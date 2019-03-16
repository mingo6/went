<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'stat') { ?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('order/records/stat');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">下单时间</label>
		<div class="col-sm-4 col-xs-4">
			<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d H:i', $starttime), 'end' => date('Y-m-d H:i', $endtime)));?>
		</div>
	</div>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">其他</label>
		<div class="col-sm-4 col-xs-4">
			<?php  if($_W['is_agent']) { ?>
				<select name="agentid" class="select2 js-select2 form-control width-130">
					<option value="0">选择代理区域</option>
					<?php  if(is_array($_W['agents'])) { foreach($_W['agents'] as $agent) { ?>
						<option value="<?php  echo $agent['id'];?>" <?php  if($agentid == $agent['id']) { ?>selected<?php  } ?>><?php  echo $agent['area'];?></option>
					<?php  } } ?>
				</select>
			<?php  } ?>
			<select name="deliveryer_id" id="deliveryer_id" class="select2 js-select2 form-control width-130">
				<option value="">选择配送员</option>
				<?php  if(is_array($deliveryer_alls)) { foreach($deliveryer_alls as $alls) { ?>
					<option value="<?php  echo $alls['id'];?>" <?php  if($alls['id'] == $deliveryer_id) { ?>selected<?php  } ?>><?php  echo $alls['title'];?></option>
				<?php  } } ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-4 col-xs-4">
			<input type="submit" value="筛选" class="btn btn-primary">
		</div>
	</div>
</form>
<form action="" class="form-table form order-deliveryer-records" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($deliveryers)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>配送员</th>
							<?php  if($_W['is_agent']) { ?>
								<th>所属城市</th>
							<?php  } ?>
							<th>待取货</th>
							<th>配送中</th>
							<th>已完成 / 超时</th>
							<th style="width: 200px; text-align: right;">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($deliveryers)) { foreach($deliveryers as $deliveryer) { ?>
							<tr>
								<td><img width="50" height="50" src="<?php  echo tomedia($deliveryer['avatar'])?>" alt=""/>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $deliveryer['title'];?></td>
								<?php  if($_W['is_agent']) { ?>
									<td><?php  echo toagent($deliveryer['agentid'])?></td>
								<?php  } ?>
								<td><?php  echo intval($wait_pickup[$deliveryer['id']]['total'])?></td>
								<td><?php  echo intval($deliverying[$deliveryer['id']]['total'])?></td>
								<td><?php  echo intval($finish[$deliveryer['id']]['total'])?> / <span class="color-danger"><?php  echo intval($timeout[$deliveryer['id']]['total'])?></span></td>
								<td align="right"><a href="<?php  echo iurl('order/records/list', array('deliveryer_id' => $deliveryer['id']))?>" class="btn btn-default btn-sm">查看</a></td>
							</tr>
						<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-right">
						<?php  echo $pager;?>
					</div>
				</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>

<?php  if($op == 'list') { ?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('order/records/list');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">下单时间</label>
		<div class="col-sm-4 col-xs-4">
			<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d H:i', $starttime), 'end' => date('Y-m-d H:i', $endtime)));?>
		</div>
	</div>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">其他</label>
		<div class="col-sm-4 col-xs-4">
			<?php  if($_W['is_agent']) { ?>
				<select name="agentid" class="select2 js-select2 form-control width-130">
					<option value="0">选择代理区域</option>
					<?php  if(is_array($_W['agents'])) { foreach($_W['agents'] as $agent) { ?>
						<option value="<?php  echo $agent['id'];?>" <?php  if($agentid == $agent['id']) { ?>selected<?php  } ?>><?php  echo $agent['area'];?></option>
					<?php  } } ?>
				</select>
			<?php  } ?>
			<select name="deliveryer_id" id="deliveryer_id" class="select2 js-select2 form-control width-130">
				<option value="">选择配送员</option>
				<?php  if(is_array($deliveryer_alls)) { foreach($deliveryer_alls as $alls) { ?>
					<option value="<?php  echo $alls['id'];?>" <?php  if($alls['id'] == $deliveryer_id) { ?>selected<?php  } ?>><?php  echo $alls['title'];?></option>
				<?php  } } ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-4 col-xs-4">
			<input type="submit" value="筛选" class="btn btn-primary">
		</div>
	</div>
</form>
<form action="" class="form-table form order-deliveryer-records" method="post">
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
							<th>流水号</th>
							<th>配送员</th>
							<?php  if($_W['is_agent']) { ?>
								<th>所属城市</th>
							<?php  } ?>
							<th>订单状态</th>
							<th>下单时间</th>
							<th>支付时间</th>
							<th>商家接单时间</th>
							<th>配送员接单时间</th>
							<th>配送员到店时间</th>
							<th>完成时间</th>
							<th>商家接单耗时</th>
							<th>配送员配送耗时</th>
							<th>订单耗时</th>
							<th>超时状态</th>
							<th style="text-align: right">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
							<tr>
								<td>#<?php  echo $order['serial_sn'];?></td>
								<td>
									<img width="50" height="50" src="<?php  echo tomedia($deliveryer_alls[$order['deliveryer_id']]['avatar'])?>" alt=""/>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $deliveryer_alls[$order['deliveryer_id']]['title'];?>
								</td>
								<?php  if($_W['is_agent']) { ?>
									<td><?php  echo toagent($order['agentid'])?></td>
								<?php  } ?>
								<td>
									<span class="<?php  echo $order_delivery_status[$order['delivery_status']]['css'];?>"><?php  echo $order_delivery_status[$order['delivery_status']]['text'];?></span>
								</td>
								<td><?php  echo date('H:i:s', $order['addtime'])?><br><?php  echo date('Y-m-d', $order['addtime'])?></td>
								<td><?php  echo date('H:i:s', $order['paytime'])?><br><?php  echo date('Y-m-d', $order['paytime'])?></td>
								<td><?php  echo date('H:i:s', $order['handletime'])?><br><?php  echo date('Y-m-d', $order['handletime'])?></td>
								<td>
									<?php  if(!empty($order['delivery_assign_time'])) { ?>
										<?php  echo date('H:i:s', $order['delivery_assign_time'])?><br><?php  echo date('Y-m-d', $order['delivery_assign_time'])?>
									<?php  } ?>
								</td>
								<td>
									<?php  if(!empty($order['delivery_instore_time'])) { ?>
										<?php  echo date('H:i:s', $order['delivery_instore_time'])?><br><?php  echo date('Y-m-d', $order['delivery_instore_time'])?>
									<?php  } ?>
								</td>
								<td>
									<?php  if(!empty($order['endtime'])) { ?>
										<?php  echo date('H:i:s', $order['endtime'])?><br><?php  echo date('Y-m-d', $order['endtime'])?>
									<?php  } ?>
								</td>
								<td><?php  echo $order['time_interval']['store_consum_time'];?></td>
								<td><?php  echo $order['time_interval']['deliveryer_consum_time'];?></td>
								<td><?php  echo $order['time_interval']['order_consum_time'];?></td>
								<td><span class="<?php  echo $order['time_interval']['timeout_css'];?>"><?php  echo $order['time_interval']['timeout_text'];?></span></td>
								<td align="right">
									<a href="<?php  echo iurl('order/takeout/detail', array('id' => $order['id']))?>" class="btn btn-default btn-sm">查看</a>
								</td>
							</tr>
						<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-right">
						<?php  echo $pager;?>
					</div>
				</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>