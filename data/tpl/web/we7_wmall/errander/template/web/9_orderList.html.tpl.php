<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="" class="form-horizontal form-filter" id="form-takeout">
	<?php  echo tpl_form_filter_hidden('errander/order/list');?>
	<input type="hidden" name="filter_type" value="<?php  echo $filter_type;?>"/>
	<?php  if($filter_type == 'process' || $filter_type == 'all') { ?>
		<input type="hidden" name="status" value="<?php  echo $status;?>"/>
		<input type="hidden" name="is_pay" value="<?php  echo $is_pay;?>"/>
		<input type="hidden" name="pay_type" value="<?php  echo $pay_type;?>"/>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单状态</label>
			<div class="col-sm-9 col-xs-12">
				<div class="btn-group">
					<div class="btn-group">
						<a href="<?php  echo ifilter_url('status:0');?>" class="btn <?php  if($status == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
						<a href="<?php  echo ifilter_url('status:1');?>" class="btn <?php  if($status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">待接单</a>
						<a href="<?php  echo ifilter_url('status:2');?>" class="btn <?php  if($status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">进行中</a>
						<a href="<?php  echo ifilter_url('status:3');?>" class="btn <?php  if($status == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已完成</a>
						<a href="<?php  echo ifilter_url('status:4');?>" class="btn <?php  if($status == 4) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已取消</a>
					</div>
				</div>
			</div>
			<div class="pull-right">
				<div class="checkbox checkbox-inline btn-refresh" data-type="status_errander_refresh"><input type="checkbox" value="1" <?php  if($_GPC['_status_errander_refresh'] == 1) { ?>checked<?php  } ?>><label><span id="time-count"><span>30</span>秒</span>自动刷新</label></div>
				<div class="checkbox checkbox-inline btn-notice" data-type="status_errander_notice"><input type="checkbox" value="1" <?php  if($_GPC['_status_errander_notice'] == 1) { ?>checked<?php  } ?>><label>语音提示</label></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">支付状态</label>
			<div class="col-sm-9 col-xs-12">
				<div class="btn-group">
					<div class="btn-group">
						<a href="<?php  echo ifilter_url('is_pay:-1');?>" class="btn <?php  if($is_pay == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
						<a href="<?php  echo ifilter_url('is_pay:0');?>" class="btn <?php  if($is_pay == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未支付</a>
						<a href="<?php  echo ifilter_url('is_pay:1');?>" class="btn <?php  if($is_pay == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已支付</a>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">支付方式</label>
			<div class="col-sm-9 col-xs-12">
				<div class="btn-group">
					<div class="btn-group">
						<a href="<?php  echo ifilter_url('pay_type:');?>" class="btn <?php  if($pay_type == '') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
						<a href="<?php  echo ifilter_url('pay_type:wechat');?>" class="btn <?php  if($pay_type == 'wechat') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">微信支付</a>
						<a href="<?php  echo ifilter_url('pay_type:alipay');?>" class="btn <?php  if($pay_type == 'alipay') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">支付宝</a>
						<a href="<?php  echo ifilter_url('pay_type:credit');?>" class="btn <?php  if($pay_type == 'credit') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">余额支付</a>
						<a href="<?php  echo ifilter_url('pay_type:delivery');?>" class="btn <?php  if($pay_type == 'delivery') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">货到付款</a>
					</div>
				</div>
			</div>
		</div>
	<?php  } else if($filter_type == 'refund_status') { ?>
		<input type="hidden" name="refund_status" value="<?php  echo $re_status;?>"/>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">处理状态</label>
			<div class="col-sm-9 col-xs-12">
				<div class="btn-group">
					<div class="btn-group">
						<a href="<?php  echo ifilter_url('refund_status:1');?>" class="btn <?php  if($re_status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未处理</a>
						<a href="<?php  echo ifilter_url('refund_status:2');?>" class="btn <?php  if($re_status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">退款中</a>
						<a href="<?php  echo ifilter_url('refund_status:3');?>" class="btn <?php  if($re_status == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">退款成功</a>
					</div>
				</div>
			</div>
		</div>
	<?php  } ?>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">其他</label>
		<div class="col-sm-9 col-xs-12">
			<div style="display: inline-block">
				<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d H:i', $starttime), 'end' => date('Y-m-d H:i', $endtime)), true);?>
			</div>
			<input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="输入用户名/手机号/订单编号">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<button class="btn btn-primary">筛选</button>
		</div>
	</div>
