<?php
/* Usuario Test cases generated on: 2010-11-03 17:11:21 : 1288802061*/
App::import('Model', 'Usuario');

class UsuarioTestCase extends CakeTestCase {
	var $fixtures = array('app.usuario', 'app.role', 'app.reserva');

	function startTest() {
		$this->Usuario =& ClassRegistry::init('Usuario');
	}

	function endTest() {
		unset($this->Usuario);
		ClassRegistry::flush();
	}

}
?>