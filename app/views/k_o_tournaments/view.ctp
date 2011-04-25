<div class="tournaments view">



<h2><?php  echo ($tournament['KOTournament']['name']);?></h2>
<?php foreach ($tournament['Round'] as $round){?>

	<div class="tournamentRound">
	<?php foreach ($round['Match'] as $match){?>
		<div class="matchbox">
			<div class="namesbox">
				<div class="topbox"> 
					<?php
					if ($match['Player1']!=null)
						echo $this->Html->link(($match['Player1']['username']), array('controller' => 'matches', 'action' => 'view',$match['id']));
					else
						echo $this->Html->link(('-'), array('controller' => 'matches', 'action' => 'view',$match['id']));
					?>
				</div>
				<div class="bottombox"> 
					<?php
					if ($match['Player2']!=null)
						echo $this->Html->link(($match['Player2']['username']), array('controller' => 'matches', 'action' => 'view',$match['id']));
					else
						echo $this->Html->link(('-'), array('controller' => 'matches', 'action' => 'view',$match['id']));
					?>
				</div>
			</div>
    		<div class="scorebox">
    			<div class="scoretop">
					<?php echo $this->Html->link(($match['player1_score']), array('controller' => 'matches', 'action' => 'view',$match['id']));?>
				</div>
				<div class="scorebottom">
					<?php echo $this->Html->link(($match['player2_score']), array('controller' => 'matches', 'action' => 'view',$match['id']));?>
				</div>
    		</div>
		</div>
	<?php }?>
	</div>
<?php }?>
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

