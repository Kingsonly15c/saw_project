<?php 
$products 	= $GLOBALS['products'];
$addons 	= $GLOBALS['addons'];
$settings 	= $GLOBALS['settings'];
$product 	= $GLOBALS['product'];
$layout 	= $GLOBALS['layout'];
?>
<div class="col-xs-12 col-md-12 col-center align-center">
	<div class="tool-header">
		<div class="product-detail">
			<div class="dropdown">
				<button class="btn btn-none" type="button" id="product-menu">
					<a class="product-detail-title" href="javascript:void(0);">
						<?php echo $product->title; ?>
					</a>
				</button>
			</div>			
		</div>
		
		<!-- Begin sidebar -->
		<div id="dg-sidebar">
			<div class="dg-tools">
				<button type="button" class="btn btn-none btn-sm btn-save-design dg-tooltip" data-placement="bottom" data-original-title="<?php echo lang('designer_save_btn'); ?> & <?php echo lang('designer_share'); ?>" onclick="design.save()">
					<i class="fa fa-save"></i>
				</button>
				<a href="javascript:void(0)" data-type="preview" data-placement="bottom" data-original-title="<?php echo lang('designer_top_preview'); ?>" class="dg-tool btn btn-none btn-sm dg-tooltip">
					<i class="fa fa-eye"></i>
				</a>
				<a href="javascript:void(0)" data-type="zoom" data-placement="bottom" data-original-title="<?php echo lang('designer_top_zoom'); ?>" class="dg-tool btn btn-default btn-sm dg-tooltip">
					<i class="fa fa-search"></i>
				</a>
				<button type="button" class="btn btn-default btn-sm" onclick="design.save()" <?php echo cssShow($settings, 'show_share'); ?>>
					<i class="fa fa-share-alt"></i>
				</button>
				<?php $addons->view('helper'); ?>
			</div>
		</div>
		<!-- END sidebar -->
	</div>
	
	<!-- design area -->
	<div id="design-area" class="div-design-area">
		<div id="app-wrap" class="div-design-area">
		<?php if ($products === false) { ?>
			<div id="view-front" class="labView active">
				<div class="product-design">
					<strong><?php echo lang('designer_product_data_found'); ?></strong>
				</div>
			</div>
		<?php } else { ?>
			
			<!-- begin front design -->						
			<div id="view-front" class="labView active">
				<div class="product-design"></div>
				<div class="design-area"><div class="content-inner"></div></div>
			</div>						
			<!-- end front design -->
			
			<!-- begin back design -->
			<div id="view-back" class="labView">
				<div class="product-design"></div>
				<div class="design-area"><div class="content-inner"></div></div>
			</div>
			<!-- end back design -->
			
			<!-- begin left design -->
			<div id="view-left" class="labView">
				<div class="product-design"></div>
				<div class="design-area"><div class="content-inner"></div></div>
			</div>
			<!-- end left design -->
			
			<!-- begin right design -->
			<div id="view-right" class="labView">
				<div class="product-design"></div>
				<div class="design-area"><div class="content-inner"></div></div>
			</div>
			<!-- end right design -->
			
		<?php } ?>
			
			<!-- BEGIN help functions -->
			<div id="dg-help-functions" <?php echo cssShow($settings, 'show_toolbar'); ?>>
				<div class="btn-group-vertical" role="group" aria-label="Group functions">
					<span class="btn btn-default" data-placement="<?php echo $layout; ?>" data-toggle="tooltip" data-original-title="<?php echo lang('designer_clipart_edit_flip'); ?>" onclick="design.tools.flip('x')">
						<i class="glyphicons transfer glyphicons-12"></i>
					</span>					
					<span class="btn btn-default" data-placement="<?php echo $layout; ?>" data-toggle="tooltip" data-original-title="<?php echo lang('designer_align_horizontal'); ?>" onclick="design.tools.move('vertical')">
						<i class="glyphicon glyphicon-object-align-vertical"></i>
					</span>
					<span class="btn btn-default" data-placement="<?php echo $layout; ?>" data-toggle="tooltip" data-original-title="<?php echo lang('designer_align_vertical'); ?>" onclick="design.tools.move('horizontal')">
						<i class="glyphicon glyphicon-object-align-horizontal"></i>
					</span>	
					<span class="btn btn-default" data-placement="<?php echo $layout; ?>" data-toggle="tooltip" data-original-title="<?php echo lang('designer_align_left'); ?>" onclick="design.tools.move('left')">
						<i class="fa fa-chevron-left"></i>
					</span>	
					<span class="btn btn-default" data-placement="<?php echo $layout; ?>" data-toggle="tooltip" data-original-title="<?php echo lang('designer_align_right'); ?>" onclick="design.tools.move('right')">
						<i class="fa fa-chevron-right"></i>
					</span>	
					<span class="btn btn-default" data-placement="<?php echo $layout; ?>" data-toggle="tooltip" data-original-title="<?php echo lang('designer_align_up'); ?>" onclick="design.tools.move('up')">
						<i class="fa fa-chevron-up"></i>
					</span>	
					<span class="btn btn-default" data-placement="<?php echo $layout; ?>" data-toggle="tooltip" data-original-title="<?php echo lang('designer_align_down'); ?>" onclick="design.tools.move('down')">
						<i class="fa fa-chevron-down"></i>
					</span>
					<span class="btn btn-default" data-placement="<?php echo $layout; ?>" data-toggle="tooltip" data-original-title="<?php echo lang('designer_team_remove'); ?>" onclick="design.tools.remove()">
						<i class="fa fa-trash-o"></i>
					</span>
					<span class="btn btn-default" data-placement="<?php echo $layout; ?>" data-toggle="tooltip" data-original-title="<?php echo lang('designer_top_reset'); ?>" onclick="design.tools.reset(this)">
						<i class="fa fa-refresh"></i>
					</span>
					<?php $addons->view('tools'); ?>
				</div>
			</div>
			<!-- END help functions -->
		</div>
	</div>
	
	<div class="product-toolbar-options">
		<div class="product-toolbar">
			<div id="product-thumbs"></div>
			
			<span class="btn-product-color">
				<div class="product-color-active list-colors">
					<span class="bg-colors product-color-active-value"></span> 
					<span><?php echo lang('product_color'); ?></span>
				</div>			
			</span>
		</div>
		
		<?php if (isset($product->design) && $product->design != false) { ?>
		<div class="product-colors-design">
			<a href="javascript:void(0);" onclick="jQuery('.product-colors-design').hide('slow');" class="close"><i class="glyph-icon flaticon-error"></i></a>
			<div id="e-change-product-color" class="form-group">			
				<label id="e-label-product-color"><?php echo lang('designer_right_choose_product_color'); ?></label>
				<div id="product-list-colors">
					<?php for ($i=0; $i<count($product->design->color_hex); $i++) { ?>
					<span class="bg-colors dg-tooltip <?php if ($i==0) echo 'active'; ?>" onclick="design.products.changeColor(this, <?php echo $i; ?>)" data-color="<?php echo $product->design->color_hex[$i]; ?>" data-placement="top" data-original-title="<?php echo $product->design->color_title[$i]; ?>">
						
						<?php 
							$colors_hex = explode(';', $product->design->color_hex[$i]);
							$span_with = (23/count($colors_hex));
						?>
						<?php for($jc=0; $jc<count($colors_hex); $jc++) { ?>
							<a href="javascript:void(0);" style="width:<?php echo $span_with; ?>px; background-color:#<?php echo $colors_hex[$jc]; ?>"></a>
						<?php } ?>
					</span>
					<?php } ?>

					<?php 
					if(isset($product->design->color_picker)) {
						if(isset($jc))
							$color_picker_index = 0;
						else
							$color_picker_index = 0;
					?>
					<span class="bg-colors dg-tooltip bg-more-colors" data-index="<?php echo $color_picker_index; ?>" data-color="" data-placement="top" data-original-title="<?php echo lang('designer_color_picker'); ?>">
					</span>
					<?php } ?>
				</div>
			</div>
			<?php $addons->view('product'); ?>
		</div>
		<?php } ?>
	</div>
</div>