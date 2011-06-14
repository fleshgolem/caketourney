<div class="tournaments index">

	
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
			
			<th><?php echo $this->Paginator->sort('recipient_id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			
            <th><?php echo $this->Paginator->sort('date');?></th>
	</tr>
	<?php
	
	foreach ($outbox as $outbox):
		
	?>
	<tr>
		
		<td><?php  
		if ( !$outbox['Message']['sender_id']){
					?><div class="admin"> <a href="">Overmind</a>
						
						</div> <?php
				}
				else{
					if ($outbox['Recipient']['admin']==true)
					{
						?><div class="admin"> <?php echo $this->Html->link($outbox['Recipient']['username'], array('controller' => 'users', 'action' => 'view', $outbox['Recipient']['id'])); ?> 
						
						</div> <?php
					}
					else
					{
						echo $this->Html->link($outbox['Recipient']['username'], array('controller' => 'users', 'action' => 'view', $outbox['Recipient']['id']));
						?>	<?php
					}
				}
		 ?> &nbsp;</td>
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
