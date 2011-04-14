<div id="planol_edit" Style="margin-bottom: 15px;">
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
			."<td>".$ajax->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Delete_Relationship', true ), 'title' => __( 'Delete_Relationship', true ) ) ), array( 'controller' => 'parts', 'action' => 'admin_del_planol', $this->data['Part']['id'], $planol['id'] ), array( 'escape'=>false, 'update' => 'planol_edit'), __( "Do_you_really_wanna_delete_relationship_between_part_and_plan?", true ) )
			//.$html->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Edit', true ), 'title' => __( 'Edit', true ) ) ), array('controller'=>'planols', 'action'=>'edit', $planol['id'] ), array('escape'=>false) )
			."</td></tr>";
	}
	?>
		</table>
	</div>
</div>