<?php
/* News Test cases generated on: 2011-05-05 22:49:57 : 1304628597*/
App::import('Controller', 'News');

class TestNewsController extends NewsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class NewsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.news');

	function startTest() {
		$this->News =& new TestNewsController();
		$this->News->constructClasses();
	}

	function endTest() {
		unset($this->News);
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