<div class="familyHistories form">
<?php echo $this->Form->create('FamilyHistory'); ?>
	<fieldset>
		<legend><?php echo __('Add Family History'); ?></legend>
	<?php
		echo $this->Form->input('member_name');
		echo $this->Form->input('relationship');
		echo $this->Form->input('age');
		echo $this->Form->input('disease_id');
		echo $this->Form->input('current_status');
		echo $this->Form->input('year');
		echo $this->Form->input('description');
		echo $this->Form->input('added_by');
		echo $this->Form->input('updated_by');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Family Histories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Diseases'), array('controller' => 'diseases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Disease'), array('controller' => 'diseases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
