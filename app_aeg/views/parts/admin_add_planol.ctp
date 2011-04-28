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
			."</td></tr>";
	}
	?>
		</table>
	</div>