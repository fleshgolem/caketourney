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
<div class="ThreadTitleBox">
	
	
      <div class="bottomactionleft">
     	<?php 
		echo $this->Html->link('Tournament Statistics', array('action'=>'statistics'));
		?>
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
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('Type','typeField');?></th>
			<th><?php echo $this->Paginator->sort('current_round');?></th>
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
			if ( $tournament['Tournament']['current_round']==NULL)
				echo ('Sign Ups open');
			else{
				if ( $tournament['Tournament']['typeField']=='Swiss')
					echo ($tournament['Tournament']['current_round']);
				else
					echo $tournament['Tournament']['typeField'].'-Type';
			}
			?>&nbsp;
		</td>
		
		
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

	
</div>
