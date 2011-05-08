<?php
/* News Test cases generated on: 2011-05-05 22:49:14 : 1304628554*/
App::import('Model', 'News');

class NewsTestCase extends CakeTestCase {
	var $fixtures = array('app.news');

	function startTest() {
		$this->News =& ClassRegistry::init('News');
	}

	function endTest() {
		unset($this->News);
		ClassRegistry::flush();
	}

}
?>