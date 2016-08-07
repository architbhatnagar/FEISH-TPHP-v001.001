<div class="recentlyViewedServices index">
	<h2><?php echo __('Recently Viewed Services'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('service_id'); ?></th>
			<th><?php echo $this->Paginator->sort('added_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recentlyViewedServices as $recentlyViewedService): ?>
	<tr>
		<td><?php echo h($recentlyViewedService['RecentlyViewedService']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($recentlyViewedService['User']['id'], array('controller' => 'users', 'action' => 'view', $recentlyViewedService['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($recentlyViewedService['Service']['title'], array('controller' => 'services', 'action' => 'view', $recentlyViewedService['Service']['id'])); ?>
		</td>
		<td><?php echo h($recentlyViewedService['RecentlyViewedService']['added_date']); ?>&nbsp;</td>
		<td><?php echo h($recentlyViewedService['RecentlyViewedService']['created']); ?>&nbsp;</td>
		<td><?php echo h($recentlyViewedService['RecentlyViewedService']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $recentlyViewedService['RecentlyViewedService']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $recentlyViewedService['RecentlyViewedService']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $recentlyViewedService['RecentlyViewedService']['id']), null, __('Are you sure you want to delete # %s?', $recentlyViewedService['RecentlyViewedService']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Recently Viewed Service'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
