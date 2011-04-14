<?php
/* Motors Test cases generated on: 2010-11-06 17:11:55 : 1289059255*/
App::import('Controller', 'Motors');

class TestMotorsController extends MotorsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MotorsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.motor', 'app.serie', 'app.part', 'app.motors_part', 'app.planol', 'app.motors_planol', 'app.parts_planol');

	function startTest() {
		$this->Motors =& new TestMotorsController();
		$this->Motors->constructClasses();
	}

	function endTest() {
		unset($this->Motors);
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