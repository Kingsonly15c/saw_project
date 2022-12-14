var sizesCn = {};
// change size of box design width product
function change_box_design()
{
	jQuery('#app-wrap .labView').css({'width':max_box_width+'px', 'height':max_box_height+'px'}); 
}

jQuery(document).on('after.load.design', function(event, data){
	var tdesign = data.design;
	if(typeof tdesign.options != 'undefined' && typeof tdesign.options.is_color_picker != 'undefined' && tdesign.options.is_color_picker == 1)
	{
		if(jQuery('.bg-more-colors').length)
		{
			jQuery('#product-list-colors .bg-colors').removeClass('active');
			var div = jQuery('#product-list-colors .bg-more-colors');
			div.data('color', tdesign.color);
			div.addClass('active');
			design.products.changeColor(div[0], 0);
		}
	}
});

jQuery(document).ready(function(){
	jQuery('#app-wrap .labView').append('<div class="mask-items-view"><div class="mask-items-area"><div class="mask-item"></div></div></div>');
		
	jQuery.each(['front', 'back', 'left', 'right'], function(i, view){
		if (items.area[view] != '' && items.area[view] != '')
		{
			var params = eval ("(" + items.params[view] + ")");
			var area = eval ("(" + items.area[view] + ")");
			
			sizesCn[view] =  params.width / area.width;
		}
	});
	
	jQuery(document).keydown(function( event ) {		
		if (jQuery('.labView.active .drag-item-selected').length > 0)
		{
			var check = jQuery('#enter-text').is(":focus"); // disable move when focus text box.
			var key = event.which;
			if(check == false)
			{
				if (key == 37)
				{
					design.tools.move('left');
				}
				else if (key == 39)
				{
					design.tools.move('right');
				}
				else if (key == 38)
				{
					event.preventDefault(); // disable scroll window.
					design.tools.move('up');
				}
				else if (key == 40)
				{
					event.preventDefault(); // disable scroll window.
					design.tools.move('down');
				}
				else if (key == 46)
				{
					design.tools.remove();
				}
			}
		}
	});
	
	// product color on mobile
	if ( jQuery('.product-color-active .product-color-active-value').length > 0)
	{
		var color_html = jQuery('#product-list-colors .bg-colors.active').html();
		jQuery('.product-color-active .product-color-active-value').html(color_html);
		
		jQuery(document).on('changeColor.product.design product.change.design', function(){
			var color_html = jQuery('#product-list-colors .bg-colors.active').html();
			jQuery('.product-color-active .product-color-active-value').html(color_html);
		});
	}
	
	jQuery('#dg-fonts').on('show.bs.modal', function() {
		var e    = design.item.get();
		if(typeof e[0] == 'undefined')
		{
			return false;
		}
		var font = e[0].item.fontFamily;
		var tmp  = '';
		jQuery('#dg-fonts .box-font').removeClass('active');
		jQuery('#dg-fonts .box-font').each(function() {
			var tmpFont = jQuery(this).find('h2').css('font-family');
			if(tmpFont == undefined)
			{
				tmpFont = jQuery(this).find('img').attr('alt');
			}
			if(tmpFont.indexOf(font) != -1) {
				if(tmp == '')
				{
					jQuery(this).addClass('active');
					tmp = tmpFont;
				}
				else
				{
					if(tmpFont.length < tmp.length)
					{
						jQuery('#dg-fonts .box-font').removeClass('active');
						jQuery(this).addClass('active');
					}
				}
			}
		});
	});
	
	change_box_design()
});

jQuery(document).on("change.product.design", function(event, product){
	if (typeof event.namespace == 'undefined' || event.namespace != 'design.product') return;
	
	jQuery.each(['front', 'back', 'left', 'right'], function(i, view){
		if (items.area[view] != '' && items.area[view] != '')
		{
			var params = eval ("(" + items.params[view] + ")");
			var area = eval ("(" + items.area[view] + ")");
			
			sizesCn[view] =  params.width / area.width;
		}
	});
	
	if(typeof product.box_width != 'undefined')
	{
		max_box_width = product.box_width;
	}
	else
	{
		max_box_width = 500;
	}
	if(typeof product.box_height != 'undefined')
	{
		max_box_height = product.box_height;
	}
	else
	{
		max_box_height = 500;
	}
	change_box_design();
	if(typeof design.mobile == 'undefined')
	{
		window.parent.setHeigh(jQuery('#dg-wapper').height());
	}
	if(typeof layout_menu_bottom != 'undefined')
	{
		var col_center_h = jQuery('.col-center').height();
		jQuery('.col-left').css('top', col_center_h+'px');
	}
});

