<?php  
App::Import ('model', 'Tournament');
class KOTournament extends Tournament { 

    var $name = 'KOTournament';
	var $actsAs = array('Containable'); 
    var $useTable = 'tournaments'; 
    var $recursive = 1;

} 
?>