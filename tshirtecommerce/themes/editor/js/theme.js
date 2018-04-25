jQuery(document).ready(function(){
	jQuery('.product-color-active').click(function(){
		jQuery('.product-colors-design').toggle('slow');
	});
	/*
	jQuery( window ).resize(function() {
		window.parent.setHeigh(jQuery('#dg-wapper').height());
	});
	*/
	jQuery('.icon-ui-lock').click(function(){
		var input = jQuery(this).parent().find('.ui-lock');
		if(input.length > 0)
		{
			if(input.is(':checked') == true)
			{
				jQuery(this).html('<i class="fa fa-lock" aria-hidden="true"></i>');
			}
			else
			{
				jQuery(this).html('<i class="fa fa-unlock-alt" aria-hidden="true"></i>');
			}
			input.click();
		}
	});	
});

function dg_full_screen(e)
{
	var check = window.parent.dg_full_screen();
	if(check == 1)
	{
		jQuery(e).html('<i class="glyph-icon flaticon-shrink"></i>');
	}
	else
	{
		jQuery(e).html('<i class="glyph-icon flaticon-expand-2"></i>');
	}
}

function layers_toggle(){
	jQuery('.div-layers').toggle('slow', function(){
		var check = jQuery('.div-layers').css('display');
		if(check == 'block')
		{
			jQuery('#dg-designer').css('z-index', 'auto');
		}
		else
		{
			jQuery('#dg-designer').css('z-index', '1');
		}
	});
}

jQuery(document).on('product.change.design', function(event, product){
	jQuery('.product-detail-title').html(product.title);
});

jQuery(document).on('select.item.design', function(event, e){
	if(typeof e == 'undefined' || typeof e.item == 'undefined') return false;
	var item = e.item;
	if(typeof item.lockedProportion != 'undefined' && item.lockedProportion == 1)
	{
		jQuery('.icon-ui-lock').html('<i class="fa fa-unlock-alt" aria-hidden="true"></i>');
	}
	else
	{
		jQuery('.icon-ui-lock').html('<i class="fa fa-lock" aria-hidden="true"></i>');
	}
	jQuery('#dg-help-functions').show();
});
jQuery(document).on('unselect.item.design', function(event, e){
	jQuery('#dg-help-functions').hide();
});