<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="clearfix order-detail">
	<div class="col-md-4 padding-0">
		<div class="panel panel-display">
			<div class="panel-heading"><h3>订单信息</h3></div>
			<div class="panel-body">
				<table class="table">
					<tr>
						<td width="130">订单编号：</td>
						<td><?php  echo $order['ordersn'];?></td>
					</tr>
					<tr>
						<td width="130">本平台支付单号：</td>
						<td><?php  echo $order['out_trade_no'];?></td>
					</tr>
					<tr>
						<td width="130">第三方支付单号：</td>
						<td><?php  echo $order['transaction_id'];?></td>
					</tr>
					<tr>
						<td>下单时间：</td>
						<td><?php  echo date('Y-m-d H:i', $order['addtime']);?></td>
					</tr>
					<tr>
						<td>订单状态：</td>
						<td><span class="<?php  echo $order_status[$order['status']]['css'];?>"><?php  echo $order_status[$order['status']]['text'];?></span></td>
					</tr>
					<tr>
						<td>配送时间：</td>
						<td><?php  echo $order['delivery_time'];?></td>
					</tr>
					<tr>
						<td>付款方式：</td>
						<td>
							<?php  if(!$order['is_pay']) { ?>
								<span class="label label-danger">未支付</span>
							<?php  } else { ?>
								<span class="<?php  echo $pay_types[$order['pay_type']]['css'];?>"><?php  echo $pay_types[$order['pay_type']]['text'];?></span>
							<?php  } ?>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="panel panel-display">
			<div class="panel-heading"><h3>订单日志</h3></div>
			<div class="panel-body">
				<table class="table">
					<?php  if(is_array($logs)) { foreach($logs as $log) { ?>
					<tr>
						<td>
							<p><i class="icon icon-info-circle"></i> <strong><?php  echo date('Y-m-d H:i', $log['addtime']);?> <?php  echo $log['title'];?></strong></p>
							<p style="padding-left:15px; "><?php  echo $log['note'];?></p>
						</td>
					</tr>
					<?php  } } ?>
				</table>
			</div>
		</div>
		<?php  if(!empty($refund_logs)) { ?>
		<div class="panel panel-display">
			<div class="panel-heading"><h3>退款日志</h3></div>
			<div class="panel-body">
				<table class="table">
					<?php  if(is_array($refund_logs)) { foreach($refund_logs as $log) { ?>
					<tr>
						<td>
							<p><i class="icon icon-info-circle"></i> <strong><?php  echo date('Y-m-d H:i', $log['addtime']);?> <?php  echo $log['title'];?></strong></p>
							<p style="padding-left:15px; "><?php  echo $log['note'];?></p>
						</td>
					</tr>
					<?php  } } ?>
				</table>
			</div>
		</div>
		<?php  } ?>
	</div>
	<div class="col-md-8 padding-r-0">
		<div class="panel panel-display">
			<div class="panel-heading"><h3>订单费用</h3></div>
			<div class="panel-body">
				<table class="table">
					<tr>
						<td width="130">配送距离：</td>
						<td><?php  if(!empty($order['distance'])) { ?><?php  echo $order['distance'];?>公里<?php  } else { ?>未知<?php  } ?></td>
					</tr>
					<tr>
						<td width="130">配送费：</td>
						<td>+￥ <?php  echo $order['delivery_fee'];?></td>
					</tr>
					<tr>
						<td width="130">总计算：</td>
						<td>
							￥ <?php  echo $order['final_fee'];?>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="panel panel-display">
			<div class="panel-heading"><h3>商品信息</h3></div>
			<div class="panel-body">
				<table class="table">
					<?php  if($order['order_type'] == 'buy') { ?>
						<tr>
							<td width="130">购买商品：</td>
							<td><?php  echo $order['goods_name'];?></td>
						</tr>
						<?php  if(!empty($order['thumbs'])) { ?>
							<tr>
								<td>顾客上传图片</td>
								<td>
									<?php  if(is_array($order['thumbs'])) { foreach($order['thumbs'] as $thumb) { ?>
										<a href="<?php  echo tomedia($thumb)?>">
											<img width="50" height="50" src="<?php  echo tomedia($thumb)?>" alt=""/>
										</a>
									<?php  } } ?>
								</td>
							</tr>
						<?php  } ?>
						<tr>
							<td width="130">备注：</td>
							<td><?php  if(!empty($order['note'])) { ?><?php  echo $order['note'];?><?php  } else { ?>无<?php  } ?></td>
						</tr>
						<tr>
							<td width="130">商品预期价格：</td>
							<td><?php  echo $order['goods_price'];?></td>
						</tr>
						<tr>
							<td width="130">购买地址：</td>
							<td><?php  if(!empty($order['buy_address'])) { ?><?php  echo $order['buy_address'];?><?php  } else { ?>用户未指定,您可以自由选择<?php  } ?></td>
						</tr>
						<tr>
							<td width="130">收货人：</td>
							<td><?php  echo $order['accept_username'];?>(<?php  echo $order['accept_sex'];?>), <?php  echo $order['accept_mobile'];?>, <?php  echo $order['accept_address'];?></td>
						</tr>
					<?php  } else { ?>
						<tr>
							<td width="130">商品信息：</td>
							<td><?php  echo $order['goods_name'];?></td>
						</tr>
						<tr>
							<td width="130">商品价值：</td>
							<td>￥ <?php  echo $order['goods_price'];?>, <?php  echo $order['goods_weight'];?> kg</td>
						</tr>
						<tr>
							<td width="130">取货联系人：</td>
							<td><?php  echo $order['buy_username'];?>(<?php  echo $order['buy_sex'];?>), <?php  echo $order['buy_mobile'];?>, <?php  echo $order['buy_address'];?></td>
						</tr>
						<tr>
							<td width="130">收货联系人：</td>
							<td><?php  echo $order['accept_username'];?>(<?php  echo $order['accept_sex'];?>), <?php  echo $order['accept_mobile'];?>, <?php  echo $order['accept_address'];?></td>
						</tr>
					<?php  } ?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>