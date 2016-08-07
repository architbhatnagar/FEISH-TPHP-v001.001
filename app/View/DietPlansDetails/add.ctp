<div class="dietPlansDetails form">
<?php echo $this->Form->create('DietPlansDetail'); ?>
	<fieldset>
		<legend><?php echo __('Add Diet Plans Detail'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Diet Plans Details'), array('action' => 'index')); ?></li>
	</ul>
</div>
