<div class="grid_16">
<h2><?php  __('Planol');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $planol['Planol']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Codigo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $planol['Planol']['codigo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Img Digital'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $planol['Planol']['img_digital']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ubicacion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $planol['Planol']['ubicacion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $planol['Planol']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $planol['Planol']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<!--
<div class="related">
	<h3><?php /* __('Related Motors');?></h3>
	<?php if (!empty($planol['Motor'])):?>
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
		foreach ($planol['Motor'] as $motor):
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
	<?php if (!empty($planol['Part'])):?>
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
		foreach ($planol['Part'] as $part):
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
</div>
-->