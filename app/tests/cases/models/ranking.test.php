<?php
/* Ranking Test cases generated on: 2011-03-12 16:00:02 : 1299942002*/
App::import('Model', 'Ranking');

class RankingTestCase extends CakeTestCase {
	var $fixtures = array('app.ranking', 'app.tournament', 'app.round', 'app.match', 'app.user', 'app.users_tournament');

	function startTest() {
		$this->Ranking =& ClassRegistry::init('Ranking');
	}

	function endTest() {
		unset($this->Ranking);
		ClassRegistry::flush();
	}

}
?>