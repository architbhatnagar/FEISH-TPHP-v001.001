<div class="servicesWorkingTimings view">
<h2><?php echo __('Services Working Timing'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($servicesWorkingTiming['ServicesWorkingTiming']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Day Of Week'); ?></dt>
		<dd>
			<?php echo h($servicesWorkingTiming['ServicesWorkingTiming']['day_of_week']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Open Time'); ?></dt>
		<dd>
			<?php echo h($servicesWorkingTiming['ServicesWorkingTiming']['open_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Close Time'); ?></dt>
		<dd>
			<?php echo h($servicesWorkingTiming['ServicesWorkingTiming']['close_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service'); ?></dt>
		<dd>
			<?php echo $this->Html->link($servicesWorkingTiming['Service']['title'], array('controller' => 'services', 'action' => 'view', $servicesWorkingTiming['Service']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($servicesWorkingTiming['ServicesWorkingTiming']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($servicesWorkingTiming['ServicesWorkingTiming']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Services Working Timing'), array('action' => 'edit', $servicesWorkingTiming['ServicesWorkingTiming']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Services Working Timing'), array('action' => 'delete', $servicesWorkingTiming['ServicesWorkingTiming']['id']), null, __('Are you sure you want to delete # %s?', $servicesWorkingTiming['ServicesWorkingTiming']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Services Working Timings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Services Working Timing'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
