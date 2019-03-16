<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('errander/statDelivery/index');?>
	<input type="hidden" name="days" value="<?php  echo $days;?>"/>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">筛选时间</label>
		<div class="col-sm-9 col-xs-12 js-daterange" data-form="#form1">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('days:0');?>" class="btn <?php  if(!$days) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">今天</a>
				<a href="<?php  echo ifilter_url('days:7');?>" class="btn <?php  if($days == 7) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">最近7天</a>
				<a href="<?php  echo ifilter_url('days:30');?>" class="btn <?php  if($days == 30) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">最近30天</a>
				<a href="javascript:;" class="btn js-btn-custom <?php  if($days == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">自定义</a>
			</div>
			<span class="btn-daterange js-btn-daterange <?php  if($days != -1) { ?>hide<?php  } ?>">
				<?php  echo tpl_form_field_daterange('stat_day', array('start' => $starttime, 'end' => $endtime), true);?>
			</span>
		</div>
	</div>
	<div class="form-group clearfix form-inline">
		<label class="col-xs-12 col-sm-2 col-md-1 control-label">其他</label>
		<div class="col-sm-7 col-lg-8 col-xs-12">
			<select name="deliveryer_id" class="form-control select2 js-select2 width-130" id="select-deliveryer_id">
				<option value="0" <?php  if(!$deliveryer_id) { ?>selected<?php  } ?>>全部配送员</option>
				<?php  if(is_array($deliveryers)) { foreach($deliveryers as $deliveryer) { ?>
					<option value="<?php  echo $deliveryer['id'];?>" <?php  if($deliveryer['id'] == $deliveryer_id) { ?>selected<?php  } ?>><?php  echo $deliveryer['title'];?></option>
				<?php  } } ?>
			</select>
		</div>
	</div>
</form>
<div class="clearfix">
	<div class="panel panel-stat">
		<div class="panel-heading">
			<h3>
				总览
				<span class="text-danger font-12">
					提示：当前订单配送超时时间为<?php  echo $config_takeout['delivery_timeout_limit'];?>分钟,提前时间为<?php  echo $config_takeout['delivery_before_limit'];?>分钟。
					配送时间:从商家通知配送员接单的时间点到配送员送达的时间点的差值。
					普通单:配送时间未超过后台设置的订单配送超时时间
				</span>
			</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-2">
				<div class="title">
					总配送
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="总配送： 由平台配送并且订单已完成的订单数"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span id="html-total-success-order">--</span>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="title">
					普通订单
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="普通订单： 根据平台设置的订单配送超时时间,计算未超时订单的数目"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span id="html-total-normal-order">--</span>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="title">
					超时订单
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="超时订单：根据平台设置的订单配送超时时间,计算超时订单的数目。"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span id="html-total-timeout-order">--</span>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="title">
					提前送达订单
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="超时订单：根据平台设置的订单配送超时时间,计算超时订单的数目。"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span id="html-total-before-order">--</span>
					</a>
				</div>
			</div>
			<div class="col-md-2">
				<div class="title">
					普通单平均配送时长(分)
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="普通单平均配送时长:未超时订单的总配送时间除以未超时的总单数。"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span id="html-avg-normal-delivery-time"></span>
					</a>
				</div>
			</div>
			<div class="col-md-2">
			<div class="title">
				配送准时率
				<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="配送准时率:未超时订单数的除以总单数。"></i>
			</div>
			<div class="num-wrapper">
				<a class="num" href="javascript:;">
					<span id="html-percent-normal"></span>
				</a>
			</div>
		</div>
			<div class="col-md-2">
				<div class="title">
					配送超时率
					<i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-content="配送超时率:超时订单数的除以总单数。"></i>
				</div>
				<div class="num-wrapper">
					<a class="num" href="javascript:;">
						<span id="html-percent-timeout"></span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix <?php  if(!$days) { ?>hide<?php  } ?>">
	<div class="panel panel-trend">
		<div class="panel-heading">
			<h3>趋势图</h3>
		</div>
		<div class="panel-body">
			<div id="chart-order-holder" style="width: 100%;height:400px;"></div>
		</div>
	</div>
