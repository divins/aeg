	<h2><?php __('Parts');?></h2>
	<?php 
	echo $form->create('Part', array('class'=>'add_part_form') );?>
		<div class="grid_4 alpha">
			<div class="search_labels">
			<?php
			echo __("Part",true);
			?>
			</div>
		<?php
			$style['type'] = 'text';
			$style['class'] = 'search_field_value';
			$style['div'] = false;
			$style['label'] = false;
			echo $form->input('Part.child_id' ,$style);
		?>
		</div>
		<div class="grid_4">
			<div class="search_labels">
			<?php
			echo __("Quantity",true);
			?>
			</div>
		<?php
			$style['type'] = 'text';
			$style['class'] = 'search_field_value';
			$style['div'] = false;
			$style['label'] = false;
			echo $form->input('Part.quantitat' ,$style);
		?>
		</div>
		<?php
			echo $form->input( 'Part.id' );
			$submit_options['url']['controller'] = "parts";
			$submit_options['url']['action'] = "add_part";
			$submit_options['update'] = "components";
			$submit_options['div'] = false;
			$submit_options['class'] = 'submit_image';
			echo $ajax->submit('icons/add_21.png', $submit_options)
		?>
	<?php echo $form->end();?>
		<div class="clear"></div>
<?php 
	if (!empty($this->data['Part']))
	{
?>
		<div class="grid_16 alpha omega">
			<table>
				<tr>
					<th class="partid_col_th"><?php __('Piece_ID'); ?></th>
					<th class="quantity_col"><?php __('Quantity'); ?></th>
					<th class="piecec_col"><?php __('Piece_Code'); ?></th>
					<th class="unityc_col"><?php __('Unit_Code'); ?></th>
					<th class="denomination_col_th"><?php __('Denomination'); ?></th>
					<th class="admin_motors_actions"><?php __('Actions'); ?></th>
				</tr>
			</table>
		</div>
<?php
		$level = 0;
		$y = 0;
		foreach ($this->data['Child'] as $part)
		{
			$color_class = "color_".$level."_hard";
			if ($y++ % 2 == 0) { $color_class = "color_".$level."_soft"; }
			?>
			<div id="<?php echo $part['id']."_0";?>" class="grid_16 alpha omega <?php echo $color_class; ?>">
				<table>
					<tr>
						<td class="partid_col_td <?php echo $color_class; ?>"><?php echo $ajax->link( $part['id'], array( 'controller' => 'parts', 'action' => 'parts_of_parts_list', $part['id'], $level, $part['PartsPart']['cantidad'], $color_class, $part['id'], $this->data['Part']['id'], 1 ), array( 'update' => $part['id']."_0", $color_class ) );?></td>
						<td class="quantity_col <?php echo $color_class; ?>"><?php echo $part['PartsPart']['cantidad'];?></td>
						<td class="piecec_col <?php echo $color_class; ?>"><?php echo $part['clave_pieza'];?></td>
						<td class="unityc_col <?php echo $color_class; ?>"><?php echo $part['clave_unidad'];?></td>
						<td class="denomination_col_td <?php echo $color_class; ?>"><?php echo $part['denominacion'];?></td>
						<td class="admin_motors_actions <?php echo $color_class; ?>"><?php 
							echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols',$part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );
							echo $ajax->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Quick_Edit', true ), 'title' => __( 'Quick_Edit', true ) ) ), array( 'controller' => 'parts', 'action' => 'quick_edit_wqty', $this->data['Part']['id'], $part['id'], 0, $color_class, $level, $part['id'] ), array( 'escape'=>false, 'update' => $part['id']."_0" ) );
							echo $this->Html->link( $html->image( 'icons/page_advanced_edit_mini.png', array( 'alt' => __( 'Advanced_Edit', true ), 'title' => __( 'Advanced_Edit', true ) ) ), array( 'controller' => 'parts', 'action' => 'edit', $part['id'] ), array( 'escape'=>false, 'target'=>'_blank' ) );
							echo $ajax->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Delete_Relationship', true ), 'title' => __( 'Delete_Relationship', true ) ) ), array( 'controller' => 'parts', 'action' => 'del_part', $this->data['Part']['id'], $part['id'] ), array( 'escape'=>false, 'update' => 'components' ), __( "Do_you_really_wanna_delete_relationship_between_part_and_part?", true ) );
						?>
						</td>					
					</tr>
				</table>
				<div id="<?php echo $part['id'];?>_childs" Style=" display:hidden"></div>
			</div>
<?php
		}
	}
?>