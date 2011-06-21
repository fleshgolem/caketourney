<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php echo $current_user['User']['name']; ?>'s Account Settings</h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>



<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php 
				echo $this->Form->create(array('action' => 'account'));
				echo $this->Form->input('password_old',     array('label' => 'Old password', 'type' => 'password', 'autocomplete' => 'off'));
				echo $this->Form->input('password_confirm', array('label' => 'New password', 'type' => 'password', 'autocomplete' => 'off'));
				echo $this->Form->input('password',         array('label' => 'Re-enter new password', 'type' => 'password', 'autocomplete' => 'off'));
				echo $this->Form->input('bnetaccount', array('label' => 'Battle.net Account', 'default' => $current_user['User']['bnetaccount']));
				echo $this->Form->input('bnetcode', array('label' => 'Battle.net Character Code', 'default' => $current_user['User']['bnetcode']));
				echo $this->Form->input('race', array('options' => array("Terran","Protoss","Zerg","Random",), 'selected' => $current_user['User']['race']));
				
				echo $this->Form->input('subscribe_own_comments', array('label' => 'Subscribe to comments of my matches'));
				echo $this->Form->input('subscribe_own_posts', array('label' => 'Subscribe to threads I posted in'));
				echo $this->Form->input('subscribe_tournaments', array('label' => 'Subscribe to newly added tournaments'));
				?>
                <fieldset>
                    <disclaimer>By checking the following box, you allow us to send you emails. We will only send you emails of your subscribtions and news.</disclaimer>
                    </fieldset>
                    <?php echo $this->Form->input('email_subscriptions', array('label' => 'Email my Subscriptions'));?>
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottomaction"> <?php echo $this->Form->end('Update');?> </div>
         <div class="bottomaction"> <?php
		 
				 
				echo $this->Html->link(__('Upload Avatar', true), array('action' => 'upload_avatar')); 
		 
		?>
     </div>
		<p style="clear: both;">  </p>
	</div>
</div>