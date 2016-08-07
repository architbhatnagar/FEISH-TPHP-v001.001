<div class="identityTypes view">
<h2><?php echo __('Identity Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($identityType['IdentityType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($identityType['IdentityType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($identityType['IdentityType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($identityType['IdentityType']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Identity Type'), array('action' => 'edit', $identityType['IdentityType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Identity Type'), array('action' => 'delete', $identityType['IdentityType']['id']), null, __('Are you sure you want to delete # %s?', $identityType['IdentityType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Identity Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Identity Type'), array('action' => 'add')); ?> </li>
	</ul>
</div>
