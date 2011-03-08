<?php
/* Round Test cases generated on: 2011-03-07 16:33:38 : 1299512018*/
App::import('Model', 'Round');

class RoundTestCase extends CakeTestCase {
	var $fixtures = array('app.round', 'app.tournament', 'app.user', 'app.match', 'app.users_tournament');

	function startTest() {
		$this->Round =& ClassRegistry::init('Round');
	}

	function endTest() {
		unset($this->Round);
		ClassRegistry::flush();
	}

}
?>