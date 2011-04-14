<?php
class PlanolsController extends AppController {

	var $name = 'Planols';
	var $helpers = array('Html','Ajax','Javascript');
	var $components = array( 'RequestHandler' );
	
	function index() {	
		$this->Planol->recursive = 0;
		$this->set('planols', $this->paginate());
	}
	
	function admin_index() {
	
		if($this->data)
		{	
			$paginate_opts["contain"] = array();
			$paginate_opts["conditions"] = array();
			$paginate_opts["order"] = array();
			
			$this->paginate = array( 'contain' => array() );
			$conditions=$this->postConditions($this->data);

			if(trim($conditions["Planol.id"]) == "" )
			{ 
				unset($conditions["Planol.id"]); 
				if(trim($conditions["Planol.codigo"]) == "" ){ unset($conditions["Planol.codigo"]); }
				else
				{ 
					$conditions["Planol.codigo LIKE"] = "%".$conditions["Planol.codigo"]."%"; 
					unset($conditions["Planol.codigo"]); 
				}
				if(trim($conditions["Planol.img_digital"]) == "" ){ unset($conditions["Planol.img_digital"]); }
				else
				{ 
					$conditions["Planol.img_digital LIKE"] = "%".$conditions["Planol.img_digital"]."%"; 
					unset($conditions["Planol.img_digital"]); 
				}
				if(trim($conditions["Planol.ubicacion"]) == "" ){ unset($conditions["Planol.ubicacion"]); }
				else
				{ 
					$conditions["Planol.ubicacion LIKE"] = "%".$conditions["Planol.ubicacion"]."%"; 
					unset($conditions["Planol.ubicacion"]); 
				}		
			}	
			else
			{
				unset($conditions["Planol.codigo"]);
				unset($conditions["Planol.img_digital"]);
				unset($conditions["Planol.ubicacion"]);
			}
			
			$paginate_opts["conditions"] = $conditions;
			//$paginate_opts["limit"] = 55000;
			$this->paginate = $paginate_opts;
			$this->set('planols', $this->paginate());
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
			
			$paginate_opts["contain"] = array();	
			
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
			$this->set('planols', $this->paginate());
			//$sort_conditions = array_merge( (array)$conditions, (array)$paginate_opts["order"] );
			//$this->set('conditions', $sort_conditions);
			$this->set('conditions', $conditions);
		}	
		else
		{
			$this->Planol->recursive = 0;
			$this->set('planols', $this->paginate());
			$this->set('conditions', "");
		}
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid planol', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('planol', $this->Planol->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Planol->create();
			if ($this->Planol->save($this->data)) {
				$this->Session->setFlash(__('The planol has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planol could not be saved. Please, try again.', true));
			}
		}
		$motors = $this->Planol->Motor->find('list');
		$parts = $this->Planol->Part->find('list');
		$this->set(compact('motors', 'parts'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid planol', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Planol->save($this->data)) {
				$this->Session->setFlash(__('The planol has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planol could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Planol->read(null, $id);
		}
		/*$motors = $this->Planol->Motor->find('list');
		$parts = $this->Planol->Part->find('list');
		$this->set(compact('motors', 'parts'));*/
	}

	function admin_quick_edit($id = null, $iCancel = false) 
	{
		if( $iCancel )
		{ 
			$this->data = $this->Planol->read(null, $id);
			$this->render('admin_quick_edit_saved'); 
		}
		else
		{
			if (!$id && empty($this->data)) {
				$this->set('error_msg', __("L'identificador del planol introduit no existeix.",true) );
				$this->render('admin_quick_edit_error');
			}
			if (!empty($this->data)) {
				if ($this->Planol->save($this->data)) {
					//$this->Session->setFlash(__('The planol has been saved', true));
					//$this->redirect(array('action' => 'index'));
					$this->render('admin_quick_edit_saved');
				} else {
					$this->set('error_msg', "Hi ha hagut un error al guardar, si us plau intenta-ho de nou.");
					$this->render('admin_quick_edit_error');
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Planol->read(null, $id);
			}
		}
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for planol', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Planol->delete($id)) {
			$this->Session->setFlash(__('Planol deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Planol was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_mostrar_planol( $iPlanolID )
	{
		$this->set( "planol", $this->Planol->findById( $iPlanolID ) );		
	}
	
	function admin_upload_attachment( $iID=null )
	{
		if (!$iID && empty($this->data)) {
			$this->flash(__('Invalid_Shipout', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			//$index_filter = $this->data['Filter'];
			$shipout = $this->Planol->findById( $this->data['Planol']['id'] );
			//DEBUG( $this->data );
			/*if( $this->Permission->check_perm( 'shipouts', null,$shipout['Shipout']['machine_id']) )
			{*/
				$tFilenameArray = explode( '.', $this->data['Planol']['file']['name'] );

				if( in_array( $tFilenameArray[ (count($tFilenameArray))-1], Configure::read("documents.extensions") ) )
				{
					//$new_file_name = $this->data['Planol']['file']['name'];
					$new_file_name = $this->data['Planol']['id'].".".$tFilenameArray[ (count($tFilenameArray))-1];
					if( move_uploaded_file( $this->data['Planol']['file']['tmp_name'], Configure::read("documents.path")."/img/planols/".$new_file_name) )
					{		
						//$this->Session->setFlash(__('uploaded_file_correctly_saved', true));
						//$this->redirect("/planols/index", null, false);
						$update_planol['Planol']['id'] = $this->data['Planol']['id'];
						$update_planol['Planol']['img_digital'] = $this->data['Planol']['file']['name'];
						$update_planol['Planol']['ubicacion'] = $this->data['Planol']['ubicacion'];
						if ( $this->Planol->save( $update_planol ) ) {
							$this->Session->setFlash(__('uploaded_file_correctly_saved', true));
							$this->redirect("/admin/planols/index", null, false);
						} else {
							$this->Session->setFlash( __('Error_saving_cit_amount', true) );
							$this->redirect("/admin/planols/index", null, false);
						}
					}
					else {
						$this->Session->setFlash( __('Error_saving_file', true) );
						$this->redirect("/admin/planols/index", null, false);
					}
				}
				else {
					$this->Session->setFlash( __('file_type_uploaded_is_not_permitted', true) );
					//$this->redirect("/planols/index/".$index_filter['machine_id']."/".$index_filter['mode']."/".$index_filter['from_date']."/".$index_filter['to_date']."/".$index_filter['order_by']."/".$index_filter['order_mode'], null, false);
					$this->redirect("/admin/planols/index", null, false);
				}
			/*}
			else{
				$this->Session->setFlash( __('You_dont_have_permission_to_upload_files_to_this_shipout'));
				$this->redirect("/shipouts/index/".$index_filter['machine_id']."/".$index_filter['mode']."/".$index_filter['from_date']."/".$index_filter['to_date']."/".$index_filter['order_by']."/".$index_filter['order_mode'], null, false);
			}*/
		}
		else{
			//$this->set( 'planol_id', $iID );
			//$this->Planol->contain('');
			$this->Planol->recursive = 0;
			$this->data = $this->Planol->read(null, $iID);
			/*$this->set('machine_id', $machine_id);
			$this->set('mode', $mode); 
			$this->set('from_date', $from_date);
			$this->set('to_date', $to_date);
			$this->set('order_by', $order_by);
			$this->set('order_mode', $order_mode);*/
		}
	}
}
?>