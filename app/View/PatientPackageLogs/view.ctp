<div class="patientPackageLogs view">
<h2><?php echo __('Patient Package Log'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($patientPackageLog['PatientPackageLog']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purchased Plan Key'); ?></dt>
		<dd>
			<?php echo h($patientPackageLog['PatientPackageLog']['purchased_plan_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purchased Plan Name'); ?></dt>
		<dd>
			<?php echo h($patientPackageLog['PatientPackageLog']['purchased_plan_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($patientPackageLog['PatientPackageLog']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Valid Visits'); ?></dt>
		<dd>
			<?php echo h($patientPackageLog['PatientPackageLog']['valid_visits']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Validity'); ?></dt>
		<dd>
			<?php echo h($patientPackageLog['PatientPackageLog']['validity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Used Visits'); ?></dt>
		<dd>
			<?php echo h($patientPackageLog['PatientPackageLog']['used_visits']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remaining Visits'); ?></dt>
		<dd>
			<?php echo h($patientPackageLog['PatientPackageLog']['remaining_visits']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Package Key'); ?></dt>
		<dd>
			<?php echo h($patientPackageLog['PatientPackageLog']['package_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($patientPackageLog['User']['id'], array('controller' => 'users', 'action' => 'view', $patientPackageLog['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($patientPackageLog['PatientPackageLog']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($patientPackageLog['PatientPackageLog']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Patient Package Log'), array('action' => 'edit', $patientPackageLog['PatientPackageLog']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Patient Package Log'), array('action' => 'delete', $patientPackageLog['PatientPackageLog']['id']), null, __('Are you sure you want to delete # %s?', $patientPackageLog['PatientPackageLog']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Patient Package Logs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient Package Log'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
