<div class="recentlyViewedServices view">
<h2><?php echo __('Recently Viewed Service'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($recentlyViewedService['RecentlyViewedService']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($recentlyViewedService['User']['id'], array('controller' => 'users', 'action' => 'view', $recentlyViewedService['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service'); ?></dt>
		<dd>
			<?php echo $this->Html->link($recentlyViewedService['Service']['title'], array('controller' => 'services', 'action' => 'view', $recentlyViewedService['Service']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Added Date'); ?></dt>
		<dd>
			<?php echo h($recentlyViewedService['RecentlyViewedService']['added_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($recentlyViewedService['RecentlyViewedService']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($recentlyViewedService['RecentlyViewedService']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Recently Viewed Service'), array('action' => 'edit', $recentlyViewedService['RecentlyViewedService']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Recently Viewed Service'), array('action' => 'delete', $recentlyViewedService['RecentlyViewedService']['id']), null, __('Are you sure you want to delete # %s?', $recentlyViewedService['RecentlyViewedService']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Recently Viewed Services'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recently Viewed Service'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
