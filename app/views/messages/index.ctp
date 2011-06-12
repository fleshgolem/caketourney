<div class="tournaments index">
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Inbox');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			
				<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('sender_id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			
            <th><?php echo $this->Paginator->sort('date');?></th>
	</tr>
	<?php
	
	foreach ($inbox as $inbox):
		
	?>
	<tr>
		<td><?php echo $inbox['Message']['id']; ?>&nbsp;</td>
		<td><?php echo $inbox['Sender']['username']; ?>&nbsp;</td>
		<td><?php 
			if($inbox['Message']['read']==1)
			{?>
				<div class="MessageRead"> 
				<?php echo $this->Html->link(__(($inbox['Message']['title']), true), array('controller' => 'messages', 'action' => 'view',$inbox['Message']['id'])); ?>
                </div>
			<?php }
			else
			{
				echo $this->Html->link(__(($inbox['Message']['title']), true), array('controller' => 'messages', 'action' => 'view',$inbox['Message']['id'])); 
			}
			?>&nbsp;</td>
		
		<td><?php echo $inbox['Message']['date']; ?>&nbsp;</td>
		
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
       
        </div>
		<p style="clear: both;">  </p>
	</div>
</div>	
	
	
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Outbox');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			
				<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('recipient_id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			
            <th><?php echo $this->Paginator->sort('date');?></th>
	</tr>
	<?php
	
	foreach ($outbox as $outbox):
		
	?>
	<tr>
		<td><?php echo $outbox['Message']['id']; ?>&nbsp;</td>
		<td><?php echo $outbox['Recipient']['username']; ?>&nbsp;</td>
        <td><?php 
			if($outbox['Message']['read']==1)
			{?>
				<div class="MessageRead"> 
				<?php echo $this->Html->link(__(($outbox['Message']['title']), true), array('controller' => 'messages', 'action' => 'view',$outbox['Message']['id'])); ?>
                </div>
			<?php }
			else
			{
				echo $this->Html->link(__(($outbox['Message']['title']), true), array('controller' => 'messages', 'action' => 'view',$outbox['Message']['id'])); 
			}
			?>&nbsp;</td>
		
		
		<td><?php echo $outbox['Message']['date']; ?>&nbsp;</td>
		
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
       
        </div>
		<p style="clear: both;">  </p>
	</div>
</div>	
	
</div>
