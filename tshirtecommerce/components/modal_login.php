<?php 
/**
 * @author tshirtecommerce - www.tshirtecommerce.com
 * @date: 2016-03-26
 *
 * API
 *
 * @copyright  Copyright (C) 2015 tshirtecommerce.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 *
 */
 
include_once ROOT .DS. 'includes' .DS. 'functions.php';
$dg = new dg();
$site_url = $dg->url();
?>
<div class="modal fade" id="f-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div id="f-login-content" class="modal-dialog">
		<div class="modal-content">
	  		<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><?php echo lang('designer_user_login_now_or_sign_up'); ?></h4>
	  		</div>
		  	<div class="modal-body">
				<div class="row">
					<!-- login form -->
					<div class="col-sm-12">		
						<form id="fr-login" role="form" style="margin-bottom: 5px;">						  						 
					  		<div class="form-group">
								<label><?php echo lang('designer_user_email'); ?></label>
								<input type="text" id="login-username" class="form-control">
					  		</div>
						  	<div class="form-group">
								<label><?php echo lang('designer_user_password'); ?></label>
								<input type="password" id="login-password" class="form-control">
						  	</div>
						</form>
						<div id="login-status" class="alert alert-danger" style="display: none;">
							<?php echo lang('designer_user_login_failed'); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-xs-12 col-sm-3">
						<button type="button" onclick="design.user.ini(this, 'login')" autocomplete="off" class="btn btn-primary form-control" data-loading-text="Loading"><?php echo lang('designer_user_login'); ?></button>
					</div>
					<div class="col-xs-12 col-sm-9">
						<span>
							<a style="text-decoration:underline;line-height:1.428571429;padding: 6px 0px;display: inline-block;font-weight: 400;" href="<?php echo $site_url ?>index.php?route=account/register" target='_blank'><?php echo lang('designer_user_register'); ?></a>
							<a style="text-decoration:underline;line-height:1.428571429;padding: 6px 0px;display: inline-block;margin-left:12px;font-weight: 400;" href="<?php echo $site_url ?>index.php?route=account/forgotten" target='_blank'><?php echo lang('designer_user_login_fogot_password'); ?></a>
						</span>
					</div>
				</div>
			</div>
		</div>
  	</div>	  
</div>
<!-- End Login -->