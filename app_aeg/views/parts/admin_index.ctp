<?php
echo $html->script('CSSPopUp');
echo $html->script('prototype');
//echo $html->script('scriptaculous');
?>

<div id="buscador_parts" class="grid_16">
	<h2><?php __('Searcher');?></h2>
	<?php
	echo $form->create('Part', array('action' => 'index'), true);
	$style['type'] = 'text';
	$style['class'] = 'search_field_value';
	$style['div'] = false;
	$style['label'] = false;
	?>
		<div class="parts_search_fields_basic">
			<div class="parts_search_labels">
				<?php
				echo __("ID",true);
				?>
			</div>
			<?php

			echo $form->input('id', $style);
			?>
		</div>
		<div class="parts_search_fields_basic">
			<div class="parts_search_labels">
				<?php
				echo __("Piece_Code",true);
				?>
			</div>
			<?php
			echo $form->input('clave_pieza', $style);
			?>
		</div>
		<div class="parts_search_fields_basic">
			<div class="parts_search_labels">
				<?php
				echo __("Unit_Code",true);
				?>
			</div>
			<?php
			echo $form->input('clave_unidad', $style);
			?>
		</div>
		<div class="parts_search_fields_basic">
			<div class="parts_search_labels">
				<?php
				echo __("Denomination",true);
				?>
			</div>
			<?php
			echo $form->input('denominacion', $style);
			?>
		</div>
		<div class="parts_search_submit">
			<?php
			$button_options = array
			(
				'name' => 'Buscar',
				'label' => __('Search', true),
				'div' => false
			);
			echo $form->end($button_options);
			?>
		</div>
	<div class="clear"></div>
</div>
<div id="search_result" class="grid_16">
<?php
	//DEBUG( $conditions );
	if( isset($unparsed_order) ){ $this->Paginator->options(array('url' => 'unparsed_order:'.$unparsed_order )); }
	else{ $this->Paginator->options(array('url' => $conditions )); }
?>
	<h2><?php __('Parts');?></h2>
	
	<div class="grid_10 alpha paging_count">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Pagination_info_for_parts_searching', true)
	));
	?>
	</div>
	<div class="grid_6 omega paging_nav">
		<?php 
		//DEBUG($url);
		$url['action']='index';
		$url = array_merge( (array)$url, (array)$conditions );
		//DEBUG($url);
		$this->Paginator->options(array('url' => $url ));
		
		$page = 1;
		if( isset($this->passedArgs['page']) ){ $page = $this->passedArgs['page']; }
	
		if( $page >=2 )
		{ 
			$url['page'] = $page-1; 
			echo $html->link(__("Previous", true), $url );
		}
		else{ echo __("Previous", true); }
		?>
		| <?php echo $this->Paginator->numbers();?> 
		| 
		<?php 
		if( $page < $this->Paginator->params['paging']['Part']['pageCount'] )
		{ 
			$url['page'] = $page+1; 
			echo $html->link(__("Next", true), $url );
		}
			
		if( isset($this->passedArgs['page']) ){ $url['page'] = $this->passedArgs['page']; }
		?>
	</div>	
	
		<table>
			<tr>
				<th class="part-result_id_col"><?php echo $this->Paginator->sort(__('ID',true));?></th>
				<th class="part-result_piecec_col"><?php echo $this->Paginator->sort(__('Piece_Code',true));?></th>
				<th class="part-result_unityc_col"><?php echo $this->Paginator->sort(__('Unit_Code',true));?></th>
				<th class="part-result_denomination_col"><?php echo $this->Paginator->sort(__('Denomination',true));?></th>
				<th class="part-admin_motors_actions"><?php __('Actions');?></th>
			</tr>
		</table>
	
	<div class="clear"></div>
	<div id="parts_result_list">
	<?php
	$x = 0;
	foreach ($parts as $part):
		$color_class = 'row';
		if ($x++ % 2 == 0) {
			$color_class = 'altrow';
		}
	?>
		<div class="parts_result_row" <?php echo "id='part_".$part['Part']['id']."'"; ?>>	
			<div class="part-result_id_col <?php echo $color_class; ?>"><?php echo $part['Part']['id']; ?></div>
			<div class="part-result_piecec_col <?php echo $color_class; ?>"><?php echo $part['Part']['clave_pieza']; ?></div>
			<div class="part-result_unityc_col <?php echo $color_class; ?>"><?php echo $part['Part']['clave_unidad']; ?></div>
			<div class="part-result_denomination_col <?php echo $color_class; ?>"><?php echo $part['Part']['denominacion']; ?></div>
			<div class="part-admin_motors_actions <?php echo $color_class; ?>">
				<?php echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'parts', 'action' => 'mostrar_planols', $part['Part']['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );?>
				<?php echo $ajax->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Quick_Edit', true ), 'title' => __( 'Quick_Edit', true ) ) ), array('action' => 'quick_edit', $part['Part']['id'], 0, $color_class ), array( 'escape'=>false, 'update' => 'part_'.$part['Part']['id']) );//, 'after' => "popup('popUpDiv')" ) );?>
				<?php echo $this->Html->link( $html->image( 'icons/page_advanced_edit_mini.png', array( 'alt' => __( 'Advanced_Edit', true ), 'title' => __( 'Advanced_Edit', true ) ) ), array('action' => 'edit', $part['Part']['id']), array( 'escape'=>false, 'target'=>'_blank' ) ); ?>
				<?php echo $this->Html->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Delete_Part', true ), 'title' => __( 'Delete_Part', true ) ) ), array('action' => 'delete', $part['Part']['id']), array( 'escape'=>false ), sprintf(__('Do_you_really_wanna_delete_part?', true), $part['Part']['id'])); ?>
			</div>
		</div>
<?php endforeach; ?>
	</div>
	<!--<div class="clear"></div>
	<div class="grid_10 alpha paging_count">
	<?php
	/*echo $this->Paginator->counter(array(
	'format' => __('Pagination_info_for_parts_searching', true)
	));
	?>
	</div>
	<div class="grid_6 omega paging_nav">
		<?php echo $this->Paginator->prev( __('Previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('Next', true), array(), null, array('class' => 'disabled'));*/?>
	</div>-->
</div>