<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page" id="page-manage-home">
	<header class="bar bar-nav common-bar-nav" style="border-bottom: 0">
		<h1 class="title"><?php  echo $_W['we7_wmall']['store']['title'];?></h1>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content">
		<ul class="store-data">
			<li>
				<a href="javascript:;">
					<div class="store-data-sum"><?php  echo $stat['total_order'];?></div>
					<div class="store-data-info">今日有效订单</div>
				</a>
			</li>
			<li>
				<a href="javascript:;">
					<div class="store-data-sum"><?php  echo $stat['total_fee'];?></div>
					<div class="store-data-info">今日总营业额</div>
				</a>
			</li>
			<li>
				<a href="javascript:;">
					<div class="store-data-sum"><?php  echo $stat['final_fee'];?></div>
					<div class="store-data-info">今日总收入</div>
				</a>
			</li>
		</ul>
		<ul class="store-cate">
			<li>
				<a href="<?php  echo imurl('manage/shop/setting');?>" class="icon icon-shop">
					<p>店铺管理</p>
				</a>
			</li>
			<li>
				<a href="<?php  echo imurl('manage/order/takeout');?>" class="icon icon-order">
					<p>订单管理</p>
				</a>
			</li>
			<li>
				<a href="<?php  echo imurl('manage/order/takeout1');?>" class="icon icon-order">
					<p>新版订单</p>
				</a>
			</li>
			<li>
				<a href="<?php  echo imurl('manage/goods/index');?>" class="icon icon-goods">
					<p>商品管理</p>
				</a>
			</li>
			<li>
				<a href="<?php  echo imurl('manage/service/comment');?>" class="icon icon-survey">
					<p>评论管理</p>
				</a>
			</li>
			<li>
				<a href="<?php  echo imurl('manage/finance/index');?>" class="icon icon-recharge">
					<p>资产</p>
				</a>
			</li>
			<!-- <li>
				<a href="javascript:;" class="icon icon-scan" id="scanqrcode">
					<p>扫一扫</p>
				</a>
			</li> -->
			<li>
				<a href="<?php  echo imurl('manage/activity/index');?>" class="icon icon-activity">
					<p>店铺活动</p>
				</a>
			</li>
			<?php  if($advertise['basic']['status'] == 1) { ?>
			<li>
				<a href="<?php  echo imurl('manage/advertise/index');?>" class="icon icon-medal">
					<p>店铺推广</p>
				</a>
			</li>
			<?php  } ?>
			<li>
				<a href="<?php  echo imurl('manage/news/notice')?>" class="icon icon-newshot">
					<p>公告</p>
					<?php  if(!empty($notice)) { ?>
						<span class="wui-badge"><?php  echo $notice;?></span>
					<?php  } ?>
				</a>
			</li>
			<li>
				<a href="<?php  echo imurl('manage/paycenter/paybill/index', array('pay_type' => 'all'))?>" class="icon icon-signboard">
					<p>买单</p>
				</a>
			</li>
			<?php  if($poster['status'] == 1) { ?>
			<li>
				<a href="<?php  echo imurl('manage/poster/index/poster')?>" class="icon icon-fukuanma">
					<p>商户海报</p>
				</a>
			</li>
			<?php  } ?>
		</ul>

		<?php  if(!empty($ads)) { ?>
			<div class="swiper-container slide" data-space-between='0' data-pagination='.swiper-slide-pagination' data-autoplay="5000">
				<div class="swiper-wrapper">
					<?php  if(is_array($ads)) { foreach($ads as $slide) { ?>
						<div class="swiper-slide js-url" data-link="<?php  echo $slide['link'];?>">
							<img src="<?php  echo tomedia($slide['thumb']);?>" alt="">
						</div>
					<?php  } } ?>
				</div>
				<div class="swiper-pagination swiper-slide-pagination"></div>
			</div>
		<?php  } ?>
	</div>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>