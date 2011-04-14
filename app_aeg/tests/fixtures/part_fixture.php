<?php
/* Part Fixture generated on: 2010-11-06 17:11:02 : 1289059262 */
class PartFixture extends CakeTestFixture {
	var $name = 'Part';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 20, 'key' => 'primary'),
		'clave_pieza' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'clave_unidad' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'denominacion' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 25, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'CODIGO' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'clave_pieza' => 1,
			'clave_unidad' => 'L',
			'denominacion' => 'Lorem ipsum dolor sit a',
			'created' => '2010-11-06 17:01:02',
			'modified' => '2010-11-06 17:01:02'
		),
	);
}
?>