<div class="specialties view">
<h2><?php echo __('Specialty'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($specialty['Specialty']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Specialty Name'); ?></dt>
		<dd>
			<?php echo h($specialty['Specialty']['specialty_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Specialty'); ?></dt>
		<dd>
			<?php echo $this->Html->link($specialty['ParentSpecialty']['id'], array('controller' => 'specialties', 'action' => 'view', $specialty['ParentSpecialty']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level'); ?></dt>
		<dd>
			<?php echo h($specialty['Specialty']['level']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Node'); ?></dt>
		<dd>
			<?php echo h($specialty['Specialty']['end_node']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Disease'); ?></dt>
		<dd>
			<?php echo $this->Html->link($specialty['Disease']['name'], array('controller' => 'diseases', 'action' => 'view', $specialty['Disease']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($specialty['Specialty']['is_deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($specialty['Specialty']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($specialty['Specialty']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Specialty'), array('action' => 'edit', $specialty['Specialty']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Specialty'), array('action' => 'delete', $specialty['Specialty']['id']), null, __('Are you sure you want to delete # %s?', $specialty['Specialty']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Specialties'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Specialty'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Specialties'), array('controller' => 'specialties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Specialty'), array('controller' => 'specialties', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Diseases'), array('controller' => 'diseases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Disease'), array('controller' => 'diseases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Services'); ?></h3>
	<?php if (!empty($specialty['Service'])): ?>
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
	<?php foreach ($specialty['Service'] as $service): ?>
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
<div class="related">
	<h3><?php echo __('Related Specialties'); ?></h3>
	<?php if (!empty($specialty['ChildSpecialty'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Specialty Name'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Level'); ?></th>
		<th><?php echo __('End Node'); ?></th>
		<th><?php echo __('Disease Id'); ?></th>
		<th><?php echo __('Is Deleted'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($specialty['ChildSpecialty'] as $childSpecialty): ?>
		<tr>
			<td><?php echo $childSpecialty['id']; ?></td>
			<td><?php echo $childSpecialty['specialty_name']; ?></td>
			<td><?php echo $childSpecialty['parent_id']; ?></td>
			<td><?php echo $childSpecialty['level']; ?></td>
			<td><?php echo $childSpecialty['end_node']; ?></td>
			<td><?php echo $childSpecialty['disease_id']; ?></td>
			<td><?php echo $childSpecialty['is_deleted']; ?></td>
			<td><?php echo $childSpecialty['created']; ?></td>
			<td><?php echo $childSpecialty['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'specialties', 'action' => 'view', $childSpecialty['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'specialties', 'action' => 'edit', $childSpecialty['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'specialties', 'action' => 'delete', $childSpecialty['id']), null, __('Are you sure you want to delete # %s?', $childSpecialty['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Specialty'), array('controller' => 'specialties', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
