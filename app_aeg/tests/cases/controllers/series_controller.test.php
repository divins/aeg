<?php
/* Series Test cases generated on: 2010-11-06 17:11:22 : 1289059222*/
App::import('Controller', 'Series');

class TestSeriesController extends SeriesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SeriesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.series');

	function startTest() {
		$this->Series =& new TestSeriesController();
		$this->Series->constructClasses();
	}

	function endTest() {
		unset($this->Series);
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