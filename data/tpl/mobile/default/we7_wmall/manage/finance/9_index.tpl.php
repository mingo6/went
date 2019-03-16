<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page account">
	<header class="bar bar-nav common-bar-nav">
	<a class="icon pull-left icon icon-arrow-left back"></a>
	<h1 class="title">资产</h1>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content">
		<div class="activity-nav">
			<div class="remainder align-center">账户可用余额</div>
			<div class="count align-center">¥<?php  echo $store['account']['amount'];?></div>
		</div>
		<div class="list-block">
			<ul>
				<li class="item-content item-link">
					<div class="item-media"><i class="icon icon-account"></i></div>
					<a class="item-inner border-1px-b" href="<?php  echo imurl('manage/finance/current')?>">
						<div class="item-title text-left">账户明细</div>
					</a>
				</li>
				<li class="item-content item-link">
					<div class="item-media"><i class="icon icon-refund"></i></div>
					<a class="item-inner" href="<?php  echo imurl('manage/finance/getcash')?>">
						<div class="item-title text-left">申请提现</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>

<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>