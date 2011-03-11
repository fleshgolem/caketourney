<div class="tournaments form">
<h2>New Tournament</h2>

Select Type:
<ul>
<li><?php echo $this->Html->link(__('Random KO Tournament', true), array('controller'=>'KOTournaments','action' => 'add_random')); ?><br>
<li><?php echo $this->Html->link(__('Seeded KO Tournament', true), array('controller'=>'KOTournaments','action' => 'add_seeded')); ?>
</ul>
</div>