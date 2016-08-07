<div class="patientHabits form">
<?php echo $this->Form->create('PatientHabit'); ?>
	<fieldset>
		<legend><?php echo __('Add Patient Habit'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('habit_id');
		echo $this->Form->input('frequency');
		echo $this->Form->input('unit');
		echo $this->Form->input('time_period');
		echo $this->Form->input('habit_since');
		echo $this->Form->input('is_stopped');
		echo $this->Form->input('stopped_date');
		echo $this->Form->input('added_by');
		echo $this->Form->input('last_updated_by');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Patient Habits'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Habits'), array('controller' => 'habits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Habit'), array('controller' => 'habits', 'action' => 'add')); ?> </li>
	</ul>
</div>
