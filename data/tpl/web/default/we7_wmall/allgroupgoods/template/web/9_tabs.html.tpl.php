<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title"><?php  echo $_W['_plugin']['title'];?></div>
<div class="nav slimscroll">
	<?php  if(check_perm('allgroupgoods.order')) { ?>
		<!--<div class="menu-header">兑换</div>-->
		<!--<ul class="menu-item">-->
			<!--<li <?php  if($_W['_action'] == 'order') { ?>class="active"<?php  } ?>>-->
				<!--<a href="<?php  echo iurl('allgroupgoods/order/list');?>">兑换记录</a>-->
			<!--</li>-->
		<!--</ul>-->
	<?php  } ?>
	<?php  if(check_perm('allgroupgoods.config') || check_perm('allgroupgoods.cover')) { ?>
		<div class="menu-header">管理</div>
		<ul class="menu-item">
			<li <?php  if($_W['_action'] == 'order') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('allgroupgoods/order/list')?>">订单列表</a>
			</li>
			<li <?php  if($_W['_action'] == 'goods') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('allgroupgoods/goods/list')?>">商品管理</a>
			</li>

			<!--<li <?php  if($_W['_action'] == 'config') { ?>class="active"<?php  } ?>>-->
				<!--<a href="<?php  echo iurl('allgroupgoods/config/index');?>">系统设置</a>-->
			<!--</li>-->

			<!--<li <?php  if($_W['_action'] == 'adv') { ?>class="active"<?php  } ?>>-->
				<!--<a href="<?php  echo iurl('allgroupgoods/adv')?>">幻灯片</a>-->
			<!--</li>-->
			<li <?php  if($_W['_action'] == 'category') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('allgroupgoods/category')?>">分类</a>
			</li>
		</ul>
	<?php  } ?>
	<?php  if(check_perm('allgroupgoods.cover')) { ?>
		<div class="menu-header">入口</div>
		<ul class="menu-item">
			<?php  if(check_perm('allgroupgoods.cover')) { ?>
				<li <?php  if($_W['_action'] == 'cover') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo iurl('allgroupgoods/cover/index');?>">入口链接</a>
				</li>
			<?php  } ?>
		</ul>
	<?php  } ?>
</div>
