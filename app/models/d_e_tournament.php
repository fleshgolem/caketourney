<?php  
App::Import ('model', 'Tournament');
class DETournament extends Tournament { 

    var $name = 'DETournament'; 
	var $actsAs = array('Containable');
    var $useTable = 'tournaments'; 
    var $recursive = 1;
	
	

} 
?>