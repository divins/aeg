<?php
class MotorsController extends AppController {

	var $name = 'Motors';
	var $helpers = array('Html','Ajax','Javascript');
	var $components = array( 'RequestHandler' );
	
	function index( $data = null) 
	{
		if($this->data)
		{	
			$paginate_opts["contain"] = array( "Serie", "Planol" );
			$paginate_opts["conditions"] = array();
			$paginate_opts["order"] = array();
			
			$this->paginate = array( 'contain' => array('Serie', 'Planol') );
			$conditions=$this->postConditions($this->data);
			
			if(trim($conditions["Motor.potencia"]) != "" )
			{
				if( $conditions["Motor.potencia_tipus"] != "-" )
				{
					$conditions["Motor.potencia ".$conditions["Motor.potencia_tipus"]] = $conditions["Motor.potencia"];
				}
				else
				{
					$rang_potencies = explode( " ", $conditions["Motor.potencia"]);
					if( isset($rang_potencies[0]) AND isset($rang_potencies[1]) )
					{
						$conditions["Motor.potencia >="] = $rang_potencies[0];
						$conditions["Motor.potencia <="] = $rang_potencies[1];
					}
					else{ $this->Session->setFlash( __( "El rang de potencia no es valid", true) ); }
				}
				array_push( $paginate_opts["order"], 'Motor.potencia');
			}
			unset($conditions["Motor.potencia_tipus"]);
			unset($conditions["Motor.potencia"]);
			
			if(trim($conditions["Motor.tension"]) != "" )
			{
				if( $conditions["Motor.tension_tipus"] != "-" )
				{
					$conditions["Motor.tension ".$conditions["Motor.tension_tipus"]] = $conditions["Motor.tension"];
				}
				else
				{
					$rang_tensions = explode( " ", $conditions["Motor.tension"]);
					if( isset($rang_tensions[0]) AND isset($rang_tensions[1]) )
					{
						$conditions["Motor.tension >="] = $rang_tensions[0];
						$conditions["Motor.tension <="] = $rang_tensions[1];
					}
					else{ $this->Session->setFlash( __( "El rang de tension no es valid", true) ); }
				}
				array_push( $paginate_opts["order"], 'Motor.tension');
			}
			unset($conditions["Motor.tension_tipus"]);
			unset($conditions["Motor.tension"]);

			if(trim($conditions["Motor.altura"]) != "" )
			{
				if( $conditions["Motor.altura_tipus"] != "-" )
				{
					$conditions["Motor.altura ".$conditions["Motor.altura_tipus"]] = $conditions["Motor.altura"];
				}
				else
				{
					$rang_altura = explode( " ", $conditions["Motor.altura"]);
					if( isset($rang_altura[0]) AND isset($rang_altura[1]) )
					{
						$conditions["Motor.altura >="] = $rang_altura[0];
						$conditions["Motor.altura <="] = $rang_altura[1];
					}
					else{ $this->Session->setFlash( __( "El rang d'altura no es valid", true) ); }
				}
				array_push( $paginate_opts["order"], 'Motor.altura');
			}
			unset($conditions["Motor.altura_tipus"]);
			unset($conditions["Motor.altura"]);
			
			if(trim($conditions["Motor.forma"]) == "" ){ unset($conditions["Motor.forma"]); }
			if(trim($conditions["Motor.id"]) == "" ){ unset($conditions["Motor.id"]); }
			if(trim($conditions["Serie.codigo"]) == "" ){ unset($conditions["Serie.codigo"]); }
			/*if(trim($conditions["Planol.codigo"]) == "" ){ unset($conditions["Planol.codigo"]); }
			else
			{ 
				$paginate_opts["contain"] = array( "Serie", "Planol.codigo = '".$conditions["Planol.codigo"]."'"); 
				unset($conditions["Planol.codigo"]); 
			}*/
			if(trim($conditions["Motor.clave_pieza"]) == "" ){ unset($conditions["Motor.clave_pieza"]); }
			if(trim($conditions["Motor.clave_unidad"]) == "" ){ unset($conditions["Motor.clave_unidad"]); }
			
			if(trim($conditions["Motor.denominacion"]) == "" ){ unset($conditions["Motor.denominacion"]); }
			else
			{ 
				$conditions["Motor.denominacion LIKE"] = "%".$conditions["Motor.denominacion"]."%"; 
				//$conditions["Motor.denominacion"] = "LIKE %".$conditions["Motor.denominacion"]."%"; 
				unset($conditions["Motor.denominacion"]); 
			}		
			$paginate_opts["conditions"] = $conditions;
			//$paginate_opts["limit"] = 55000;
			$this->paginate = $paginate_opts;
			$this->set('motors', $this->paginate());
			//$sort_conditions = array_merge( (array)$conditions, (array)$paginate_opts["order"] );
			//$this->set('conditions', $sort_conditions);
			if( isset( $conditions["Motor.denominacion LIKE"] ) ){ $conditions["Motor.denominacion LIKE"] = substr( $conditions["Motor.denominacion LIKE"], 1, (strlen($conditions["Motor.denominacion LIKE"])-2) ); }
			$this->set('conditions', $conditions);
		}
		else if( $this->passedArgs )
		{		
			$conditions = $this->passedArgs;
			//DEBUG( $conditions );
			unset($conditions["page"]);
			unset($conditions["sort"]);
			unset($conditions["direction"]);
			unset( $this->passedArgs['sort'] );
			unset( $this->passedArgs['direction'] );
			
			$paginate_opts["contain"] = array( "Serie", "Planol" );	
			
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
			if( isset( $conditions["Motor.denominacion LIKE"] ) ){ $conditions["Motor.denominacion LIKE"] = '%'.$conditions["Motor.denominacion LIKE"].'%'; }
			//http://marc.divinscastellvi.name/aeg_v2/motors/index/Motor.potencia/page:4/Motor.potencia%20%3E:78/sort:altura/direction:asc
			$paginate_opts["conditions"] = $conditions;
			//DEBUG( $conditions );
			$this->paginate = $paginate_opts;
			$this->set('motors', $this->paginate());
			//$sort_conditions = array_merge( (array)$conditions, (array)$paginate_opts["order"] );
			//$this->set('conditions', $sort_conditions);

			if( isset( $conditions["Motor.denominacion LIKE"] ) ){ $conditions["Motor.denominacion LIKE"] = substr( $conditions["Motor.denominacion LIKE"], 1, (strlen($conditions["Motor.denominacion LIKE"])-2) ); }
			$this->set('conditions', $conditions);
		}	
		else
		{
			$this->paginate = array( 'contain' => array('Serie', 'Planol') );
			$this->set('motors', $this->paginate()); 
			$this->set('conditions', "");
		}
	}

