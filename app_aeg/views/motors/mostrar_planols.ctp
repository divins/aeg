<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<div Style="text-align:center">
	<div Style="float:left; width:90%; text-align:center; margin-top:12px; font-weight:bold;">
		<?php echo $planols["Motor"]["denominacion"]; ?>
	</div>
	<div Style="float:right; text-align:right; min-width:60px; width:10%;">
		<a href="#<?php echo $planols["Motor"]["id"];?>" onclick="popup('popUpDiv')"><?php 
			echo $this->Html->image("btn_close_x.png", array( "alt" => __( "Close", true ), "title" => __( "Close", true ) ) );
		?></a>
	</div>
	<div Style="clear:both; float:none"></div>
	<div Style="text-align:center; border: 1px dashed gray; width:90%; height:110px; margin-left:5%; margin-right:5%;">
	<?php
	//DEBUG( $planols );
	foreach( $planols['Planol'] as $planol)
	{
	?>
		<div Style="width:120px; height:105px; text-align:center; float:left;">
		<?php
		echo $this->Html->link( $this->Html->image("planols/".$planol["id"].".jpg", array( "width" => "110", "height" => "80", "alt" => $planol["codigo"], "title" => $planol["codigo"])), "", array('escape'=>false) );
		?>
		<br>
		<?php echo utf8_encode($planol["codigo"]); ?>
		</div>
	<?php
	}
	?>
	</div>
	<?php
	$class = "visible";
	foreach( $planols['Planol'] as $planol)
	{?>
		<div id="big_image" Style="visibility: <?php echo $class; ?>">
			<div Style="width:100%; text-align:center; margin-top:12px; font-weight:bold;">
				<?php 
					echo __('Plan',true).": ".$planol["codigo"]." [".__('Location',true)." - ".$planol["ubicacion"]."]"; 
					echo "&nbsp;&nbsp;&nbsp;".$this->Html->link( $this->Html->image("download.jpg", array( "width" => "24", "height" => "24", "alt" => __( "Download", true ), "title" => __( "Download", true ))), "/img/planols/".$planol["id"].".jpg", array('escape'=>false,'target'=>'_blank', 'onclick'=>'alert("hey");') );
				?>
			</div>
		<?php
			//echo $this->Html->image("planols/".$planols["Planol"][0]["img_digital"].".jpg", array( "width" => "100%", "height" => "100%", "alt" => $planols["Planol"][0]["codigo"], "title" => $planols["Planol"][0]["codigo"]));
			echo $this->Html->image("planols/".$planol["id"].".jpg", array( "width" => "100%", "height" => "100%", "alt" => $planol["codigo"], "title" => $planol["codigo"]));
		?>
		</div>
	<?php 
		$class = "hidden";
	} 
	?>
</div>