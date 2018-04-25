<?php
/**
 * @author tshirtecommerce - www.tshirtecommerce.com
 * @date: 2017-05-7
 *
 * @copyright  Copyright (C) 2016 tshirtecommerce.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 *
 */
if(!isset($data['settings']['minifyjs']))
{
	$data['settings']['minifyjs'] = 0;
}
if(!isset($data['settings']['minifyjsdata']))
{
	$data['settings']['minifyjsdata'] = array();
}
require_once ROOT .DS. 'includes' .DS. 'functions.php';
$dg = new dg();
$pathjs  = dirname(ROOT) .DS. 'addons' .DS. 'js' .DS;
$filesJS = $dg->getFiles($pathjs, '.js');
?>
<h4><?php echo $addons->__('addon_minifyjs_title'); ?></h4>
<p class="help-block"><small><?php echo $addons->__('addon_minifyjs_title_help'); ?></small></p>
<div class="form-group row">
	<label class="col-sm-3 control-label">
		<?php echo $addons->__('addon_minifyjs_label'); ?>
	</label>
	<div class="col-sm-6">
		<label class="radio-inline">
			<?php if($data['settings']['minifyjs'] == '1') { ?>
				<input type="radio" class="minifyjsEnable" name="setting[minifyjs]" value="1" checked="checked"/> <?php echo $addons->__('addon_minifyjs_yes'); ?>
			<?php } else { ?>
				<input type="radio" class="minifyjsEnable" name="setting[minifyjs]" value="1"/> <?php echo $addons->__('addon_minifyjs_yes'); ?>
			<?php } ?>
		</label>
		<label class="radio-inline">
			<?php if($data['settings']['minifyjs'] == '0') { ?>
				<input type="radio" class="minifyjsDisable" name="setting[minifyjs]" value="0" checked="checked"/> <?php echo $addons->__('addon_minifyjs_no'); ?>
			<?php } else { ?>
				<input type="radio" class="minifyjsDisable" name="setting[minifyjs]" value="0"/> <?php echo $addons->__('addon_minifyjs_no'); ?>
			<?php } ?>
		</label>
	</div>
</div>

<div class="form-group minifyjsItems">
	<label class="col-sm-12 control-label">
		<?php echo $addons->__('addon_minify_sort_label'); ?>
	</label>
	<?php if(count($filesJS) > 0) { ?>
		<div class="col-sm-12">
			<select multiple class="chosen-select" name="setting[minifyjsdata][]">
				<?php
					foreach($filesJS as $key=>$val)
					{
						$val = str_replace('.js', '', $val);
						if(in_array($val, $data['settings']['minifyjsdata']))
						{
							echo '<option value="'.$val.'" selected>'.$val.'.js</option>';
						}else
						{
							echo '<option value="'.$val.'">'.$val.'.js</option>';
						}
					}
				?>
			</select>
		</div>
	<?php } else { echo $addons->__('addon_minify_add_new_addon'); } ?>
</div>
<script type='text/javascript'>	
jQuery(document).ready(function(){
	var minifyjs = '<?php echo $data['settings']['minifyjs']; ?>'
	if(minifyjs == '1')
	{
		jQuery('.minifyjsItems').css({'display': 'block'});
	}
	else
	{
		jQuery('.minifyjsItems').css({'display': 'none'});
	}

	jQuery('.minifyjsEnable').click(function() {
		jQuery('.minifyjsItems').show(500);
	});
	jQuery('.minifyjsDisable').click(function() {
		jQuery('.minifyjsItems').hide(500);
	});
});
</script>
<hr/>