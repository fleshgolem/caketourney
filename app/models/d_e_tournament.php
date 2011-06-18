<?php  
App::Import ('model', 'Tournament');
class DETournament extends Tournament { 

    var $name = 'DETournament'; 
    var $useTable = 'tournaments'; 
    var $recursive = 1;

} 
?>