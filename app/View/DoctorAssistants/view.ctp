<div class="doctorAssistants view">
<h2><?php echo __('Doctor Assistant'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($doctorAssistant['DoctorAssistant']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($doctorAssistant['User']['id'], array('controller' => 'users', 'action' => 'view', $doctorAssistant['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service'); ?></dt>
		<dd>
			<?php echo $this->Html->link($doctorAssistant['Service']['title'], array('controller' => 'services', 'action' => 'view', $doctorAssistant['Service']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($doctorAssistant['DoctorAssistant']['is_deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($doctorAssistant['DoctorAssistant']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($doctorAssistant['DoctorAssistant']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Doctor Assistant'), array('action' => 'edit', $doctorAssistant['DoctorAssistant']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Doctor Assistant'), array('action' => 'delete', $doctorAssistant['DoctorAssistant']['id']), null, __('Are you sure you want to delete # %s?', $doctorAssistant['DoctorAssistant']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Doctor Assistants'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Doctor Assistant'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
