<?php
/* Planol Fixture generated on: 2010-11-06 17:11:38 : 1289059238 */
class PlanolFixture extends CakeTestFixture {
	var $name = 'Planol';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary'),
		'codigo' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 25, 'key' => 'unique', 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'img_digital' => array('type' => 'string', 'null' => false, 'default' => 'No Definit', 'length' => 50, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'ubicacion' => array('type' => 'string', 'null' => false, 'default' => 'No Definit', 'length' => 50, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'codigo' => array('column' => 'codigo', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'codigo' => 'Lorem ipsum dolor sit a',
			'img_digital' => 'Lorem ipsum dolor sit amet',
			'ubicacion' => 'Lorem ipsum dolor sit amet',
			'created' => '2010-11-06 17:00:38',
			'modified' => '2010-11-06 17:00:38'
		),
	);
}
?>