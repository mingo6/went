<?php defined('IN_IA') or exit('Access Denied');?><nav class="bar bar-tab footer-bar">
	<a class="tab-item <?php  if($_W['_action'] == 'shop') { ?>active<?php  } ?>" href="<?php  echo imurl('manage/shop/index');?>">
		<span class="icon icon-home"></span>
		<span class="tab-label">店铺</span>
	</a>
	<a class="tab-item <?php  if($_W['_action'] == 'order' && $_W['_op'] == 'takeout') { ?>active<?php  } ?>" href="<?php  echo imurl('manage/order/takeout');?>">
		<span class="icon icon-takeout"></span>
		<span class="tab-label">外卖</span>
	</a>
	<a class="tab-item <?php  if($_W['_action'] == 'order' && $_W['_op'] == 'tangshi') { ?>active<?php  } ?>" href="<?php  echo imurl('manage/order/tangshi');?>">
		<span class="icon icon-meal"></span>
		<span class="tab-label">店内</span>
	</a>
	<a class="tab-item <?php  if($_W['_action'] == 'more') { ?>active<?php  } ?>" href="<?php  echo imurl('manage/more/index');?>">
		<span class="icon icon-more"></span>
		<span class="tab-label">更多</span>
	</a>
</nav>