<?php
/* Premio Fixture generated on: 2010-11-03 17:11:42 : 1288802082 */
class PremioFixture extends CakeTestFixture {
	var $name = 'Premio';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary'),
		'description' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'description' => 'Lorem ipsum dolor sit amet',
			'created' => '2010-11-03 17:34:42',
			'modified' => '2010-11-03 17:34:42'
		),
	);
}
?>