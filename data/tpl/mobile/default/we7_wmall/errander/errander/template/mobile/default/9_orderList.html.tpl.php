<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<style>
.cagegroy-info.border-1px-b a{
	display: flex !important;
	justify-content: space-between;
}
</style>
<div class="page errander-order" id="page-app-arrander-order">
	<header class="bar bar-nav">
		<a class="pull-left back" href="<?php  echo imurl('wmall/order/index');?>"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">社区订单</h1>
	</header>
	<div class="content infinite-scroll js-infinite" data-href="<?php  echo imurl('errander/order/more');?>" data-distance="50" data-min="<?php  echo $min;?>" data-container=".order-list" data-tpl="tpl-order">
		<!--<div class="list-block order-stat">-->
			<!--<ul>-->
				<!--<li class="item-content border-1px-b">-->
					<!--<div class="item-inner">-->
						<!--<div class="item-title">已有 <span class="color-danger">10000</span> 人使用了随意购</div>-->
						<!--<div class="item-after">-->
							<!--<a href="<?php  echo imurl('errander/index');?>" class="color-danger">立即下单 <i class="icon icon-arrow-right"></i></a>-->
						<!--</div>-->
					<!--</div>-->
				<!--</li>-->
			<!--</ul>-->
		<!--</div>-->
		<?php  if(empty($orders)) { ?>
			<div class="order-empty border-1px-b">
				<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/errander-order-no.png" alt="" />
				<p>您还没有社区订单 ~</p>
			</div>
			<?php  if(!empty($others)) { ?>
				<div class="content-block-title text-center" style="display: none;">看看大家都在买啥</div>
				<div class="list-block media-list order-others" style="display: none;">
					<ul>
						<?php  if(is_array($others)) { foreach($others as $other) { ?>
							<li class="border-1px-tb">
								<a href="<?php  echo imurl('errander/category/index', array('id' => $other['order_cid']));?>" class="item-link item-content">
									<div class="item-media"><img src="<?php  echo tomedia($other['thumb']);?>"></div>
									<div class="item-inner">
										<div class="item-title-row">
											<div class="item-title"><?php  echo $other['anonymous_username'];?> 购买了 <?php  echo $other['goods_name'];?></div>
										</div>
										<div class="item-text"><?php  echo date('Y-m-d H:i:s', $other['addtime']);?></div>
									</div>
								</a>
							</li>
						<?php  } } ?>
					</ul>
				</div>
			<?php  } ?>
		<?php  } else { ?>
			<div class="order-list">
				<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
					<div class="order-container">
						<div class="order-inner">
							<div class="cagegroy-info border-1px-b">
								<a class="external" href="<?php  echo imurl('errander/category/index', array('id' => $order['order_cid']));?>">
									<div>
										<img src="<?php  echo tomedia($order['thumb']);?>" alt="" />
										<span class="store-title"><?php  echo $type_name[$order['order_type']];?>-<?php  echo $order['title'];?></span>
									</div>
									<span class="icon icon-arrow-right"></span>
								</a>
							</div>
							<a class="goods-info row no-gutter external" href="<?php  echo imurl('errander/order/detail', array('id' => $order['id']));?>">
								<div class="col-75">
									<?php  if($order['order_type']=="errand") { ?>
										<div class="goods-title">购买商品：<?php  echo $order['goods_name'];?></div>
									<?php  } else { ?>
										<div class="goods-title">备注：<?php  echo $order['note'];?></div>
									<?php  } ?>
									<div class="date"><?php  echo date('Y-m-d H:i', $order['addtime']);?></div>
								</div>
								<div class="col-25 text-right">
									<div class="price">￥<?php  echo $order['final_fee'];?></div>
									<div class="status no-pay"><?php  echo $order_status[$order['status']]['text'];?></div>
								</div>
							</a>
							<?php  if(!$order['is_pay'] && $order['status'] != 4) { ?>
								<div class="order-status">
									<div class="pic">
										<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/order_status_money.png" alt="" />
									</div>
									<div class="order-status-detail">
										<div class="arrow-left"></div>
										<div class="clearfix">待支付<span class="pull-right date"><?php  echo date('H:i', $order['addtime']);?></span></div>
										<?php  if(!empty($config['errander']['pay_time_limit'])) { ?>
											<div class="tips">请在提交订单后<?php  echo $config['errander']['pay_time_limit'];?>分钟内完成支付</div>
										<?php  } ?>
									</div>
								</div>
							<?php  } ?>
						</div>
						<?php  if($order['status'] < 3 || $order['refund_status'] > 0) { ?>
							<div class="order-btn table border-1px-t">
								<?php  if(!$order['is_pay'] && !in_array($order['status'], array(3, 4))) { ?>
									<a href="<?php  echo imurl('system/paycenter/pay', array('id' => $order['id'], 'order_type' => 'errander', 'type' => 1));?>" class="table-cell external">立即支付</a>
								<?php  } ?>
								<?php  if($order['status'] == 1) { ?>
									<a href="<?php  echo imurl('errander/order/cancel', array('id' => $order['id']));?>" class="table-cell js-post" data-confirm="确定取消该订单吗?">取消订单</a>
								<?php  } else if($order['status'] == 2) { ?>
									<?php  if($order['order_type'] != 'pickup' && $order['order_type'] != 'express') { ?>
										<a href="<?php  echo imurl('errander/order/end', array('id' => $order['id']));?>" class="table-cell js-post" data-confirm="确定已收到商品吗?">确认收货</a>
									<?php  } ?>
									<a href="tel:<?php  echo $order['deliveryer']['mobile'];?>" class="table-cell border-1px-l">联系骑士</a>
								<?php  } else if($order['status'] == 3) { ?>
								<?php  } ?>
								<?php  if($order['refund_status'] > 1) { ?>
									<a href="<?php  echo imurl('errander/order/detail', array('id' => $order['id']));?>" class="table-cell">查看退款</a>
								<?php  } ?>
							</div>
						<?php  } ?>
					</div>
				<?php  } } ?>
			</div>
			<div class="infinite-scroll-preloader hide">
				<div class="preloader"></div>
			</div>
		<?php  } ?>
	</div>
