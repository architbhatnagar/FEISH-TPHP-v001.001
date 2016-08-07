<div class="familyHistories view">
<h2><?php echo __('Family History'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($familyHistory['FamilyHistory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Member Name'); ?></dt>
		<dd>
			<?php echo h($familyHistory['FamilyHistory']['member_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Relationship'); ?></dt>
		<dd>
			<?php echo h($familyHistory['FamilyHistory']['relationship']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Age'); ?></dt>
		<dd>
			<?php echo h($familyHistory['FamilyHistory']['age']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Disease'); ?></dt>
		<dd>
			<?php echo $this->Html->link($familyHistory['Disease']['name'], array('controller' => 'diseases', 'action' => 'view', $familyHistory['Disease']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Current Status'); ?></dt>
		<dd>
			<?php echo h($familyHistory['FamilyHistory']['current_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo h($familyHistory['FamilyHistory']['year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($familyHistory['FamilyHistory']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Added By'); ?></dt>
		<dd>
			<?php echo h($familyHistory['FamilyHistory']['added_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo h($familyHistory['FamilyHistory']['updated_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($familyHistory['User']['id'], array('controller' => 'users', 'action' => 'view', $familyHistory['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($familyHistory['FamilyHistory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($familyHistory['FamilyHistory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Family History'), array('action' => 'edit', $familyHistory['FamilyHistory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Family History'), array('action' => 'delete', $familyHistory['FamilyHistory']['id']), null, __('Are you sure you want to delete # %s?', $familyHistory['FamilyHistory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Family Histories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Family History'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Diseases'), array('controller' => 'diseases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Disease'), array('controller' => 'diseases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
