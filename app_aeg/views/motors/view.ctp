<?php
echo $html->script('prototype');
echo $html->script('CSSPopUp');
//echo $html->script('scriptaculous');
?>

<div id="motor" class="grid_16">
	<h2><?php echo __('Motor',true)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$this->Html->link( $html->image( 'icons/export_to_html_35.png', array( 'alt' => __( 'Export_to_Html', true ), 'title' => __( 'Export_to_Html', true ) ) ), array('controller'=>'parts', 'action'=>'get_all_childs', $motor['Motor']['id']), array( 'escape'=>false, 'target'=>'_blank' ) );;?></h2>
	<?php echo $this->Html->link( __( "New_Search", true ), array('controller'=>'motors', 'action'=>'index' ) ); ?>
	<br><br>
	<table>
		<tr>
			<th class="motorid_col"><?php echo __('ID', true);?></th>
			<th class="piecec_col"><?php echo __('Piece_Code', true );?></th>
			<th class="unityc_col"><?php echo __('Unit_Code', true );?></th>
			<th class="denomination_col"><?php echo __('Denomination', true );?></th>
			<th class="serie_col"><?php echo __('Serie', true );?></th>
			<th class="height_col"><?php echo __('Height', true );?></th>
			<th class="power_col"><?php echo __('Power', true );?></th>
			<th class="voltage_col"><?php echo __('Voltage', true );?></th>
			<th class="shape_col"><?php echo __('Shape', true );?></th>
			<th class="plan_col"><?php echo __( "Plan", true ); ?></th>
		</tr>
		<tr>
			<td class="motorid_col"><?php echo $this->Html->link( $motor['Motor']['id'], array('controller'=>'motors', 'action'=>'view', $motor['Motor']['id']), array('target'=>'_blank') );?>&nbsp;</td>
			<td class="piecec_col"><?php echo $motor['Motor']['clave_pieza']; ?>&nbsp;</td>
			<td class="unityc_col"><?php echo $motor['Motor']['clave_unidad']; ?>&nbsp;</td>
			<td class="denomination_col"><?php echo $motor['Motor']['denominacion']; ?>&nbsp;</td>
			<td class="serie_col"><?php echo $this->Html->link($motor['Serie']['codigo'], array('controller' => 'series', 'action' => 'view', $motor['Serie']['id'])); ?></td>
			<td class="height_col"><?php echo $motor['Motor']['altura']; ?>&nbsp;</td>
			<td class="power_col"><?php echo $motor['Motor']['potencia']; ?>&nbsp;</td>
			<td class="voltage_col"><?php echo $motor['Motor']['tension']; ?>&nbsp;</td>
			<td class="shape_col"><?php echo $motor['Motor']['forma']; ?>&nbsp;</td>
			<td class="plan_col"><?php echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'motors', 'action' => 'mostrar_planols', $motor['Motor']['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );?></td>
		</tr>
	</table>
</div>
<div id="MotorView_Serie" class="grid_16">
<span class="serie_previous_text"><?php echo __("Serie_Description", true)."</span><span class='serie_id'> ".$motor['Serie']['codigo'].": </span><span class='serie_description'>".$motor['Serie']['descripcion']."</span>"; ?>
</div>

<div id="components" class="grid_16">
	<h2><?php __('Parts');?></h2>
<?php 
	if (!empty($motor['Part']))
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
					<th class="plan_col"><?php __('Plan'); ?></th>
				</tr>
			</table>
		</div>
<?php
		$level = 0;
		foreach ($motor['Part'] as $part)
		{
			$color_class = "color_".$level."_hard";
			if ($y++ % 2 == 0) { $color_class = "color_".$level."_soft"; }
?>
			<div id="<?php echo $part['id']."_0";?>" class="grid_16 alpha omega <?php echo $color_class; ?>">
			<table cellpadding = "0" cellspacing = "0" Style="margin-bottom:0px">
					<tr>
						<td class="partid_col_td <?php echo $color_class; ?>"><?php echo $ajax->link( $part['id'], array( 'controller' => 'parts', 'action' => 'parts_of_parts_list', $part['id'], $level, $part['MotorsPart']['cantidad'], $color_class, $part['id'] ), array( 'update' => $part['id']."_0", $color_class ) );?></td>
						<td class="quantity_col <?php echo $color_class; ?>"><?php echo $part['MotorsPart']['cantidad'];?></td>
						<td class="piecec_col <?php echo $color_class; ?>"><?php echo $part['clave_pieza'];?></td>
						<td class="unityc_col <?php echo $color_class; ?>"><?php echo $part['clave_unidad'];?></td>
						<td class="denomination_col_td <?php echo $color_class; ?>"><?php echo $part['denominacion'];?></td>
						<td class="plan_col <?php echo $color_class; ?>"><?php echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $part['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );?></td>
					</tr>
				</table>
				<div id="<?php echo $part['id'];?>_childs" Style=" display:hidden"></div>
			</div>
<?php
		}
	}
?>
</div>

