<div class="threads index">
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Forum');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<p>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('title');?></th>
			
			<th><?php echo $this->Paginator->sort('original_poster_id');?></th>
			<th>Replies</th>
			<th><?php echo $this->Paginator->sort('Last Post','date_modified');?></th>
			
	</tr>
	<?php
	$i = 0;
	foreach ($threads as $thread):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td width="50%"><?php echo $this->Html->link(__($thread['Thread']['title'], true), array('action' => 'view', $thread['Thread']['id'])); ?></td>
		<td>
        	<?php //debug($post);
				if ($thread['OriginalPoster']['admin']==true)
				{
					?><div class="admin"> <?php echo $this->Html->link($thread['OriginalPoster']['username'], array('controller' => 'users', 'action' => 'view', $thread['LastPoster']['id'])); ?> 
					
					</div> <?php
				}
				else
				{
					echo $this->Html->link($thread['OriginalPoster']['username'], array('controller' => 'users', 'action' => 'view', $thread['LastPoster']['id']));
					?>	
					<?php ?><?php
				}
			?>
					
		</td>
		<td>
			<?php echo (count($thread['Post'])-1);?>
		<td>
			<small>
            <?php //debug($post);
				if ($thread['LastPoster']['admin']==true)
				{
					?><div class="admin"> <?php echo $this->Html->link($thread['LastPoster']['username'], array('controller' => 'users', 'action' => 'view', $thread['LastPoster']['id'])); ?> 
					<br>
					<?php echo $thread['Thread']['date_modified'];?>
					</div> <?php
				}
				else
				{
					echo $this->Html->link($thread['LastPoster']['username'], array('controller' => 'users', 'action' => 'view', $thread['LastPoster']['id']));
					?>	<br>
					<?php echo $thread['Thread']['date_modified'];?><?php
				}
			?>
            
			</small>
		</td>
		
	</tr>
<?php endforeach; ?>
	</table>
			</div>
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
		<?php echo ($this->Html->Link('New Thread', array('action' => 'add')));?>
    </div>
		<p style="clear: both;">  </p>
	</div>
</div>
	
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% threads out of %count% total', true)
	));
	?>	</p>

	
</div>
