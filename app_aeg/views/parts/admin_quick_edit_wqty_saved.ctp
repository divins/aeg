<table>
	<tr>
		<?php if( isset( $part['sons'] ) ){ ?>
		<td class="partid_col_td <?php echo $color_class; ?>"><?php echo $ajax->link( $part['id'], array( 'controller' => 'parts', 'action' => 'parts_of_parts_list', $part['id'], $level, $part['PartsPart']['cantidad'], $color_class, $trace.",".$part['id'], $part["parent_id"], 1 ), array( 'update' => $part['id']."_".($level) ) );?></td>
		<?php } else { ?>
		<td class="partid_col_td <?php echo $color_class; ?>"><?php echo $part['id']; ?></td>
		<?php } ?>
		<td class="quantity_col <?php echo $color_class; ?>"><?php echo $part['PartsPart']['cantidad']; ?></td>
		<td class="piecec_col <?php echo $color_class; ?>"><?php echo $part['clave_pieza']; ?></td>
		<td class="unityc_col <?php echo $color_class; ?>"><?php echo $part['clave_unidad']; ?></td>
		<td class="denomination_col_td <?php echo $color_class; ?>"><?php echo utf8_encode($part['denominacion']); ?></td>
		<td  class="admin_motors_actions <?php echo $color_class; ?>">
		<?php 
			echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );
			echo $ajax->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Quick_Edit', true ), 'title' => __( 'Quick_Edit', true ) ) ), array( 'controller' => 'parts', 'action' => 'admin_quick_edit_wqty', $part["parent_id"], $part['id'], 0, $color_class, $level, $trace ), array( 'escape'=>false, 'update' => $part['id']."_".($level) ) );
			echo $html->link( $html->image( 'icons/page_advanced_edit_mini.png', array( 'alt' => __( 'Advanced_Edit', true ), 'title' => __( 'Advanced_Edit', true ) ) ), array( 'controller' => 'parts', 'action' => 'edit', $part['id'] ), array( 'escape'=>false, 'target'=>'_blank' ) );
			//echo $ajax->link( $html->image( 'icons/page_add_mini.png', array( 'alt' => __( 'Afegir Part', true ), 'title' => __( 'Afegir Part', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv' ) );
			//echo $ajax->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Eliminar Relacio', true ), 'title' => __( 'Eliminar Relacio', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv' ) );
			echo $ajax->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Delete_Relationship', true ), 'title' => __( 'Delete_Relationship', true ) ) ), array( 'controller' => 'parts', 'action' => 'del_part', $part["parent_id"], $part['id'] ), array( 'escape'=>false, 'update' => 'components' ), __( "Do_you_really_wanna_delete_relationship_between_part_and_part?", true ) );
			//echo $ajax->link( $html->image( 'icons/refresh.gif', array( 'alt' => __( 'Refresh', true ), 'title' => __( 'Refresh', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv' ) );
		?>
		</td>
	</tr>
</table>
<div id="<?php echo $part['id'];?>_childs" Style=" display:hidden;"></div>