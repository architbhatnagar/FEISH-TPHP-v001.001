<div class="appointments view">
<h2><?php echo __('Appointment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($appointment['Appointment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Appointed Timing'); ?></dt>
		<dd>
			<?php echo h($appointment['Appointment']['appointed_timing']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($appointment['User']['id'], array('controller' => 'users', 'action' => 'view', $appointment['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service'); ?></dt>
		<dd>
			<?php echo $this->Html->link($appointment['Service']['title'], array('controller' => 'services', 'action' => 'view', $appointment['Service']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Visited'); ?></dt>
		<dd>
			<?php echo h($appointment['Appointment']['is_visited']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($appointment['Appointment']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($appointment['Appointment']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Appointment'), array('action' => 'edit', $appointment['Appointment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Appointment'), array('action' => 'delete', $appointment['Appointment']['id']), null, __('Are you sure you want to delete # %s?', $appointment['Appointment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prescriptions'), array('controller' => 'prescriptions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prescription'), array('controller' => 'prescriptions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Prescriptions'); ?></h3>
	<?php if (!empty($appointment['Prescription'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Observation'); ?></th>
		<th><?php echo __('Diagnosis'); ?></th>
		<th><?php echo __('Prescription'); ?></th>
		<th><?php echo __('Appointment Id'); ?></th>
		<th><?php echo __('Doctor Id'); ?></th>
		<th><?php echo __('Patient Id'); ?></th>
		<th><?php echo __('Is Viewed'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($appointment['Prescription'] as $prescription): ?>
		<tr>
			<td><?php echo $prescription['id']; ?></td>
			<td><?php echo $prescription['observation']; ?></td>
			<td><?php echo $prescription['diagnosis']; ?></td>
			<td><?php echo $prescription['prescription']; ?></td>
			<td><?php echo $prescription['appointment_id']; ?></td>
			<td><?php echo $prescription['doctor_id']; ?></td>
			<td><?php echo $prescription['patient_id']; ?></td>
			<td><?php echo $prescription['is_viewed']; ?></td>
			<td><?php echo $prescription['created']; ?></td>
			<td><?php echo $prescription['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'prescriptions', 'action' => 'view', $prescription['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'prescriptions', 'action' => 'edit', $prescription['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'prescriptions', 'action' => 'delete', $prescription['id']), null, __('Are you sure you want to delete # %s?', $prescription['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Prescription'), array('controller' => 'prescriptions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
