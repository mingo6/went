<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'post') { ?>
<style>
	.category-container .category-item {position: relative; height: 80px; border: 1px solid #eee; margin-bottom: 10px;}
	.category-container .btn-del {height: 0; width: 100%; display: block; position: relative;}
	.category-container .btn-del::before {content: "×"; position: absolute; height: 16px; width: 16px; text-align: center; line-height: 14px; color: rgb(255, 255, 255); cursor: pointer; top: -6px; right: -6px; z-index: 10; background: rgba(0, 0, 0, 0.3); border-radius: 16px;}
	.category-container .category-item img {width: 100%; height: 80px;}
	.category-container .category-item .title {position: absolute; height: 20px; left: 0; right: 0; bottom: -1px; background: rgba(0,0,0,0.5); color: #fff; text-align: center; font-size: 12px; line-height: 20px; cursor: pointer;}
</style>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<h2>编辑商品</h2>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="displayorder" value="<?php  echo $item['displayorder'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品标题</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品缩略图</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_image('thumb', $item['thumb']);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品分类</label>
			<div class="col-sm-9 col-xs-12">
				<select class="form-control" name="creditshop_category_id" >
					<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
						<option value="<?php  echo $category['id'];?>" <?php  if($category['id'] == $item['category_id']) { ?>selected<?php  } ?>><?php  echo $category['name'];?></option>
					<?php  } } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品类型</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="radio radio-inline" onclick="$('#credit').hide();$('#redpacket').hide();">
					<input type="radio" name="type" id="type-1" value="goods" <?php  if(!$item['type'] || $item['type'] == 'goods') { ?>checked<?php  } ?> >
					<label for="type-1">商品</label>
				</div>
				<div class="radio radio-inline" onclick="$('#credit').show();$('#redpacket').hide();">
					<input type="radio" name="type" id="type-2" value="credit2" <?php  if($item['type'] == 'credit2') { ?>checked<?php  } ?>>
					<label for="type-2">余额</label>
				</div>
				<div class="radio radio-inline" onclick="$('#credit').hide();$('#redpacket').show();">
					<input type="radio" name="type" id="type-3" value="redpacket" <?php  if($item['type'] == 'redpacket') { ?>checked<?php  } ?>>
					<label for="type-3">红包</label>
				</div>
			</div>
		</div>
		<div class="form-group" id="credit" style="display: <?php  if($item['type'] == 'credit2') { ?>block<?php  } else { ?>none<?php  } ?>;" >
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">设置余额</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<div class="input-group-addon">余额</div>
					<input type="text" class="form-control" name="credit2" value="<?php  echo $item['credit2'];?>">
					<div class="input-group-addon">元</div>
				</div>
			</div>
		</div>
		<div id="redpacket" style="display: <?php  if($item['type'] == 'redpacket') { ?>block<?php  } else { ?>none<?php  } ?>;">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">红包名称及金额</label>
				<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon">名称</span>
						<input type="text" class="form-control" name="name" value="<?php  echo $item['redpacket']['name'];?>">
						<span class="input-group-addon border-0-lr">金额</span>
						<input type="text" class="form-control" name="discount" value="<?php  echo $item['redpacket']['discount'];?>">
						<span class="input-group-addon">元</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">使用条件</label>
				<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon">满多少元可用</span>
						<input type="text" class="form-control" name="condition" value="<?php  echo $item['redpacket']['condition'];?>">
						<span class="input-group-addon">元</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">使用期限</label>
				<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon">领取后</span>
						<input type="text" class="form-control" name="grant_days_effect" value="<?php  echo $item['redpacket']['grant_days_effect'];?>">
						<span class="input-group-addon border-0-lr">天后生效</span>
						<span class="input-group-addon">有效期</span>
						<input type="text" class="form-control" name="use_days_limit" value="<?php  echo $item['redpacket']['use_days_limit'];?>">
						<span class="input-group-addon">天</span>
					</div>
					<div class="help-block">
						如需红包发放后立即生效， 可设置为0
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">使用时间段</label>
				<div class="col-sm-9 col-xs-12">
					<a href="javascript:;" class="btn btn-default btn-sm" id="hour-add"><i class="fa fa-plus-circle"></i> 添加时间段</a>
				</div>
			</div>
			<div class="hour clockpicker" id="hour">
				<?php  if(!empty($item['redpacket']['hour'])) { ?>
					<?php  if(is_array($item['redpacket']['hour'])) { foreach($item['redpacket']['hour'] as $hour) { ?>
						<div class="form-group hour-item">
							<div class="col-sm-2 control-label"></div>
							<div class="col-sm-9 col-xs-4 col-md-4">
								<div class="input-group">
									<input type="text" readonly class="form-control" name="start_hour[]" value="<?php  echo $hour['s'];?>">
									<span class="input-group-addon border-0-lr">至</span>
									<input type="text" readonly class="form-control" name="end_hour[]" value="<?php  echo $hour['e'];?>">
								</div>
							</div>
							<div class="col-sm-9 col-xs-4 col-md-3">
								<a href="javascript:;" class="fa fa-times-circle delete-hour"></a>
							</div>
						</div>
					<?php  } } ?>
				<?php  } ?>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">使用分类</label>
				<div class="col-sm-9 col-xs-12">
					<a href="javascript:;" class="btn btn-default btn-sm category-add" id="category-add"><i class="fa fa-plus-circle"></i> 选择分类</a>
				</div>
			</div>
			<div class="category-container clearfix">
				<div class="col-sm-2 control-label"></div>
				<div class="col-sm-10" id="categorys">
					<?php  if(!empty($item['redpacket']['category'])) { ?>
					<?php  if(is_array($item['redpacket']['category'])) { foreach($item['redpacket']['category'] as $index => $c) { ?>
						<div class="col-sm-3">
							<div class="category-item" id="category-<?php  echo $index;?>">
								<a href="javascript:;" class="btn-del delete-category"></a>
								<img src="<?php  echo tomedia($c['src'])?>" alt=""/>
								<div class="title js-selectCategory" data-id-input="#id-<?php  echo $index;?>" data-title-input="#title-<?php  echo $index;?>" data-src-input="#src-<?php  echo $index;?>" data-element="#category-<?php  echo $index;?>"><?php  echo $c['title'];?></div>
								<input type="hidden" class="diy-bind" id="id-<?php  echo $index;?>" data-bind-child="redpackets" data-bind-parent="<?php  echo $index;?>" data-bind="categorys" data-bind-category="<?php  echo $index;?>" data-bind-type="id" name="category_id[]" value="<?php  echo $c['id'];?>">
								<input type="hidden" class="diy-bind" id="title-<?php  echo $index;?>" data-bind-child="redpackets" data-bind-parent="<?php  echo $index;?>" data-bind="categorys" data-bind-category="<?php  echo $index;?>" data-bind-type="title" name="category_title[]" value="<?php  echo $c['title'];?>">
								<input type="hidden" class="diy-bind" id="src-<?php  echo $index;?>" data-bind-child="redpackets" data-bind-parent="<?php  echo $index;?>" data-bind="categorys" data-bind-category="<?php  echo $index;?>" data-bind-type="src" name="category_src[]" value="<?php  echo $c['src'];?>">
							</div>
						</div>
					<?php  } } ?>
					<?php  } ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品原价</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" name="old_price" value="<?php  echo $item['old_price'];?>">
					<div class="input-group-addon">元</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">兑换限制</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<div class="input-group-addon">每人共</div>
					<input type="number" class="form-control" name="chance" value="<?php  echo $item['chance'];?>" required="true">
					<div class="input-group-addon">次</div>
					<!--<div class="input-group-addon">次,每天提供</div>-->
					<!--<input type="number" class="form-control" name="totalday" value="<?php  echo $item['totalday'];?>" required="true">-->
					<!--<div class="input-group-addon">份</div>-->
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动消耗</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<div class="input-group-addon">消耗</div>
					<input type="text" class="form-control" name="use_credit1" value="<?php  echo $item['use_credit1'];?>" required="true">
					<div class="input-group-addon">积分+金额</div>
					<input type="text" class="form-control" name="use_credit2" value="<?php  echo $item['use_credit2'];?>">
					<div class="input-group-addon">元</div>
				</div>
				<div class="help-block">
					可任意组合，可以单独积分兑换，或者积分+现金形式兑换(积分必须大于0)
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动状态</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="radio radio-inline">
					<input type="radio" name="status" id="status-1" value="1" <?php  if($item['status'] == 1) { ?>checked<?php  } ?>>
					<label for="status-1">开启</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="status" id="status-0" value="0" <?php  if(!$item['status']) { ?>checked<?php  } ?>>
					<label for="status-0">关闭</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品详情</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_ueditor('description', $item['description']);?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
require(['clockpicker'], function($){
	$('.clockpicker :text').clockpicker({autoclose: true});

	$('#hour-add').click(function(){
		var hour_length = $('#hour .hour-item').length;
		if(hour_length < 3) {
			var html =  '<div class="form-group hour-item">'+
						'	<div class="col-sm-2 control-label"></div>'+
						'	<div class="col-sm-9 col-xs-4 col-md-4">'+
						'		<div class="input-group">'+
						'			<input type="text" readonly class="form-control" name="start_hour[]">'+
						'			<span class="input-group-addon border-0-lr">至</span>'+
						'			<input type="text" readonly class="form-control" name="end_hour[]">'+
						'		</div>'+
						'	</div>'+
						'	<div class="col-sm-9 col-xs-4 col-md-3">'+
						'		<a href="javascript:;" class="fa fa-times-circle delete-hour"></a>'+
						'	</div>'+
						'</div>';
			$('#hour').append(html);
			$('.clockpicker :text').clockpicker({autoclose: true});
		} else {
			util.message('最多可添加3个时间段', '', 'error');
			return false;
		}
	});

	$('.hour-item .delete-hour').click(function(){
		$(this).parent().parent().remove();
	});

	$('#category-add').click(function(){
		var timestamp = Date.parse(new Date());
		var num = parseInt(1000 * Math.random());
		timestamp = timestamp + num;
		var html = '<div class="col-sm-3">'+
					'	<div class="category-item" id="category-'+timestamp+'">'+
					'		<a href="javascript:;" class="btn-del delete-category"></a>'+
					'		<img src="" alt=""/>'+
					'		<div class="title js-selectCategory" data-id-input="#id-'+timestamp+'" data-title-input="#title-'+timestamp+'" data-src-input="#src-'+timestamp+'" data-element="#category-'+timestamp+'">选择分类</div>'+
					'		<input type="hidden" class="diy-bind" id="id-'+timestamp+'" data-bind-child="redpackets" data-bind-parent="'+timestamp+'" data-bind="categorys" data-bind-category="'+timestamp+'" data-bind-type="id" name="category_id[]">'+
					'		<input type="hidden" class="diy-bind" id="title-'+timestamp+'" data-bind-child="redpackets" data-bind-parent="'+timestamp+'" data-bind="categorys" data-bind-category="'+timestamp+'" data-bind-type="title" name="category_title[]">'+
					'		<input type="hidden" class="diy-bind" value="" id="src-'+timestamp+'" data-bind-child="redpackets" data-bind-parent="'+timestamp+'" data-bind="categorys" data-bind-category="'+timestamp+'" data-bind-type="src" name="category_src[]">'+
					'	</div>'+
					'</div>';
		$('#categorys').append(html);
	});

	$('.category-item .delete-category').click(function(){
		$(this).parent().parent().remove();
	});
});
</script>
<?php  } else if($op == 'list') { ?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('creditshop/goods/list');?>
	<input type="hidden" name="ta" value="list"/>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品类型</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a class="btn <?php  if(!$type) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('creditshop/goods/list')?>">不限</a>
				<a class="btn <?php  if($type == 'goods') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('creditshop/goods/list', array('type' => 'goods'))?>">商品</a>
				<a class="btn <?php  if($type == 'credit2') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('creditshop/goods/list', array('type' => 'credit2'))?>">余额</a>
				<a class="btn <?php  if($type == 'redpacket') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('creditshop/goods/list', array('type' => 'redpacket'))?>">红包</a>
			</div>
		</div>
	</div>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">筛选</label>
		<div class="col-sm-9 col-xs-12">
			<div class="input-group">
				<input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="商品名称">
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<button class="btn btn-primary">筛选</button>
		</div>
	</div>
</form>


<form action="" class="form-table form form-validate" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('creditshop/goods/post');?>" class="btn btn-primary btn-sm">添加商品</a>
		</div>
		<?php  if(!empty($lists)) { ?>
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<th width="30">
							<div class="checkbox checkbox-inline">
								<input type="checkbox">
								<label></label>
							</div>
						</th>
						<th>缩略图</th>
						<th>商品原价</th>
						<th>商品名称</th>
						<th>排序</th>
						<th>商品类型</th>
						<th>是否上架</th>
						<th style="width:150px; text-align:right;">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($lists)) { foreach($lists as $item) { ?>
					<input type="hidden" name="ids[]" value="<?php  echo $item['id'];?>">
					<tr>
						<td>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="id[]" value="<?php  echo $item['id'];?>">
								<label></label>
							</div>
						</td>
						<td><img src="<?php  echo tomedia($item['thumb']);?>" width="38" style="border-radius: 3px;"></td>
						<td>
							<input type="text" name="old_prices[]" class="form-control width-100" value="<?php  echo $item['old_price'];?>">
						</td>
						<td>
							<input type="text" name="titles[]" class="form-control width-100" value="<?php  echo $item['title'];?>">
						</td>
						<td>
							<input type="text" name="displayorders[]" class="form-control width-100" value="<?php  echo $item['displayorder'];?>">
						</td>
						<td>
							<?php  if($item['type'] == 'goods') { ?>
							商品
							<?php  } else if($item['type'] == 'credit2') { ?>
							余额
							<?php  } else { ?>
							红包
							<?php  } ?>
						</td>
						<td>
							<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('creditshop/goods/status', array('id' => $item['id']));?>" data-name="status" value="<?php  echo $item['status'];?>" <?php  if($item['status'] == 1) { ?>checked<?php  } ?>>
						</td>
						<td style="text-align:right;">
							<a href="<?php  echo iurl('creditshop/goods/post', array('id' => $item['id']))?>" class="btn btn-default btn-sm" title="编辑" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"> </i></a>
							<a href="<?php  echo iurl('creditshop/goods/del', array('id' => $item['id']))?>" class="btn btn-default btn-sm js-remove" title="删除" data-toggle="tooltip" data-placement="top" data-confirm="删除后将不可恢复，确定删除吗?"><i class="fa fa-times"> </i></a>
						</td>
					</tr>
					<?php  } } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<div class="pull-left">
					<input type="submit" class="btn btn-primary btn-sm" value="提交修改">
					<a href="<?php  echo iurl('creditshop/goods/del')?>" class="btn btn-danger btn-sm js-batch" data-batch="remove" data-confirm="确定删除选中的商品吗?">批量删除</a>
				</div>
				<div class="pull-right">
					<?php  echo $pager;?>
				</div>
			</div>
		</div>
		<?php  } else { ?>
		<div class="no-result">
			<p>还没有相关数据</p>
		</div>
		<?php  } ?>
	</div>
</form>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>