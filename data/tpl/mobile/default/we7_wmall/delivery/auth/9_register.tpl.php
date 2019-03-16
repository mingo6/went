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
						<div class="item-media"><i class="icon icon-people"></i></div>
						<div class="item-inner border-1px-b">
							<div class="item-input">
								<select class="form-control" name="type">
									<?php  if(is_array($type)) { foreach($type as $category) { ?>
									<option value="<?php  echo $category['value'];?>" <?php  if($category['value'] == $item['type']) { ?>selected<?php  } ?>><?php  echo $category['deliveryer_name'];?></option>
									<?php  } } ?>
								</select>
								<!--<input type="radio" name="type" id="type-1" value="buy" checked>-->
								<!--<label for="type-1">家政服务员</label>-->
								<!--<input type="radio" name="type" id="type-2" value="delivery">-->
								<!--<label for="type-2">家电维修员</label>-->
								<!--<input type="radio" name="type" id="type-3" value="pickup">-->
								<!--<label for="type-3">废品回收员</label>-->
								<!--<input type="radio" name="type" id="type-4" value="errand">-->
								<!--<label for="type-4">社区跑腿员</label>-->
							</div>
						</div>
					</div>
				</li>

				<li>
					<div class="item-content">
						<div class="item-media"><i class="icon icon-phone1"></i></div>
						<div class="item-inner border-1px-b">
							<div class="item-input">
								<input type="hidden" name="openid" value="<?php  echo $fans['openid'];?>"/>
								<input type="hidden" name="nickname" value="<?php  echo $fans['nickname'];?>"/>
								<input type="hidden" name="avatar" value="<?php  echo $fans['avatar'];?>"/>
								<input type="number" max="11" name="mobile" placeholder="请输入手机号">
							</div>
						</div>
					</div>
				</li>
				<?php  if($config_deliveryer['settle']['mobile_verify_status'] == 1) { ?>
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
				<?php  } ?>
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
					<div class="item-content">
						<div class="item-media"><i class="icon icon-lock"></i></div>
						<div class="item-inner border-1px-b">
							<div class="item-input">
								<input type="password" name="repassword" placeholder="请重复输入密码">
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-media"><i class="icon icon-people"></i></div>
						<div class="item-inner border-1px-b">
							<div class="item-input">
								<input type="text" name="title" placeholder="真实姓名将作为提现验证身份重要依据">
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content">
						<div class="item-media"><i class="icon icon-favor"></i></div>
						<div class="item-inner border-1px-b">
							<div class="item-input">
								<input type="text" name="sex" placeholder="性别">
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-content border-1px-b">
						<div class="item-media"><i class="icon icon-favor"></i></div>
						<div class="item-inner">
							<div class="item-input">
								<input type="number" name="age" placeholder="年龄">
							</div>
						</div>
					</div>
				</li>
				<?php  if($config_deliveryer['settle']['idCard'] == 1) { ?>
					<li>
						<div class="item-content border-1px-b">
							<div class="item-media"><i class="icon icon-camera"></i></div>
							<div class="item-inner">
								<div class="reminder ">
									上传手持身份证照片
								</div>
							</div>
						</div>
						<div class="item-picture">
							<div class="pic-l">
								<div class="pic-t">参考照片</div>
								<div class="pic-b">
									<img src="<?php echo WE7_WMALL_TPL_URL;?>/static/img/id-card-1.png" alt="">
								</div>
							</div>
							<div class="pic-r">
								<div class="pic-t">你的照片</div>
								<div class="pic-b pic-upload">
									<input type="hidden" name="idCard1" value=""/>
									<input type="file" accept="image*/" multiple="false" @change="upload">
									<img src="<?php echo WE7_WMALL_TPL_URL;?>/static/img/add_pic.png" alt="" style="pointer-events: none;">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content border-1px-b">
							<div class="item-media"><i class="icon icon-camera"></i></div>
							<div class="item-inner">
								<div class="reminder ">
									上传身份证正面照片
								</div>
							</div>
						</div>
						<div class="item-picture">
							<div class="pic-l">
								<div class="pic-t">参考照片</div>
								<div class="pic-b">
									<img src="<?php echo WE7_WMALL_TPL_URL;?>/static/img/id-card-2.png" alt="">
								</div>
							</div>
							<div class="pic-r">
								<div class="pic-t">你的照片</div>
								<div class="pic-b pic-upload">
									<input type="hidden" name="idCard2" value=""/>
									<input type="file" accept="image*/" multiple="false" @change="upload">
									<img src="<?php echo WE7_WMALL_TPL_URL;?>/static/img/add_pic.png" alt="" style="pointer-events: none;">
								</div>
							</div>
						</div>
					</li>
				<?php  } ?>
			</ul>
			<div class="agreement">
				我已阅读并同意 <a href="javascript:;" class="color-danger open-popup" data-popup=".popup-dy-agreement">《配送员入驻协议》</a>
			</div>
			<div class="content-padded">
				<a href="javascript:;" class="button button-big button-fill button-round button-success button-register">立即注册</a>
			</div>
		</div>
		<div class="text">
			<p>已有账号？<a href="<?php  echo imurl('delivery/auth/login');?>">立即登陆</a></p>
		</div>
	</div>
