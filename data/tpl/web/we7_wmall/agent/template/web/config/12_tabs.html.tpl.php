<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">
	设置
</div>
<div class="nav slimscroll">
	<div class="menu-header">平台</div>
	<ul class="menu-item">
		<li <?php  if($_W['_router'] == 'config/mall/basic') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('config/mall/basic');?>">基础设置</a>
		</li>
	</ul>
	<div class="menu-header">商户</div>
	<ul class="menu-item">
		<li <?php  if($_W['_router'] == 'config/store/serve_fee') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('config/store/serve_fee');?>">服务费率</a>
		</li>
		<li <?php  if($_W['_router'] == 'config/store/delivery') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('config/store/delivery');?>">配送模式</a>
		</li>
		<li <?php  if($_W['_router'] == 'config/store/extra') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('config/store/extra');?>">其他批量操作</a>
		</li>
	</ul>
	<div class="menu-header">外卖</div>
	<ul class="menu-item">
		<li <?php  if($_W['_router'] == 'config/takeout/range') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('config/takeout/range');?>">服务范围</a>
		</li>
		<li <?php  if($_W['_router'] == 'config/takeout/order') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('config/takeout/order');?>">订单相关</a>
		</li>
<!--
		<li <?php  if($_W['_router'] == 'config/takeout/deliveryer') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('config/takeout/deliveryer');?>">配送员提成</a>
		</li>
-->
	</ul>
	<div class="menu-header">配送员</div>
	<ul class="menu-item">
		<li <?php  if($_W['_router'] == 'config/deliveryer/cash') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('config/deliveryer/cash');?>">提成及提现</a>
		</li>
	</ul>
</div>
