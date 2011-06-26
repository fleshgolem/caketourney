<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Manage Team'); ?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>


 <div class="PostBox">
    <div class="ThreadTitleBox">
        <div class="ThreadTitleContent">
            <h3><?php echo 'Invite a User';?></h3>
        </div> 
        <div class="bottomaction">
         </div> 
         <p style="clear: both;"></p>  
    </div>
    </div>


<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				

<?php echo $this->Form->create('Team');?>
<fieldset>
 		<legend></legend>
	<?php
	echo $this->Form->input('id');
	
	echo $this->Form->input('Invitation.user_id');
	
	?>
</fieldset>
				
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"><?php echo $this->Form->end(__('Submit', true));?>  </p></div>
        
		<p style="clear: both;">  </p>
	</div>
</div>


 <div class="PostBox">
    <div class="ThreadTitleBox">
        <div class="ThreadTitleContent">
            <h3><?php echo 'List of Teammembers';?></h3>
        </div> 
        <div class="bottomaction">
         </div> 
         <p style="clear: both;"></p>  
    </div>
    </div>


<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			
				<table cellpadding="0" cellspacing="0">
	<tr>
    		<th><?php echo ('Username');?></th>
			<th><?php echo ('');?></th>
			
	</tr>
	<?php
	$i = 0;
	foreach ($members as $member):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
    	<td width="75%"><?php echo $member['User']['username'];?></td>
		<td><?php echo $this->Html->link('Kick Teammember',array('action'=>'kick_member',$team_id,$member['User']['id']));?></td>
		
		
		
	</tr>
<?php endforeach; ?>
	</table>
			
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottompages">  
        	
        </div>
        <div class="bottomaction">
		
    </div>
		<p style="clear: both;">  </p>
	</div>
</div>	

	