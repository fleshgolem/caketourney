<table>
	<?php foreach ($invitations as $invitation)
	{?>
		<tr>
			<td><?php echo $invitation['Team']['name'];?></td>
			<td><?php echo $this->Html->link('Accept',array('controller'=>'invitations','action'=>'accept',$invitation['Invitation']['id']));?></td>
			<td><?php echo $this->Html->link('Decline',array('action'=>'decline',$invitation['Invitation']['id']));?></td>
		</tr>
	<?php }?>
</table>