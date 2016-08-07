<div class="doctorPlanDetails index">
	<h2><?php echo __('Doctor Plan Details'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('package_key'); ?></th>
			<th><?php echo $this->Paginator->sort('start_date'); ?></th>
			<th><?php echo $this->Paginator->sort('end_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($doctorPlanDetails as $doctorPlanDetail): ?>
	<tr>
		<td><?php echo h($doctorPlanDetail['DoctorPlanDetail']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($doctorPlanDetail['User']['id'], array('controller' => 'users', 'action' => 'view', $doctorPlanDetail['User']['id'])); ?>
		</td>
		<td><?php echo h($doctorPlanDetail['DoctorPlanDetail']['package_key']); ?>&nbsp;</td>
		<td><?php echo h($doctorPlanDetail['DoctorPlanDetail']['start_date']); ?>&nbsp;</td>
		<td><?php echo h($doctorPlanDetail['DoctorPlanDetail']['end_date']); ?>&nbsp;</td>
		<td><?php echo h($doctorPlanDetail['DoctorPlanDetail']['created']); ?>&nbsp;</td>
		<td><?php echo h($doctorPlanDetail['DoctorPlanDetail']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $doctorPlanDetail['DoctorPlanDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $doctorPlanDetail['DoctorPlanDetail']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $doctorPlanDetail['DoctorPlanDetail']['id']), null, __('Are you sure you want to delete # %s?', $doctorPlanDetail['DoctorPlanDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Doctor Plan Detail'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
