<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<style>
.order .order-inner .goods-info{
	padding:.5rem .25rem;
}
.store-info{
	position: relative;
	height:2rem !important;
	line-height:2rem !important;
}
.store-info a{
	display: flex !important;
	justify-content:space-between;
}
.blank{clear: both;}
.table-cell{
	border-right:1px solid #e0e0e0;
}
.table-cell:last-child{
	border-right:none;
}
.order-btn.table{
	border-top:1px solid #e0e0e0;
}
</style>
<div class="page order" id="page-app-order">
	<header class="bar bar-nav">
		<h1 class="title">我的订单</h1>
	</header>
	<?php  get_mall_menu();?>
	<div class="content infinite-scroll js-infinite" data-href="<?php  echo imurl('wmall/order/index/more');?>" data-distance="50" data-min="<?php  echo $min;?>" data-container=".order-list" data-tpl="tpl-order">
		<div class="order-list">
			<?php  if(empty($orders)) { ?>
				<div class="common-no-con">
					<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/order_no_con.png" alt="" />
					<p>您还没有商品订单！</p>
					<div class="btn">
						<a href="<?php  echo imurl('wmall/home/index');?>">现在去逛逛</a>
					</div>
				</div>
			<?php  } else { ?>
				<?php  if(check_plugin_perm('errander') && get_plugin_config('errander.status')) { ?>
					<div class="list-block errander-block">
						<ul>
							<li>
								<a href="<?php  echo imurl('errander/order/list/');?>" class="item-link item-content">
									<div class="item-media"><img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/suiyigou_icon.png" alt=""/></div>
									<div class="item-inner">
										<div class="item-title">社区订单</div>
									</div>
								</a>
							</li>
						</ul>
					</div>
				<?php  } ?>
				<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
					<div class="order-container">
						<div class="order-inner">
							<div class="store-info">
								<a class="external" href="<?php  echo imurl('wmall/store/goods', array('sid' => $order['sid']));?>">
									<div>
										<img src="<?php  echo tomedia($order['logo']);?>" alt="" />
										<span class="store-title"><?php  echo $order['title'];?></span>
									</div>
									<span class="icon icon-arrow-right"></span>
								</a>
								<!-- <?php  if($order['delivery_mode'] == 2) { ?>
									<div class="plateform-delivery"><span><?php  echo $_config_mall['delivery_title'];?></span></div>
								<?php  } ?> -->
							</div>
							<div class="blank"></div>
							<a class="goods-info row no-gutter external" href="<?php  echo imurl('wmall/order/index/detail', array('id' => $order['id']));?>">
								<div class="col-75">
									<div class="goods-title"><?php  echo $order['goods']['goods_title'];?>等<span><?php  echo $order['num'];?></span>件商品</div>
									<div class="date"><?php  echo date('Y-m-d H:i', $order['addtime']);?></div>
								</div>
								<div class="col-25 text-right">
									<div class="price">￥<?php  echo $order['final_fee'];?></div>
									<?php  if($order['active_state']==1) { ?>
										<div class="status no-pay">拼团中</div>
									<?php  } else { ?>
										<div class="status no-pay"><?php  echo $order_status[$order['status']]['text'];?></div>
									<?php  } ?>
								</div>
							</a>
							<?php  if(!$order['is_pay'] && $order['status'] != 6) { ?>
								<div class="order-status">
									<div class="pic">
										<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/order_status_money.png" alt="" />
									</div>
									<div class="order-status-detail">
										<div class="arrow-left"></div>
										<div class="clearfix">待支付<span class="pull-right date"><?php  echo date('H:i', $order['addtime']);?></span></div>
										<div class="tips">
											<?php  if($config_takeout['pay_time_limit'] > 0) { ?>
												请在提交订单后<?php  echo $config_takeout['pay_time_limit'];?>分钟内完成支付
											<?php  } else { ?>
												请在提交订单后尽快完成支付
											<?php  } ?>
										</div>
									</div>
								</div>
							<?php  } ?>
						</div>
						<div class="order-btn table">
							<?php  if(!$order['is_pay'] && !in_array($order['status'], array(5, 6))) { ?>
								<a href="<?php  echo imurl('system/paycenter/pay', array('id' => $order['id'], 'order_type' => 'takeout', 'type' => 1));?>" class="table-cell">立即支付</a>
							<?php  } ?>
							<?php  if($order['status'] == 1) { ?>
								<a href="<?php  echo imurl('wmall/order/index/cancel', array('id' => $order['id']));?>" class="table-cell js-post" data-confirm="确定取消该订单吗">取消订单</a>
								<?php  if($order['is_pay'] == 1) { ?>
									<a href="<?php  echo imurl('wmall/order/index/remind', array('id' => $order['id']));?>" class="table-cell js-post">催单</a>
								<?php  } ?>
							<?php  } else if(in_array($order['status'], array(2, 3, 4))) { ?>
								<?php  if($order['order_type'] == 1) { ?>
									<?php  if($order['status'] == 4) { ?>
										<a href="<?php  echo imurl('wmall/order/index/end', array('id' => $order['id']));?>" class="table-cell js-post" data-confirm="你确定收到该商家的外卖?">确认送达</a>
									<?php  } ?>
								<?php  } else if($order['order_type'] == 2) { ?>
									<a href="<?php  echo imurl('wmall/order/index/end', array('id' => $order['id']));?>" class="table-cell js-post" data-confirm="确认已到店自提?">我已提货</a>
								<?php  } ?>
								<?php  if($order['is_pay'] == 1) { ?>
									<a href="<?php  echo imurl('wmall/order/index/remind', array('id' => $order['id']));?>" class="table-cell js-post">催单</a>
								<?php  } ?>
							<?php  } else if(in_array($order['status'], array(5))) { ?>
								<a href="<?php  echo imurl('wmall/store/goods', array('f' => '1', 'id' => $order['id'], 'sid' => $order['sid']));?>" class="table-cell border-1px-r" data-id="<?php  echo $order['id'];?>">再来一单</a>
								<?php  if(!$order['is_comment']) { ?>
									<a href="<?php  echo imurl('wmall/order/comment', array('id' => $order['id']));?>" class="table-cell"><?php  echo $order['comment_cn'];?></a>
								<?php  } else { ?>
									<a href="<?php  echo imurl('wmall/member/comment');?>" class="table-cell">查看评价</a>
								<?php  } ?>
							<?php  } else if(in_array($order['status'], array(6))) { ?>
								<a href="<?php  echo imurl('wmall/store/goods', array('f' => '1', 'id' => $order['id'], 'sid' => $order['sid']));?>" class="table-cell" data-id="<?php  echo $order['id'];?>">再来一单</a>
							<?php  } ?>
							<?php  if($order['is_refund'] == 1) { ?>
								<a href="<?php  echo imurl('wmall/order/index/detail', array('id' => $order['id']));?>" class="table-cell">查看退款</a>
							<?php  } ?>
						</div>
					</div>
				<?php  } } ?>
			<?php  } ?>
		</div>
		<div class="infinite-scroll-preloader hide">
			<div class="preloader"></div>
		</div>
	</div>
