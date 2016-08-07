<div class="vitalSigns form">
<?php echo $this->Form->create('VitalSign'); ?>
	<fieldset>
		<legend><?php echo __('Add Vital Sign'); ?></legend>
	<?php
		echo $this->Form->input('vital_sign_list_id');
		echo $this->Form->input('unit_id');
		echo $this->Form->input('max_observation');
		echo $this->Form->input('min_observation');
		echo $this->Form->input('observation');
		echo $this->Form->input('remark');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Vital Signs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vital Sign Lists'), array('controller' => 'vital_sign_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vital Sign List'), array('controller' => 'vital_sign_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>
