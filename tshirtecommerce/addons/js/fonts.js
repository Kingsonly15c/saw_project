design.text.baseencode = function(title, type, span){
	
	var title_file = title.replace(/ /g, '+');
	
	jQuery.ajax({
		url: baseURL + 'fonts.php?name='+title_file+'&type='+type,					
	}).done(function( data ) {
		if (data != '0')
		{
			if(typeof span == 'undefined')
			{
				var e = design.item.get();
			}
			else
			{
				var e = jQuery(span);
			}
			var svg = e.find('svg');
			if (typeof svg[0] != 'undefined')
			{
				
				var svg_ns = "http://www.w3.org/2000/svg";
				
				var fontFace = "data:application/font-ttf;charset=utf-8;base64, "+data;
				var style = document.createElementNS(svg_ns, 'style');
				var content = document.createTextNode('@font-face{font-family: \''+title+'\';src: url("'+fontFace+'") format(\'truetype\');}');
				style.appendChild(content);

				var defs = jQuery(svg[0]).find('defs');
				if (defs.length > 0)
				{					
					var styleOld = jQuery(svg[0]).find('style');
					if (styleOld.length > 0)
					{
						defs[0].removeChild(styleOld[0]);
					}
					
					defs[0].appendChild(style);
				}
				else
				{
					var defs = document.createElementNS(svg_ns,'defs');	
					defs.appendChild(style);
					svg[0].appendChild(defs);
				}
				
				setTimeout(function(){
					var rotate = e.data('rotate');
					if (rotate == 'undefined') rotate = 0;
					rotate = rotate * Math.PI / 180;
					e.css('transform', 'rotate(0rad)');	
							
					var txt = e.find('text');
					txt[0].setAttributeNS(null, 'y', 0);
					var size1 = txt[0].getBoundingClientRect();
					var size2 = e[0].getBoundingClientRect();
					var $w 	= parseInt(size1.width);							
					var $h 	= parseInt(size1.height);							
					design.item.updateSize($w, $h);

					var svg = e.find('svg'),
					view = svg[0].getAttributeNS(null, 'viewBox');
					var arr = view.split(' ');			
					var y = (size2.top - size1.top) * arr[3] / $h;
					txt[0].setAttributeNS(null, 'y', y);
					e.css('transform', 'rotate('+rotate+'rad)');
					var safari = /safari/.test(navigator.userAgent.toLowerCase());
					if (safari === true)
					{
						IOSFont(e);
					}
					jQuery(document).triggerHandler( "beforechangefont.item.design", [$w, $h]);	
				}, 1000);
			}
		}
	});
}