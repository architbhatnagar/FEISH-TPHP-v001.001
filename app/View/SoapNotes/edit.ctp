<div class="soapNotes form">
<?php echo $this->Form->create('SoapNote'); ?>
	<fieldset>
		<legend><?php echo __('Edit Soap Note'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('disease');
		echo $this->Form->input('observation');
		echo $this->Form->input('dignosis');
		echo $this->Form->input('comments');
		echo $this->Form->input('is_reference');
		echo $this->Form->input('reference_name');
		echo $this->Form->input('reference_address');
		echo $this->Form->input('reference_comments');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SoapNote.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SoapNote.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Soap Notes'), array('action' => 'index')); ?></li>
	</ul>
</div>
