<div class="grid_15 alpha" <?php echo "id='motor_".$this->data['Part']['id']."'"; ?>>
<?php  echo $error_msg; ?>
</div>
<div class="grid_1 omega actions">
	<?php echo $ajax->link( $html->image( 'icons/page_cancel_mini.png', array( 'alt' => __( 'Cancel', true ), 'title' => __( 'Cancel', true ) ) ), array('action' => 'quick_edit', $this->data['Part']['id'], true ), array( 'escape'=>false, 'update' => 'part_'.$this->data['Part']['id']) ); ?>
</div>