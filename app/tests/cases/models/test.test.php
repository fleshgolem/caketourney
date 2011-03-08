<?php
/* Test Test cases generated on: 2011-03-07 04:17:33 : 1299467853*/
App::import('Model', 'Test');

class TestTestCase extends CakeTestCase {
	var $fixtures = array('app.test', 'app.user');

	function startTest() {
		$this->Test =& ClassRegistry::init('Test');
	}

	function endTest() {
		unset($this->Test);
		ClassRegistry::flush();
	}

}
?>