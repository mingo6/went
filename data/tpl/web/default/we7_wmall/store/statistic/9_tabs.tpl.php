<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">
	分析
</div>
<div class="nav slimscroll">
	<ul class="menu-item">
		<li <?php  if($_W['_op'] == 'order') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/statistic/order');?>">营业统计</a>
		</li>
		<li <?php  if($_W['_op'] == 'goods') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/statistic/goods');?>">热门商品</a>
		</li>
	</ul>
</div>
