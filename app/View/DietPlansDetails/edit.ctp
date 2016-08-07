<div class="dietPlansDetails form">
<?php echo $this->Form->create('DietPlansDetail'); ?>
	<fieldset>
		<legend><?php echo __('Edit Diet Plans Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('weekday');
		echo $this->Form->input('time');
		echo $this->Form->input('description');
		echo $this->Form->input('created_date');
		echo $this->Form->input('modified_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('DietPlansDetail.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('DietPlansDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Diet Plans Details'), array('action' => 'index')); ?></li>
	</ul>
</div>
