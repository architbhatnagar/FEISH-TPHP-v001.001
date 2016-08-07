<div class="soapNotes view">
<h2><?php echo __('Soap Note'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($soapNote['SoapNote']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Disease'); ?></dt>
		<dd>
			<?php echo h($soapNote['SoapNote']['disease']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Observation'); ?></dt>
		<dd>
			<?php echo h($soapNote['SoapNote']['observation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dignosis'); ?></dt>
		<dd>
			<?php echo h($soapNote['SoapNote']['dignosis']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comments'); ?></dt>
		<dd>
			<?php echo h($soapNote['SoapNote']['comments']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Reference'); ?></dt>
		<dd>
			<?php echo h($soapNote['SoapNote']['is_reference']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reference Name'); ?></dt>
		<dd>
			<?php echo h($soapNote['SoapNote']['reference_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reference Address'); ?></dt>
		<dd>
			<?php echo h($soapNote['SoapNote']['reference_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reference Comments'); ?></dt>
		<dd>
			<?php echo h($soapNote['SoapNote']['reference_comments']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($soapNote['SoapNote']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($soapNote['SoapNote']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Soap Note'), array('action' => 'edit', $soapNote['SoapNote']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Soap Note'), array('action' => 'delete', $soapNote['SoapNote']['id']), null, __('Are you sure you want to delete # %s?', $soapNote['SoapNote']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Soap Notes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Soap Note'), array('action' => 'add')); ?> </li>
	</ul>
</div>
