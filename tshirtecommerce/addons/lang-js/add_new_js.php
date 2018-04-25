<?php
/**
 * @author tshirtecommerce - www.tshirtecommerce.com
 * @date: 2015-11-26
 *
 * API
 *
 * @copyright  Copyright (C) 2015 tshirtecommerce.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 *
 */
$addons 	= $GLOBALS['addons'];
$dg 		= $GLOBALS['dg'];
$product 	= $GLOBALS['product'];
$settings	= $GLOBALS['settings'];

$check_dpi = 0;
if(isset($settings->settings_check_dpi) && $settings->settings_check_dpi == 1)
{
	$check_dpi = 1;
}

$printing_method = '';
if (isset($product->print_type) && $product->print_type != '')
{
	$printing = $dg->getPrintingType($product->print_type);
	
	if ( isset($printing->price_type) )
	{
		$printing_method = $printing->price_type;
	}		
}

// setting DPI of file upload
$dpioutput			= 72;
$dpioutput_default	= 72;
if(empty($product->dpioutput))
{
	if(isset($settings->dpioutput))
	{
		$dpioutput 			= $settings->dpioutput;
		$dpioutput_default 	= $settings->dpioutput;
	}
}
else
{
	$dpioutput = $product->dpioutput;
}

// setting change color of photo
if(isset($settings->photo_color) && $settings->photo_color == 0)
{
	$change_photo = 0;
}
else
{
	$change_photo = 1;
}
$photo_color_default = '#000000';
if(isset($settings->photo_color_default))
{
	$photo_color_default = $settings->photo_color_default;
}

/* update attribute when choose in page product detail */
if(isset($_GET['options']))
{
	$attr_options = $_GET['options'];
}
else
{
	$attr_options = '';
}
?>
<script type="text/javascript">
var addon_lang_js_design_blank = '<?php echo $addons->__('addon_lang_js_design_blank'); ?>';
var printing_method = '<?php echo $printing_method; ?>';

<?php if( isset($_GET['variation_id']) ){ ?>
jQuery(document).on('form.addtocart.design', function(event, datas){
	datas.variation_id = '<?php echo $_GET['variation_id']; ?>';
});
<?php } ?>

<?php if( isset($_GET['light_box']) ){ ?>
var load_idea_id = 1;
var windown_light_box = 1;
jQuery(document).ready(function(){
	jQuery('body').addClass('light_box');
});
<?php } ?>

var max_box_width = 500;
var max_box_height = 500;
<?php if(isset($product->box_width) && $product->box_width != ''){ ?>
	max_box_width = '<?php echo $product->box_width; ?>';	
<?php } ?>

<?php if(isset($product->box_height) && $product->box_height != ''){ ?>
	max_box_height = '<?php echo $product->box_height; ?>';	
<?php } ?>

var change_photo_color = '<?php echo $change_photo; ?>';
var photo_color_default = '<?php echo $photo_color_default; ?>';

var check_dpi = '<?php echo $check_dpi; ?>';
var addon_photo_size_msg = '<?php echo lang('addon_photo_size_msg'); ?>';
var addon_photo_size_cart_msg = '<?php echo lang('addon_photo_size_cart_msg'); ?>';
var dpioutput = '<?php echo $dpioutput; ?>';
var dpioutput_default = '<?php echo $dpioutput_default; ?>';

var attr_options = '<?php echo $attr_options; ?>';
</script>