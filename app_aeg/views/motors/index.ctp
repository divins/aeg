<?php
echo $html->script('CSSPopUp');
echo $html->script('prototype');
//echo $html->script('scriptaculous');
?>
<div id="buscador" class="grid_16">
<h2><?php __('Searcher');?></h2>
	<?php
	echo $form->create('Motor', array('action' => 'index'), true);
	$options = array(">"=>__('Superior', true), ">="=>__('Superior_or_Equal', true), "="=>__('Equal', true), "<="=>__('Lower_or_Equal', true), "<"=>__('Lower', true), "-"=>__('Range', true));
    ?>
	<div class="grid_6 alpha">
		<div class="search_fields_advanced">
			<div class="search_labels">
			<?php
			echo __("Power",true);
			?>
			</div>
			<?php
			$style['class'] = 'search_field_comparition';
			$style['div'] = false;
			$style['label'] = false;
			$style['options'] = $options;
			echo $form->input('potencia_tipus', $style);
			unset( $style );
			$style['type'] = 'text';
			$style['class'] = 'search_field_value';
			$style['div'] = false;
			$style['label'] = false;
			echo $form->input('potencia' ,$style);
			?>
		</div> 
		<div class="search_fields_advanced"> 
			<div class="search_labels">
			<?PHP
			echo __("Voltage",true);
			?>
			</div>
			<?php
			unset( $style );
			$style['class'] = 'search_field_comparition';
			$style['div'] = false;
			$style['label'] = false;
			$style['options'] = $options;
			echo $form->input('tension_tipus', $style);
			unset( $style );
			$style['type'] = 'text';
			$style['class'] = 'search_field_value';
			$style['div'] = false;
			$style['label'] = false;
			echo $form->input('tension', $style);
			?>
		</div> 
		<div class="search_fields_advanced"> 
			<div class="search_labels">
			<?PHP
			echo __("Height",true);
			?>
			</div>
			<?php
			unset( $style );
			$style['class'] = 'search_field_comparition';
			$style['div'] = false;
			$style['label'] = false;
			$style['options'] = $options;
			echo $form->input('altura_tipus', $style);
			unset( $style );
			$style['type'] = 'text';
			$style['class'] = 'search_field_value';
			$style['div'] = false;
			$style['label'] = false;
			echo $form->input('altura', $style);	
			?>
		</div>
	</div> 
	<div class="grid_4"> 
		<div class="search_fields_basic"> 
			<div class="search_labels">
				<?PHP
				echo __("Shape",true);
				?>
			</div>
			<?php
			$style['type'] = 'text';
			$style['class'] = 'search_field_value';
			$style['div'] = false;
			$style['label'] = false;
			echo $form->input('forma', $style);
			?>
		</div>
		<div class="search_fields_basic"> 
			<div class="search_labels">
				<?PHP
				echo __("Serie",true);
				?>
			</div>
			<?php
			echo $form->input('Serie.codigo', $style );
			?>
		</div>
		<div class="search_fields_basic"> 
			<div class="search_labels">
				<?PHP
				echo __("Denomination",true);
				?>
			</div>
			<?php
			echo $form->input('denominacion', $style );
			?>
		</div>
	</div>
	<div class="grid_4 omega"> 
		<div class="search_fields_basic"> 
			<div class="search_labels">
				<?PHP
				echo __("ID_Motor",true);
				?>
			</div>
			<?php
			echo $form->input('id', $style);
			?>
		</div>
		<div class="search_fields_basic"> 
			<div class="search_labels">
				<?PHP
				echo __("Piece_Code",true);
				?>
			</div>
			<?php
			echo $form->input('clave_pieza', $style );
			?>
		</div>
		<div class="search_fields_basic"> 
			<div class="search_labels">
				<?PHP
				echo __("Unit_Code",true);
				?>
			</div>
			<?php
			echo $form->input('clave_unidad', $style );
			?>
		</div>
	</div>
	<div class="grid_2 alpha">
		<div class="submit">
			<?php
			$button_options = array
			(
				'name' => 'Buscar',
				'label' => __('Search', true),
			);
			echo $form->end($button_options);
			?>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php
	if( isset($unparsed_order) ){ $this->Paginator->options(array('url' => 'unparsed_order:'.$unparsed_order )); }
	else{ $this->Paginator->options(array('url' => $conditions )); }
