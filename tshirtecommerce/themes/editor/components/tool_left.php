<?php
$settings = $GLOBALS['settings'];
$addons = $GLOBALS['addons'];
$layout = $GLOBALS['layout'];
$tooltip = array(
	'left' => 'right',
	'right' => 'left',
	'bottom' => 'top',
	'top' => 'top',
);
?>
<div class="col-left">	
	<div id="dg-left" class="width-100">
		<div class="dg-box width-100">
			<ul class="menu-left">			
				<li>
					<a href="javascript:void(0);" onclick="dg_full_screen(this)" class="dg-tooltip" data-placement="<?php echo $tooltip[$layout]; ?>" data-original-title="<?php echo lang('designer_full_screen'); ?>">
						<i class="glyph-icon flaticon-expand-2"></i>
						<span><?php echo lang('designer_full_screen'); ?></span>
					</a>
				</li>
				
				<li <?php echo cssShow($settings, 'show_product'); ?>>
					<a href="#dg-products" class="view_change_products dg-tooltip" data-placement="<?php echo $tooltip[$layout]; ?>" data-original-title="<?php echo lang('designer_menu_choose_product'); ?>" data-toggle="modal" data-target="#dg-products">
						<i class="glyph-icon flaticon-menu-1"></i>
						<span><?php echo lang('designer_menu_choose_product'); ?></span>
					</a>
				</li>

				<?php $addons->view('menu-left'); ?>
				
				<li <?php echo cssShow($settings, 'show_add_text'); ?>>
					<a href="javascript:void(0);" class="add_item_text" data-placement="<?php echo $tooltip[$layout]; ?>" data-toggle="tooltip" data-original-title="<?php echo lang('designer_menu_add_text'); ?>">
						<i class="glyph-icon flaticon-type"></i>
						<span><?php echo lang('designer_menu_add_text'); ?></span>
					</a>
				</li>
				
				<li <?php echo cssShow($settings, 'show_add_art'); ?>>
					<a href="#dg-cliparts" class="add_item_clipart dg-tooltip" data-placement="<?php echo $tooltip[$layout]; ?>" data-toggle="modal" data-placement="<?php echo $tooltip[$layout]; ?>" data-original-title="<?php echo lang('designer_menu_add_art'); ?>" data-target="#dg-cliparts">
						<i class="glyph-icon flaticon-picture"></i>
					</a>
				</li>							
				<li <?php echo cssShow($settings, 'show_add_upload'); ?>>
					<a href="#dg-myclipart" class="dg-tooltip" data-toggle="modal" data-placement="<?php echo $tooltip[$layout]; ?>" data-target="#dg-myclipart" data-original-title="<?php echo lang('designer_menu_upload_image'); ?>">
						<i class="glyph-icon flaticon-upload"></i>
					</a>
				</li>
				
				<li <?php echo cssShow($settings, 'show_add_team'); ?>>
					<a href="javascript:void(0);" class="add_item_team dg-tooltip" data-placement="<?php echo $tooltip[$layout]; ?>" data-original-title="<?php echo lang('designer_menu_name_number'); ?>">
						<i class="glyph-icon flaticon-football"></i>
					</a>
				</li>
				<li>
					<a href="javascript:void(0);" class="add_item_mydesign dg-tooltip" data-placement="<?php echo $tooltip[$layout]; ?>" data-original-title="<?php echo lang('designer_menu_my_design'); ?>" <?php echo cssShow($settings, 'show_my_design'); ?>>
						<i class="glyph-icon flaticon-user"></i>
					</a>
				</li>				
				<li <?php echo cssShow($settings, 'show_add_qrcode'); ?>>
					<a href="javascript:void(0);" class="add_item_qrcode dg-tooltip" data-placement="<?php echo $tooltip[$layout]; ?>" data-original-title="<?php echo lang('designer_menu_add_qrcode'); ?>">
						<i class="glyph-icon flaticon-qr-code"></i>
					</a>
				</li>
				
				<li <?php echo cssShow($settings, 'show_layers'); ?>>
					<a href="javascript:void(0);" onclick="layers_toggle();" class="dg-tooltip" data-placement="<?php echo $tooltip[$layout]; ?>" data-original-title="<?php echo lang('designer_menu_login_layers'); ?>">
						<i class="glyph-icon flaticon-layers-1"></i>
					</a>
				</li>
			</ul>
		</div>
		
		<div class="div-layers" <?php echo cssShow($settings, 'show_layers'); ?>>
			<span class="title"><?php echo lang('designer_menu_login_layers'); ?> <a href="javascript:void(0);" onclick="layers_toggle();" class="close pull-right"><i class="glyph-icon flaticon-error"></i></a></span>
			<div class="control-layers">
				<div id="dg-layers">
					<ul id="layers"></ul>
				</div>
			</div>
		</div>
	</div>
</div>