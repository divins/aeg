<div class="planols form">
<?php echo $this->Form->create('Planol');?>
	<fieldset>
 		<legend><?php __('Add Planol'); ?></legend>
	<?php
		echo $this->Form->input('codigo');
		echo $this->Form->input('img_digital');
		echo $this->Form->input('ubicacion');
		echo $this->Form->input('Motor');
		echo $this->Form->input('Part');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Planols', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Motors', true), array('controller' => 'motors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Motor', true), array('controller' => 'motors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Parts', true), array('controller' => 'parts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part', true), array('controller' => 'parts', 'action' => 'add')); ?> </li>
	</ul>
</div>