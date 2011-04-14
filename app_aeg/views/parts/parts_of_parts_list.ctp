<?php
echo $html->script('prototype');
echo $html->script('CSSPopUp');
//echo $html->script('scriptaculous');
?>
<table>
	<tr><!-- el primer enllaç ha de mostrar/amagar el DIV id_childs -->
		<?php if (!empty($parts['Child'])) { ?>
		<td class="partid_col_td <?php echo $color_class; ?>"><a href="javascript: void toggle('<?php echo $parts["Part"]['id']."_".($level-1)."_childs"; ?>')"><?php echo $parts["Part"]['id']; ?></a></td>
		<?php }else{ ?>
		<td class="partid_col_td <?php echo $color_class; ?>"><?php echo $parts["Part"]['id']; ?></td>
		<?php } ?>
		<td class="quantity_col <?php echo $color_class; ?>"><?php echo $parent_qty; ?></td>
		<td class="piecec_col <?php echo $color_class; ?>"><?php echo $parts["Part"]['clave_pieza']; ?></td>
		<td class="unityc_col <?php echo $color_class; ?>"><?php echo $parts["Part"]['clave_unidad']; ?></td>
		<td class="denomination_col_td <?php echo $color_class; ?>"><?php echo $parts["Part"]['denominacion']; ?></td>
		<td class="plan_col <?php echo $color_class; ?>"><?php echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $parts["Part"]['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );?></td>
	</tr>
</table>
<?php
if (!empty($parts['Child']))
{
?>
	<div id="<?php echo $parts["Part"]['id']."_".($level-1);?>_childs" class="component_son" Style="width:<?php echo 940-($level*15); ?>px;">
<?php 
		$z = 0;
		foreach ($parts['Child'] as $part)
		{
			$color_level = substr(sprintf("%01.1f", ($level/5)), -1);
			$color_class = "color_".$color_level."_hard";
			if ($y++ % 2 == 0) { $color_class = "color_".$color_level."_soft"; }
			if( $part['denominacion'] != "ERROR_REPEATED_ELEMENT_IN_TRACE" )
			{
?>
				<div id="<?php echo $part['id']."_".($level-1);?>" class="<?php echo $color_class;?>">
					<table>
						<tr>
							<?php if( isset( $part['sons'] ) ){ ?>
							<td class="partid_col_td <?php echo $color_class; ?>"><?php echo $ajax->link( $part['id'], array( 'controller' => 'parts', 'action' => 'parts_of_parts_list', $part['id'], $level, $part['PartsPart']['cantidad'], $color_class, $trace.",".$part['id'] ), array( 'update' => $part['id']."_".($level-1) ) );?></td>
							<?php } else { if( $part['denominacion'] == __("ERROR->ELEMENT REPETIT A LA TRAÇA",true) ){ $color_class="error"; }?>
							<td class="partid_col_td <?php echo $color_class; ?>"><?php echo $part['id']; ?></td>
							<?php } ?>
							<td class="quantity_col <?php echo $color_class; ?>"><?php echo $part['PartsPart']['cantidad']; ?></td>
							<td class="piecec_col <?php echo $color_class; ?>"><?php echo $part['clave_pieza']; ?></td>
							<td class="unityc_col <?php echo $color_class; ?>"><?php echo $part['clave_unidad']; ?></td>
							<td class="denomination_col_td <?php echo $color_class; ?>"><?php echo utf8_encode($part['denominacion']); ?></td>
							<td class="plan_col <?php echo $color_class; ?>"><?php echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );?></td>
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