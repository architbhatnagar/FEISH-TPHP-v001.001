<div class="vitalUnits view">
<h2><?php echo __('Vital Unit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($vitalUnit['VitalUnit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($vitalUnit['VitalUnit']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vital Sign List'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vitalUnit['VitalSignList']['name'], array('controller' => 'vital_sign_lists', 'action' => 'view', $vitalUnit['VitalSignList']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($vitalUnit['VitalUnit']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modiefied'); ?></dt>
		<dd>
			<?php echo h($vitalUnit['VitalUnit']['modiefied']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vital Unit'), array('action' => 'edit', $vitalUnit['VitalUnit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vital Unit'), array('action' => 'delete', $vitalUnit['VitalUnit']['id']), null, __('Are you sure you want to delete # %s?', $vitalUnit['VitalUnit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Vital Units'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vital Unit'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vital Sign Lists'), array('controller' => 'vital_sign_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vital Sign List'), array('controller' => 'vital_sign_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>
