<?php
/* Replay Test cases generated on: 2011-04-10 18:35:49 : 1302453349*/
App::import('Model', 'Replay');

class ReplayTestCase extends CakeTestCase {
	var $fixtures = array('app.replay', 'app.match', 'app.round', 'app.tournament', 'app.signup', 'app.user', 'app.users_tournament', 'app.comment');

	function startTest() {
		$this->Replay =& ClassRegistry::init('Replay');
	}

	function endTest() {
		unset($this->Replay);
		ClassRegistry::flush();
	}

}
?>