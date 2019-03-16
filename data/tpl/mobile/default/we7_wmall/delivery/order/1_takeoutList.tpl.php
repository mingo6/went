<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page" id="page-delivery-order">
	<header class="bar bar-nav common-bar-nav">
		<a class="icon pull-left icon icon-arrow-left back hide"></a>
		<h1 class="title">外卖订单<?php  if($status == 3 && $config_takeout['order']['auto_refresh'] == 1) { ?>(<span id="time">10</span>秒后自动刷新)<?php  } ?></h1>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content infinite-scroll js-infinite" data-href="<?php  echo imurl('delivery/order/takeout/more', array('status' => $status))?>" data-distance="50" data-min="<?php  echo $min;?>" data-container=".order-list-container" data-tpl="tpl-takeout-order">
		<div class="buttons-tab">
			<a href="<?php  echo imurl('delivery/order/takeout/list', array('status' => 3));?>" class="button <?php  if($status == 3) { ?>active<?php  } ?>">
				待抢
				<?php  if($num3['num'] > 0) { ?>
					<span class="num"><?php  echo $num3['num'];?></span>
				<?php  } ?>
			</a>
			<a href="<?php  echo imurl('delivery/order/takeout/list', array('status' => 7));?>" class="button <?php  if($status == 7) { ?>active<?php  } ?>">
				待取货
				<?php  if($num7['num'] > 0) { ?>
					<span class="num"><?php  echo $num7['num'];?></span>
				<?php  } ?>
			</a>
			<a href="<?php  echo imurl('delivery/order/takeout/list', array('status' => 4));?>" class="button <?php  if($status == 4) { ?>active<?php  } ?>">
				配送中
				<?php  if($num4['num'] > 0) { ?>
					<span class="num"><?php  echo $num4['num'];?></span>
				<?php  } ?>
			</a>
			<a href="<?php  echo imurl('delivery/order/takeout/list', array('status' => 5));?>" class="button <?php  if($status == 5) { ?>active<?php  } ?>">配送成功</a>
		</div>
		<?php  if(empty($orders)) { ?>
			<div class="no-data">
				<div class="bg"></div>
				<?php  if($status == 3) { ?>
					<?php  if($_W['deliveryer']['work_status'] == 1) { ?>
						<?php  if($_W['deliveryer']['perm_takeout'] == 1) { ?>
							<?php  if(!$can_collect_order) { ?>
								<p>当前调度模式不允许抢单,请等待管理员或系统派单</p>
							<?php  } else { ?>
								<p>没有任何订单哦～</p>
							<?php  } ?>
						<?php  } else { ?>
							<p>没有任何订单哦～</p>
						<?php  } ?>
					<?php  } else { ?>
						<p>您当前处于收工状态</p>
						<p>收工时将不再接到新任务提示!</p>
					<?php  } ?>
				<?php  } else { ?>
					<p>没有任何订单哦～</p>
				<?php  } ?>
			</div>
		<?php  } else { ?>
		<div class="order-list">
			<?php  if($status == 3) { ?>
			<ul>
				<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
				<li class="row delivery-wait">
					<?php  if($order['delivery_type'] == 1) { ?>
						<div class="delivery-type bg-danger">店内</div>
					<?php  } else { ?>
						<div class="delivery-type bg-success">平台</div>
					<?php  } ?>
					<div class="order-ls-info col-80">
						<p>编号: <b class="color-danger" style="font-size: .8rem;">#<?php  echo $order['serial_sn'];?></b></p>
						<?php  if(!empty($order['remind'])) { ?>
							<div class="order-remind" data-endtime="<?php  echo $order['remind']['endtime'];?>" data-id="<?php  echo $order['id'];?>" style="background-color: <?php  echo $order['remind']['color'];?>">
								<i class="icon icon-time"></i>
								<?php  echo $order['remind']['text'];?> <?php  if(!empty($order['remind']['endtime'])) { ?><span class="minute">00</span>:<span class="second">00</span><?php  } ?>
							</div>
						<?php  } ?>
						<p>取货门店: <?php  echo $stores[$order['sid']]['title'];?></p>
						<p>取货地址: <?php  echo $stores[$order['sid']]['address'];?></p>
						<p>送货地址: <?php  echo $order['address'];?></p>
						<p>下单时间: <?php  echo date('Y-m-d H:i:s', $order['addtime'])?></p>
						<?php  if($order['delivery_type'] == 2) { ?>
							<p>配送费用: <?php  echo $order['plateform_deliveryer_fee'];?>元</p>
							<?php  if($order['pay_type'] == 'delivery') { ?>
								<p class="color-danger">本单需收取顾客: <?php  echo $order['final_fee'];?>元</p>
							<?php  } ?>
						<?php  } ?>
					</div>
					<div class="order-pay-info <?php  echo $order['pay_type_class'];?>"></div>
					<div class="order-ls-btn col-20">
						<a href="<?php  echo imurl('delivery/order/takeout/collect', array('id' => $order['id']))?>" class="js-post" data-confirm="<?php  if($order['delivery_type'] == 1) { ?>该订单是店内单, 确定接单吗?<?php  } else { ?>该订单是平台单, 配送完成后将获得<?php  echo $order['plateform_deliveryer_fee'];?>元配送费, 确定接单吗<?php  } ?>" >抢</a>
					</div>
				</li>
				<?php  } } ?>
			</ul>
			<?php  } else { ?>
			<ul class="order-list-container">
				<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
					<li class="delivery-others border-1px-tb">
						<?php  if($order['delivery_type'] == 1) { ?>
							<div class="delivery-type bg-danger">店内</div>
						<?php  } else { ?>
							<div class="delivery-type bg-success">平台</div>
						<?php  } ?>
						<div class="collect-type bg-success" style="display: none"><?php  echo $order['delivery_collect_type_cn'];?></div>
						<a class="order-ls-info external" href="<?php  echo imurl('delivery/order/takeout/detail', array('id' => $order['id']));?>">
							<div class="order-ls-tl">编号: <b class="order-serial-sn">#<?php  echo $order['serial_sn'];?></b><span class="<?php  echo $delivery_status[$order['delivery_status']]['color'];?>"><?php  echo $delivery_status[$order['delivery_status']]['text'];?></span></div>
							<?php  if(!empty($order['remind'])) { ?>
								<div class="order-remind" <?php  if($order['remind']['color']) { ?>style="background: <?php  echo $order['remind']['color'];?>;"<?php  } ?>>
									<i class="icon icon-time"></i>
									<?php  echo $order['remind']['text'];?> <?php  if(!empty($order['remind']['endtime'])) { ?><span class="minute">00</span>:<span class="second">00</span><?php  } ?>
								</div>
							<?php  } ?>
							<div class="order-ls-date"><?php  echo date('Y-m-d H:i:s', $order['addtime']);?><span>下单人:<?php  echo $order['username'];?></span></div>
							<div class="order-ls-dl border-1px-tb">
								<div class="row">
									<div class="col-25">取货地址:</div>
									<div class="col-75 align-right"><?php  echo $stores[$order['sid']]['title'];?> <br><?php  echo $stores[$order['sid']]['address'];?></div>
								</div>
								<div class="row">
									<div class="col-25">送货地址:</div>
									<div class="col-75 align-right"><?php  echo $order['address'];?></div>
								</div>
								<div class="row">
									<div class="col-25">手机　号:</div>
									<div class="col-75 align-right"><?php  echo $order['mobile'];?></div>
								</div>
								<?php  if($order['delivery_type'] == 2 && $order['pay_type'] == 'delivery') { ?>
									<div class="row color-danger">
										<div class="col-25">本单需收取顾客:</div>
										<div class="col-75 align-right"><?php  echo $order['final_fee'];?>元</div>
									</div>
								<?php  } ?>
							</div>
							<div class="order-ls-sum">共<?php  echo $order['num'];?>件，合计：¥<?php  echo $order['final_fee'];?></div>
							<?php  if($order['transfer_delivery_status'] == 1) { ?>
								<div class="transfer-reason">转单原因：<?php  echo $order['transfer_delivery_reason'];?></div>
							<?php  } ?>
						</a>
						<div class="order-pay-info <?php  echo $order['pay_type_class'];?>"></div>
						<?php  if($order['transfer_delivery_status'] == 1) { ?>
							<div class="order-ls-btn border-1px-t">
								<a href="<?php  echo imurl('delivery/order/takeout/direct_transfer_reply', array('id' => $order['id'], 'result' => 'agree'))?>" data-confirm="确定接受吗?" class="js-post border-1px-r">接受转单</a>
								<a href="<?php  echo imurl('delivery/order/takeout/direct_transfer_reply', array('id' => $order['id'], 'result' => 'refuse'))?>" data-confirm="确定拒绝吗?" class="js-post">拒绝转单</a>
							</div>
						<?php  } else { ?>
							<?php  if($order['delivery_status'] == 7 || $order['delivery_status'] == 8) { ?>
							<div class="order-ls-btn border-1px-t">
								<a href="tel:<?php  echo $stores[$order['sid']]['telephone'];?>" class="border-1px-r">呼叫商户</a>
								<a href="<?php  echo imurl('delivery/order/takeout/takegoods', array('id' => $order['id']))?>" data-confirm="确定已取货?" class="js-post">确认取货</a>
							</div>
							<?php  } else if($order['delivery_status'] == 4) { ?>
							<div class="order-ls-btn border-1px-t">
								<a href="tel:<?php  echo $order['mobile'];?>" class="border-1px-r">呼叫顾客</a>
								<a href="<?php  echo imurl('delivery/order/takeout/notice', array('id' => $order['id']));?>" data-confirm="确定通知下单人你已到达送餐地址吗?" class="js-post border-1px-r">微信通知</a>
								<a href="<?php  echo imurl('delivery/order/takeout/success', array('id' => $order['id']));?>" data-confirm="<?php  if($order['pay_type'] == 'delivery' && $order['delivery_type'] == 2) { ?>'本单属于货到付款单,请收取顾客<?php  echo $order['final_fee'];?>元<?php  } else { ?>确认已将该订单送达?<?php  } ?>" class="js-post">确认送达</a>
							</div>
							<?php  } ?>
						<?php  } ?>
					</li>
					<?php  } } ?>
				</ul>
			<?php  } ?>
			<div class="infinite-scroll-preloader hide">
				<div class="preloader"></div>
			</div>
		</div>
		<?php  } ?>
	</div>
