<?php
//DEBUG( $this->data );
$class="";
?>
<div <?php echo "id='serie_".$this->data['Series']['id']."' ".$class; ?>>
	<?php echo $this->Form->create('Series'); ?>
	<?php //$ajax->form('quick_edit','serie',array('model'=>'Serie','update'=>'serie_'.$this->data['Series']['id'])); ?>
	<div class="grid_1 alpha"><?php echo $this->data['Series']['id']; ?>&nbsp;</div>
	<div class="grid_2"><?php echo $this->Form->input('codigo', array( 'label'=>false )); ?>&nbsp;</div>
	<div class="grid_8"><?php echo $this->Form->input('descripcion', array( 'label'=>false )); ?>&nbsp;</div>
	<div class="grid_4 omega actions">
	<?php //echo $ajax->form->end(__('Guardar', true));?>
	<?php  echo $this->Form->input('id'); ?>
	<?php echo $ajax->submit( 'icons/save.gif', array('url'=> array('controller'=>'series', 'action'=>'quick_edit'), 'update' => 'serie_'.$this->data['Series']['id'])); ?>
	<?php echo $ajax->link( $html->image( 'icons/page_cancel_mini.png', array( 'alt' => __( 'Cancelar', true ), 'title' => __( 'Cancelar', true ) ) ), array('action' => 'quick_edit', $this->data['Series']['id'], true ), array( 'escape'=>false, 'update' => 'serie_'.$this->data['Series']['id']) ); ?>
	</div>
</div>
		