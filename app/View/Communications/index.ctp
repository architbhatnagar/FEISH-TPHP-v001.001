<div class="communications index">
	<h2><?php echo __('Communications'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('message'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('is_viewed'); ?></th>
			<th><?php echo $this->Paginator->sort('is_attachment'); ?></th>
			<th><?php echo $this->Paginator->sort('service_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('replied_user_key'); ?></th>
			<th><?php echo $this->Paginator->sort('created_date'); ?></th>
			<th><?php echo $this->Paginator->sort('replied_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($communications as $communication): ?>
	<tr>
		<td><?php echo h($communication['Communication']['id']); ?>&nbsp;</td>
		<td><?php echo h($communication['Communication']['message']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($communication['ParentCommunication']['id'], array('controller' => 'communications', 'action' => 'view', $communication['ParentCommunication']['id'])); ?>
		</td>
		<td><?php echo h($communication['Communication']['is_viewed']); ?>&nbsp;</td>
		<td><?php echo h($communication['Communication']['is_attachment']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($communication['Service']['title'], array('controller' => 'services', 'action' => 'view', $communication['Service']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($communication['User']['id'], array('controller' => 'users', 'action' => 'view', $communication['User']['id'])); ?>
		</td>
		<td><?php echo h($communication['Communication']['replied_user_key']); ?>&nbsp;</td>
		<td><?php echo h($communication['Communication']['created_date']); ?>&nbsp;</td>
		<td><?php echo h($communication['Communication']['replied_date']); ?>&nbsp;</td>
		<td><?php echo h($communication['Communication']['created']); ?>&nbsp;</td>
		<td><?php echo h($communication['Communication']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $communication['Communication']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $communication['Communication']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $communication['Communication']['id']), null, __('Are you sure you want to delete # %s?', $communication['Communication']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Communication'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Communications'), array('controller' => 'communications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Communication'), array('controller' => 'communications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
