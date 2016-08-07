<div class="diseases index">
	<h2><?php echo __('Diseases'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('level'); ?></th>
			<th><?php echo $this->Paginator->sort('end_node'); ?></th>
			<th><?php echo $this->Paginator->sort('is_deleted'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($diseases as $disease): ?>
	<tr>
		<td><?php echo h($disease['Disease']['id']); ?>&nbsp;</td>
		<td><?php echo h($disease['Disease']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($disease['ParentDisease']['name'], array('controller' => 'diseases', 'action' => 'view', $disease['ParentDisease']['id'])); ?>
		</td>
		<td><?php echo h($disease['Disease']['level']); ?>&nbsp;</td>
		<td><?php echo h($disease['Disease']['end_node']); ?>&nbsp;</td>
		<td><?php echo h($disease['Disease']['is_deleted']); ?>&nbsp;</td>
		<td><?php echo h($disease['Disease']['created']); ?>&nbsp;</td>
		<td><?php echo h($disease['Disease']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $disease['Disease']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $disease['Disease']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $disease['Disease']['id']), null, __('Are you sure you want to delete # %s?', $disease['Disease']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Disease'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Diseases'), array('controller' => 'diseases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Disease'), array('controller' => 'diseases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Family Histories'), array('controller' => 'family_histories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Family History'), array('controller' => 'family_histories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Specialties'), array('controller' => 'specialties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Specialty'), array('controller' => 'specialties', 'action' => 'add')); ?> </li>
	</ul>
</div>
