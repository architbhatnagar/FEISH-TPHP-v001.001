<div class="patientHabits view">
<h2><?php echo __('Patient Habit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($patientHabit['PatientHabit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($patientHabit['User']['id'], array('controller' => 'users', 'action' => 'view', $patientHabit['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Habit'); ?></dt>
		<dd>
			<?php echo $this->Html->link($patientHabit['Habit']['id'], array('controller' => 'habits', 'action' => 'view', $patientHabit['Habit']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Frequency'); ?></dt>
		<dd>
			<?php echo h($patientHabit['PatientHabit']['frequency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unit'); ?></dt>
		<dd>
			<?php echo h($patientHabit['PatientHabit']['unit']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time Period'); ?></dt>
		<dd>
			<?php echo h($patientHabit['PatientHabit']['time_period']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Habit Since'); ?></dt>
		<dd>
			<?php echo h($patientHabit['PatientHabit']['habit_since']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Stopped'); ?></dt>
		<dd>
			<?php echo h($patientHabit['PatientHabit']['is_stopped']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stopped Date'); ?></dt>
		<dd>
			<?php echo h($patientHabit['PatientHabit']['stopped_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Added By'); ?></dt>
		<dd>
			<?php echo h($patientHabit['PatientHabit']['added_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Updated By'); ?></dt>
		<dd>
			<?php echo h($patientHabit['PatientHabit']['last_updated_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($patientHabit['PatientHabit']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($patientHabit['PatientHabit']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Patient Habit'), array('action' => 'edit', $patientHabit['PatientHabit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Patient Habit'), array('action' => 'delete', $patientHabit['PatientHabit']['id']), null, __('Are you sure you want to delete # %s?', $patientHabit['PatientHabit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Habits'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient Habit'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Habits'), array('controller' => 'habits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Habit'), array('controller' => 'habits', 'action' => 'add')); ?> </li>
	</ul>
</div>
