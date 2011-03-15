<?php
/* Comment Test cases generated on: 2011-03-15 16:24:02 : 1300202642*/
App::import('Model', 'Comment');

class CommentTestCase extends CakeTestCase {
	var $fixtures = array('app.comment', 'app.match', 'app.round', 'app.tournament', 'app.user', 'app.ranking', 'app.users_tournament');

	function startTest() {
		$this->Comment =& ClassRegistry::init('Comment');
	}

	function endTest() {
		unset($this->Comment);
		ClassRegistry::flush();
	}

}
?>