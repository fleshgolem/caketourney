<div class="tournaments view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php  echo ($name);?>: Sign Ups</h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox">
<div class="ThreadTitleBox">
	
	<div class="bottomaction"> <?php
		if ($this->Session->read('Auth.User.admin')){
			echo $this->Html->link(__('Edit', true), array('action' => 'edit', $tournament['Tournament']['id']));
		}?>
     </div>
     <div class="bottomaction"> <?php
		if ($this->Session->read('Auth.User.admin')){
			echo $this->Html->link(__('Delete', true), array('action' => 'delete', $tournament['Tournament']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tournament['Tournament']['id']));
		}?>
     </div>
     <div class="bottomaction"> <?php
		if ($this->Session->read('Auth.User.admin')){
			if ( $tournament['Tournament']['current_round']==NULL)
					echo $this->Html->link(__('Start', true), array('action' => 'start', $tournament['Tournament']['id'])); 
		}?>
     </div>
	<p style="clear: both;">  </p>  
</div>
</div>

	<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			

<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Username</th>
            <th>Battle.net Name</th>
            <th>Battle.net Code</th>
            <th>Race</th>
            <th>Elo</th>
            <th>Division</th>
	</tr>
	<?php
	$i = 0;
	foreach ($signups as $signup):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo ($this->Html->link(__($signup['User']['username'], true), array('controller' => 'users', 'action' => 'view', $signup['User']['id']))); ?> &nbsp;</td>
		<td><?php echo ($signup['User']['bnetaccount']); ?> &nbsp;</td>
        <td><?php echo ($signup['User']['bnetcode']); ?> &nbsp;</td>
		<td><?php echo $this->Race->small_img($signup['User']['race']); ?>&nbsp;</td>
		<td><?php echo $signup['User']['elo']; ?>&nbsp;</td>
		<td><?php echo $signup['User']['division']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>



			
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottomaction"> 
		<?php if(empty($signed_up)){
			echo $this->Html->link('Sign me Up', array('action' => 'sign_up',$id)); 	
		}
		else
		{
			echo $this->Html->link('Unsign me', array('action' => 'unsign',$id)); 
		}
		?></div>
		<p style="clear: both;">  </p>
	</div>
</div>
	
</div>
	