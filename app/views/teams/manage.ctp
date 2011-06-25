<?php echo $this->Form->create('Team');?>

	<?php
	echo $this->Form->input('id');
	
	echo $this->Form->input('Invitation.user_id');
	
	echo $this->Form->end(__('Submit', true));?>
	
<table>
	<?php foreach ($members as $member)
	{?>
		<tr>
			<td><?php echo $member['User']['username'];?></td>
			<td><?php echo $this->Html->link('Kick!',array('action'=>'kick_member',$team_id,$member['User']['id']));?></td>
		</tr>
	<?php }?>
</table>
	