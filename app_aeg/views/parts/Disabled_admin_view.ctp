<div class="grid_16">
<h2><?php  __('Part');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ID'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $part['Part']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Piece_Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $part['Part']['clave_pieza']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Unit_Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $part['Part']['clave_unidad']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Denomination'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $part['Part']['denominacion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $part['Part']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $part['Part']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<!--
<div class="actions">
	<h3><?php /*__('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Part', true), array('action' => 'edit', $part['Part']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Part', true), array('action' => 'delete', $part['Part']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $part['Part']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Parts', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Motors', true), array('controller' => 'motors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Motor', true), array('controller' => 'motors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Parts', true), array('controller' => 'parts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part', true), array('controller' => 'parts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Planols', true), array('controller' => 'planols', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planol', true), array('controller' => 'planols', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Motors');?></h3>
	<?php if (!empty($part['Motor'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Clave Pieza'); ?></th>
		<th><?php __('Clave Unidad'); ?></th>
		<th><?php __('Denominacion'); ?></th>
		<th><?php __('Serie Id'); ?></th>
		<th><?php __('Altura'); ?></th>
		<th><?php __('Potencia'); ?></th>
		<th><?php __('Tension'); ?></th>
		<th><?php __('Forma'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($part['Motor'] as $motor):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $motor['id'];?></td>
			<td><?php echo $motor['clave_pieza'];?></td>
			<td><?php echo $motor['clave_unidad'];?></td>
			<td><?php echo $motor['denominacion'];?></td>
			<td><?php echo $motor['serie_id'];?></td>
			<td><?php echo $motor['altura'];?></td>
			<td><?php echo $motor['potencia'];?></td>
			<td><?php echo $motor['tension'];?></td>
			<td><?php echo $motor['forma'];?></td>
			<td><?php echo $motor['created'];?></td>
			<td><?php echo $motor['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'motors', 'action' => 'view', $motor['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'motors', 'action' => 'edit', $motor['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'motors', 'action' => 'delete', $motor['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $motor['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Motor', true), array('controller' => 'motors', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Parts');?></h3>
	<?php if (!empty($part['Part'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Clave Pieza'); ?></th>
		<th><?php __('Clave Unidad'); ?></th>
		<th><?php __('Denominacion'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($part['Part'] as $part):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $part['id'];?></td>
			<td><?php echo $part['clave_pieza'];?></td>
			<td><?php echo $part['clave_unidad'];?></td>
			<td><?php echo $part['denominacion'];?></td>
			<td><?php echo $part['created'];?></td>
			<td><?php echo $part['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'parts', 'action' => 'view', $part['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'parts', 'action' => 'edit', $part['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'parts', 'action' => 'delete', $part['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $part['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Part', true), array('controller' => 'parts', 'action' => 'add')); */ ?> </li>
		</ul>
	</div>
</div>-->

