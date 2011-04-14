<?php
$level = 0;
//$style = "FF0000";
$part = $part['Part'];
?>
<table>
	<tr>
		<td class="partid_col_td <?php echo $color_class; ?>"><?php echo $ajax->link( $part['id'], array( 'controller' => 'parts', 'action' => 'parts_of_parts_list', $part['id'], $level, $part['MotorsPart']['cantidad'], $color_class, $part['id'], $motor_id ), array( 'update' => $part['id']."_0", $color_class ) );?></td>
		<td class="quantity_col <?php echo $color_class; ?>"><?php echo $part['MotorsPart']['cantidad'];?></td>
		<td class="piecec_col <?php echo $color_class; ?>"><?php echo $part['clave_pieza'];?></td>
		<td class="unityc_col <?php echo $color_class; ?>"><?php echo $part['clave_unidad'];?></td>
		<td class="denomination_col_td <?php echo $color_class; ?>"><?php echo $part['denominacion'];?></td>
		<!--<td class="plan_col <?php/* echo $color_class; ?>"><?php echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );*/?></td>-->
		<td class="admin_motors_actions <?php echo $color_class; ?>">
		<?php 
			echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols',$part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );
			echo $ajax->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Quick_Edit', true ), 'title' => __( 'Quick_Edit', true ) ) ), array( 'controller' => 'motors', 'action' => 'quick_edit_part', $motor_id, $part['id'], 0, $color_class ), array( 'escape'=>false, 'update' => $part['id']."_0" ) );
			echo $this->Html->link( $html->image( 'icons/page_advanced_edit_mini.png', array( 'alt' => __( 'Advanced_Edit', true ), 'title' => __( 'Advanced_Edit', true ) ) ), array( 'controller' => 'parts', 'action' => 'edit', $part['id'] ), array( 'escape'=>false, 'target'=>'_blank' ) );
			//echo $ajax->link( $html->image( 'icons/page_add_mini.png', array( 'alt' => __( 'Afegir Part', true ), 'title' => __( 'Afegir Part', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $parts["Part"]['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );
			echo $ajax->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Delete_Relationship', true ), 'title' => __( 'Delete_Relationship', true ) ) ), array( 'controller' => 'motors', 'action' => 'del_part', $this->data['Motor']['id'], $part['id'] ), array( 'escape'=>false, 'update' => 'components' ), __( "Do_you_really_wanna_delete_relationship_between_motor_and_part?", true ) );
			//echo $ajax->link( $html->image( 'icons/refresh.gif', array( 'alt' => __( 'Refresh', true ), 'title' => __( 'Refresh', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );
		?>
		</td>	
	</tr>
</table>
