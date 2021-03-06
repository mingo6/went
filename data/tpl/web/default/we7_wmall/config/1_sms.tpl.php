<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'set') { ?>
<div class="page clearfix">
	<h2><?php  echo $_W['page']['title'];?></h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="alert alert-warning" style="display: none;">短信使用"阿里云"短信平台"。<a href="https://www.aliyun.com/product/sms?spm=5176.8142029.388261.400.e9396d3eYxsqzP" target="_blank">立即申请</a></div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">开启短信功能</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="status" id="status-1" <?php  if($sms['status'] == 1) { ?>checked<?php  } ?> required="true">
					<label for="status-1">开启</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="status" id="status-0" <?php  if(!$sms['status']) { ?>checked<?php  } ?> required="true">
					<label for="status-0">关闭</label>
				</div>
				<div class="help-block">开启短信功能后,所有门店都可以使用该短信设置.</div>
			</div>
		</div>
		<div class="form-group" style="display: none;">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">接口类型</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="version" id="version-1" <?php  if($sms['version'] == 1 || empty($sms['version'])) { ?>checked<?php  } ?>>
					<label for="version-1">旧版</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="version" id="version-2" <?php  if($sms['version'] == 2) { ?>checked<?php  } ?>>
					<label for="version-2">新版(2017年6月之后申请的)</label>
				</div>
				<span class="help-block">由于阿里大于接口调整，需要根据申请时间来区分支付接口</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">AppKey</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="key" value="<?php  echo $sms['key'];?>">
				<!--<span class="help-block">还没有短信账号? <a href="http://www.alidayu.com/service?spm=a3142.7816148.1.2.4hG4Zd#about" target="_blank">现在去创建</a>。 如果是新版接口，此处填写：Access Key ID</span>-->
				<span class="help-block">填写创蓝短信的账号</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">AppSecret</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="secret" value="<?php  echo $sms['secret'];?>">
				<!--<span class="help-block">如果是新版接口，此处填写：Access Key Secret</span>-->
				<span class="help-block">密码</span>
			</div>
		</div>
		<div class="form-group" style="display: none;">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">短信签名</label>
			<div class="col-sm-9 col-xs-12">
				<!--<input type="text" class="form-control" name="sign" value="<?php  echo $sms['sign'];?>">-->
				<input type="text" class="form-control" name="sign" value="0">
				<span class="help-block">请填写短信签名.</span>
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
<?php  } ?>

<?php  if($op == 'template') { ?>
<div class="page clearfix">
	<h2><?php  echo $_W['page']['title'];?></h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">身份验证验证码 模板id</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="verify_code_tpl" value="<?php  echo $sms['verify_code_tpl'];?>" required="true">
				<span class="help-block">请登录"阿里大鱼"短信平台,进入管理中心,进行验证码模板申请</span>
				<span class="help-block">
					<strong class="text-danger">
						模板名称: 通用验证码<br>
						模板详情: 验证码${code},您正在使用***平台（注意：这里改成你自己的平台）,需要进行验证,15分钟内有效,打死也不能告诉别人哦
					</strong>
				</span>
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
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
