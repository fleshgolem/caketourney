<div class="tournaments bracket view">



<h2><?php  echo ($tournament['KOTournament']['name']);?></h2>
<?php $m = 0;?>
<?php foreach ($tournament['Round'] as $round){?>


	<div class="tournamentRound">
	<?php 
	$this->Bracket->spaceboxes($round['number']);
	foreach ($round['Match'] as $match){
		$this->Bracket->matchbox($match['Player1'],$match['Player2'],$match['player1_score'],$match['player2_score'],$match['id']);
		$this->Bracket->dummyboxes($round['number']);
	}?>
	</div>
<?php 
	$m += 30;
}?>
<!--
<table>
<?php foreach ($tournament['Round'] as $round){?>
	<tr>
	<?php foreach ($round['Match'] as $match){?>
	
		<td>
			<?php 
			if ($match['Player1']!=null)
			{
				echo $this->Race->small_img($match['Player1']['race']);
				echo ('<strong>'.$match['player1_score'].'</strong> ');
			}?>
			<?php 
			//Link to match
			$matchtitle = '';
			if ($match['Player1']!=null)
				$matchtitle .=($match['Player1']['username']) ;
			$matchtitle .= ' vs ' ;
			if ($match['Player2']!=null)
				$matchtitle .=($match['Player2']['username']);
			echo $this->Html->link(($matchtitle), array('controller' => 'matches', 'action' => 'view',$match['id'])); 	
				?>
			<?php 
			if ($match['Player2']!=null)
			{
				echo (' <strong>'.$match['player2_score'].'</strong>');
				echo $this->Race->small_img($match['Player2']['race']);
			}?>
		</td>

	<?php
	} ?>
	</tr>
<?php
} ?>
-->	
</div>

