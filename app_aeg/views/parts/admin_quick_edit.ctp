<?php
//DEBUG( $this->data );
$class="";
?>
	<?php echo $this->Form->create('Part'); ?>
	<div class="part-result_id_col"><?php echo $this->data['Part']['id']; ?></div>
	<div class="part-result_piecec_col"><?php echo $this->Form->input('clave_pieza', array( 'label'=>false )); ?></div>
	<div class="part-result_unityc_col"><?php echo $this->Form->input('clave_unidad', array( 'label'=>false )); ?></div>
	<div class="part-result_denomination_col"><?php echo $this->Form->input('denominacion', array( 'label'=>false )); ?></div>
	<div class="part-admin_motors_actions">
	<?php echo $this->Form->input('id'); ?>
	<?php echo $this->Form->input('row_info.color_class', array('value'=>$color_class, 'type'=>'hidden') ); ?>
	<?php echo $ajax->submit( 'icons/save.gif', array('url'=> array('controller'=>'parts', 'action'=>'quick_edit'), 'update' => 'part_'.$this->data['Part']['id'])); ?>
	<?php echo $ajax->link( $html->image( 'icons/page_cancel_mini.png', array( 'alt' => __( 'Cancel', true ), 'title' => __( 'Cancel', true ) ) ), array('action' => 'quick_edit', $this->data['Part']['id'], true, $color_class ), array( 'escape'=>false, 'update' => 'part_'.$this->data['Part']['id']) ); ?>
	</div>