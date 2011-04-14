<?php
echo $html->script('prototype');
echo $html->script('CSSPopUp');

$colors_depth[0][0] = "DDDDDD";
$colors_depth[0][1] = "999999";
$colors_depth[1][0] = "FF9595";
$colors_depth[1][1] = "FFCACA";
$colors_depth[2][0] = "FFCE95";
$colors_depth[2][1] = "FFBA6B";
$colors_depth[3][0] = "FFF9A4";
$colors_depth[3][1] = "FFF66B";
$colors_depth[4][0] = "D7FFA4";
$colors_depth[4][1] = "BBFD65";
$colors_depth[5][0] = "C2FDE0";
$colors_depth[5][1] = "65FDB1";
?>

<div <?php echo "id='motor_".$this->data['Part']['id']."'"; ?> class="grid_16">
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
<?php echo $this->Form->end(__('Save', true));?>
</div>

<div class="clear" Style="margin-top:35px;">&nbsp;</div>
<div id="planol_edit" Style="margin-bottom: 15px; margin-top: 35px;">
	<h3><?php __('Plans');?></h3>
	<div id="planol_add_form">
	<?php echo $form->create('Planol');?>
		<fieldset>
		<?php
			$options['label'] = false;
			$options['value'] = "";		
			$options['type'] = "text";		
			$options['before'] = __( 'ID_Plan', true ).": ";
			$options['div']['style'] = 'float: left; width: 150px; vertical-align: bottom;';
			$options['style'] = 'float:both; width: 70px; font-weight: normal;';
			echo $form->input( 'Planol.id', $options );
			echo $form->input( 'Part.id' );
			/*$options['before'] = __( 'Codi Planol', true ).": ";
			$options['div']['style'] = 'float: left; width: 210px; vertical-align: bottom;';
			$options['style'] = 'float:both; width: 150px; font-weight: normal;';
			echo $form->input( 'Planol.codigo', $options );*/
			$submit_options['url']['controller'] = "parts";
			$submit_options['url']['action'] = "add_planol";
			$submit_options['update'] = "planol_edit";
			$submit_options['div']['style'] = 'float: left; width: 20px; text-align: left; margin-left: 10px; vertical-align:super; margin-top: 0px';
			echo $ajax->submit('icons/add_21.png', $submit_options)
		?>
		</fieldset>
	<?php echo $form->end();?>
	</div>
	<div class="clear" Style="margin-top:15px;"></div>
	<div id="planols_list">
		<table>
			<tr>
				<td Style="min-width:100px; text-align:center;"><?PHP echo __( 'ID', true ); ?></td>
				<td Style="min-width:100px; text-align:center;"><?PHP echo __( 'Code', true ); ?></td>
				<td Style="min-width:200px; text-align:center;"><?PHP echo __( 'Digital_Image', true ); ?></td>
				<td Style="min-width:200px; text-align:center;"><?PHP echo __( 'Location', true ); ?></td>
				<td Style="min-width:170px; text-align:center;"><?PHP echo __( 'Actions', true ); ?></td>
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
			.$ajax->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Delete_Relationship', true ), 'title' => __( 'Delete_Relationship', true ) ) ), array( 'controller' => 'parts', 'action' => 'admin_del_planol', $this->data['Part']['id'], $planol['id'] ), array( 'escape'=>false, 'update' => 'planol_edit'), __( "Do_you_really_wanna_delete_relationship_between_part_and_plan?", true ) )
			//.$html->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Edit', true ), 'title' => __( 'Edit', true ) ) ), array('controller'=>'planols', 'action'=>'edit', $planol['id'] ), array('escape'=>false) )
			."</td></tr>";
	}
	?>
		</table>
	</div>
</div>
<div class="clear"></div>

<div id="parts_edit" class="grid_16" Style="margin-top:40px;">
	<h3><?php __('Parts');?></h3>
	<div id="part_add_form">
	<?php echo $form->create('Part');?>
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
			/*$options['before'] = __( 'Codi Planol', true ).": ";
			$options['div']['style'] = 'float: left; width: 210px; vertical-align: bottom;';
			$options['style'] = 'float:both; width: 150px; font-weight: normal;';
			echo $form->input( 'Planol.codigo', $options );*/
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
					<!--<th class="actions"><?php //__('Actions');?></th>-->
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
	}
?>
</div>