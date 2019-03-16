<?php defined('IN_IA') or exit('Access Denied');?><div class="second-sidebar-title">
	营销活动
</div>
<div class="nav slimscroll">
	<div class="menu-header">店铺活动</div>
	<ul class="menu-item">
		<li <?php  if($_W['_op'] == 'shopIndex') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('store/activity/shopIndex');?>">活动类型</a>
		</li>
		<li <?php  if($_W['_op'] == 'newMember') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/activity/newMember');?>">门店新用户</a>
		</li>
		<li <?php  if($_W['_op'] == 'selfDelivery') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/activity/selfDelivery');?>">自提优惠</a>
		</li>
		<li <?php  if($_W['_op'] == 'discount') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/activity/discount');?>">满减优惠</a>
		</li>
		<li <?php  if($_W['_op'] == 'cashGrant') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/activity/cashGrant');?>">返现优惠</a>
		</li>
		<li <?php  if($_W['_op'] == 'grant') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/activity/grant');?>">满赠优惠</a>
		</li>
		<li <?php  if($_W['_op'] == 'couponGrant') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/activity/couponGrant');?>">满返优惠</a>
		</li>
		<li <?php  if($_W['_op'] == 'couponCollect') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/activity/couponCollect');?>">进店领券</a>
		</li>
		<li <?php  if($_W['_op'] == 'bargain') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/activity/bargain');?>">天天特价</a>
		</li>
		<li <?php  if($_W['_op'] == 'deliveryFeeDiscount') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/activity/deliveryFeeDiscount');?>">满减配送费</a>
		</li>
	</ul>
	<div class="menu-header" hidden>门店推广</div>
	<ul class="menu-item" hidden>
		<li <?php  if($_W['_op'] == 'storeAdvertise') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/activity/storeAdvertise');?>">门店推广管理</a>
		</li>
	</ul>
	<?php  if(check_plugin_perm('superCoupon') && $_W['we7_wmall']['store']['data']['superCoupon']['status'] == 1) { ?>
		<div class="menu-header">代金券</div>
		<ul class="menu-item">
			<li <?php  if($_W['_op'] == 'superCoupon') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('store/activity/superCoupon');?>">超级代金券</a>
			</li>
			<li <?php  if($_W['_op'] == 'superCouponRecord') { ?>class="active"<?php  } ?>>
				<a href="<?php  echo iurl('store/activity/superCouponRecord');?>">发券记录</a>
			</li>
		</ul>
	<?php  } ?>
	<div class="menu-header">平台活动</div>
	<ul class="menu-item">
		<li <?php  if($_W['_op'] == 'mallNewMember') { ?>class="active"<?php  } ?>>
			<a href="<?php  echo iurl('store/activity/mallNewMember');?>">平台新用户</a>
		</li>
	</ul>
	<div class="menu-header">客户</div>
	<ul class="menu-item">
		<li <?php  if($_W['_op'] == 'member') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo iurl('store/activity/member');?>">客户管理</a>
		</li>
	</ul>
</div>
