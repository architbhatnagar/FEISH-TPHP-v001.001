<div class="servicesWorkingTimings index">
	<h2><?php echo __('Services Working Timings'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('day_of_week'); ?></th>
			<th><?php echo $this->Paginator->sort('open_time'); ?></th>
			<th><?php echo $this->Paginator->sort('close_time'); ?></th>
			<th><?php echo $this->Paginator->sort('service_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($servicesWorkingTimings as $servicesWorkingTiming): ?>
	<tr>
		<td><?php echo h($servicesWorkingTiming['ServicesWorkingTiming']['id']); ?>&nbsp;</td>
		<td><?php echo h($servicesWorkingTiming['ServicesWorkingTiming']['day_of_week']); ?>&nbsp;</td>
		<td><?php echo h($servicesWorkingTiming['ServicesWorkingTiming']['open_time']); ?>&nbsp;</td>
		<td><?php echo h($servicesWorkingTiming['ServicesWorkingTiming']['close_time']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($servicesWorkingTiming['Service']['title'], array('controller' => 'services', 'action' => 'view', $servicesWorkingTiming['Service']['id'])); ?>
		</td>
		<td><?php echo h($servicesWorkingTiming['ServicesWorkingTiming']['created']); ?>&nbsp;</td>
		<td><?php echo h($servicesWorkingTiming['ServicesWorkingTiming']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $servicesWorkingTiming['ServicesWorkingTiming']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $servicesWorkingTiming['ServicesWorkingTiming']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $servicesWorkingTiming['ServicesWorkingTiming']['id']), null, __('Are you sure you want to delete # %s?', $servicesWorkingTiming['ServicesWorkingTiming']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Services Working Timing'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
