<?php
/* Invitation Fixture generated on: 2011-06-25 16:17:04 : 1309011424 */
class InvitationFixture extends CakeTestFixture {
	var $name = 'Invitation';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'team_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'date' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'team_id' => 1,
			'user_id' => 1,
			'date' => '2011-06-25 16:17:04'
		),
	);
}
?>