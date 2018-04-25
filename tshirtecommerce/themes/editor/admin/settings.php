<?php
/**
 * @author tshirtecommerce - www.tshirtecommerce.com
 * @date: 2016-03-22
 *
 * API Theme
 *
 * @copyright  Copyright (C) 2015 tshirtecommerce.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 *
 */

if ( isset($data['settings']['theme']) && isset($data['settings']['theme']['editor']) )
{
	$settings	= $data['settings']['theme']['editor'];
}
else
{
	$settings	= array();
}
?>

<style>
.fancybox-inner{max-height: 540px;}
#edit-layouts a.thumbnail {float: left;width:110px;margin: 4px;border: 3px solid #fff;padding: 0px;border-radius: 0;}
#edit-layouts a.thumbnail:hover{opacity: 0.5;}
#edit-layouts a.thumbnail.active{border-color: #5EA1ED;}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/plugins/pickColor/spectrum.css'); ?>">
<script type='text/javascript' src='<?php echo site_url('assets/plugins/pickColor/spectrum.js'); ?>'></script>
<script type="text/javascript" src="<?php echo site_url('assets/plugins/jquery-fancybox/jquery.fancybox.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo site_url('assets/plugins/jquery-fancybox/jquery.fancybox.css'); ?>">

<div class="tabbable">
	<ul id="myTab" class="nav nav-tabs tab-bricky">
		<li class="active">
			<a href="#panel_tab1" data-toggle="tab" aria-expanded="false">
				<i class="green fa fa-bars"></i> Layout
			</a>
		</li>	
		<li>
			<a href="#panel_tab2" data-toggle="tab" aria-expanded="false">
				<i class="green fa fa-magic"></i> Colors
			</a>
		</li>
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="panel_tab1">
			<div class="form-group">
				<label>Choose layout</label>
				<?php
				$layout = setValue($settings, 'layout', 'left');
				?>
				<div class="row">
					<div class="col-xs-12" id="edit-layouts">
						<a href="#" class="thumbnail layout <?php if($layout == 'left') echo 'active'; ?>" data-value="left">
						  <img src="<?php echo site_url('themes/editor/layouts/layout-left.png', false); ?>" alt="Menu left">
						</a>
						
						<a href="#" class="thumbnail layout <?php if($layout == 'right') echo 'active'; ?>" data-value="right">
						  <img src="<?php echo site_url('themes/editor/layouts/layout-right.png', false); ?>" alt="Menu right">
						</a>
						
						<a href="#" class="thumbnail layout <?php if($layout == 'top') echo 'active'; ?>" data-value="top">
						  <img src="<?php echo site_url('themes/editor/layouts/layout-top.png', false); ?>" alt="Menu top">
						</a>
						
						<a href="#" class="thumbnail layout <?php if($layout == 'bottom') echo 'active'; ?>" data-value="bottom">
						  <img src="<?php echo site_url('themes/editor/layouts/layout-botton.png', false); ?>" alt="Menu botton">
						</a>
					</div>
				</div>
				
				<input type="hidden" class="layout_value" value="<?php echo $layout; ?>" name="setting[theme][editor][layout]">
			</div>
		</div>
		
		<div class="tab-pane" id="panel_tab2">
			<div class="form-horizontal custom_theme_default">
				<div class="form-group">
					<h4 class="col-sm-4">Background</h4>					
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label">Background Color</label>
					<div class="col-sm-8">
						<input type="text" class="colors" value="<?php echo setValue($settings, 'background_color', '#FFFFFF'); ?>" name="setting[theme][editor][background_color]">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label">Background Image</label>
					<div class="col-sm-8 background-image">
						<a href="javascript:void(0);" class="btn btn-default btn-sm" onclick="jQuery.fancybox( {height:'400px', href : '<?php echo site_url('index.php/media/modals/backgroundImg/1'); ?>', type: 'iframe'} );">Choose Image</a>
						
						<?php $theme_background = setValue($settings, 'background_image', ''); ?>
						<input type="hidden" class="theme-image" value="<?php echo $theme_background; ?>" name="setting[theme][editor][background_image]">
						
						<?php if ($theme_background != '') { ?>
							<img src="<?php echo $theme_background; ?>" class="img-thumbnail" alt="" width="50" />
						<?php } ?>
						<a href="javascript:void(0);" onclick="themRemoveOption(this)"><i class="fa fa-trash-o"></i></a>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label">
						Background Repeat
					</label>
					<div class="col-sm-8">
						<input type="text" style="width:150px;" class="form-control" value="<?php echo setValue($settings, 'background_repeat', 'repeat'); ?>" name="setting[theme][editor][background_repeat]">
						<small class="help-block"><i class="fa fa-info-circle"></i> Enter background repeat (Example: "repeat", "repeat-x", "repeat-y", "no-repeat")</small>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label">
						Background position
					</label>
					<div class="col-sm-8">
						<input type="text" style="width:150px;" class="form-control" value="<?php echo setValue($settings, 'background_position', 'center center'); ?>" name="setting[theme][editor][background_position]">
						<small class="help-block"><i class="fa fa-info-circle"></i> Enter position of a background image (Example: "left top", "left center", "left bottom", "right top", "right center", "right bottom", "center top", "center center", "center bottom")</small>
					</div>
				</div>
				
				<div class="form-group">
					<h4 class="col-sm-4">Menu add text, clipart...</h4>					
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label">Background Color</label>
					<div class="col-sm-8">
						<input type="text" class="colors" value="<?php echo setValue($settings, 'menu_bg', '#3E454F'); ?>" name="setting[theme][editor][menu_bg]">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Color active of item menu</label>
					<div class="col-sm-8">
						<input type="text" class="colors" value="<?php echo setValue($settings, 'menu_bg_active', '#43B9D3'); ?>" name="setting[theme][editor][menu_bg_active]">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Line Color</label>
					<div class="col-sm-8">
						<input type="text" class="colors" value="<?php echo setValue($settings, 'menu_line_color', '#292f38'); ?>" name="setting[theme][editor][menu_line_color]">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Icon Color</label>
					<div class="col-sm-8">
						<input type="text" class="colors" value="<?php echo setValue($settings, 'menu_bg_icon', '#FFFFFF'); ?>" name="setting[theme][editor][menu_bg_icon]">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Icon Color Active</label>
					<div class="col-sm-8">
						<input type="text" class="colors" value="<?php echo setValue($settings, 'menu_bg_iconhover', '#FFFFFF'); ?>" name="setting[theme][editor][menu_bg_iconhover]">
					</div>
				</div>
				
				<hr />
				<div class="form-group">
					<h4 class="col-sm-12 pull-right"><button type="button" class="btn btn-default" onclick="theme_default()">Reset Default</button>
				</div>
			</div>
		</div>		
	</div>
