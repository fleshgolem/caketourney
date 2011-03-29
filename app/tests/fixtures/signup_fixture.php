<?php
/* Signup Fixture generated on: 2011-03-29 15:58:39 : 1301407119 */
class SignupFixture extends CakeTestFixture {
	var $name = 'Signup';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'tournament_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'tournament_id' => 1,
			'user_id' => 1
		),
	);
}
?>