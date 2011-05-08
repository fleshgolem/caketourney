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
				?>
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