<?php
/* Rounds Test cases generated on: 2011-03-07 17:00:41 : 1299513641*/
App::import('Controller', 'Rounds');

class TestRoundsController extends RoundsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class RoundsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.round', 'app.tournament', 'app.user', 'app.match', 'app.users_tournament');

	function startTest() {
		$this->Rounds =& new TestRoundsController();
		$this->Rounds->constructClasses();
	}

	function endTest() {
		unset($this->Rounds);
		ClassRegistry::flush();
	}

}
?>