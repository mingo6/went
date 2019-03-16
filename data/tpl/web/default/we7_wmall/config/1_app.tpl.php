<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'deliveryer') { ?>
<div class="page clearfix">
	<h2>配送员app设置 <small class="text-danger">(此功能需要购买配送员APP才能使用)</small></h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">app序列号</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="deliveryer[serial_sn]" value="<?php  echo $app['deliveryer']['serial_sn'];?>" class="form-control" required="true"/>
				<?php  if($_W['isfounder'] == 1) { ?><div class="help-block">请联系模块开发者获取</div><?php  } ?>
			</div>
		</div>
		<div class="form-group hide">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员APP版本号</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<div class="input-group-addon">版本号</div>
					<input type="text" name="deliveryer[version][android]" value="<?php  echo $app['deliveryer']['version']['android'];?>" class="form-control" required="true"/>
				</div>
				<div class="help-block">app版本号， 必须和最新apk的versionCode 一致，否则无法进行app更新。如果您不了解该配置，请勿修改.</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">IOS版本打包方式</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="0" name="deliveryer[ios_build_type]" id="deliveryer-ios-build-type-0" <?php  if(!$app['deliveryer']['ios_build_type']) { ?>checked<?php  } ?>>
					<label for="deliveryer-ios-build-type-0">官方统一打包</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="1" name="deliveryer[ios_build_type]" id="deliveryer-ios-build-type-1" <?php  if($app['deliveryer']['ios_build_type'] == 1) { ?>checked<?php  } ?>>
					<label for="deliveryer-ios-build-type-1">自定义打包</label>
				</div>
				<div class="help-block">
					如果您没有苹果开发者账号, 你可以选择"官方统一打包"方式。<br>
					如果您已经在苹果商店上架了官方给你打包的配送员app,请选择"自定义打包"
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">Android版本</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="deliveryer[android_version]" id="android-version-1" <?php  if(!$app['deliveryer']['android_version'] || $app['deliveryer']['android_version'] <= 1) { ?>checked<?php  } ?>>
					<label for="android-version-1">1.0</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="deliveryer[android_version]" id="android-version-2" <?php  if($app['deliveryer']['android_version'] == 2) { ?>checked<?php  } ?>>
					<label for="android-version-2">2.0</label>
				</div>
				<div class="help-block">
					注意:2017年9月20日之前生成的app,都是1.0版本。如果您的app是1.0版本,坚决不能选择2.0版本,否则会造成app推送订单不成功的问题。同理,如果您的版本是2.0,不能选择1.0
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">极光推送key</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="deliveryer[push_key]" value="<?php  echo $app['deliveryer']['push_key'];?>" class="form-control" required="true"/>
				<div class="help-block"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">极光推送Secret</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="deliveryer[push_secret]" value="<?php  echo $app['deliveryer']['push_secret'];?>" class="form-control" required="true"/>
				<div class="help-block"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员App下载地址</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static">安卓版本：<a href="<?php  echo $downurls['deliveryer']['android'];?>" target="_blank"><?php  echo $downurls['deliveryer']['android'];?></a></p>
				<p class="form-control-static hide">苹果版本：<a href="<?php  echo $downurls['deliveryer']['ios'];?>" target="_blank"><?php  echo $downurls['deliveryer']['ios'];?></a></p>
				<div class="help-block">下载之前,请确保已经将apk上传到服务器</div>
				<div class="panel panel-default panel-app-qrcode">
					<div class="panel-heading">安卓版本下载</div>
					<div class="panel-body">
						<div class="qrcode-block js-qrcode" data-text="<?php  echo $downurls['deliveryer']['android'];?>"></div>
					</div>
				</div>
				<div class="panel panel-default panel-app-qrcode hide">
					<div class="panel-heading">IOS版本下载</div>
					<div class="panel-body">
						<img width="180" src="<?php  echo $_W['siteroot'] .  'web/' . url('utility/wxcode/qrcode', array('text' => $downurls['deliveryer']['ios']));?>">
					</div>
				</div>
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

<?php  if($op == 'manager') { ?>
<div class="page clearfix config-notice-phonic">
	<h2>商家app设置 <small class="text-danger">(此功能需要购买商家APP才能使用)</small></h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">app序列号</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="manager[serial_sn]" value="<?php  echo $app['manager']['serial_sn'];?>" class="form-control" required="true"/>
				<?php  if($_W['isfounder'] == 1) { ?><div class="help-block">请联系模块开发者获取</div><?php  } ?>
			</div>
		</div>
		<div class="form-group hide">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商家APP版本号</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<div class="input-group-addon">版本号</div>
					<input type="text" name="manager[version][android]" value="<?php  echo $app['manager']['version']['android'];?>" class="form-control" required="true"/>
				</div>
				<div class="help-block">app版本号， 必须和最新apk的versionCode 一致，否则无法进行app更新。如果您不了解该配置，请勿修改.</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">IOS版本打包方式</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="0" name="manager[ios_build_type]" id="manager-ios-build-type-0" <?php  if(!$app['manager']['ios_build_type']) { ?>checked<?php  } ?>>
					<label for="manager-ios-build-type-0">官方统一打包</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="1" name="manager[ios_build_type]" id="manager-ios-build-type-1" <?php  if($app['manager']['ios_build_type'] == 1) { ?>checked<?php  } ?>>
					<label for="manager-ios-build-type-1">自定义打包</label>
				</div>
				<div class="help-block">
					如果您没有苹果开发者账号, 你可以选择"官方统一打包"方式。<br>
					如果您已经在苹果商店上架了官方给你打包的商家app,请选择"自定义打包"
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">极光推送key</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="manager[push_key]" value="<?php  echo $app['manager']['push_key'];?>" class="form-control" required="true"/>
				<div class="help-block"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">极光推送Secret</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="manager[push_secret]" value="<?php  echo $app['manager']['push_secret'];?>" class="form-control" required="true"/>
				<div class="help-block"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商家App下载地址</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static">安卓版本：<a href="<?php  echo $downurls['manager']['android'];?>" target="_blank"><?php  echo $downurls['manager']['android'];?></a></p>
				<p class="form-control-static hide">苹果版本：<a href="<?php  echo $downurls['manager']['ios'];?>" target="_blank"><?php  echo $downurls['manager']['ios'];?></a></p>
				<div class="help-block">
					下载之前,请确保已经将apk上传到服务器<br>
					<span class="text-danger">上传到服务器之前,请将app的文件名改成"manager.apk"</span>
				</div>
				<div class="panel panel-default panel-app-qrcode">
					<div class="panel-heading">安卓版本下载</div>
					<div class="panel-body">
						<div class="qrcode-block js-qrcode" data-text="<?php  echo $downurls['manager']['android'];?>"></div>
					</div>
				</div>
				<div class="panel panel-default panel-app-qrcode hide">
					<div class="panel-heading">IOS版本下载</div>
					<div class="panel-body">
						<img width="180" src="<?php  echo $_W['siteroot'] .  'web/' . url('utility/wxcode/qrcode', array('text' => $downurls['manager']['ios']));?>">
					</div>
				</div>
			</div>
		</div>
		<h2>语音提醒</h2>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">新订单提醒</label>
			<div class="col-sm-9 col-xs-12">
				<input type="file" name="new" value="<?php  echo $app['manager']['phonic']['new'];?>">
				<?php  if(!empty($app['manager']['phonic']['new'])) { ?>
					<div class="audio-container">
						<div class="audio-msg">
							<div class="icon audio-player-play" data-attach="<?php echo WE7_WMALL_URL;?><?php  echo $path;?><?php  echo $app['manager']['phonic']['new'];?>"><span><i class="fa fa-play"></i></span></div>
						</div>
					</div>
				<?php  } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">催单提醒</label>
			<div class="col-sm-9 col-xs-12">
				<input type="file" name="remind" value="<?php  echo $app['manager']['phonic']['remind'];?>">
				<?php  if(!empty($app['manager']['phonic']['remind'])) { ?>
					<div class="audio-container">
						<div class="audio-msg">
							<div class="icon audio-player-play" data-attach="<?php echo WE7_WMALL_URL;?><?php  echo $path;?><?php  echo $app['manager']['phonic']['remind'];?>"><span><i class="fa fa-play"></i></span></div>
						</div>
					</div>
				<?php  } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">退单提醒</label>
			<div class="col-sm-9 col-xs-12">
				<input type="file" name="refund" value="<?php  echo $app['manager']['phonic']['refund'];?>">
				<?php  if(!empty($app['manager']['phonic']['refund'])) { ?>
					<div class="audio-container">
						<div class="audio-msg">
							<div class="icon audio-player-play" data-attach="<?php echo WE7_WMALL_URL;?><?php  echo $path;?><?php  echo $app['manager']['phonic']['refund'];?>"><span><i class="fa fa-play"></i></span></div>
						</div>
					</div>
				<?php  } ?>
			</div>
		</div>
		<div class="form-group hide">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单完成提醒</label>
			<div class="col-sm-9 col-xs-12">
				<input type="file" name="end" value="<?php  echo $app['manager']['phonic']['end'];?>">
				<?php  if(!empty($app['manager']['phonic']['end'])) { ?>
					<div class="audio-container">
						<div class="audio-msg">
							<div class="icon audio-player-play" data-attach="<?php echo WE7_WMALL_URL;?><?php  echo $path;?><?php  echo $app['manager']['phonic']['end'];?>"><span><i class="fa fa-play"></i></span></div>
						</div>
					</div>
				<?php  } ?>
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
<script>
	require(['jquery.jplayer'], function(){
		$(".audio-player-play").click(function(){
			var src = $(this).data("attach");
			if(!src) {
				return;
			}
			if ($("#player")[0]) {
				var player = $("#player");
			} else {
				var player = $('<div id="player"></div>');
				$(document.body).append(player);
			}
			player.data('control', $(this));
			player.jPlayer({
				playing: function() {
					$(this).data('control').find("i").removeClass("fa-play").addClass("fa-stop");
				},
				pause: function (event) {
					$(this).data('control').find("i").removeClass("fa-stop").addClass("fa-play");
				},
				swfPath: "resource/components/jplayer",
				supplied: "mp3,wma,wav,amr",
				solution: "html, flash"
			});
			player.jPlayer("setMedia", {mp3: $(this).data("attach")}).jPlayer("play");
			if($(this).find("i").hasClass("fa-stop")) {
				player.jPlayer("stop");
			} else {
				$('.audio-msg').find('.fa-stop').removeClass("fa-stop").addClass("fa-play");
				player.jPlayer("setMedia", {mp3: $(this).data("attach")}).jPlayer("play");
			}
		});
	});
</script>
<?php  } ?>

<?php  if($op == 'customer') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#movement" aria-controls="movement" role="tab" data-toggle="pill">推送设置</a></li>
			<li role="presentation"><a href="#login" aria-controls="login" role="tab" data-toggle="pill">登录设置</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" role="tabpanel" id="movement">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">Appid</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="customer[appid]" value="<?php  echo $app['customer']['appid'];?>" class="form-control" required="true"/>
						<div class="help-block">去云打包后台获取</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">key</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="customer[key]" value="<?php  echo $app['customer']['key'];?>" class="form-control" required="true"/>
						<div class="help-block">去云打包后台获取</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" role="tabpanel" id="login">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">APP第三方登录</label>
					<div class="col-sm-9 col-xs-12">
						<div class="checkbox checkbox-inline">
							<input type="checkbox" value="1" name="qq" id="qq" <?php  if($app['customer']['login']['qq'] == 1) { ?>checked<?php  } ?>>
							<label for="qq">qq登录</label>
						</div>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" value="1" name="wx" id="wx" <?php  if($app['customer']['login']['wx'] == 1) { ?>checked<?php  } ?>>
							<label for="wx">微信登录</label>
						</div>
						<div class="help-block">勾选后请在APP后台开启相应支付插件并配置好参数</div>
					</div>
				</div>
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