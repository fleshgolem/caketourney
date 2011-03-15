<div class="matches view">
<h2>My Open Matches</h2>

<table>
	<tr>
		<th>Match</th>

		<th>Tournament</th>
		<th>Round</th>
	</tr>
	<?php foreach($matches as $match){?>
	<tr>
		<td>
		<?php 
			if ($match['Player1']!=null)
				echo $this->Race->small_img($match['Player1']['race']);
			//Link to match
			$matchtitle = '';
			if ($match['Player1']!=null)
				$matchtitle .=($match['Player1']['name']);
			$matchtitle .= ' vs ' ;
			if ($match['Player2']!=null)
				$matchtitle .=($match['Player2']['name']);
			echo $this->Html->link(($matchtitle), array('controller' => 'matches', 'action' => 'view',$match['Match']['id'])); 	
			if ($match['Player2']!=null)
				echo $this->Race->small_img($match['Player2']['race']);
			?>
		</td>
		
		<td>
		<?php echo $this->Html->link(($match['Round']['Tournament']['name']),array('controller' => 'tournaments', 'action' => 'view',$match['Round']['Tournament']['id']))?>
		</td>
		<td>
		<?php echo ($match['Round']['number']+1)?>
		</td>
	</tr>
	<?php }?>
</table>
</div>