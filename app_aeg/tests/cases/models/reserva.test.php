<?php
/* Reserva Test cases generated on: 2010-11-03 17:11:03 : 1288802103*/
App::import('Model', 'Reserva');

class ReservaTestCase extends CakeTestCase {
	var $fixtures = array('app.reserva', 'app.premio', 'app.usuario', 'app.role');

	function startTest() {
		$this->Reserva =& ClassRegistry::init('Reserva');
	}

	function endTest() {
		unset($this->Reserva);
		ClassRegistry::flush();
	}

}
?>