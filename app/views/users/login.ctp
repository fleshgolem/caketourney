<div class="view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Login');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>

<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php
					echo $this->Form->create(array('action' => 'login'));
					echo $this->Form->input('username');
					echo $this->Form->input('password');
					echo $this->Form->input('auto_login', array('type' => 'checkbox', 'label' => 'Remember me')); ?>			
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"> <?php echo $this->Form->end('Login') ?> <p style="clear: both;">  </p></div>
        <div class="bottomaction"> <a href="register">Register</a> </div>
       
		<p style="clear: both;">  </p>
	</div>
</div>



</div>