<div class="users index">
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php  echo(Configure::read('__Caketourney.division_2'));?></h2>
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
		<td><?php 
						if ($user['User']['admin']==true)
						{
							?><div class="admin"> <?php echo $this->Html->link(__($user['User']['username'], true), array('action' => 'view', $user['User']['id'])); ?> 
							 <?php
						}
						else
						{
							echo $this->Html->link(__($user['User']['username'], true), array('action' => 'view', $user['User']['id']));
							?><?php
						}
					
		
		?> &nbsp;</td>
		
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
        <div class="bottomaction">
		<?php echo $this->Html->image("find.png", array( "alt" => "find", 'width' => '19', 'height' => '17' ,'url' => array(  'action' => 'find')));?>
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
