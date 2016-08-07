<div class="doctorAccountDetails view">
<h2><?php echo __('Doctor Account Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($doctorAccountDetail['DoctorAccountDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Amount'); ?></dt>
		<dd>
			<?php echo h($doctorAccountDetail['DoctorAccountDetail']['transaction_amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($doctorAccountDetail['User']['id'], array('controller' => 'users', 'action' => 'view', $doctorAccountDetail['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($doctorAccountDetail['DoctorAccountDetail']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Name'); ?></dt>
		<dd>
			<?php echo h($doctorAccountDetail['DoctorAccountDetail']['transaction_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Type'); ?></dt>
		<dd>
			<?php echo h($doctorAccountDetail['DoctorAccountDetail']['transaction_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Key'); ?></dt>
		<dd>
			<?php echo h($doctorAccountDetail['DoctorAccountDetail']['transaction_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Invoice Number'); ?></dt>
		<dd>
			<?php echo h($doctorAccountDetail['DoctorAccountDetail']['invoice_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($doctorAccountDetail['DoctorAccountDetail']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($doctorAccountDetail['DoctorAccountDetail']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Doctor Account Detail'), array('action' => 'edit', $doctorAccountDetail['DoctorAccountDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Doctor Account Detail'), array('action' => 'delete', $doctorAccountDetail['DoctorAccountDetail']['id']), null, __('Are you sure you want to delete # %s?', $doctorAccountDetail['DoctorAccountDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Doctor Account Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Doctor Account Detail'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
