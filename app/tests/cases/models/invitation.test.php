<?php
/* Invitation Test cases generated on: 2011-06-25 16:17:05 : 1309011425*/
App::import('Model', 'Invitation');

class InvitationTestCase extends CakeTestCase {
	var $fixtures = array('app.invitation', 'app.team', 'app.user', 'app.match', 'app.round', 'app.tournament', 'app.signup', 'app.users_tournament', 'app.comment', 'app.replay', 'app.message', 'app.ranking', 'app.users_team');

	function startTest() {
		$this->Invitation =& ClassRegistry::init('Invitation');
	}

	function endTest() {
		unset($this->Invitation);
		ClassRegistry::flush();
	}

}
?>