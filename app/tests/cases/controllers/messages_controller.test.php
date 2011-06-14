<?php
/* Messages Test cases generated on: 2011-06-11 16:32:31 : 1307802751*/
App::import('Controller', 'Messages');

class TestMessagesController extends MessagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MessagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.message', 'app.user', 'app.match', 'app.round', 'app.tournament', 'app.signup', 'app.users_tournament', 'app.comment', 'app.replay');

	function startTest() {
		$this->Messages =& new TestMessagesController();
		$this->Messages->constructClasses();
	}

	function endTest() {
		unset($this->Messages);
		ClassRegistry::flush();
	}

}
?>