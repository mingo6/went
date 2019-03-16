<?php defined('IN_IA') or exit('Access Denied');?><?php  $copyright = m('common')->getCopyright(true)?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php  if(!empty($copyright) && !empty($copyright['title'])) { ?><?php  echo $copyright['title'];?><?php  } ?></title>
        <meta name="keywords" content="<?php  if(empty($_W['page']['copyright']['keywords'])) { ?><?php  if(IMS_FAMILY != 'x') { ?>勤瀚堂,微信,微信公众平台,we7.cc<?php  } ?><?php  } else { ?><?php  echo $_W['page']['copyright']['keywords'];?><?php  } ?>" />
        <meta name="description" content="<?php  if(empty($_W['page']['copyright']['description'])) { ?><?php  if(IMS_FAMILY != 'x') { ?>公众平台自助引擎（www.qinhantangtop.com），简称勤瀚堂，勤瀚堂是一款免费开源的微信公众平台管理系统，是国内最完善移动网站及移动互联网技术解决方案。<?php  } ?><?php  } else { ?><?php  echo $_W['page']['copyright']['description'];?><?php  } ?>" />
        <link rel="shortcut icon" href="<?php  if(!empty($_W['setting']['copyright']['icon'])) { ?><?php  echo $_W['attachurl'];?><?php  echo $_W['setting']['copyright']['icon'];?><?php  } else { ?>./resource/images/favicon.ico<?php  } ?>" />
        <link href="./resource/css/bootstrap.min.css?v=20180203" rel="stylesheet">
        <link href="./resource/css/common.css?v=20180203" rel="stylesheet">
        <script>
            window.sysinfo = {
            <?php  if(!empty($_W['uniacid'])) { ?>'uniacid': '<?php  echo $_W['uniacid'];?>',<?php  } ?>
            <?php  if(!empty($_W['acid'])) { ?>'acid': '<?php  echo $_W['acid'];?>',<?php  } ?>
            <?php  if(!empty($_W['openid'])) { ?>'openid': '<?php  echo $_W['openid'];?>',<?php  } ?>
            <?php  if(!empty($_W['uid'])) { ?>'uid': '<?php  echo $_W['uid'];?>',<?php  } ?>
            'isfounder': <?php  if(!empty($_W['isfounder'])) { ?>1<?php  } else { ?>0<?php  } ?>,
            'siteroot': '<?php  echo $_W['siteroot'];?>',
                'siteurl': '<?php  echo $_W['siteurl'];?>',
                'attachurl': '<?php  echo $_W['attachurl'];?>',
                'attachurl_local': '<?php  echo $_W['attachurl_local'];?>',
                'attachurl_remote': '<?php  echo $_W['attachurl_remote'];?>',
                'module' : {'url' : '<?php  if(defined('MODULE_URL')) { ?><?php echo MODULE_URL;?><?php  } ?>', 'name' : '<?php  if(defined('IN_MODULE')) { ?><?php echo IN_MODULE;?><?php  } ?>'},
            'cookie' : {'pre': '<?php  echo $_W['config']['cookie']['pre'];?>'},
            'account' : <?php  echo json_encode($_W['account'])?>,
            'server' : {'php' : '<?php  echo phpversion()?>'},
            };
        </script>

        <script>
            var require = { urlArgs: 'v=20180322' };
        </script>
        <script type="text/javascript" src="./resource/js/lib/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="./resource/js/lib/bootstrap.min.js"></script>
        <script type="text/javascript" src="./resource/js/app/util.js?v=20180322"></script>
        <script type="text/javascript" src="./resource/js/app/common.min.js?v=20180322"></script>
        <script type="text/javascript" src="./resource/js/require.js?v=20180322"></script>
        <script src="<?php  echo EWEI_SHOPV2_LOCAL?>static/js/dist/jquery/jquery.gcjs.js"></script>
        <script src="<?php  echo EWEI_SHOPV2_LOCAL?>static/js/myconfig.js?2017515"></script>

        <!--<link href="<?php  echo EWEI_SHOPV2_LOCAL?>static/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">-->
        <link href="<?php  echo EWEI_SHOPV2_LOCAL?>static/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
        <link href="<?php  echo EWEI_SHOPV2_LOCAL?>static/css/animate.css" rel="stylesheet">
        <link href="<?php  echo EWEI_SHOPV2_LOCAL?>static/css/v2.css?v=4.1.0" rel="stylesheet">
        <link href="<?php  echo EWEI_SHOPV2_LOCAL?>static/css/common.css?v=2.0.0" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php  echo EWEI_SHOPV2_LOCAL?>static/fonts/iconfont.css?v=20170503">
        <script>
            require.config({
                waitSeconds: 0
            });
        </script>
        <script src="./resource/js/app/config.js"></script>
        <script type="text/javascript">
                if (navigator.appName == 'Microsoft Internet Explorer') {
                    if (navigator.userAgent.indexOf("MSIE 5.0") > 0 || navigator.userAgent.indexOf("MSIE 6.0") > 0 || navigator.userAgent.indexOf("MSIE 7.0") > 0) {
                        alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
                    }
                }
                myrequire.path = "<?php  echo $_W['siteroot'];?>addons/ewei_shopv2/static/js/";
                myrequire.systemVersion = '<?php  echo IMS_VERSION?>';
            function preview_html(txt)
            {
                var win = window.open("", "win", "width=300,height=600"); // a window object
                win.document.open("text/html", "replace");
                win.document.write($(txt).val());
                win.document.close();
            }
        </script>

    </head>


    <body class="white-bg ">
        <div id='topbar' class='top-navigation   gray-bg '>
            <nav class="navbar   gray-bg " role="navigation" style="width:1024px;margin:auto;">
                <div class="navbar-header" style="width:200px;">
                    <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <i class="fa fa-reorder"></i>
                    </button>
		    <?php  if(!empty($copyright) && !empty($copyright['logo'])) { ?>
		    <a style='padding:0;overflow:hidden;'><img src="<?php  echo tomedia($copyright['logo'])?>" style='width:150px;height:50px;' /></a>
		    <?php  } else { ?>
		    <a class="navbar-brand" href="<?php  echo webUrl()?>">LOGO</a>
		    <?php  } ?>
		</div>