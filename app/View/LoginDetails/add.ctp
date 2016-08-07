<div class="loginDetails form">
<?php echo $this->Form->create('LoginDetail'); ?>
	<fieldset>
		<legend><?php echo __('Add Login Detail'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('c_date');
		echo $this->Form->input('ip_address');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Login Details'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