</div>

<script id="tpl-order" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<div class="order-container">
		<div class="order-inner">
			<div class="store-info">
				<a class="external" href="<?php  echo imurl('wmall/store/goods');?>&sid=<{d[i].sid}>">
					<div>
						<img src="<{d[i].logo_cn}>" alt="" />
						<span class="store-title"><{d[i].title}></span>
					</div>
					<span class="icon icon-arrow-right"></span>
					<!-- <{# if(d[i].delivery_mode == 2){ }>
						<div class="plateform-delivery"><span><?php  echo $_config_mall['delivery_title'];?></span></div>
					<{# } }> -->
				</a>
			</div>
			<div class="blank"></div>
			<a class="goods-info row no-gutter external" href="<?php  echo imurl('wmall/order/index/detail');?>&id=<{d[i].id}>">
				<div class="col-75">
					<div class="goods-title"><{d[i].goods['goods_title']}>等<span><{d[i].num}></span>件商品</div>
					<div class="date"><{d[i].addtime_cn}></div>
				</div>
				<div class="col-25 text-right">
					<div class="price">￥<{d[i].final_fee}></div>
					<div class="status no-pay"><{d[i].status_cn}></div>
				</div>
			</a>
			<{# if(!d[i].is_pay && d[i].status != 6){ }>
			<div class="order-status">
				<div class="pic">
					<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/order_status_money.png" alt="" />
				</div>
				<div class="order-status-detail">
					<div class="arrow-left"></div>
					<div class="clearfix">待支付<span class="pull-right date"><{d[i].time_cn}></span></div>
					<div class="tips"><?php  if($config_takeout['pay_time_limit'] > 0) { ?>请在提交订单后<?php  echo $config_takeout['pay_time_limit'];?>分钟内完成支付<?php  } else { ?>请在提交订单后尽快付款<?php  } ?></div>
				</div>
			</div>
			<{# } }>
		</div>
		<div class="order-btn table">
			<{# if(!d[i].is_pay && d[i].status != 5 && d[i].status != 6){ }>
				<a href="<?php  echo imurl('system/paycenter/pay', array('order_type' => 'takeout', 'type' => 1));?>&id=<{d[i].id}>" class="table-cell">立即支付</a>
			<{# } }>
			<{# if(d[i].status == 1){ }>
				<a href="<?php  echo imurl('wmall/order/index/cancel');?>&id=<{d[i].id}>" class="table-cell js-post" data-confirm="确定取消该订单吗">取消订单</a>
				<{# if(d[i].is_pay == 1){ }>
					<a href="<?php  echo imurl('wmall/order/index/remind');?>&id=<{d[i].id}>" class="table-cell js-post">催单</a>
				<{# } }>
			<{# } else if(d[i].status >= 2 && d[i].status <= 4) { }>
				<{# if(d[i].order_type == 1){ }>
					<{# if(d[i].order_type == 4){ }>
						<a href="<?php  echo imurl('wmall/order/index/end');?>&id=<{d[i].id}>" class="table-cell js-post" data-confirm="你确定收到该商家的外卖?">确认送达</a>
					<{# } }>
				<{# } else if(d[i].order_type == 2) { }>
					<a href="<?php  echo imurl('wmall/order/index/end');?>&id=<{d[i].id}>" class="table-cell js-post" data-confirm="确认已到店自提?">我已提货</a>
				<{# } }>
				<{# if(d[i].is_pay == 1){ }>
					<a href="<?php  echo imurl('wmall/order/index/remind');?>&id=<{d[i].id}>" class="table-cell js-post">催单</a>
				<{# } }>
			<{# } else if(d[i].status == 5) { }>
				<a href="<?php  echo imurl('wmall/store/goods', array('f' => '1'));?>&id=<{d[i].id}>&sid=<{d[i].sid}>" class="table-cell" data-id="<?php  echo $order['id'];?>">再来一单</a>
				<{# if(d[i].is_comment == 1){ }>
					<a href="<?php  echo imurl('wmall/order/comment');?>&id=<{d[i].id}>" class="table-cell"><{d[i].comment_cn}></a>
				<{# } else { }>
					<a href="<?php  echo imurl('wmall/member/comment');?>" class="table-cell">查看评价</a>
				<{# } }>
			<{# } else if(d[i].status == 6) { }>
				<a href="<?php  echo imurl('wmall/store/goods', array('f' => '1'));?>&id=<{d[i].id}>&sid=<{d[i].sid}>" class="table-cell" data-id="<?php  echo $order['id'];?>">再来一单</a>
			<{# } }>
			<{# if(d[i].is_refund == 1){ }>
				<a href="<?php  echo imurl('wmall/order/order', array('op' => 'detail'));?>&id=<{d[i].id}>" class="table-cell">查看退款</a>
			<{# } }>
		</div>
	</div>
	<{# } }>
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>