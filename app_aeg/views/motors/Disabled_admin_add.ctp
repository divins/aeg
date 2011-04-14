<div class="grid_16">
<?php echo $this->Form->create('Motor');?>
	<fieldset>
 		<legend><?php __('Afegir Motor'); ?></legend>
	<?php
		echo $this->Form->input('clave_pieza');
		echo $this->Form->input('clave_unidad');
		echo $this->Form->input('denominacion');
		echo $this->Form->input('serie_id', array( 'type' => 'text' ) );
		echo $this->Form->input('altura');
		echo $this->Form->input('potencia');
		echo $this->Form->input('tension');
		echo $this->Form->input('forma');
		echo $this->Form->input('Part', array( 'type' => 'text' ) );
		echo $this->Form->input('Planol', array( 'type' => 'text' ) );
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar', true));?>
</div>