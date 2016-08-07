<div class="treatmentHistories view">
<h2><?php echo __('Treatment History'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($treatmentHistory['TreatmentHistory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($treatmentHistory['TreatmentHistory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Treatment'); ?></dt>
		<dd>
			<?php echo h($treatmentHistory['TreatmentHistory']['parent_treatment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($treatmentHistory['TreatmentHistory']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($treatmentHistory['TreatmentHistory']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($treatmentHistory['TreatmentHistory']['end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($treatmentHistory['User']['id'], array('controller' => 'users', 'action' => 'view', $treatmentHistory['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Cured'); ?></dt>
		<dd>
			<?php echo h($treatmentHistory['TreatmentHistory']['is_cured']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Running'); ?></dt>
		<dd>
			<?php echo h($treatmentHistory['TreatmentHistory']['is_running']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Show Status'); ?></dt>
		<dd>
			<?php echo h($treatmentHistory['TreatmentHistory']['show_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Visibility'); ?></dt>
		<dd>
			<?php echo h($treatmentHistory['TreatmentHistory']['visibility']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($treatmentHistory['TreatmentHistory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($treatmentHistory['TreatmentHistory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Treatment History'), array('action' => 'edit', $treatmentHistory['TreatmentHistory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Treatment History'), array('action' => 'delete', $treatmentHistory['TreatmentHistory']['id']), null, __('Are you sure you want to delete # %s?', $treatmentHistory['TreatmentHistory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Treatment Histories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treatment History'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
