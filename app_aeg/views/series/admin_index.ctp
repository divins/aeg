<?php
echo $html->script('prototype');
?>
	<h2 Style="margin-top: 20px;"><?php __('Series');?></h2>
		<?php
		$i = 0;
		foreach ($series as $series):
			$class = ' style="background-color:#fff;"';
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#bbb;"';
			}
		?>
		<div class="grid_16" <?php echo "id='serie_".$series['Series']['id']."' ".$class; ?>>
			<div class="grid_1 alpha"><?php echo $series['Series']['id']; ?>&nbsp;</div>
			<div class="grid_2"><?php echo $series['Series']['codigo']; ?>&nbsp;</div>
			<div class="grid_11"><?php echo $series['Series']['descripcion']; ?>&nbsp;</div>
			<div class="grid_1 omega">
				<?php echo $ajax->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Edicio Rapida', true ), 'title' => __( 'Edicio Rapida', true ) ) ), array('action' => 'quick_edit', $series['Series']['id'] ), array( 'escape'=>false, 'update' => 'serie_'.$series['Series']['id']) );//, 'after' => "popup('popUpDiv')" ) );?>
				<?php echo $this->Html->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Eliminar Serie', true ), 'title' => __( 'Eliminar Serie', true ) ) ), array('action' => 'delete', $series['Series']['id']), array( 'escape'=>false ), sprintf(__('Estas segur de voler eliminar: %s?', true), $series['Series']['codigo'])); ?>
			</div>
		</div>
		<div class="clear"></div>
		
	<?php endforeach; ?>