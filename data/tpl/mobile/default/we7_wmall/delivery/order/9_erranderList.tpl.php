<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<style>
	input.modal-text-input2{margin-top:.25rem;}
	input.modal-text-input2+input.modal-text-input3{margin-top:.75rem;}
</style>
<div class="page" id="page-errander-order">
	<header class="bar bar-nav common-bar-nav">
		<a class="icon pull-left icon icon-arrow-left back hide"></a>
		<h1 class="title">社区订单<?php  if($status == 1 && $config_errander['auto_refresh'] == 1) { ?>(<span id="time">10</span>秒后自动刷新)<?php  } ?></h1>
	</header>
	<?php  include itemplate('public/nav', TEMPLATE_INCLUDEPATH);?>
	<div class="content infinite-scroll js-infinite" data-href="<?php  echo imurl('delivery/order/errander/more', array('status' => $status))?>" data-distance="50" data-min="<?php  echo $min;?>" data-container=".order-list-container" data-tpl="tpl-errander-order">
		<div class="buttons-tab">
			<a href="<?php  echo imurl('delivery/order/errander', array('status' => 1));?>" class="button <?php  if($status == 1) { ?>active<?php  } ?>">
				待抢
				<?php  if($num1['num'] > 0) { ?>
					<span class="num"><?php  echo $num1['num'];?></span>
				<?php  } ?>
			</a>
			<a href="<?php  echo imurl('delivery/order/errander', array('status' => 2));?>" class="button <?php  if($status == 2) { ?>active<?php  } ?>">
				待到达
				<?php  if($num2['num'] > 0) { ?>
					<span class="num"><?php  echo $num2['num'];?></span>
				<?php  } ?>
			</a>
			<a href="<?php  echo imurl('delivery/order/errander', array('status' => 3));?>" class="button <?php  if($status == 3) { ?>active<?php  } ?>">
				进行中
				<?php  if($num3['num'] > 0) { ?>
					<span class="num"><?php  echo $num3['num'];?></span>
				<?php  } ?>
			</a>
			<a href="<?php  echo imurl('delivery/order/errander', array('status' => 4));?>" class="button <?php  if($status == 4) { ?>active<?php  } ?>">
				已成功
			</a>
		</div>
		<?php  if(empty($orders)) { ?>
		<div class="no-data">
			<div class="bg"></div>
			<?php  if($status == 1) { ?>
				<?php  if($_W['deliveryer']['work_status'] == 1) { ?>
					<?php  if(!$can_collect_order) { ?>
						<p>当前调度模式不允许抢单,请等待管理员或系统派单</p>
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
			<?php  if($status == 1) { ?>
			<ul class="order-list-container">
				<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
				<li class="row delivery-wait">
					<div class="order-ls-info col-80">
						<p>编号: <b class="color-danger" style="font-size: .8rem;">#<?php  echo $order['id'];?></b></p>
						<?php  if($order['order_type'] == 'errand') { ?>
							<p>商品名称: <?php  echo $order['goods_name'];?></p>
							<!--<p>预期商品价格: <?php  echo $order['goods_price'];?></p>-->
							<!--<p>购买地址: <?php  echo $order['buy_address'];?></p>-->
						<?php  } else { ?>
							<p>备注: <?php  echo $order['note'];?></p>
							<!--<p>取货地址: <?php  echo $order['buy_address'];?></p>-->
						<?php  } ?>
						<p><?php  if($order['order_type'] == 'errand') { ?>收货地址<?php  } else if($order['order_type'] == 'pickup') { ?>收取地址<?php  } else { ?>上门地址<?php  } ?>: <?php  echo $order['accept_address'];?></p>
						<p>下单时间: <?php  echo date('Y-m-d H:i:s', $order['addtime'])?></p>
						<!-- <p>费用: <?php  echo $order['deliveryer_total_fee'];?>元</p> -->
						<!-- <?php  echo $order['order_type_bg'];?> -->
						<div class="order-type"><?php  echo $order['order_type_cn'];?>:<?php  echo $order['title'];?></div>
					</div>
					<div class="order-ls-btn border-1px-t col-20">
						<a href="<?php  echo imurl('delivery/order/errander/collect', array('id' => $order['id']))?>" class="js-post" data-confirm="该跑腿订单配送完成后将获得<?php  echo $order['deliveryer_total_fee'];?>元配送费, 确定接单吗?">抢</a>
					</div>
				</li>
				<?php  } } ?>
			</ul>
			<?php  } else { ?>
			<ul>
				<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
				<li class="delivery-others border-1px-tb">
					<!--<div class="order-type <?php  echo $order['order_type_bg'];?>"><?php  echo $order['order_type_cn'];?>-<?php  echo $order['title'];?></div>-->
					<a class="order-ls-info external" href="<?php  echo imurl('delivery/order/errander/detail', array('id' => $order['id']))?>">
						<div class="order-ls-tl">编号: <b class="color-danger" style="font-size: .8rem">#<?php  echo $order['id'];?></b><span class="<?php  echo $order['delivery_status_color'];?>"><?php  echo $order['delivery_status_cn'];?></span></div>
						<div class="order-type"><?php  echo $order['order_type_cn'];?>:<?php  echo $order['title'];?></div>
						<div class="order-ls-date"><?php  echo date('Y-m-d H:i', $order['addtime']);?><span>联系人:<?php  echo $order['accept_username'];?></span></div>
						<div class="order-ls-dl border-1px-tb">
							<?php  if($order['order_type'] == 'errand') { ?>
								<div class="row">
									<div class="col-25">商品名称:</div>
									<div class="col-75 align-right"><?php  echo $order['goods_name'];?></div>
								</div>
								<!--<div class="row">-->
									<!--<div class="col-25">预期商品价格:</div>-->
									<!--<div class="col-75 align-right"><?php  echo $order['goods_price'];?>元</div>-->
								<!--</div>-->
								<div class="row">
									<div class="col-25">取货地址:</div>
									<div class="col-75 align-right"><?php echo empty($order['buy_address'])?'无':$order['buy_address']?></div>
								</div>
							<?php  } else if($order['order_type'] == 'express') { ?>
								<div class="row">
									<div class="col-25">收货人姓名:</div>
									<div class="col-75 align-right"><?php  echo $order['buy_username'];?></div>
								</div>
								<div class="row">
									<div class="col-25">收货人电话:</div>
									<div class="col-75 align-right"><?php  echo $order['buy_mobile'];?></div>
								</div>
								<div class="row">
									<div class="col-25">收货人地址:</div>
									<div class="col-75 align-right"><?php  echo $order['buy_address'];?></div>
								</div>
								<?php  if($status == 4) { ?>
									<div class="row">
										<div class="col-25">快递公司:</div>
										<div class="col-75 align-right"><?php  echo $order['express'];?></div>
									</div>
									<div class="row">
										<div class="col-25">快递单号:</div>
										<div class="col-75 align-right"><?php  echo $order['code'];?></div>
									</div>
								<?php  } ?>
								<div class="row">
									<div class="col-25">备注:</div>
									<div class="col-75 align-right"><?php  echo $order['note'];?></div>
								</div>
							<?php  } else { ?>
								<div class="row">
									<div class="col-25">备注:</div>
									<div class="col-75 align-right"><?php  echo $order['note'];?></div>
								</div>
							<?php  } ?>
							<div class="row">
								<div class="col-25"><?php  if($order['order_type'] == 'errand') { ?>收货地址<?php  } else if($order['order_type'] == 'pickup') { ?>收取地址<?php  } else { ?>上门地址<?php  } ?>: </div>
								<div class="col-75 align-right"><?php  echo $order['accept_address'];?></div>
							</div>
							<div class="row">
								<div class="col-25">手机:</div>
								<div class="col-75 align-right"><?php  echo $order['accept_mobile'];?></div>
							</div>
						</div>
						<?php  if($order['order_type'] != 'pickup') { ?>
						<div class="order-ls-sum">可获:<span class="color-danger">￥<?php  echo $order['deliveryer_total_fee'];?></span>(费用￥<?php  echo $order['deliveryer_fee'];?> + 小费￥<?php  echo $order['delivery_tips'];?>)</div>
						<?php  } ?>
						<?php  if($order['transfer_delivery_status'] == 1) { ?>
							<div class="transfer-reason">转单原因：<?php  echo $order['transfer_delivery_reason'];?></div>
						<?php  } ?>
					</a>
					<?php  if($order['transfer_delivery_status'] == 1) { ?>
						<div class="order-ls-btn border-1px-t">
							<a href="<?php  echo imurl('delivery/order/errander/direct_transfer_reply', array('id' => $order['id'], 'result' => 'agree'))?>" data-confirm="确定接受吗?" class="js-post border-1px-r">接受转单</a>
							<a href="<?php  echo imurl('delivery/order/errander/direct_transfer_reply', array('id' => $order['id'], 'result' => 'refuse'))?>" data-confirm="确定拒绝吗?" class="js-post">拒绝转单</a>
						</div>
					<?php  } else { ?>
						<?php  if($order['delivery_status'] == 2) { ?>
							<div class="order-ls-btn border-1px-t">

									<a href="tel:<?php  echo $order['accept_mobile'];?>" class="col-33 border-1px-r">呼叫联系人</a>

									<!--<a href="tel:<?php  echo $order['buy_mobile'];?>" class="col-33 border-1px-r">呼叫取货联系人</a>-->

								<a href="http://m.amap.com/?q=<?php  echo $order['buy_location_x'];?>,<?php  echo $order['buy_location_y'];?>&name=<?php  echo $order['buy_address'];?>" data-location-x="<?php  echo $order['buy_location_x'];?>" class="order-errander-navigation border-1px-r col-33">导航</a>
								<a href="<?php  echo imurl('delivery/order/errander/instore', array('id' => $order['id']))?>" data-confirm="确定已到达上门地址?" class="col-33 js-post">我已到达</a>
							</div>
						<?php  } else if($order['delivery_status'] == 3) { ?>
							<div class="order-ls-btn border-1px-t">
								<a href="tel:<?php  echo $order['accept_mobile'];?>" class="col-33 border-1px-r">呼叫联系人</a>
								<a href="http://m.amap.com/?q=<?php  echo $order['accept_location_x'];?>,<?php  echo $order['accept_location_y'];?>&name=<?php  echo $order['accept_address'];?>" data-location-x="<?php  echo $order['accept_location_x'];?>" class="order-errander-navigation col-33 border-1px-r">导航</a>
								<a href="javascript:;" class="order-errander-success col-33" data-id="<?php  echo $order['id'];?>" data-vcode="<?php  echo $order['verification_code'];?>" data-type="<?php  echo $order['order_type'];?>">确认</a>
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
<script id="tpl-errander-order" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<li class="delivery-others border-1px-tb">
		<!--<div class="order-type <{d[i].order_type_bg}>"><{d[i].order_type_cn}>-<{d[i].title}></div>-->
		<a class="order-ls-info external" href="<?php  echo imurl('delivery/order/errander/detail');?>&id=<{d[i].id}>">
			<div class="order-ls-tl">编号: <b class="color-danger" style="font-size: .8rem"># <{d[i].id}></b><span class="<{d[i].delivery_status_color}>"><{d[i].delivery_status_cn}></span></div>
			<div class="order-type"><?php  echo $order['order_type_cn'];?>:<?php  echo $order['title'];?></div>
			<div class="order-ls-date"><{d[i].addtime}><span>收货人:<{d[i].accept_username}></span></div>
			<div class="order-ls-dl border-1px-tb">
				<{# if(d[i].order_type == 'buy') { }>
					<div class="row">
						<div class="col-25">购买商品:</div>
						<div class="col-75 align-right"><{d[i].goods_name}></div>
					</div>
					<div class="row">
						<div class="col-25">预期商品价格:</div>
						<div class="col-75 align-right"><{d[i].goods_price}></div>
					</div>
					<div class="row">
						<div class="col-25">购买地址:</div>
						<div class="col-75 align-right"><{d[i].buy_address}></div>
					</div>
				<{# } else { }>
					<div class="row">
						<div class="col-25">物品信息:</div>
						<div class="col-75 align-right"><{d[i].goods_name}></div>
					</div>
					<div class="row">
						<div class="col-25">取货地址:</div>
						<div class="col-75 align-right"><{d[i].buy_address}></div>
					</div>
					<div class="row">
						<div class="col-25">物品价值:</div>
						<div class="col-75 align-right"><{d[i].goods_price}>元</div>
					</div>
					<div class="row">
						<div class="col-25">物品重量:</div>
						<div class="col-75 align-right"><{d[i].goods_weight}>kg</div>
					</div>
				<{#  } }>
				<div class="row">
					<div class="col-25">送货地址:</div>
					<div class="col-75 align-right"><{d[i].accept_address}></div>
				</div>
				<div class="row">
					<div class="col-25">手机号:</div>
					<div class="col-75 align-right"><{d[i].accept_mobile}></div>
				</div>
			</div>
			<div class="order-ls-sum">可获配送费:<span class="color-danger">￥<{d[i].deliveryer_total_fee}></span>(配送费￥<{d[i].deliveryer_fee}> + 小费￥<{d[i].delivery_tips}>)</div>
			<{# if(d[i].transfer_delivery_status == 1) { }>
				<div class="transfer-reason">转单原因：<{d[i].transfer_delivery_reason}></div>
			<{#  } }>
		</a>
		<{# if(d[i].transfer_delivery_status == 1) { }>
			<div class="order-ls-btn border-1px-t">
				<a href="<?php  echo imurl('delivery/order/errander/direct_transfer_reply');?>&id=<{d[i].id}&result=agree>" data-confirm="确定接受转单吗?" class="js-post border-1px-r">接受转单</a>
				<a href="<?php  echo imurl('delivery/order/errander/direct_transfer_reply');?>&id=<{d[i].id}&result=refuse>"  data-confirm="确定拒绝转单吗" class="js-post">拒绝转单</a>
			</div>
		<{# } else { }>
			<{# if(d[i].delivery_status == 2) { }>
				<div class="order-ls-btn border-1px-t">
					<{# if(d[i].order_type == 'buy') { }>
						<a href="tel:<{d[i].accept_mobile}>" class="col-33 border-1px-r">呼叫收货人</a>
					<{# } else { }>
						<a href="tel:<{d[i].buy_mobile}> border-1px-r" class="col-33">呼叫取货联系人</a>
					<{# } }>
					<a href="http://m.amap.com/?q=<{d[i].buy_location_x}>,<{d[i].buy_location_y}>&name=<{d[i].buy_address}>" data-location-x="<{d[i].buy_location_x}>" class="order-errander-navigation border-1px-r col-33">导航</a>
					<a href="<?php  echo imurl('delivery/order/errander/instore')?>&id=<{d[i].id}>" data-confirm="确定已取到物品?" class="js-post col-33">我已取货</a>
				</div>
			<{# } else if(d[i].delivery_status == 3) { }>
				<div class="order-ls-btn border-1px-t">
					<a href="tel:<{d[i].accept_mobile}>" class="col-33 border-1px-r">呼叫收货人</a>
					<a href="http://m.amap.com/?q=<{d[i].accept_location_x}>,<{d[i].accept_location_y}>&name=<{d[i].accept_address}>" data-location-x="<{d[i].accept_location_x}>" class="order-errander-navigation border-1px-r col-33">导航</a>
					<a href="javascript:;" class="order-errander-success col-33" data-id="<{d[i].id}>" data-vcode="<{d[i].verification_code}>">确认送达</a>
				</div>
			<{# } }>
		<{# } }>
	</li>
	<{# } }>
</script>
<script>
$(function(){
	$(document).on("click", ".order-errander-success", function() {
		var id = $(this).data('id');
		if(!id) {
			return false;
		}
		var codeNum = $(this).data('vcode');
		var type = $(this).data('type');
		function Vcode(id, code){
			if(!id) {
				return false;
			} else {
				$.post("<?php  echo imurl('delivery/order/errander/success')?>", {id: id, code: code}, function(data){
					var result = $.parseJSON(data);
					if(result.message.errno != 0) {
						$.toast(result.message.message);
					} else {
						$.toast(result.message.message, location.href);
					}
				});
			}
			
		}
		if (type == 'express'){
            $.prompt2('', function(value){
                var val_arr = value.split(',');
                if(!val_arr[0]) {
                	$.toast('请输入快递公司名称');
                	return false;
                } else if(!val_arr[1]) {
                	$.toast('请输入快递单号');
                	return false;
                } else {
                	var data = { "code": val_arr[1], "express": val_arr[0] };
                	Vcode(id, data);
                }
            });
            return;
        }

        if (type == 'pickup'){
            $.prompt('请输入废品回收费用', function(value){
                if(!value) {
                    return false;
                }
                if(isNaN(value)){
                    $.toast('请输入数字');
                    return false;
                }
                if(value<=0){
                    $.toast('请输入正数');
                    return false;
                }
                var code = value;
                Vcode(id, code);
            });
            return;
        }

		if(codeNum == 1) {
			$.prompt('请输入收货码(4位数字)', function(value){
				if(!value) {
					$.toast('请联系顾客索要收货码');
					return false;
				}
				var code = value;
				Vcode(id, code);
			});
		} else {
			Vcode(id, 0);
		}
	});

	$(document).on("click", ".order-errander-navigation", function() {
		var location_x = $(this).data('location-x');
		if(!location_x) {
			$.toast('地址信息不详细，无法导航');
			$.hideIndicator();
			return false;
		}
		return true;
	});

	//自动刷新
	<?php  if($status == 1 && $config_errander['auto_refresh'] == 1) { ?>
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
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>