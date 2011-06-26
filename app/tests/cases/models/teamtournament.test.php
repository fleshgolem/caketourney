<?php
/* Teamtournament Test cases generated on: 2011-06-25 16:17:12 : 1309011432*/
App::import('Model', 'Teamtournament');

class TeamtournamentTestCase extends CakeTestCase {
	var $fixtures = array('app.teamtournament');

	function startTest() {
		$this->Teamtournament =& ClassRegistry::init('Teamtournament');
	}

	function endTest() {
		unset($this->Teamtournament);
		ClassRegistry::flush();
	}

}
?>