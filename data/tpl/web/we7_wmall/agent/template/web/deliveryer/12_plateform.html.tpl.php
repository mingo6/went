<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="./wagent.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('deliveryer/plateform/list');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">外卖权限</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<div class="btn-group">
					<a href="<?php  echo ifilter_url('is_takeout:-1');?>" class="btn <?php  if($is_takeout == '-1') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
					<a href="<?php  echo ifilter_url('is_takeout:1');?>" class="btn <?php  if($is_takeout == '1') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">有</a>
					<a href="<?php  echo ifilter_url('is_takeout:0');?>" class="btn <?php  if($is_takeout == '0') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">无</a>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">跑腿权限</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<div class="btn-group">
					<a href="<?php  echo ifilter_url('is_errander:-1');?>" class="btn <?php  if($is_errander == '-1') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
					<a href="<?php  echo ifilter_url('is_errander:1');?>" class="btn <?php  if($is_errander == '1') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">有</a>
					<a href="<?php  echo ifilter_url('is_errander:0');?>" class="btn <?php  if($is_errander == '0') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">无</a>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-4 col-xs-4">
			<input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="搜索的姓名、昵称、手机号">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-4 col-xs-4">
			<input type="submit" value="筛选" class="btn btn-primary">
		</div>
	</div>
</form>
<form action="" class="form-table form" id="form-deliveryer" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('deliveryer/plateform/post')?>" class="btn btn-primary btn-sm">添加配送员</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th width="40">
						<div class="checkbox checkbox-inline">
							<input type="checkbox">
							<label></label>
						</div>
					</th>
					<th width="85">头像</th>
					<th>微信昵称</th>
					<th>配送员名称</th>
					<th>账户余额</th>
					<th>手机号/性别/年龄</th>
					<th>添加时间</th>
					<th>外卖单权限</th>
					<?php  if(check_plugin_perm('errander')) { ?>
					<th>跑腿单权限</th>
					<?php  } ?>
					<th>跑腿人员类型</th>
					<!--<th>身份信息</th>-->
					<th style="width:400px; text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($data)) { foreach($data as $item) { ?>
				<tr>
					<td>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="ids[]" value="<?php  echo $item['id'];?>">
							<label></label>
						</div>
					</td>
					<td>
						<img src="<?php  echo tomedia($item['avatar']);?>" width="48">
					</td>
					<td><?php  echo $item['nickname'];?></td>
					<td><?php  echo $item['title'];?></td>
					<td>
						<span class="label <?php  if($item['credit2'] > 0) { ?>label-success<?php  } else { ?>label-danger<?php  } ?>"><?php  echo $item['credit2'];?></span>
					</td>
					<td>
						<?php  echo $item['mobile'];?>
						<br/>
						<?php  echo $item['sex'];?> /<?php  echo $item['age'];?>
					</td>
					<td><?php  echo date('Y-m-d H:i', $item['addtime']);?></td>
					<!--<td>
						<span class="label label-success">平台单</span>
						<br>
						<?php  if(!empty($item['stores'])) { ?>
							<?php  if(is_array($item['stores'])) { foreach($item['stores'] as $store) { ?>
								<span class="label label-danger"><?php  echo $stores[$store['sid']]['title'];?></span>
							<?php  } } ?>
						<?php  } ?>
					</td>-->
					<td>
						<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('deliveryer/plateform/perm', array('id' => $item['id'], 'fields' => 'is_takeout', 'value' => $item['is_takeout']));?>" <?php  if($item['is_takeout'] == 1) { ?>checked<?php  } ?>>
					</td>
					<?php  if(check_plugin_perm('errander')) { ?>
					<td>
						<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('deliveryer/plateform/perm', array('id' => $item['id'], 'fields' => 'is_errander', 'value' => $item['is_errander']));?>" <?php  if($item['is_errander'] == 1) { ?>checked<?php  } ?>>
					</td>
					<?php  } ?>
					<td><?php  echo $item['type'];?></td>
					<!--<td>-->
						<?php  if($item['auth_info']) { ?>
						<!--<a href="<?php  echo tomedia($item['auth_info']['idCardOne'])?>" target="_blank">手持身份证照片</a>-->
						<!--<br>-->
						<!--<a href="<?php  echo tomedia($item['auth_info']['idCardTwo'])?>" target="_blank">身份证正面照片</a>-->
						<?php  } ?>
					<!--</td>-->
					<td style="text-align:right;">
						<a href="<?php  echo iurl('deliveryer/plateform/stat', array('id' => $item['id']))?>" class="btn btn-default btn-sm" title="配送统计" data-toggle="tooltip" data-placement="top">统计</a>
						<a href="<?php  echo iurl('deliveryer/getcash/list', array('deliveryer_id' => $item['id']))?>" class="btn btn-default btn-sm" title="提现记录" data-toggle="tooltip" data-placement="top">提现</a>
						<a href="<?php  echo iurl('deliveryer/current/list', array('deliveryer_id' => $item['id']))?>" class="btn btn-default btn-sm" title="账户明细" data-toggle="tooltip" data-placement="top">账户明细</a>
						<a href="<?php  echo iurl('deliveryer/plateform/post', array('id' => $item['id']))?>" class="btn btn-default btn-sm" title="编辑" data-toggle="tooltip" data-placement="top">编辑</a>
						<a href="<?php  echo iurl('deliveryer/plateform/del', array('id' => $item['id']))?>" class="btn btn-default btn-sm" title="删除" data-toggle="tooltip" data-placement="top">删除</a>
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
		</div>
	</div>
