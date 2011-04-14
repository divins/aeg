<div class="grid_16">
	<h2><?php __('Rols');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('alias');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Accions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($roles as $role):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $role['Role']['id']; ?>&nbsp;</td>
		<td><?php echo $role['Role']['title']; ?>&nbsp;</td>
		<td><?php echo $role['Role']['alias']; ?>&nbsp;</td>
		<td><?php echo $role['Role']['created']; ?>&nbsp;</td>
		<td><?php echo $role['Role']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Veure', true), array('action' => 'view', $role['Role']['id'])); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $role['Role']['id'])); ?>
			<?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $role['Role']['id']), null, sprintf(__('Estas segur de voler eliminar: %s?', true), $role['Role']['id'])); ?>
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
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nou Rol', true), array('action' => 'add')); ?></li>
	</ul>
</div>