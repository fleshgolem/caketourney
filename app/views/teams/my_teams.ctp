<table>
	<?php foreach ($my_teams as $team)
	{?>
		<tr>
			<td><?php echo $team['Team']['name'];?></td>
			<td><?php echo $this->Html->link('Leave',array('action'=>'leave',$team['Team']['id']));?></td>
		</tr>
	<?php }?>
</table>