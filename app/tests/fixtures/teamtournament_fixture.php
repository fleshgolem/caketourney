<?php
/* Teamtournament Fixture generated on: 2011-06-25 16:17:12 : 1309011432 */
class TeamtournamentFixture extends CakeTestFixture {
	var $name = 'Teamtournament';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'typeField' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'typeAlias' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'team_type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'currend_round' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'ranked' => array('type' => 'integer', 'null' => false, 'default' => '1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'typeField' => 'Lorem ipsum dolor sit amet',
			'typeAlias' => 1,
			'team_type' => 'Lorem ipsum dolor sit amet',
			'currend_round' => 1,
			'ranked' => 1
		),
	);
}
?>