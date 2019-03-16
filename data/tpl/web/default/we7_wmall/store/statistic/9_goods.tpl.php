<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php?" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('store/statistic/goods');?>
	<input type="hidden" name="orderby" value="<?php  echo $orderby;?>"/>
	<input type="hidden" name="days" value="<?php  echo $days;?>"/>
	<input type="hidden" name="r" value="">
	<input type="hidden" name="status" value="<?php  echo $status;?>">
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单状态</label>
		<div class="col-sm-9 col-xs-12 js-daterange" data-form="#form1">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('status:0');?>" class="btn <?php  if($status == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo ifilter_url('status:1');?>" class="btn <?php  if($status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">待接单</a>
				<a href="<?php  echo ifilter_url('status:2');?>" class="btn <?php  if($status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已确认</a>
				<a href="<?php  echo ifilter_url('status:3');?>" class="btn <?php  if($status == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">待配送</a>
				<a href="<?php  echo ifilter_url('status:4');?>" class="btn <?php  if($status == 4) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">配送中</a>
				<a href="<?php  echo ifilter_url('status:5');?>" class="btn <?php  if($status == 5) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已完成</a>
				<a href="<?php  echo ifilter_url('status:6');?>" class="btn <?php  if($status == 6) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已取消</a>
			</div>
		</div>
	</div>
	<div class="form-group clearfix">
		<label class="col-xs-12 col-sm-2 col-md-1 control-label">筛选时间</label>
		<div class="col-sm-9 col-xs-12 js-daterange" data-form="#form1">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('days:0');?>" class="btn <?php  if(!$days) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">今天</a>
				<a href="<?php  echo ifilter_url('days:7');?>" class="btn <?php  if($days == 7) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">最近7天</a>
				<a href="<?php  echo ifilter_url('days:30');?>" class="btn <?php  if($days == 30) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">最近30天</a>
				<a href="javascript:;" class="btn js-btn-custom <?php  if($days == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">自定义</a>
			</div>
			<span class="btn-daterange js-btn-daterange <?php  if($days != -1) { ?>hide<?php  } ?>">
				<?php  echo tpl_form_field_daterange('stat_day', array('start' => $starttime, 'end' => $endtime));?>
			</span>
		</div>
	</div>
	<div class="form-group clearfix">
		<label class="col-xs-12 col-sm-2 col-md-1 control-label">排序</label>
		<div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('orderby:total_goods_price');?>" class="btn <?php  if($orderby == 'total_goods_price') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">销售额</a>
				<a href="<?php  echo ifilter_url('orderby:total_goods_num');?>" class="btn <?php  if($orderby == 'total_goods_num') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">销售量</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-2 col-md-1 control-label"></label>
		<div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
			<div class="btn-group">
				<a class="btn btn-default btn-export" href="javascript:;">导出商品统计</a>
			</div>
		</div>
	</div>
</form>
<div class="clearfix <?php  if(!$days) { ?>hide<?php  } ?>">
	<div class="col-lg-6 padding-0">
		<div class="panel panel-trend">
			<div class="panel-heading">
				<h3>销售额百分比</h3>
			</div>
			<div class="panel-body">
				<div id="chart-goods_price-holder" style="width: 100%;height:400px;"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 padding-r-0">
		<div class="panel panel-trend">
			<div class="panel-heading">
				<h3>销量百分比</h3>
			</div>
			<div class="panel-body">
				<div id="chart-goods_num-holder" style="width: 100%;height:400px;"></div>
			</div>
		</div>
	</div>
</div>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive">
			<table class="table table-bordered table-hover text-center" style="background: #fff">
				<thead>
				<tr style="height: 50px">
					<th colspan="4">
						<strong class="text-danger">
							<?php  if($status == 0) { ?>统计所有订单<?php  } else if($status == 1) { ?>统计待接单的订单<?php  } else if($status == 2) { ?>统计已确认的订单<?php  } else if($status == 3) { ?>统计待配送的订单<?php  } else if($status == 4) { ?>统计配送中的订单<?php  } else if($status == 5) { ?>统计已完成的订单<?php  } else if($status == 6) { ?>统计已取消的订单<?php  } ?>
						</strong>
					</th>
					<th colspan="2" class="text-center">商品销售总额:<strong class="text-danger">￥<?php  echo $stat['total_goods_price'];?></strong></th>
					<th colspan="2" class="text-center">商品销售总量:<strong class="text-danger"><?php  echo $stat['total_goods_num'];?>份</strong></th>
				</tr>
				<tr>
					<th>排名</th>
					<th>商品名称</th>
					<th>商品编号</th>
					<th>销售量</th>
					<th>销售额</th>
					<th>销售额百分比</th>
					<th>销售量百分比</th>
					<th style="width:150px; text-align:right;">菜品</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($records)) { foreach($records as $record) { ?>
					<?php  $i++?>
					<tr>
						<td><strong><?php  echo $i;?></strong></td>
						<td><?php  echo $record['goods_title'];?></td>
						<td><?php  echo $record['goods_number'];?></td>
						<td><?php  echo $record['total_goods_num'];?></td>
						<td>￥<?php  echo $record['total_goods_price'];?></td>
						<td><?php  echo $record['pre_goods_price'];?></td>
						<td><?php  echo $record['pre_goods_num'];?></td>
						<td style="text-align:right;">
							<a href="<?php  echo iurl('store/goods/index/post', array('id' => $record['goods_id']))?>" class="btn btn-default btn-sm" title="菜品详情" data-toggle="tooltip" data-placement="top" target="_blank">菜品详情</a>
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
	var templates = {
		goods_num: {
			title: {
				text: '销量百分比'
			},
			series: [{
				name: '销量百分比',
				data: []
			}]
		},
		goods_price: {
			title: {
				text: '销售额百分比'
			},
			series: [{
				name: '销售额百分比',
				data: []
			}]
		}
	};
	var option = {
		title : {
			text: '',
			x:'center'
		},
		tooltip : {
			trigger: 'item',
			formatter: "{a} <br/>{b} : {c} ({d}%)"
		},
		legend: {
			orient: 'vertical',
			left: 'left',
			data: []
		},
		series : [
			{
				name: '直接访问',
				type: 'pie',
				radius : '55%',
				center: ['50%', '60%'],
				data:[],
				itemStyle: {
					emphasis: {
						shadowBlur: 10,
						shadowOffsetX: 0,
						shadowColor: 'rgba(0, 0, 0, 0.5)'
					}
				}
			}
		]
	};
	$.post(location.href, function(data){
		var result = $.parseJSON(data);
		result = result.message.message;
		var ds = {};
		$.each(result.field, function(k, v){
			ds = $.extend(true, {}, option, templates[v]);
			ds.legend.data = result.title;
			ds.series[0].data = result.data[v];
			myChart = echarts.init($('#chart-' + v + '-holder')[0]);
			myChart.setOption(ds);
		});
	});
	$(document).on('click', '.btn-export', function() {
		$('#form1 input[name="r"]').val('export');
		$("#form1").submit();
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
