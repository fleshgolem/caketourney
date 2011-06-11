<?php
/* CommentSubscription Test cases generated on: 2011-06-11 16:51:54 : 1307803914*/
App::import('Model', 'CommentSubscription');

class CommentSubscriptionTestCase extends CakeTestCase {
	var $fixtures = array('app.comment_subscription', 'app.match', 'app.round', 'app.tournament', 'app.signup', 'app.user', 'app.users_tournament', 'app.comment', 'app.replay');

	function startTest() {
		$this->CommentSubscription =& ClassRegistry::init('CommentSubscription');
	}

	function endTest() {
		unset($this->CommentSubscription);
		ClassRegistry::flush();
	}

}
?>