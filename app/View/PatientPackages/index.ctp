<div class="patientPackages index">
	<h2><?php echo __('Patient Packages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('plan_details'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('valid_visits'); ?></th>
			<th><?php echo $this->Paginator->sort('validity'); ?></th>
			<th><?php echo $this->Paginator->sort('service_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('is_deleted'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($patientPackages as $patientPackage): ?>
	<tr>
		<td><?php echo h($patientPackage['PatientPackage']['id']); ?>&nbsp;</td>
		<td><?php echo h($patientPackage['PatientPackage']['name']); ?>&nbsp;</td>
		<td><?php echo h($patientPackage['PatientPackage']['plan_details']); ?>&nbsp;</td>
		<td><?php echo h($patientPackage['PatientPackage']['price']); ?>&nbsp;</td>
		<td><?php echo h($patientPackage['PatientPackage']['valid_visits']); ?>&nbsp;</td>
		<td><?php echo h($patientPackage['PatientPackage']['validity']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($patientPackage['Service']['title'], array('controller' => 'services', 'action' => 'view', $patientPackage['Service']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($patientPackage['User']['id'], array('controller' => 'users', 'action' => 'view', $patientPackage['User']['id'])); ?>
		</td>
		<td><?php echo h($patientPackage['PatientPackage']['created']); ?>&nbsp;</td>
		<td><?php echo h($patientPackage['PatientPackage']['modified']); ?>&nbsp;</td>
		<td><?php echo h($patientPackage['PatientPackage']['is_deleted']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $patientPackage['PatientPackage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $patientPackage['PatientPackage']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $patientPackage['PatientPackage']['id']), null, __('Are you sure you want to delete # %s?', $patientPackage['PatientPackage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Patient Package'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
