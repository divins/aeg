<div class="grid_16">
<h2><?php  __('Series');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $series['Series']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Codigo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $series['Series']['codigo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $series['Series']['descripcion']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<!--<div class="actions">
	<h3><?php /*__('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Series', true), array('action' => 'edit', $series['Series']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Series', true), array('action' => 'delete', $series['Series']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $series['Series']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Series', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Series', true), array('action' => 'add'));*/ ?> </li>
	</ul>
</div>-->
