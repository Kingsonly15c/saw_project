var is_save = 0;
design.user = {
	ini: function(e, type)
	{
		var datas = {};
		
		var username = jQuery('#'+type+'-username').val();
		var password = jQuery('#'+type+'-password').val();
		if (username == '')
		{
			alert_text(lang.text.username);
			return false;
		}
		
		if (password == '')
		{
			alert_text(lang.text.password);
			return false;
		}
		datas.username = username;
		datas.password = password;
		
		if (type == 'login')
		{
			var url = mainURL + 'index.php?route=tshirtecommerce/designer_api/login';

		}
		else
		{
			return false;
		}
		jQuery('#'+type+'-status').css('display', 'none');
		var $btn = jQuery(e).button('loading');
		jQuery.ajax({
			type: "POST",
			dataType: "json",
			url: url,
			data: datas
		}).done(function( data ) {
			
			if (typeof data.error != 'undefined' && typeof data.id != 'undefined')
			{	
				var valid_login = data.error;
				
				if (valid_login == 0)
				{
					jQuery('#'+type+'-status').css('display', 'block');
					jQuery('#'+type+'-status a').click(function(e){
						e.preventDefault(); 
						var url = jQuery(this).attr('href'); 
						window.open(url, '_blank');
					});
				}
				else //if (valid_login >= 1)
				{
					user_id = data.id;
					jQuery('#f-'+type).modal('hide');
					var page = document.referrer;
					jQuery.ajax({url: page}).done(function(){
						if (is_save == 1)
							design.save();
						else
							design.ajax.mydesign();
					});
				}
			}
			$btn.button('reset');
		});
	}
}

// load design of cart
design.imports.cart = function(key){
	design.mask(true);
	
	jQuery.ajax({				
		dataType: "json",
		url: siteURL + "ajax.php?type=cartDesign&cart_id="+key		
	}).done(function( data ) {
		if (data.error == 1)
		{
			alert_text(data.msg);
		}
		else
		{
			design.fonts = data.design.fonts;
			design.imports.productColor(data.design.color);
			if (design.fonts != '')
			{
				jQuery('head').append(design.fonts);
			}
			design.imports.vector(data.design.vector);
			if (data.design.item.teams != '')
			{
				design.teams = data.design.item.teams;				
				design.team.load(data.design.item.teams);
			}
			
			jQuery(document).triggerHandler( "after.load.design", data);
			
			design.ajax.getPrice();
			
			var a = document.getElementById('product-thumbs').getElementsByTagName('a');
			design.products.changeView(a[0], 'front');
		}
	}).always(function(){
		design.mask(false);
	});
}