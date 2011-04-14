
	<div class="grid_1 alpha"><?php echo $this->data['Series']['id']; ?>&nbsp;</div>
	<div class="grid_2"><?php echo $this->data['Series']['codigo']; ?>&nbsp;</div>
	<div class="grid_8"><?php echo $this->data['Series']['descripcion']; ?>&nbsp;</div>
	<div class="grid_4 omega actions">
		<?php echo $ajax->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Edicio Rapida', true ), 'title' => __( 'Edicio Rapida', true ) ) ), array('action' => 'quick_edit', $this->data['Series']['id'] ), array( 'escape'=>false, 'update' => 'serie_'.$this->data['Series']['id']) );//, 'after' => "popup('popUpDiv')" ) );?>
		<?php echo $this->Html->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Eliminar Serie', true ), 'title' => __( 'Eliminar Serie', true ) ) ), array('action' => 'delete', $this->data['Series']['id']), array( 'escape'=>false ), sprintf(__('Estas segur de voler eliminar: %s?', true), $this->data['Series']['id'])); ?>
	</div>