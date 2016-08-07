<div class="diseases form">
<?php echo $this->Form->create('Disease'); ?>
	<fieldset>
		<legend><?php echo __('Edit Disease'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('level');
		echo $this->Form->input('end_node');
		echo $this->Form->input('is_deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Disease.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Disease.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Diseases'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Diseases'), array('controller' => 'diseases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Disease'), array('controller' => 'diseases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Family Histories'), array('controller' => 'family_histories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Family History'), array('controller' => 'family_histories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Specialties'), array('controller' => 'specialties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Specialty'), array('controller' => 'specialties', 'action' => 'add')); ?> </li>
	</ul>
</div>
