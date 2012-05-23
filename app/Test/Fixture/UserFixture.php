<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'create_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modify_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'deleted' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'delete_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'role' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'created' => '2012-05-18 23:11:44',
			'create_at' => '2012-05-18 23:11:44',
			'modified' => '2012-05-18 23:11:44',
			'modify_at' => '2012-05-18 23:11:44',
			'deleted' => '2012-05-18 23:11:44',
			'delete_at' => '2012-05-18 23:11:44',
			'group_id' => 1,
			'username' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'role' => 'Lorem ipsum dolor '
		),
	);
}
