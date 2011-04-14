<div class="motors view">
<h2><?php  __('Motor');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $motor['Motor']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Piece_Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $motor['Motor']['clave_pieza']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Unit_Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $motor['Motor']['clave_unidad']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Denomination'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $motor['Motor']['denominacion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Serie'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($motor['Serie']['id'], array('controller' => 'series', 'action' => 'view', $motor['Serie']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Height'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $motor['Motor']['altura']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Power'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $motor['Motor']['potencia']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Voltage'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $motor['Motor']['tension']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shape'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $motor['Motor']['forma']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $motor['Motor']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $motor['Motor']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Motor', true), array('action' => 'edit', $motor['Motor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Motor', true), array('action' => 'delete', $motor['Motor']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $motor['Motor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Motors', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Motor', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Series', true), array('controller' => 'series', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Serie', true), array('controller' => 'series', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Parts', true), array('controller' => 'parts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part', true), array('controller' => 'parts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Planols', true), array('controller' => 'planols', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planol', true), array('controller' => 'planols', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Parts');?></h3>
	<?php if (!empty($motor['Part'])):?>
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
		foreach ($motor['Part'] as $part):
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
			<li><?php echo $this->Html->link(__('New Part', true), array('controller' => 'parts', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Planols');?></h3>
	<?php if (!empty($motor['Planol'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Codigo'); ?></th>
		<th><?php __('Img Digital'); ?></th>
		<th><?php __('Ubicacion'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($motor['Planol'] as $planol):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $planol['id'];?></td>
			<td><?php echo $planol['codigo'];?></td>
			<td><?php echo $planol['img_digital'];?></td>
			<td><?php echo $planol['ubicacion'];?></td>
			<td><?php echo $planol['created'];?></td>
			<td><?php echo $planol['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'planols', 'action' => 'view', $planol['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'planols', 'action' => 'edit', $planol['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'planols', 'action' => 'delete', $planol['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $planol['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Planol', true), array('controller' => 'planols', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