</div>

<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive">
			<table class="table table-bordered table-hover text-center" style="background: #fff">
				<thead class="navbar-inner">
					<tr>
						<th>日期</th>
						<th>总配送单数</th>
						<th>正常送达单数</th>
						<th>提前送达单数</th>
						<th>超时单数</th>
						<th>普通单<br>平均配送时长(分)</th>
						<th>订单准时率</th>
						<th>订单超时率</th>
						<th>接单-到店(取货)-送达<br>(普通单,单位:分)</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($records)) { foreach($records as $record) { ?>
						<tr>
							<td><strong><?php  echo $record['stat_day'];?></strong></td>
							<td><strong><?php  echo intval($record['total_success_order']);?></strong></td>
							<td><strong><?php  echo intval($record['total_normal_order']);?></strong></td>
							<td><strong><?php  echo intval($record['total_before_order']);?></strong></td>
							<td><strong><?php  echo intval($record['total_timeout_order']);?></strong></td>
							<td><strong><?php  echo $record['avg_normal_delivery_time'];?></strong></td>
							<td><strong><?php  echo $record['percent_normal'];?>%</strong></td>
							<td><strong><?php  echo $record['percent_timeout'];?>%</strong></td>
							<td>
								<strong>
									<?php  echo $record['avg_delivery_notify_time'];?> -
									<?php  echo $record['avg_delivery_instore_time'];?> - <?php  echo $record['avg_delivery_success_time'];?>
								</strong>
							</td>
							<td>
								<a href="<?php  echo iurl('errander/statDelivery/day', array('days' => -1, 'stat_day' => $record['stat_day']));?>" class="btn btn-default btn-sm">详情</a>
							</td>
						</tr>
					<?php  } } ?>
				</tbody>
			</table>
		</div>
	</div>
</form>

<script type="text/javascript">
irequire(['echarts'], function(echarts){
	var option = {
		title: {
			text: '营业趋势图'
		},
		tooltip : {
			trigger: 'axis'
		},
		legend: {
			data:[]
		},
		toolbox: {
			feature: {
				saveAsImage: {}
			}
		},
		grid: {
			left: '3%',
			right: '4%',
			bottom: '3%',
			containLabel: true
		},
		xAxis : [{
			type : 'category',
			boundaryGap : false,
			data :[1, 2, 3]
		}],
		yAxis : [
			{
				type : 'value'
			}
		],
		series : []
	};
	var myChart = echarts.init($('#chart-order-holder')[0]);
	myChart.setOption(option);
	myChart.showLoading();
	$.post(location.href, function(data){
		myChart.hideLoading();
		var result = $.parseJSON(data);
		option.legend.data = result.message.message.titles;
		var xAxis = {
			type : 'category',
			boundaryGap : false,
			data : result.message.message.days
		};
		option.xAxis = xAxis;
		$.each(result.message.message.fields, function(k, v){
			var serie = {
				name: result.message.message.titles[k],
				type: 'line',
				areaStyle: {normal: {}},
				data: result.message.message[v]
			};
			option.series.push(serie);
		});
		myChart.setOption(option);
		var stat = result.message.message.stat;
		$('#html-total-success-order').html(stat.total_success_order);
		$('#html-total-normal-order').html(stat.total_normal_order);
		$('#html-total-timeout-order').html(stat.total_timeout_order);
		$('#html-total-before-order').html(stat.total_before_order);
		$('#html-avg-normal-delivery-time').html(stat.avg_normal_delivery_time);
		$('#html-percent-normal').html(stat.percent_normal + '%');
		$('#html-percent-timeout').html(stat.percent_timeout + '%');
	});
});
</script>

<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>