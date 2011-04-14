<?php
/* Reservas Test cases generated on: 2010-11-03 17:11:03 : 1288802103*/
App::import('Controller', 'Reservas');

class TestReservasController extends ReservasController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ReservasControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.reserva', 'app.premio', 'app.usuario', 'app.role');

	function startTest() {
		$this->Reservas =& new TestReservasController();
		$this->Reservas->constructClasses();
	}

	function endTest() {
		unset($this->Reservas);
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