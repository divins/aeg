<?php
/* Motor Fixture generated on: 2010-11-06 17:11:54 : 1289059254 */
class MotorFixture extends CakeTestFixture {
	var $name = 'Motor';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 20, 'key' => 'primary'),
		'clave_pieza' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'clave_unidad' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'denominacion' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 25, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'serie_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'key' => 'index', 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'altura' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'potencia' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 25, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'tension' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'forma' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'CODIGO' => array('column' => 'id', 'unique' => 1), 'serie' => array('column' => 'serie_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'clave_pieza' => 1,
			'clave_unidad' => 'L',
			'denominacion' => 'Lorem ipsum dolor sit a',
			'serie_id' => 'Lorem ip',
			'altura' => 'L',
			'potencia' => 'Lorem ipsum dolor sit a',
			'tension' => 'Lorem ip',
			'forma' => 'Lorem ip',
			'created' => '2010-11-06 17:00:54',
			'modified' => '2010-11-06 17:00:54'
		),
	);
}
?>