<?php
/* Team Fixture generated on: 2011-06-25 16:16:19 : 1309011379 */
class TeamFixture extends CakeTestFixture {
	var $name = 'Team';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'leader_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'team_type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 13, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'logo_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'logo_size' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 13),
		'logo_type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'date_created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'leader_id' => 1,
			'team_type' => 'Lorem ipsum',
			'name' => 'Lorem ipsum dolor ',
			'logo_name' => 'Lorem ipsum dolor sit amet',
			'logo_size' => 1,
			'logo_type' => 'Lorem ipsum dolor sit amet',
			'date_created' => '2011-06-25 16:16:19'
		),
	);
}
?>