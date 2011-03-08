<?php
/* Matches Test cases generated on: 2011-03-07 16:19:43 : 1299511183*/
App::import('Controller', 'Matches');

class TestMatchesController extends MatchesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MatchesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.match', 'app.round', 'app.user', 'app.tournament', 'app.users_tournament');

	function startTest() {
		$this->Matches =& new TestMatchesController();
		$this->Matches->constructClasses();
	}

	function endTest() {
		unset($this->Matches);
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