<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Team Invitations');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			
				<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo 'Team Name';?></th>
			
			
			<th><?php echo '';?></th>
			
			<th><?php echo '';?></th>
	</tr>
	<?php foreach ($invitations as $invitation)
	{?>
		<tr>
			<td width="75%"><?php echo $this->Html->link($invitation['Team']['name'],array('controller'=>'teams','action'=>'view',$invitation['Invitation']['team_id']));?></td>
			<td><?php echo $this->Html->link('Accept',array('controller'=>'invitations','action'=>'accept',$invitation['Invitation']['id']));?></td>
			<td><?php echo $this->Html->link('Decline',array('action'=>'decline',$invitation['Invitation']['id']));?></td>
		</tr>
	<?php }?>
</table>
			
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottompages">  
        	
        </div>
		<p style="clear: both;">  </p>
	</div>
</div>	
	
	
	

