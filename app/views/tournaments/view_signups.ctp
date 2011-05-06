<div class="tournaments view">
	<h2><?php  echo ($name);?></h2>
	<h3>Sign Ups</h3>
   <?php 
			//Only show edit and delete if admin
			if ($this->Session->read('Auth.User.admin')) 
			{
				echo $this->Html->link(__('Edit', true), array('action' => 'edit', $tournament['Tournament']['id'])); 
				echo $this->Html->link(__('Delete', true), array('action' => 'delete', $tournament['Tournament']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tournament['Tournament']['id'])); 
				if ( $tournament['Tournament']['current_round']==-1)
					echo $this->Html->link(__('Start', true), array('action' => 'start', $tournament['Tournament']['id'])); 
	}?>
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
	