</div>
<div class="popup popup-dy-agreement">
	<div class="page">
		<header class="bar bar-nav common-bar-nav">
			<a class="icon icon icon-arrow-left pull-left close-popup" href="javascript:;"></a>
			<h1 class="title">入驻协议</h1>
		</header>
		<div class="content" style="background: #FFF">
			<div class="content-padded">
				<?php  echo $agreement_delivery;?>
			</div>
		</div>
	</div>
</div>
<script>
require(['tiny'], function(tiny){
	var mobile_verify_status = "<?php  echo $config_delivery['settle']['mobile_verify_status'];?>";
	var idCard = "<?php  echo $config_delivery['settle']['idCard'];?>";
	$('.button-code').click(function(){
		var $this = $(this);
		if($(this).hasClass('disabled')) {
			return false;
		}
		var mobile = $.trim($('input[name="mobile"]').val());
		if(!mobile) {
			$.toast('请输入手机号');
			return false;
		}
		var reg = /^[01][3456789][0-9]{9}/;
		if(!reg.test(mobile)) {
			$.toast('手机号格式错误');
			return false;
		}
		var captcha = $.trim($('input[name="captcha"]').val());
		if(!captcha) {
			$.toast('请输入图形验证码');
			return false;
		}
		$.post(tiny.getUrl('system/common/code'), {mobile: mobile, product: '注册配送员', captcha: captcha}, function(data){
			if(data != 'success') {
				$.toast(data);
			} else {
				$this.addClass("disabled");
				var downcount = 60;
				$this.html(downcount + "秒后重新获取");
				var timer = setInterval(function(){
					downcount--;
					if(downcount <= 0){
						clearInterval(timer);
						$this.html("获取验证码");
						$this.removeClass("disabled");
						downcount = 60;
					} else {
						$this.html(downcount + "秒后重新获取");
					}
				}, 1000);
				$.toast('验证码发送成功, 请注意查收');
			}
		});
		return false;
	});

	$('.pic-upload input[type="file"]').remove();
	$('.pic-upload').off('click').on('click', function(){
		var obj = $(this);
		tiny.image(obj[0], function(obj, data){
			var img_value = data.message ? data.message : data.attachment;
			obj.find("img").attr("src", data.url);
			obj.find("input").val(img_value);
		});
	});

	$('.button-register').click(function(){
		var $this = $(this);
		if($(this).hasClass('disabled')) {
			return false;
		}
		var openid = $.trim($(':hidden[name="openid"]').val());
		if(!openid && 0) {
			$.toast("获取微信信息错误");
			return false;
		}
		var mobile = $.trim($('input[name="mobile"]').val());
		if(!mobile) {
			$.toast('请输入手机号');
			return false;
		}
		var reg = /^[01][3456789][0-9]{9}/;
		if(!reg.test(mobile)) {
			$.toast('手机号格式错误');
			return false;
		}
		var code = '';
		if(mobile_verify_status == 1) {
			code = $.trim($('input[name="code"]').val());
			if(!code) {
				$.toast("验证码不能为空");
				return false;
			}
		}
		var password = $.trim($('input[name="password"]').val());
		if(!password) {
			$.toast('请输入密码');
			return false;
		} else {
			var length = password.length;
			if(length < 8 || length > 20) {
				$.toast("请输入8-20位密码");
				return false;
			}
			var reg = /[0-9]+[a-zA-Z]+[0-9a-zA-Z]*|[a-zA-Z]+[0-9]+[0-9a-zA-Z]*/;
			if(!reg.test(password)) {
				$.toast("密码必须由数字和字母组合");
				return false;
			}
		}
		var repassword = $.trim($('input[name="repassword"]').val());
		if(!repassword) {
			$.toast('请重复输入密码');
			return false;
		}
		if(password != repassword) {
			$.toast('两次密码输入不一致');
			return false;
		}
		var title = $.trim($(':text[name="title"]').val());
		if(!title) {
			$.toast('真实姓名不能为空');
			return false;
		}
		var sex = $.trim($(':text[name="sex"]').val());
		if(!sex || (sex != '男' && sex != '女')) {
			$.toast('性别有误');
			return false;
		}
		var age = parseInt($.trim($('input[name="age"]').val()));
		if(isNaN(age)) {
			$.toast('年龄不合法');
			return false;
		}
		if(idCard == 1) {
			var idCardOne = $.trim($(':input[name="idCard1"]').val());
			if(!idCardOne) {
				$.toast('手持身份证照片不能为空');
				return false;
			}
			var idCardTwo = $.trim($(':input[name="idCard2"]').val());
			if(!idCardTwo) {
				$.toast('身份证正面照片不能为空');
				return false;
			}
		}

		var params = {
			password: password,
			mobile: mobile,
			code: code,
			title: title,
			openid: openid,
			nickname: $.trim($(':hidden[name="nickname"]').val()),
			avatar: $.trim($(':hidden[name="avatar"]').val()),
			sex: sex,
			age: age,
			idCardOne: idCardOne,
			idCardTwo: idCardTwo,
			type:$('input[name="type"]:checked').val()
		}
		$this.addClass("disabled");
		$.post(tiny.getUrl('delivery/auth/register'), params, function(data){
			var result = $.parseJSON(data);
			if(!result.message.errno) {
				$.toast('注册成功', result.message.message);
			} else {
				$.toast(result.message.message);
				$this.removeClass("disabled");
			}
		});
		return false;
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>