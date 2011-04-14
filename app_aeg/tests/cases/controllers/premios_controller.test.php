<?php
/* Premios Test cases generated on: 2010-11-03 17:11:43 : 1288802083*/
App::import('Controller', 'Premios');

class TestPremiosController extends PremiosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PremiosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.premio', 'app.reserva');

	function startTest() {
		$this->Premios =& new TestPremiosController();
		$this->Premios->constructClasses();
	}

	function endTest() {
		unset($this->Premios);
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