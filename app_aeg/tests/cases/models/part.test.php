<?php
/* Part Test cases generated on: 2010-11-06 17:11:02 : 1289059262*/
App::import('Model', 'Part');

class PartTestCase extends CakeTestCase {
	var $fixtures = array('app.part', 'app.motor', 'app.serie', 'app.motors_part', 'app.planol', 'app.motors_planol', 'app.parts_planol', 'app.parts_part');

	function startTest() {
		$this->Part =& ClassRegistry::init('Part');
	}

	function endTest() {
		unset($this->Part);
		ClassRegistry::flush();
	}

}
?>