</form>
<div class="clearfix order-list">
	<?php  if(!empty($orders)) { ?>
	<div class="col-md-8">
		<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
		<div class="panel-order">
			<div class="pay-info <?php  echo $order['pay_type_class'];?>"></div>
			<div class="panel-heading clearfix">
				<div class="order-info pull-left">
					<span class="serial-sn">
						#<strong><?php  echo $order['id'];?></strong>
					</span>
					<span class="send-time">
						<strong><?php  echo $order['delivery_time'];?></strong>
						<span class="grayest">（<?php  echo date('Y-m-d H:i', $order['addtime'])?> 下单）</span>
						<?php  if($order['is_pay'] == 1) { ?>
							<span><?php  echo $pay_types[$order['pay_type']]['text'];?></span>
						<?php  } ?>
					</span>
				</div>
				<div class="order-status pull-right"><strong class="<?php  echo $order_status[$order['status']]['color'];?>"><?php  echo $order_status[$order['status']]['text'];?></strong></div>
			</div>
			<?php  if($order['order_type'] == 'buy') { ?>
				<div class="user-info">
					<span class="highlight">购买商品：<?php  echo $order['goods_name'];?></span>
					<span class="orange">备注：</span><?php  if(!empty($order['note'])) { ?><?php  echo $order['note'];?><?php  } else { ?>无<?php  } ?>
					<?php  if(!empty($order['goods_price'])) { ?>
						<div class="user-location clearfix">
							<span>预期商品价格：<?php  echo $order['goods_price'];?>元</span>
						</div>
					<?php  } ?>
				</div>
				<div class="user-info">
					<span class="highlight">购买地址：<?php  if(!empty($order['buy_address'])) { ?><?php  echo $order['buy_address'];?><?php  } else { ?>用户未指定,您可以自由选择<?php  } ?></span>
				</div>
			<?php  } else { ?>
				<div class="user-info">
					<span class="highlight">商品信息：<?php  echo $order['goods_name'];?></span>
					<span class="user-phone"><?php  echo $order['goods_weight'];?>kg</span>
					<span class="orange">备注：</span><?php  if(!empty($order['note'])) { ?><?php  echo $order['note'];?><?php  } else { ?>无<?php  } ?>
					<?php  if(!empty($order['goods_price'])) { ?>
						<div class="user-location clearfix">
							<span>商品价值：<?php  echo $order['goods_price'];?>元</span>
						</div>
					<?php  } ?>
				</div>

				<div class="user-info">
					<span class="highlight">发货联系人：<?php  echo $order['buy_username'];?>(<?php  echo $order['buy_sex'];?>)</span>
					<span class="user-phone"><?php  echo $order['buy_mobile'];?></span>
					<div class="user-location clearfix">
						<span><?php  echo $order['buy_address'];?></span>
					</div>
				</div>
			<?php  } ?>
			<div class="user-info">
				<span class="highlight">收货人：<?php  echo $order['accept_username'];?>(<?php  echo $order['accept_sex'];?>)</span>
				<span class="user-phone"><?php  echo $order['accept_mobile'];?></span>
				<div class="user-location clearfix">
					<span><?php  echo $order['accept_address'];?></span>
				</div>
			</div>
			<?php  if($order['deliveryer_id'] > 0) { ?>
				<div class="delivery-info clearfix">
					<div class="highlight">配送:</div>
					<div class="deliveryer-info">
						<strong><?php  echo $deliveryers[$order['deliveryer_id']]['title'];?></strong> &nbsp; &nbsp;<?php  echo $deliveryers[$order['deliveryer_id']]['mobile'];?>
						<div class="status-info">
							<?php  if($order['delivery_status'] == 2) { ?>
								骑士已接单（接单时间：<?php  echo date('Y-m-d H:i', $order['delivery_assign_time'])?>）
							<?php  } else if($order['delivery_status'] == 3) { ?>
								骑士已取货（取货时间：<?php  echo date('Y-m-d H:i', $order['delivery_instore_time'])?>）
							<?php  } else if($order['delivery_status'] == 4) { ?>
								骑手已送达（送达时间：<?php  echo date('Y-m-d H:i', $order['delivery_success_time'])?>）
							<?php  } ?>
						</div>
					</div>
				</div>
			<?php  } ?>
			<div class="product-info">
				<p class="product-title">
					<span class="highlight">费用</span>
					<span class="pull-right greenest toggle-product">展开 <i class="icon icon-angle-up"></i></span>
				</p>
				<div class="product-display hide">
					<div class="list-item clearfix">
						<span class="pull-left">距离</span>
						<span class="pull-right">yen<?php  if(!empty($order['distance'])) { ?><?php  echo $order['distance'];?>km<?php  } else { ?>未知<?php  } ?></span>
					</div>
					<?php  if($order['delivery_fee'] > 0) { ?>
						<div class="list-item clearfix">
							<span class="pull-left">配送费</span>
							<span class="pull-right">yen<?php  echo $order['delivery_fee'];?></span>
						</div>
					<?php  } ?>
					<?php  if($order['delivery_tips'] > 0) { ?>
						<div class="list-item clearfix">
							<span class="pull-left">小费</span>
							<span class="pull-right">yen<?php  echo $order['delivery_tips'];?></span>
						</div>
					<?php  } ?>
					<div class="charge-info">
						<div class="charge-title clearfix">
							<div class="pull-left"><strong>小计</strong></div>
							<div class="pull-right">yen<?php  echo $order['total_fee'];?></div>
						</div>
						<div class="charge-title clearfix">
							<div class="pull-left"><strong>顾客实际支付</strong></div>
							<div class="pull-right">yen<?php  echo $order['final_fee'];?></div>
						</div>
					</div>
				</div>
			</div>
			<div class="btn-area">
				<?php  if($order['status'] < 3) { ?>
					<?php  if($order['status'] == 1) { ?>
						<a href="javascript:;" class="btn btn-primary btn-sm btn-dispatch" data-id="<?php  echo $order['id'];?>">调度</a>
					<?php  } else if($order['status'] == 2) { ?>
						<a href="javascript:;" class="btn btn-primary btn-sm btn-dispatch" data-id="<?php  echo $order['id'];?>">重新调度</a>
						<a href="<?php  echo iurl('errander/order/end', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定完成订单吗?">完成订单</a>
					<?php  } ?>
					<?php  if($order['is_pay'] == 1 && $order['pay_type'] != 'delivery') { ?>
						<a href="<?php  echo iurl('errander/order/cancel', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定取消订单并退款?">取消订单并退款</a>
					<?php  } else { ?>
						<a href="<?php  echo iurl('errander/order/cancel', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定取消订单?">取消订单</a>
					<?php  } ?>
				<?php  } ?>
				<?php  if($order['refund_status'] == 1) { ?>
					<a href="<?php  echo iurl('errander/order/refund_handle', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定发起退款吗?">发起退款</a>
					<a href="<?php  echo iurl('errander/order/refund_status', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定设置为已退款吗?">已退款</a>
				<?php  } else if($order['refund_status'] == 2) { ?>
					<a href="<?php  echo iurl('errander/order/refund_query', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-post">查询退款进度</a>
					<a href="<?php  echo iurl('errander/order/refund_status', array('id' => $order['id']));?>" class="btn btn-primary btn-sm js-post" data-confirm="确定设置为已退款吗?">已退款</a>
				<?php  } ?>
				<a href="<?php  echo iurl('errander/order/detail', array('id' => $order['id']));?>" target="_blank" class="btn btn-primary btn-sm">详情</a>
			</div>
		</div>
		<?php  } } ?>
	</div>
	<div class="col-md-4">
		<div class="panel panel-stat">
			<div class="panel-heading">
				<h3>当日订单概况</h3>
			</div>
			<div class="panel-body">
				<div class="col-md-6">
					<div class="title">已完成订单(笔)</div>
					<div class="num-wrapper">
						<a class="num" href="javascript:;"><?php  echo intval($stat['total_num']);?></a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="title">预计收入(元)</div>
					<div class="num-wrapper">
						<a class="num" href="javascript:;"><?php  echo round($stat['total_price'], 2);?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php  } else { ?>
		<div class="no-result">
			<p>还没有相关数据</p>
		</div>
	<?php  } ?>
	<div class="col-md-12">
		<?php  echo $pager;?>
	</div>
