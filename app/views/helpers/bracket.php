<?php

class BracketHelper extends AppHelper {
	var $helpers = array('Html');
	function matchbox($player1,$player2,$player1_score,$player2_score,$match_id)
	{
	?>
		<div class="matchbox">
			<div class="namesbox">
				<div class="topbox"> 
					<?php
					if ($player1!=null)
						echo $this->Html->link(($player1['username']), array('controller' => 'matches', 'action' => 'view',$match_id));
					else
						echo $this->Html->link(('-'), array('controller' => 'matches', 'action' => 'view',$match_id));
					?>
				</div>
				<div class="bottombox"> 
					<?php
					if ($player2!=null)
						echo $this->Html->link(($player2['username']), array('controller' => 'matches', 'action' => 'view',$match_id));
					else
						echo $this->Html->link(('-'), array('controller' => 'matches', 'action' => 'view',$match_id));
					?>
				</div>
			</div>
    		<div class="scorebox">
    			<div class="scoretop">
					<?php
					if ($player1_score!=null)
						echo $this->Html->link(($player1_score), array('controller' => 'matches', 'action' => 'view',$match_id));
					else
						echo $this->Html->link(('-'), array('controller' => 'matches', 'action' => 'view',$match_id));
					?>
				</div>
				<div class="scorebottom">
					<?php
					if ($player2_score!=null)
						echo $this->Html->link(($player2_score), array('controller' => 'matches', 'action' => 'view',$match_id));
					else
						echo $this->Html->link(('-'), array('controller' => 'matches', 'action' => 'view',$match_id));
					?>

				</div>
    		</div>
		</div>
<?php
	}
	
	function spaceboxes($round)
	{
		//debug($round);
		if ($round > 0)
		{
			echo ('<div class="spacebox"> </div>');
		}
		$boxes = pow(2,$round-1)-1;
		//debug($boxes);
		for ($i = 0; $i < $boxes; $i++)
		{
			echo('<div class="matchbox"> </div>');
		}
	}
	
	function dummyboxes($round)
	{
		$boxes = pow(2,$round)-1;
		//debug($boxes);
		for ($i = 0; $i < $boxes; $i++)
		{
			echo('<div class="matchbox"> </div>');
		}
	}
	
	function lines($round)
	{
		?>
		<div class="linebox">
    	<div class="halflinebox">
		<?php
		//debug($round);
		if ($round > 0)
		{
			echo ('<div class="spacebox2em"> </div>');
		}
		$boxes = pow(2,$round-1)-1;
		//debug($boxes);
		for ($i = 0; $i < $boxes; $i++)
		{
			echo('<div class="matchbox"> </div>');
		}
	}
}
?>
