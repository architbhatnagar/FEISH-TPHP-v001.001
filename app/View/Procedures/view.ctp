<div class="procedures view">
<h2><?php echo __('Procedure'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($procedure['Procedure']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($procedure['Procedure']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($procedure['Procedure']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($procedure['Procedure']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Procedure'), array('action' => 'edit', $procedure['Procedure']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Procedure'), array('action' => 'delete', $procedure['Procedure']['id']), null, __('Are you sure you want to delete # %s?', $procedure['Procedure']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Procedures'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Procedure'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Treatment Histories'), array('controller' => 'treatment_histories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treatment History'), array('controller' => 'treatment_histories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Treatment Histories'); ?></h3>
	<?php if (!empty($procedure['TreatmentHistory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Parent Treatment'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Start Date'); ?></th>
		<th><?php echo __('End Date'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Appointment Id'); ?></th>
		<th><?php echo __('Procedure Id'); ?></th>
		<th><?php echo __('Is Cured'); ?></th>
		<th><?php echo __('Is Running'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Reason'); ?></th>
		<th><?php echo __('Show Status'); ?></th>
		<th><?php echo __('Visibility'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($procedure['TreatmentHistory'] as $treatmentHistory): ?>
		<tr>
			<td><?php echo $treatmentHistory['id']; ?></td>
			<td><?php echo $treatmentHistory['name']; ?></td>
			<td><?php echo $treatmentHistory['parent_treatment']; ?></td>
			<td><?php echo $treatmentHistory['description']; ?></td>
			<td><?php echo $treatmentHistory['start_date']; ?></td>
			<td><?php echo $treatmentHistory['end_date']; ?></td>
			<td><?php echo $treatmentHistory['user_id']; ?></td>
			<td><?php echo $treatmentHistory['appointment_id']; ?></td>
			<td><?php echo $treatmentHistory['procedure_id']; ?></td>
			<td><?php echo $treatmentHistory['is_cured']; ?></td>
			<td><?php echo $treatmentHistory['is_running']; ?></td>
			<td><?php echo $treatmentHistory['status']; ?></td>
			<td><?php echo $treatmentHistory['reason']; ?></td>
			<td><?php echo $treatmentHistory['show_status']; ?></td>
			<td><?php echo $treatmentHistory['visibility']; ?></td>
			<td><?php echo $treatmentHistory['created']; ?></td>
			<td><?php echo $treatmentHistory['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'treatment_histories', 'action' => 'view', $treatmentHistory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'treatment_histories', 'action' => 'edit', $treatmentHistory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'treatment_histories', 'action' => 'delete', $treatmentHistory['id']), null, __('Are you sure you want to delete # %s?', $treatmentHistory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Treatment History'), array('controller' => 'treatment_histories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