?>
<!--<div class="motors index">-->
<div id="search_result" class="grid_16">
	<h2>
<?php 
		$url['controller']='Motors';
		$url['action']='export_motors_search';
		if( isset($unparsed_order) ){ $url['unparsed_order'] = $unparsed_order; }
		$url = array_merge( (array)$url, (array)$conditions );
		
		__('Search_Result');
		echo "&nbsp;&nbsp;&nbsp;";
		echo $this->Html->link( $this->Html->image( "icons/excel_25.png", array( "alt" => __("Export_to_Excel",true), "title" => __("Export_to_Excel",true))), $url, array( 'escape'=>false));
?>	
	</h2>
	<div class="grid_9 alpha paging_count">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Pagination_info_for_motor_searching', true)
	));
	?>
	</div>
	<div class="grid_7 omega paging_nav">
		<?php 
		$url['action']='index';
		$this->Paginator->options(array('url' => $url ));
		
		$page = 1;
		if( isset($this->passedArgs['page']) ){ $page = $this->passedArgs['page']; }
	
		if( $page >=2 )
		{ 
			$url['page'] = $page-1; 
			echo $html->link(__("Previous", true), $url );
		}
		else{ echo __("Previous", true); }
		?>
		| <?php echo $this->Paginator->numbers();?> 
		| 
		<?php 
		if( $page < $this->Paginator->params['paging']['Motor']['pageCount'] )
		{ 
			$url['page'] = $page+1; 
			echo $html->link(__("Next", true), $url );
		}
			
		if( isset($this->passedArgs['page']) ){ $url['page'] = $this->passedArgs['page']; }
		?>
	</div>	
	<table>
	<tr>
		<?php 
		$page = "";
		if( isset($this->passedArgs['page']) ){ $page = "page:".$this->passedArgs['page']; }

		if( isset($unparsed_order) )
		{
		?>
			<?php
			if( strpos( $unparsed_order, "Motor.id__asc") !== false ){ $url['unparsed_order'] = str_replace("Motor.id__asc", "Motor.id__desc", $unparsed_order); $class = 'asc'; }
			else if( strpos( $unparsed_order, "Motor.id__desc") !== false ){$url['unparsed_order'] = str_replace("Motor.id__desc", "Motor.id__asc", $unparsed_order); $class = 'desc'; }
			else{ $url['unparsed_order'] = $unparsed_order.";Motor.id__asc"; $class = 'asc'; }
			?>
			<!--<th><?php //echo $html->link(__("ID", true), array('controller'=>'Motors','action'=>'index', $unparsed_order_final, $page  ), array('class' => $class) ); ?></th>-->
			<th class="motorid_col"><?php echo $html->link(__("ID", true), $url, array('class' => $class) ); ?></th>
			
			<?php
			if( strpos( $unparsed_order, "Motor.clave_pieza__asc") !== false ){ $url['unparsed_order'] = str_replace("Motor.clave_pieza__asc", "Motor.clave_pieza__desc", $unparsed_order); $class = 'asc'; }
			else if( strpos( $unparsed_order, "Motor.clave_pieza__desc") !== false ){ $url['unparsed_order'] = str_replace("Motor.clave_pieza__desc", "Motor.clave_pieza__asc", $unparsed_order); $class = 'desc'; }
			else{ $url['unparsed_order'] = $unparsed_order.";Motor.clave_pieza__asc"; $class = 'asc'; }
			?>
			<th class="piecec_col"><?php echo $html->link(__("Piece_Code", true), $url, array('class' => $class) ); ?></th>
			
			<?php
			if( strpos( $unparsed_order, "Motor.clave_unidad__asc") !== false ){ $url['unparsed_order'] = str_replace("Motor.clave_unidad__asc", "Motor.clave_unidad__desc", $unparsed_order); $class = 'asc'; }
			else if( strpos( $unparsed_order, "Motor.clave_unidad__desc") !== false ){ $url['unparsed_order'] = str_replace("Motor.clave_unidad__desc", "Motor.clave_unidad__asc", $unparsed_order); $class = 'desc'; }
			else{ $url['unparsed_order'] = $unparsed_order.";Motor.clave_unidad__asc"; $class = 'asc'; }
			?>
			<th class="unityc_col"><?php echo $html->link(__("Unit_Code", true), $url, array('class' => $class) ); ?></th>
			
			<?php
			if( strpos( $unparsed_order, "Motor.denominacion__asc") !== false ){ $url['unparsed_order'] = str_replace("Motor.denominacion__asc", "Motor.denominacion__desc", $unparsed_order); $class = 'asc'; }
			else if( strpos( $unparsed_order, "Motor.denominacion__desc") !== false ){ $url['unparsed_order'] = str_replace("Motor.denominacion__desc", "Motor.denominacion__asc", $unparsed_order); $class = 'desc'; }
			else{ $url['unparsed_order'] = $unparsed_order.";Motor.denominacion__asc"; $class = 'asc'; }
			?>
			<th class="denomination_col"><?php echo $html->link(__("Denomination", true), $url, array('class' => $class) ); ?></th>
			
			<?php
			if( strpos( $unparsed_order, "Motor.serie_id__asc") !== false ){ $url['unparsed_order'] = str_replace("Motor.serie_id__asc", "Motor.serie_id__desc", $unparsed_order); $class = 'asc'; }
			else if( strpos( $unparsed_order, "Motor.serie_id__desc") !== false ){ $url['unparsed_order'] = str_replace("Motor.serie_id__desc", "Motor.serie_id__asc", $unparsed_order); $class = 'desc'; }
			else{ $url['unparsed_order'] = $unparsed_order.";Motor.serie_id__asc"; $class = 'asc'; }
			?>
			<th class="serie_col"><?php echo $html->link(__("Serie", true), $url, array('class' => $class) ); ?></th>
			
			<?php
			if( strpos( $unparsed_order, "altura__asc") !== false ){ $url['unparsed_order'] = str_replace("altura__asc", "altura__desc", $unparsed_order); $class = 'asc'; }
			else if( strpos( $unparsed_order, "altura__desc") !== false ){ $url['unparsed_order'] = str_replace("altura__desc", "altura__asc", $unparsed_order); $class = 'desc'; }
			else{ $url['unparsed_order'] = $unparsed_order.";altura__asc"; $class = 'asc'; }
			?>		
			<th class="height_col"><?php echo $html->link(__("Height", true), $url, array('class' => $class) ); ?></th>
			
			<?php
			if( strpos( $unparsed_order, "Motor.potencia__asc") !== false ){ $url['unparsed_order'] = str_replace("Motor.potencia__asc", "Motor.potencia__desc", $unparsed_order); $class = 'asc'; }
			else if( strpos( $unparsed_order, "Motor.potencia__desc") !== false ){ $url['unparsed_order'] = str_replace("Motor.potencia__desc", "Motor.potencia__asc", $unparsed_order); $class = 'desc'; }
			else{ $url['unparsed_order'] = $unparsed_order.";Motor.potencia__asc"; $class = 'asc'; }
			?>
			<th class="power_col"><?php echo $html->link(__("Power", true), $url, array('class' => $class) ); ?></th>
			
			<?php
			if( strpos( $unparsed_order, "Motor.tension__asc") !== false ){ $url['unparsed_order'] = str_replace("Motor.tension__asc", "Motor.tension__desc", $unparsed_order); $class = 'asc'; }
			else if( strpos( $unparsed_order, "Motor.tension__desc") !== false ){ $url['unparsed_order'] = str_replace("Motor.tension__desc", "Motor.tension__asc", $unparsed_order); $class = 'desc'; }
			else{ $url['unparsed_order'] = $unparsed_order.";Motor.tension__asc"; $class = 'asc'; }
			?>
			<th class="voltage_col"><?php echo $html->link(__("Voltage", true), $url, array('class' => $class) ); ?></th>
			
			<?php
			if( strpos( $unparsed_order, "Motor.forma__asc") !== false ){ $url['unparsed_order'] = str_replace("Motor.forma__asc", "Motor.forma__desc", $unparsed_order); $class = 'asc'; }
			else if( strpos( $unparsed_order, "Motor.forma__desc") !== false ){ $url['unparsed_order'] = str_replace("Motor.forma__desc", "Motor.forma__asc", $unparsed_order); $class = 'desc'; }
			else{ $url['unparsed_order'] = $unparsed_order.";Motor.forma__asc"; $class = 'asc'; }
			?>
			<th class="shape_col"><?php echo $html->link(__("Shape", true), $url, array('class' => $class) ); ?></th>
			
			<th class="plan_col"><?php echo __( "Plan", true ); ?></th>
		<?php
		}
		else
		{
			$url['controller']='Motors';
			$url['action']='index';
			if( isset($this->passedArgs['page']) ){ $url['page'] = $this->passedArgs['page']; }
			$url = array_merge( (array)$url, (array)$conditions );
		?>
			<th class="motorid_col">
				<?php 
				$url['unparsed_order']='Motor.id__asc';
				echo $html->link(__("ID", true), $url ); 
				?>
			</th>
			<th class="piecec_col">
				<?php 
				$url['unparsed_order']='Motor.clave_pieza__asc';
				echo $html->link(__("Piece_Code", true), $url ); 
				?>
			</th>
			<th class="unityc_col">
				<?php 
				$url['unparsed_order']='Motor.clave_unidad__asc';
				echo $html->link(__("Unit_Code", true), $url ); 
				?>
			</th>
			<th class="denomination_col">
				<?php 
				$url['unparsed_order']='Motor.denominacion__asc';
				echo $html->link(__("Denomination", true), $url ); 
				?>
			</th>
			<th class="serie_col">
				<?php 
				$url['unparsed_order']='Motor.serie_id__asc';
				echo $html->link(__("Serie", true), $url ); 
				?>
			</th>
			<th class="height_col">
				<?php 
				$url['unparsed_order']='Motor.altura__asc';
				echo $html->link(__("Height", true), $url ); 
				?>
			</th>
			<th class="power_col">
				<?php 
				$url['unparsed_order']='Motor.potencia__asc';
				echo $html->link(__("Power", true), $url ); 
				?>
			</th>
			<th class="voltage_col">
				<?php 
				$url['unparsed_order']='Motor.tension__asc';
				echo $html->link(__("Voltage", true), $url ); 
				?>
			</th>
			<th class="shape_col">
				<?php 
				$url['unparsed_order']='Motor.forma__asc';
				echo $html->link(__("Shape", true), $url ); 
				?>
			</th>
			<th class="plan_col"><?php echo __( "Plan", true ); ?></th>
		<?php
		}
		?>
	</tr>
	<?php
	$x = 0;
	foreach ($motors as $motor):
	?>
	<tr id="<?php echo $motor['Motor']['id']; ?>">
		<td class="motorid_col"><?php echo $this->Html->link( $motor['Motor']['id'], array('controller'=>'motors', 'action'=>'view', $motor['Motor']['id']), array('target'=>'_blank') );?>&nbsp;</td>
		<td class="piecec_col"><?php echo $motor['Motor']['clave_pieza']; ?>&nbsp;</td>
		<td class="unityc_col"><?php echo $motor['Motor']['clave_unidad']; ?>&nbsp;</td>
		<td class="denomination_col"><?php echo $motor['Motor']['denominacion']; ?>&nbsp;</td>
		<td class="serie_col"><?php echo $motor['Serie']['codigo']; ?></td>
		<td class="height_col"><?php echo $motor['Motor']['altura']; ?>&nbsp;</td>
		<td class="power_col"><?php echo $motor['Motor']['potencia']; ?>&nbsp;</td>
		<td class="voltage_col"><?php echo $motor['Motor']['tension']; ?>&nbsp;</td>
		<td class="shape_col"><?php echo $motor['Motor']['forma']; ?>&nbsp;</td>
		<td class="plan_col"><?php echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'motors', 'action' => 'mostrar_planols', $motor['Motor']['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );?></td>
	</tr>
<?php endforeach; ?>
	</table>
</div>