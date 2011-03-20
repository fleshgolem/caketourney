<?php
/* Threads Test cases generated on: 2011-03-20 19:04:59 : 1300644299*/
App::import('Controller', 'Threads');

class TestThreadsController extends ThreadsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ThreadsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.thread', 'app.user', 'app.match', 'app.round', 'app.tournament', 'app.users_tournament', 'app.comment', 'app.post');

	function startTest() {
		$this->Threads =& new TestThreadsController();
		$this->Threads->constructClasses();
	}

	function endTest() {
		unset($this->Threads);
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