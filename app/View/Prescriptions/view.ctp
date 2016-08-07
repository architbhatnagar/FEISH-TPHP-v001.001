<div class="prescriptions view">
<h2><?php echo __('Prescription'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($prescription['Prescription']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Observation'); ?></dt>
		<dd>
			<?php echo h($prescription['Prescription']['observation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Diagnosis'); ?></dt>
		<dd>
			<?php echo h($prescription['Prescription']['diagnosis']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prescription'); ?></dt>
		<dd>
			<?php echo h($prescription['Prescription']['prescription']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Appointment'); ?></dt>
		<dd>
			<?php echo $this->Html->link($prescription['Appointment']['id'], array('controller' => 'appointments', 'action' => 'view', $prescription['Appointment']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Doctor By'); ?></dt>
		<dd>
			<?php echo h($prescription['Prescription']['doctor_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Patient To'); ?></dt>
		<dd>
			<?php echo h($prescription['Prescription']['patient_to']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Viewed'); ?></dt>
		<dd>
			<?php echo h($prescription['Prescription']['is_viewed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($prescription['Prescription']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($prescription['Prescription']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Prescription'), array('action' => 'edit', $prescription['Prescription']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Prescription'), array('action' => 'delete', $prescription['Prescription']['id']), null, __('Are you sure you want to delete # %s?', $prescription['Prescription']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Prescriptions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prescription'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('controller' => 'appointments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment'), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
	</ul>
</div>
