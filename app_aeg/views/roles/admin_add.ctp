<div class="grid_16">
<?php echo $this->Form->create('Role');?>
	<fieldset>
 		<legend><?php __('Afegir Rol'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('alias');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar', true));?>
</div>
<div class="actions">
	<h3><?php __('Accions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('LListar Rols', true), array('action' => 'index'));?></li>
	</ul>
</div>