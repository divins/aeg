	<div class="grid_1 alpha"><?php echo $this->data['Planol']['id']; ?>&nbsp;</div>	<div class="grid_3"><?php echo $this->data['Planol']['codigo']; ?>&nbsp;</div>	<div class="grid_4"><?php echo $this->data['Planol']['img_digital']; ?>&nbsp;</div>	<div class="grid_5"><?php echo $this->data['Planol']['ubicacion']; ?>&nbsp;</div>	<div class="grid_2 omega actions">		<?php echo $ajax->link( $html->image( 'icons/picture.png', array( 'alt' => __( 'Show_Plan', true ), 'title' => __( 'Show_Plan', true ) ) ), array( 'controller' => 'planols', 'action' => 'mostrar_planol', $this->data['Planol']['id'] ), array( 'escape'=>false, 'update' => 'popUpDiv', 'after' => "popup('popUpDiv')" ) );?>		<?php echo $html->link( $html->image( 'icons/upload_3.png', array( 'alt' => __( 'Upload_Image', true ), 'title' => __( 'Upload_Image', true ) ) ) ,array( 'controller' => 'planols', 'action' => 'upload_attachment', $this->data['Planol']['id'] ), array('escape'=>false) ); ?>		<?php echo $ajax->link( $html->image( 'icons/page_edit_mini.png', array( 'alt' => __( 'Quick_Edit', true ), 'title' => __( 'Quick_Edit', true ) ) ), array('action' => 'quick_edit', $this->data['Planol']['id'] ), array( 'escape'=>false, 'update' => 'planol_'.$this->data['Planol']['id']) ); ?>		<?php echo $this->Html->link( $html->image( 'icons/cross.png', array( 'alt' => __( 'Delete_Plan', true ), 'title' => __( 'Delete_Plan', true ) ) ), array('action' => 'delete', $this->data['Planol']['id']),array( 'escape'=>false ), sprintf(__('Do_you_really_wanna_delete_plan?', true), $this->data['Planol']['codigo'])); ?>	</div>