<?php
/* Series Fixture generated on: 2010-11-06 17:11:20 : 1289059220 */
class SeriesFixture extends CakeTestFixture {
	var $name = 'Series';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary'),
		'codigo' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'unique', 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'descripcion' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'codigo' => array('column' => 'codigo', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'codigo' => 'Lorem ip',
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'created' => '2010-11-06 17:00:20',
			'modified' => '2010-11-06 17:00:20'
		),
	);
}
?>