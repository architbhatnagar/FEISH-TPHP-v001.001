<div class="treatmentHistories form">
<?php echo $this->Form->create('TreatmentHistory'); ?>
	<fieldset>
		<legend><?php echo __('Edit Treatment History'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('parent_treatment');
		echo $this->Form->input('description');
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
		echo $this->Form->input('user_id');
		echo $this->Form->input('is_cured');
		echo $this->Form->input('is_running');
		echo $this->Form->input('show_status');
		echo $this->Form->input('visibility');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TreatmentHistory.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('TreatmentHistory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Treatment Histories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
