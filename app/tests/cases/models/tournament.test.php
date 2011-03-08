<?php
/* Tournament Test cases generated on: 2011-03-07 16:19:53 : 1299511193*/
App::import('Model', 'Tournament');

class TournamentTestCase extends CakeTestCase {
	var $fixtures = array('app.tournament', 'app.round', 'app.user', 'app.match', 'app.users_tournament');

	function startTest() {
		$this->Tournament =& ClassRegistry::init('Tournament');
	}

	function endTest() {
		unset($this->Tournament);
		ClassRegistry::flush();
	}

}
?>