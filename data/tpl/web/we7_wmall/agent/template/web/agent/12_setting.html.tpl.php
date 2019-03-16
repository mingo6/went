<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<h2>账号设置</h2>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">代理名称</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="title" value="<?php  echo $agent['title'];?>" class="form-control" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">真实姓名</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="realname" value="<?php  echo $agent['realname'];?>" class="form-control" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">手机号</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="mobile" value="<?php  echo $agent['mobile'];?>" class="form-control" required="true">
				<div class="help-block">手机号将作为后台登陆账号</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">密码</label>
			<div class="col-sm-9 col-xs-12">
				<input type="password" name="password" class="form-control" minlength="6">
				<div class="help-block">请填写密码，最小长度为 6 个字符。如果不更改密码此处请留空</div>
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
