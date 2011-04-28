<?php
echo $html->script('prototype');
echo $html->script('CSSPopUp');


?>
<div id="parts_result_list" class="grid_16">
	<h2><?php echo __('Part',true); ?></h2>
	<table>
		<tr>
			<th class="part-result_id_col"><?php echo __('ID',true);?></th>
			<th class="part-result_piecec_col"><?php echo __('Piece_Code',true);?></th>
			<th class="part-result_unityc_col"><?php echo __('Unit_Code',true);?></th>
			<th class="part-result_denomination_col"><?php echo __('Denomination',true);?></th>
			<th class="part-admin_motors_actions">&nbsp;</th>
		</tr>
	</table>
	<div class="part_result_row" id="<?php echo "part_".$this->data['Part']['id']; ?>">
		<?php
		$class="";
		echo $this->Form->create('Part', array('class'=>'InTableForm'));
		$style['type'] = 'text';
		$style['class'] = 'quick_edit_tbox';
		$style['div'] = false;
		$style['label'] = false;
		?>
			<div class="part-result_id_col"><?php echo $this->data['Part']['id']; ?>&nbsp;</div>
			<div class="part-result_piecec_col"><?php echo $this->Form->input('clave_pieza', $style); ?>&nbsp;</div>
			<div class="part-result_unityc_col"><?php echo $this->Form->input('clave_unidad', $style); ?>&nbsp;</div>
			<div class="part-result_denomination_col"><?php echo $this->Form->input('denominacion', $style); ?>&nbsp;</div>
			<div class="part-admin_motors_actions">
				<?php echo $this->Form->input('id'); ?>
				<?php //echo $ajax->submit('Gu', array('url'=> array('controller'=>'motors', 'action'=>'quick_edit'), 'update' => 'motor_'.$this->data['Motor']['id'])); ?>
				<?php echo $ajax->submit( 'icons/save.gif', array('url'=> array('controller'=>'parts', 'action'=>'edit'), 'update' => 'part_'.$this->data['Part']['id'] ) ); ?>
				<?php echo $ajax->link( $html->image( 'icons/page_cancel_mini.png', array( 'alt' => __( 'Cancel', true ), 'title' => __( 'Cancel', true ) ) ), array('action' => 'edit', $this->data['Part']['id'], true ), array( 'escape'=>false, 'update' => 'part_'.$this->data['Part']['id']) ); ?>
			</div>
		<?php echo $form->end(); ?>
	</div>
</div>
<!--
<div <?php/* echo "id='motor_".$this->data['Part']['id']."'"; ?> class="grid_16">
<?php echo $this->Form->create('Part');?>
	<fieldset>
 		<legend><?php __('Edit_Part'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('clave_pieza');
		echo $this->Form->input('clave_unidad');
		echo $this->Form->input('denominacion');
		//echo $this->Form->input('Motor', array( 'type' => 'text' ) );
		//echo $this->Form->input('Part', array( 'type' => 'text' ) );
		//echo $this->Form->input('Planol', array( 'type' => 'text' ) );
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));*/?>
</div>-->

