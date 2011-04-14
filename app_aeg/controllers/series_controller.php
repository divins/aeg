<?php
class SeriesController extends AppController {

	var $name = 'Series';
	var $helpers = array('Html','Ajax','Javascript');
	var $components = array( 'RequestHandler' );
	
	function index() {
		$this->Series->recursive = 0;
		$this->set('series', $this->paginate());
	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid series', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('series', $this->Series->read(null, $id));
	}
	
	function admin_index() {
		$this->Series->recursive = 0;
		$this->paginate = array( 'limit'=>200 );
		$this->set('series', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid series', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('series', $this->Series->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Series->create();
			if ($this->Series->save($this->data)) {
				$this->Session->setFlash(__('The series has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The series could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		$this->layout = 'ajax';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid series', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Series->save($this->data)) {
				$this->Session->setFlash(__('The series has been saved', true));
				//$this->redirect(array('action' => 'index'));
				$this->render('quick_edit_saved');
			} else {
				$this->Session->setFlash(__('The series could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Series->read(null, $id);
		}
	}
	
	function admin_quick_edit($id = null, $iCancel = false) {
		if( $iCancel )
		{ 
			$this->data = $this->Series->read(null, $id);
			$this->render('admin_quick_edit_saved'); 
		}
		else
		{
			if (!$id && empty($this->data)) {
				$this->set('error_msg', __("L'identificador de la serie introduida no existeix.",true) );
				$this->render('admin_quick_edit_error');
			}
			if (!empty($this->data)) {
				if ($this->Series->save($this->data)) {
					$this->render('admin_quick_edit_saved');
				} else {
					$this->set('error_msg', "Hi ha hagut un error al guardar, si us plau intenta-ho de nou.");
					$this->render('admin_quick_edit_error');
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Series->read(null, $id);
			}
		}
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for series', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Series->delete($id)) {
			$this->Session->setFlash(__('Series deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Series was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>