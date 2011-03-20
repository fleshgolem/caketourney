<?php
/* Thread Fixture generated on: 2011-03-20 19:03:34 : 1300644214 */
class ThreadFixture extends CakeTestFixture {
	var $name = 'Thread';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date_modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'original_poster_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'last_poster_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'date_modified' => '2011-03-20 19:03:34',
			'original_poster_id' => 1,
			'last_poster_id' => 1
		),
	);
}
?>