<div class="matches view">

<div class="PostBox">
<div class="ThreadTitleBox">
	<div class="ThreadTitleContent">
		<h2><?php echo ($this->Race->small_img($match['Player1']['race']).' '. $match['Player1']['username'] .' vs '.$match['Player2']['username'].' '.$this->Race->small_img($match['Player2']['race']));?></h2>
	</div> 
	
	<p style="clear: both;">  </p>  
</div>
</div>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Round'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($match['Round']['number']+1); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tournament'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($round['Tournament']['name'], array('controller' => 'tournaments', 'action' => 'view', $round['Tournament']['id'])); ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Best of'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $match['Match']['games']; ?>
			&nbsp;
		</dd>
	
	</dl>
	<?php 

	//Show Report page, if user participates and match is open
	if($report AND $match['Match']['open'])
	//if($match['Match']['open'])
	{
	?>
    <div class="PostBox"> 
        <div class="PostContent">
            <div class="PostContentBox">
                <div class="PostMainContentbox">
                	<fieldset>
                    <?php echo $this->Form->create('Match',array('action'=>'set_date'));?>
                    <legend><?php __('Set Date');?></legend>
                    <?php echo $this->Form->input('id');?>
                    <?php echo $this->Form->input('date');?>
                   	</fieldset>

                </div>
            </div>
            <p style="clear: both;"> </p>
        </div>
        <div class="PostFooter">
            <div class="bottomaction"> <?php echo $this->Form->end(__('Submit', true));?>  </p></div>
           
            <p style="clear: both;">  </p>
        </div>
    </div>
	
    <div class="PostBox"> 
        <div class="PostContent">
            <div class="PostContentBox">
                <div class="PostMainContentbox">
                	<div class="matchbox">
                        <div class="namesbox">
                            <div class="topboxBIG"> <a href=""><?php echo ($this->Race->small_img($match['Player1']['race']).' '. $match['Player1']['username'])?></a> </div>
                            <div class="bottomboxBIG"> <a href=""><?php echo ($this->Race->small_img($match['Player2']['race']).' '.$match['Player2']['username'])?></a> </div>
                        </div>
                        <div class="scorebox">
                            <div class="scoretopBIG"> <a href=""><?php echo $this->Form->input('player1_score', array( 'label' => '' ));?></a> </div>
                            <div class="scorebottomBIG"> <a href=""><?php echo $this->Form->input('player2_score', array( 'label' => '' ));?></a> </div>
                        </div>
                    </div>
                	<fieldset>
                   
		
						<?php echo $this->Form->create('Match');?>
                        <?php echo $this->Form->input('id');?>
                        <legend><?php __('Scores');?></legend>
                        <div class="matchbox">
                        <div class="namesbox">
                            <div class="topboxBIG"> <a href=""><?php echo ($this->Race->small_img($match['Player1']['race']).' '. $match['Player1']['username'])?></a> </div>
                            <div class="bottomboxBIG"> <a href=""><?php echo ($this->Race->small_img($match['Player2']['race']).' '.$match['Player2']['username'])?></a> </div>
                        </div>
                        <div class="scorebox">
                            <div class="scoretopBIG"> <a href=""><?php echo $this->Form->input('player1_score', array( 'label' => '' ));?></a> </div>
                            <div class="scorebottomBIG"> <a href=""><?php echo $this->Form->input('player2_score', array( 'label' => '' ));?></a> </div>
                        </div>
                    </div>
                       
                   
                   	</fieldset>

                </div>
            </div>
            <p style="clear: both;"> </p>
        </div>
        <div class="PostFooter">
            <div class="bottomaction">  <?php echo $this->Form->end(__('Submit', true));?>  </p></div>
           
            <p style="clear: both;">  </p>
        </div>
    </div>
	
	<?php
	}
	//show normal page otherwise
	else
	{
	?>
    <div class="PostBox"> 
        <div class="PostContent">
            <div class="PostContentBox">
                <div class="PostMainContentbox">
                	<div class="matchbox">
                        <div class="namesbox">
                            <div class="topbox"> <a href=""><?php echo ($match['Player1']['username'])?></a> </div>
                            <div class="bottombox"> <a href=""><?php echo ($match['Player2']['username'])?></a> </div>
                        </div>
                        <div class="scorebox">
                            <div class="scoretop"> <a href=""><?php 
								if ($match['Match']['player1_score']!=null)
									echo $match['Match']['player1_score'];
								else
									echo "-";
								?></a> </div>
                            <div class="scorebottom"> <a href=""><?php 
								if ($match['Match']['player2_score']!=null)
									echo $match['Match']['player2_score'];
								else
									echo "-";
								?></a> </div>
                        </div>
                    </div>
                	
                </div>
            </div>
            <p style="clear: both;"> </p>
        </div>
        <div class="PostFooter">
            <div class="bottomaction">   </p></div>
           
            <p style="clear: both;">  </p>
        </div>
    </div>
	<div class="scores">
		<h3>Scores</h3>
		<div align="left">
			<?php echo ($this->Race->small_img($match['Player1']['race']).' '. $match['Player1']['username'].' <strong>'.$match['Match']['player1_score'].'</strong>')?>
		</div>
		<div align="right">
			<?php echo ('<strong>'.$match['Match']['player2_score'].'</strong> '. $match['Player2']['username'].' '.$this->Race->small_img($match['Player2']['race']))?>
		</div>
	</div>
	<?php
	}?>




	<h3>Replays</h3>
	<?php
	//show upload button if allowed
	if($report){?>
	<div class="buttons" align="right">
		<?php echo $this->Html->link('Upload Replays', array('controller'=>'matches', 'action' => 'upload_replays', $match['Match']['id']));?>
	</div>
	<?php }?>
	<?php foreach ($replays as $replay)
	{?>
		<?php echo $this->Html->link( $replay['Replay']['name'], '/files/'.$replay['Replay']['name'] );?>
		<br>
	<?php }?>
	<h3>Comments</h3>

