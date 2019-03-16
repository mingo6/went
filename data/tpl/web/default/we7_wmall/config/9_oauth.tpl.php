<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<h2>oAuth设置</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">oAuth独立域名</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="oauth_host" value="<?php  echo $oauth['oauth_host'];?>" class="form-control">
				<div class="help-block">此处填写您在微信公众平台设置的网页授权接口的域名,以http或https开头。如不填写可为空，如果要设置,确保与微信公众平台的网页授权接口保持一致。此项主要用来解决:"redirct_url和后台设置的域名不一致，错误码：10003"的问题</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>