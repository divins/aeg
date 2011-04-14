<?php
class UsuariosController extends AppController {

	var $name = 'Usuarios';

	function beforeFilter() 
	{
		parent::beforeFilter(); 
		//$this->Auth->allow(array('*'));
	}	
	
	function acceder() {
		if ($this->Session->read('Auth.User')) 
		{
			$this->Session->setFlash('You are logged in!');
			$this->redirect('/Premios/index', null, false);
		}
	}
	 
	function salir() {
		$this->Session->setFlash('Good-Bye');
		$this->redirect($this->Auth->logout());
	}

	function admin_index() {
		$this->Usuario->recursive = 0;
		$this->set('usuarios', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid usuario', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('usuario', $this->Usuario->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Usuario->create();
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(__('The usuario has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usuario could not be saved. Please, try again.', true));
			}
		}
		$roles = $this->Usuario->Role->find('list');
		$this->set(compact('roles'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid usuario', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(__('The usuario has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usuario could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Usuario->read(null, $id);
		}
		$roles = $this->Usuario->Role->find('list');
		$this->set(compact('roles'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for usuario', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Usuario->delete($id)) {
			$this->Session->setFlash(__('Usuario deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Usuario was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function initDB() 
	{
		$role =& $this->Usuario->Role;
		//Allow admins to everything
		$role->id = 1;     
		$this->Acl->allow($role, 'controllers');
	 
		//allow managers to posts and widgets
		$role->id = 2;
		$this->Acl->deny($role, 'controllers');
		$this->Acl->allow($role, 'controllers/Premios');
		$this->Acl->allow($role, 'controllers/Reservas');
	 
		//allow users to only add and edit on posts and widgets
		$role->id = 3;
		$this->Acl->deny($role, 'controllers');        
		$this->Acl->allow($role, 'controllers/Premios/index');
		$this->Acl->allow($role, 'controllers/Premios/view');        
		$this->Acl->allow($role, 'controllers/Reservas/index');
		//we add an exit to avoid an ugly "missing views" error message
		echo "all done";
		exit;
	}
}
?>