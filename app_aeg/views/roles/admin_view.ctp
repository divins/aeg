<div class="roles view">
<h2><?php  __('Role');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $role['Role']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $role['Role']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Alias'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $role['Role']['alias']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $role['Role']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $role['Role']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Role', true), array('action' => 'edit', $role['Role']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Role', true), array('action' => 'delete', $role['Role']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $role['Role']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario', true), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Usuarios');?></h3>
	<?php if (!empty($role['Usuario'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Role Id'); ?></th>
		<th><?php __('Username'); ?></th>
		<th><?php __('Password'); ?></th>
		<th><?php __('Language'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Website'); ?></th>
		<th><?php __('Activation Key'); ?></th>
		<th><?php __('Image'); ?></th>
		<th><?php __('Bio'); ?></th>
		<th><?php __('Timezone'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($role['Usuario'] as $usuario):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $usuario['id'];?></td>
			<td><?php echo $usuario['role_id'];?></td>
			<td><?php echo $usuario['username'];?></td>
			<td><?php echo $usuario['password'];?></td>
			<td><?php echo $usuario['language'];?></td>
			<td><?php echo $usuario['name'];?></td>
			<td><?php echo $usuario['email'];?></td>
			<td><?php echo $usuario['website'];?></td>
			<td><?php echo $usuario['activation_key'];?></td>
			<td><?php echo $usuario['image'];?></td>
			<td><?php echo $usuario['bio'];?></td>
			<td><?php echo $usuario['timezone'];?></td>
			<td><?php echo $usuario['status'];?></td>
			<td><?php echo $usuario['updated'];?></td>
			<td><?php echo $usuario['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'usuarios', 'action' => 'view', $usuario['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'usuarios', 'action' => 'edit', $usuario['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'usuarios', 'action' => 'delete', $usuario['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $usuario['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Usuario', true), array('controller' => 'usuarios', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
