<div class="diseases view">
<h2><?php echo __('Disease'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($disease['Disease']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($disease['Disease']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Disease'); ?></dt>
		<dd>
			<?php echo $this->Html->link($disease['ParentDisease']['name'], array('controller' => 'diseases', 'action' => 'view', $disease['ParentDisease']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level'); ?></dt>
		<dd>
			<?php echo h($disease['Disease']['level']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Node'); ?></dt>
		<dd>
			<?php echo h($disease['Disease']['end_node']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($disease['Disease']['is_deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($disease['Disease']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($disease['Disease']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Disease'), array('action' => 'edit', $disease['Disease']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Disease'), array('action' => 'delete', $disease['Disease']['id']), null, __('Are you sure you want to delete # %s?', $disease['Disease']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Diseases'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Disease'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Diseases'); ?></h3>
	<?php if (!empty($disease['ChildDisease'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Level'); ?></th>
		<th><?php echo __('End Node'); ?></th>
		<th><?php echo __('Is Deleted'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($disease['ChildDisease'] as $childDisease): ?>
		<tr>
			<td><?php echo $childDisease['id']; ?></td>
			<td><?php echo $childDisease['name']; ?></td>
			<td><?php echo $childDisease['parent_id']; ?></td>
			<td><?php echo $childDisease['level']; ?></td>
			<td><?php echo $childDisease['end_node']; ?></td>
			<td><?php echo $childDisease['is_deleted']; ?></td>
			<td><?php echo $childDisease['created']; ?></td>
			<td><?php echo $childDisease['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'diseases', 'action' => 'view', $childDisease['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'diseases', 'action' => 'edit', $childDisease['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'diseases', 'action' => 'delete', $childDisease['id']), null, __('Are you sure you want to delete # %s?', $childDisease['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Disease'), array('controller' => 'diseases', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Family Histories'); ?></h3>
	<?php if (!empty($disease['FamilyHistory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Member Name'); ?></th>
		<th><?php echo __('Relationship'); ?></th>
		<th><?php echo __('Age'); ?></th>
		<th><?php echo __('Disease Id'); ?></th>
		<th><?php echo __('Current Status'); ?></th>
		<th><?php echo __('Year'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Added By'); ?></th>
		<th><?php echo __('Updated By'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($disease['FamilyHistory'] as $familyHistory): ?>
		<tr>
			<td><?php echo $familyHistory['id']; ?></td>
			<td><?php echo $familyHistory['member_name']; ?></td>
			<td><?php echo $familyHistory['relationship']; ?></td>
			<td><?php echo $familyHistory['age']; ?></td>
			<td><?php echo $familyHistory['disease_id']; ?></td>
			<td><?php echo $familyHistory['current_status']; ?></td>
			<td><?php echo $familyHistory['year']; ?></td>
			<td><?php echo $familyHistory['description']; ?></td>
			<td><?php echo $familyHistory['added_by']; ?></td>
			<td><?php echo $familyHistory['updated_by']; ?></td>
			<td><?php echo $familyHistory['user_id']; ?></td>
			<td><?php echo $familyHistory['created']; ?></td>
			<td><?php echo $familyHistory['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'family_histories', 'action' => 'view', $familyHistory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'family_histories', 'action' => 'edit', $familyHistory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'family_histories', 'action' => 'delete', $familyHistory['id']), null, __('Are you sure you want to delete # %s?', $familyHistory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Family History'), array('controller' => 'family_histories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Services'); ?></h3>
	<?php if (!empty($disease['Service'])): ?>
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
		<th><?php echo __('User Id'); ?></th>
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
	<?php foreach ($disease['Service'] as $service): ?>
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
			<td><?php echo $service['user_id']; ?></td>
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
	<?php if (!empty($disease['Specialty'])): ?>
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
	<?php foreach ($disease['Specialty'] as $specialty): ?>
		<tr>
			<td><?php echo $specialty['id']; ?></td>
			<td><?php echo $specialty['specialty_name']; ?></td>
			<td><?php echo $specialty['parent_id']; ?></td>
			<td><?php echo $specialty['level']; ?></td>
			<td><?php echo $specialty['end_node']; ?></td>
			<td><?php echo $specialty['disease_id']; ?></td>
			<td><?php echo $specialty['is_deleted']; ?></td>
			<td><?php echo $specialty['created']; ?></td>
			<td><?php echo $specialty['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'specialties', 'action' => 'view', $specialty['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'specialties', 'action' => 'edit', $specialty['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'specialties', 'action' => 'delete', $specialty['id']), null, __('Are you sure you want to delete # %s?', $specialty['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Specialty'), array('controller' => 'specialties', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
