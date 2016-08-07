<div class="medicalHistories view">
<h2><?php echo __('Medical History'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($medicalHistory['MedicalHistory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conditions'); ?></dt>
		<dd>
			<?php echo h($medicalHistory['MedicalHistory']['conditions']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Condition Type'); ?></dt>
		<dd>
			<?php echo h($medicalHistory['MedicalHistory']['condition_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Current Medication'); ?></dt>
		<dd>
			<?php echo h($medicalHistory['MedicalHistory']['current_medication']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($medicalHistory['MedicalHistory']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($medicalHistory['MedicalHistory']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($medicalHistory['User']['id'], array('controller' => 'users', 'action' => 'view', $medicalHistory['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($medicalHistory['MedicalHistory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($medicalHistory['MedicalHistory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Medical History'), array('action' => 'edit', $medicalHistory['MedicalHistory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Medical History'), array('action' => 'delete', $medicalHistory['MedicalHistory']['id']), null, __('Are you sure you want to delete # %s?', $medicalHistory['MedicalHistory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Medical Histories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Medical History'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
