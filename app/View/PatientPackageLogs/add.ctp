<div class="patientPackageLogs form">
<?php echo $this->Form->create('PatientPackageLog'); ?>
	<fieldset>
		<legend><?php echo __('Add Patient Package Log'); ?></legend>
	<?php
		echo $this->Form->input('purchased_plan_key');
		echo $this->Form->input('purchased_plan_name');
		echo $this->Form->input('price');
		echo $this->Form->input('valid_visits');
		echo $this->Form->input('validity');
		echo $this->Form->input('used_visits');
		echo $this->Form->input('remaining_visits');
		echo $this->Form->input('package_key');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Patient Package Logs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