jQuery(document).on('move.tool.design', function(event, elm){
	var style = jQuery(elm).attr('style');
	jQuery(elm).parents('.labView').find('.mask-item').attr('style', style);
});

jQuery(document).on('select.item.design', function(event, e){
	
	var id = jQuery('.labView.active').attr('id');
	var view = id.replace('view-', '');
	
	if (jQuery(e).length == 0)
	{
		var elm = design.item.get();
		var e = elm[0];
	}
	if (typeof e == 'undefined') return;
	var style = jQuery(e).parents('.design-area').attr('style');
	jQuery(e).parents('.labView').find('.mask-items-area').attr('style', style);
	jQuery(e).parents('.labView').find('.mask-items-view').css('display', 'block');
	
	var style = jQuery(e).attr('style');
	var item = jQuery(e).parents('.labView').find('.mask-item');
	item.attr('style', style);
	var width = item.width();
	width = parseInt(width) + 4;
	item.css('width', width+'px');
	
	// update size of item
	if (jQuery('.labView.active .mask-item .item-info').length == 0)
	{
		item.append('<span class="item-info"></span>');
	}
	
	if (jQuery('.labView.active .mask-item .item-mask-move').length == 0)
	{
		item.append('<div class="item-mask-move fa fa fa-arrows"></div>');
	}
	var width   = parseInt(jQuery(e).css('width').replace('px', '')) * sizesCn[view];
	var height  = parseInt(jQuery(e).css('height').replace('px', '')) * sizesCn[view];
	var viewDes = jQuery('#design-area .labView.active .design-area');
	var zoom    = -1;
	if(viewDes.hasClass('zoom')) {
		zoom   = viewDes.data('zoom');
		width  = width / zoom;
		height = height / zoom;
	}
	if(typeof design.mobile != 'undefined' && typeof design.mobile.zoom != 'undefined')
	{
		width  = width / design.mobile.zoom;
		height = height / design.mobile.zoom;
	}

	width = width.toFixed(1);
	height = height.toFixed(1);
	jQuery('.labView.active .mask-item .item-info').html(width +' x '+ height);
	
	var type = jQuery(e).data('type');
	jQuery('#'+type+'-width').val(width);
	jQuery('#'+type+'-height').val(height);
	jQuery(document).triggerHandler( "info.size.design", [type, width, height]);
	
	// resize
	var type = e.item.type;	
	if(e.item.lockedProportion == 1)
	{
		var auto = false;
		var handles = 'e, s, se';
		jQuery('#'+type+'-lock').prop('checked', true);
	}
	else
	{
		var auto = true;
		var handles = 'se';
		jQuery('#'+type+'-lock').prop('checked', false);
	}
	design.item.lockpropo = auto;
	if (jQuery('.labView.active .mask-item').hasClass('ui-resizable'))
		jQuery('.labView.active .mask-item').resizable( "destroy" );
	var tempW = 0;
	item.resizable({
		minHeight: 10, 
		aspectRatio: auto,
		minWidth: 10,		
		handles: handles,
		grid: 1,
		alsoResize: ".drag-item.drag-item-selected",
		start: function( event, ui ){
			tempW = ui.originalSize.width;
			jQuery(document).triggerHandler( "resizeStart.item.design", ui);
		},
		stop: function( event, ui ) {			
			jQuery(document).triggerHandler( "resize.item.design", ui);
			design.print.size();
			design.ajax.getPrice();
		},
		resize: function(event,ui){
			var $left   = parseInt(ui.position.left),
				$top    = parseInt(ui.position.top),
				$width  = parseInt(jQuery(e).css('width').replace('px', '')),
				$height = parseInt(jQuery(e).css('height').replace('px', ''));

			var svg     = jQuery(e).find('svg');
			svg[0].setAttributeNS(null, 'width', $width);
			svg[0].setAttributeNS(null, 'height', $height);
			svg[0].setAttributeNS(null, 'preserveAspectRatio', 'none');
			
			if(jQuery(e).data('type') == 'clipart')
			{
				var file = jQuery(e).data('file');
				if(file.type == 'image' || jQuery(e).find('image').length > 0)
				{
					if(typeof file.type == 'undefined')
					{
						file = {
							'type': 'image',
						};
						jQuery(e).data('file', file);
					}
					var imgSvg = design.item.get().find('svg');
					var gEle   = jQuery(imgSvg[0]).find('g');
					flipFlg    = true;
					if(gEle.attr('transform') != undefined)
					{
						if(gEle.attr('transform').indexOf('scale(-1,1)') != -1) {
							flipFlg = false;
						}
					}
					var img = jQuery(e).find('image');
					img[0].setAttributeNS(null, 'width', $width);
					img[0].setAttributeNS(null, 'height', $height);
					
					if (flipFlg == false)
					{
						jQuery(img[0]).parent().attr('transform', 'translate('+$width+', 0) scale(-1,1)');
					}
				}
			}
			
			var width  = $width * sizesCn[view];
			var height = $height * sizesCn[view];
			if(zoom != -1)
			{
				width  = width / zoom;
				height = height / zoom;
			}
			if(typeof design.mobile != 'undefined' && typeof design.mobile.zoom != 'undefined')
			{
				width  = width / design.mobile.zoom;
				height = height / design.mobile.zoom;
			}
			width = width.toFixed(1);
			height = height.toFixed(1);
			jQuery('.labView.active .mask-item .item-info').html(width +' x '+ height);
			
			var type = jQuery(e).data('type');
			jQuery('#'+type+'-width').val(width);
			jQuery('#'+type+'-height').val(height);
			
			jQuery(document).triggerHandler( "info.size.design", [type, width, height]);
			jQuery(document).triggerHandler( "resizzing.item.design", ui);
		}
	});
	
	var top = 0, left = 0; recoupLeft = 0, recoupTop = 0;
	item.draggable({
		scroll: false,
		start: function( event, ui ){
			top = ui.position.top;
			left = ui.position.left;
			var t = design.convert.px(jQuery(this).css('top'));
			var l = design.convert.px(jQuery(this).css('left'));
			t = isNaN(t) ? 0 : t;
			l = isNaN(l) ? 0 : l;
			recoupLeft = l - left;
			recoupTop  = t - top;
		},
		drag:function(event, ui){
			ui.position.left += recoupLeft;
			ui.position.top  += recoupTop;
			jQuery(e).css('left', ui.position.left);
			jQuery(e).css('top', ui.position.top);
			jQuery(document).triggerHandler( "draging.item.design", ui);
		},
		stop: function( event, ui ) {
			var width = jQuery(this).width();
			var height = jQuery(this).height();
			var areaW = jQuery(this).parent().width();
			var areaH = jQuery(this).parent().height();
			if (
				(ui.position.left + width) < 5 
				|| (ui.position.top + height) < 5
				|| (ui.position.left + 5) > areaW
				|| (ui.position.top + 5) > areaH
			)
			{
				jQuery(e).css('left', left);
				jQuery(e).css('top', top);
				jQuery(this).css('left', left);
				jQuery(this).css('top', top);
			}
			jQuery(document).triggerHandler( "move.item.design", ui);
			design.ajax.getPrice();
		}
	});
	
	// add remove button
	if(e.item.remove != false)
	{
		jQuery('.mask-item .item-mask-remove-on').css('visibility', 'visible');
		
		if (jQuery('.labView.active .mask-item .item-mask-remove-on').length == 0)
		{
			var div = document.createElement('div');
			div.className = 'item-mask-remove-on fa fa-trash-o ui-resizable-handle';
			div.setAttribute('title', lang.text.remove);
			//div.setAttribute('onclick', 'design.item.mask.remove()');
			jQuery(div).bind('click', function(){design.item.mask.remove();});
			jQuery(item).append(div);		
		}		
	}
	else
	{
		jQuery('.mask-item .item-mask-remove-on').css('visibility', 'hidden');
	}
	
	// rotate	
	if(typeof e.item.rotate != 'undefined' && e.item.rotate !== false)
	{
		jQuery('.mask-item .item-rotate-on').css('visibility', 'visible');
		
		var deg = jQuery(e).data('rotate');
		jQuery('#' + type + '-rotate-value').val(deg);
		if (typeof deg == 'undefined')
		{
			deg = 0;
		}
		else
		{
			if(deg < 180)
			{
				deg = deg * Math.PI / 180;
			}
			else
			{
				deg = -(360 - deg) * Math.PI / 180;
			}
		}
		item.data('angle', deg);
		item.rotatable({
			angle: deg, 
			rotate: function(event, angle){
				var deg = Math.round(angle.r);
				if(deg < 0) deg = 360 + deg;
				jQuery('#' + type + '-rotate-value').val(deg);
				jQuery(e).data('rotate', deg);
				
				var radian = deg * Math.PI / 180;
				//jQuery(e).rotatable("setValue", radian);
				design.item.mask.rotate(jQuery(e), radian);
			}
		});
	}
	else
	{
		jQuery('.mask-item .item-rotate-on').css('visibility', 'hidden');
	}
	var itemWidthVal  = jQuery('#'+type+'-width');
	var itemHeightVal = jQuery('#'+type+'-height');
	if(typeof design.mobile == 'undefined')
	{
		itemWidthVal[0].removeAttribute('readonly');
		itemWidthVal[0].removeAttribute('disabled');
		itemHeightVal[0].removeAttribute('readonly');
		itemHeightVal[0].removeAttribute('disabled');
	}
	
	itemWidthVal.change(function(e) {
		var txtH = (parseInt(design.item.get().css('height').replace('px', '')) * sizesCn[view]).toFixed(1);
		var txtW = (parseInt(design.item.get().css('width').replace('px', '')) * sizesCn[view]).toFixed(1);
		if(itemWidthVal.val() == '') {
			return false;
		}
		var newW = parseFloat(itemWidthVal.val()).toFixed(1);
		var newH;
		jQuery(document).triggerHandler( "beforechangesize.item.design", [txtW, txtH]);
		if(jQuery('#'+type+'-lock').prop('checked') == false)
		{
			newH = (newW * txtH / txtW).toFixed(1);
		}
		else
		{
			newH = txtH;
		}
		if(typeof design.mobile != 'undefined' && typeof design.mobile.zoom != 'undefined')
		{
			newW  = width / design.mobile.zoom;
			newH = height / design.mobile.zoom;
		}
		itemWidthVal.val(newW);
		itemHeightVal.val(newH);
		newW = newW.toFixed(1);
		newH = newH.toFixed(1);
		jQuery('.labView.active .mask-item .item-info').html(newW +' x '+ newH);
		changeSizeTextItem(e, newW / sizesCn[view], newH / sizesCn[view]);
		design.print.size();
		design.ajax.getPrice();
	});
	itemHeightVal.change(function(e) {
		var txtH = (parseInt(design.item.get().css('height').replace('px', '')) * sizesCn[view]).toFixed(1);
		var txtW = (parseInt(design.item.get().css('width').replace('px', '')) * sizesCn[view]).toFixed(1);
		if(itemHeightVal.val() == '') {
			return false;
		}
		var newH = parseFloat(itemHeightVal.val()).toFixed(1);
		var newW;
		jQuery(document).triggerHandler( "beforechangesize.item.design", [txtW, txtH]);
		if(jQuery('#'+type+'-lock').prop('checked') == false)
		{
			newW = (newH * txtW / txtH).toFixed(1);
		}
		else
		{
			newW = txtW;
		}
		if(typeof design.mobile != 'undefined' && typeof design.mobile.zoom != 'undefined')
		{
			newW  = width / design.mobile.zoom;
			newH = height / design.mobile.zoom;
		}
		itemWidthVal.val(newW);
		itemHeightVal.val(newH);
		newW = newW.toFixed(1);
		newH = newH.toFixed(1);
		jQuery('.labView.active .mask-item .item-info').html(newW +' x '+ newH);
		changeSizeTextItem(e, newW / sizesCn[view], newH / sizesCn[view]);
		design.print.size();
		design.ajax.getPrice();
	});
	
	jQuery(e).draggable({ disabled: true });
});

