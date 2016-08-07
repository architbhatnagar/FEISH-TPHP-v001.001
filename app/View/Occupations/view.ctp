<div class="occupations view">
<h2><?php echo __('Occupation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($occupation['Occupation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($occupation['Occupation']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($occupation['Occupation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($occupation['Occupation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Occupation'), array('action' => 'edit', $occupation['Occupation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Occupation'), array('action' => 'delete', $occupation['Occupation']['id']), null, __('Are you sure you want to delete # %s?', $occupation['Occupation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Occupations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Occupation'), array('action' => 'add')); ?> </li>
	</ul>
</div>
