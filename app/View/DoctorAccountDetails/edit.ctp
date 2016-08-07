<div class="doctorAccountDetails form">
<?php echo $this->Form->create('DoctorAccountDetail'); ?>
	<fieldset>
		<legend><?php echo __('Edit Doctor Account Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('transaction_amount');
		echo $this->Form->input('user_id');
		echo $this->Form->input('date');
		echo $this->Form->input('transaction_name');
		echo $this->Form->input('transaction_type');
		echo $this->Form->input('transaction_key');
		echo $this->Form->input('invoice_number');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('DoctorAccountDetail.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('DoctorAccountDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Doctor Account Details'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
