<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('common/header-base', TEMPLATE_INCLUDEPATH));?>
<div data-skin="default" class="skin-default <?php  if($_GPC['main-lg']) { ?> main-lg-body <?php  } ?>">
<?php  $frames = buildframes(FRAME);_calc_current_frames($frames);?>
<div class="head">
	<nav class="navbar-default" role="navigation">
		<div style="width:1200px;position: relative;text-align: center;margin: 0 auto;" class="mycontainer  <?php  if(!empty($frames['section']['platform_module_menu']['plugin_menu'])) { ?>plugin-head<?php  } ?>">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php  echo $_W['siteroot'];?>">
					<img src="<?php  if(!empty($_W['setting']['copyright']['blogo'])) { ?><?php  echo tomedia($_W['setting']['copyright']['blogo'])?><?php  } else { ?>./resource/images/logo/logo.png<?php  } ?>" class="pull-left" width="110px" height="35px">
					<span class="version hidden"><?php echo IMS_VERSION;?></span>
				</a>
			</div>
			<?php  if(!empty($_W['uid'])) { ?>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-left">
					<?php  global $top_nav?>
					<?php  if(is_array($top_nav)) { foreach($top_nav as $nav) { ?>
					<li<?php  if(FRAME == $nav['name']) { ?> class="active"<?php  } ?>><a href="<?php  if(empty($nav['url'])) { ?><?php  echo url('home/welcome/' . $nav['name']);?><?php  } else { ?><?php  echo $nav['url'];?><?php  } ?>" <?php  if(!empty($nav['blank'])) { ?>target="_blank"<?php  } ?>><?php  echo $nav['title'];?></a></li>
					<?php  } } ?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="wi wi-user color-gray"></i><?php  echo $_W['user']['username'];?> <span class="caret"></span></a>
						<ul class="dropdown-menu color-gray" role="menu">
							<li>
								<a href="<?php  echo url('user/profile');?>" target="_blank"><i class="wi wi-account color-gray"></i> 我的账号</a>
							</li>
							<?php  if($_W['isfounder']) { ?>
							<li class="divider"></li>
							<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
							<li><a href="<?php  echo url('cloud/upgrade');?>" target="_blank"><i class="wi wi-update color-gray"></i> 自动更新</a></li>
							<?php  } ?>
							<li><a href="<?php  echo url('system/updatecache');?>" target="_blank"><i class="wi wi-cache color-gray"></i> 更新缓存</a></li>
							<li class="divider"></li>
							<?php  } ?>
							<li>
								<a href="<?php  echo url('user/logout');?>"><i class="fa fa-sign-out color-gray"></i> 退出系统</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<?php  } else { ?>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown"><a href="<?php  echo url('user/register');?>">注册</a></li>
					<li class="dropdown"><a href="<?php  echo url('user/login');?>">登录</a></li>
				</ul>
			</div>
			<?php  } ?>
		</div>
	</nav>
</div>
<?php  if(empty($_COOKIE['check_setmeal']) && !empty($_W['account']['endtime']) && ($_W['account']['endtime'] - TIMESTAMP < (6*86400))) { ?>
<div class="system-tips we7-body-alert" id="setmeal-tips">
	<div class="container text-right">
		<div class="alert-info">
			<a href="<?php  if($_W['isfounder']) { ?><?php  echo url('user/edit', array('uid' => $_W['account']['uid']));?><?php  } else { ?>javascript:void(0);<?php  } ?>">
				该公众号管理员服务有效期：<?php  echo date('Y-m-d', $_W['account']['starttime']);?> ~ <?php  echo date('Y-m-d', $_W['account']['endtime']);?>.
				<?php  if($_W['account']['endtime'] < TIMESTAMP) { ?>
				目前已到期，请联系管理员续费
				<?php  } else { ?>
				将在<?php  echo floor(($_W['account']['endtime'] - strtotime(date('Y-m-d')))/86400);?>天后到期，请及时付费
				<?php  } ?>
			</a>
			<span class="tips-close" onclick="check_setmeal_hide();"><i class="wi wi-error-sign"></i></span>
		</div>
	</div>
</div>
<script>
	function check_setmeal_hide() {
		util.cookie.set('check_setmeal', 1, 1800);
		$('#setmeal-tips').hide();
		return false;
	}
</script>
<?php  } ?> 

