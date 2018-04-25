<?php
/**
 * @author tshirtecommerce - www.tshirtecommerce.com
 * @date: 2015-12-10
 * 
 * @copyright  Copyright (C) 2015 tshirtecommerce.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 *
 */

$addons->path_data = dirname(ROOT) .DS. 'data';
$settings 	= $addons->getSetting();
if (isset($settings->store) && isset($settings->store->enable) && $settings->store->enable == 1 && $settings->store->api != '')
{
 ?>
<li <?php if($data[0] == 'store') echo 'class="active open"' ?>>
	<a href='javascript:void(0)'>
		<i class='fa fa-database'></i>
		<span class='title'>Design Store</span>
		<i class='icon-arrow'></i>
		<span class='selected'></span>
		<script type='text/javascript' src='<?php echo site_url('assets/plugins/stores/chart.min.js', false); ?>'></script>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				store.charts.ini();
			});
		</script>
	</a>
	<ul class='sub-menu'>
		<li>
			<a href="javascript:;"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> Design Template <i class="icon-arrow"></i></a>
			<ul class='sub-menu'>
				<li <?php if($data[0] == 'store' && isset($data[1]) && ($data[1] == 'ideas' || $data[1] == 'idea')) echo 'class="active open"' ?>>
					<a href='<?php echo site_url('index.php/store/ideas'); ?>'>
						<span class='title'>Designs</span>
					</a>
				</li>
				
				<li <?php if($data[0] == 'store' && isset($data[2]) && $data[2] == 'idea') echo 'class="active open"' ?>>
					<a href='<?php echo site_url('index.php/store/category/idea'); ?>'>
						<span class='title'> Categories</span>
					</a>
				</li>

				<li <?php if($data[0] == 'store' && isset($data[1]) && $data[1] == 'types') echo 'class="active open"' ?>>
					<a href='<?php echo site_url('index.php/store/types'); ?>'>
						<span class='title'> Types</span>
					</a>
				</li>
				
				<li <?php if($data[0] == 'store' && isset($data[1]) && $data[1] == 'fields') echo 'class="active open"' ?>>
					<a href='<?php echo site_url('index.php/store/fields'); ?>'>
						<span class='title'> Fields</span>
					</a>
				</li>
			</ul>
		</li>

		<li>
			<a href="javascript:;"><i class="clip-pictures"></i> Cliparts <i class="icon-arrow"></i></a>
			<ul class='sub-menu'>
				<li <?php if( ($data[0] == 'store' && isset($data[1]) && $data[1] == 'arts') || (isset($data[2]) && $data[2] == 'arts') ) echo 'class="active open"' ?>>
					<a href='<?php echo site_url('index.php/store/arts'); ?>'>
						<span class='title'>Cliparts</span>
					</a>
				</li>

				<li <?php if($data[0] == 'store' && isset($data[2]) && $data[2] == 'art') echo 'class="active open"' ?>>
					<a href='<?php echo site_url('index.php/store/category/art'); ?>'>
						<span class='title'> Categories</span>
					</a>
				</li>
			</ul>
		</li>
		
		<li <?php if($data[0] == 'store' && isset($data[1]) && $data[1] == 'charts') echo 'class="active open"' ?>>
			<a href='<?php echo site_url('index.php/store/charts'); ?>'>
				<i class="clip-bars" aria-hidden="true"></i> <span class='title'> Reports</span>
			</a>
		</li>
	</ul>
</li>
<?php } ?>
 