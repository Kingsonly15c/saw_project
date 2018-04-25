<?php
$token	= session_id();
$new = true;
if (empty($data['settings']['store']))
{
	$store = array(
		'enable'	=> 0,
	);
	if ( empty($store['auto_download']) )
		$store['auto_download'] = 1;
}
else
{
	$new 	= false;
	$store 	= $data['settings']['store'];
	
	if ( empty($store['auto_download']) )
		$store['auto_download'] = 0;
}
if ( empty($store['enable']) )
	$store['enable'] = 0;

if ( empty($store['api']) )
{
	$store['api'] = '';
}

if ( empty($store['time']) )
	$store['time'] = 0;

$check_api 			= false;
if(empty($store['verified']))
	$store['verified']	= 0;

if($store['api'] != '' && $store['enable'] ==1)
{
	include_once(dirname(ROOT) .DS. 'api.php');
	$api = new API($store['api']);
	$keys = $api->getKey();
	if ($keys == false)
	{
		$html = '<button type="button" class="btn btn-danger">No Activated</button>';
		if($store['verified'] == 1)
		{
			$data['settings']['store']['verified'] = 0;
			$settings = json_encode($data['settings']);
			$file_setting = dirname(ROOT) .DS. 'data' .DS. 'settings.json';
			$api->WriteFile($file_setting, $settings);
		}
		$store['verified']	= 0;
	}
	else
	{
		if($store['verified'] == 0)
		{
			$data['settings']['store']['verified'] = 1;
			$settings = json_encode($data['settings']);
			$file_setting = dirname(ROOT) .DS. 'data' .DS. 'settings.json';
			$api->WriteFile($file_setting, $settings);
		}
		$check_api = true;
		$store['verified']	= 1;
		$html 	= '<button type="button" class="btn btn-success">Activated</button>';
		$html 	.= '<div class="col-sm-offset-3 col-sm-9"><span>Plan: <strong>'.$keys['plan'].'</strong>; <br /> Activated From: <strong>'.$keys['start_date'].'</strong> to <strong>'.$keys['end_date'].'</strong></span></div>';
	}
}
else
{
	$store['verified']	= 0;
	$html 				= '';
}

if (empty($store['exchange_rate'])) $store['exchange_rate'] = 0.2;
?>
<div class="col-md-12">
	<p class="text-muted">T-Shirt eCommerce Store give to your site library with cliparts and design template from our community of designers. <a href="http://9file.net/" target="_blank">View More</a></p>
	
	<div class="form-group row">
		<label class="col-sm-3 control-label"><strong>Enable Store</strong></label>
		<div class="col-sm-6">
			<input type="checkbox" class="active_store" onclick="activeStore(this);" <?php if($store['enable'] == 1) echo 'checked="checked"'; ?> name="setting[store][enable]" value="1">
		</div>
	</div>
	
	<div class="row store-enable" <?php if($store['enable'] != 1) echo 'style="display:none;"'; ?>>
		
		<div class="form-group">
			<label class="col-sm-3 control-label">Your API</label>
			<div class="col-sm-6">
				<input type="text" name="setting[store][api]" class="form-control" value="<?php echo $store['api']; ?>">
				<input type="hidden" name="setting[store][verified]" value="<?php echo $store['verified']; ?>">
			</div>
			<?php echo $html; ?>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label">Automatic download new data</label>
			<div class="col-sm-9 store_auto_download">
				<?php echo displayRadio('[store][auto_download]', $store, 'auto_download', 1); ?>
				<p class="text-muted">
					"YES": Automatic download new data with arts and design template one time/day.<br />
					"No": System only download one time.
				</p>
				<input type="hidden" class="auto_download_value" value="<?php echo $store['auto_download']; ?>" />
			</div>
		</div>

		<?php if ($check_api == true) { ?>
		<div class="form-group">
			<label class="col-sm-3"></label>
			<div class="col-sm-9">
				<button type="button" class="btn btn-success" onclick="reloadData(this)">Update Data Now!</button>
				<p class="text-muted">System automatic download data but you can use this button to import data whenever.</p>
			</div>
		</div>
		<?php } ?>
		
		<div class="form-group">
			<label class="col-sm-3 control-label">Show Your Clipart</label>
			<div class="col-sm-9">
				<?php echo displayRadio('[store][your_clipart]', $store, 'your_clipart', 0); ?>
				<p class="text-muted">If you choose Yes, system show clipart of store and clipart you uploaded.</p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Exchange Rate</label>
			<div class="col-sm-9">
				<input type="text" name="setting[store][exchange_rate]" style="width: 200px;" class="form-control" value="<?php echo $store['exchange_rate']; ?>">
				<p class="text-muted">Price of clipart in store is <strong>Credits ($0.2/Credits)</strong>, system will show price with your currency. If you not using <strong>USD</strong>, you can change "Exchange Rate", system will automatic convert price and show in front-end of design tool.</p>
				<p class="text-muted">Note: if you not want calculate price cliparts to client you only need setup <strong>Rate = 0</strong></p>
			</div>
		</div>
		
	</div>