jQuery('.rotate-refresh').click(function(){
	design.item.refresh('rotate');
	jQuery('.labView.active .mask-item').css('transform', 'rotate(0rad)');
});

jQuery('.rotate-value').on("focus change", function(){
	var e = design.item.get();
	var deg = jQuery(this).val();
	if(deg > 360) deg = 360;
	if(deg < 0) deg = 0;
	var angle = (jQuery(this).val() * Math.PI)/180;
	e.rotatable("setValue", angle);
	
	design.item.mask.rotate(jQuery('.labView.active .mask-item'), angle);
});

// remove name, number
jQuery(document).on('remove.team.design', function(event){
	jQuery('.mask-items-view').css('display', 'none');
});

jQuery(document).on('unselect.item.design remove.item.design', function(event, e){
	var item = jQuery('.labView.active .mask-items-view');
	item.css('display', 'none');
});

jQuery(document).on('size.update.text.design', function(event, w, h){
	jQuery('.labView.active .mask-item').css({'width':w+'px', 'height':h+'px'});
	design.text.sizeFontTxt();
});

design.item.mask = {
	remove: function(){
		var e = design.item.get();
		var elm = e.children('.item-remove-on');
		if (elm.length > 0)
		{
			design.item.remove(elm[0]);			
		}
	},
	rotate: function(el, angle){
		el.css('transform','rotate(' + angle + 'rad)');
		el.css('-moz-transform','rotate(' + angle + 'rad)');
		el.css('-webkit-transform','rotate(' + angle + 'rad)');
		el.css('-o-transform','rotate(' + angle + 'rad)');
	}
};

