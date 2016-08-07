<div class="communications form">
<?php echo $this->Form->create('Communication'); ?>
	<fieldset>
		<legend><?php echo __('Edit Communication'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('message');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('is_viewed');
		echo $this->Form->input('is_attachment');
		echo $this->Form->input('service_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('replied_user_key');
		echo $this->Form->input('created_date');
		echo $this->Form->input('replied_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Communication.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Communication.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Communications'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Communications'), array('controller' => 'communications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Communication'), array('controller' => 'communications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
