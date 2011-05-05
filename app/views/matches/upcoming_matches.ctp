<div class="matches view">
<h2>Upcoming Matches</h2>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th>Player 1</th>
		<th>Player 2</th>
		<th>Date</th>
	</tr>
	
	<?php foreach ($matches as $match){?>
	
	<tr>
		<td>
		<?php
		if ($match['Player1']!=null)
			{
				echo $this->Race->small_img($match['Player1']['race']);
				echo ($match['Player1']['username']);
			}?>
		</td>
		<td>
		<?php
		if ($match['Player2']!=null)
			{
				echo $this->Race->small_img($match['Player2']['race']);
				echo ($match['Player2']['username']);
			}?>
		</td>
		<td>
			<?php echo ($this->Html->link($match['Match']['date'],array('action'=>'view',$match['Match']['id'])));?>
		</td>
	</tr>
	<?}?>
</table>
</div>