<?php
echo $html->script('prototype');
echo $html->script('CSSPopUp');
?>
<table>
	<tr>
		<?php if (!empty($parts['Child'])) { ?>
		<td class="partid_col_td <?php echo $color_class; ?>"><a href="javascript: void toggle('<?php echo $parts["Part"]['id']."_".($level-1)."_childs"; ?>')"><?php echo $parts["Part"]['id']; ?></a></td>
		<?php }else{ ?>
		<td class="partid_col_td <?php echo $color_class; ?>"><?php echo $parts["Part"]['id']; ?></td>
		<?php } ?>
		<td class="quantity_col <?php echo $color_class; ?>"><?php echo $parent_qty;?></td>
		<td class="piecec_col <?php echo $color_class; ?>"><?php echo $parts["Part"]['clave_pieza'];?></td>
		<td class="unityc_col <?php echo $color_class; ?>"><?php echo $parts["Part"]['clave_unidad'];?></td>
		<td class="denomination_col_td <?php echo $color_class; ?>"><?php echo $parts["Part"]['denominacion'];?></td>
		<td class="admin_motors_actions <?php echo $color_class; ?>">
		<?php 
			echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols',$parts["Part"]['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );
			if( isset( $ParentID['Motor'] ) ){ echo $ajax->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Quick_Edit', true ), 'title' => __( 'Quick_Edit', true ) ) ), array( 'controller' => 'motors', 'action' => 'quick_edit_part', $ParentID['Motor'], $parts['Part']['id'], 0, $color_class ), array( 'escape'=>false, 'update' => $parts['Part']['id']."_0" ) ); }
			else{ echo $ajax->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Quick_Edit', true ), 'title' => __( 'Quick_Edit', true ) ) ), array( 'controller' => 'parts', 'action' => 'admin_quick_edit_wqty', $ParentID['Part'], $parts['Part']['id'], 0, $color_class, ($level-1), $trace ), array( 'escape'=>false, 'update' => $parts['Part']['id']."_".($level-1) ) ); }
			echo $this->Html->link( $html->image( 'icons/page_advanced_edit_mini.png', array( 'alt' => __( 'Advanced_Edit', true ), 'title' => __( 'Advanced_Edit', true ) ) ), array( 'controller' => 'parts', 'action' => 'edit', $parts['Part']['id'] ), array( 'escape'=>false, 'target'=>'_blank' ) );
			if( $level == 1 )
			{ 
				if( isset( $ParentID['Motor'] ) ){ echo $ajax->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Delete_Relationship', true ), 'title' => __( 'Delete_Relationship', true ) ) ), array( 'controller' => 'motors', 'action' => 'del_part', $ParentID['Motor'], $parts['Part']['id'] ), array( 'escape'=>false, 'update' => 'components' ), __( "Do_you_really_wanna_delete_relationship_between_motor_and_part?", true ) ); }
				else{ echo $ajax->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Delete_Relationship', true ), 'title' => __( 'Delete_Relationship', true ) ) ), array( 'controller' => 'motors', 'action' => 'del_part', $ParentID['Part'], $parts['Part']['id'] ), array( 'escape'=>false, 'update' => 'components' ), __( "Do_you_really_wanna_delete_relationship_between_part_and_part?", true ) ); }
			}
		?>
		</td>	
	</tr>
</table>
<?php
if (!empty($parts['Child']))
{

?>
	<div id="<?php echo $parts["Part"]['id']."_".($level-1);?>_childs" class="component_son" Style="width:<?php echo 940-($level*15); ?>px; margin-left:15px;">
		<?php 
		$y = 0;
		
		foreach ($parts['Child'] as $part)
		{
			$color_level = substr(sprintf("%01.1f", ($level/5)), -1);
			$color_class = "color_".$color_level."_hard";
			if ($y++ % 2 == 0) { $color_class = "color_".$color_level."_soft"; }
			if( $part['denominacion'] != "ERROR_REPEATED_ELEMENT_IN_TRACE" )
			{
		?>
				<div id="<?php echo $part['id']."_".($level);?>" class="<?php echo $color_class;?>">
					<table>
						<tr>
							<?php if( isset( $part['sons'] ) ){ ?>
							<td class="partid_col_td <?php echo $color_class; ?>"><?php echo $ajax->link( $part['id'], array( 'controller' => 'parts', 'action' => 'parts_of_parts_list', $part['id'], $level, $part['PartsPart']['cantidad'], $color_class, $trace.",".$part['id'], $parts["Part"]['id'], 1 ), array( 'update' => $part['id']."_".($level) ) );?></td>
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
								echo $ajax->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Quick_Edit', true ), 'title' => __( 'Quick_Edit', true ) ) ), array( 'controller' => 'parts', 'action' => 'admin_quick_edit_wqty', $parts["Part"]['id'], $part['id'], 0, $color_class, $level, $trace ), array( 'escape'=>false, 'update' => $part['id']."_".($level) ) );
								echo $html->link( $html->image( 'icons/page_advanced_edit_mini.png', array( 'alt' => __( 'Advanced_Edit', true ), 'title' => __( 'Advanced_Edit', true ) ) ), array( 'controller' => 'parts', 'action' => 'edit', $part['id'] ), array( 'escape'=>false, 'target'=>'_blank' ) );
								//echo $ajax->link( $html->image( 'icons/page_add_mini.png', array( 'alt' => __( 'Afegir Part', true ), 'title' => __( 'Afegir Part', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv' ) );
								//echo $ajax->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Eliminar Relacio', true ), 'title' => __( 'Eliminar Relacio', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv' ) );
								//echo $ajax->link( $html->image( 'icons/refresh.gif', array( 'alt' => __( 'Refresh', true ), 'title' => __( 'Refresh', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv' ) );
							?>
							</td>
						</tr>
					</table>
					<div id="<?php echo $part['id'];?>_childs" Style=" display:hidden;"></div>
				</div>
<?php
			}
			else
			{
?>
				<div id="<?php echo $part['id']."_".($level-1);?>" class="<?php echo $color_class;?>">
					<table>
						<tr>
							<td class="error"><?php echo $part['id']; ?></td><td colspan="5" class="error"><?php echo __("ERROR_REPEATED_ELEMENT_IN_TRACE",true); ?></<td>
						</tr>
					</table>
					<div id="<?php echo $part['id'];?>_childs" Style=" display:hidden;"></div>
				</div>
<?php
			}
		}
?>
	</div>
<?php
}
?>