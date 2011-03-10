<div class="matches view">
<?php 

//Show Report page, if user participates
if($report)
{
	echo("testest");
}?>
<h2><?php echo ($this->Race->replace($match['Player1']['race']).' '. $match['Player1']['name'] .' VS '.$match['Player2']['name'].' '.$this->Race->replace($match['Player2']['race']));?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Round'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($match['Round']['number']+1); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tournament'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($match['Round']['Tournament']['name'], array('controller' => 'tournaments', 'action' => 'view', $match['Round']['Tournament']['id'])); ?>
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
			<?php echo ($this->Race->replace($match['Player1']['race']).' '. $match['Player1']['name'].' '.$match['Match']['player1_score'])?>
		</div>
		<div align="right">
			<?php echo ($match['Match']['player2_score'].' '. $match['Player2']['name'].' '.$this->Race->replace($match['Player2']['race']))?>
		</div>
	</div>
	<?php
	}?>
</div>