jQuery(document).on('ini.design change.product.design', function(event){
	if (typeof event.namespace == 'undefined') return;
	
	jQuery("#tool_cart select, input[type='radio'], input[type='checkbox']").change(function(){
		design.ajax.getPrice();		
	});
});

jQuery(document).on('before.create.item.design', function(event, span){
	span.item.lockedProportion = 0;
	if (jQuery('.labView.active .mask-item').hasClass('ui-resizable'))
		jQuery('.labView.active .mask-item').resizable( "destroy" );
});

jQuery(document).on('ini.design', function(event){
	jQuery('.ui-lock').click(function(){		
		var e = design.item.get();
		if (jQuery(this).is(':checked') == true)
		{
			e[0].item.lockedProportion = 1;
		}
		else
		{
			e[0].item.lockedProportion = 0;
		}
		if (typeof e[0] != 'undefined')
		{
			jQuery('.labView.active .mask-item').resizable( "destroy" );
			design.item.unselect();
			design.item.select(e[0]);
		}
	});
});

jQuery(document).on('beforechangefont.item.design', function(width, height) {
	var item   = design.item.get();
	if(item.length == 0) return false;
	var id     = jQuery('.labView.active').attr('id');
	var view   = id.replace('view-', '');
	var width  = (parseInt(item.css('width').replace('px', '')) * sizesCn[view]).toFixed(1);
	var height = (parseInt(item.css('height').replace('px', '')) * sizesCn[view]).toFixed(1);
	if(typeof design.mobile != 'undefined' && typeof design.mobile.zoom != 'undefined')
	{
		width  = width / design.mobile.zoom;
		height = height / design.mobile.zoom;
	}
	width = parseInt(width);
	height = parseInt(height);
	width = width.toFixed(1);
	height = height.toFixed(1);
	jQuery('.labView.active .mask-item .item-info').html(width +' x '+ height);
	jQuery('#text-width').val(width);
	jQuery('#text-height').val(height);
});

