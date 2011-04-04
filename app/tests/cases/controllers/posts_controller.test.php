<?php
/* Posts Test cases generated on: 2011-04-04 14:44:01 : 1301921041*/
App::import('Controller', 'Posts');

class TestPostsController extends PostsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PostsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.post', 'app.user', 'app.match', 'app.round', 'app.tournament', 'app.signup', 'app.users_tournament', 'app.comment', 'app.thread');

	function startTest() {
		$this->Posts =& new TestPostsController();
		$this->Posts->constructClasses();
	}

	function endTest() {
		unset($this->Posts);
		ClassRegistry::flush();
	}

}
?>