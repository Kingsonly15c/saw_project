<?php
/**
 * @author tshirtecommerce - www.tshirtecommerce.com
 * @date: 2015-01-10
 * 
 * @copyright  Copyright (C) 2015 tshirtecommerce.com. All rights reserved.
 * @license	   GNU General Public License version 2 or later; see LICENSE
 *
 */
if ( isset($settings->theme) && isset($settings->theme->editor) )
{
	$options = $settings->theme->editor;
	$settings->theme = 'editor';
}
else
{
	$options = array();
}

$layout 		= 'left';
if(isset($options->layout))
{
	$layout				= $options->layout;
}
$addons					= $GLOBALS['addons'];
$GLOBALS['layout']		= $layout;
if(isset($addons->is_mobile) && $addons->is_mobile == true)
{
?>
<link type="text/css" href="<?php echo 'themes/editor/css/style_mobile.css'; ?>" rel="stylesheet" media="all" />
<?php
}
else 
{
?>
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700" rel="stylesheet">
<link type="text/css" href="<?php echo 'themes/editor/fonts/flaticon.css'; ?>" rel="stylesheet" media="all" />
<link type="text/css" href="<?php echo 'themes/editor/css/style_'.$layout.'.css'; ?>" rel="stylesheet" media="all" />
<script type="text/javascript" src="<?php echo 'themes/editor/js/theme.js'; ?>"></script>
<style type="text/css">
	/* font */
	body{font-family: 'Roboto Slab', serif; font-weight: 400;font-size:13px;}
	/* Background */
	<?php if (isset($options->background_color) && $options->background_color != '') { ?>
	.col-center{background-color:<?php echo $options->background_color; ?>!important;}
	<?php } ?>
	
	<?php if (isset($options->background_image) && $options->background_image != '') { ?>
	.col-center{background-image:url('<?php echo $options->background_image; ?>')!important;}
	<?php } ?>
	
	<?php if (isset($options->background_repeat) && $options->background_repeat != '') { ?>
	.col-center{background-repeat:<?php echo $options->background_repeat; ?>;}
	<?php } ?>
	
	<?php if (isset($options->background_position) && $options->background_position != '') { ?>
	.col-center{background-position:<?php echo $options->background_position; ?>!important;}
	<?php } ?>
	
	/* Menu */
	<?php if (isset($options->menu_bg) && $options->menu_bg != '') { ?>
	#dg-designer .col-left{background-color:<?php echo $options->menu_bg; ?>!important;}
	.product-prices button.btn-addcart{background:<?php echo $options->menu_bg; ?>!important;}
	<?php } ?>
	
	<?php if (isset($options->menu_line_color) && $options->menu_line_color != '') { ?>
	#dg-designer .col-left .menu-left > li{border-color:<?php echo $options->menu_line_color; ?>!important;}
	<?php } ?>
	
	<?php if (isset($options->menu_bg_active) && $options->menu_bg_active != '') { ?>
	#dg-designer .col-left .menu-left > li a:hover, #dg-designer .col-left .menu-left > li a.active{background-color:<?php echo $options->menu_bg_active; ?>!important;}
	<?php } ?>
	
	<?php if (isset($options->menu_bg_icon) && $options->menu_bg_icon != '') { ?>
	#dg-designer .col-left .menu-left > li a i:before{color:<?php echo $options->menu_bg_icon; ?>!important;}
	.product-prices button.btn-addcart{color:<?php echo $options->menu_bg_icon; ?>!important;}
	<?php } ?>
	
	<?php if (isset($options->menu_bg_iconhover) && $options->menu_bg_iconhover != '') { ?>
	#dg-designer .col-left .menu-left > li a:hover i:before, #dg-designer .col-left .menu-left > li a.active i:before{color:<?php echo $options->menu_bg_iconhover; ?>!important;}
	<?php } ?>	
</style>

<script type='text/javascript'>
<?php if($layout == 'bottom') { ?>
var layout_menu_bottom = 1;
jQuery(document).ready(function(){
	setTimeout(function(){
		var col_center_h = jQuery('.col-center').height();
		jQuery('.col-left').css('top', col_center_h+'px');
	}, 1000);
});
<?php } ?>
</script>
<?php } ?>