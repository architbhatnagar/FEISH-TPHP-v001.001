<div class="habits view">
<h2><?php echo __('Habit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($habit['Habit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Habit Name'); ?></dt>
		<dd>
			<?php echo h($habit['Habit']['habit_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($habit['Habit']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($habit['Habit']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Habit'), array('action' => 'edit', $habit['Habit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Habit'), array('action' => 'delete', $habit['Habit']['id']), null, __('Are you sure you want to delete # %s?', $habit['Habit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Habits'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Habit'), array('action' => 'add')); ?> </li>
	</ul>
</div>