<div class="clear" Style="margin-top:35px;">&nbsp;</div>
<div id="plans" class="grid_16">
	<h2><?php __('Plans');?></h2>
	
	<?php echo $form->create('Planol', array('class'=>'add_plan_form') );?>
			
			<div class="search_labels">
			<?php
			echo __("ID_Plan",true);
			?>
			</div>
		<?php
			$style['type'] = 'text';
			$style['class'] = 'search_field_value';
			$style['div'] = false;
			$style['label'] = false;
			echo $form->input('Planol.id' ,$style);
			echo $form->input( 'Part.id' );
			$submit_options['url']['controller'] = "parts";
			$submit_options['url']['action'] = "add_planol";
			$submit_options['update'] = "plans";
			$submit_options['div'] = false;
			$submit_options['class'] = 'submit_image';
			echo $ajax->submit('icons/add_21.png', $submit_options)
		?>
		<!--</fieldset>-->
	<?php echo $form->end();?>
	<div id="plans_list">
		<table>
			<tr>
				<th class="PlansList_id"><?PHP echo __( 'ID_Plan', true ); ?></th>
				<th class="PlansList_Code"><?PHP echo __( 'Code', true ); ?></th>
				<th class="PlansList_Image"><?PHP echo __( 'Digital_Image', true ); ?></th>
				<th class="PlansList_Location"><?PHP echo __( 'Location', true ); ?></th>
				<th class="PlansList_Actions"><?PHP echo __( 'Actions', true ); ?></th>
			</tr>
	<?PHP
	foreach( $this->data['Planol'] as $planol )
	{
		echo "<tr>"
			."<td>".$planol['id']."</td>"
			."<td>".$planol['codigo']."</td>"
			."<td>".$planol['img_digital']."</td>"
			."<td>".$planol['ubicacion']."</td>"
			."<td>".$ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'planols', 'action' => 'mostrar_planol',$planol['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) )
			.$ajax->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Delete_Relationship', true ), 'title' => __( 'Delete_Relationship', true ) ) ), array( 'controller' => 'parts', 'action' => 'admin_del_planol', $this->data['Part']['id'], $planol['id'] ), array( 'escape'=>false, 'update' => 'plans'), __( "Do_you_really_wanna_delete_relationship_between_part_and_plan?", true ) )
			//.$html->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Edit', true ), 'title' => __( 'Edit', true ) ) ), array('controller'=>'planols', 'action'=>'edit', $planol['id'] ), array('escape'=>false) )
			."</td></tr>";
	}
	?>
		</table>
	</div>
</div>

<!--
<div id="parts_edit" class="grid_16" Style="margin-top:40px;">
	<h3><?php __('Parts');?></h3>
	<div id="part_add_form">
	<?php /*echo $form->create('Part');?>
		<fieldset>
		<?php
			$options['label'] = false;
			$options['value'] = "";		
			$options['type'] = "text";		
			$options['before'] = __( 'ID_Part', true ).": ";
			$options['div']['style'] = 'float: left; width: 150px; vertical-align: bottom;';
			$options['style'] = 'float:both; width: 70px; font-weight: normal;';
			echo $form->input( 'Part.child_id', $options );
			$options['before'] = __( 'Quantity', true ).": ";
			echo $form->input( 'Part.quantitat', $options );
			echo $form->input( 'Part.id' );
			$submit_options['url']['controller'] = "parts";
			$submit_options['url']['action'] = "add_part";
			$submit_options['update'] = "parts_edit";
			$submit_options['div']['style'] = 'float: left; width: 20px; text-align: left; margin-left: 10px; vertical-align:super; margin-top: 0px';
			echo $ajax->submit('icons/add_21.png', $submit_options)
		?>
		</fieldset>
	<?php echo $form->end();?>
	</div>
	<div class="clear" Style="margin-top:15px;"></div>
<?php 
	if (!empty($this->data['Part']))
	{
	//DEBUG( $this->data );
?>
		<div class="grid_16 alpha omega">
			<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th Style="text-align:center;"><?php __('Piece_ID'); ?></th>
					<th Style="width:50px; text-align:center;"><?php __('Quantity'); ?></th>
					<th Style="width:50px; text-align:center;"><?php __('Piece_Code'); ?></th>
					<th Style="width:50px; text-align:center;"><?php __('Unit_Code'); ?></th>
					<th Style="width:350px; text-align:center;"><?php __('Denomination'); ?></th>
					<th Style="width:60px; text-align:center;"><?php __('Plan'); ?></th>
				</tr>
			</table>
		</div>
<?php
		$y = 0;
		$level = 0;
		foreach ($this->data['Child'] as $part)
		{
			$style = $colors_depth[$level][0];
			if ($y++ % 2 == 0) { $style = $colors_depth[$level][1]; }
?>
			<div id="<?php echo $part['id']."_0";?>" class="grid_16 alpha omega" Style="background-color:#<?php echo $style;?>">
				<table cellpadding = "0" cellspacing = "0" Style="margin-bottom:0px">
					<tr>
						<td Style="text-align:left; background-color:#<?php echo $style;?>"><?php echo $ajax->link( $part['id'], array( 'controller' => 'parts', 'action' => 'parts_of_parts_list', $part['id'], $level, $part['PartsPart']['cantidad'], $style, $part['id'], $this->data['Part']['id'], $style ), array( 'update' => $part['id']."_0" ) );?></td>
						<td Style="width:50px; text-align:center; background-color:#<?php echo $style;?>"><?php echo $part['PartsPart']['cantidad'];?></td>
						<td Style="width:50px; text-align:center; background-color:#<?php echo $style;?>"><?php echo $part['clave_pieza'];?></td>
						<td Style="width:50px; text-align:center; background-color:#<?php echo $style;?>"><?php echo $part['clave_unidad'];?></td>
						<td Style="width:330px; text-align:left; background-color:#<?php echo $style;?>"><?php echo $part['denominacion'];?></td>
						<td Style="width:80px; text-align:center; background-color:#<?php echo $style;?>"><?php 
							echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols',$part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );
							echo $ajax->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Quick_Edit', true ), 'title' => __( 'Quick_Edit', true ) ) ), array( 'controller' => 'parts', 'action' => 'quick_edit_part', $this->data['Part']['id'], $part['id'], 0, $style ), array( 'escape'=>false, 'update' => $part['id']."_0" ) );
							echo $this->Html->link( $html->image( 'icons/page_advanced_edit_mini.png', array( 'alt' => __( 'Advanced_Edit', true ), 'title' => __( 'Advanced_Edit', true ) ) ), array( 'controller' => 'parts', 'action' => 'edit', $part['id'] ), array( 'escape'=>false, 'target'=>'_blank' ) );
							//echo $ajax->link( $html->image( 'icons/page_add_mini.png', array( 'alt' => __( 'Afegir Part', true ), 'title' => __( 'Afegir Part', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $parts["Part"]['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );
							echo $ajax->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Delete_Relationship', true ), 'title' => __( 'Delete_Relationship', true ) ) ), array( 'controller' => 'parts', 'action' => 'del_part', $this->data['Part']['id'], $part['id'] ), array( 'escape'=>false, 'update' => 'parts_edit' ), __( "Do_you_really_wanna_delete_relationship_between_part_and_part?", true ) );
							echo $ajax->link( $html->image( 'icons/refresh.gif', array( 'alt' => __( 'Refresh', true ), 'title' => __( 'Refresh', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );
						?>
						</td>
					</tr>
				</table>
				<div id="<?php echo $part['id'];?>_childs" Style=" display:hidden"></div>
			</div>
<?php
		}
	}*/
?>
</div>-->
<div id="components" class="grid_16">
	<h2><?php __('Parts');?></h2>
	<?php 
	echo $form->create('Part', array('class'=>'add_part_form') );?>
		<!--<fieldset>-->
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
		<!--<div class="grid_7 omega">-->
		<?php
			echo $form->input( 'Part.id' );
			$submit_options['url']['controller'] = "parts";
			$submit_options['url']['action'] = "add_part";
			$submit_options['update'] = "components";
			$submit_options['div'] = false;
			$submit_options['class'] = 'submit_image';
			echo $ajax->submit('icons/add_21.png', $submit_options)
		?>
		<!--</div>-->
		<!--</fieldset>-->
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
							//echo $ajax->link( $html->image( 'icons/page_add_mini.png', array( 'alt' => __( 'Afegir Part', true ), 'title' => __( 'Afegir Part', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $parts["Part"]['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );
							echo $ajax->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Delete_Relationship', true ), 'title' => __( 'Delete_Relationship', true ) ) ), array( 'controller' => 'parts', 'action' => 'del_part', $this->data['Part']['id'], $part['id'] ), array( 'escape'=>false, 'update' => 'components' ), __( "Do_you_really_wanna_delete_relationship_between_part_and_part?", true ) );
							//echo $ajax->link( $html->image( 'icons/refresh.gif', array( 'alt' => __( 'Refresh', true ), 'title' => __( 'Refresh', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );
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
</div>