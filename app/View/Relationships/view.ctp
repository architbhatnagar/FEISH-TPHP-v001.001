<div class="relationships view">
<h2><?php echo __('Relationship'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($relationship['Relationship']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($relationship['Relationship']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($relationship['Relationship']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($relationship['Relationship']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Relationship'), array('action' => 'edit', $relationship['Relationship']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Relationship'), array('action' => 'delete', $relationship['Relationship']['id']), null, __('Are you sure you want to delete # %s?', $relationship['Relationship']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Relationships'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Relationship'), array('action' => 'add')); ?> </li>
	</ul>
</div>