	function export_motors_search()
	{
		if( $this->passedArgs )
		{
			$conditions = $this->passedArgs;
		
			unset($conditions["page"]);
			unset($conditions["sort"]);
			unset($conditions["direction"]);
			unset( $this->passedArgs['sort'] );
			unset( $this->passedArgs['direction'] );
			
			$paginate_opts["contain"] = array('Serie'=>array( 'fields'=>array('id','codigo') ) );	
			
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
			$paginate_opts["conditions"] = $conditions;
			
			$this->layout = 'export_xls';
			$this->set( "motors", $this->Motor->find('all', $paginate_opts ) );
			$this->set( "report_name", "export" );
		}
		else
		{
			$this->layout = 'export_xls';
			$paginate_opts["contain"] = array('Serie'=>array( 'fields'=>array('id','codigo') ) );
			$this->set( "motors", $this->Motor->find('all', $paginate_opts ) );
			$this->set( "report_name", "export" );
		}
	}
	
	function export_motor( $iID = null )
	{
		if (!$iID) {
			$this->Session->setFlash(__('Invalid motor', true));
			$this->redirect(array('action' => 'index'));
		}
		$motor = $this->Motor->read(null, $iID);
		DEBUG( $motor );
		foreach( $motor['Part'] as $child )
		{
			$this->requestAction( '/parts/get_all_childs/'.$child['id'] );
		}
		//$this->set('motor', $motor);
	}
	
