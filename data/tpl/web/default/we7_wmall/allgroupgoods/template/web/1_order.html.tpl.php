<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('allgroupgoods/order');?>
	<input type="hidden" name="id" value="<?php  echo $record_id;?>">
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">支付状态</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a class="btn <?php  if(!$order_status) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('allgroupgoods/order/list')?>">不限</a>
				<!--<a class="btn <?php  if($order_status == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('allgroupgoods/order/list', array('order_status' => 0))?>">待支付</a>-->
				<a class="btn <?php  if($order_status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('allgroupgoods/order/list', array('order_status' => 1))?>">待发货</a>
				<a class="btn <?php  if($order_status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('allgroupgoods/order/list', array('order_status' => 2))?>">待收货</a>
				<a class="btn <?php  if($order_status == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('allgroupgoods/order/list', array('order_status' => 3))?>">待评价</a>
				<a class="btn <?php  if($order_status == 4) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('allgroupgoods/order/list', array('order_status' => 4))?>">已完成</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-4 col-xs-4">
			<input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="订单编号">
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
					<th>订单编号</th>
					<th>用户信息</th>
					<th>收件人信息</th>
					<th>收货地址</th>
					<th>商品信息</th>
					<th>支付方式</th>
					<th style="text-align: center">支付时间</th>
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
					<td><?php  echo $order['order_no'];?></td>
					<td>
						<img width="50" height="50" src="<?php  echo tomedia($order['avatar'])?>" alt=""/>
						<?php  echo $order['nickname'];?>
					</td>
					<td>
						<?php  echo $order['realname'];?><br>
						<?php  echo $order['mobile'];?>
					</td>
					<td><?php  echo $order['address'];?></td>
					<td>
						<img width="50" height="50" src="<?php  echo tomedia($order['thumb'])?>" alt=""/>
						<?php  echo $order['name'];?>
					</td>
					<td>
						<?php  if($order['is_pay'] == 1 && $order['pay_type']) { ?>
						<span><?php  if($order['pay_type']==1) { ?>支付宝<?php  } else if($order['pay_type']==2) { ?>微信<?php  } else { ?>余额<?php  } ?></span>
						<?php  } ?>
					</td>
					<td align="center"><?php  echo date('Y-m-d H:i:s', $order['pay_time'])?></td>
					<td align="right">
						<?php  if($order['status'] == 0) { ?>
						<span class="label label-danger">待支付</span>
						<?php  } else if($order['status'] == 1) { ?>
						<span class="label label-danger">待发货</span>
						<?php  } else if($order['status'] == 2) { ?>
						<span class="label label-danger">待收货</span>
						<?php  } else if($order['status'] == 3) { ?>
						<span class="label label-danger">待评价</span>
						<?php  } else if($order['status'] == 4) { ?>
						<span class="label label-success">已完成</span>
						<?php  } else { ?>
						<span class="label label-success">已取消</span>
						<?php  } ?>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<div class="pull-left">
					<!--<a href="<?php  echo iurl('allgroupgoods/order/handle')?>" class="btn btn-primary btn-sm js-batch" data-confirm="确认更改未处理订单的状态为已处理吗？">确认订单</a>-->
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
