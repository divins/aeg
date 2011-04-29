<?php
//DEBUG( $this->data );
$class="";
?>
	<?php echo $this->Form->create('Planol'); ?>
	<div class="grid_1 alpha"><?php echo $this->data['Planol']['id']; ?>&nbsp;</div>
	<div class="grid_3"><?php echo $this->Form->input('codigo', array( 'label'=>false, 'class'=>'grid_3' )); ?>&nbsp;</div>
	<div class="grid_5"><?php echo $this->Form->input('img_digital', array( 'label'=>false, 'class'=>'grid_4' )); ?>&nbsp;</div>
	<div class="grid_5"><?php echo $this->Form->input('ubicacion', array( 'label'=>false, 'class'=>'grid_4' )); ?>&nbsp;</div>
	<div class="grid_1 omega actions">
	<?php  echo $this->Form->input('id'); ?>
	<?php echo $ajax->submit( 'icons/save.gif', array('url'=> array('controller'=>'planols', 'action'=>'quick_edit'), 'update' => 'planol_'.$this->data['Planol']['id'], 'style'=>'float:left')); ?>
	<?php echo $ajax->link( $html->image( 'icons/page_cancel_mini.png', array( 'alt' => __( 'Cancel', true ), 'title' => __( 'Cancel', true ) ) ), array('action' => 'quick_edit', $this->data['Planol']['id'], true ), array( 'escape'=>false, 'update' => 'planol_'.$this->data['Planol']['id']) ); ?>
	</div>
		