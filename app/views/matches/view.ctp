<div class="matches view">



<h2><?php echo ($this->Race->small_img($match['Player1']['race']).' '. $match['Player1']['name'] .' VS '.$match['Player2']['name'].' '.$this->Race->small_img($match['Player2']['race']));?></h2>
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
	//security disable for testing
	//if($report AND $match['Match']['open'])
	if($match['Match']['open'])
	{
		echo("testest");
	?>
	
	<div class="scores">
		<?php echo $this->Form->create('Match');?>
		<h3>Scores</h3>
		<div class="score1">
			<?php echo ($this->Race->small_img($match['Player1']['race']).' '. $match['Player1']['name'])?>
			<?php echo $this->Form->input('player1_score', array( 'label' => '' ));?>
		</div>
		<div class="score2">
			<?php echo $this->Form->input('player2_score', array( 'label' => '' ));?>
			<?php echo ($match['Player2']['name'].' '.$this->Race->small_img($match['Player2']['race']))?>
		</div>
		<?php echo $this->Form->end(__('Submit', true));?>
	</div>
	<?php
	}
	//show normal page otherwise
	else
	{
	?>
	<div class="scores">
		<h3>Scores</h3>
		<div align="left">
			<?php echo ($this->Race->small_img($match['Player1']['race']).' '. $match['Player1']['name'].' '.$match['Match']['player1_score'])?>
		</div>
		<div align="right">
			<?php echo ($match['Match']['player2_score'].' '. $match['Player2']['name'].' '.$this->Race->small_img($match['Player2']['race']))?>
		</div>
	</div>
	<?php
	}?>
	
	<h3>Comments</h3>
	<?php echo $this->Form->create('Match', array('action'=>'post_comment'));?>
	<?php echo $this->Form->input('Comment.body', array('label'=>'Post Comment'));?>
	<?php echo $this->Form->end(__('Submit', true));?>
	<table>
		<?php
		foreach ($comments as $comment){?>
		<tr>
			<td class="info">
				<?php echo($this->Html->link($comment['User']['username'], array('controller' => 'users', 'action' => 'view', $comment['User']['id']))); ?>
				<br>
				<small>
				<?php echo ($comment['Comment']['date_posted']);?>
				</small>
			</td>
			<td>
				<?php echo ( $this->Text->autoLink($comment['Comment']['body']));?>
			</td>
		</tr>
		<?php }?>
	</table>
</div>
