<?php 
$product = $GLOBALS['product'];
$settings = $GLOBALS['settings'];
$addons = $GLOBALS['addons'];
if (isset($settings->show_detail_price) && $settings->show_detail_price == 0)
{
	echo '<style>div.product-price-info{display:none;}</style>';
}
?>
<div class="col-right col-botton">
	<div id="dg-right">
		<!-- product -->
		<div class="row" id="right-options">
			<div class="product-options col-sm-6" id="product-details">			
				<div class="colors-sizes-used">
					<div class="pull-left color_used" title="<?php echo lang('designer_right_color_used'); ?>" <?php echo cssShow($settings, 'show_color_used'); ?>>
						<span><?php echo lang('designer_right_color_used'); ?></span>
						<div class="color-used"></div>
					</div>
					
					<div class="pull-right screen_size" title="<?php echo lang('designer_right_screen_size'); ?>" <?php echo cssShow($settings, 'show_screen_size'); ?>>						
						<div class="screen-size"></div>
					</div>
				</div>
				
				<form method="POST" id="tool_cart" name="tool_cart" action="">							
					<div class="product-info" id="product-attributes">
						<?php if (isset($product->attribute)) { ?>
							<?php echo $product->attribute; ?>
						<?php } ?>
						<?php $addons->view('attribute'); ?>
					</div>
				</form>
			</div>
			
			<div class="product-prices col-sm-6">
				<div class="product-cart">
					<button <?php echo cssShow($settings, 'show_add_to_cart', 1); ?> type="button" class="btn btn-warning btn-addcart" onclick="design.ajax.addJs(this)"><i class="glyph-icon flaticon-shopping-cart-3"></i> <?php echo lang('designer_right_buy_now'); ?></button>
					
					<div id="product-price" <?php echo cssShow($settings, 'show_total_price'); ?>>
						<div class="product-price-list">							
							<span id="product-price-sale">
								<?php echo $settings->currency_symbol; ?><span class="price-sale-number"></span>
							</span>
							<span id="product-price-old">
								<?php echo $settings->currency_symbol; ?><span class="price-old-number"></span>
							</span>
						</div>						
					</div>
					<?php $addons->view('cart'); ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="products-detail">
			<div class="col-md-12" id="modal-product-info" <?php echo cssShow($settings, 'show_product_info'); ?>>
				<h3><?php echo lang('designer_product_description'); ?></h3>
				<hr />
				<div class="media">
					<div class="media-left">
						<img src="<?php echo base_url($product->image); ?>" width="200" class="media-object product-detail-image" alt="<?php echo $product->title; ?>" />
					</div>
					<div class="media-body">
						<h3 class="media-heading product-detail-title"><?php echo $product->title; ?></h3>
						<p><?php echo lang('designer_product_id'); ?>: <strong class="product-detail-id"><?php echo $product->id; ?></strong></p>
						<p><?php echo lang('designer_product_sku'); ?>: <strong class="product-detail-sku"><?php echo $product->sku; ?></strong></p>
						<div class="product-detail-short_description"><?php echo $product->short_description; ?></div>
					</div>
				</div>
				<br />
				<div class="product-detail-description"><?php echo $product->description; ?></div>
			</div>
			
			<div class="col-md-12 product-detail-size" <?php echo cssShow($settings, 'show_product_size'); ?>>
				<?php echo $product->size; ?>
			</div>
		</div>
	</div>
</div>
