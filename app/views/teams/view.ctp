<div class="teams view">




<h2><?php  __('Team');?></h2>
<?php echo $this->Html->link(__('View', true), array('action' => 'view', $team['Team']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $team['Team']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $team['Team']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $team['Team']['id'])); ?>	

	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Leader'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($team['Leader']['username'], array('controller' => 'users', 'action' => 'view', $team['Leader']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Team Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['team_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Logo Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['logo_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Logo Size'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['logo_size']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Logo Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['logo_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $team['Team']['date_created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<?php 
if($in_team)
{
	echo $this->Html->link('Get me out of this n00b Team!!',array('action'=>'leave',$team['Team']['id']));
}?>
