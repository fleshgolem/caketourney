<div class="news index">
	<div class="PostBox">
    <div class="ThreadTitleBox">
        <div class="ThreadTitleContent">
        
           <h2><?php  echo (Configure::read('__Caketourney.company_name_long').' Settings');?></h2>
        </div> 
        <div class="bottomaction">
         </div> 
         <p style="clear: both;"></p>  
    </div>
    </div>
	
    
<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			
				<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('key');?></th>
			<th><?php echo $this->Paginator->sort('Key Value', 'pair');?></th>
			
            <th><?php echo $this->Paginator->sort('');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($Settings as $Setting):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $Setting['Setting']['key']; ?>&nbsp;</td>
		<td><?php echo $Setting['Setting']['pair']; ?>&nbsp;</td>
		
        <td><?php echo $this->Html->link('Edit',array('action'=>'edit',$Setting['Setting']['id'])) ?>&nbsp;</td>
		
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
        
        <?php if ($this->Session->read('Auth.User.admin')  && (Configure::read("__addsettings")))
		{?>
        <div class="bottomaction"> <?php echo $this->Html->link('Add Setting',array('action'=>'add')) ?> </p></div>
        <?php }?>
        
		<p style="clear: both;">  </p>
	</div>
</div>	


	
	
</div>