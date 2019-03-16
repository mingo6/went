<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page order-info" id="page-delivery-order">
	<header class="bar bar-nav common-bar-nav">
		<a class="icon icon icon-arrow-left pull-left external" href="<?php  echo imurl('delivery/order/errander');?>"></a>
		<h1 class="title">跑腿订单</h1>
		<a class="icon tel pull-right external" href="tel:<?php  echo $store['telephone'];?>"></a>
	</header>
	<?php  if($order['delivery_status'] == 2) { ?>
		<nav class="bar bar-tab footer-bar">
				<a href="tel:<?php  echo $order['accept_mobile'];?>" class="tab-item">
					<span class="tab-label">呼叫联系人</span>
				</a>
			<?php  if($order['deliveryer_transfer_status'] == 1) { ?>
				<a class="tab-item js-modal" href="<?php  echo imurl('delivery/order/errander/op', array('type' => 'transfer', 'id' => $order['id']));?>">
					<span class="tab-label">申请转单</span>
				</a>
			<?php  } ?>
			<a href="<?php  echo imurl('delivery/order/errander/instore', array('id' => $order['id']))?>" data-confirm="确定已取到物品?" class="tab-item js-post">
				<span class="tab-label">我已取货</span>
			</a>
		</nav>
	<?php  } else if($order['delivery_status'] == 3) { ?>
		<nav class="bar bar-tab footer-bar">
			<a href="tel:<?php  echo $order['accept_mobile'];?>" class="tab-item">
				<span class="tab-label">呼叫联系人</span>
			</a>
			<?php  if($order['deliveryer_transfer_status'] == 1) { ?>
				<a class="tab-item js-modal" href="<?php  echo imurl('delivery/order/errander/op', array('type' => 'transfer', 'id' => $order['id']));?>">
					<span class="tab-label">申请转单</span>
				</a>
			<?php  } ?>
			<a href="javascript:;" class="tab-item order-errander-success" data-id="<?php  echo $order['id'];?>" data-vcode="<?php  echo $order['verification_code'];?>">
				<span class="tab-label">确认送达</span>
			</a>
		</nav>
	<?php  } ?>
	<div class="content">
		<div id="order-detail" class="tab active">
			<div class="order-state border-1px-tb">
				<div class="order-state-con">
					<div class="guide">
						<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/order_status_service.png" alt="" />
					</div>
					<div class="order-state-detail">
						<div class="clearfix">订单<?php  echo $order['delivery_status_cn'];?><span class="pull-right date"><?php  echo date('H:i', $order['addtime']);?></span></div>
						<div class="tips clearfix"><?php  echo $log['note'];?></div>
					</div>
				</div>
			</div>
			<div class="content-block-title">订单收入</div>
			<div class="list-block other-info" style="margin: 0">
				<ul class="border-1px-tb">
                    <?php  if($order['order_type'] != 'pickup') { ?>
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">费用</div>
							<div class="item-after">￥<?php  echo $order['deliveryer_fee'];?></div>
						</div>
					</li>
                    <?php  } ?>
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">小费</div>
							<div class="item-after">￥<?php  echo $order['delivery_tips'];?></div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title">本单收入</div>
							<div class="item-after">￥<?php  echo $order['deliveryer_total_fee'];?></div>
						</div>
					</li>
				</ul>
			</div>
			<div class="content-block-title">信息</div>
			<div class="list-block other-info" style="margin: 0">
				<ul class="border-1px-tb">
					<?php  if($order['order_type'] == 'errand') { ?>
						<li class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title">商品名称</div>
								<div class="item-after"><?php  echo $order['goods_name'];?></div>
							</div>
						</li>
						<li class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title">购买地址</div>
								<div class="item-after"><?php  echo $order['buy_address'];?></div>
							</div>
						</li>
						<li class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title">商品预期价格</div>
								<div class="item-after"><?php  echo $order['goods_price'];?></div>
							</div>
						</li>
					<?php  } else { ?>
						<li class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title">备注</div>
								<div class="item-after"><?php  echo $order['note'];?></div>
							</div>
						</li>
						<!--<li class="item-content">-->
							<!--<div class="item-inner border-1px-b">-->
								<!--<div class="item-title">取货地址</div>-->
								<!--<div class="item-after"><?php  echo $order['buy_address'];?></div>-->
							<!--</div>-->
						<!--</li>-->
						<!--<li class="item-content">-->
							<!--<div class="item-inner border-1px-b">-->
								<!--<div class="item-title">物品价值</div>-->
								<!--<div class="item-after"><?php  echo $order['goods_price'];?></div>-->
							<!--</div>-->
						<!--</li>-->
						<!--<li class="item-content">-->
							<!--<div class="item-inner border-1px-b">-->
								<!--<div class="item-title">物品重量</div>-->
								<!--<div class="item-after"><?php  echo $order['goods_weight'];?></div>-->
							<!--</div>-->
						<!--</li>-->
					<?php  } ?>
					<?php  if(!empty($order['data']['order'])) { ?>
						<?php  if(!empty($order['data']['order']['partData'])) { ?>
							<?php  if(is_array($order['data']['order']['partData'])) { foreach($order['data']['order']['partData'] as $item) { ?>
								<li class="item-content">
									<div class="item-inner border-1px-b">
										<div class="item-title"><?php  echo $item['title'];?></div>
										<?php  if($item['type'] != 'multipleChoices') { ?>
											<div class="item-after"><?php  echo $item['value'];?></div>
										<?php  } else { ?>
											<div class="item-after">
												<?php  if(is_array($item['value'])) { foreach($item['value'] as $da) { ?>
													<span><?php  echo $da;?></span>
												<?php  } } ?>
											</div>
										<?php  } ?>
									</div>
								</li>
							<?php  } } ?>
						<?php  } ?>
						<?php  if(!empty($order['data']['order']['extra_fee'])) { ?>
							<?php  if(is_array($order['data']['order']['extra_fee'])) { foreach($order['data']['order']['extra_fee'] as $item) { ?>
								<li class="item-content">
									<div class="item-inner border-1px-b">
										<div class="item-title"><?php  echo $item['title'];?></div>
										<div class="item-after">
											<?php  if(is_array($item['value'])) { foreach($item['value'] as $da) { ?>
												<span><?php  echo $da['name'];?></span>
											<?php  } } ?>
										</div>
									</div>
								</li>
							<?php  } } ?>
						<?php  } ?>
					<?php  } ?>
					<?php  if(!empty($order['thumbs'])) { ?>
						<li class="item-content">
							<div class="item-inner customer-thumb border-1px-t">
								<div class="item-title">顾客上传的图片</div>
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
				<?php  if($order['order_type'] != 'buy') { ?>
					<!--<div class="table border-no">-->
						<!--<a href="tel:<?php  echo $order['buy_mobile'];?>" class="table-cell external">呼叫取货联系人</a>-->
						<!--<a href="javascript:;" class="table-cell external border-1px-l js-location" data-lat="<?php  echo $order['buy_location_x'];?>" data-lng="<?php  echo $order['buy_location_y'];?>" data-name="<?php  echo $order['buy_address'];?>">导航</a>-->
					<!--</div>-->
				<?php  } ?>
			</div>
			<div class="content-block-title"><?php  if($order['order_type'] == 'errand') { ?>收货地址<?php  } else if($order['order_type'] == 'pickup') { ?>收取地址<?php  } else { ?>上门地址<?php  } ?></div>
			<div class="list-block other-info border-1px-tb" style="margin: 0">
				<ul class="border-1px-b">
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title"><?php  if($order['order_type'] == 'errand') { ?>收货地址<?php  } else if($order['order_type'] == 'pickup') { ?>收取地址<?php  } else { ?>上门地址<?php  } ?></div>
							<div class="item-after"><?php  echo $order['accept_address'];?></div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title">联系人</div>
							<div class="item-after"><?php  echo $order['accept_mobile'];?></div>
						</div>
					</li>
				</ul>
				<div class="table border-no border-1px-b">
					<a href="tel:<?php  echo $order['accept_mobile'];?>" class="table-cell external border-1px-r">呼叫联系人</a>
					<a href="javascript:;" class="table-cell external border-1px-l js-location" data-lat="<?php  echo $order['accept_location_x'];?>" data-lng="<?php  echo $order['accept_location_y'];?>" data-name="<?php  echo $order['accept_address'];?>">导航</a>
				</div>
			</div>
			<div class="content-block-title">其他信息</div>
			<div class="list-block other-info">
				<ul class="border-1px-tb">
					<!--<li class="item-content">-->
						<!--<div class="item-inner border-1px-b">-->
							<!--<div class="item-title">订单来源</div>-->
							<!--<div class="item-after"><?php  echo $order['delivery_collect_type_cn'];?></div>-->
						<!--</div>-->
					<!--</li>-->
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title"><?php  if($order['order_type'] == 'errand') { ?>配送时间<?php  } else if($order['order_type'] == 'pickup') { ?>收取时间<?php  } else if($order['order_type'] == 'delivery') { ?>维修时间<?php  } else if($order['order_type'] == 'buy') { ?>服务时间<?php  } ?></div>
							<div class="item-after"><?php  echo $order['delivery_time'];?></div>
						</div>
					</li>
					<?php  if($order['deliveryer_id'] > 0) { ?>
						<li class="item-content">
							<div class="item-inner border-1px-b">
								<div class="item-title"><?php  if($order['order_type'] == 'errand') { ?>社区跑腿员<?php  } else if($order['order_type'] == 'pickup') { ?>废品回收员<?php  } else if($order['order_type'] == 'delivery') { ?>家电维修员<?php  } else if($order['order_type'] == 'buy') { ?>家政服务员<?php  } ?></div>
								<div class="item-after"><?php  echo $_deliveryer['title'];?></div>
							</div>
						</li>
					<?php  } ?>
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">订单号</div>
							<div class="item-after"><?php  echo $order['order_sn'];?></div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">下单时间</div>
							<div class="item-after"><?php  echo date('Y-m-d H:i:s', $order['addtime']);?></div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner border-1px-b">
							<div class="item-title">支付方式</div>
							<div class="item-after"><?php  echo $order['pay_type_cn'];?></div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title">备注信息</div>
							<div class="item-after"><?php  if(empty($order['note'])) { ?>无<?php  } else { ?><?php  echo $order['note'];?><?php  } ?></div>
						</div>
					</li>
				</ul>
				<div class="content-padded">
					<?php  if($order['deliveryer_transfer_status'] == 1) { ?>
						<a class="button button-fill button-success button-big margin-10px-t js-modal" href="<?php  echo imurl('delivery/order/errander/op', array('type' => 'transfer', 'id' => $order['id']));?>">
							<span class="tab-label">申请转单</span>
						</a>
						<a class="button button-fill button-success button-big margin-10px-t js-modal" href="<?php  echo imurl('delivery/order/errander/op', array('type' => 'direct_transfer', 'id' => $order['id']));?>">
							定向转单
						</a>
					<?php  } ?>
					<?php  if($order['deliveryer_cancel_status'] == 1) { ?>
						<a class="button button-fill button-danger button-big margin-10px-t js-modal" href="<?php  echo imurl('delivery/order/errander/op', array('type' => 'cancel', 'id' => $order['id']));?>">
							<span class="tab-label">取消订单</span>
						</a>
					<?php  } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){

	$(document).on("click", ".order-errander-success", function() {
		var id = $(this).data('id');
		if(!id) {
			return false;
		}
		var codeNum = $(this).data('vcode');
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
	$(document).on('click', '.btn-user-location', function(e){
		var location_x = $(this).data('location-x');
		var location_y = $(this).data('location-y');
		if(!location_x || !location_y) {
			$.toast('获取顾客位置失败');
			e.preventDefault();
			return false;
		}
	});
});
</script>

<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>