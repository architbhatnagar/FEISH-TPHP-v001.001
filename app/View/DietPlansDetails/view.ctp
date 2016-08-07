<div class="dietPlansDetails view">
<h2><?php echo __('Diet Plans Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dietPlansDetail['DietPlansDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weekday'); ?></dt>
		<dd>
			<?php echo h($dietPlansDetail['DietPlansDetail']['weekday']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time'); ?></dt>
		<dd>
			<?php echo h($dietPlansDetail['DietPlansDetail']['time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($dietPlansDetail['DietPlansDetail']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Date'); ?></dt>
		<dd>
			<?php echo h($dietPlansDetail['DietPlansDetail']['created_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified Date'); ?></dt>
		<dd>
			<?php echo h($dietPlansDetail['DietPlansDetail']['modified_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Diet Plans Detail'), array('action' => 'edit', $dietPlansDetail['DietPlansDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Diet Plans Detail'), array('action' => 'delete', $dietPlansDetail['DietPlansDetail']['id']), null, __('Are you sure you want to delete # %s?', $dietPlansDetail['DietPlansDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Diet Plans Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Diet Plans Detail'), array('action' => 'add')); ?> </li>
	</ul>
</div>
