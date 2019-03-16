<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix page-config-store-delivery">
	<h2>配送员申请</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>是否短信验证手机号</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="mobile_verify_status" value="1" id="mobile-verify-status-1" <?php  if($settle['mobile_verify_status'] == 1) { ?>checked<?php  } ?>>
					<label for="mobile-verify-status-1">验证</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="mobile_verify_status" value="2" id="mobile-verify-status-2" <?php  if($settle['mobile_verify_status'] == 2 || !$settle['mobile_verify_status']) { ?>checked<?php  } ?>>
					<label for="mobile-verify-status-2">不验证</label>
				</div>
				<div class="help-block">开启验证手机号,需要配置短信参数.<a href="<?php  echo iurl('config/sms/set');?>" target="_blank">现在去配置</a></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>是否需要上传身份证照片</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="idCard" value="1" id="idCard-1" <?php  if($settle['idCard'] == 1) { ?>checked<?php  } ?>>
					<label for="idCard-1">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="idCard" value="2" id="idCard-2" <?php  if($settle['idCard'] == 2 ) { ?>checked<?php  } ?>>
					<label for="idCard-2">否</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>入驻协议</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_ueditor('agreement_delivery', $settle['agreement_delivery']);?>
				<div class="help-block">不填写时，配送员申请页面将不显示：我已阅读并同意 《配送员入驻协议》</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
