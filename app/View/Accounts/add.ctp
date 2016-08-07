<div class="accounts form">
<?php echo $this->Form->create('Account'); ?>
	<fieldset>
		<legend><?php echo __('Add Account'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('patient_count');
		echo $this->Form->input('total_cost');
		echo $this->Form->input('commission');
		echo $this->Form->input('dr_income_cost');
		echo $this->Form->input('invoice_date');
		echo $this->Form->input('paid_on');
		echo $this->Form->input('paid_by');
		echo $this->Form->input('paid_flag');
		echo $this->Form->input('comments');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Accounts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
