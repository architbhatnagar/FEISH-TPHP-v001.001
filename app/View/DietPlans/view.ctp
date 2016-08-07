<div class="dietPlans view">
<h2><?php echo __('Diet Plan'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dietPlan['DietPlan']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Plan Name'); ?></dt>
		<dd>
			<?php echo h($dietPlan['DietPlan']['plan_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($dietPlan['DietPlan']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($dietPlan['DietPlan']['end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Added By'); ?></dt>
		<dd>
			<?php echo h($dietPlan['DietPlan']['added_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dietPlan['User']['id'], array('controller' => 'users', 'action' => 'view', $dietPlan['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Doctor'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dietPlan['Doctor']['id'], array('controller' => 'doctors', 'action' => 'view', $dietPlan['Doctor']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Added Date'); ?></dt>
		<dd>
			<?php echo h($dietPlan['DietPlan']['added_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Diet Plan'), array('action' => 'edit', $dietPlan['DietPlan']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Diet Plan'), array('action' => 'delete', $dietPlan['DietPlan']['id']), null, __('Are you sure you want to delete # %s?', $dietPlan['DietPlan']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Diet Plans'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Diet Plan'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Doctors'), array('controller' => 'doctors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Doctor'), array('controller' => 'doctors', 'action' => 'add')); ?> </li>
	</ul>
</div>
