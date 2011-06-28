<div class="threads index">
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php __('Search Forum');?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>

<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php
				echo $form->create('Post', array(
					'url' => array_merge(array('action' => 'find'), $this->params['pass'])
					));
				//echo $form->input('title', array('div' => false));
				echo $form->input('body', array('div' => false));
	
?>

			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
		<div class="bottomaction"><?php echo $form->submit(__('Search', true), array('div' => false));
	echo $form->end();?> </div>
        <div class="bottomaction">   </p></div>
		<p style="clear: both;">  </p>
	</div>
</div>


<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			
				<p>
	<table cellpadding="0" cellspacing="0">
	<tr>
    		<th><?php echo $this->Paginator->sort('','icon');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			
			<th><?php echo $this->Paginator->sort('body');?></th>
			<th><?php echo $this->Paginator->sort('Poster','date_modified');?></th>
			
	</tr>
	<?php
	$i = 0;
	foreach ($posts as $post):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
    	<td ><?php if($post['Thread']['icon']!='default' && $post['Thread']['icon']!=null) {echo $this->Html->image('/img/thread/'.$post['Thread']['icon'], array('width' => '25', 'height' => '25')); } ?></td>
		<td width><?php echo $this->Html->link(__($post['Thread']['title'], true), array('controller' => 'threads','action' => 'view', $post['Thread']['id'])); ?></td>
        <td width="50%"><?php $body = $this->Bbcode->doshortcode(strip_tags($post['Post']['body'])); echo ( $this->Text->autoLink($body)); ?> </td>
		
		<td>
			<small>
            <?php //debug($post);
				if ($post['User']['admin']==true)
				{
					?><div class="admin"> <?php echo $this->Html->link($post['User']['username'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?> 
					<br>
					<?php echo $post['Thread']['date_modified'];?>
					</div> <?php
				}
				else
				{
					echo $this->Html->link($post['User']['username'], array('controller' => 'users', 'action' => 'view', $post['User']['id']));
					?>	<br>
					<?php echo $post['Thread']['date_modified'];?><?php
				}
			?>
            
			</small>
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