<link rel="stylesheet" type="text/css" href="<?php  echo MODULE_URL?>template/web/css/common.css<?php echo '?t='.TIMESTAMP?>">
<link rel="stylesheet" type="text/css" href="<?php  echo MODULE_URL?>template/web/css/tao.css<?php echo '?t='.TIMESTAMP?>">
<link rel="stylesheet" href="<?php  echo MODULE_URL?>template/web/css/jquery-ui.css">
<script src="<?php  echo MODULE_URL?>template/web/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php  echo MODULE_URL?>template/web/js/tao.js<?php echo '?t='.TIMESTAMP?>"></script>

	<?php  $leftmenu = Data::webMenu()?>

 	<div id="body" class="body page_message"> 
   		<div id="js_container_box" class="container_box cell_layout side_l">
	    	<div class="col_side"> 
	    		 <div class="menu_box" id="menuBar">
				    <?php  if(is_array($leftmenu)) { foreach($leftmenu as $k => $item) { ?>
				    	<?php  if($item['hide'] == 0 && !empty( $item )) { ?>
					    <dl class="menu">
					     	<dt class="menu_title clickable">
					     		<a href="<?php echo empty($item['url']) ? 'javascript:;' : $item['url']?>">
					      			<i class="icon_menu" style="background:url(<?php  echo $item['icon'];?>) no-repeat;"> </i><?php  echo $item['name'];?> 
					      		</a>
					     	</dt>
					     	<?php  if(is_array($item['list'])) { foreach($item['list'] as $kk => $vv) { ?>
					     		<?php  if($vv['hide'] == 0) { ?>
							    <dd class="menu_item <?php  if(($_GPC['do'] == $k && $_GPC['op'] == $vv['op']) || $_GPC['c'] == 'module' && $vv['op'] == 'set' ) { ?>selected<?php  } ?>">
							      	<a href="<?php  echo $vv['url'];?>" class="left_title_box"><?php  echo $vv['name'];?> <?php  if(isset($vv['num'])) { ?><i><?php  echo $vv['num'];?></i><?php  } ?></a>
							    </dd>
							    <?php  } ?>
							<?php  } } ?>
					    </dl>
					    <?php  } ?>
				    <?php  } } ?>
	     		</div>
	    	</div>
	    	<div class="col_main">
	    		<?php  if(is_array($leftmenu)) { foreach($leftmenu as $k => $item) { ?>
	    			<?php  if($_GPC['do'] == $k) { ?>
						<div class="main_hd">
							<h2><?php  echo $item['name'];?></h2>
							<div class="title_tab" id="topTab">
								<ul class="tab_navs title_tab">
									<?php  if(is_array($item['list'])) { foreach($item['list'] as $kk => $vv) { ?>
										
										<?php  if($vv['hide'] != 1 || ($_GPC['op'] == $vv['op'] && $vv['hide'] == 1 )) { ?>
										<li class="tab_nav first js_top <?php  if($_GPC['op'] == $vv['op']) { ?>selected<?php  } ?>">
										<?php  if(in_array( $_GPC['op'],(array)$item['toplist'] )) { ?>
											<a class="left_title_box top_title_box" href="<?php  echo $vv['url'];?>"><?php  echo $vv['name'];?> <?php  if(isset($vv['num'])) { ?><i><?php  echo $vv['num'];?></i><?php  } ?> </a>
										<?php  } ?>
										</li>
										<?php  } ?>
									<?php  } } ?>
								</ul>
							</div>
						</div>
					<?php  } ?>
				<?php  } } ?>
				
				<div class="main_bd">