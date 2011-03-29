<?php
/* Signup Test cases generated on: 2011-03-29 15:58:39 : 1301407119*/
App::import('Model', 'Signup');

class SignupTestCase extends CakeTestCase {
	var $fixtures = array('app.signup', 'app.tournament', 'app.round', 'app.match', 'app.user', 'app.users_tournament', 'app.comment');

	function startTest() {
		$this->Signup =& ClassRegistry::init('Signup');
	}

	function endTest() {
		unset($this->Signup);
		ClassRegistry::flush();
	}

}
?>