<div class="vitalSigns view">
<h2><?php echo __('Vital Sign'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($vitalSign['VitalSign']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vital Sign List'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vitalSign['VitalSignList']['name'], array('controller' => 'vital_sign_lists', 'action' => 'view', $vitalSign['VitalSignList']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unit Id'); ?></dt>
		<dd>
			<?php echo h($vitalSign['VitalSign']['unit_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Max Observation'); ?></dt>
		<dd>
			<?php echo h($vitalSign['VitalSign']['max_observation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Min Observation'); ?></dt>
		<dd>
			<?php echo h($vitalSign['VitalSign']['min_observation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Observation'); ?></dt>
		<dd>
			<?php echo h($vitalSign['VitalSign']['observation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remark'); ?></dt>
		<dd>
			<?php echo h($vitalSign['VitalSign']['remark']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vitalSign['User']['id'], array('controller' => 'users', 'action' => 'view', $vitalSign['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($vitalSign['VitalSign']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($vitalSign['VitalSign']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vital Sign'), array('action' => 'edit', $vitalSign['VitalSign']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vital Sign'), array('action' => 'delete', $vitalSign['VitalSign']['id']), null, __('Are you sure you want to delete # %s?', $vitalSign['VitalSign']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Vital Signs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vital Sign'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vital Sign Lists'), array('controller' => 'vital_sign_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vital Sign List'), array('controller' => 'vital_sign_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>
