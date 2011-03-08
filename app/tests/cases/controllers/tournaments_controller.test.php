<?php
/* Tournaments Test cases generated on: 2011-03-07 15:37:39 : 1299508659*/
App::import('Controller', 'Tournaments');

class TestTournamentsController extends TournamentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TournamentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.tournament', 'app.user', 'app.users_tournament');

	function startTest() {
		$this->Tournaments =& new TestTournamentsController();
		$this->Tournaments->constructClasses();
	}

	function endTest() {
		unset($this->Tournaments);
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