</div>

<script type='text/javascript'>
jQuery(document).ready(function(){
	jQuery('#edit-layouts .layout').click(function(){
		jQuery('#edit-layouts .layout').removeClass('active');
		jQuery(this).addClass('active');
		jQuery('.layout_value').val( jQuery(this).data('value') );
	});
});
function backgroundImg(images)
{
	if(images.length > 0)
	{
		var e = jQuery('.theme-image');
		e.val(images[0]);
		if(e.parent().children('img').length > 0)
			e.parent().children('img').attr('src', images[0]);
		else
			e.parent().append('<img src="'+images[0]+'" class="img-thumbnail" alt="" width="50" />');
		jQuery.fancybox.close();
	}
}
function themRemoveOption(e)
{
	var elm = jQuery(e).parent();
	elm.find('img').remove();
	elm.find('input').val('');
}
jQuery(document).ready(function(){
	jQuery(".colors").spectrum({
		showPalette: true,
		showInput: true,
		preferredFormat: "hex",
		palette: [
			['FFFFFF', 'FCFCFC', 'CCCCCC', '333333'],
			['000000', '428BCA', 'F65E13', '2997AB'],
			['5CB85C', 'D9534F', 'F0AD4E', '5BC0DE'],
			['C3512F', '7C6853', 'F0591A', '2D5C88'],
			['4ECAC2', '435960', '734854', 'A81010'],
		]
	});
});
function theme_default(){
	var check = confirm('You sure want reset default of setting theme?');
	if(check == true)
	{
		jQuery('.custom_theme_default input').remove();
		jQuery('.custom_theme_default').parents('form').submit();
	}
}
</script>