<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<link href="../addons/we7_wmall/plugin/errander/static/css/mobile/index.css" rel="stylesheet" type="text/css"/>
<div class="page errander-order-detail">
	<header class="bar bar-nav">
		<a class="pull-left back"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">订单详情</h1>
		<!--<a class="pull-right" href="tel:<?php  echo $_config_plugin['mobile'];?>">客服</a>-->
	</header>
	<div class="content">
		<div class="buttons-tab">
			<a href="#order-detail" class="tab-link active button">订单详情</a>
			<a href="#order-status" class="tab-link button">订单状态</a>
			<?php  if($order['refund_status']  > 0) { ?>
				<a href="#order-refund" class="tab-link button">退款详情</a>
			<?php  } ?>
		</div>
		<div class="tabs">
			<div id="order-detail" class="tab active">
				<div class="order-state">
					<div class="order-state-con border-1px-t">
						<div class="guide">
							<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/order_status_service.png" alt="" />
						</div>
						<div class="order-state-detail">
							<div class="clearfix">订单<?php  echo $order_status[$order['status']]['text'];?><span class="pull-right date"><?php  echo date('Y-m-d H:i', $order['addtime']);?></span></div>
							<div class="tips clearfix"><?php  echo $log['note'];?></div>
						</div>
					</div>
					<?php  if($order['status'] < 3 || $order['refund_status'] > 0) { ?>
						<div class="table border-1px-t">
							<?php  if(!$order['is_pay'] && !in_array($order['status'], array(3, 4))) { ?>
								<a href="<?php  echo imurl('system/paycenter/pay', array('id' => $order['id'], 'order_type' => 'errander', 'type' => 1));?>" class="table-cell border-1px-r">立即支付</a>
							<?php  } ?>
							<?php  if($order['status'] == 1) { ?>
								<a href="<?php  echo imurl('errander/order/cancel', array('id' => $order['id']));?>" class="table-cell js-post" data-confirm="确定取消该订单吗?">取消订单</a>
							<?php  } else if($order['status'] == 2) { ?>
								<?php  if($order['delivery_stauts'] == 1) { ?>
									<a href="javascript:;" class="errander-order-cancel table-cell border-1px-r" data-id="<?php  echo $order['id'];?>">取消订单</a>
								<?php  } ?>
								<?php  if($order['order_type'] != 'pickup' && $order['order_type'] != 'express') { ?>
									<a href="<?php  echo imurl('errander/order/end', array('id' => $order['id']));?>" class="table-cell js-post border-1px-r" data-confirm="确定已收到商品吗?">确认收货</a>
								<?php  } ?>
								<a href="tel:<?php  echo $deliveryer['mobile'];?>"  class="table-cell">联系骑士</a>
							<?php  } else if($order['status'] == 3) { ?>
							<?php  } ?>
							<?php  if($order['is_refund'] == 1) { ?>
								<a href="<?php  echo imurl('errander/order/detail', array('id' => $order['id']));?>" class="table-cell border-1px-l">查看退款</a>
							<?php  } ?>
						</div>
					<?php  } ?>
				</div>
				<?php  if($order['order_type'] != 'pickup') { ?>
				<div class="content-block-title">订单明细</div>
				<div class="order-details border-1px-tb">
					<div class="order-details-con">
						<!--<div class="store-info">-->
							<!--<a href="<?php  echo imurl('errander/category/index', array('id' => $order['order_cid']));?>" class="external">-->
								<!--<img src="<?php  echo tomedia($order['category']['thumb']);?>" alt="" />-->
								<!--<span class="store-title"><?php  echo $order['category']['title'];?></span>-->
								<!--<span class="icon icon-arrow-right pull-right"></span>-->
							<!--</a>-->
						<!--</div>-->
						<div class="inner-con border-1px-b">
							<?php  if($order['order_type'] == 'errand') { ?>
								<div class="row no-gutter">
									<div class="col-50">商品费用</div>
									<div class="col-50 text-right color-black">与社区跑腿员结算</div>
								</div>
							<?php  } ?>
							<div class="row no-gutter">
								<div class="col-50">费用</div>
								<div class="col-50 text-right color-black">￥<?php  echo $order['delivery_fee'];?></div>
							</div>
							<div class="row no-gutter">
								<div class="col-50">小费</div>
								<div class="col-50 text-right color-black">￥<?php  echo $order['delivery_tips'];?></div>
							</div>
						</div>
						<div class="inner-con">
							<div class="row no-gutter">
								<div class="col-80 text-right color-muted">总计</div>
								<div class="col-20 text-right color-black">￥<?php  echo $order['final_fee'];?></div>
							</div>
						</div>
					</div>
				</div>
				<?php  } ?>
				<?php  if($order['order_type'] == 'buy') { ?>
					<!--<div class="content-block-title">需求信息</div>-->
					<!--<div class="list-block other-info">-->
						<!--<ul class="border-1px-tb">-->
							<!--<li class="item-content">-->
								<!--<div class="item-inner border-1px-b">-->
									<!--<div class="item-title">订单类型</div>-->
									<!--<div class="item-after"><?php  echo $order['order_type_cn'];?></div>-->
								<!--</div>-->
							<!--</li>-->
							<!--<li class="item-content">-->
								<!--<div class="item-inner border-1px-b">-->
									<!--<div class="item-title">商品名称</div>-->
									<!--<div class="item-after"><?php  echo $order['goods_name'];?></div>-->
								<!--</div>-->
							<!--</li>-->
							<!--&lt;!&ndash;<li class="item-content">&ndash;&gt;-->
								<!--&lt;!&ndash;<div class="item-inner border-1px-b">&ndash;&gt;-->
									<!--&lt;!&ndash;<div class="item-title">购买地址</div>&ndash;&gt;-->
									<!--&lt;!&ndash;<div class="item-after"><?php  echo $order['buy_address'];?></div>&ndash;&gt;-->
								<!--&lt;!&ndash;</div>&ndash;&gt;-->
							<!--&lt;!&ndash;</li>&ndash;&gt;-->
							<?php  if(!empty($order['thumbs'])) { ?>
								<!--<li class="item-content">-->
									<!--<div class="item-inner customer-thumb border-1px-t">-->
										<!--<div class="item-title">顾客上传的图片</div>-->
										<!--<div class="row">-->
											<?php  if(is_array($order['thumbs'])) { foreach($order['thumbs'] as $thumb) { ?>
												<!--<div class="col-25 photoBrowser-image-item">-->
													<!--<img src="<?php  echo tomedia($thumb)?>">-->
												<!--</div>-->
											<?php  } } ?>
										<!--</div>-->
									<!--</div>-->
								<!--</li>-->
							<?php  } ?>
						<!--</ul>-->
					<!--</div>-->
				<?php  } else { ?>
					<div class="content-block-title">信息</div>
					<div class="list-block other-info">
						<ul class="border-1px-tb">
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title">订单类型</div>
									<div class="item-after"><?php  echo $order['order_type_cn'];?></div>
								</div>
							</li>
							<?php  if($order['order_type'] == 'errand') { ?>
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title">商品名称</div>
									<div class="item-after"><?php  echo $order['goods_name'];?></div>
								</div>
							</li>
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title">物品价值</div>
									<div class="item-after"><?php  echo $order['goods_price'];?>元</div>
								</div>
							</li>
							<!--<li class="item-content">-->
								<!--<div class="item-inner border-1px-b">-->
									<!--<div class="item-title">物品重量</div>-->
									<!--<div class="item-after"><?php  echo $order['goods_weight'];?>kg</div>-->
								<!--</div>-->
							<!--</li>-->
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title">购买地址</div>
									<div class="item-after"><?php echo empty($order['buy_address'])?'无':$order['buy_address']?></div>
								</div>
							</li>
							<!--<li class="item-content">-->
								<!--<div class="item-inner">-->
									<!--<div class="item-title">联系人</div>-->
									<!--<div class="item-after"><?php  echo $order['buy_username'];?></div>-->
								<!--</div>-->
							<!--</li>-->
							<?php  } ?>
							<?php  if(!empty($order['thumbs'])) { ?>
								<li class="item-content">
									<div class="item-inner customer-thumb border-1px-t">
										<div class="item-title">图片</div>
										<div class="row">
											<?php  if(is_array($order['thumbs'])) { foreach($order['thumbs'] as $thumb) { ?>
												<div class="col-25 photoBrowser-image-item">
													<img src="<?php  echo tomedia($thumb)?>">
												</div>
											<?php  } } ?>
										</div>
									</div>
								</li>
							<?php  } ?>
						</ul>
					</div>
				<?php  } ?>
				<div class="content-block-title"><?php  if($order['order_type'] == 'errand') { ?>收货地址<?php  } else if($order['order_type'] == 'pickup') { ?>收取地址<?php  } else { ?>上门地址<?php  } ?></div>
				<div class="list-block other-info">
					<ul class="border-1px-tb">
						<li class="item-content">
							<div class="item-inner border-1px-b" style="display:flex;">
								<div class="item-title" style="margin-right:.75rem;"><?php  if($order['order_type'] == 'errand') { ?>收货地址<?php  } else if($order['order_type'] == 'pickup') { ?>收取地址<?php  } else { ?>上门地址<?php  } ?></div>
								<div class="item-after" style="flex:1;word-break:break-all;white-space:normal;overflow:visible;"><?php  echo $order['accept_address'];?></div>
							</div>
						</li>
						<li class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title">联系人</div>
								<div class="item-after"><?php  echo $order['accept_username'];?></div>
							</div>
						</li>
					</ul>
				</div>
				<div class="content-block-title">其他信息</div>
				<div class="list-block other-info">
					<ul class="border-1px-tb">
						<?php  if(!empty($order['deliveryer_id'])) { ?>
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title"><?php  echo $types[$order['order_type']]['deliveryer_text']?></div>
									<div class="item-after"><?php  echo $deliveryer['title'];?></div>
								</div>
							</li>
						<?php  } ?>
						<li class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title"><?php  if($order['order_type'] == 'errand') { ?>配送时间<?php  } else if($order['order_type'] == 'pickup') { ?>收取时间<?php  } else if($order['order_type'] == 'delivery') { ?>维修时间<?php  } else { ?>服务时间<?php  } ?></div>
								<div class="item-after"><?php  echo $order['delivery_time'];?></div>
							</div>
						</li>
						<li class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title">订单号</div>
								<div class="item-after"><?php  echo $order['order_sn'];?></div>
							</div>
						</li>
						<?php  if($order['order_type'] == 'express') { ?>

							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title">收货人姓名</div>
									<div class="item-after"><?php  echo $order['buy_username'];?></div>
								</div>
							</li>
							<li class="item-content">
								<div class="item-inner border-1px-b">
									<div class="item-title">收货人电话</div>
									<div class="item-after"><?php  echo $order['buy_mobile'];?></div>
								</div>
							</li>
							<li class="item-content">
								<div class="item-inner border-1px-b" style="display:flex;">
									<div class="item-title" style="margin-right:.75rem;">收货人地址</div>
									<div class="item-after" style="flex:1;word-break:break-all;white-space:normal;overflow:visible;"><?php  echo $order['buy_address'];?></div>
								</div>
							</li>
							<?php  if($order['status']==3) { ?>
								<li class="item-content">
									<div class="item-inner border-1px-b">
										<div class="item-title">快递公司</div>
										<div class="item-after"><?php  echo $order['express'];?></div>
									</div>
								</li>
								<li class="item-content">
									<div class="item-inner border-1px-b">
										<div class="item-title">快递单号</div>
										<div class="item-after"><?php  echo $order['code'];?></div>
									</div>
								</li>
							<?php  } ?>
						<?php  } ?>
						<li class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title">支付方式</div>
								<div class="item-after"><?php  echo $order['pay_type_cn'];?></div>
							</div>
						</li>
						<li class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title">备注</div>
								<a class="item-after"><?php  if(!empty($order['note'])) { ?><?php  echo $order['note'];?><?php  } else { ?>无<?php  } ?></a>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div id="order-status" class="tab">
				<?php  if(is_array($logs)) { foreach($logs as $key => $log) { ?>
					<div class="order-status-item">
						<div class="guide">
							<?php  if($maxid != $key) { ?>
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/order_status_service_grey.png" alt="" />
							<?php  } else { ?>
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/order_status_service.png" alt="" />
							<?php  } ?>
						</div>
						<div class="order-status-info">
							<div class="arrow-left"></div>
							<div class="clearfix"><?php  echo $log['title'];?> <span class="time pull-right"><?php  echo date('H:i', $log['addtime'])?></span></div>
							<div class="tips"><?php  echo $log['note'];?></div>
						</div>
						<?php  if($order['delivery_handle_type'] == 'app' && $log['type'] == 'delivery_instore') { ?>
							<div id="map" class="map-info border-1px" style="height: 160px; background: #FFF; margin-top: -1em; z-index: 10000"></div>
						<?php  } ?>
					</div>
				<?php  } } ?>
			</div>
			<div id="order-refund" class="tab">
				<div class="refund-detail">
					<div class="row no-gutter refund-de-title">
						<div class="col-60">退款金额<span class="color-danger">¥<?php  echo $order['final_fee'];?></span></div>
						<div class="col-40"><span><?php  echo $order['refund_status_cn'];?></span></div>
					</div>
					<div class="refund-detail-con">
						<div class="row no-gutter">订单编号:<span><?php  echo $order['order_sn'];?></span></div>
						<div class="row no-gutter">退款周期:<span>1-15个工作日</span></div>
						<?php  if($order['order_type'] != 'pickup') { ?>
							<div class="row no-gutter">支付方式:<span><?php  echo $order['pay_type_cn'];?></span></div>
						<?php  } ?>
						<?php  if(!empty($order['refund_channel'])) { ?>
							<div class="row no-gutter">退款方式:<span><?php  echo $order['refund_channel_cn'];?></span></div>
						<?php  } ?>
						<?php  if(!empty($order['refund_account'])) { ?>
							<div class="row no-gutter">退款账户:<span><?php  echo $order['refund_account'];?></span></div>
						<?php  } ?>
					</div>
				</div>
				<div class="refund-plan">
					<?php  if(is_array($refund_logs)) { foreach($refund_logs as $key => $log) { ?>
						<div class="order-refund-item">
							<div class="guide">
								<?php  if($refundmaxid != $key) { ?>
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/order_status_service_grey.png" alt="" />
								<?php  } else { ?>
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/order_status_service.png" alt="" />
								<?php  } ?>
							</div>
							<div class="order-refund-info">
								<div class="arrow-left"></div>
								<div class="clearfix"><?php  echo $log['title'];?> <span class="time pull-right"><?php  echo date('H:i', $log['addtime'])?></span></div>
								<div class="tips"><?php  echo $log['note'];?></div>
							</div>
						</div>
					<?php  } } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="popup popup-order-map-info">
	<div class="page">
		<header>
			<a class="pull-left btn-close-popup" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
			<a class="pull-right btn-refresh"><i class="icon icon-refresh"></i></a>
		</header>
		<nav>
			<a class="pull-right btn-info" href="javascript:;"><i class="icon icon-question"></i></a>
		</nav>
		<div class="content">
			<div class="map-current" id="map-current" style="height: 100%">
			</div>
		</div>
	</div>
