<div class="planols form">
<?php echo $form->create( 'Planol', array('action' => 'upload_attachment', 'type' => 'file') );?>
	<fieldset>
 		<legend><?php __('Upload_Image');?></legend>
	<?php
		//DEBUG($this->data);
		echo $form->input('id');
		//echo $form->input('file');
		$options['label'] = false;
		$options['before'] = __( 'select_an_image_to_attach', true ).": ";	
		echo $form->file('file', $options);	
		echo $form->input('Planol.id', array('type'=>'hidden', 'value'=>$this->data['Planol']['id']) );	
		echo $form->input('Planol.ubicacion', array('label'=>__('Location', true),'value'=>$this->data['Planol']['ubicacion']) );	
	?>
	</fieldset>
<?php echo $form->end( __('Save', true) );?>
</div>