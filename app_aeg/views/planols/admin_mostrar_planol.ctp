<div Style="text-align:center">
	<div Style="float:left; width:90%; text-align:center; margin-top:12px; font-weight:bold;">
		<?php echo $planol["Planol"]["codigo"]; ?>
	</div>
	<div Style="float:right; text-align:right; min-width:60px; width:10%;">
		<a href="#<?php echo $planol["Planol"]["id"];?>" onclick="popup('popUpDiv')"><?php 
			echo $this->Html->image("btn_close_x.png", array( "alt" => __( "Close", true ), "title" => __( "Close", true ) ) );
		?></a>
	</div>
	<div Style="clear:both; float:none"></div>
	<div id="big_image">
		<div Style="width:100%; text-align:center; margin-top:12px; font-weight:bold;">
			<?php 
				echo __('Plan',true).": ".$planol["Planol"]["codigo"]." [".__('Location',true)." - ".$planol["Planol"]["ubicacion"]."]"; 
				echo "&nbsp;&nbsp;&nbsp;".$this->Html->link( $this->Html->image("download.jpg", array( "width" => "24", "height" => "24", "alt" => __( "Download", true ), "title" => __( "Download", true ))), "/img/".$planol["Planol"]["img_digital"], array('escape'=>false,'target'=>'_blank') );
			?>
		</div>
	<?php
		//echo $this->Html->image("planols/".$planols["Planol"][0]["img_digital"].".jpg", array( "width" => "100%", "height" => "100%", "alt" => $planols["Planol"][0]["codigo"], "title" => $planols["Planol"][0]["codigo"]));
		//echo $this->Html->image("planols/".$planol["Planol"]["img_digital"], array( "width" => "100%", "height" => "100%", "alt" => $planol["Planol"]["codigo"], "title" => $planol["Planol"]["codigo"]));
		echo $this->Html->image("planols/".$planol["Planol"]["id"], array( "width" => "100%", "height" => "100%", "alt" => $planol["Planol"]["codigo"], "title" => $planol["Planol"]["codigo"]));
	?>
	</div>
</div>