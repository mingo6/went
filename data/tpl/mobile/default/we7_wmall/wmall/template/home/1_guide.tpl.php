<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php  if(empty($_W['page']['title'])) { ?><?php  echo $_W['we7_wmall']['config']['title'];?><?php  } else { ?><?php  echo $_W['page']['title'];?><?php  } ?></title>
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<script type='text/javascript' src="<?php  echo WE7_WMALL_LOCAL?>static/js/components/jquery/jquery-2.2.1.min.js"></script>
	<script type='text/javascript' src="<?php  echo WE7_WMALL_LOCAL?>static/js/components/jquery/jquery.extend.js"></script>
	<script type='text/javascript' src="<?php  echo $_W['siteroot'];?>app/resource/js/require.js"></script>
	<script type='text/javascript' src="<?php  echo WE7_WMALL_LOCAL?>static/js/iconfig-app.js"></script>
	<script type='text/javascript'>
		$.config = {router: false};
		var we7_wmall = {prefix: "<?php  echo $_W['config']['cookie']['pre'];?>"};
		require(['tiny'], function(tiny){tiny.init({siteUrl: "<?php  echo $_W['siteroot'];?>", baseUrl: "<?php  echo imurl('ROUTES')?>"});});
	</script>
	<style>
		#time a{position: absolute; z-index: 10; top: 50px; right: 25px; height:30px; line-height: 30px; padding: 0 10px; background:#F5F5F5; color:#333; text-decoration: none; border:0; border-radius:5px;filter:alpha(opacity=40);-moz-opacity:0.4;-khtml-opacity: 0.4;opacity: 0.4;}
		#time span{font-weight: bold;}
	</style>
</head>
<body>
	<div id="time"><a href="<?php  echo $url;?>"><span>3</span> 跳过</a></div>
	<div class="main">
		<?php  if(!empty($slides)) { ?>
			<?php  if(is_array($slides)) { foreach($slides as $slide) { ?>
				<section class="section" onclick="window.location.href='<?php  echo $slide['link'];?>'" style="background: url(<?php  echo tomedia($slide['thumb']);?>); background-size: 100% 100%; background-repeat: no-repeat;">
					<div class="page_container">
					</div>
				</section>
			<?php  } } ?>
		<?php  } ?>
	</div>
</body>
</html>
<script type="text/javascript">
require(['guide'], function(guide){
	guide.init("<?php  echo $url;?>");
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>