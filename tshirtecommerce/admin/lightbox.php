<!DOCTYPE html>
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<?php load_header($addons); ?>
</head>
<body style="background: #fff!important;">
	<!-- start: MAIN CONTAINER -->
	<div class="main-container" style="background: #fff!important;">		
		<?php echo $content; ?>
	</div>

	<script type="text/javascript">
		var admin_url_site = '<?php echo site_url(''); ?>';
		jQuery(document).ready(function(){
			Main.init();
			if(typeof window.parent.setHeightF != 'undefined')
			{
				var height = jQuery('body').height();
				window.parent.setHeightF(height);
			}
		});
	</script>
</body>
<!-- end: BODY -->
</html>