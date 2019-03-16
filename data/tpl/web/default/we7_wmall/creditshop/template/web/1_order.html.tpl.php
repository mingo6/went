<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('creditshop/order');?>
	<input type="hidden" name="id" value="<?php  echo $record_id;?>">
	<div class="alert alert-info">注意：积分商城目前仅支持小程序版本,不支持公众号版本</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品类型</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a class="btn <?php  if(!$goods_type) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('creditshop/order/list')?>">不限</a>
				<a class="btn <?php  if($goods_type == 'goods') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('creditshop/order/list', array('goods_type' => 'goods'))?>">商品</a>
				<a class="btn <?php  if($goods_type == 'credit2') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('creditshop/order/list', array('goods_type' => 'credit2'))?>">余额</a>
				<a class="btn <?php  if($goods_type == 'redpacket') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('creditshop/order/list', array('goods_type' => 'redpacket'))?>">红包</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">兑换时间</label>
		<div class="col-sm-4 col-xs-4">
			<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d  H:i', $starttime), 'end' => date('Y-m-d H:i', $endtime)), true);?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-4 col-xs-4">
			<input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="搜索的昵称、收件人姓名、手机号">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-4 col-xs-4">
			<input type="submit" value="筛选" class="btn btn-primary">
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($orders)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead>
					<tr>
						<th width="40">
							<div class="checkbox checkbox-inline">
								<input type="checkbox">
								<label></label>
							</div>
						</th>
						<th>ID</th>
						<th>兑换用户信息</th>
						<th>收件人信息</th>
						<th>商品信息</th>
						<th style="text-align:center;">商品类型 <br>兑换码</th>
						<th style="text-align:center;">消耗积分+消耗余额</th>
						<th>支付状态</th>
						<th>支付方式</th>
						<th style="text-align: center">兑换时间</th>
						<th style="text-align: right">订单状态</th>
					</tr>
					</thead>
					<tbody>
						<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
							<tr>
								<td>
									<div class="checkbox checkbox-inline">
										<input type="checkbox" name="ids[]" value="<?php  echo $order['id'];?>">
										<label></label>
									</div>
								</td>
								<td><?php  echo $order['id'];?></td>
								<td>
									<img width="50" height="50" src="<?php  echo tomedia($order['avatar'])?>" alt=""/>
									<?php  echo $order['nickname'];?>
								</td>
								<td>
									<?php  echo $order['username'];?><br>
									<?php  echo $order['mobile'];?>
								</td>
								<td>
									<img width="50" height="50" src="<?php  echo tomedia($order['thumb'])?>" alt=""/>
									<?php  echo $order['title'];?>
								</td>
								<td style="text-align:center;">
									<?php  if($order['goods_type'] == 'goods') { ?>
									商品
									<?php  } else if($order['goods_type'] == 'credit2') { ?>
									余额
									<?php  } else { ?>
									红包
									<?php  } ?>
									<br>
									<?php  echo $order['code'];?>
								</td>
								<td style="text-align:center;">
									<?php  echo $order['use_credit1'];?>积分
									<?php  if($order['use_credit2'] > 0) { ?>
										+yen<?php  echo $order['use_credit2'];?>
									<?php  } ?>
								</td>
								<td>
									<?php  if($order['is_pay'] == 1) { ?>
										<span class="label label-success">已支付</span>
									<?php  } else { ?>
										<span class="label label-danger">未支付</span>
									<?php  } ?>
								</td>
								<td>
									<?php  if($order['is_pay'] == 1 && $order['pay_type']) { ?>
										<span><?php  echo $pay_types[$order['pay_type']]['text'];?></span>
									<?php  } ?>
								</td>
								<td align="center"><?php  echo date('Y-m-d H:i:s', $order['addtime'])?></td>
								<td align="right">
									<?php  if($order['status'] == 1) { ?>
									<span class="label label-danger">未处理</span>
									<?php  } else { ?>
									<span class="label label-success">已处理</span>
									<?php  } ?>
								</td>
							</tr>
						<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-left">
						<a href="<?php  echo iurl('creditshop/order/handle')?>" class="btn btn-primary btn-sm js-batch" data-confirm="确认更改未处理订单的状态为已处理吗？">确认订单</a>
					</div>
					<div class="pull-right">
						<?php  echo $pager;?>
					</div>
				</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
