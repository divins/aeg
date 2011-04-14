<?php
/* Parts Test cases generated on: 2010-11-06 17:11:03 : 1289059263*/
App::import('Controller', 'Parts');

class TestPartsController extends PartsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PartsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.part', 'app.motor', 'app.serie', 'app.motors_part', 'app.planol', 'app.motors_planol', 'app.parts_planol', 'app.parts_part');

	function startTest() {
		$this->Parts =& new TestPartsController();
		$this->Parts->constructClasses();
	}

	function endTest() {
		unset($this->Parts);
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