	function admin_index( $data = null) 
	{
		if($this->data)
		{	
			$paginate_opts["contain"] = array( "Serie", "Planol" );
			$paginate_opts["conditions"] = array();
			$paginate_opts["order"] = array();
			
			$this->paginate = array( 'contain' => array('Serie', 'Planol') );
			$conditions=$this->postConditions($this->data);
			
			if(trim($conditions["Motor.potencia"]) != "" )
			{
				if( $conditions["Motor.potencia_tipus"] != "-" )
				{
					$conditions["Motor.potencia ".$conditions["Motor.potencia_tipus"]] = $conditions["Motor.potencia"];
				}
				else
				{
					$rang_potencies = explode( " ", $conditions["Motor.potencia"]);
					if( isset($rang_potencies[0]) AND isset($rang_potencies[1]) )
					{
						$conditions["Motor.potencia >="] = $rang_potencies[0];
						$conditions["Motor.potencia <="] = $rang_potencies[1];
					}
					else{ $this->Session->setFlash( __( "El rang de potencia no es valid", true) ); }
				}
				array_push( $paginate_opts["order"], 'Motor.potencia');
			}
			unset($conditions["Motor.potencia_tipus"]);
			unset($conditions["Motor.potencia"]);
			
			if(trim($conditions["Motor.tension"]) != "" )
			{
				if( $conditions["Motor.tension_tipus"] != "-" )
				{
					$conditions["Motor.tension ".$conditions["Motor.tension_tipus"]] = $conditions["Motor.tension"];
				}
				else
				{
					$rang_tensions = explode( " ", $conditions["Motor.tension"]);
					if( isset($rang_tensions[0]) AND isset($rang_tensions[1]) )
					{
						$conditions["Motor.tension >="] = $rang_tensions[0];
						$conditions["Motor.tension <="] = $rang_tensions[1];
					}
					else{ $this->Session->setFlash( __( "El rang de tension no es valid", true) ); }
				}
				array_push( $paginate_opts["order"], 'Motor.tension');
			}
			unset($conditions["Motor.tension_tipus"]);
			unset($conditions["Motor.tension"]);

			if(trim($conditions["Motor.altura"]) != "" )
			{
				if( $conditions["Motor.altura_tipus"] != "-" )
				{
					$conditions["Motor.altura ".$conditions["Motor.altura_tipus"]] = $conditions["Motor.altura"];
				}
				else
				{
					$rang_altura = explode( " ", $conditions["Motor.altura"]);
					if( isset($rang_altura[0]) AND isset($rang_altura[1]) )
					{
						$conditions["Motor.altura >="] = $rang_altura[0];
						$conditions["Motor.altura <="] = $rang_altura[1];
					}
					else{ $this->Session->setFlash( __( "El rang d'altura no es valid", true) ); }
				}
				array_push( $paginate_opts["order"], 'Motor.altura');
			}
			unset($conditions["Motor.altura_tipus"]);
			unset($conditions["Motor.altura"]);
			
			if(trim($conditions["Motor.forma"]) == "" ){ unset($conditions["Motor.forma"]); }
			if(trim($conditions["Motor.id"]) == "" ){ unset($conditions["Motor.id"]); }
			if(trim($conditions["Serie.codigo"]) == "" ){ unset($conditions["Serie.codigo"]); }
			/*if(trim($conditions["Planol.codigo"]) == "" ){ unset($conditions["Planol.codigo"]); }
			else
			{ 
				$paginate_opts["contain"] = array( "Serie", "Planol.codigo = '".$conditions["Planol.codigo"]."'"); 
				unset($conditions["Planol.codigo"]); 
			}*/
			if(trim($conditions["Motor.clave_pieza"]) == "" ){ unset($conditions["Motor.clave_pieza"]); }
			if(trim($conditions["Motor.clave_unidad"]) == "" ){ unset($conditions["Motor.clave_unidad"]); }
			
			if(trim($conditions["Motor.denominacion"]) == "" ){ unset($conditions["Motor.denominacion"]); }
			else
			{ 
				$conditions["Motor.denominacion LIKE"] = "%".$conditions["Motor.denominacion"]."%"; 
				unset($conditions["Motor.denominacion"]); 
			}		
			$paginate_opts["conditions"] = $conditions;
			//$paginate_opts["limit"] = 55000;
			$this->paginate = $paginate_opts;
			$this->set('motors', $this->paginate());
			//$sort_conditions = array_merge( (array)$conditions, (array)$paginate_opts["order"] );
			//$this->set('conditions', $sort_conditions);
			if( isset( $conditions["Motor.denominacion LIKE"] ) ){ $conditions["Motor.denominacion LIKE"] = substr( $conditions["Motor.denominacion LIKE"], 1, (strlen($conditions["Motor.denominacion LIKE"])-2) ); }
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
			
			$paginate_opts["contain"] = array( "Serie", "Planol" );	
			
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
			if( isset( $conditions["Motor.denominacion LIKE"] ) ){ $conditions["Motor.denominacion LIKE"] = '%'.$conditions["Motor.denominacion LIKE"].'%'; }
			$paginate_opts["conditions"] = $conditions;
			//DEBUG( $conditions );
			$this->paginate = $paginate_opts;
			$this->set('motors', $this->paginate());
			//$sort_conditions = array_merge( (array)$conditions, (array)$paginate_opts["order"] );
			//$this->set('conditions', $sort_conditions);
			if( isset( $conditions["Motor.denominacion LIKE"] ) ){ $conditions["Motor.denominacion LIKE"] = substr( $conditions["Motor.denominacion LIKE"], 1, (strlen($conditions["Motor.denominacion LIKE"])-2) ); }
			$this->set('conditions', $conditions);
		}	
		else
		{
			$this->paginate = array( 'contain' => array('Serie', 'Planol') );
			$this->set('motors', $this->paginate()); 
			$this->set('conditions', "");
		}
	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid motor', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('motor', $this->Motor->read(null, $id));
	}
	
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid motor', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('motor', $this->Motor->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {			
			$this->Motor->create();
			if ($this->Motor->save($this->data)) {
				$this->Session->setFlash(__('The motor has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The motor could not be saved. Please, try again.', true));
			}
		}
		//$series = $this->Motor->Serie->find('list');
		//$parts = $this->Motor->Part->find('list');
		//$planols = $this->Motor->Planol->find('list');
		//$this->set(compact('series', 'parts', 'planols'));
	}
	
	function admin_edit($id = null, $iCancel = false) {
		if( $iCancel )
		{ 
			$this->set('standard_edit', true);
			$this->data = $this->Motor->read(null, $id);
			$this->render('admin_quick_edit'); 
		}
		else
		{
			$this->set('title_for_layout', 'Editar Motor - '.$id);
			$this->set('standard_edit', true);
			if (!$id && empty($this->data)) {
				$this->Session->setFlash(__('Invalid motor', true));
			}
			if (!empty($this->data)) {
				$CodigoSerie = $this->data['Serie']['codigo'];
				unset( $this->data['Serie'] );
				$series = $this->Motor->Serie->findByCodigo( $CodigoSerie );
				$this->data['Motor']['serie_id']=$series['Serie']['id'];
				if( trim($CodigoSerie) != "" && trim($this->data['Motor']['serie_id']) == "" )
				{
					$this->set('error_msg', "La serie introduida no existeix.");
					$this->render('admin_quick_edit_error');
				}
				else
				{
					if ($this->Motor->save($this->data)) {
						$this->data['Serie']['codigo'] = $CodigoSerie;
						//$this->Session->setFlash(__('The motor has been saved', true));
						$this->render('admin_quick_edit');
					} else {
						$this->set('error_msg', "Hi ha hagut un error al guardar, si us plau intenta-ho de nou.");
						$this->render('admin_quick_edit_error');
					}
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Motor->read(null, $id);
			}
		}
	}
	
	function admin_add_planol()
	{
		if (!empty($this->data)) 
		{
			$new_planol = $this->data;
			//DEBUG( $new_planol );
			if( $new_planol['Planol']['id'] != null ) { $planol_id_exists = $this->Motor->Planol->findById( $new_planol['Planol']['id'] ); }
			else{ $planol_id_exists = null;}
			/*if( $new_planol['Planol']['codigo'] != null ) { $planol_code_exists = $this->Phone->findByCodigo( $new_planol['Planol']['codigo'] ); }
			else{ $planol_code_exists = null;}*/
			
			$opts["contain"] = array('Planol'=>array( 'fields'=>array('id') ) );
			$opts["conditions"] = array('Motor.id'=>$new_planol['Motor']['id'] );
			$opts["fields"] = array('Motor.id');
			$tMotor = $this->Motor->find( 'all', $opts );
			//DEBUG( $tMotor );
			
			$repeated = false;
			$planols = array();
			foreach( $tMotor[0]['Planol'] as $planol )
			{
				array_push( $planols, $planol['id'] );
				if( $planol['id'] == $new_planol['Planol']['id'] ){ $repeated = true; }
			}
			if( !$repeated )
			{
				$motor['Motor']['id'] = $tMotor[0]['Motor']['id'];
				$motor['Planol'] = $planols;
				
				//array_push( $motor[0]['Planol'], array('id'=>$new_planol['Planol']['id']) );
				array_push( $motor['Planol'], $new_planol['Planol']['id'] );
				
				//DEBUG( $motor );
				if ($this->Motor->saveAll($motor)) 
				{
					$this->data = $this->Motor->read(null, $new_planol['Motor']['id']);
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
	
	function admin_del_planol( $iMotorID, $iPlanolID )
	{
		$opts["contain"] = array('Planol'=>array( 'fields'=>array('id') ) );
		$opts["conditions"] = array('Motor.id'=>$iMotorID );
		$opts["fields"] = array('Motor.id');
		$tMotor = $this->Motor->find( 'all', $opts );
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
				$motor['Motor']['id'] = $tMotor[0]['Motor']['id'];
				$motor['Planol'] = $planols;
				if ($this->Motor->saveAll($motor)) 
				{
					$this->data = $this->Motor->read(null, $motor['Motor']['id']);
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
	
	function admin_add_part()
	{
		if (!empty($this->data)) 
		{
			$new_part = $this->data;
			//DEBUG( $new_part );
			if( $new_part['Part']['id'] != null ) { $planol_id_exists = $this->Motor->Part->findById( $new_part['Part']['id'] ); }
			else{ $planol_id_exists = null;}
			/*if( $new_planol['Planol']['codigo'] != null ) { $planol_code_exists = $this->Phone->findByCodigo( $new_planol['Planol']['codigo'] ); }
			else{ $planol_code_exists = null;}*/
			
			$opts["contain"] = array('Part'=>array( 'fields'=>array('id') ) );
			$opts["conditions"] = array('Motor.id'=>$new_part['Motor']['id'] );
			$opts["fields"] = array('Motor.id');
			$tMotor = $this->Motor->find( 'all', $opts );
			//DEBUG( $tMotor );
			
			$repeated = false;
			$parts = array();
			foreach( $tMotor[0]['Part'] as $Part )
			{
				$part['id'] = $Part['id'];
				$part['MotorsPart']['motor_id'] = $Part['MotorsPart']['motor_id'];
				$part['MotorsPart']['part_id'] = $Part['MotorsPart']['part_id'];
				$part['MotorsPart']['cantidad'] = $Part['MotorsPart']['cantidad'];
				
				//array_push( $parts, $Part['id'] );
				array_push( $parts, $part );
				if( $Part['id'] == $new_part['Part']['id'] ){ $repeated = true; }
			}
			//DEBUG( $parts );
			if( !$repeated )
			{
				$motor['Motor']['id'] = $new_part['Motor']['id'];
				$motor['Part'] = $parts;
				
				$part['id'] = $new_part['Part']['id'];
				$part['MotorsPart']['motor_id'] = $new_part['Motor']['id'];
				$part['MotorsPart']['part_id'] = $new_part['Part']['id'];
				$part['MotorsPart']['cantidad'] = $new_part['Part']['quantitat'];
				
				array_push( $motor['Part'], $part );
				//array_push( $motor['Part'], $new_part['Part']['id'] );

				if ($this->Motor->saveAll($motor)) 
				{
					$this->data = $this->Motor->read(null, $new_part['Motor']['id']);
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

	function admin_quick_edit_part( $iMotorID = null, $iPartID = null, $iCancel = false, $iStyle)
	{
		if( $iCancel )
		{ 
			//$opts["contain"] = array('Part'=>array( 'fields'=>array('id') ) );
			$opts["contain"] = array('Part');
			$opts["conditions"] = array('Motor.id'=>$iMotorID );
			$opts["fields"] = array('Motor.id');
			$tMotor = $this->Motor->find( 'all', $opts );
			//DEBUG( $tMotor );
			
			$repeated = false;
			$part = array();
			foreach( $tMotor[0]['Part'] as $Part )
			{
				if( $Part['id'] == $iPartID )
				{
					$part['Part']['motor_id'] = $iMotorID;
					$part['Part']['id'] = $Part['id'];
					$part['Part']['clave_pieza'] = $Part['clave_pieza'];
					$part['Part']['clave_unidad'] = $Part['clave_unidad'];
					$part['Part']['denominacion'] = $Part['denominacion'];
					$part['Part']['MotorsPart']['motor_id'] = $Part['MotorsPart']['motor_id'];
					$part['Part']['MotorsPart']['part_id'] = $Part['MotorsPart']['part_id'];
					$part['Part']['MotorsPart']['cantidad'] = $Part['MotorsPart']['cantidad'];
				}
			}
			
			$this->set('part', $part);
			$this->set('color_class', $iStyle);
			$this->set('motor_id', $iMotorID);
			
			//$this->set('color_class', $iStyle);
			//$this->data = $this->Motor->read(null, $id);
			$this->render('admin_quick_edit_part_saved'); 
		}
		else
		{
			if (!empty($this->data)) 
			{
				$new_part = $this->data;
				//DEBUG( $new_part );
				if( $new_part['Part']['id'] != null ) { $planol_id_exists = $this->Motor->Part->findById( $new_part['Part']['id'] ); }
				else{ $planol_id_exists = null;}
				/*if( $new_planol['Planol']['codigo'] != null ) { $planol_code_exists = $this->Phone->findByCodigo( $new_planol['Planol']['codigo'] ); }
				else{ $planol_code_exists = null;}*/
				
				//$opts["contain"] = array('Part'=>array( 'fields'=>array('id') ) );
				$opts["contain"] = array('Part');
				$opts["conditions"] = array('Motor.id'=>$new_part['Motor']['id'] );
				$opts["fields"] = array('Motor.id');
				$tMotor = $this->Motor->find( 'all', $opts );
				//DEBUG( $tMotor );
				
				$repeated = false;
				$parts = array();
				foreach( $tMotor[0]['Part'] as $Part )
				{
					$part['id'] = $Part['id'];
					$part['MotorsPart']['motor_id'] = $Part['MotorsPart']['motor_id'];
					$part['MotorsPart']['part_id'] = $Part['MotorsPart']['part_id'];
					$part['MotorsPart']['cantidad'] = $Part['MotorsPart']['cantidad'];
					
					if( $Part['id'] == $new_part['Part']['id'] )
					{ 
						$part['MotorsPart']['cantidad'] = $new_part['Part']['quantitat'];
						$repeated = true; 
					}
					
					//array_push( $parts, $Part['id'] );
					array_push( $parts, $part );
				}
				//DEBUG( $parts );
				if( $repeated )
				{
					$motor['Motor']['id'] = $new_part['Motor']['id'];
					$motor['Part'] = $parts;
					
					/*$part['id'] = $new_part['Part']['id'];
					$part['MotorsPart']['motor_id'] = $new_part['Motor']['id'];
					$part['MotorsPart']['part_id'] = $new_part['Part']['id'];
					$part['MotorsPart']['cantidad'] = $new_part['Part']['quantitat'];*/
					
					array_push( $motor['Part'], $part );
					//array_push( $motor['Part'], $new_part['Part']['id'] );

					if ($this->Motor->saveAll($motor)) 
					{
						$this->data = $this->Motor->read(null, $new_part['Motor']['id']);
						
						$edit_part['Part']['id'] = $new_part['Part']['id'];
						$edit_part['Part']['clave_pieza'] = $new_part['Part']['clave_pieza'];
						$edit_part['Part']['clave_unidad'] = $new_part['Part']['clave_unidad'];
						$edit_part['Part']['denominacion'] = $new_part['Part']['denominacion'];
						$edit_part['Part']['MotorsPart']['cantidad'] = $new_part['Part']['quantitat'];
						
						//DEBUG($edit_part);
						$this->loadModel('Part');
						if ($this->Part->save($edit_part)) {
							$this->set('part', $edit_part);
							$this->set('color_class', $new_part['RowInfo']['style']);
							$this->set('motor_id', $new_part['Motor']['id']);
							$this->render('admin_quick_edit_part_saved');
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
				//$opts["contain"] = array('Part'=>array( 'fields'=>array('id') ) );
				$opts["contain"] = array('Part');
				$opts["conditions"] = array('Motor.id'=>$iMotorID );
				$opts["fields"] = array('Motor.id');
				$tMotor = $this->Motor->find( 'all', $opts );
				//DEBUG( $tMotor );
				
				$repeated = false;
				$part = array();
				foreach( $tMotor[0]['Part'] as $Part )
				{
					if( $Part['id'] == $iPartID )
					{
						$part['motor_id'] = $iMotorID;
						$part['id'] = $Part['id'];
						$part['clave_pieza'] = $Part['clave_pieza'];
						$part['clave_unidad'] = $Part['clave_unidad'];
						$part['denominacion'] = $Part['denominacion'];
						$part['MotorsPart']['motor_id'] = $Part['MotorsPart']['motor_id'];
						$part['MotorsPart']['part_id'] = $Part['MotorsPart']['part_id'];
						$part['MotorsPart']['cantidad'] = $Part['MotorsPart']['cantidad'];
					}
				}
				$this->set('part', $part);
				$this->set('color_class', $iStyle);
			}
		}
	}
	
	function admin_del_part( $iMotorID, $iPartID )
	{
		$opts["contain"] = array('Part'=>array( 'fields'=>array('id') ) );
		$opts["conditions"] = array('Motor.id'=>$iMotorID );
		$opts["fields"] = array('Motor.id');
		$tMotor = $this->Motor->find( 'all', $opts );
		//DEBUG( $tMotor );
		
		if( count($tMotor)>0 )
		{
			$parts = array();
			$found = false;
			foreach( $tMotor[0]['Part'] as $Part )
			{
				$part['id'] = $Part['id'];
				$part['MotorsPart']['motor_id'] = $Part['MotorsPart']['motor_id'];
				$part['MotorsPart']['part_id'] = $Part['MotorsPart']['part_id'];
				$part['MotorsPart']['cantidad'] = $Part['MotorsPart']['cantidad'];
				
				//array_push( $parts, $Part['id'] );
				//array_push( $parts, $part );
				//if( $Part['id'] == $new_part['Part']['id'] ){ $repeated = true; }
				
				if( $Part['id'] != $iPartID ){ array_push( $parts, $part ); }
				else{ $found = true; }
			}
			//DEBUG( $parts );
			if( $found )
			{
				$motor['Motor']['id'] = $tMotor[0]['Motor']['id'];
				$motor['Part'] = $parts;
				if ($this->Motor->saveAll($motor)) 
				{
					$this->data = $this->Motor->read(null, $motor['Motor']['id']);
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
	
	function admin_quick_edit($id = null, $iCancel = false, $iColor_Class = "") {
		if( $iCancel )
		{ 
			$this->data = $this->Motor->read(null, $id);
			$this->set( 'color_class', $iColor_Class );
			$this->render('admin_quick_edit_saved'); 
		}
		else
		{
			if (!$id && empty($this->data)) {
				$this->set('error_msg', "L'identificador de motor introduit no existeix.");
				$this->render('admin_quick_edit_error');
			}
			if (!empty($this->data)) {
				$CodigoSerie = $this->data['Serie']['codigo'];
				//DEBUG( $this->data );
				unset( $this->data['Serie'] );
				$iColor_Class = $this->data['row_info']['color_class'];
				unset( $this->data['row_info'] );
				$series = $this->Motor->Serie->findByCodigo( $CodigoSerie );
				$this->data['Motor']['serie_id']=$series['Serie']['id'];
				if( trim($CodigoSerie) != "" && trim($this->data['Motor']['serie_id']) == "" )
				{
					$this->set('error_msg', "La serie introduida no existeix.");
					$this->set( 'color_class', $iColor_Class );
					$this->render('admin_quick_edit_error');
				}
				else
				{
					if ($this->Motor->save($this->data)) {
						$this->data['Serie']['codigo'] = $CodigoSerie;
						//$this->Session->setFlash(__('The motor has been saved', true));
						$this->set( 'color_class', $iColor_Class );
						$this->render('admin_quick_edit_saved');
					} else {
						$this->set( 'color_class', $iColor_Class );
						$this->set('error_msg', "Hi ha hagut un error al guardar, si us plau intenta-ho de nou.");
						$this->render('admin_quick_edit_error');
					}
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Motor->read(null, $id);
				$this->set( 'color_class', $iColor_Class );
			}
		}
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for motor', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Motor->delete($id)) {
			$this->Session->setFlash(__('Motor deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Motor was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function mostrar_planols( $iMotorID )
	{
		$planols = $this->Motor->find( "first", array('contain' => 'Planol', "conditions" => array( "Motor.id" => $iMotorID ) ) );
		$this->set( "planols", $planols);
		//$planols = $this->Planol->find( "all", array('contain' => 'Motor.id = '.$iMotorID, "conditions" => array( "Serie.codigo" => $motor["Motor"]["serie_id"] ), "fields" => array( "id", "codigo" ) ) );
	}
	
	function admin_mostrar_planols( $iMotorID )
	{
		$planols = $this->Motor->find( "first", array('contain' => 'Planol', "conditions" => array( "Motor.id" => $iMotorID ) ) );
		$this->set( "planols", $planols);
		//$planols = $this->Planol->find( "all", array('contain' => 'Motor.id = '.$iMotorID, "conditions" => array( "Serie.codigo" => $motor["Motor"]["serie_id"] ), "fields" => array( "id", "codigo" ) ) );
	}
	
	/*function update_easyplanols()
	{
		$this->Motor->contain('Planol');
		$motors = $this->Motor->find( 'all', array( 'conditions'=>array('easy_planols' => ''), 'fields'=>array( 'id','easy_planols' ), 'limit'=>5000 ) );
		
		foreach( $motors as $motor )
		{
			$planols = "";
			foreach( $motor['Planol'] as $planol )
			{
				$planols .= "$;$".$planol['codigo'];
			}
			$this->Motor->id = $motor['Motor']['id'];
			$this->Motor->saveField('easy_planols', $planols );
			//DEBUG( $motor );
			DEBUG( "[".$motor['Motor']['id']."] Planols -> ".$planols );
		}
	}*/
	
	/*function update_series()
	{
		$this->loadModel('Serie');
		//$this->Motor->contain();
		//$motors = $this->Motor->find( 'all', array( 'fields'=>array( 'id','serie_id' ) ) );
		//$motors = $this->Motor->find( 'all' );
		/*foreach( $motors as $motor )
		{
			//debug($motor);
			$serie = $this->Serie->find( "first", array("conditions" => array( "Serie.codigo" => $motor["Motor"]["serie_id"] ), "fields" => array( "id", "codigo" ) ) );
			//$serie = $this->Serie->find( "first", array("conditions" => array( "Serie.codigo" => "A" ), "fields" => array( "id", "codigo" ) ) );
			//DEBUG($serie);
			echo $motor["Motor"]["id"]." -> ".$motor["Motor"]["serie_id"]." -> ".$serie["Serie"]["id"]."<br>";
		}*/
		/*$series = $this->Serie->find('all', array( 'fields'=>array( 'id','codigo' ) ) );
		foreach($series as $serie)
		{
			echo $serie["Serie"]["id"]." -> ".$serie["Serie"]["codigo"]."<br>";
			$this->Motor->updateAll( array('Motor.serie_id' => $serie["Serie"]["id"]), array('Motor.serie_id' => $serie["Serie"]["codigo"]) );
			//$this->Motor->updateAll( array('Motor.serie_id' => 37), array('Motor.serie_id' => "AM") );
		}
	}
	
	function update_altura()
	{
		$this->Motor->contain();
		$motors = $this->Motor->find( 'all', array( 'fields'=>array( 'id','altura' ) ) );
		$null=0;
		$invalid=0;
		
		foreach( $motors as $motor )
		{
			//DEBUG($motor);
			$altura_original = strtolower( trim( str_replace(array("\n", "\r", "\t", " "), "", $motor["Motor"]["altura"]) ) );
			if( is_numeric( $altura_original )  ){ echo "Motor: ".$motor["Motor"]["id"]." -> ".$altura_original." (".$motor["Motor"]["altura"].") OK<br>"; }
			else
			{ 
				if( $altura_original == null OR $altura_original == "")
				{
					echo "Motor: ".$motor["Motor"]["id"]." -> ".$altura_original." (".$motor["Motor"]["altura"].") NUUUUUUUUUUUUUULL<br>"; 
					$null++;
				}
				else
				{
					echo "Motor: ".$motor["Motor"]["id"]." -> ".$altura_original." (".$motor["Motor"]["altura"].") NOOOOOOOOOOOOOOK<br>"; 
					$invalid++;
				}
			}
		}
		echo "<br><br>ALTURES NO CONVERTIBLES: $invalid";
		echo "<br><br>ALTURES NULLS: $null";
	}
	
	function update_potencia()
	{
		$this->Motor->contain();
		$motors = $this->Motor->find( 'all', array( 'fields'=>array( 'id','potencia' ) ) );
		$null=0;
		$invalid=0;
		$total=0;
		$KW=0;
		$CV=0;
		$nidea=0;
		$OK=0;
		
		foreach( $motors as $motor )
		{
			//DEBUG($motor);
			$potencia_original = strtolower( trim( str_replace(array("\n", "\r", "\t", " "), "", $motor["Motor"]["potencia"]) ) );
			if( is_numeric( $potencia_original )  ){ echo "Motor: ".$motor["Motor"]["id"]." -> ".$potencia_original." (".$motor["Motor"]["potencia"].") OK<br>"; $OK++; }
			else
			{ 
				if( $potencia_original == null OR $potencia_original == "")
				{
					echo "Motor: ".$motor["Motor"]["id"]." -> ".$potencia_original." (".$motor["Motor"]["potencia"].") NUUUUUUUUUUUUUULL<br>"; 
					$null++;
				}
				else
				{
					if( stristr( $potencia_original, "KW" )!="" AND stristr( $potencia_original, "CV" ) === FALSE  AND stristr( $potencia_original, "HP" ) === FALSE )
					{  
						$potencia_en_KW = str_replace( "KW", "", $potencia_original );
						$potencia_en_KW = str_replace( ",", ".", $potencia_en_KW );
						$potencia_en_KW = sprintf( "%.2f", $potencia_en_KW );
						$tipus="KWWWWWWWWWWWWWWWWW - ".$potencia_en_KW;
						$KW++;
						$this->Motor->id = $motor["Motor"]["id"];
						$update["Motor"]["potencia"] = $potencia_en_KW;
						$this->Motor->save( $update );
						
					}
					else if( (stristr( $potencia_original, "CV" )!="" OR stristr( $potencia_original, "HP" )!="") AND stristr( $potencia_original, "KW" ) === FALSE )
					{  
						$potencia_en_KW = str_replace( "CV", "", $potencia_original );
						$potencia_en_KW = str_replace( "HP", "", $potencia_en_KW );
						$potencia_en_KW = str_replace( ",", ".", $potencia_en_KW );
						$potencia_en_KW = sprintf( "%.2f", $potencia_en_KW );
						$potencia_en_KW = (0.7457*$potencia_en_KW);
						$potencia_en_KW = sprintf( "%.2f", $potencia_en_KW );
						$tipus="CVVVVVVVVVVVVVVVVVVVVVV - ".$potencia_en_KW;
						$CV++;
						$this->Motor->id = $motor["Motor"]["id"];
						$update["Motor"]["potencia"] = $potencia_en_KW;
						$this->Motor->save( $update );
					}
					else
					{  
						$tipus="NIDEAAAAAAAA";
						$nidea++;
					}
					echo "Motor: ".$motor["Motor"]["id"]." -> ".$potencia_original." (".$motor["Motor"]["potencia"].") NOOOOOOOOOOOOOOK [".$tipus."]<br>"; 
					$invalid++;
				}
			}
			$total++;
		}
		echo "<br><br>POTENCIES NO CONVERTIBLES: $invalid";
		echo "<br><br>POTENCIES EN KW: $KW";
		echo "<br><br>POTENCIES EN CV: $CV";
		echo "<br><br>POTENCIES EN nidea: $nidea";
		echo "<br><br>POTENCIES I SUMEN: ".($KW+$CV+$nidea);
		echo "<br><br>POTENCIES NULLS: $null";
		echo "<br><br>POTENCIES 'NO VALIDES': ".($null+$invalid);
		echo "<br><br>POTENCIES TOTALS: $total";
		echo "<br><br>POTENCIES OK: $OK";
	}
	
	function update_tension()
	{
		$this->Motor->contain();
		$motors = $this->Motor->find( 'all', array( 'fields'=>array( 'id','tension' ) ) );
		$null=0;
		$invalid=0;
		$total=0;
		$V=0;
		$nidea=0;
		$OK=0;
		
		foreach( $motors as $motor )
		{
			//DEBUG($motor);
			$tension_original = strtolower( trim( str_replace(array("\n", "\r", "\t", " "), "", $motor["Motor"]["tension"]) ) );
			if( is_numeric( $tension_original )  ){ echo "Motor: ".$motor["Motor"]["id"]." -> ".$tension_original." (".$motor["Motor"]["tension"].") OK<br>"; $OK++; }
			else
			{ 
				if( $tension_original == null OR $tension_original == "")
				{
					echo "Motor: ".$motor["Motor"]["id"]." -> ".$tension_original." (".$motor["Motor"]["tension"].") NUUUUUUUUUUUUUULL<br>"; 
					$null++;
				}
				else
				{
					if( stristr( $tension_original, "V" )!="" )
					{  
						$tension = str_replace( "V", "", $tension_original );
						$tension = str_replace( ",", ".", $tension );
						$tension = sprintf( "%.2f", $tension );
						$tipus="VVVVVVVVVVVVVVVVVVVVVVVVVV - ".$tension;
						$V++;
						$this->Motor->id = $motor["Motor"]["id"];
						$update["Motor"]["tension"] = $tension;
						$this->Motor->save( $update );					
					}
					else
					{  
						$tipus="NIDEAAAAAAAA";
						$nidea++;
					}
					echo "Motor: ".$motor["Motor"]["id"]." -> ".$tension_original." (".$motor["Motor"]["tension"].") NOOOOOOOOOOOOOOK [".$tipus."]<br>"; 
					$invalid++;
				}
			}
			$total++;
		}
		echo "<br><br>TENSIONS NO CONVERTIBLES: $invalid";
		echo "<br><br>TENSIONS AMB V: $V";
		echo "<br><br>TENSIONS EN nidea: $nidea";
		echo "<br><br>TENSIONS I SUMEN: ".($V+$nidea);
		echo "<br><br>TENSIONS NULLS: $null";
		echo "<br><br>TENSIONS 'NO VALIDES': ".($null+$invalid);
		echo "<br><br>TENSIONS TOTALS: $total";
		echo "<br><br>TENSIONS OK: $OK";
	}*/
}
?>