<div class="patientHabits index">
	<h2><?php echo __('Patient Habits'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('habit_id'); ?></th>
			<th><?php echo $this->Paginator->sort('frequency'); ?></th>
			<th><?php echo $this->Paginator->sort('unit'); ?></th>
			<th><?php echo $this->Paginator->sort('time_period'); ?></th>
			<th><?php echo $this->Paginator->sort('habit_since'); ?></th>
			<th><?php echo $this->Paginator->sort('is_stopped'); ?></th>
			<th><?php echo $this->Paginator->sort('stopped_date'); ?></th>
			<th><?php echo $this->Paginator->sort('added_by'); ?></th>
			<th><?php echo $this->Paginator->sort('last_updated_by'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($patientHabits as $patientHabit): ?>
	<tr>
		<td><?php echo h($patientHabit['PatientHabit']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($patientHabit['User']['id'], array('controller' => 'users', 'action' => 'view', $patientHabit['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($patientHabit['Habit']['id'], array('controller' => 'habits', 'action' => 'view', $patientHabit['Habit']['id'])); ?>
		</td>
		<td><?php echo h($patientHabit['PatientHabit']['frequency']); ?>&nbsp;</td>
		<td><?php echo h($patientHabit['PatientHabit']['unit']); ?>&nbsp;</td>
		<td><?php echo h($patientHabit['PatientHabit']['time_period']); ?>&nbsp;</td>
		<td><?php echo h($patientHabit['PatientHabit']['habit_since']); ?>&nbsp;</td>
		<td><?php echo h($patientHabit['PatientHabit']['is_stopped']); ?>&nbsp;</td>
		<td><?php echo h($patientHabit['PatientHabit']['stopped_date']); ?>&nbsp;</td>
		<td><?php echo h($patientHabit['PatientHabit']['added_by']); ?>&nbsp;</td>
		<td><?php echo h($patientHabit['PatientHabit']['last_updated_by']); ?>&nbsp;</td>
		<td><?php echo h($patientHabit['PatientHabit']['created']); ?>&nbsp;</td>
		<td><?php echo h($patientHabit['PatientHabit']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $patientHabit['PatientHabit']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $patientHabit['PatientHabit']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $patientHabit['PatientHabit']['id']), null, __('Are you sure you want to delete # %s?', $patientHabit['PatientHabit']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Patient Habit'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Habits'), array('controller' => 'habits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Habit'), array('controller' => 'habits', 'action' => 'add')); ?> </li>
	</ul>
</div>
