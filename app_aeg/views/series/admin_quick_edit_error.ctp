<div class="grid_15 alpha" <?php echo "id='serie_".$this->data['Series']['id']."'"; ?>>
<?php  echo $error_msg; ?>
</div>
<div class="grid_1 omega actions">
	<?php echo $ajax->link( $html->image( 'icons/page_cancel_mini.png', array( 'alt' => __( 'Cancelar', true ), 'title' => __( 'Cancelar', true ) ) ), array('action' => 'quick_edit', $this->data['Series']['id'], true ), array( 'escape'=>false, 'update' => 'serie_'.$this->data['Series']['id']) ); ?>
</div>