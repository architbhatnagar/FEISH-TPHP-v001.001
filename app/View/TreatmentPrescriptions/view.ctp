<div class="treatmentPrescriptions view">
<h2><?php echo __('Treatment Prescription'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($treatmentPrescription['TreatmentPrescription']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Observation'); ?></dt>
		<dd>
			<?php echo h($treatmentPrescription['TreatmentPrescription']['observation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Diagnosis'); ?></dt>
		<dd>
			<?php echo h($treatmentPrescription['TreatmentPrescription']['diagnosis']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prescription'); ?></dt>
		<dd>
			<?php echo h($treatmentPrescription['TreatmentPrescription']['prescription']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($treatmentPrescription['TreatmentPrescription']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($treatmentPrescription['TreatmentPrescription']['end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Treatment History'); ?></dt>
		<dd>
			<?php echo $this->Html->link($treatmentPrescription['TreatmentHistory']['name'], array('controller' => 'treatment_histories', 'action' => 'view', $treatmentPrescription['TreatmentHistory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($treatmentPrescription['User']['id'], array('controller' => 'users', 'action' => 'view', $treatmentPrescription['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($treatmentPrescription['TreatmentPrescription']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($treatmentPrescription['TreatmentPrescription']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Treatment Prescription'), array('action' => 'edit', $treatmentPrescription['TreatmentPrescription']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Treatment Prescription'), array('action' => 'delete', $treatmentPrescription['TreatmentPrescription']['id']), null, __('Are you sure you want to delete # %s?', $treatmentPrescription['TreatmentPrescription']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Treatment Prescriptions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treatment Prescription'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Treatment Histories'), array('controller' => 'treatment_histories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treatment History'), array('controller' => 'treatment_histories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
