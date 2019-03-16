<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title"><?php  echo $_W['_plugin']['title'];?></div>
<div class="nav slimscroll">
	<div class="menu-header">代理</div>
	<ul class="menu-item">
		<li <?php  if($_GPC['ac'] == 'agent') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('agent/agent')?>">代理列表</a>
		</li>
		<li <?php  if($_GPC['ac'] == 'initialize') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('agent/initialize')?>">数据初始化</a>
		</li>
	</ul>
	<div class="menu-header">财务</div>
	<ul class="menu-item">
		<li <?php  if($_GPC['ac'] == 'getcash') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('agent/getcash')?>">提现申请</a>
		</li>
		<li <?php  if($_GPC['ac'] == 'current') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('agent/current')?>">账户明细</a>
		</li>
	</ul>
	<div class="menu-header">设置</div>
	<ul class="menu-item">
		<li <?php  if($_GPC['ac'] == 'config' && $_GPC['op'] == 'basic') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('agent/config/basic')?>">基础设置</a>
		</li>
		<li <?php  if($_GPC['ac'] == 'config' && $_GPC['op'] == 'serve_fee') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('agent/config/serve_fee')?>">服务费率</a>
		</li>
		<li <?php  if($_GPC['ac'] == 'cover') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('agent/cover')?>">代理入口</a>
		</li>
	</ul>
</div>
