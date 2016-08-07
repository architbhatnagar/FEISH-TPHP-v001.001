<div class="specialties form">
<?php echo $this->Form->create('Specialty'); ?>
	<fieldset>
		<legend><?php echo __('Edit Specialty'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('specialty_name');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('level');
		echo $this->Form->input('end_node');
		echo $this->Form->input('disease_id');
		echo $this->Form->input('is_deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Specialty.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Specialty.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Specialties'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Specialties'), array('controller' => 'specialties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Specialty'), array('controller' => 'specialties', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Diseases'), array('controller' => 'diseases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Disease'), array('controller' => 'diseases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
