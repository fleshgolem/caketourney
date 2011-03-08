<?php
/* Tests Test cases generated on: 2011-03-07 03:28:16 : 1299464896*/
App::import('Controller', 'Tests');

class TestTestsController extends TestsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TestsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.test');

	function startTest() {
		$this->Tests =& new TestTestsController();
		$this->Tests->constructClasses();
	}

	function endTest() {
		unset($this->Tests);
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