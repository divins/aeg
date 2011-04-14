<div class="usuarios index">
	<h2><?php __('Usuaris');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('role_id');?></th>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('password');?></th>
			<th><?php echo $this->Paginator->sort('language');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('website');?></th>
			<th><?php echo $this->Paginator->sort('activation_key');?></th>
			<th><?php echo $this->Paginator->sort('image');?></th>
			<th><?php echo $this->Paginator->sort('bio');?></th>
			<th><?php echo $this->Paginator->sort('timezone');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($usuarios as $usuario):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $usuario['Usuario']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($usuario['Role']['title'], array('controller' => 'roles', 'action' => 'view', $usuario['Role']['id'])); ?>
		</td>
		<td><?php echo $usuario['Usuario']['username']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['password']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['language']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['name']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['email']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['website']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['activation_key']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['image']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['bio']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['timezone']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['status']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['updated']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Veure', true), array('action' => 'view', $usuario['Usuario']['id'])); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $usuario['Usuario']['id'])); ?>
			<?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $usuario['Usuario']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $usuario['Usuario']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => utf8_encode( __('Pàgina %page% de %pages%, %count% motors coincideixen amb la cerca, mostrant de %start% al %end%', true) )
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('Anterior', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('Seguent', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Accions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nou Usuari', true), array('action' => 'add')); ?></li>
	</ul>
</div>