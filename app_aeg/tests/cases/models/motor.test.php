<?php
/* Motor Test cases generated on: 2010-11-06 17:11:54 : 1289059254*/
App::import('Model', 'Motor');

class MotorTestCase extends CakeTestCase {
	var $fixtures = array('app.motor', 'app.serie', 'app.part', 'app.motors_part', 'app.planol', 'app.motors_planol', 'app.parts_planol');

	function startTest() {
		$this->Motor =& ClassRegistry::init('Motor');
	}

	function endTest() {
		unset($this->Motor);
		ClassRegistry::flush();
	}

}
?>