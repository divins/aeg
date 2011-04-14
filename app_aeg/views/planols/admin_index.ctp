<?php
echo $html->script('CSSPopUp');
echo $html->script('prototype');
//echo $html->script('scriptaculous');
?>

<div id="buscador" class="grid_16">
<h2><?php __('Searcher');?></h2>
	<?php
	echo $form->create('Planol', array('action' => 'index', "style"=>"background-color:#DDDDDD;"), true);
		//$options = array(">"=>__('Superior', true), ">="=>__('Superior o Igual', true), "="=>__('Igual', true), "<="=>__('Inferior o Igual', true), "<"=>__('Inferior', true), "-"=>__('Rang', true));
        
		$style['type'] = 'text';
        $style['style'] = 'float:left; width: 90px; font-weight: normal; font-size: 14px;';
        $style['div']['style'] = 'float: left; width: 150px; font-weight: bold; vertical-align: bottom; font-size: 14px;';
        $style['label'] = false;
		
		echo "<div style='float:left; width:20px; font-weight:bold; vertical-align:bottom; font-size:14px;'>".__("ID",true)."</div>";
		echo $form->input('id', $style );	
		echo "<div style='float:left; width:80px; font-weight:bold; vertical-align:bottom; font-size:14px;'>".__("Code",true)."</div>";
		echo $form->input('codigo', $style );
		echo "<div style='float:left; width:90px; font-weight:bold; vertical-align:bottom; font-size:14px;'>".__("Digital_Image",true)."</div>";
		echo $form->input('img_digital', $style );
		echo "<div style='float:left; width:90px; font-weight:bold; vertical-align:bottom; font-size:14px;'>".__("Location",true)."</div>";
		echo $form->input('ubicacion', $style );
		
	$button_options = array
	(
		'name' => 'Buscar',
		'label' => __('Search', true),
		'div' => array
		(
			'style' => 'text-align:center; font-weight:bold; margin-top:15px;',
		)
	);
	echo $form->end($button_options);
	?>
</div>
<!--<div class="parts index">-->
<div class="clear" Style="margin-top:25px"></div>
<?php
	//DEBUG( $conditions );
	if( isset($unparsed_order) ){ $this->Paginator->options(array('url' => 'unparsed_order:'.$unparsed_order )); }
	else{ $this->Paginator->options(array('url' => $conditions )); }
?>

	<h2><?php __('Planols');?></h2>
	
	<div class="grid_9">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Pagination_info_for_plans_searching', true)
	));
	?>
	</div>
	<div class="grid_7">
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
		if( $page < $this->Paginator->params['paging']['Planol']['pageCount'] )
		{ 
			$url['page'] = $page+1; 
			echo $html->link(__("Next", true), $url );
		}
			
		if( isset($this->passedArgs['page']) ){ $url['page'] = $this->passedArgs['page']; }
		?>
	</div>	
	<br>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort(__('ID',true));?></th>
			<th><?php echo $this->Paginator->sort(__('Code',true));?></th>
			<th><?php echo $this->Paginator->sort(__('Digital_Image',true));?></th>
			<th><?php echo $this->Paginator->sort(__('Location',true));?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	</table>
	<?php
	$i = 0;
	foreach ($planols as $planol):
			$class = ' style="background-color:#fff;"';
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#bbb;"';
			}
	?>
	<div class="grid_16" <?php echo "id='planol_".$planol['Planol']['id']."' ".$class; ?>>
		<div class="grid_1 alpha"><?php echo $planol['Planol']['id']; ?>&nbsp;</div>
		<div class="grid_3"><?php echo $planol['Planol']['codigo']; ?>&nbsp;</div>
		<div class="grid_4"><?php echo $planol['Planol']['img_digital']; ?>&nbsp;</div>
		<div class="grid_4"><?php echo $planol['Planol']['ubicacion']; ?>&nbsp;</div>
		<div class="grid_3 omega actions">
			<?php echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'planols', 'action' => 'mostrar_planol', $planol['Planol']['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );?>
			<?php echo $html->link( $html->image( 'icons/upload_3.png', array( 'alt' => __( 'Upload_Image', true ), 'title' => __( 'Upload_Image', true ) ) ) ,array( 'controller' => 'planols', 'action' => 'upload_attachment', $planol['Planol']['id'] ), array('escape'=>false) ); ?>
			<?php echo $ajax->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Quick_Edit', true ), 'title' => __( 'Qcuik_Edit', true ) ) ), array('action' => 'quick_edit', $planol['Planol']['id'] ), array( 'escape'=>false, 'update' => 'planol_'.$planol['Planol']['id']) ); ?>
			<?php echo $this->Html->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Delete_Plan', true ), 'title' => __( 'Delete_Plan', true ) ) ), array('action' => 'delete', $planol['Planol']['id']),array( 'escape'=>false ), sprintf(__('Do_you_really_wanna_delete_plan?', true), $planol['Planol']['codigo'])); ?>
		</div>
	</div>
	<div class="clear"></div>
<?php endforeach; ?>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Pagination_info_for_plans_searching', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('Previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('Next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
<!--<div class="actions">
	<h3><?php /* __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Planol', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Motors', true), array('controller' => 'motors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Motor', true), array('controller' => 'motors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Parts', true), array('controller' => 'parts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part', true), array('controller' => 'parts', 'action' => 'add')); */ ?> </li>
	</ul>
</div>-->