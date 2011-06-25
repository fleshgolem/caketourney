<?php
/* Teams Test cases generated on: 2011-06-25 16:21:12 : 1309011672*/
App::import('Controller', 'Teams');

class TestTeamsController extends TeamsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TeamsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.team', 'app.user', 'app.match', 'app.round', 'app.tournament', 'app.signup', 'app.users_tournament', 'app.comment', 'app.replay', 'app.message', 'app.ranking', 'app.invitation', 'app.users_team');

	function startTest() {
		$this->Teams =& new TestTeamsController();
		$this->Teams->constructClasses();
	}

	function endTest() {
		unset($this->Teams);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>