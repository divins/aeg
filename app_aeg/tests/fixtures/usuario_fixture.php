<?php
/* Usuario Fixture generated on: 2010-11-03 17:11:21 : 1288802061 */
class UsuarioFixture extends CakeTestFixture {
	var $name = 'Usuario';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary'),
		'role_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 60, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'language' => array('type' => 'string', 'null' => false, 'default' => 'es', 'length' => 3, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'website' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'activation_key' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 60, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'image' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'bio' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'timezone' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 10, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'role_id' => 1,
			'username' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'language' => 'L',
			'name' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'website' => 'Lorem ipsum dolor sit amet',
			'activation_key' => 'Lorem ipsum dolor sit amet',
			'image' => 'Lorem ipsum dolor sit amet',
			'bio' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'timezone' => 'Lorem ip',
			'status' => 1,
			'updated' => '2010-11-03 17:34:21',
			'created' => '2010-11-03 17:34:21'
		),
	);
}
?>