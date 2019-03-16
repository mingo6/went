<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<h2>支付回调设置</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">支付回调使用 http</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="notify_use_http" id="notify_use_http_yes" <?php  if($paycallback['notify_use_http'] == 1) { ?>checked<?php  } ?>>
					<label for="notify_use_http_yes">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="notify_use_http" id="notify_use_http_no" <?php  if($paycallback['notify_use_http'] == 0) { ?>checked<?php  } ?>>
					<label for="notify_use_http_no">否</label>
				</div>
				<span class="help-block">如果您的网站采用https协议，支付回调默认采用https方式，若要使用http，请先将网站设置为http协议。</span>
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