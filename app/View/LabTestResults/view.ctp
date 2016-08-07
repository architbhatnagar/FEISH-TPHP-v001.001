<div class="labTestResults view">
<h2><?php echo __('Lab Test Result'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($labTestResult['LabTestResult']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Test'); ?></dt>
		<dd>
			<?php echo $this->Html->link($labTestResult['Test']['id'], array('controller' => 'tests', 'action' => 'view', $labTestResult['Test']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Test Date'); ?></dt>
		<dd>
			<?php echo h($labTestResult['LabTestResult']['test_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Observed Value'); ?></dt>
		<dd>
			<?php echo h($labTestResult['LabTestResult']['observed_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Report'); ?></dt>
		<dd>
			<?php echo h($labTestResult['LabTestResult']['report']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($labTestResult['LabTestResult']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Added By'); ?></dt>
		<dd>
			<?php echo h($labTestResult['LabTestResult']['added_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($labTestResult['User']['id'], array('controller' => 'users', 'action' => 'view', $labTestResult['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($labTestResult['LabTestResult']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($labTestResult['LabTestResult']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lab Test Result'), array('action' => 'edit', $labTestResult['LabTestResult']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lab Test Result'), array('action' => 'delete', $labTestResult['LabTestResult']['id']), null, __('Are you sure you want to delete # %s?', $labTestResult['LabTestResult']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Lab Test Results'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lab Test Result'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tests'), array('controller' => 'tests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Test'), array('controller' => 'tests', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