</div>
<script id="tpl-takeout-order" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<li class="delivery-others border-1px-tb">
		<{# if(d[i].delivery_type == 1){ }>
		<div class="delivery-type bg-danger">店内</div>
		<{# } else { }>
		<div class="delivery-type bg-success">平台</div>
		<{# } }>
		<div class="collect-type bg-success" style="display: none"><{d[i].delivery_collect_type_cn}></div>
		<div class="order-ls-info">
			<div class="order-ls-tl">编号: <b class="order-serial-sn">#<{d[i].serial_sn}></b><span class="<{d[i].status_color}>"><{d[i].status_cn}></span></div>
			<div class="order-ls-date"><{d[i].addtime_cn}><span>下单人:<{d[i].username}></span></div>
			<div class="order-ls-dl">
				<div class="row">
					<div class="col-25">取货地址:</div>
					<div class="col-75 align-right"><{d[i].store.address}></div>
				</div>
				<div class="row">
					<div class="col-25">送货地址:</div>
					<div class="col-75 align-right"><{d[i].address}></div>
				</div>
				<div class="row">
					<div class="col-25">手机　号:</div>
					<div class="col-75 align-right"><{d[i].mobile}></div>
				</div>
			</div>
			<div class="order-ls-sum">共<{d[i].num}>件，合计：¥<{d[i].final_fee}></div>
			<{# if(d[i].transfer_delivery_status == 1) { }>
				<div class="transfer-reason">转单原因：<{d[i].transfer_delivery_reason}></div>
			<{#  } }>
		</div>
		<{# if(d[i].transfer_delivery_status == 1){ }>
			<a href="<?php  echo imurl('delivery/order/takeout/direct_transfer_reply');?>&id=<{d[i].id}&result=agree>" data-confirm="确定接受转单吗?" class="js-post border-1px-r">接受转单</a>
			<a href="<?php  echo imurl('delivery/order/takeout/direct_transfer_reply');?>&id=<{d[i].id}&result=refuse>"  data-confirm="确定拒绝转单吗" class="js-post">拒绝转单</a>
		<{# } else { }>
			<{# if(d[i].delivery_status == 7 || d[i].delivery_status == 8){ }>
			<div class="order-ls-btn border-1px-t">
				<a href="tel:<{d[i].store.telephone}>" class="border-1px-r">呼叫商户</a>
				<a href="<?php  echo imurl('delivery/order/takeout/takegoods')?>&id=<{d[i].id}>" data-confirm="确定已取货?" class="js-post">确认取货</a>
			</div>
			<{# } else if(d[i].delivery_status == 4){ }>
			<div class="order-ls-btn border-1px-t">
				<a href="tel:<{d[i].mobile}>" class="border-1px-r">呼叫顾客</a>
				<a href="<?php  echo imurl('delivery/order/takeout/notice');?>&id=<{d[i].id}>" data-confirm="确定通知下单人你已到达送餐地址吗?" class="js-post border-1px-r">微信通知</a>
				<a href="<?php  echo imurl('delivery/order/takeout/success');?>&id=<{d[i].id}>"  data-confirm="<{# if(d[i].pay_type == 'delivery' && d[i].delivery_type == 2 ){ }>本单属于货到付款单,请收取顾客<{d[i].final_fee}>元<{# } else { }>确认已将该订单送达?<{# } }>" class="js-post">确认送达</a>
			</div>
			<{# } }>
		<{# } }>
	</li>
	<{# } }>
</script>
<script>
require(['tiny'], function(tiny){
	//自动刷新
	<?php  if($status == 3 && $config_takeout['order']['auto_refresh'] == 1) { ?>
		setInterval(function(){
			var time = parseInt($('#time').html());
			if(time >= 1) {
				time--;
				$('#time').html(time);
			} else {
				location.reload();
			}
		}, 1000);
	<?php  } ?>

	$('.order-remind').each(function(){
		var endtime = $(this).data('endtime'), id = $(this).data('id');
		var parent = '.order-remind[data-id="'+ id +'"]';
		tiny.countDown(endtime, '', parent + ' .hour', parent + ' .minute', parent + ' .second');
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>