<?php
//DEBUG( $this->data );
?>
<div class="motorid_col <?php echo $color_class; ?>"><?php echo $this->data['Motor']['id']; ?>&nbsp;</div>
<div class="piecec_col <?php echo $color_class; ?>"><?php echo $this->data['Motor']['clave_pieza']; ?>&nbsp;</div>
<div class="unityc_col <?php echo $color_class; ?>"><?php echo $this->data['Motor']['clave_unidad']; ?>&nbsp;</div>
<div class="denomination_col <?php echo $color_class; ?>"><?php echo $this->data['Motor']['denominacion']; ?>&nbsp;</div>
<div class="serie_col <?php echo $color_class; ?>"><?php echo $this->data['Serie']['codigo']; ?>&nbsp;</div>
<div class="height_col <?php echo $color_class; ?>"><?php echo $this->data['Motor']['altura']; ?>&nbsp;</div>
<div class="power_col <?php echo $color_class; ?>"><?php echo $this->data['Motor']['potencia']; ?>&nbsp;</div>
<div class="voltage_col <?php echo $color_class; ?>"><?php echo $this->data['Motor']['tension']; ?>&nbsp;</div>
<div class="shape_col <?php echo $color_class; ?>"><?php echo $this->data['Motor']['forma']; ?>&nbsp;</div>
<div class="admin_motors_actions <?php echo $color_class; ?>">
	<?php echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'motors', 'action' => 'mostrar_planols', $this->data['Motor']['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );?>
	<?php echo $ajax->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Quick_Edit', true ), 'title' => __( 'Quick_Edit', true ) ) ), array('action' => 'quick_edit', $this->data['Motor']['id'], 0, $color_class ), array( 'escape'=>false, 'update' => 'motor_'.$this->data['Motor']['id']) );?>
	<?php echo $this->Html->link( $html->image( 'icons/page_advanced_edit_mini.png', array( 'alt' => __( 'Advanced_Edit', true ), 'title' => __( 'Advanced_Edit', true ) ) ), array('action' => 'edit', $this->data['Motor']['id']), array( 'escape'=>false, 'target'=>'_blank' ) ); ?>
	<?php echo $this->Html->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Delete_Motor', true ), 'title' => __( 'Delete_Motor', true ) ) ), array('action' => 'delete', $this->data['Motor']['id']), array( 'escape'=>false), sprintf(__('Do_you_really_wanna_delete_motor?', true), $this->data['Motor']['id']) ); ?>
</div>