<?php foreach($comments as $comment)
{?>
<div class="PostBox"> 
	<div class="PostContent">
		<div class="leftBox">
			<div class="PostContentBox">
				<div class="PostMainContentbox">

				<?php echo($this->Html->link($comment['User']['username'], array('controller' => 'users', 'action' => 'view', $comment['User']['id']))); ?>
				<br>
				<small>
				<?php echo ($comment['Comment']['date_posted']);?>
				</small>
				</div>
			</div>
		</div>
		<div class="rightBox">
			<div class="PostContentBox">
				<div class="PostMainContentbox">
				
				<?php $body = $this->Bbcode->doShortcode(strip_tags($comment['Comment']['body']));
				echo ( $this->Text->autoLink($body));?>
				</div>
			</div>
		</div>
		<p style="clear: both;">  </p>
	</div>
                            
	<div class="PostFooter">
		<div class="bottomaction">
        	<?php
					if ($this->Session->read('Auth.User.admin') OR $comment['Comment']['user_id']==$current_user)
					{
						
						echo $this->Html->link('Delete', array('controller' => 'comments', 'action' => 'delete', $comment['Comment']['id']), null, sprintf(__('Are you sure you want to delete this Comment?', true)));
					}?>

        </div>
        <div class="bottomaction"> <?php
				if ($this->Session->read('Auth.User.admin') OR $comment['Comment']['user_id']==$current_user)
				{
					echo($this->Html->link('Edit', array('controller' => 'comments', 'action' => 'edit', $comment['Comment']['id'])));
					
				}?>
        </div>
		<p style="clear: both;">  </p>
	</div>
</div>
<?php
}?>
    

<div class="PostBox"> 
	<div class="PostContent">
		<div class="PostContentBox">
			<div class="PostMainContentbox">
				<fieldset>
 				<legend><?php echo $this->Form->create('Match', array('action'=>'post_comment'));?></legend>
				
				<?php echo $this->Form->input('Comment.body', array('label'=>'Post Comment'));?>
				
				BBCode is enabled<br>
				Embedding images is disabled
				</fieldset>
				
				
			</div>
		</div>
		<p style="clear: both;"> </p>
	</div>
	<div class="PostFooter">
    	<div class="bottomaction"> <?php echo $this->Form->end(__('Submit', true));?>   </p></div>
       
		<p style="clear: both;">  </p>
	</div>
</div>

	
	
	
</div>
