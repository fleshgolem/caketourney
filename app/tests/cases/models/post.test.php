<?php
/* Post Test cases generated on: 2011-03-20 19:05:10 : 1300644310*/
App::import('Model', 'Post');

class PostTestCase extends CakeTestCase {
	var $fixtures = array('app.post', 'app.user', 'app.match', 'app.round', 'app.tournament', 'app.users_tournament', 'app.comment', 'app.thread');

	function startTest() {
		$this->Post =& ClassRegistry::init('Post');
	}

	function endTest() {
		unset($this->Post);
		ClassRegistry::flush();
	}

}
?>