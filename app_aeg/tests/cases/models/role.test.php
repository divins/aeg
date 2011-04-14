<?php
/* Role Test cases generated on: 2010-11-03 17:11:01 : 1288802041*/
App::import('Model', 'Role');

class RoleTestCase extends CakeTestCase {
	var $fixtures = array('app.role', 'app.usuario');

	function startTest() {
		$this->Role =& ClassRegistry::init('Role');
	}

	function endTest() {
		unset($this->Role);
		ClassRegistry::flush();
	}

}
?>