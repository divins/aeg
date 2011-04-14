<?php
/* Premio Test cases generated on: 2010-11-03 17:11:42 : 1288802082*/
App::import('Model', 'Premio');

class PremioTestCase extends CakeTestCase {
	var $fixtures = array('app.premio', 'app.reserva');

	function startTest() {
		$this->Premio =& ClassRegistry::init('Premio');
	}

	function endTest() {
		unset($this->Premio);
		ClassRegistry::flush();
	}

}
?>