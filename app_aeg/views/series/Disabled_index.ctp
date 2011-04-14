<div class="grid_16">
	<h2><?php __('Series');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('codigo');?></th>
			<th><?php echo $this->Paginator->sort('descripcion');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Accions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($series as $series):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $series['Series']['id']; ?>&nbsp;</td>
		<td><?php echo $series['Series']['codigo']; ?>&nbsp;</td>
		<td><?php echo $series['Series']['descripcion']; ?>&nbsp;</td>
		<td><?php echo $series['Series']['created']; ?>&nbsp;</td>
		<td><?php echo $series['Series']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Veure', true), array('action' => 'view', $series['Series']['id'])); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $series['Series']['id'])); ?>
			<?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $series['Series']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $series['Series']['id'])); ?>
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