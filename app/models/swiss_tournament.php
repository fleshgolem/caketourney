<?php  
App::Import ('model', 'Tournament');
class SwissTournament extends Tournament { 

    var $name = 'KOTournament'; 
    var $useTable = 'tournaments'; 
	var $hasMany = array(
		'Ranking' => array(
			'className' => 'Ranking',
			'foreignKey' => 'tournament_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		));
    var $recursive = 3;

} 
?>