</div>
<script id="mask_downloading" type="text/html">
	<div class="store-mask-content">
		<h3>The importer is working</h3>
		<span>Status: <span class="downloading-status">Importing categories of cliparts</span></span>
		<div class="progress">
			<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width: 1%">
				<span class="sr-only">40% Complete (success)</span>
			</div>
		</div>
		<p>Please don't navigate away while importing</p>
	</div>
</script>
<script type="text/javascript">
function activeStore(e)
{
	if (jQuery(e).is(':checked'))
	{
		jQuery('.store-enable').show('slow');
	}
	else
	{
		jQuery('.store-enable').hide('slow');
	}
}
function reloadData(e)
{
	if(jQuery('.store-mask').length == 0)
	{	
		jQuery('body').append('<div class="store-mask"><span>Data Downloading...</span></div>');
	}
	var mask = jQuery('.store-mask');
	mask.show();
	var btn = jQuery(e).button('loading');
	jQuery.ajax({
		url: "<?php echo str_replace('tshirtecommerce/', 'wp-admin/admin-ajax.php?action=tshirt_store_import_all&type=art', site_url('', false)); ?>",
		type: "GET",
		complete: function(data) {
			jQuery.ajax({
				url: "<?php echo str_replace('tshirtecommerce/', 'wp-admin/admin-ajax.php?action=tshirt_store_import_all&type=idea', site_url('', false)); ?>",
				type: "GET",
				complete: function(data) {
					btn.button('reset');
					mask.hide('slow');
				}
			});
		}
	});
}
function import_data(mask, status)
{
	status = status + 1;
	if(status == 2)
	{
		mask.show();
	}
	if(status > 6)
	{
		mask.hide('slow');
		return false;
	}
	var width 	= 1;
    var id 		= setInterval(frame, 300);
    function frame() {
        if (width >= 100) {
            clearInterval(id);
        } else {
            width++; 
            jQuery('.store-mask .progress-bar').css('width', width + '%'); 
        }
    }
	jQuery.ajax({
		url: "<?php echo site_url('ajax.php?type=addon&task=store_admin&token='.$token, false); ?>"+'&status='+status,
		type: "GET",
		success: function(text){
			jQuery('.store-mask .progress-bar').css('width', '100%');
			var data = eval ("(" + text + ")");
			if(typeof data != 'undefined' && typeof data.error != 'undefined' && data.error == 0)
			{
				jQuery('.store-mask .downloading-status').html(data.msg);
				if(data.step == 0)
				{
					mask.hide('slow');
				}
				else
				{
					import_data(mask, status);
				}
			}
			else
			{
				mask.hide('slow');
			}
		},
		error: function(xhr) {
			mask.hide('slow');
		}
	});
}
function download(e)
{
	var status = 0;
	if(jQuery('.store-mask').length == 0)
	{	
		jQuery('body').append('<div class="store-mask">'+jQuery('#mask_downloading').html()+'</div>');
	}
	var mask = jQuery('.store-mask');
	import_data(mask, status);
}
function addHook(type)
{
	if(type == 1)
	{
		var url = '<?php echo str_replace('tshirtecommerce/', 'wp-admin/admin-ajax.php?action=tshirt_store_add_cronjobs', site_url('', false)); ?>';
	}
	else
	{
		var url = '<?php echo str_replace('tshirtecommerce/', 'wp-admin/admin-ajax.php?action=tshirt_store_remove_cronjobs', site_url('', false)); ?>';
	}		
	jQuery.ajax({
		url: url,
		type: "GET",
		complete: function(data) {
			jQuery('.auto_download_value').parents('form').submit();
		}
	});
}
jQuery(document).ready(function(){
	<?php if($store['verified'] == 1){ ?>
	if(jQuery('.active_store').is(':checked'))
	{
		download('');
	}
	jQuery('.store_auto_download input').click(function(){		
		var old = jQuery('.auto_download_value').val();
		var value = jQuery(this).val();
		if(old != value)
		{
			var check = confirm('You sure want change automatic download data?');
			if(check == true)
			{
				jQuery('.auto_download_value').val(value);
				addHook(value);
			}
			else
			{
				return false;
			}
		}
	});
	<?php } ?>
});
</script>