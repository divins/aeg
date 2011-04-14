<?php
class PartsController extends AppController {

	var $name = 'Parts';
	var $helpers = array('Html','Ajax','Javascript');
	var $components = array( 'RequestHandler' );
	var $parts_db = array();
	
	function admin_index( $data = null ) {
	
		if($this->data)
		{	
			$paginate_opts["contain"] = array( "Planol" );
			$paginate_opts["conditions"] = array();
			$paginate_opts["order"] = array();
			
			$this->paginate = array( 'contain' => array('Planol') );
			$conditions=$this->postConditions($this->data);
			
			if(trim($conditions["Part.id"]) == "" )
			{ 
				unset($conditions["Part.id"]); 
				if(trim($conditions["Part.clave_pieza"]) == "" ){ unset($conditions["Part.clave_pieza"]); }
				if(trim($conditions["Part.clave_unidad"]) == "" ){ unset($conditions["Part.clave_unidad"]); }
				
				if(trim($conditions["Part.denominacion"]) == "" ){ unset($conditions["Part.denominacion"]); }
				else
				{ 
					$conditions["Part.denominacion LIKE"] = "%".$conditions["Part.denominacion"]."%"; 
					unset($conditions["Part.denominacion"]); 
				}		
			}	
			else
			{
				unset($conditions["Part.clave_pieza"]);
				unset($conditions["Part.clave_unidad"]);
				unset($conditions["Part.denominacion"]);
			}
			
			$paginate_opts["conditions"] = $conditions;
			//$paginate_opts["limit"] = 55000;
			$this->paginate = $paginate_opts;
			$this->set('parts', $this->paginate());
			//$sort_conditions = array_merge( (array)$conditions, (array)$paginate_opts["order"] );
			//$this->set('conditions', $sort_conditions);
			$this->set('conditions', $conditions);
		}
		else if( $this->passedArgs )
		{		
			$conditions = $this->passedArgs;
		
			unset($conditions["page"]);
			unset($conditions["sort"]);
			unset($conditions["direction"]);
			unset( $this->passedArgs['sort'] );
			unset( $this->passedArgs['direction'] );
			
			$paginate_opts["contain"] = array( "Planol" );	
			
			$paginate_opts["order"] = array();
			if( isset( $conditions["unparsed_order"] ) )
			{
				$unparsed_order = $conditions["unparsed_order"];
				unset($conditions["unparsed_order"]); 	

				$orders['all'] = explode(';', $unparsed_order );
				foreach( $orders['all'] as $order ) 
				{
					$order = explode( '__', $order );
					array_push( $paginate_opts["order"], $order[0]." ".$order[1] );
				}
				$this->set('unparsed_order', $unparsed_order);
			}
			//http://marc.divinscastellvi.name/aeg_v2/motors/index/Motor.potencia/page:4/Motor.potencia%20%3E:78/sort:altura/direction:asc
			$paginate_opts["conditions"] = $conditions;
			//DEBUG( $conditions );
			$this->paginate = $paginate_opts;
			$this->set('parts', $this->paginate());
			//$sort_conditions = array_merge( (array)$conditions, (array)$paginate_opts["order"] );
			//$this->set('conditions', $sort_conditions);
			$this->set('conditions', $conditions);
		}	
		else
		{
			$this->Part->recursive = 0;
			$this->set('parts', $this->paginate());	
			$this->set('conditions', "");
		}
	}
	
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid part', true));
			$this->redirect(array('action' => 'index'));
		}
		//$this->Part->contain('Child');
		$this->Part->contain();
		$this->set('part', $this->Part->read(null, $id));
	}
	
	function parts_of_parts_list( $id = null, $iLevel, $iParentQty, $iColor, $iPartsTrace ) {
		/*if (!$id) {
			$this->Session->setFlash(__('Invalid part', true));
			$this->redirect(array('action' => 'index'));
		}*/
		$trace = explode( ',', $iPartsTrace );
		$this->layout = 'ajax';
		$this->Part->contain('Child');
		$parts = $this->Part->findById($id);
		$i=0;
		foreach( $parts['Child'] as $child )
		{
			if( in_array( $child['id'], $trace ) )
			{ 
				$parts['Child'][$i]['denominacion'] = 'ERROR_REPEATED_ELEMENT_IN_TRACE';
				$this->log("ELEMENT REPETIT A LA TRAÇA [".$child['id']."]: ".$iPartsTrace.",".$child['id'], 'parts_inifintes');				
			}
			else
			{
				$this->Part->contain('Child');
				$child_childs = $this->Part->findById($child['id']);
				if( count( $child_childs['Child'] ) > 0 )
				{ $parts['Child'][$i]['sons'] = true; }
			}
			$i++;
		}
		//DEBUG($);
		$this->set('parts', $parts);
		$iLevel++;
		$this->set('level', $iLevel);
		$this->set('parent_qty', $iParentQty);
		$this->set('color_class', $iColor);
		$this->set('trace', $iPartsTrace);
	}
	
	function file( $iSoDocID )
	{
		Configure::write('debug', 0);
		$this->set( "filename", $iSoDocID );
    }
	
	function comprimir ($nom_arxiu)
	{
		$fptr = fopen($nom_arxiu, "rb");
		$dump = fread($fptr, filesize($nom_arxiu));
		fclose($fptr);

		//Comprime al máximo nivel, 9
		$gzbackupData = gzencode($dump,9);

		$nom_comprimit = explode('.',$nom_arxiu);
		$fptr = fopen($nom_comprimit[0] . ".gz", "wb");
		fwrite($fptr, $gzbackupData);
		fclose($fptr);
		unlink($nom_arxiu);
		//Devuelve el nombre del archivo comprimido
		return $nom_comprimit.".gz";
	}
	
	function motor_export_html_header( $iID )
	{
		$stringData = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' 
			.'<html xmlns="http://www.w3.org/1999/xhtml">'
			.'<head>' 
				.'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'
				.'<title>Fons AEG: '.$iID.'</title> '
				.'<style type="text/css">'
				."#body{}/* Links */A:link { color:#5E0531; text-decoration:none; font-weight: bold; }A:visited { color:#5E0531; text-decoration:none; font-weight: bold; }A:active { color:#5E0531; text-decoration:underline; }A:hover { color:#5E0531; text-decoration: underline; }a img { border:none; }/* Tables */table{ 	border-collapse: collapse; 	padding:0px;	margin:0px;	background: #fff;	border-right:0;	clear: both;	color: #333;	width: 100%;}th {	border:0;	border-bottom:2px solid #555;	text-align: left;	padding:4px;}table tr td {	padding: 3px;	border-bottom:1px solid #ddd;}/* Titles */h1, h2, h3, h4 {	font-weight: normal;	margin-bottom:0.5em;}h1 {	background:#fff;	color: #003d4c;	font-size: 100%;}h2 {	background:#fff;	color: #e32;	font-family:'Gill Sans','lucida grande', helvetica, arial, sans-serif;	font-size: 190%;}h3 {	color: #993;	font-family:'Gill Sans','lucida grande', helvetica, arial, sans-serif;	font-size: 165%;}h4 {	color: #993;	font-weight: normal;}/***********************//* Motor Search Engine *//***********************/.motorid_col {	text-align:center;} .piecec_col {	width:70px;	text-align:center;} .unityc_col {	width:85px;	text-align:center;} .denomination_col {} .serie_col {	width:60px;	text-align:center;} .height_col {	width:70px;	text-align:center;} .power_col {	width:85px;	text-align:center;} .voltage_col {	width:75px;	text-align:center;} .shape_col {	width:70px;	text-align:center;} .plan_col {	text-align:center;} /*****************//* View Motor    *//*****************/#motor {  	margin-top:20px;} #components {  	margin-top:20px;} #MotorView_Serie {	margin-top:10px;} #MotorView_Serie .serie_previous_text, .serie_id{ 	font-weight:bold;} /**********************//* Part Search Engine *//**********************/#components .partid_col_th {	text-align:center;} #components .partid_col_td {	text-align:left; } #components .quantity_col {	width:50px; 	text-align:center;} #components .quantity_col {	width:50px; 	text-align:center;} #components .unityc_col {	width:50px; 	text-align:center;} #components .denomination_col_th {	width:350px; 	text-align:center;} #components .denomination_col_td {	width:350px; 	text-align:left;} #components .plan_col {	width:60px; 	text-align:center;} .component_son {	margin-left:15px;} /**********//* Colors *//**********/.error { background-color:#FF0000; font-weight:bold; } .color_0_hard { background-color:#DDDDDD; } .color_0_soft { background-color:#999999; } .color_2_hard { background-color:#FFCE95; } .color_2_soft { background-color:#FFBA6B; } .color_4_hard { background-color:#FFF9A4; } .color_4_soft { background-color:#FFF66B; } .color_6_hard { background-color:#D7FFA4; } .color_6_soft { background-color:#BBFD65; } .color_8_hard { background-color:#C2FDE0; } .color_8_soft { background-color:#65FDB1; }"
				.'</style>'
			.'</head>'
			.'<body>'
			.'<script type="text/javascript">'
			.'function toggle(div_id)'
			.'{'
			.'	var el = document.getElementById(div_id);'
			.'	if ( el.style.display == "none" ) { el.style.display = "block";}'
			.'		else {el.style.display = "none";}'
			.'}' 
			.'</script>';
		return $stringData;
	}
	
	function get_all_childs( $iID )
	{
		$myFile = "/var/www/clients/client3/web11/web/aeg_v2/files/exported_motors/".$iID.".html";
		$myCompressedFile = "/var/www/clients/client3/web11/web/aeg_v2/files/exported_motors/".$iID.".gz";
		
		if ( !file_exists($myCompressedFile) ) 
		{
			$fh = fopen($myFile, 'w') or die("can't open file");
			Configure::write('debug', 0);
			$componentes_totales=0;
			$componentes_repetidos=0;
			//$motor = array('21000013','22006480','29101599');
			//$motor = array('22006480');
			//$motor = array('22780845');
			//$this->layout = 'export_html';
			$stringData = $this->motor_export_html_header( $iID );
			fwrite($fh, $stringData);
			/*header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
			header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
			header ("Cache-Control: no-cache, must-revalidate");
			header ("Pragma: no-cache");
			header ("Content-type: text/html");
			//header ("Content-type: application/zip");
			header ("Content-Disposition: attachment; filename=\"".$iID.".html\"" );
			header ("Content-Description: Generated Report" );
			*/
			$this->loadModel('Motor');
			$motor = $this->Motor->read(null, $iID);
			$colors_depth = $this->get_colors();
			$z=0;
			
			$stringData = '<div id="motor" class="grid_16">'
				.'<h2>'.__('Motor',true).'</h2>'
				.'<br><br>'
				.'<table>'
					.'<tr>'
						.'<th class="motorid_col">'.__('ID', true).'</th>'
						.'<th class="piecec_col">'.__('Piece_Code', true ).'</th>'
						.'<th class="unityc_col">'.__('Unit_Code', true ).'</th>'
						.'<th class="denomination_col">'.__('Denomination', true ).'</th>'
						.'<th class="serie_col">'.__('Serie', true ).'</th>'
						.'<th class="height_col">'.__('Height', true ).'</th>'
						.'<th class="power_col">'.__('Power', true ).'</th>'
						.'<th class="voltage_col">'.__('Voltage', true ).'</th>'
						.'<th class="shape_col">'.__('Shape', true ).'</th>'
						//.'<th class="plan_col">'.__( "Plan", true ).'</th>'
					.'</tr>'
					.'<tr>'
						.'<td class="motorid_col">'.$motor['Motor']['id'].'&nbsp;</td>'
						.'<td class="piecec_col">'.$motor['Motor']['clave_pieza'].'&nbsp;</td>'
						.'<td class="unityc_col">'.$motor['Motor']['clave_unidad'].'&nbsp;</td>'
						.'<td class="denomination_col">'.$motor['Motor']['denominacion'].'&nbsp;</td>'
						.'<td class="serie_col">'.$motor['Serie']['codigo'].'</td>'
						.'<td class="height_col">'.$motor['Motor']['altura'].'&nbsp;</td>'
						.'<td class="power_col">'.$motor['Motor']['potencia'].'&nbsp;</td>'
						.'<td class="voltage_col">'.$motor['Motor']['tension'].'&nbsp;</td>'
						.'<td class="shape_col">'.$motor['Motor']['forma'].'&nbsp;</td>'
					.'</tr>'
				.'</table>'
			.'</div>'
			.'<div id="MotorView_Serie" class="grid_16">'
			.'<span class="serie_previous_text">'.__("Serie_Description", true).'</span><span class="serie_id"> '.$motor['Serie']['codigo'].': </span><span class="serie_description">'.$motor['Serie']['descripcion'].'</span>'
			//.'<b>'.__("Serie_Description", true)." ".$motor['Serie']['codigo'].": </b>".$motor['Serie']['descripcion']
			.'</div>'
			.'<div class="clear" Style="margin-top:35px;">&nbsp;</div>';
			fwrite($fh, $stringData);
			
			$stringData = '<div id="planols_list">'
				.'<table>'
					.'<tr>'
						.'<td Style="min-width:100px; text-align:center;">'.__( 'ID', true ).'</td>'
						.'<td Style="min-width:100px; text-align:center;">'.__( 'Code', true ).'</td>'
						.'<td Style="min-width:200px; text-align:center;">'.__( 'Digital_Image', true ).'</td>'
						.'<td Style="min-width:200px; text-align:center;">'.__( 'Location', true ).'</td>'
						.'<td Style="min-width:170px; text-align:center;">'.__( 'Actions', true ).'</td>'
					.'</tr>';
			fwrite($fh, $stringData);	
			foreach( $motor['Planol'] as $planol )
			{
				$stringData = "<tr>"
					."<td>".$planol['id']."</td>"
					."<td>".$planol['codigo']."</td>"
					."<td>".$planol['img_digital']."</td>"
					."<td>".$planol['ubicacion']."</td>"
					."</tr>";
				fwrite($fh, $stringData);
			}
			$stringData = '</table>'
				.'</div>';
			fwrite($fh, $stringData);
			
			foreach( $motor['Part'] as $child )
			{
				$iLevel=0;
				$style = $colors_depth[$iLevel][0];
				if ($z++ % 2 == 0) { $style = $colors_depth[$iLevel][1]; }
				$num_padre = $componentes_totales;
				
				$tabla_padre['before'] = "<div id='".$child['id']."_".($iLevel-1)."_".($componentes_totales)."' Style='background-color:#".$style."'>&nbsp;\n"
					."<table cellpadding = '0' cellspacing = '0' Style='margin-bottom:0px; background-color:#".$style."'>\n"
					."<tr>\n";
				$tabla_padre['link'] = "";
				$tabla_padre['after'] = "";
				$tabla_padre['child'] = "";
				$tabla_padre['id'] = $child['id'];
				
				$tabla_padre['link'] = '<td Style="text-align:left; background-color:#'.$style.'"><a href="javascript: void toggle(\''.$child['id']."_".$num_padre.'\')">'.$child['id'].'</a></td><!-- \n -->';
				$tabla_padre['after'] = '<td Style="width:50px; text-align:center; background-color:#'.$style.'">'.$child['MotorsPart']['cantidad'].'</td><!-- \n -->'
					.'<td Style="width:50px; text-align:center; background-color:#'.$style.'">'.$child['clave_pieza'].'</td><!-- \n -->'
					.'<td Style="width:50px; text-align:center; background-color:#'.$style.'">'.$child['clave_unidad'].'</td><!-- \n -->'
					.'<td Style="width:350px; text-align:left; background-color:#'.$style.'">'.utf8_encode($child['denominacion']).'</td><!-- \n -->'
					."</tr><!-- \n -->"				
					."</table><!-- \n -->";
				$display = '';
				$tabla_padre['child'] = '<div id="'.$child['id']."_".$num_padre.'" Style="'.$display.'width:'.(940-($iLevel*15)).'px; margin-left:15px; background-color:#'.$colors_depth[$iLevel].'">';
						
				$this->Part->contain('Child');
				$part = $this->Part->findById($child['id']);		
				if( count( $part['Child'] ) == 0 ){ $tabla_padre['link'] = '<td Style="text-align:left; background-color:#'.$style.'">'.$child['id'].'</td>'; }
				//echo $tabla_padre['before'].$tabla_padre['link'].$tabla_padre['after'].$tabla_padre['child'];
				$stringData = $tabla_padre['before'].$tabla_padre['link'].$tabla_padre['after'].$tabla_padre['child'];
				fwrite($fh, $stringData);
				$this->get_childs( $child['id'], $child['id'], &$parts_db, &$componentes_totales, &$componentes_repetidos, $iLevel, &$fh, $part  );
				//echo "</div></div>";
				$stringData = "</div></div><!-- \n -->"
					.'</body></html>';
				fwrite($fh, $stringData);
			}
			unset($parts_db);
			fclose($fh);
			if( $this->comprimir($myFile) )
			{
				$this->set("id",$iID);
				$this->set("file",$myFile);
			}
		}
		else
		{
			$this->set("id",$iID);
			$this->set("file",$myFile);
		}
		
		//DEBUG( $all_childs );
		//DEBUG( $parts_db );
		//DEBUG($componentes_totales);
		//DEBUG($componentes_repetidos);
	}	
		
	function get_colors()
	{
		//Row Background Color
		$colors_depth[0][0] = "DDDDDD";
		$colors_depth[0][1] = "999999";
		$colors_depth[1][0] = "FFCE95";
		$colors_depth[1][1] = "FFBA6B";
		$colors_depth[2][0] = "D7FFA4";
		$colors_depth[2][1] = "BBFD65";
		$colors_depth[3][0] = "FFF9A4";
		$colors_depth[3][1] = "FFF66B";
		$colors_depth[4][0] = "C2FDE0";
		$colors_depth[4][1] = "65FDB1";
		//---
		$colors_depth[5][0] = "DDDDDD";
		$colors_depth[5][1] = "999999";
		$colors_depth[6][0] = "FFCE95";
		$colors_depth[6][1] = "FFBA6B";
		$colors_depth[7][0] = "D7FFA4";
		$colors_depth[7][1] = "BBFD65";
		$colors_depth[8][0] = "FFF9A4";
		$colors_depth[8][1] = "FFF66B";
		$colors_depth[9][0] = "C2FDE0";
		$colors_depth[9][1] = "65FDB1";
		$colors_depth[10][0] = "DDDDDD";
		$colors_depth[10][1] = "999999";
		$colors_depth[11][0] = "FFCE95";
		$colors_depth[11][1] = "FFBA6B";
		$colors_depth[12][0] = "D7FFA4";
		$colors_depth[12][1] = "BBFD65";
		$colors_depth[13][0] = "FFF9A4";
		$colors_depth[13][1] = "FFF66B";
		$colors_depth[14][0] = "C2FDE0";
		$colors_depth[14][1] = "65FDB1";
		$colors_depth[15][0] = "DDDDDD";
		$colors_depth[15][1] = "999999";
		$colors_depth[16][0] = "FFCE95";
		$colors_depth[16][1] = "FFBA6B";
		$colors_depth[17][0] = "D7FFA4";
		$colors_depth[17][1] = "BBFD65";
		$colors_depth[18][0] = "FFF9A4";
		$colors_depth[18][1] = "FFF66B";
		$colors_depth[19][0] = "C2FDE0";
		$colors_depth[19][1] = "65FDB1";
		
		return $colors_depth;
	}
	
	function get_childs( $iID, $iPartsTrace, &$parts_db, &$componentes_totales, &$componentes_repetidos, $iLevel, &$fh, $iChild = null )
	{
		$num_padre = $componentes_totales;
		$colors_depth = $this->get_colors();
		$trace = explode( ',', $iPartsTrace );
		//$this->layout = 'ajax';
		if(!$iChild)
		{
			$this->Part->contain('Child');
			$part = $this->Part->findById($iID);
		}
		else{ $part = $iChild; }
		
		$parts_db[ $part['Part']['id'] ]['id'] = $part['Part']['id'];
		$parts_db[ $part['Part']['id'] ]['clave_pieza'] = $part['Part']['clave_pieza'];
		$parts_db[ $part['Part']['id'] ]['clave_unidad'] = $part['Part']['clave_unidad'];
		$parts_db[ $part['Part']['id'] ]['denominacion'] = $part['Part']['denominacion'];
		//$parts_db[ $part['Part']['id'] ]['cantidad'] = $part['Part']['PartsPart']['cantidad'];
		$parts_db[ $part['Part']['id'] ]['parts'] = "";
		
		$iLevel++;
		if( $iLevel <= 18 )
		{
			$z = 0;
			foreach( $part['Child'] as $child )
			{
				$style = $colors_depth[$iLevel][0];
				if ($z++ % 2 == 0) { $style = $colors_depth[$iLevel][1]; }
				
				if( in_array( $child['id'], $trace ) )
				{ 
					$stringData = "<div id='".$child['id']."_".($iLevel-1)."_".($componentes_totales)."' Style='background-color:#".$style."'>&nbsp;<!-- \n -->"
						."<table cellpadding = '0' cellspacing = '0' Style='margin-bottom:0px; background-color:#".$style."'><!-- \n -->"
						.'<td Style="text-align:left; background-color:#FF0000; font-weight:bold">'.$child['id'].'</td><!-- \n -->'
						.'<td colspan="4" Style="text-align:left; background-color:#FF0000; font-weight:bold">'.__('ERROR_REPEATED_ELEMENT_IN_TRACE',true).'</td><!-- \n -->'
						."</table></div><!-- \n -->";
					$this->log("ELEMENT REPETIT A LA TRAÇA [".$child['id']."]: ".$iPartsTrace.",".$child['id'], 'parts_infinites');		
					//echo $stringData;
					fwrite($fh, $stringData);
				}
				else
				{
					$parts_db[ $part['Part']['id'] ]['parts'] = $parts_db[ $part['Part']['id'] ]['parts'].",".$child['id']."*".$child['PartsPart']['cantidad'];
					
					$tabla_padre['before'] = "<div id='".$child['id']."_".($iLevel-1)."_".($componentes_totales)."' Style='background-color:#".$style."'>&nbsp;<!-- \n -->"
						."<table cellpadding = '0' cellspacing = '0' Style='margin-bottom:0px; background-color:#".$style."'><!-- \n -->"
						."<tr><!-- \n -->";
					$tabla_padre['link'] = "";
					$tabla_padre['after'] = "";
					$tabla_padre['child'] = "";
					$tabla_padre['id'] = $child['id'];
					
					$tabla_padre['link'] = '<td Style="text-align:left; background-color:#'.$style.'"><a href="javascript: void toggle(\''.$child['id']."_".$num_padre.'\')">'.$child['id'].'</a></td><!-- \n -->';
					$tabla_padre['after'] = '<td Style="width:50px; text-align:center; background-color:#'.$style.'">'.$child['PartsPart']['cantidad'].'</td><!-- \n -->'
						.'<td Style="width:50px; text-align:center; background-color:#'.$style.'">'.$child['clave_pieza'].'</td><!-- \n -->'
						.'<td Style="width:50px; text-align:center; background-color:#'.$style.'">'.$child['clave_unidad'].'</td><!-- \n -->'
						.'<td Style="width:350px; text-align:left; background-color:#'.$style.'">'.utf8_encode($child['denominacion']).'</td><!-- \n -->'
						."</tr><!-- \n -->"				
						."</table><!-- \n -->";
					if($iLevel>=1){ $display = 'display:none; ';}
					else{ $display = '';}
					$tabla_padre['child'] = '<div id="'.$child['id']."_".$num_padre.'" Style="'.$display.'width:'.(940-($iLevel*15)).'px; margin-left:15px; background-color:#'.$colors_depth[$iLevel].'"><!-- \n -->';
					
					if( isset( $parts_db[ $child['id'] ] ) )
					{ 
						$content_parts = explode( ',', $parts_db[ $child['id'] ]['parts'] );
						if( count( $content_parts ) <= 1 ){ $tabla_padre['link'] = '<td Style="text-align:left; background-color:#'.$style.'">'.$child['id'].'</td><!-- \n -->'; }
						//echo $tabla_padre['before'].$tabla_padre['link'].$tabla_padre['after'].$tabla_padre['child'];
						$stringData = $tabla_padre['before'].$tabla_padre['link'].$tabla_padre['after'].$tabla_padre['child'];
						fwrite($fh, $stringData);
						$componentes_repetidos++;
						$content_parts = explode( ',', $parts_db[ $child['id'] ]['parts'] );
						if( count( $content_parts )>1 )
						{ 
							$this->get_childs_from_parts_db( $child['id'], $iPartsTrace.",".$child['id'], &$parts_db, &$componentes_totales, &$componentes_repetidos, $iLevel, &$fh ); 
						}
					}
					else
					{ 
						$this->Part->contain('Child');
						$child_part = $this->Part->findById( $child['id'] );
						if( count( $child_part['Child'] ) == 0 ){ $tabla_padre['link'] = '<td Style="text-align:left; background-color:#'.$style.'">'.$child['id'].'</td><!-- \n -->'; }
						//echo $tabla_padre['before'].$tabla_padre['link'].$tabla_padre['after'].$tabla_padre['child'];
						$stringData = $tabla_padre['before'].$tabla_padre['link'].$tabla_padre['after'].$tabla_padre['child'];
						fwrite($fh, $stringData);
						$this->get_childs( $child['id'], $iPartsTrace.",".$child['id'], &$parts_db, &$componentes_totales, &$componentes_repetidos, $iLevel, &$fh, $child_part ); 
					}
					//echo "</div></div>";
					$stringData = "</div></div><!-- \n -->";
					fwrite($fh, $stringData);
					$componentes_totales++;
				}
			}
		}
	}
	
	function get_childs_from_parts_db( $iID, $iPartsTrace, &$parts_db, &$componentes_totales, &$componentes_repetidos, $iLevel, &$fh )
	{
		$num_padre = $componentes_totales;
		$colors_depth = $this->get_colors();
		$trace = explode( ',', $iPartsTrace );
		//$this->layout = 'ajax';
		$iLevel++;
		$content_parts = explode( ',', $parts_db[ $iID ]['parts'] );
		
		if( $iLevel <= 18 && count( $content_parts )>1 )
		{		
			$z = 0;
			foreach( $content_parts as $child)
			{
				$child = explode( '*', $child );
				$child_id = $child[0];
				$child_qty = $child[1];
				
				if( isset( $parts_db[ $child_id ] ) )
				{
					$child = $parts_db[ $child_id ];
					
					$style = $colors_depth[$iLevel][0];
					if ($z++ % 2 == 0) { $style = $colors_depth[$iLevel][1]; }
					
					if( in_array( $child['id'], $trace ) )
					{ 
						$stringData = "<div id='".$child['id']."_".($iLevel-1)."_".($componentes_totales)."' Style=' display:hidden; background-color:#".$style."'>&nbsp;<!-- \n -->"
							."<table cellpadding = '0' cellspacing = '0' Style='margin-bottom:0px; background-color:#".$style."'><!-- \n -->"
							.'<td Style="text-align:left; background-color:#FF0000; font-weight:bold">'.$child['id'].'</td><!-- \n -->'
							.'<td colspan="4" Style="text-align:left; background-color:#FF0000; font-weight:bold">'.__('ERROR_REPEATED_ELEMENT_IN_TRACE',true).'</td><!-- \n -->'
							."</table></div><!-- \n -->";	
						$this->log("ELEMENT REPETIT A LA TRAÇA [".$child['id']."]: ".$iPartsTrace.",".$child['id'], 'parts_infinites');		
						//echo $stringData;
						fwrite($fh, $stringData);						
					}
					else
					{	
						$tabla_padre['before'] = "<div id='".$child['id']."_".($iLevel-1)."_".($componentes_totales)."' Style='background-color:#".$style."'>&nbsp;<!-- \n -->"
							."<table cellpadding = '0' cellspacing = '0' Style='margin-bottom:0px; background-color:#".$style."'><!-- \n -->"
							."<tr><!-- \n -->";
						$tabla_padre['link'] = "";
						$tabla_padre['after'] = "";
						$tabla_padre['child'] = "";
						$tabla_padre['id'] = $child['id'];
						
						$tabla_padre['link'] = '<td Style="text-align:left; background-color:#'.$style.'"><a href="javascript: void toggle(\''.$child['id']."_".$num_padre.'\')">'.$child['id'].'</a></td><!-- \n -->';
						$tabla_padre['after'] = '<td Style="width:50px; text-align:center; background-color:#'.$style.'">'.$child['PartsPart']['cantidad'].'</td><!-- \n -->'
							.'<td Style="width:50px; text-align:center; background-color:#'.$style.'">'.$child['clave_pieza'].'</td><!-- \n -->'
							.'<td Style="width:50px; text-align:center; background-color:#'.$style.'">'.$child['clave_unidad'].'</td><!-- \n -->'
							.'<td Style="width:350px; text-align:left; background-color:#'.$style.'">'.utf8_encode($child['denominacion']).'</td><!-- \n -->'
							."</tr><!-- \n -->"				
							."</table><!-- \n -->";
						if($iLevel>=1){ $display = 'display:none; ';}
						else{ $display = '';}
						$tabla_padre['child'] = '<div id="'.$child['id']."_".$num_padre.'" Style="'.$display.'width:'.(940-($iLevel*15)).'px; margin-left:15px; background-color:#'.$colors_depth[$iLevel].'">';
												
						if( isset( $parts_db[ $child['id'] ] ) )
						{ 
							$content_parts = explode( ',', $parts_db[ $child['id'] ]['parts'] );
							if( count( $content_parts ) <= 1 ){ $tabla_padre['link'] = '<td Style="text-align:left; background-color:#'.$style.'">'.$child['id'].'</td><!-- \n -->'; }
							//echo $tabla_padre['before'].$tabla_padre['link'].$tabla_padre['after'].$tabla_padre['child'];
							$stringData = $tabla_padre['before'].$tabla_padre['link'].$tabla_padre['after'].$tabla_padre['child'];
							fwrite($fh, $stringData);
							$componentes_repetidos++;
							$content_parts = explode( ',', $parts_db[ $child['id'] ]['parts'] );
							if( count( $content_parts )>1 )
							{ 
								$this->get_childs_from_parts_db( $child['id'], $iPartsTrace.",".$child['id'], &$parts_db, &$componentes_totales,&$componentes_repetidos, $iLevel, &$fh ); 
							}
						}
						//echo "</div></div>";
						$stringData = "</div></div><!-- \n -->";
						fwrite($fh, $stringData);
						$componentes_totales++;
					}
				}
			}
		}
	}
	
	/*function get_childs( $iID, $iPartsTrace )
	{
		$trace = explode( ',', $iPartsTrace );
		$this->layout = 'ajax';
		$this->Part->contain('Child');
		$parts = $this->Part->findById($iID);
		//DEBUG( $parts );
		$i=0;
		$parts_of_part = array();
		foreach( $parts['Child'] as $child )
		{
			if( in_array( $child['id'], $trace ) )
			{ 
				$parts_of_part[ $child['id'] ][ 'denominacion' ] = "ERROR->ELEMENT REPETIT A LA TRAÇA";
				//$this->log("ELEMENT REPETIT A LA TRAÇA [".$child['id']."]: ".$iPartsTrace.",".$child['id'], 'parts_inifintes');				
			}
			else
			{
				$parts_of_part[ $child['id'] ]['id'] = $child['id'];
				$parts_of_part[ $child['id'] ]['clave_pieza'] = $child['clave_pieza'];
				$parts_of_part[ $child['id'] ]['clave_unidad'] = $child['clave_unidad'];
				$parts_of_part[ $child['id'] ]['denominacion'] = $child['denominacion'];
				$parts_of_part[ $child['id'] ]['cantidad'] = $child['PartsPart']['cantidad'];
				$parts_of_part[ $child['id'] ]['parts'] = $this->get_childs( $child['id'], $iPartsTrace.",".$child['id'] );
			}
			$i++;
		}
		return $parts_of_part;
	}*/
	
	function admin_parts_of_parts_list( $id = null, $iLevel, $iParentQty, $iColor, $iPartsTrace, $iParentID = null, $iMotorPart = false ) {
		/*if (!$id) {
			$this->Session->setFlash(__('Invalid part', true));
			$this->redirect(array('action' => 'index'));
		}*/
		$trace = explode( ',', $iPartsTrace );
		$this->layout = 'ajax';
		$this->Part->contain('Child');
		$parts = $this->Part->findById($id);
		$i=0;
		foreach( $parts['Child'] as $child )
		{
			if( in_array( $child['id'], $trace ) )
			{ 
				$parts['Child'][$i]['denominacion'] = "ERROR->ELEMENT REPETIT A LA TRAÇA";
				$this->log("ELEMENT REPETIT A LA TRAÇA [".$child['id']."]: ".$iPartsTrace.",".$child['id'], 'parts_inifinites');				
			}
			else
			{
				$this->Part->contain('Child');
				$child_childs = $this->Part->findById($child['id']);
				if( count( $child_childs['Child'] ) > 0 )
				{ $parts['Child'][$i]['sons'] = true; }
			}
			$i++;
		}
		//DEBUG($);
		$this->set('parts', $parts);
		$iLevel++;
		$this->set('level', $iLevel);
		$this->set('parent_qty', $iParentQty);
		$this->set('color_class', $iColor);
		$this->set('trace', $iPartsTrace);
		//$this->set('style', $iStyle);
		if(isset($iParentID))
		{ 
			/*echo "ID: ".$iParentID."<br>";
			echo "MotorPart: ".$iMotorPart."<br>";*/
			if( !$iMotorPart ){ $iParent['Motor'] = $iParentID; }
			else{ $iParent['Part'] = $iParentID; }
			$this->set('ParentID', $iParent); 
		}
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Part->create();
			if ($this->Part->save($this->data)) {
				$this->Session->setFlash(__('The part has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The part could not be saved. Please, try again.', true));
			}
		}
		$motors = $this->Part->Motor->find('list');
		$parts = $this->Part->Part->find('list');
		$planols = $this->Part->Planol->find('list');
		$this->set(compact('motors', 'parts', 'planols'));
	}

	function admin_edit($id = null) {
		$this->set('title_for_layout', 'Editar Part - '.$id);
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid part', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Part->save($this->data)) {
				$this->Session->setFlash(__('The part has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The part could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$opts["contain"] = array('Planol','Child' );
			$opts["conditions"] = array('Part.id'=>$id );
			$this->data = $this->Part->find( 'first', $opts );
			//DEBUG( $this->data );
		}
	}

	function admin_quick_edit($id = null, $iCancel = false, $iColor_Class = '') {
		if( $iCancel )
		{ 
			$this->data = $this->Part->read(null, $id);
			$this->set( 'color_class', $iColor_Class );
			$this->render('admin_quick_edit_saved'); 
		}
		else
		{
			if (!$id && empty($this->data)) {
				$this->set('error_msg', __("L'identificador de la part introduida no existeix.",true) );
				$this->render('admin_quick_edit_error');
			}
			if (!empty($this->data)) {
				$iColor_Class = $this->data['row_info']['color_class'];
				unset( $this->data['row_info'] );
				$this->set( 'color_class', $iColor_Class );
				if ($this->Part->save($this->data)) {
					//$this->Session->setFlash(__('The part has been saved', true));
					//$this->redirect(array('action' => 'index'));
					$this->render('admin_quick_edit_saved');
				} else {
					$this->set('error_msg', "Hi ha hagut un error al guardar, si us plau intenta-ho de nou.");
					$this->render('admin_quick_edit_error');
				}
			}
			if (empty($this->data)) {
				$this->set( 'color_class', $iColor_Class );
				$this->data = $this->Part->read(null, $id);
				//$this->set( 'class', $iClass );
			}
		}
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for part', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Part->delete($id)) {
			$this->Session->setFlash(__('Part deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Part was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_add_planol()
	{
		if (!empty($this->data)) 
		{
			$new_planol = $this->data;
			//DEBUG( $new_planol );
			if( $new_planol['Planol']['id'] != null ) { $planol_id_exists = $this->Part->Planol->findById( $new_planol['Planol']['id'] ); }
			else{ $planol_id_exists = null;}
			/*if( $new_planol['Planol']['codigo'] != null ) { $planol_code_exists = $this->Phone->findByCodigo( $new_planol['Planol']['codigo'] ); }
			else{ $planol_code_exists = null;}*/
			
			$opts["contain"] = array('Planol'=>array( 'fields'=>array('id') ) );
			$opts["conditions"] = array('Part.id'=>$new_planol['Part']['id'] );
			$opts["fields"] = array('Part.id');
			$tPart = $this->Part->find( 'all', $opts );
			//DEBUG( $tPart );
			
			$repeated = false;
			$planols = array();
			foreach( $tPart[0]['Planol'] as $planol )
			{
				array_push( $planols, $planol['id'] );
				if( $planol['id'] == $new_planol['Planol']['id'] ){ $repeated = true; }
			}
			if( !$repeated )
			{
				$part['Part']['id'] = $tPart[0]['Part']['id'];
				$part['Planol'] = $planols;
				
				//array_push( $motor[0]['Planol'], array('id'=>$new_planol['Planol']['id']) );
				array_push( $part['Planol'], $new_planol['Planol']['id'] );
				
				//DEBUG( $motor );
				if ($this->Part->saveAll($part)) 
				{
					$this->data = $this->Part->read(null, $new_planol['Part']['id']);
				}
				else
				{
				
				}
			}
			else
			{
			
			}
		}
		else{  }
	}
	
	function admin_del_planol( $iPartID, $iPlanolID )
	{
		$opts["contain"] = array('Planol'=>array( 'fields'=>array('id') ) );
		$opts["conditions"] = array('Part.id'=>$iPartID );
		$opts["fields"] = array('Part.id');
		$tMotor = $this->Part->find( 'all', $opts );
		//DEBUG( $tMotor );
		if( count($tMotor)>0 )
		{
			$planols = array();
			$found = false;
			foreach( $tMotor[0]['Planol'] as $planol )
			{
				if( $planol['id'] != $iPlanolID ){ array_push( $planols, $planol['id'] ); }
				else{ $found = true; }
			}
			if( $found )
			{
				$part['Part']['id'] = $tMotor[0]['Part']['id'];
				$part['Planol'] = $planols;
				if ($this->Part->saveAll($part)) 
				{
					$this->data = $this->Part->read(null, $part['Part']['id']);
				}
				else
				{
				
				}
			}
			else
			{
			
			}
		}
		$this->render( "admin_add_planol" );
	}
	
	function mostrar_planols( $iPartID )
	{
		$planols = $this->Part->find( "first", array('contain' => 'Planol', "conditions" => array( "Part.id" => $iPartID ) ) );
		$this->set( "planols", $planols);
		//$planols = $this->Planol->find( "all", array('contain' => 'Motor.id = '.$iMotorID, "conditions" => array( "Serie.codigo" => $motor["Motor"]["serie_id"] ), "fields" => array( "id", "codigo" ) ) );
	}	
	
	function admin_mostrar_planols( $iPartID )
	{
		$planols = $this->Part->find( "first", array('contain' => 'Planol', "conditions" => array( "Part.id" => $iPartID ) ) );
		$this->set( "planols", $planols);
		//$planols = $this->Planol->find( "all", array('contain' => 'Motor.id = '.$iMotorID, "conditions" => array( "Serie.codigo" => $motor["Motor"]["serie_id"] ), "fields" => array( "id", "codigo" ) ) );
	}	
	
	function admin_add_part()
	{
		if (!empty($this->data)) 
		{
			$new_part = $this->data;
			//DEBUG( $new_part );
			if( $new_part['Part']['id'] != null ) { $planol_id_exists = $this->Part->findById( $new_part['Part']['child_id'] ); }
			else{ $planol_id_exists = null;}
			/*if( $new_planol['Planol']['codigo'] != null ) { $planol_code_exists = $this->Phone->findByCodigo( $new_planol['Planol']['codigo'] ); }
			else{ $planol_code_exists = null;}*/
			
			//$opts["contain"] = array('Part'=>array( 'fields'=>array('id') ) );
			$opts["conditions"] = array('Part.id'=>$new_part['Part']['id'] );
			$opts["fields"] = array('Part.id');
			$tPart = $this->Part->find( 'all', $opts );
			//DEBUG( $tPart );
			
			$repeated = false;
			$parts = array();
			foreach( $tPart[0]['Child'] as $Part )
			{
				$part['id'] = $Part['id'];
				$part['PartsPart']['parent_id'] = $Part['PartsPart']['parent_id'];
				$part['PartsPart']['child_id'] = $Part['PartsPart']['child_id'];
				$part['PartsPart']['cantidad'] = $Part['PartsPart']['cantidad'];
				
				//array_push( $parts, $Part['id'] );
				array_push( $parts, $part );
				if( $Part['id'] == $new_part['Part']['child_id'] ){ $repeated = true; }
			}
			//DEBUG( $parts );
			$parent = false;
			
			foreach( $tPart[0]['Parent'] as $Part )
			{
				if( $Part['id'] == $new_part['Part']['child_id'] ){ $parent = true; }
			}
			
			//DEBUG( "Parent: ".$parent."; Repeated: ".$repeated );
			
			if( !$repeated && !$parent )
			{
				$edited_part['Part']['id'] = $new_part['Part']['id'];
				$edited_part['Child'] = $parts;
				
				$part['id'] = $new_part['Part']['id'];
				$part['PartsPart']['parent_id'] = $new_part['Part']['id'];
				$part['PartsPart']['child_id'] = $new_part['Part']['child_id'];
				$part['PartsPart']['cantidad'] = $new_part['Part']['quantitat'];
				
				array_push( $edited_part['Child'], $part );
				//DEBUG( $edited_part );
				//array_push( $motor['Part'], $new_part['Part']['id'] );

				if ($this->Part->saveAll($edited_part)) 
				{
					$this->data = $this->Part->read(null, $new_part['Part']['id']);
				}
				else
				{
				
				}
			}
			else
			{
			
			}
		}
		else{  }
	}
	
	function admin_del_part( $iPartID, $iChildID )
	{
		//$opts["contain"] = array('Part'=>array( 'fields'=>array('id') ) );	
		$opts["conditions"] = array('Part.id'=>$iPartID );
		$opts["fields"] = array('Part.id');
		$tPart = $this->Part->find( 'all', $opts );
		//DEBUG( $tMotor );
		
		if( count($tPart)>0 )
		{
			$parts = array();
			$found = false;
			foreach( $tPart[0]['Child'] as $Part )
			{
				$part['id'] = $Part['id'];
				$part['PartsPart']['parent_id'] = $Part['PartsPart']['parent_id'];
				$part['PartsPart']['child_id'] = $Part['PartsPart']['child_id'];
				$part['PartsPart']['cantidad'] = $Part['PartsPart']['cantidad'];
				
				//array_push( $parts, $Part['id'] );
				//array_push( $parts, $part );
				//if( $Part['id'] == $new_part['Part']['id'] ){ $repeated = true; }
				
				if( $Part['id'] != $iChildID ){ array_push( $parts, $part ); }
				else{ $found = true; }
			}
			//DEBUG( $parts );
			if( $found )
			{
				$edited_part['Part']['id'] = $iPartID;
				$edited_part['Child'] = $parts;
				
				//DEBUG( $edited_part );
				if ($this->Part->saveAll($edited_part)) 
				{
					$this->data = $this->Part->read(null, $edited_part['Part']['id']);
				}
				else
				{
				
				}
			}
			else
			{
			
			}
		}
		$this->render( "admin_add_part" );
	}
	
	function admin_quick_edit_wqty( $iParentID = null, $iPartID = null, $iCancel = false, $iStyle = "", $iLevel = null, $iTrace = "")
	{
		if( $iCancel )
		{ 
			$opts["contain"] = array('Child');
			$opts["conditions"] = array('Part.id'=>$iParentID );
			$opts["fields"] = array('Part.id');
			$tParent = $this->Part->find( 'all', $opts );
			
			$repeated = false;
			$part = array();
			foreach( $tParent[0]['Child'] as $Part )
			{
				if( $Part['id'] == $iPartID )
				{
					$part['parent_id'] = $iParentID;
					$part['id'] = $Part['id'];
					$part['clave_pieza'] = $Part['clave_pieza'];
					$part['clave_unidad'] = $Part['clave_unidad'];
					$part['denominacion'] = $Part['denominacion'];
					$part['PartsPart']['parent_id'] = $Part['PartsPart']['parent_id'];
					$part['PartsPart']['child_id'] = $Part['PartsPart']['child_id'];
					$part['PartsPart']['cantidad'] = $Part['PartsPart']['cantidad'];
				}
			}
			$this->set('color_class', $iStyle);
			$this->set('level', $iLevel);
			$this->set('parent_id', $iParentID);
			$this->set('trace', $iTrace);
			
			$opts["contain"] = array('Child');
			$opts["conditions"] = array('Part.id'=>$iPartID );
			$opts["fields"] = array('Part.id');
			$tPart = $this->Part->find( 'first', $opts );
			if( count( $tPart['Child'] ) > 0 ){ $part['sons'] = true; }
			$this->set('part', $part);
			$this->render('admin_quick_edit_wqty_saved'); 
		}
		else
		{
			if (!empty($this->data)) 
			{
				$new_part = $this->data;
				if( $new_part['Part']['id'] != null ) { $planol_id_exists = $this->Part->findById( $new_part['Part']['id'] ); }
				else{ $planol_id_exists = null;}
				
				$opts["contain"] = array('Child');
				$opts["conditions"] = array('Part.id'=>$new_part['Parent']['id'] );
				$opts["fields"] = array('Part.id');
				$tParent = $this->Part->find( 'all', $opts );
				
				$repeated = false;
				$parts = array();
				foreach( $tParent[0]['Child'] as $Part )
				{
					$part['id'] = $Part['id'];
					$part['PartsPart']['parent_id'] = $Part['PartsPart']['parent_id'];
					$part['PartsPart']['child_id'] = $Part['PartsPart']['child_id'];
					$part['PartsPart']['cantidad'] = $Part['PartsPart']['cantidad'];
					
					if( $Part['id'] == $new_part['Part']['id'] )
					{ 
						$part['PartsPart']['cantidad'] = $new_part['Part']['quantitat'];
						$repeated = true; 
					}
					array_push( $parts, $part );
				}
				if( $repeated )
				{
					$parent['Part']['id'] = $new_part['Parent']['id'];
					$parent['Child'] = $parts;
					
					if ($this->Part->saveAll($parent)) 
					{
						$edit_part['Part']['id'] = $new_part['Part']['id'];
						$edit_part['Part']['clave_pieza'] = $new_part['Part']['clave_pieza'];
						$edit_part['Part']['clave_unidad'] = $new_part['Part']['clave_unidad'];
						$edit_part['Part']['denominacion'] = $new_part['Part']['denominacion'];
						
						if ($this->Part->save($edit_part)) {
							$view_part = $edit_part['Part'];
							$opts["contain"] = array('Child');
							$opts["conditions"] = array('Part.id'=>$new_part['Part']['id'] );
							$opts["fields"] = array('Part.id');
							$tPart = $this->Part->find( 'first', $opts );
							if( count( $tPart['Child'] ) > 0 ){ $view_part['sons'] = true; }		
							$view_part['parent_id'] = $new_part['Parent']['id'];
							$view_part['PartsPart']['cantidad'] = $new_part['Part']['quantitat'];
							$this->set('part', $view_part);
							$this->set('color_class', $new_part['RowInfo']['style']);
							$this->set('parent_id', $new_part['Parent']['id']);
							$this->set('level', $new_part['RowInfo']['level']);
							$this->set('trace', $new_part['RowInfo']['trace']);
							$this->render('admin_quick_edit_wqty_saved');
						} else {
							$this->set('error_msg', "Hi ha hagut un error al guardar part del Component, si us plau intenta-ho de nou.");
							$this->render('admin_quick_edit_part_error');
						}
					}
					else
					{
						$this->set('error_msg', "Hi ha hagut un error al guardar, si us plau intenta-ho de nou.");
						$this->render('admin_quick_edit_part_error');
					}
				}
				else
				{
					$this->set('error_msg', "El Component introduit no esta vinculat a aquest motor");
					$this->render('admin_quick_edit_part_error');
				}
			}
			else
			{ 
				$opts["contain"] = array('Child');
				$opts["conditions"] = array('Part.id'=>$iParentID );
				$opts["fields"] = array('Part.id');
				$tPart = $this->Part->find( 'all', $opts );
				
				$repeated = false;
				$part = array();
				foreach( $tPart[0]['Child'] as $Part )
				{
					if( $Part['id'] == $iPartID )
					{
						$part['parent_id'] = $iParentID;
						$part['id'] = $Part['id'];
						$part['clave_pieza'] = $Part['clave_pieza'];
						$part['clave_unidad'] = $Part['clave_unidad'];
						$part['denominacion'] = $Part['denominacion'];
						$part['PartsPart']['parent_id'] = $Part['PartsPart']['parent_id'];
						$part['PartsPart']['child_id'] = $Part['PartsPart']['child_id'];
						$part['PartsPart']['cantidad'] = $Part['PartsPart']['cantidad'];
					}
				}
				$this->set('part', $part);
				$this->set('color_class', $iStyle);
				$this->set('level', $iLevel);
				$this->set('trace', $iTrace);
			}
		}
	}
}
?>