</div>

<div class="modal fade" id="order-dispatch">
	<div class="modal-dialog" style="width: 85%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">订单调度</h3>
			</div>
			<div class="modal-body" style="min-height: 530px">
				<form action="">
					<div class="col-lg-9">
						<div id="allmap" style="height: 500px">
						</div>
					</div>
					<div class="col-lg-3 table-responsive">
						<table class="table table-hover table-bordered">
							<thead>
							<th width="100"></th>
							<th>配送员</th>
							<th>操作</th>
							</thead>
							<tbody class="deliveryer-list">
							</tbody>
						</table>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>

<script id="tpl-deliveryer-list" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<tr>
		<td>
			<img src="<{d[i].avatar}>" class="thumbnail" alt=""/>
		</td>
		<td>
			<strong><{d[i].title}></strong>
		</td>
		<td>
			<a href="javascript:;" data-deliveryer-id="<{d[i].id}>" data-order-id="<{d[i].order_id}>" class="btn btn-primary btn-dispatch-submit">分配</a>
		</td>
	</tr>
	<tr>
		<td colspan="3">配送员-<strong class="text-danger"><{d[i].store2deliveryer_distance}></strong>-门店-<strong class="text-danger"><{d[i].store2user_distance}></strong>-收货人</td>
	</tr>
	<{# } }>
</script>
<script type="text/javascript" src="//webapi.amap.com/maps?v=1.4.1&key=550a3bf0cb6d96c3b43d330fb7d86950&plugin=AMap.Driving,AMap.Geocoder"></script>
<script>
irequire(['laytpl', 'tiny'], function(laytpl, tiny){
	var config = <?php  echo json_encode($_config_plugin);?>;
	var map = new AMap.Map('allmap', {
		resizeEnable: true,
		zoom: 13,
		center: [config.map.location_y, config.map.location_x]
	});
	var driving = new AMap.Driving({
		policy:AMap.DrivingPolicy.LEAST_TIME,
		map: map
	});

	$(document).on('click', '.product-title .toggle-product', function(){
		var $parent = $(this).parents('.panel-order');
		var is_hide = $('.product-display', $parent).hasClass('hide');
		if(is_hide) {
			$('.product-display', $parent).removeClass('hide');
			$(this).html('收起 <i class="icon icon-angle-up"></i>');
		} else {
			$('.product-display', $parent).addClass('hide');
			$(this).html('展开 <i class="icon icon-angle-down"></i>');
		}
	});

	$(document).on('click', '.btn-dispatch', function(){
		var id = $(this).data('id');
		$.post("<?php  echo iurl('errander/order/analyse')?>", {id: id}, function(data){
			var result = $.parseJSON(data);
			if(result.message.errno != 0) {
				Notify.error(result.message.message);
				return false;
			}
			var order = result.message.message;
			var gettpl = $('#tpl-deliveryer-list').html();
			laytpl(gettpl).render(order.deliveryers, function(html){
				$('#order-dispatch').find('.deliveryer-list').html(html);
			});
			if(order.buy_location_y && order.buy_location_x) {
				driving.search(new AMap.LngLat(order.buy_location_y, order.buy_location_x), new AMap.LngLat(order.accept_location_y, order.accept_location_x));
			} else {
				marker = new AMap.Marker({
					position: [order.accept_location_y, order.accept_location_x],
					offset: new AMap.Pixel(-27, -74),
					content: '<div class="marker-end-route"></div>'
				});
				marker.setMap(map);
			}
			$.each(order.deliveryers, function(k, v){
				var deliveryer = v;
				if(deliveryer.location_x && deliveryer.location_y) {
					marker = new AMap.Marker({
						position: [deliveryer.location_y, deliveryer.location_x],
						offset: new AMap.Pixel(-26, -80),
						content: '<div class="marker-deliveyer-route"><img src="'+ deliveryer.avatar +'" alt=""/></div>'
					});
					marker.setMap(map);
				}
			});
			$('#order-dispatch').modal('show');
		});
	});

	$(document).on('click', '.btn-dispatch-submit', function(){
		var order_id = $(this).data('order-id');
		var deliveryer_id = $(this).data('deliveryer-id');
		if(!order_id || !deliveryer_id) {
			return false;
		}
		util.loading();
		$.post("<?php  echo iurl('errander/order/dispatch')?>", {order_id: order_id, deliveryer_id: deliveryer_id}, function(data){
			var result = $.parseJSON(data);
			util.loaded();
			if(result.message.errno != 0) {
				Notify.error(result.message.message);
				return false;
			} else {
				location.reload();
			}
			$('#order-dispatch').modal('hide');
		});
	});

	$(document).on('click', '.item-deliveryer', function(){
		var deliveryer = $(this).data('info');
		if(!deliveryer) {
			Notify.error('配送员信息错误');
			return false;
		}
	});

	$('.btn-refresh, .btn-notice').click(function(){
		var type = $(this).data('type');
		var value = $(this).find(':checkbox').prop('checked') ? 0 : 1;
		$.post(location.href, {type: type, value: value}, function(){
			location.reload();
		});
		return false;
	});
	<?php  if($_GPC['_status_errander_refresh'] == 1) { ?>
		var sync = setInterval(function(){
			var time = parseInt($('#time-count span').html());
			if(time > 1) {
				time--;
				var html = '<span>' + time + '</span>'  + '秒后';
				$('#time-count').html(html);
			} else {
				location.reload();
			}
		}, 1000);
		if(!$('#time-count span').size()) {
			clearInterval(sync);
		}
	<?php  } ?>
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>