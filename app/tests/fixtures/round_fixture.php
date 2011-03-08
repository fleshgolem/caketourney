<?php
/* Round Fixture generated on: 2011-03-07 16:33:38 : 1299512018 */
class RoundFixture extends CakeTestFixture {
	var $name = 'Round';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'number' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'tournament_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'number' => 1,
			'tournament_id' => 1
		),
	);
}
?>