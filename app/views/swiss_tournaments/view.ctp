<div class="tournaments view">



<h2><?php  echo ($tournament['SwissTournament']['name']);?></h2>

<?php 
if ($in_tournament){?>
	<div class="buttons">
		<?php echo $this->Html->link('My Tournament Settings', array('action'=>'settings',$tournament['SwissTournament']['id']));?>
	</div>
<?php }?>
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
				$matchtitle .=($match['Player1']['username']);
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
	<?php 

		if($tournament['SwissTournament']['current_round']==$round['number'] AND $this->Session->read('Auth.User.admin'))
		{?>
			<td>
			<?php  echo $this->Html->link(__('Finish Round',true), array('controller' => 'swiss_tournaments', 'action' => 'finish_round',$tournament['SwissTournament']['id']));?>
			</td>
		<?php }?>
	</tr>
<?php
} ?>	
</table>

<table>
<?php foreach ($ranking as $i=>$rank){?>
	<tr>
		<td><?php echo($i+1);?></td>
		<td><?php echo($rank['User']['username']);?></td>
		<td><?php echo($rank['Ranking']['wins']);?></td>
		<td><?php echo($rank['Ranking']['draws']);?></td>
		<td><?php echo($rank['Ranking']['defeats']);?></td>
		<td><?php echo($rank['Ranking']['elo']);?></td>
	</tr>
	<?php }?>
</table>
</div>
