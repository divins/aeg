<?php
//echo $html->script('CSSPopUp');
echo $html->script('prototype');
//echo $html->script('scriptaculous');
?>
	<h2><?php __('Series');?></h2>
		<?php
		$i = 0;
		foreach ($series as $series):
			$class = ' style="background-color:#fff;"';
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#bbb;"';
			}
		?>
		<!-- MOSTRAR VISUALITZACIÓ SERIE -->
		<div class="grid_16" <?php echo "id='serie_".$series['Series']['id']."' ".$class; ?>>
			<div class="grid_1 alpha"><?php echo $series['Series']['id']; ?>&nbsp;</div>
			<div class="grid_2"><?php echo $series['Series']['codigo']; ?>&nbsp;</div>
			<div class="grid_11"><?php echo $series['Series']['descripcion']; ?>&nbsp;</div>
			<div class="grid_1 omega actions">
				<?php echo $ajax->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Edicio Rapida', true ), 'title' => __( 'Edicio Rapida', true ) ) ), array('action' => 'quick_edit', $series['Series']['id'] ), array( 'escape'=>false, 'update' => 'serie_'.$series['Series']['id']) );//, 'after' => "popup('popUpDiv')" ) );?>
				<?php echo $this->Html->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Eliminar Serie', true ), 'title' => __( 'Eliminar Serie', true ) ) ), array('action' => 'delete', $series['Series']['id']), array( 'escape'=>false ), sprintf(__('Estas segur de voler eliminar: %s?', true), $series['Series']['codigo'])); ?>
			</div>
		</div>
		<div class="clear"></div>

		<!-- MOSTRAR FORMULARI SERIE -->
		<!--<tr <?php/* echo "id='".$this->data['Series']['id']."' ".$class; ?>>
			<?php echo $this->Form->create('Series');?>
			<fieldset>
			<td><?php echo $this->data['Series']['id']; ?>&nbsp;</td>
			<td><?php echo $this->Form->input('codigo', array( 'label'=>false )); ?>&nbsp;</td>
			<td><?php echo $this->Form->input('descripcion', array( 'label'=>false )); ?>&nbsp;</td>
			</fieldset>
			<td class="actions">
				<?php echo $this->Form->end(__('Guardar', true)); */?>
			</td>
		</tr>-->
		
	<?php endforeach; ?>
	<!--<p>
	<?php/*
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
<!--<div class="actions">
	<h3><?php*/ /* __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Series', true), array('action' => 'add')); */ ?></li>
	</ul>
</div>-->