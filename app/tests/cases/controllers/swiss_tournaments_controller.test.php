<?php
/* SwissTournaments Test cases generated on: 2011-03-12 16:10:50 : 1299942650*/
App::import('Controller', 'SwissTournaments');

class TestSwissTournamentsController extends SwissTournamentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SwissTournamentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.k_o_tournament', 'app.ranking', 'app.tournament', 'app.round', 'app.match', 'app.user', 'app.users_tournament');

	function startTest() {
		$this->SwissTournaments =& new TestSwissTournamentsController();
		$this->SwissTournaments->constructClasses();
	}

	function endTest() {
		unset($this->SwissTournaments);
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