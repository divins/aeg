<div class="grid_16">
<?php echo $this->Form->create('Part');?>
	<fieldset>
 		<legend><?php __('Add_Part'); ?></legend>
	<?php
		echo $this->Form->input('clave_pieza');
		echo $this->Form->input('clave_unidad');
		echo $this->Form->input('denominacion');
		//echo $this->Form->input('Motor');
		//echo $this->Form->input('Part');
		//echo $this->Form->input('Planol');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>