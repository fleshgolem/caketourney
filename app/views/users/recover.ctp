<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2>Recover Password</h2>
 	</div> 
	
	<p style="clear: both;">  </p>  
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php
				echo $this->Form->create('User', array('action' => 'recover'));
				echo $this->Form->input('email');
				?>
			</div>
		</div>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"> <?php echo $this->Form->end('Recover') ?> <p style="clear: both;">  </p></div>
		<p style="clear: both;">  </p>
	</div>
</div>