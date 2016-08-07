<div class="soapNotes index">
	<h2><?php echo __('Soap Notes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('disease'); ?></th>
			<th><?php echo $this->Paginator->sort('observation'); ?></th>
			<th><?php echo $this->Paginator->sort('dignosis'); ?></th>
			<th><?php echo $this->Paginator->sort('comments'); ?></th>
			<th><?php echo $this->Paginator->sort('is_reference'); ?></th>
			<th><?php echo $this->Paginator->sort('reference_name'); ?></th>
			<th><?php echo $this->Paginator->sort('reference_address'); ?></th>
			<th><?php echo $this->Paginator->sort('reference_comments'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($soapNotes as $soapNote): ?>
	<tr>
		<td><?php echo h($soapNote['SoapNote']['id']); ?>&nbsp;</td>
		<td><?php echo h($soapNote['SoapNote']['disease']); ?>&nbsp;</td>
		<td><?php echo h($soapNote['SoapNote']['observation']); ?>&nbsp;</td>
		<td><?php echo h($soapNote['SoapNote']['dignosis']); ?>&nbsp;</td>
		<td><?php echo h($soapNote['SoapNote']['comments']); ?>&nbsp;</td>
		<td><?php echo h($soapNote['SoapNote']['is_reference']); ?>&nbsp;</td>
		<td><?php echo h($soapNote['SoapNote']['reference_name']); ?>&nbsp;</td>
		<td><?php echo h($soapNote['SoapNote']['reference_address']); ?>&nbsp;</td>
		<td><?php echo h($soapNote['SoapNote']['reference_comments']); ?>&nbsp;</td>
		<td><?php echo h($soapNote['SoapNote']['created']); ?>&nbsp;</td>
		<td><?php echo h($soapNote['SoapNote']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $soapNote['SoapNote']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $soapNote['SoapNote']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $soapNote['SoapNote']['id']), null, __('Are you sure you want to delete # %s?', $soapNote['SoapNote']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Soap Note'), array('action' => 'add')); ?></li>
	</ul>
</div>
