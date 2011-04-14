<div class="grid_16">
<?php echo $this->Form->create('Usuario');?>
	<fieldset>
 		<legend><?php __('Afegir Usuari'); ?></legend>
	<?php
		echo $this->Form->input('role_id');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('language');
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('website');
		echo $this->Form->input('activation_key');
		echo $this->Form->input('image');
		echo $this->Form->input('bio');
		echo $this->Form->input('timezone');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar', true));?>
</div>
<div class="actions">
	<h3><?php __('Accions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('LLista Usuaris', true), array('action' => 'index'));?></li>
	</ul>
</div>