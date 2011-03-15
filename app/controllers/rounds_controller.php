<?php
App::import('Controller', 'Matches');
class RoundsController extends AppController {

	var $name = 'Rounds';
	var $scaffold;
	
	function generate ($tournament_id, $number, $matchcount, $games_per_match)
	{
		$this->Round->create();
		$this->data['Round']['tournament_id']=$tournament_id;
		$this->data['Round']['number']=$number;
		if ($this->Round->save($this->data)) 
		{
				$id= $this->Round->id;
				//$this->Session->setFlash(__('The round has been saved', true));
		} 
			else 
		{
				$this->Session->setFlash(__('The round could not be saved. Please, try again.', true));
		}
		
		//Generate Matches
		$Matches = new MatchesController;
		$Matches->ConstructClasses();
		
		$this->Round->getLastInsertId();
		for ($i = 0; $i<$matchcount ; $i++)
		{
			$Matches->generate($id,$i,$games_per_match);
		}
			
	}
	function generate_with_matchups ($tournament_id, $number, $matchcount, $games_per_match, $matchups)
	{	
		$this->Round->create();
		$this->data['Round']['tournament_id']=$tournament_id;
		$this->data['Round']['number']=$number;
		if ($this->Round->save($this->data)) 
		{
				$id= $this->Round->id;
				//$this->Session->setFlash(__('The round has been saved', true));
		} 
			else 
		{
				$this->Session->setFlash(__('The round could not be saved. Please, try again.', true));
		}
		
		//Generate Matches
		$Matches = new MatchesController;
		$Matches->ConstructClasses();
		
		$this->Round->getLastInsertId();
		for ($i = 0; $i<$matchcount ; $i++)
		{
			$Matches->generate_with_matchup($id,$i,$games_per_match,$matchups[$i][0],$matchups[$i][1]);
		}
			
	}
		
}
?>