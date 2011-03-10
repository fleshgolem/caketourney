<?php


class RaceHelper extends AppHelper {
	var $helpers = array('Html');
    function small_img($i) {
        switch ($i) {
		case 0:
			return ($this->Html->image('terran.png', array('alt' => 'Terran')));
			break;
		case 1:
			return ($this->Html->image('protoss.png', array('alt' => 'Protoss')));
			break;
		case 2:
			return ($this->Html->image('zerg.png', array('alt' => 'zerg')));
			break;
		case 3:
			return ($this->Html->image('random.png', array('alt' => 'Random')));
			break;	
		}
    }
}

?>
