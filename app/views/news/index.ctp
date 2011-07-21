<div class="news index">
	<div class="PostBox">
    <div class="ThreadTitleBox">
        <div class="ThreadTitleContent">
           <h2><?php Configure::load('caketourney_configuration'); echo (Configure::read('Caketourney.company_name_long').' News');?></h2>
        </div> 
        <div class="bottomaction">
         </div> 
         <p style="clear: both;"></p>  
    </div>
    </div>
	
    
    
    <?php foreach ($news as $newspost)
	{?>
    <div class="PostBox">
    <div class="ThreadTitleBox">
        <div class="ThreadTitleContent">
            <h3><?php echo ($newspost['News']['title']);?></h3>
        </div> 
        <div class="bottomaction">
         </div> 
         <p style="clear: both;"></p>  
    </div>
    </div>
	<div class="PostBox"> 
		<div class="PostContent">
			<div class="leftBox">
				<div class="PostUserContentBox">
					<div class="PostMainContentbox">
                    <?php  if($newspost['User']['avatar_name']=='default'){
						echo $this->Html->image('avatar_l.png', array('width' => '125'));
					}
					else{
						echo $this->Html->image('/img/avatar/'.$newspost['User']['avatar_name'], array('width' => '125', 'height' => '125'));
					}?> 
					<?php //debug($post);
						if ($newspost['User']['admin']==true)
						{
							?><div class="admin"> <?php echo($this->Html->link($newspost['User']['username'], array('controller' => 'users', 'action' => 'view', $newspost['User']['id']))); ?> 
							<br>
							<small><?php echo ($newspost['News']['date_posted']);?></small>
							</div> <?php
						}
						else
						{
							echo($this->Html->link($newspost['User']['username'], array('controller' => 'users', 'action' => 'view', $newspost['User']['id'])));
							?>	<br>
							<small><?php echo ($newspost['News']['date_posted']);?></small><?php
						}
					?>
                    
					
					</div>
				</div>
			</div>
			<div class="rightBox">
				<div class="PostContentBox">
					<div class="PostMainContentbox">
					
					<?php
						$body = $this->Bbcode->doshortcode(strip_tags($newspost['News']['body']));
						echo ( $this->Text->autoLink($body));
						$edit_reason = $this->Bbcode->doshortcode(strip_tags($newspost['News']['edit_reason']));
						echo ( $this->Text->autoLink($edit_reason));?>
					</div>
				</div>
			</div>
			<p style="clear: both;">  </p>
		</div>
								
		<div class="PostFooter">
			<div class="bottomaction">
				<?php
						if ($this->Session->read('Auth.User.admin') )
						{
							
							echo $this->Html->link('Delete', array('action' => 'delete', $newspost['News']['id']), null, sprintf(__('Are you sure you want to delete this Post?', true)));
						}?>
	
			</div>
			<div class="bottomaction"> <?php
					if ($this->Session->read('Auth.User.admin') )
					{
						echo($this->Html->link('Edit', array('action' => 'edit', $newspost['News']['id'])));
						
					}?>
			</div>
			<p style="clear: both;">  </p>
		</div>
	</div>
	<?php
	}?>
    
    
    
<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="bottompages">  
        	<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	  	 | 	<?php echo $this->Paginator->numbers();?> |
			<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    </div>
            <div class="bottomaction", style="padding:0 8px"> <?php
        echo $this->Paginator->counter(array(
        'format' => __('Page %page% of %pages%, showing %current% posts out of %count% total', true)
        ));
        ?>	
         </div> 

   <p style="clear: both;">  </p>
</div>
</div>


	<?php if ($this->Session->read('Auth.User.admin'))
	{?>
    
    <div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<?php echo $this->Form->create('News',array('action'=>'add'));?>
                    <fieldset>
                        <legend><?php __('Post News'); ?></legend>
                    <?php
                        echo $this->Form->input('title');
                        echo $this->Form->input('body');
                    ?>
                        BBCode is enabled<br>
                        Embedding images is disabled
                    </fieldset>
				
				
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"> <?php echo $this->Form->end(__('Submit', true));?>   </p></div>
       <div class="bottomaction"> <?php echo $this->Html->link('BBCode Help',array('controller'=>'pages','action'=>'bbcode'));?>   </p></div>
		<p style="clear: both;">  </p>
	</div>
	</div>

	<?php }?>	
	
	
	
	
</div>