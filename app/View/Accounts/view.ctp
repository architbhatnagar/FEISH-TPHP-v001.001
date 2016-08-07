<div class="accounts view">
<h2><?php echo __('Account'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($account['Account']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($account['User']['id'], array('controller' => 'users', 'action' => 'view', $account['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Patient Count'); ?></dt>
		<dd>
			<?php echo h($account['Account']['patient_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Cost'); ?></dt>
		<dd>
			<?php echo h($account['Account']['total_cost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commission'); ?></dt>
		<dd>
			<?php echo h($account['Account']['commission']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dr Income Cost'); ?></dt>
		<dd>
			<?php echo h($account['Account']['dr_income_cost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Invoice Date'); ?></dt>
		<dd>
			<?php echo h($account['Account']['invoice_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paid On'); ?></dt>
		<dd>
			<?php echo h($account['Account']['paid_on']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paid By'); ?></dt>
		<dd>
			<?php echo h($account['Account']['paid_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paid Flag'); ?></dt>
		<dd>
			<?php echo h($account['Account']['paid_flag']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comments'); ?></dt>
		<dd>
			<?php echo h($account['Account']['comments']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($account['Account']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($account['Account']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Account'), array('action' => 'edit', $account['Account']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Account'), array('action' => 'delete', $account['Account']['id']), null, __('Are you sure you want to delete # %s?', $account['Account']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
