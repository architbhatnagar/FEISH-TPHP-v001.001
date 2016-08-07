<div class="medicalConditions view">
<h2><?php echo __('Medical Condition'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($medicalCondition['MedicalCondition']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($medicalCondition['MedicalCondition']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($medicalCondition['MedicalCondition']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($medicalCondition['MedicalCondition']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Medical Condition'), array('action' => 'edit', $medicalCondition['MedicalCondition']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Medical Condition'), array('action' => 'delete', $medicalCondition['MedicalCondition']['id']), null, __('Are you sure you want to delete # %s?', $medicalCondition['MedicalCondition']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Medical Conditions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Medical Condition'), array('action' => 'add')); ?> </li>
	</ul>
</div>
