<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">
	财务管理
</div>
<div class="nav slimscroll">
	<div class="menu-header">订单</div>
	<ul class="menu-item">
		<li <?php  if($_W['_action'] == 'order') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('finance/order/log');?>">交易记录</a>
		</li>
	</ul>
	<div class="menu-header">提现</div>
	<ul class="menu-item">
		<li <?php  if($_W['_action'] == 'getcash' && $_W['_op'] == 'index') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('finance/getcash/index');?>">余额提现</a>
		</li>
		<li <?php  if($_W['_action'] == 'getcash' && $_W['_op'] == 'account') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('finance/getcash/account');?>">提现账户</a>
		</li>
		<li  <?php  if($_W['_action'] == 'getcash' && $_W['_op'] == 'log') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('finance/getcash/log');?>">提现记录</a>
		</li>
	</ul>
	<div class="menu-header">账户</div>
	<ul class="menu-item">
		<li <?php  if($_W['_action'] == 'account' &&  $_W['_op'] == 'log') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('finance/account/log');?>">账户明细</a>
		</li>
	</ul>
</div>
