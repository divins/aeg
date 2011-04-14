<div class="grid_16">
<?php echo $this->Form->create('Planol');?>
	<fieldset>
 		<legend><?php __('Editar Planol'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('codigo');
		echo $this->Form->input('img_digital');
		echo $this->Form->input('ubicacion');
		/*echo $this->Form->input('Motor');
		echo $this->Form->input('Part');*/
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar', true));?>
</div>