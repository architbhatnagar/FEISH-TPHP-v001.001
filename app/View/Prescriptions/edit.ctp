<div class="prescriptions form">
<?php echo $this->Form->create('Prescription'); ?>
	<fieldset>
		<legend><?php echo __('Edit Prescription'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('observation');
		echo $this->Form->input('diagnosis');
		echo $this->Form->input('prescription');
		echo $this->Form->input('appointment_id');
		echo $this->Form->input('doctor_by');
		echo $this->Form->input('patient_to');
		echo $this->Form->input('is_viewed');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Prescription.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Prescription.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Prescriptions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('controller' => 'appointments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment'), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
	</ul>
</div>