</div>
<script id="tpl-order" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<div class="order-container">
		<div class="order-inner">
			<div class="cagegroy-info border-1px-b">
				<a class="external" href="<?php  echo imurl('errander/category/index');?>&id=<{d[i].order_cid}>">
					<div>
						<img src="<{d[i].thumb}>" alt="" />
						<span class="store-title"><{d[i].title}></span>
					</div>
					<span class="icon icon-arrow-right"></span>
				</a>
			</div>
			<a class="goods-info row no-gutter external" href="<?php  echo imurl('errander/order/detail');?>&id=<{d[i].id}>">
				<div class="col-75">
					<div class="goods-title">购买商品：<{d[i].goods_name}></div>
					<div class="date"><{d[i].addtime_cn}></div>
				</div>
				<div class="col-25 text-right">
					<div class="price">￥<{d[i].final_fee}></div>
					<div class="status no-pay"><{d[i].status_cn}></div>
				</div>
			</a>
			<{# if(!d[i].is_pay && d[i].status != 4){ }>
				<div class="order-status">
					<div class="pic">
						<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/order_status_money.png" alt="" />
					</div>
					<div class="order-status-detail">
						<div class="arrow-left"></div>
						<div class="clearfix">待支付<span class="pull-right date"><{d[i].time_cn}></span></div>
						<{# if(!d[i]['errander']['pay_time_limit'] > 0){ }>
							<div class="tips">请在提交订单后<{d[i]['errander']['pay_time_limit']}>分钟内完成支付</div>
						<{# } }>
					</div>
				</div>
			<{# } }>
		</div>
		<{# if(d[i].status < 3 || d[i].refund_status > 0){ }>
			<div class="order-btn table border-1px-t">
				<{# if(!d[i].is_pay && d[i].status != 3){ }>
					<a href="<?php  echo imurl('system/paycenter/pay', array('order_type' => 'errander', 'type' => 1));?>&id=<{d[i].id}>" class="table-cell external">立即支付</a>
				<{# } }>
				<{# if(d[i].status == 1){ }>
					<a href="<?php  echo imurl('errander/order/cancel');?>&id=<{d[i].id}>" class="table-cell js-post" data-confirm="确定取消该订单吗?">取消订单</a>
				<{# } else if(d[i].status == 2){ }>
<!--
					<{# if(d[i].delivery_status == 1){ }>
						<a href="<?php  echo imurl('errander/order/cancel');?>&id=<{d[i].id}>" class="table-cell js-post" data-confirm="确定取消该订单吗?">取消订单</a>
					<{# } }>
-->
					<a href="<?php  echo imurl('errander/order/end');?>&id=<{d[i].id}>" class="table-cell js-post" data-confirm="确定已收到商品吗?">确认收货</a>
					<a href="tel:<{d[i].deliveryer.mobile}>" class="table-cell border-1px-l">联系骑士</a>
				<{# } else if(d[i].status == 3){ }>
				<{# } }>
				<{# if(d[i].is_refund == 1){ }>
					<a href="<?php  echo imurl('errander/order/detail');?>&id=<{d[i].id}>" class="table-cell">查看退款</a>
				<{# } }>
			</div>
		<{# } }>
	</div>
	<{# } }>
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>