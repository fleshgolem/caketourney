<?php
/* Post Fixture generated on: 2011-03-20 19:05:10 : 1300644310 */
class PostFixture extends CakeTestFixture {
	var $name = 'Post';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'thread_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'date_posted' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'body' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
		
	);

	var $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'thread_id' => 1,
			'date_posted' => '2011-03-20 19:05:10',
			'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);
}
?>