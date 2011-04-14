<?php
//DEBUG( $this->data );
//DEBUG($part);
$class="";
$style['div'] = false;
?>
<?php echo $this->Form->create('Part', array('class'=>'InTableForm') ); ?>
<table>
	<tr>
		<td class="partid_col_td <?php echo $color_class; ?>"><?php echo $part['id'];?></td>
		<td class="quantity_col <?php echo $color_class; ?>"><?php echo $this->Form->input( 'Part.quantitat', array('value'=>$part['PartsPart']['cantidad'], 'label'=>false, 'div'=>false) );?></td>
		<td class="piecec_col <?php echo $color_class; ?>"><?php echo $this->Form->input('clave_pieza', array( 'value'=>$part['clave_pieza'], 'label'=>false, 'div'=>false )); ?></td>
		<td class="unityc_col <?php echo $color_class; ?>"><?php echo $this->Form->input('clave_unidad', array( 'value'=>$part['clave_unidad'], 'label'=>false, 'div'=>false )); ?></td>
		<td class="denomination_col_td <?php echo $color_class; ?>"><?php echo $this->Form->input('denominacion', array( 'value'=>$part['denominacion'], 'label'=>false, 'div'=>false )); ?></td>
		<!--<td class="plan_col <?php/* echo $color_class; ?>"><?php echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );*/?></td>-->
		<td class="admin_motors_actions <?php echo $color_class; ?>">
		<?php 
			echo $this->Form->input('id', array('value'=>$part['id']) );
			echo $this->Form->input('Parent.id', array('value'=>$part['parent_id'], 'type'=>'hidden') );
			echo $this->Form->input('RowInfo.style', array('value'=>$color_class, 'type'=>'hidden') );
			echo $this->Form->input('RowInfo.trace', array('value'=>$trace, 'type'=>'hidden') );
			echo $this->Form->input('RowInfo.level', array('value'=>$level, 'type'=>'hidden') );
			echo $ajax->submit( 'icons/save.gif', array('url'=> array('controller'=>'parts', 'action'=>'quick_edit_wqty'), 'update' => $part['id']."_".$level));
			echo $ajax->link( $html->image( 'icons/page_cancel_mini.png', array( 'alt' => __( 'Cancel', true ), 'title' => __( 'Cancel', true ) ) ), array('controller'=>'parts', 'action' => 'quick_edit_wqty', $part['parent_id'],$part['id'], true, $color_class, $level, $trace ), array( 'escape'=>false, 'update' => $part['id']."_".$level) );
		?>
		</td>	
	</tr>
</table>
</div>