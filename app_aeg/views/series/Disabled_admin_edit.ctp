<div class="grid_16">
<?php echo $this->Form->create('Series');?>
	<fieldset>
 		<legend><?php __('Editar Series'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('codigo');
		echo $this->Form->input('descripcion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar', true));?>
</div>