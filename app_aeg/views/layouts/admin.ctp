<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('Fons AEG: '); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('cake.generic','960', Configure::read("css.final_admin_design") ) );
		
		echo $scripts_for_layout;
	?>
</head>
<body>
<div id="blanket" style="display:none;"></div> 
<div id="popUpDiv" class="container_16" style="display:none;"></div>	
<div id="header" class="container_16">
	<div id="header_title">
		<?php //echo $this->Html->link( $this->Html->image( "aeg_patrocinadors/logo_aeg.png", array( "alt" =>"Fons AEG", "title" => "Fons AEG")), array( "controller" => "motors", "action" => "index"  ), array('escape'=>false) ); ?>			
		AEG
	</div>
	<div id="menu">
		<ul>
			<li><?php echo $this->Html->link( __("Tornar a la Web", true), array( "controller" => "../motors", "action" => "index") ); ?> </a></li>
			<li><?php echo $this->Html->link( __("Motors", true), array( "controller" => "motors", "action" => "index") ); ?> </a></li>
			<li><?php echo $this->Html->link( __("Parts", true), array( "controller" => "parts", "action" => "index") ); ?> </a></li>
			<li><?php echo $this->Html->link( __("Series", true), array( "controller" => "series", "action" => "index") ); ?> </a></li>
			<li><?php echo $this->Html->link( __("Plans", true), array( "controller" => "planols", "action" => "index") ); ?> </a></li>
			<!--<li><?php /*echo $this->Html->link( __("Usuaris", true), array( "controller" => "usuarios", "action" => "index") ); ?> </a></li>
			<li><?php echo $this->Html->link( __("Rols", true), array( "controller" => "roles", "action" => "index") );*/ ?> </a></li>-->
		</ul>
	</div>
    <div class="clear"></div>
</div>
<div id="content" class="container_16">
<?php
	echo $this->Session->flash();
	echo $content_for_layout;
?>
</div>
<div class="clear"></div>
<div id="footer" class="container_16">
	<ul>
		<?php /*echo $this->Html->link( $this->Html->image( "aeg_patrocinadors/ajterrassa_footer.png", array( "alt" =>"Ajuntament de Terrassa", "title" => "Ajuntament de Terrassa")), "http://www.terrassa.cat/", array( 'target'=>'_blank', 'escape'=>false) ); ?>			
		<?php echo $this->Html->link( $this->Html->image( "aeg_patrocinadors/logo_aeg_footer.png", array( "alt" =>"AEG", "title" => "AEG")), "http://www.aeg.com/", array( 'target'=>'_blank', 'escape'=>false) ); ?>			
		<?php echo $this->Html->link( $this->Html->image( "aeg_patrocinadors/euetit_footer.png", array( "alt" =>"Escola d'Eginyeria de Terrassa", "title" => "Escola d'Eginyeria de Terrassa")), "http://www.eet.upc.edu", array( 'target'=>'_blank', 'escape'=>false) ); ?>	
		<?php echo $this->Html->link( $this->Html->image( "aeg_patrocinadors/bct_footer.png", array( "alt" =>"Biblioteca Campus Terrassa", "title" => "Biblioteca Campus Terrassa")), "http://bibliotecnica.upc.edu/BCT/", array( 'target'=>'_blank', 'escape'=>false) ); ?>						
		<?php */ ?>
		<li> <?php echo $this->Html->link( "Ajuntament de Terrassa", "http://www.terrassa.cat/", array( 'target'=>'_blank', 'escape'=>false) ); ?>			
		<li> <?php echo $this->Html->link( "AEG", "http://www.aeg.com/", array( 'target'=>'_blank', 'escape'=>false) ); ?>			
		<li> <?php echo $this->Html->link( "Escola d'Enginyeria de Terrassa", "http://www.eet.upc.edu", array( 'target'=>'_blank', 'escape'=>false) ); ?>	
		<li> <?php echo $this->Html->link( "Biblioteca Campus Terrassa", "http://bibliotecnica.upc.edu/BCT/", array( 'target'=>'_blank', 'escape'=>false) ); ?>						
	</ul>
</div>	
<?php echo $this->element('sql_dump'); ?>
</body>
</html>