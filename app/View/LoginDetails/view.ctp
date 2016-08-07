<div class="loginDetails view">
<h2><?php echo __('Login Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($loginDetail['LoginDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($loginDetail['User']['id'], array('controller' => 'users', 'action' => 'view', $loginDetail['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('C Date'); ?></dt>
		<dd>
			<?php echo h($loginDetail['LoginDetail']['c_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ip Address'); ?></dt>
		<dd>
			<?php echo h($loginDetail['LoginDetail']['ip_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($loginDetail['LoginDetail']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($loginDetail['LoginDetail']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Login Detail'), array('action' => 'edit', $loginDetail['LoginDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Login Detail'), array('action' => 'delete', $loginDetail['LoginDetail']['id']), null, __('Are you sure you want to delete # %s?', $loginDetail['LoginDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Login Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Login Detail'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
