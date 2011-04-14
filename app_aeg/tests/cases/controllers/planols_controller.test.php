<?php
/* Planols Test cases generated on: 2010-11-06 17:11:40 : 1289059240*/
App::import('Controller', 'Planols');

class TestPlanolsController extends PlanolsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PlanolsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.planol', 'app.motor', 'app.motors_planol', 'app.part', 'app.parts_planol');

	function startTest() {
		$this->Planols =& new TestPlanolsController();
		$this->Planols->constructClasses();
	}

	function endTest() {
		unset($this->Planols);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>