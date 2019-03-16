<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'account') { ?>
<div class="page register">
	<header class="bar bar-nav common-bar-nav">
		<h1 class="title">商户入驻</h1>
	</header>
	<div class="content">
		<form action="" method="post" id="form-account">
			<input type="hidden" name="openid" value="<?php  echo $fans['openid'];?>"/>
			<input type="hidden" name="nickname" value="<?php  echo $fans['nickname'];?>"/>
			<input type="hidden" name="avatar" value="<?php  echo $fans['avatar'];?>"/>
			<div class="list-block">
				<ul class="border-1px-tb">
					<?php  if($config_store['settle']['mobile_verify_status'] == 1) { ?>
						<li>
							<div class="item-content verify-code">
								<div class="item-inner border-1px-b">
									<div class="item-title label">手机</div>
									<div class="item-input">
										<input type="text" name="mobile" placeholder="手机号">
									</div>
									<div class="item-button">
										<a class="button button-danger" href="javascript:;" id="btn-code">获取验证码</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title label">图形验证码</div>
									<div class="item-input">
										<input type="number" name="captcha" placeholder="请输入图形验证码">
									</div>
									<img src="<?php  echo imurl('system/common/captcha');?>" class="btn-captcha" data-href="<?php  echo imurl('system/common/captcha')?>&captcha=" />
								</div>
							</div>
						</li>
						<li>
							<div class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title label">手机验证码</div>
									<div class="item-input">
										<input type="text" name="code" placeholder="输入手机收到的验证码">
									</div>
								</div>
							</div>
						</li>
					<?php  } else { ?>
						<li>
							<div class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title label">手机</div>
									<div class="item-input">
										<input type="text" name="mobile" placeholder="手机号">
									</div>
								</div>
							</div>
						</li>
					<?php  } ?>
					<li>
						<div class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title label">密码</div>
								<div class="item-input">
									<input type="password" name="password" placeholder="8-20位密码">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title label">确认密码</div>
								<div class="item-input">
									<input type="password" name="repassword" placeholder="8-20位密码">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title label">姓名</div>
								<div class="item-input">
									<input type="text" name="title" placeholder="您的姓名">
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="content-padded color-danger">*手机号将作为登陆账号,请认真填写</div>
			<div class="content-padded">
				<a href="javascript:;" class="button button-fill button-big button-danger" id="btn-account">下一步</a>
			</div>
		</form>
	</div>
</div>
<?php  } ?>

<?php  if($ta == 'store') { ?>
<div class="page business-enter">
	<header class="bar bar-nav common-bar-nav">
		<h1 class="title">商户信息</h1>
	</header>
	<div class="content">
		<form action="" method="post" id="form-store">
			<div class="list-block">
				<ul>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">商户名称</div>
								<div class="item-input">
									<input type="text" name="title" placeholder="店铺名称">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">商户地址</div>
								<div class="item-input">
									<input type="text" name="address" placeholder="店铺详细地址">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">联系电话</div>
								<div class="item-input">
									<input type="text" name="telephone" placeholder="店铺负责人电话">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">商户简介</div>
								<div class="item-input">
									<textarea rows="3" name="content" placeholder="选填"></textarea>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<?php  if(!empty($config_store['settle']['agreement'])) { ?>
				<div class="content-padded text-right color-gray">
					我已阅读并同意 <a href="javascript:;" class="color-danger open-popup" data-popup=".popup-settle-agreement">《商户入驻协议》</a>
				</div>
			<?php  } ?>
			<div class="content-padded">
				<a href="javascript:;" class="button button-fill button-big button-danger" id="btn-store">提交</a>
			</div>
		</form>
	</div>
</div>
<div class="popup popup-settle-agreement">
	<div class="page">
		<header class="bar bar-nav common-bar-nav">
			<h1 class="title">入驻协议</h1>
			<button class="button button-link button-nav pull-right close-popup">关闭</button>
		</header>
		<div class="content" style="background: #FFF">
			<div class="content-padded">
				<?php  echo $config_store['settle']['agreement'];?>
			</div>
		</div>
	</div>
</div>
<?php  } ?>

<script>
require(['store'], function(store){
	store.initSettle({
		mobile_verify_status: "<?php  echo $config_store['settle']['mobile_verify_status'];?>"
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>