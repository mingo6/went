<?php defined('IN_IA') or exit('Access Denied');?><nav class="bar bar-tab footer-bar">
	<?php  if($_W['deliveryer']['perm_takeout'] > 0) { ?>
		<a class="tab-item external <?php  if($_W['_op'] == 'takeout') { ?>active<?php  } ?>" href="<?php  echo imurl('delivery/order/takeout');?>">
			<span class="icon icon icon-takeout"></span>
			<span class="tab-label">外卖</span>
		</a>
	<?php  } ?>
	<?php  if($config_errander['status'] == 1 && $_W['deliveryer']['is_errander'] == 1) { ?>
		<a class="tab-item external <?php  if($_W['_op'] == 'errander') { ?>active<?php  } ?>" href="<?php  echo imurl('delivery/order/errander');?>">
			<span class="icon icon-errander"></span>
			<span class="tab-label">跑腿</span>
		</a>
	<?php  } ?>
	<a class="tab-item <?php  if($_W['_action'] == 'member') { ?>active<?php  } ?>" href="<?php  echo imurl('delivery/member/mine');?>">
		<span class="icon icon-mine"></span>
		<span class="tab-label">我的</span>
	</a>
</nav>
