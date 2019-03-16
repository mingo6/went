<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="./index.php?" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('deliveryer/comment/list');?>
	<input type="hidden" name="days" value="<?php  echo $days;?>"/>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送服务</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('delivery_service:-1');?>" class="btn <?php  if($delivery_service == -1 || !$delivery_service) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('delivery_service:1');?>" class="btn <?php  if($delivery_service == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">一星</a>
				<a href="<?php  echo ifilter_url('delivery_service:2');?>" class="btn <?php  if($delivery_service == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">二星</a>
				<a href="<?php  echo ifilter_url('delivery_service:3');?>" class="btn <?php  if($delivery_service == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">三星</a>
				<a href="<?php  echo ifilter_url('delivery_service:4');?>" class="btn <?php  if($delivery_service == 4) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">四星</a>
				<a href="<?php  echo ifilter_url('delivery_service:5');?>" class="btn <?php  if($delivery_service == 5) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">五星</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">评论时间</label>
		<div class="col-sm-9 col-xs-12 js-daterange" data-form="#form1">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('days:-2');?>" class="btn <?php  if($days == -2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('days:7');?>" class="btn <?php  if($days == 7) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">近一周</a>
				<a href="<?php  echo ifilter_url('days:30');?>" class="btn <?php  if($days == 30) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">近一月</a>
				<a href="<?php  echo ifilter_url('days:90');?>" class="btn <?php  if($days == 90) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">近三月</a>
				<a href="javascript:;" class="btn js-btn-custom <?php  if($days == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">自定义</a>
			</div>
			<span class="js-btn-daterange <?php  if($days != -1) { ?>hide<?php  } ?>">
				<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d H:i', $starttime), 'end' => date('Y-m-d H:i', $endtime)));?>
			</span>
		</div>
	</div>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员</label>
		<div class="col-sm-9 col-xs-12">
			<?php  if($_W['is_agent']) { ?>
				<select name="agentid" class="select2 js-select2 form-control width-130">
					<option value="0">选择代理区域</option>
					<?php  if(is_array($_W['agents'])) { foreach($_W['agents'] as $agent) { ?>
						<option value="<?php  echo $agent['id'];?>" <?php  if($agentid == $agent['id']) { ?>selected<?php  } ?>><?php  echo $agent['area'];?></option>
					<?php  } } ?>
				</select>
			<?php  } ?>
			<select name="deliveryer_id" class="form-control select2" >
				<option value="0" <?php  if(!$sid) { ?>selected<?php  } ?>>==选择配送员==</option>
				<?php  if(is_array($deliveryers)) { foreach($deliveryers as $deliveryer) { ?>
					<option value="<?php  echo $deliveryer['id'];?>" <?php  if($deliveryer_id == $deliveryer['id']) { ?>selected<?php  } ?>><?php  echo $deliveryer['title'];?></option>
				<?php  } } ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<button class="btn btn-primary">筛选</button>
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<th>评论时间</th>
						<?php  if($_W['is_agent']) { ?>
							<th>所属城市</th>
						<?php  } ?>
						<th>配送员</th>
						<th>顾客信息</th>
						<th>评价星级</th>
						<th>评价标签</th>
						<th style="text-align: right;">操作</th>
					</tr>
				</thead>
				<tbody>
				<?php  if(is_array($records)) { foreach($records as $record) { ?>
					<tr>
						<td><?php  echo date('Y-m-d H:i', $record['addtime']);?></td>
						<?php  if($_W['is_agent']) { ?>
							<td><?php  echo toagent($record['agentid'])?></td>
						<?php  } ?>
						<td>
							<img src="<?php  echo $deliveryers[$record['deliveryer_id']]['avatar'];?>" alt="" width="50" height="50" style="border-radius: 100%"/>
							<?php  echo $deliveryers[$record['deliveryer_id']]['title'];?>
						</td>
						<td>
							姓名：<?php  echo $record['username'];?><br>
							手机：<?php  echo $record['mobile'];?>
						</td>
						<td>
							<?php 
								for($i = 0; $i < $record['delivery_service']; $i++) {
									echo '<span><i class="deliveryer-comment fa fa-star star light"></i></span> ';
								}
								for($i = $record['delivery_service']; $i < 5; $i++) {
									echo '<span><i class="deliveryer-comment fa fa-star star"></i></span> ';
								}
							?>
						</td>
						<td>
							<?php echo $record['deliveryer_tag'] ? $record['deliveryer_tag'] : '无';?>
						</td>
						<td style="text-align: right;">
							<a href="<?php  echo iurl('order/takeout/detail', array('id' => $record['oid']));?>" target="_blank" class="btn btn-default btn-sm">订单详情</a>
						</td>
					</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<?php  echo $pager;?>
		</div>
	</div>
</form>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
