<?php
/* Series Test cases generated on: 2010-11-06 17:11:20 : 1289059220*/
App::import('Model', 'Series');

class SeriesTestCase extends CakeTestCase {
	var $fixtures = array('app.series');

	function startTest() {
		$this->Series =& ClassRegistry::init('Series');
	}

	function endTest() {
		unset($this->Series);
		ClassRegistry::flush();
	}

}
?>