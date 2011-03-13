<?php
/* Ranking Fixture generated on: 2011-03-12 16:00:02 : 1299942002 */
class RankingFixture extends CakeTestFixture {
	var $name = 'Ranking';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'tournament_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'match_points' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'elo' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'tournament_id' => 1,
			'user_id' => 1,
			'match_points' => 1,
			'elo' => 1
		),
	);
}
?>