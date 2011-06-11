<?php
/* CommentSubscription Fixture generated on: 2011-06-11 16:51:54 : 1307803914 */
class CommentSubscriptionFixture extends CakeTestFixture {
	var $name = 'CommentSubscription';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'match_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'match_id' => 1,
			'user_id' => 1,
			'active' => 1
		),
	);
}
?>