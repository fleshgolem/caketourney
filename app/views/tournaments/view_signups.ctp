<div class="tournaments view">
	<h2><?php  echo ($name);?></h2>
	<h3>Sign Ups</h3>
   
	<p>
	<ul>
	<?php 
	foreach ($signups as $signup){?>
		<li>
		<?php echo ($signup['User']['username']);?>
		</li>
	<?php }?>
	</ul>
	</p>
	<br>
	<p>
	<div class="buttons">
	<?php if(empty($signed_up)){
		echo $this->Html->link('Sign me Up', array('action' => 'sign_up',$id)); 	
	}
	else
	{
		echo $this->Html->link('Unsign me', array('action' => 'unsign',$id)); 
	}
	
	?>
	</div>
	</p>
</div>
	