var changeSizeTextItem = function(e, newW, newH) {
	var item = design.item.get();
	var svg  = item.find('svg');
	jQuery('.labView.active').find('.mask-item').css({
		'width' : newW + 'px',
		'height': newH + 'px'
	});
	item.css({
		'width' : newW + 'px',
		'height': newH + 'px'
	});
	svg[0].setAttribute('width', newW);
	svg[0].setAttribute('height', newH);
	svg[0].setAttribute('preserveAspectRatio', 'none');
	if(item.find('image').length != 0)
	{
		item.find('image')[0].setAttribute('width', newW);
		item.find('image')[0].setAttribute('height', newH);
	}
	jQuery(document).triggerHandler( "afterchangesize.item.design", [newW, newH]);
	e.preventDefault();
	e.stopImmediatePropagation();
	e.stopPropagation();
}
design.text.sizeFontTxt = function() {
	var item = design.item.get();
	if(typeof item[0] == 'undefined')
	{
		return false;
	}
	var svg  = item.find('svg');
	var txt  = item.find('text');
	var box  = svg[0].getAttribute('viewBox').split(' ');
	var zoom = box[2] / svg.attr('width');
	box[0]   = (txt[0].getBoundingClientRect().left - svg[0].getBoundingClientRect().left) * zoom;
	svg[0].setAttributeNS(null, 'viewBox', box.join(' '));
};
/*disable copy, save clipart*/
jQuery(document).ready(function () {
    jQuery("#dg-cliparts").on("contextmenu",function(e){
        return false;
    });
	jQuery('#dg-cliparts').bind('cut copy paste', function (e) {
        e.preventDefault();
    });
});
jQuery(document).on('load.item.design', function(event, img, e){
	if(typeof e.is_product != 'undefined' && e.is_product == 1)
	{
		jQuery(img).addClass('main-product-img');
	}
});