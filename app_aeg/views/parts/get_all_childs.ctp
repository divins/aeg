<?php //echo __('Please_download_motor_exported_file_from_next_link',true).": <a href='http://marc.divinscastellvi.name/aeg_v2/files/exported_motors/".$id.".html.gz'>".$id."</a>"; ?>
<?php //echo $html->link( $id ,array( 'controller' => 'parts', 'action' => 'file', $id ), array('escape'=>false) )."&nbsp;&nbsp;";; ?>
<br>
<a href="http://marc.divinscastellvi.name/aeg_v2/files/exported_motors/<?php echo $id; ?>.gz">
	<?php echo __('Use_this_link_to_download_compressed_html_with_motor_structure',true)." [ ".$id." ]"; ?>
</a>