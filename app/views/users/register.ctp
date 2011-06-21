<div class="users form">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Registration');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>

<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php
					echo $this->Form->create(array('action' => 'register'));
					echo $this->Form->input('name');
					echo $this->Form->input('email');
					echo $this->Form->input('username');
					echo $this->Form->input('password_confirm', array('label' => 'Password', 'type' => 'password'));
					echo $this->Form->input('password', array('label' => 'Password Confirm'));
					echo $this->Form->input('bnetaccount', array('label' => 'Battle.net Account'));
					echo $this->Form->input('bnetcode', array('label' => 'Battle.net Character Code'));
					echo $this->Form->input('race', array('options' => array("Terran","Protoss","Zerg","Random",)));
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
    	<div class="bottomaction"> <?php echo $this->Form->end('Register'); ?>   </p></div>
       
		<p style="clear: both;">  </p>
	</div>
</div>



</div>