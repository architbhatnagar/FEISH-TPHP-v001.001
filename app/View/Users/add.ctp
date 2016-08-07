<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('salutation');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('sex');
		echo $this->Form->input('mobile');
		echo $this->Form->input('qualification');
		echo $this->Form->input('registration_number');
		echo $this->Form->input('patient_key');
		echo $this->Form->input('avatar');
		echo $this->Form->input('facebook');
		echo $this->Form->input('google_plus');
		echo $this->Form->input('twitter');
		echo $this->Form->input('user_type');
		echo $this->Form->input('ip_address');
		echo $this->Form->input('created_date');
		echo $this->Form->input('modified_date');
		echo $this->Form->input('is_active');
		echo $this->Form->input('is_deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Appointments'), array('controller' => 'appointments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment'), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Communications'), array('controller' => 'communications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Communication'), array('controller' => 'communications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Doctor Account Details'), array('controller' => 'doctor_account_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Doctor Account Detail'), array('controller' => 'doctor_account_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Doctor Assistants'), array('controller' => 'doctor_assistants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Doctor Assistant'), array('controller' => 'doctor_assistants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Doctor Plan Details'), array('controller' => 'doctor_plan_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Doctor Plan Detail'), array('controller' => 'doctor_plan_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Family Histories'), array('controller' => 'family_histories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Family History'), array('controller' => 'family_histories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Login Details'), array('controller' => 'login_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Login Detail'), array('controller' => 'login_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Medical Histories'), array('controller' => 'medical_histories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Medical History'), array('controller' => 'medical_histories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Habits'), array('controller' => 'patient_habits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient Habit'), array('controller' => 'patient_habits', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Package Logs'), array('controller' => 'patient_package_logs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient Package Log'), array('controller' => 'patient_package_logs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Packages'), array('controller' => 'patient_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient Package'), array('controller' => 'patient_packages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Plan Details'), array('controller' => 'patient_plan_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient Plan Detail'), array('controller' => 'patient_plan_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Recently Viewed Services'), array('controller' => 'recently_viewed_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recently Viewed Service'), array('controller' => 'recently_viewed_services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reviews'), array('controller' => 'reviews', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Review'), array('controller' => 'reviews', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Treatment Histories'), array('controller' => 'treatment_histories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treatment History'), array('controller' => 'treatment_histories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vital Signs'), array('controller' => 'vital_signs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vital Sign'), array('controller' => 'vital_signs', 'action' => 'add')); ?> </li>
	</ul>
</div>
