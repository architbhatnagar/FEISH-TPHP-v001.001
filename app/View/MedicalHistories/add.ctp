<div class="medicalHistories form">
<?php echo $this->Form->create('MedicalHistory'); ?>
	<fieldset>
		<legend><?php echo __('Add Medical History'); ?></legend>
	<?php
		echo $this->Form->input('conditions');
		echo $this->Form->input('condition_type');
		echo $this->Form->input('current_medication');
		echo $this->Form->input('description');
		echo $this->Form->input('date');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Medical Histories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
