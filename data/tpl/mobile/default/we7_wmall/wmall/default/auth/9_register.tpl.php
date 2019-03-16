<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page page-auth">
	<div class="content">
		<div class="header">
			<div class="logo">
				<img src="<?php  echo tomedia($config_mall['logo']);?>" alt=""/>
			</div>
			<div class="name"><?php  echo $config_mall['title'];?></div>
		</div>
		<div class="list-block">
			<ul>
				<li>
					<div class="item-content">
						<div class="item-media"><i class="icon icon-phone1"></i></div>
						<div class="item-inner border-1px-b">
							<div class="item-input">
								<input type="number" max="11" name="mobile" placeholder="请输入手机号">
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-media"><i class="icon icon-code"></i></div>
						<div class="item-inner border-1px-b">
							<div class="item-input">
								<input type="number" name="captcha" placeholder="请输入图形验证码">
							</div>
							<img src="<?php  echo imurl('system/common/captcha');?>" class="btn-captcha" data-href="<?php  echo imurl('system/common/captcha')?>&captcha=" />
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-media"><i class="icon icon-email"></i></div>
						<div class="item-inner border-1px-b">
							<div class="item-input">
								<input type="number" max="6" name="code" placeholder="请输入6位短信验证码">
							</div>
							<a class="item-remark button-code" href="javascript:;">
								获取验证码<i class="icon icon-arrow-right"></i>
							</a>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-media"><i class="icon icon-lock"></i></div>
						<div class="item-inner border-1px-b">
							<div class="item-input">
								<input type="password" name="password" placeholder="请输入密码">
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content border-1px-b">
						<div class="item-media"><i class="icon icon-lock"></i></div>
						<div class="item-inner">
							<div class="item-input">
								<input type="password" name="repassword" placeholder="请重复输入密码">
							</div>
						</div>
					</div>
				</li>
			</ul>
			<div class="content-padded">
				<a href="javascript:;" class="button button-big button-fill button-round button-danger button-register">立即注册</a>
			</div>
		</div>
		<div class="text">
			<p>已有账号？<a href="<?php  echo imurl('wmall/auth/login');?>">立即登陆</a></p>
		</div>
	</div>
</div>
<script>
require(['auth'], function(auth){
	auth.initRegister();
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>