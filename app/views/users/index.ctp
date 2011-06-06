<div class="users index">
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Users');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			
				<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<!--<th><?php echo $this->Paginator->sort('email');?></th>-->
			<th><?php echo $this->Paginator->sort('Battle.net Name', 'bnetaccount');?></th>
			<th><?php echo $this->Paginator->sort('Battle.net Code', 'bnetcode');?></th>
			<th><?php echo $this->Paginator->sort('race');?></th>
			<!--<th><?php echo $this->Paginator->sort('admin');?></th>-->
			<th><?php echo $this->Paginator->sort('elo');?></th>
			<th><?php echo $this->Paginator->sort('division');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $this->Html->link(__($user['User']['username'], true), array('action' => 'view', $user['User']['id'])); ?> &nbsp;</td>
		<td><?php echo $user['User']['name']; ?>&nbsp;</td>
		<!--<td><?php echo $user['User']['email']; ?>&nbsp;</td>-->
		<td><?php echo $user['User']['bnetaccount']; ?>&nbsp;</td>
		<td><?php echo $user['User']['bnetcode']; ?>&nbsp;</td>
		<td><?php echo $this->Race->small_img($user['User']['race']); ?>&nbsp;</td>
		<!--<td><?php echo $user['User']['admin']; ?>&nbsp;</td>-->
		<td><?php echo $user['User']['elo']; ?>&nbsp;</td>
		<td><?php echo $user['User']['division']; ?>&nbsp;</td>
		
	</tr>
<?php endforeach; ?>
	</table>
			
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottompages">  
        	<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	  	 | 	<?php echo $this->Paginator->numbers();?> |
			<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
        </div>
		<p style="clear: both;">  </p>
	</div>
</div>	
	
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%', true)
	));
	?>	</p>

	
</div>
