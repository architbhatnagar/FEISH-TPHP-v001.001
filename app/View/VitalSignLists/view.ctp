<div class="vitalSignLists view">
<h2><?php echo __('Vital Sign List'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($vitalSignList['VitalSignList']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($vitalSignList['VitalSignList']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($vitalSignList['VitalSignList']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($vitalSignList['VitalSignList']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vital Sign List'), array('action' => 'edit', $vitalSignList['VitalSignList']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vital Sign List'), array('action' => 'delete', $vitalSignList['VitalSignList']['id']), null, __('Are you sure you want to delete # %s?', $vitalSignList['VitalSignList']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Vital Sign Lists'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vital Sign List'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vital Signs'), array('controller' => 'vital_signs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vital Sign'), array('controller' => 'vital_signs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vital Units'), array('controller' => 'vital_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vital Unit'), array('controller' => 'vital_units', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Vital Signs'); ?></h3>
	<?php if (!empty($vitalSignList['VitalSign'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Vital Sign List Id'); ?></th>
		<th><?php echo __('Unit Id'); ?></th>
		<th><?php echo __('Max Observation'); ?></th>
		<th><?php echo __('Min Observation'); ?></th>
		<th><?php echo __('Observation'); ?></th>
		<th><?php echo __('Remark'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($vitalSignList['VitalSign'] as $vitalSign): ?>
		<tr>
			<td><?php echo $vitalSign['id']; ?></td>
			<td><?php echo $vitalSign['vital_sign_list_id']; ?></td>
			<td><?php echo $vitalSign['unit_id']; ?></td>
			<td><?php echo $vitalSign['max_observation']; ?></td>
			<td><?php echo $vitalSign['min_observation']; ?></td>
			<td><?php echo $vitalSign['observation']; ?></td>
			<td><?php echo $vitalSign['remark']; ?></td>
			<td><?php echo $vitalSign['user_id']; ?></td>
			<td><?php echo $vitalSign['created']; ?></td>
			<td><?php echo $vitalSign['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'vital_signs', 'action' => 'view', $vitalSign['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'vital_signs', 'action' => 'edit', $vitalSign['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'vital_signs', 'action' => 'delete', $vitalSign['id']), null, __('Are you sure you want to delete # %s?', $vitalSign['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Vital Sign'), array('controller' => 'vital_signs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Vital Units'); ?></h3>
	<?php if (!empty($vitalSignList['VitalUnit'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Vital Sign List Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modiefied'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($vitalSignList['VitalUnit'] as $vitalUnit): ?>
		<tr>
			<td><?php echo $vitalUnit['id']; ?></td>
			<td><?php echo $vitalUnit['name']; ?></td>
			<td><?php echo $vitalUnit['vital_sign_list_id']; ?></td>
			<td><?php echo $vitalUnit['created']; ?></td>
			<td><?php echo $vitalUnit['modiefied']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'vital_units', 'action' => 'view', $vitalUnit['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'vital_units', 'action' => 'edit', $vitalUnit['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'vital_units', 'action' => 'delete', $vitalUnit['id']), null, __('Are you sure you want to delete # %s?', $vitalUnit['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Vital Unit'), array('controller' => 'vital_units', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
