<div class="labTestResults form">
<?php echo $this->Form->create('LabTestResult'); ?>
	<fieldset>
		<legend><?php echo __('Add Lab Test Result'); ?></legend>
	<?php
		echo $this->Form->input('test_id');
		echo $this->Form->input('test_date');
		echo $this->Form->input('observed_value');
		echo $this->Form->input('report');
		echo $this->Form->input('description');
		echo $this->Form->input('added_by');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Lab Test Results'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Tests'), array('controller' => 'tests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Test'), array('controller' => 'tests', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
