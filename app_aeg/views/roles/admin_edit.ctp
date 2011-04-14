<div class="roles form">
<?php echo $this->Form->create('Role');?>
	<fieldset>
 		<legend><?php __('Edit Role'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('alias');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Role.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Role.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Roles', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario', true), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>