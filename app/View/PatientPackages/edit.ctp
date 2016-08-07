<div class="patientPackages form">
<?php echo $this->Form->create('PatientPackage'); ?>
	<fieldset>
		<legend><?php echo __('Edit Patient Package'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('plan_details');
		echo $this->Form->input('price');
		echo $this->Form->input('valid_visits');
		echo $this->Form->input('validity');
		echo $this->Form->input('service_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('is_deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PatientPackage.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PatientPackage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Patient Packages'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
