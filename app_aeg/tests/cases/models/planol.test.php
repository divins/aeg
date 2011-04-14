<?php
/* Planol Test cases generated on: 2010-11-06 17:11:38 : 1289059238*/
App::import('Model', 'Planol');

class PlanolTestCase extends CakeTestCase {
	var $fixtures = array('app.planol', 'app.motor', 'app.motors_planol', 'app.part', 'app.parts_planol');

	function startTest() {
		$this->Planol =& ClassRegistry::init('Planol');
	}

	function endTest() {
		unset($this->Planol);
		ClassRegistry::flush();
	}

}
?>