</div>
<script>
<?php  if($order['delivery_handle_type'] == 'app') { ?>
	require(['map'], function(AMap){
		var map = new AMap.Map('map', {
			resizeEnable: true,
			center: [116.397428, 39.90923],
			zoom: 13
		});
		var current_map = new AMap.Map('map-current', {
			resizeEnable: true,
			center: [116.397428, 39.90923],
			zoom: 15
		});

		var marker = new AMap.Marker({
			position: [<?php  echo $order['accept_location_y'];?>, <?php  echo $order['accept_location_x'];?>],
			offset: new AMap.Pixel(-35, -35),
			content: '<div class="marker-mine-route"></div>'
		});
		marker.setMap(current_map);

		<?php  if(!empty($order['buy_location_x']) && !empty($order['buy_location_y'])) { ?>
			var marker = new AMap.Marker({
				position: [<?php  echo $order['buy_location_y'];?>, <?php  echo $order['buy_location_x'];?>],
				offset: new AMap.Pixel(-27, -74),
				content: '<div class="marker-start-route"></div>'
			});
			marker.setMap(current_map);
		<?php  } ?>

		<?php  if($order['status'] == 3) { ?>
			map.panTo(["<?php  echo $order['delivery_success_location_y'];?>", "<?php  echo $order['delivery_success_location_x'];?>"]);
			current_map.panTo(["<?php  echo $order['delivery_success_location_y'];?>", "<?php  echo $order['delivery_success_location_x'];?>"]);

			var avatar = "<?php  echo $deliveryer['avatar'];?>";
			var marker = new AMap.Marker({
				position: [<?php  echo $order['delivery_success_location_y'];?>, <?php  echo $order['delivery_success_location_x'];?>],
				offset: new AMap.Pixel(-26, -80),
				content: '<div class="marker-deliveyer-route"><img src='+ avatar +' alt=""/></div>'
			});
			marker.setMap(map);

			var marker = new AMap.Marker({
				position: [<?php  echo $order['delivery_success_location_y'];?>, <?php  echo $order['delivery_success_location_x'];?>],
				offset: new AMap.Pixel(-26, -80),
				content: '<div class="marker-deliveyer-route"><img src='+ avatar +' alt=""/></div>'
			});
			marker.setMap(current_map);
		<?php  } else { ?>
			map.panTo(["<?php  echo $deliveryer['location_y'];?>", "<?php  echo $deliveryer['location_x'];?>"]);
			var avatar = "<?php  echo $deliveryer['avatar'];?>";
			var marker = new AMap.Marker({
				position: [<?php  echo $deliveryer['location_y'];?>, <?php  echo $deliveryer['location_x'];?>],
				offset: new AMap.Pixel(-26, -80),
				content: '<div class="marker-deliveyer-route"><img src='+ avatar +' alt=""/></div>'
			});
			marker.setMap(map);
		<?php  } ?>

		var set = '';
		map.on('click', function(){
			setTimeout(function(){
				current_map.setFitView();
			}, 500);
			position_sync();
			set = setInterval(position_sync, 60000);
			$.popup('.popup-order-map-info');
		});

		function position_sync() {
			$.showIndicator();
			<?php  if($order['status'] >= 3) { ?>
				$.hideIndicator();
				return;
			<?php  } ?>
			var markers = [];
			$.post("<?php  echo imurl('system/common/deliveryer/location', array('id' => $order['deliveryer_id']))?>", function(data){
				$.hideIndicator();
				var result = $.parseJSON(data);
				if(result.message.errno != -1) {
					var deliveryer = result.message.message;
					var marker = new AMap.Marker({
						position: [deliveryer.location_y, deliveryer.location_x],
						offset: new AMap.Pixel(-26, -80),
						content: '<div class="marker-deliveyer-route"><img src="'+ deliveryer.avatar +'" alt=""/></div>'
					});
					var marker1 = new AMap.Marker({
						position: [deliveryer.location_y, deliveryer.location_x],
						offset: new AMap.Pixel(-26, -80),
						content: '<div class="marker-deliveyer-route"><img src="'+ deliveryer.avatar +'" alt=""/></div>'
					});
					map.panTo([deliveryer.location_y, deliveryer.location_x]);
					map.remove(markers);
					marker.setMap(map);

					current_map.panTo([deliveryer.location_y, deliveryer.location_x]);
					current_map.remove(markers);
					marker1.setMap(current_map);
					current_map.setFitView();
					markers.push(marker);
					markers.push(marker1);
				}
			});
		}

		$('.btn-close-popup').click(function(){
			clearInterval(set);
			$.closeModal('.popup-order-map-info');
		});
		$('.btn-refresh').click(function(){
			position_sync();
		});
		$('.btn-info').click(function(){
			alert('配送员位置一分钟更新一次，如果配送员远离您，那可能是正在为更早下单的用户配送，请耐心等待~');
		});
	});
<?php  } ?>
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>