<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php  if(empty($_W['page']['title'])) { ?><?php  echo $_W['we7_wmall']['config']['mall']['title'];?><?php  } else { ?><?php  echo $_W['page']['title'];?><?php  } ?></title>
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" href="../addons/we7_wmall/static/js/components/light7/light7.min.css" />
	<link rel="stylesheet" href="../addons/we7_wmall/template/mobile/delivery/static/css/delivery.css" />
	<script type='text/javascript' src='../addons/we7_wmall/static/css/iconfont.js' charset='utf-8'></script>
	<link rel="stylesheet" href="../addons/we7_wmall/static/css/iconfont.css"/>
	<script type='text/javascript' src="<?php  echo WE7_WMALL_LOCAL?>static/js/components/jquery/jquery-2.2.1.min.js"></script>
	<script type='text/javascript' src="<?php  echo WE7_WMALL_LOCAL?>static/js/components/jquery/jquery.extend.js"></script>
	<?php  echo iregister_jssdk(false);?>
	<script type='text/javascript' src="<?php  echo WE7_WMALL_LOCAL?>static/js/require.js"></script>
	<script type='text/javascript' src="<?php  echo WE7_WMALL_LOCAL?>static/js/iconfig-app.js"></script>
	<script type='text/javascript'>
		$.config = {router: false};
		var we7_wmall = {prefix: "<?php  echo $_W['config']['cookie']['pre'];?>", pluginStaticRoot: "../addons/we7_wmall/plugin/<?php  echo $_W['_plugin']['name'];?>/static/js/"};
		require(['tiny'], function(tiny){tiny.init({siteUrl: "<?php  echo $_W['siteroot'];?>", baseUrl: "<?php  echo imurl('ROUTES')?>", uniacid: "<?php  echo $_W['uniacid'];?>"});});
	</script>
	<script type='text/javascript' src='../addons/we7_wmall/static/js/components/light7/light7.js' charset='utf-8'></script>
	<script type="text/javascript" src="../addons/we7_wmall/static/js/components/light7/light7-swiper.min.js"></script>
	<script type="text/javascript" src="../addons/we7_wmall/static/js/components/light7/i18n/cn.min.js"></script>
	<script type="text/javascript" src="../addons/we7_wmall/static/js/components/light7/common.js?t=1111"></script>
</head>
<body>


