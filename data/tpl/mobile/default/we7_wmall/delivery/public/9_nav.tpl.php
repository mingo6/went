<?php defined('IN_IA') or exit('Access Denied');?><style>
	.footer-bar.bar-tab .tab-item.active .lrt_icon_errander_active{
		display:block;
	}
	.footer-bar.bar-tab .tab-item.active .lrt_icon_errander{
		display: none;
	}
	.lrt_icon{
		display:block;
		width:1.2rem;
	  	height:1.2rem;
	  	margin:0 auto;
	  	background:no-repeat center/100%;
	}
	.lrt_icon_errander{
	  	background-image:url(../addons/we7_wmall/template/mobile/wmall/default/static/img/community.png);
	}
	.lrt_icon_errander_active{
	  	background-image:url(../addons/we7_wmall/template/mobile/wmall/default/static/img/community_active2.png);
		display:none;
	}
	.tab-label{
		color: #929292;
	}
</style>
<nav class="bar bar-tab footer-bar">
	<?php  if($config_errander['status'] == 1 && $_W['deliveryer']['is_errander'] == 1) { ?>
		<a class="tab-item external <?php  if($_W['_op'] == 'errander') { ?>active<?php  } ?>" href="<?php  echo imurl('delivery/order/errander');?>">
			<span class="lrt_icon lrt_icon_errander"></span>
			<span class="lrt_icon lrt_icon_errander_active"></span>
			<span class="tab-label" style="font-size:.55rem;line-height:.9rem;display:block;text-align:center;">社区</span>
		</a>
	<?php  } ?>
	<?php  if($_W['deliveryer']['perm_takeout'] > 0) { ?>
	<a class="tab-item external <?php  if($_W['_op'] == 'takeout') { ?>active<?php  } ?>" href="<?php  echo imurl('delivery/order/takeout');?>">
		<span class="icon icon icon-shop"></span>
		<span class="tab-label">商铺</span>
	</a>
	<?php  } ?>
	<a class="tab-item <?php  if($_W['_action'] == 'member') { ?>active<?php  } ?>" href="<?php  echo imurl('delivery/member/mine');?>">
		<span class="icon icon-mine"></span>
		<span class="tab-label">我</span>
	</a>
</nav>