</form>
<script>
$(function(){
	$(document).on('click', '#show-login-modal', function(){
		$('#qrcode-modal').modal('show');
	});

	$(document).on('click', '.btn-add', function(){
		$('#add-container').modal('show');
		$(document).on('click', '.btn-subm4it', function(){
			var mobile = $('#mobile').val();
			if(!mobile) {
				Notify.info('手机号不能为空');
				return false;
			}
			$.post("<?php  echo iurl('deliveryer/plateform/stat', array('op' => 'add_ptf_deliveryer'));?>", {mobile: mobile}, function(data){
				var result = $.parseJSON(data);
				if(result.message.errno == -1) {
					Notify.info(result.message.message);
					return false;
				} else {
					location.reload();
				}
			});
		});
	});

});
</script>
<?php  } ?>

<?php  if($op == 'stat') { ?>
<div class="clearfix">
	<div class="panel panel-stat">
		<div class="panel-heading">
			<h3>配送员: <?php  echo $deliveryer['title'];?></h3>
		</div>
		<div class="panel-body">
			<div class="col-md-3">
				<div class="title">今日配送</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;"><?php  echo $stat['today_num'];?></a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="title">昨日配送</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;"><?php  echo $stat['yesterday_num'];?></a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="title">本月配送</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;"><?php  echo $stat['month_num'];?></a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="title">总配送</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;"><?php  echo $stat['total_num'];?></a>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-trend">
		<div class="panel-heading">
			<h3>详细统计</h3>
		</div>
		<div class="panel-body">
			<form action="" id="trade">
				<?php  echo tpl_form_field_daterange('time', array('start' => date('Y-m-d', $start),'end' => date('Y-m-d', $end)), '')?>
			</form>
			<div id="chart-container">
				<canvas id="myChart" width="1200" height="300"></canvas>
			</div>
		</div>
	</div>
</div>
<script>
require(['daterangepicker'], function() {
	irequire(['chart'], function(){
		$('.daterange').on('apply.daterangepicker', function(ev, picker) {
			refresh();
		});

		var chart = null;
		var templates = {
			flow1: {
				label: '配送(单)',
				fillColor : "rgba(36,165,222,0.1)",
				strokeColor : "rgba(36,165,222,1)",
				pointColor : "rgba(36,165,222,1)",
				pointStrokeColor : "#fff",
				pointHighlightFill : "#fff",
				pointHighlightStroke : "rgba(36,165,222,1)",
			}
		};

		function refresh() {
			$('#chart-container').html('<canvas id="myChart" width="1200" height="300"></canvas>');
			var url = location.href + '&#aaaa';
			var params = {
				'start': $('#trade input[name="time[start]"]').val(),
				'end': $('#trade input[name="time[end]"]').val()
			};
			$.post(url, params, function(data){
				var data = $.parseJSON(data)
				var datasets = data.datasets;
				var label = data.label;
				var ds = $.extend(true, {}, templates);
				ds.flow1.data = datasets.flow1;
				var lineChartData = {
					labels : label,
					datasets : [ds.flow1]
				};
				var ctx = document.getElementById("myChart").getContext("2d");
				chart = new Chart(ctx).Line(lineChartData, {
					responsive: true
				});
			});
		}
		refresh();
	});
});
</script>
<?php  } ?>
<?php  if($op == 'post') { ?>
<div class="page clearfix">
	<h2>编辑配送员</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">微信昵称</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_fans('wechat', $deliveryer, 'notify', true);?>
				<div class="help-block">如果待添加的配送员未关注公众号, 需要先关注公众号</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员姓名</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="title" value="<?php  echo $deliveryer['title'];?>" class="form-control" required="true">
				<div class="help-block">请填写配送员姓名。<strong class="text-danger">请填写真实姓名, 否则会造成微信提现失败</strong></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">手机号</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" name="mobile" value="<?php  echo $deliveryer['mobile'];?>" class="form-control" placeholder="用于账号登陆" required="true">
				<div class="help-block">手机号用于配送员账号登陆, 请认真填写</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">登陆密码</label>
			<div class="col-sm-9 col-xs-12">
				<input type="password" name="password" value="" class="form-control" placeholder="" <?php  if(!$id) { ?>required="true"<?php  } ?>>
				<div class="help-block">请填写密码，长度为 8-20 个字符.<?php  if($id > 0) { ?>如果不更改密码此处请留空<?php  } ?></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">确认登陆密码</label>
			<div class="col-sm-9 col-xs-12">
				<input type="password" name="repassword" value="" class="form-control" placeholder="" <?php  if(!$id) { ?>required="true"<?php  } ?>>
				<div class="help-block">重复输入密码，确认正确输入.<?php  if($id > 0) { ?>如果不更改密码此处请留空<?php  } ?></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">年龄</label>
			<div class="col-sm-9 col-xs-12">
				<input type="number" name="age" value="<?php  echo $deliveryer['age'];?>" class="form-control" required="true">
				<div class="help-block"></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">性别</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="sex" id="sex-1" value="男" <?php  if($deliveryer['sex'] == '男' || !$deliveryer['sex']) { ?>checked<?php  } ?>>
					<label for="sex-1">男</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="sex" id="sex-0" value="女" <?php  if($deliveryer['sex'] == '女') { ?>checked<?php  } ?>>
					<label for="sex-0">女</label>
				</div>
			</div>
		</div>
		<h3>配送权限</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送权限</label>
			<div class="col-sm-9 col-xs-12">
				<div class="checkbox checkbox-inline">
					<input type="checkbox" name="is_takeout" id="is_takeout" value="1" <?php  if($deliveryer['is_takeout'] == 1) { ?>checked<?php  } ?>>
					<label for="is_takeout">外卖单</label>
				</div>
				<?php  if(check_plugin_perm('errander')) { ?>
				<div class="checkbox checkbox-inline">
					<input type="checkbox" name="is_errander" id="is_errander" value="1" <?php  if($deliveryer['is_errander'] == 1) { ?> checked<?php  } ?>>
					<label for="is_errander">跑腿单</label>
				</div>
				<?php  } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跑腿类型</label>
			<div class="col-sm-9 col-xs-12">
				<select class="form-control" name="type">
					<?php  if(is_array($type)) { foreach($type as $category) { ?>
					<option value="<?php  echo $category['value'];?>" <?php  if($category['value'] == $deliveryer['type']) { ?>selected<?php  } ?>><?php  echo $category['deliveryer_name'];?></option>
					<?php  } } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否允许配送员取消订单（外卖单）</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="perm_cancel[status_takeout]" id="perm_cancel_takeout-1" <?php  if($deliveryer['perm_cancel']['status_takeout'] == '1') { ?>checked<?php  } ?>>
					<label for="perm_cancel_takeout-1">允许</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="perm_cancel[status_takeout]" id="perm_cancel_takeout-0" <?php  if($deliveryer['perm_cancel']['status_takeout'] == '0') { ?>checked<?php  } ?>>
					<label for="perm_cancel_takeout-0">禁止</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否允许配送员取消订单（跑腿单）</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="perm_cancel[status_errander]" id="perm_cancel_errander-1" <?php  if($deliveryer['perm_cancel']['status_errander'] == '1') { ?>checked<?php  } ?>>
					<label for="perm_cancel_errander-1">允许</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="perm_cancel[status_errander]" id="perm_cancel_errander-0" <?php  if($deliveryer['perm_cancel']['status_errander'] == '0') { ?>checked<?php  } ?>>
					<label for="perm_cancel_errander-0">禁止</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否允许配送员转单(外卖单)</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="perm_transfer[status_takeout]" id="perm_transfer_status_takeout-1" <?php  if($deliveryer['perm_transfer']['status_takeout'] == '1') { ?>checked<?php  } ?>>
					<label for="perm_transfer_status_takeout-1">允许</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="perm_transfer[status_takeout]" id="perm_transfer_status_takeout-0" <?php  if($deliveryer['perm_transfer']['status_takeout'] == '0') { ?>checked<?php  } ?>>
					<label for="perm_transfer_status_takeout-0">禁止</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否允许配送员转单(跑腿单)</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="perm_transfer[status_errander]" id="perm_transfer_status_errander-1" <?php  if($deliveryer['perm_transfer']['status_errander'] == '1') { ?>checked<?php  } ?>>
					<label for="perm_transfer_status_errander-1">允许</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="perm_transfer[status_errander]" id="perm_transfer_status_errander-0" <?php  if($deliveryer['perm_transfer']['status_errander'] == '0') { ?>checked<?php  } ?>>
					<label for="perm_transfer_status_errander-0">禁止</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员每天最多可转</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">外卖单</span>
					<input type="text" class="form-control" name="perm_transfer[max_takeout]" value="<?php  echo $deliveryer['perm_transfer']['max_takeout'];?>" digits="true">
					<span class="input-group-addon">单</span>
				</div>
				</br>
				<div class="input-group">
					<span class="input-group-addon">跑腿单</span>
					<input type="text" class="form-control" name="perm_transfer[max_errander]" value="<?php  echo $deliveryer['perm_transfer']['max_errander'];?>" digits="true">
					<span class="input-group-addon">单</span>
				</div>
				<div class="help-block">配送员在遇到特殊情况下可申请转单，设置每天最多可转几次单。0为不限制</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员最多可抢 <br>（外卖单）</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" name="collect_max_takeout" value="<?php  echo $deliveryer['collect_max_takeout'];?>" digits="true">
					<span class="input-group-addon">单</span>
				</div>
				<div class="help-block">配送员最多可抢外卖单数。0为不限制</div>
				<div class="help-block">注意：系统派单和配送员自己抢单模式受此项限制，平台调度给配送员分配订单不受此项限制</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员最多可抢 <br>（跑腿单）</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" name="collect_max_errander" value="<?php  echo $deliveryer['collect_max_errander'];?>" digits="true">
					<span class="input-group-addon">单</span>
				</div>
				<div class="help-block">配送员最多可抢跑腿单数。0为不限制</div>
				<div class="help-block">注意：系统派单和配送员自己抢单模式受此项限制，平台调度给配送员分配订单不受此项限制</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">平台给配送员每单支付金额(外卖单)</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_takeout_fee_type" value="1" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 1 || !$deliveryer['fee_delivery']['takeout']['deliveryer_fee_type']) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单固定</span>
					<input type="text" class="form-control" name="deliveryer_takeout_fee_1" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 1) { ?>value="<?php  echo $deliveryer['fee_delivery']['takeout']['deliveryer_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元</span>
				</div>
				<br>
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_takeout_fee_type" value="2" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 2) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单按照订单配送费提成</span>
					<input type="text" class="form-control" name="deliveryer_takeout_fee_2" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 2) { ?>value="<?php  echo $deliveryer['fee_delivery']['takeout']['deliveryer_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">%</span>
				</div>
				<br>
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_takeout_fee_type" value="3" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 3) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单基础配送费</span>
					<input type="text" class="form-control" name="deliveryer_takeout_fee_3[start_fee]" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['takeout']['deliveryer_fee']['start_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元,超过</span>
					<input type="text" class="form-control" name="deliveryer_takeout_fee_3[start_km]" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['takeout']['deliveryer_fee']['start_km'];?>"<?php  } ?>>
					<span class="input-group-addon">公里,超过部分每公里增加</span>
					<input type="text" class="form-control" name="deliveryer_takeout_fee_3[pre_km]" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['takeout']['deliveryer_fee']['pre_km'];?>"<?php  } ?>>
					<span class="input-group-addon">元,最高</span>
					<input type="text" class="form-control" name="deliveryer_takeout_fee_3[max_fee]" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['takeout']['deliveryer_fee']['max_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block"><span class="text-danger">第三种提成模式仅适用于开启按照距离收取配送费的计费模式。最高设置为0表示不限制。</span></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">平台给跑腿员每单支付金额(跑腿单)</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_errander_fee_type" value="1" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 1 || !$deliveryer['fee_delivery']['errander']['deliveryer_fee_type']) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单固定</span>
					<input type="text" class="form-control" name="deliveryer_errander_fee_1" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 1) { ?>value="<?php  echo $deliveryer['fee_delivery']['errander']['deliveryer_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元</span>
				</div>
				<br>
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_errander_fee_type" value="2" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 2) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单按照订单配送费提成</span>
					<input type="text" class="form-control" name="deliveryer_errander_fee_2" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 2) { ?>value="<?php  echo $deliveryer['fee_delivery']['errander']['deliveryer_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">%</span>
				</div>
				<br>
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_errander_fee_type" value="3" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 3) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单基础配送费</span>
					<input type="text" class="form-control" name="deliveryer_errander_fee_3[start_fee]" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['errander']['deliveryer_fee']['start_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元,超过</span>
					<input type="text" class="form-control" name="deliveryer_errander_fee_3[start_km]" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['errander']['deliveryer_fee']['start_km'];?>"<?php  } ?>>
					<span class="input-group-addon">公里,超过部分每公里增加</span>
					<input type="text" class="form-control" name="deliveryer_errander_fee_3[pre_km]" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['errander']['deliveryer_fee']['pre_km'];?>"<?php  } ?>>
					<span class="input-group-addon">元,最高</span>
					<input type="text" class="form-control" name="deliveryer_errander_fee_3[max_fee]" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['errander']['deliveryer_fee']['max_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block"><span class="text-danger">第三种提成模式仅适用于开启按照距离收取配送费的计费模式。最高设置为0表示不限制。</span></div>
			</div>
		</div>
		<h3>提现设置</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>最低提现金额</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" name="fee_getcash[get_cash_fee_limit]" digits="true" value="<?php  echo $deliveryer['fee_getcash']['get_cash_fee_limit'];?>" class="form-control"/>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block">只能填写整数，不填写为不限制</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>提现费率</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" name="fee_getcash[get_cash_fee_rate]" required="true" value="<?php  echo $deliveryer['fee_getcash']['get_cash_fee_rate'];?>" class="form-control"/>
					<span class="input-group-addon">%</span>
				</div>
				<div class="help-block">
					配送员申请提现时，每笔申请提现扣除的费用，默认为空，即提现不扣费，支持填写小数
					<br>
					<strong clas="text-danger">配送员入驻时的默认提现费率</strong>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>提现费用</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">最低</span>
					<input type="text" name="fee_getcash[get_cash_fee_min]" required="true" value="<?php  echo $deliveryer['fee_getcash']['get_cash_fee_min'];?>" class="form-control"/>
					<span class="input-group-addon">元</span>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">最高</span>
					<input type="text" name="fee_getcash[get_cash_fee_max]" required="true" value="<?php  echo $deliveryer['fee_getcash']['get_cash_fee_max'];?>" class="form-control"/>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block">
					<strong class="text-danger">最高金额设置为0， 表示不限制最高提现费用。</strong>
					<br>
					配送员提现时，提现费用的上下限，最高为空时，表示不限制扣除的提现费用
					<br>
					例如：提现100元，费率5%，最低1元，最高2元，配送员最终提现金额=100-2=98
					<br>
					例如：提现100元，费率5%，最低1元，最高10元，配送员最终提现金额=100-100*5%=95
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">提现到账周期</label>
			<div class="col-sm-9 col-xs-12 toggle-tabs" data-content=".get-cash-period-type">
				<div class="radio radio-inline">
					<input type="radio" value="0" name="fee_getcash[get_cash_period]" id="get_cash_period-0" <?php  if(empty($deliveryer['fee_getcash']['get_cash_period'])) { ?>checked<?php  } ?>>
					<label for="get_cash_period-0" class="toggle-role" data-target="get_cash_period-0">管理员审核</label>
					<div class="help-block"></div>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="1" name="fee_getcash[get_cash_period]" id="get_cash_period-1" <?php  if($deliveryer['fee_getcash']['get_cash_period'] == 1) { ?>checked<?php  } ?>>
					<label for= "get_cash_period-1" class="toggle-role" data-target="get_cash_period-1">极速到账</label>
				</div>
				<div class="help-block">
					商户提现默认为需要管理员审核确定后才能转账 <br>
					极速转账:不需要管理员审核直接转账
				</div>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<input type="submit" value="提交" class="btn btn-primary">
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		</div>
	</form>
</div>
<script>
	$(function() {
		$('#form1').submit(function(){
			var password = $.trim($('input[name="password"]').val());
			if(password) {
				var length = password.length;
				if(length < 8 || length > 20) {
					Notify.info('请输入8-20位密码');
					$('form').attr('stop', 1);
					return false;
				}
				var reg = /[0-9]+[a-zA-Z]+[0-9a-zA-Z]*|[a-zA-Z]+[0-9]+[0-9a-zA-Z]*/;
				if(!reg.test(password)) {
					Notify.info('密码必须由数字和字母组合');
					$('form').attr('stop', 1);
					return false;
				}
				var repassword = $.trim($('input[name="repassword"]').val());
				if(!repassword) {
					Notify.info('请重复输入密码');
					$('form').attr('stop', 1);
					return false;
				}
				if(password != repassword) {
					Notify.info('两次密码输入不一致');
					$('form').attr('stop', 1);
					return false;
				}
			}
			$('form').attr('stop', 0);
			return false;
		});
	});
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>