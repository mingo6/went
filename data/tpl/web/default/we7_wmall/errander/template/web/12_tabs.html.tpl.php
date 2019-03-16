<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title"><?php  echo $_W['_plugin']['title'];?></div>
<div class="nav slimscroll">
	<?php  if(check_perm('errander.order')) { ?>
		<div class="menu-header">订单</div>
		<ul class="menu-item">
			<li <?php  if($_GPC['filter_type'] == 'process') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('errander/order/list', array('filter_type' => 'process'));?>">未完成</a>
			</li>
			<li <?php  if($_GPC['filter_type'] == 'refund_status') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('errander/order/list', array('refund_status' => 1, 'filter_type' => 'refund_status'));?>">退款单</a>
			</li>
			<li <?php  if($_GPC['filter_type'] == 'all') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('errander/order/list', array('filter_type' => 'all'));?>">所有订单</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('errander.statcenter')) { ?>
		<div class="menu-header">数据</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'statcenter') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('errander/statcenter')?>">跑腿统计</a>
			</li>
			<li <?php  if($_W['_action'] == 'statDelivery' && $_GPC['op'] == 'index') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('errander/statDelivery/index')?>">配送统计</a>
			</li>
			<li <?php  if($_W['_action'] == 'statDelivery' && $_GPC['op'] == 'day') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('errander/statDelivery/day')?>">配送详情</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('errander.category')) { ?>
		<div class="menu-header">跑腿分类</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'type') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('errander/type/list');?>">类型列表</a>
			</li>
		</ul>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'category') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('errander/category/list');?>">分类列表</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('errander.diy')) { ?>
		<!--<div class="menu-header">跑腿场景(仅适用小程序)</div>-->
		<!--<ul class="menu-item">-->
			<!--<li <?php  if($_W['_action'] == 'diypage' && $_W['_op'] == 'home') { ?>class="active"<?php  } ?>>-->
				<!--<a href="<?php  echo iurl('errander/diypage/home');?>">跑腿首页</a>-->
			<!--</li>-->
			<!--<li <?php  if($_W['_action'] == 'diypage' && $_W['_op'] == 'scene') { ?>class="active"<?php  } ?>>-->
				<!--<a href="<?php  echo iurl('errander/diypage/scene');?>">跑腿场景</a>-->
			<!--</li>-->
		<!--</ul>-->
	<?php  } ?>
	<?php  if(check_perm('errander.config') || check_perm('errander.cover')) { ?>
		<div class="menu-header">设置</div>
		<ul class="menu-item">
			<?php  if(check_perm('errander.config')) { ?>
				<li <?php  if($_W['_action'] == 'config') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('errander/config/index');?>">跑腿设置</a>
				</li>
			<?php  } ?>
			<?php  if(check_perm('errander.cover')) { ?>
				<li <?php  if($_W['_action'] == 'cover') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('errander/cover/index');?>">入口设置</a>
				</li>
			<?php  } ?>
		</ul>
	<?php  } ?>
</div>
