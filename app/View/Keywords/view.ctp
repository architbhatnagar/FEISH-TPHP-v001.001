<div class="keywords view">
<h2><?php echo __('Keyword'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Keyword'), array('action' => 'edit', $keyword['Keyword']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Keyword'), array('action' => 'delete', $keyword['Keyword']['id']), null, __('Are you sure you want to delete # %s?', $keyword['Keyword']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Keywords'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Keyword'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Services'); ?></h3>
	<?php if (!empty($keyword['Service'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Logo'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Locality'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('Pin Code'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Avg Rating'); ?></th>
		<th><?php echo __('Review Count'); ?></th>
		<th><?php echo __('Latitude'); ?></th>
		<th><?php echo __('Longitude'); ?></th>
		<th><?php echo __('Appointment Interval'); ?></th>
		<th><?php echo __('Facebook'); ?></th>
		<th><?php echo __('Google Plus'); ?></th>
		<th><?php echo __('Twitter'); ?></th>
		<th><?php echo __('Doctor Id'); ?></th>
		<th><?php echo __('Parent Specialty Id'); ?></th>
		<th><?php echo __('Specialty Id'); ?></th>
		<th><?php echo __('Disease Id'); ?></th>
		<th><?php echo __('Keyword Id'); ?></th>
		<th><?php echo __('View Counter'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Is Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($keyword['Service'] as $service): ?>
		<tr>
			<td><?php echo $service['id']; ?></td>
			<td><?php echo $service['title']; ?></td>
			<td><?php echo $service['description']; ?></td>
			<td><?php echo $service['logo']; ?></td>
			<td><?php echo $service['address']; ?></td>
			<td><?php echo $service['locality']; ?></td>
			<td><?php echo $service['city']; ?></td>
			<td><?php echo $service['pin_code']; ?></td>
			<td><?php echo $service['phone']; ?></td>
			<td><?php echo $service['avg_rating']; ?></td>
			<td><?php echo $service['review_count']; ?></td>
			<td><?php echo $service['latitude']; ?></td>
			<td><?php echo $service['longitude']; ?></td>
			<td><?php echo $service['appointment_interval']; ?></td>
			<td><?php echo $service['facebook']; ?></td>
			<td><?php echo $service['google_plus']; ?></td>
			<td><?php echo $service['twitter']; ?></td>
			<td><?php echo $service['doctor_id']; ?></td>
			<td><?php echo $service['parent_specialty_id']; ?></td>
			<td><?php echo $service['specialty_id']; ?></td>
			<td><?php echo $service['disease_id']; ?></td>
			<td><?php echo $service['keyword_id']; ?></td>
			<td><?php echo $service['view_counter']; ?></td>
			<td><?php echo $service['created']; ?></td>
			<td><?php echo $service['modified']; ?></td>
			<td><?php echo $service['is_deleted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'services', 'action' => 'view', $service['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'services', 'action' => 'edit', $service['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'services', 'action' => 'delete', $service['id']), null, __('Are you sure you want to delete # %s?', $service['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
