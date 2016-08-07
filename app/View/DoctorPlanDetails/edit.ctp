<div class="doctorPlanDetails form">
<?php echo $this->Form->create('DoctorPlanDetail'); ?>
	<fieldset>
		<legend><?php echo __('Edit Doctor Plan Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('package_key');
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('DoctorPlanDetail.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('DoctorPlanDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Doctor Plan Details'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
