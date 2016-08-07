<div class="treatmentPrescriptions form">
<?php echo $this->Form->create('TreatmentPrescription'); ?>
	<fieldset>
		<legend><?php echo __('Edit Treatment Prescription'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('observation');
		echo $this->Form->input('diagnosis');
		echo $this->Form->input('prescription');
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
		echo $this->Form->input('treatment_history_id');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TreatmentPrescription.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('TreatmentPrescription.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Treatment Prescriptions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Treatment Histories'), array('controller' => 'treatment_histories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treatment History'), array('controller' => 'treatment_histories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
