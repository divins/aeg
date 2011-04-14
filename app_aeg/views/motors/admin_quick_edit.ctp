<?php
//DEBUG( $this->data );
$class="";
echo $this->Form->create('Motor');
$style['type'] = 'text';
$style['class'] = 'quick_edit_tbox';
$style['div'] = false;
$style['label'] = false;
?>
	<div class="motorid_col"><?php echo $this->data['Motor']['id']; ?>&nbsp;</div>
	<div class="piecec_col"><?php echo $this->Form->input('clave_pieza', $style); ?>&nbsp;</div>
	<div class="unityc_col"><?php echo $this->Form->input('clave_unidad', $style); ?>&nbsp;</div>
	<div class="denomination_col"><?php echo $this->Form->input('denominacion', $style); ?>&nbsp;</div>
	<div class="serie_col"><?php echo $this->Form->input('Serie.codigo', $style ); ?>&nbsp;</div>
	<div class="height_col"><?php echo $this->Form->input('altura', $style); ?>&nbsp;</div>
	<div class="power_col"><?php echo $this->Form->input('potencia', $style); ?>&nbsp;</div>
	<div class="voltage_col"><?php echo $this->Form->input('tension', $style); ?>&nbsp;</div>
	<div class="shape_col"><?php echo $this->Form->input('forma', $style); ?>&nbsp;</div>
	<div class="admin_motors_actions">
		<?php 
			echo $this->Form->input('id'); 
			echo $this->Form->input('row_info.color_class', array('value'=>$color_class, 'type'=>'hidden') );
		?>
		<?php //echo $ajax->submit('Gu', array('url'=> array('controller'=>'motors', 'action'=>'quick_edit'), 'update' => 'motor_'.$this->data['Motor']['id'])); ?>
		<?php
			$action = "quick_edit";
			if( isset($standard_edit) ) 
			{ 
				echo $ajax->submit( 'icons/save.gif', array('url'=> array('controller'=>'motors', 'action'=>'edit'), 'update' => 'motor_'.$this->data['Motor']['id'] ) ); 
				echo $ajax->link( $html->image( 'icons/page_cancel_mini.png', array( 'alt' => __( 'Cancel', true ), 'title' => __( 'Cancel', true ) ) ), array('action' => 'edit', $this->data['Motor']['id'], true ), array( 'escape'=>false, 'update' => 'motor_'.$this->data['Motor']['id']) );
			}
			else
			{ 
				echo $ajax->submit( 'icons/save.gif', array('url'=> array('controller'=>'motors', 'action'=>'quick_edit', $this->data['Motor']['id'],0,$color_class), 'update' => 'motor_'.$this->data['Motor']['id'] ) ); 
				echo $ajax->link( $html->image( 'icons/page_cancel_mini.png', array( 'alt' => __( 'Cancel', true ), 'title' => __( 'Cancel', true ) ) ), array('action' => 'quick_edit', $this->data['Motor']['id'], true, $color_class ), array( 'escape'=>false, 'update' => 'motor_'.$this->data['Motor']['id']) );
			}
		?>
	</div>
<?php echo $form->end(); ?>