<div class="tournaments index">
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Tournaments');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('Type','typeField');?></th>
			<th><?php echo $this->Paginator->sort('current_round');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($tournaments as $tournament):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $tournament['Tournament']['id']; ?>&nbsp;</td>
		<td><?php echo $this->Html->link(__($tournament['Tournament']['name'], true), array('action' => 'view', $tournament['Tournament']['id'])); ?>&nbsp;</td>
		<td><?php echo $tournament['Tournament']['typeField']; ?>&nbsp;</td>
		<td><?php 
			if ( $tournament['Tournament']['current_round']==-1)
				echo ('Sign Ups open');
			else
				echo ($tournament['Tournament']['current_round']); 
			?>&nbsp;
		</td>
		<td class="actions">
			
			<?php 
			//Only show edit and delete if admin
			if ($this->Session->read('Auth.User.admin')) 
			{
				echo $this->Html->link(__('Edit', true), array('action' => 'edit', $tournament['Tournament']['id'])); 
				echo $this->Html->link(__('Delete', true), array('action' => 'delete', $tournament['Tournament']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tournament['Tournament']['id'])); 
				if ( $tournament['Tournament']['current_round']==-1)
					echo $this->Html->link(__('Start', true), array('action' => 'start', $tournament['Tournament']['id'])); 
			}?>
		</td>
		
	</tr>
<?php endforeach; ?>
	</table>
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottomaction">
        <?php if ($this->Session->read('Auth.User.admin')){ 
			echo $this->Html->link(__('New Tournament', true), array('controller' => 'tournaments','action' => 'add')); 
		}?> 
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

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
