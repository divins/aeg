<?php
/* Reserva Fixture generated on: 2010-11-03 17:11:03 : 1288802103 */
class ReservaFixture extends CakeTestFixture {
	var $name = 'Reserva';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary'),
		'premio_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'index'),
		'usuario_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20),
		'number' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 3, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'prize' => array('column' => array('premio_id', 'usuario_id'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'premio_id' => 1,
			'usuario_id' => 1,
			'number' => 'L',
			'status' => 1,
			'created' => '2010-11-03 17:35:03',
			'modified' => '2010-11-03 17:35:03'
		),
	);
}
?>