<div class="patientPlanDetails view">
<h2><?php echo __('Patient Plan Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($patientPlanDetail['PatientPlanDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($patientPlanDetail['User']['id'], array('controller' => 'users', 'action' => 'view', $patientPlanDetail['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Package Key'); ?></dt>
		<dd>
			<?php echo h($patientPlanDetail['PatientPlanDetail']['package_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service'); ?></dt>
		<dd>
			<?php echo $this->Html->link($patientPlanDetail['Service']['title'], array('controller' => 'services', 'action' => 'view', $patientPlanDetail['Service']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($patientPlanDetail['PatientPlanDetail']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($patientPlanDetail['PatientPlanDetail']['end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($patientPlanDetail['PatientPlanDetail']['is_active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($patientPlanDetail['PatientPlanDetail']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($patientPlanDetail['PatientPlanDetail']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Patient Plan Detail'), array('action' => 'edit', $patientPlanDetail['PatientPlanDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Patient Plan Detail'), array('action' => 'delete', $patientPlanDetail['PatientPlanDetail']['id']), null, __('Are you sure you want to delete # %s?', $patientPlanDetail['PatientPlanDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Plan Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient Plan Detail'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
