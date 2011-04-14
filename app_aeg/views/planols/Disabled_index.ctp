<div class="grid_16">
	<h2><?php __('Planols');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('codigo');?></th>
			<th><?php echo $this->Paginator->sort('img_digital');?></th>
			<th><?php echo $this->Paginator->sort('ubicacion');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Accions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($planols as $planol):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $planol['Planol']['id']; ?>&nbsp;</td>
		<td><?php echo $planol['Planol']['codigo']; ?>&nbsp;</td>
		<td><?php echo $planol['Planol']['img_digital']; ?>&nbsp;</td>
		<td><?php echo $planol['Planol']['ubicacion']; ?>&nbsp;</td>
		<td><?php echo $planol['Planol']['created']; ?>&nbsp;</td>
		<td><?php echo $planol['Planol']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Veure', true), array('action' => 'view', $planol['Planol']['id'])); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $planol['Planol']['id'])); ?>
			<?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $planol['Planol']['id']), null, sprintf(__('Estas segur de voler eliminar: %s?', true), $planol['Planol']['id'])); ?>
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
<!--<div class="actions">
	<h3><?php /* __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Planol', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Motors', true), array('controller' => 'motors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Motor', true), array('controller' => 'motors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Parts', true), array('controller' => 'parts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part', true), array('controller' => 'parts', 'action' => 'add')); */ ?> </li>
	</ul>
</div>-->