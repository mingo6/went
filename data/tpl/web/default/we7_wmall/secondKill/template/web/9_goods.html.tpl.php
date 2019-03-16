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
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">绑定商户</label>
			<div class="col-sm-9 col-xs-12">
				<select class="form-control" name="sid" >
					<option value="">请选择商户</option>
					<?php  if(is_array($store)) { foreach($store as $category) { ?>
					<option value="<?php  echo $category['id'];?>" <?php  if($category['id'] == $item['sid']) { ?>selected<?php  } else { ?><?php  if($item) { ?>disabled<?php  } ?><?php  } ?>><?php  echo $category['title'];?></option>
					<?php  } } ?>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="num" value="<?php  echo $item['num'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品名称</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="name" value="<?php  echo $item['name'];?>" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品简介</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="introduction" value="<?php  echo $item['introduction'];?>" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品分类</label>
			<div class="col-sm-9 col-xs-12">
				<select class="form-control" name="type_id" >
					<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
					<option value="<?php  echo $category['id'];?>" <?php  if($category['id'] == $item['type_id']) { ?>selected<?php  } ?>><?php  echo $category['name'];?></option>
					<?php  } } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品图片</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_image('thumb', $item['thumb']);?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品原价</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" name="y_price" value="<?php  echo $item['y_price'];?>" required="true">
					<div class="input-group-addon">元</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品售价</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" name="s_price" value="<?php  echo $item['s_price'];?>" required="true">
					<div class="input-group-addon">元</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品数量</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="number" value="<?php  echo $item['number'];?>" required="true">
			</div>
		</div>

		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">活动开始时间</label>
			<div class="col-sm-10">
				<?php  echo tpl_form_field_date(start_time, $item['start_time'],$withtime = true);?>
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">活动结束时间</label>
			<div class="col-sm-10">
				<?php  echo tpl_form_field_date(end_time, $item['end_time'],$withtime = true);?>
			</div>
		</div>
		<div class="form-group" style="display: none;">
			<label for="inputEmail3" class="col-sm-2 control-label">消费截止时间</label>
			<div class="col-sm-10">
				<?php  echo tpl_form_field_date(xf_time, $item['xf_time'],$withtime = true);?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品详情</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_ueditor('details', $item['details']);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="radio radio-inline">
					<input type="radio" name="is_shelves" id="status-1" value="1" <?php  if($item['is_shelves'] == 1) { ?>checked<?php  } ?>>
					<label for="status-1">上架</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="is_shelves" id="status-0" value="0" <?php  if(!$item['is_shelves']) { ?>checked<?php  } ?>>
					<label for="status-0">下架</label>
				</div>
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
	<?php  echo tpl_form_filter_hidden('secondKill/goods/list');?>
	<input type="hidden" name="ta" value="list"/>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品类型</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a class="btn <?php  if(!$type) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('secondKill/goods/list')?>">不限</a>
				<?php  if(is_array($category)) { foreach($category as $item) { ?>
				<a class="btn <?php  if($type == $item['id']) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>" href="<?php  echo iurl('secondKill/goods/list', array('type' => $item['id']))?>"><?php  echo $item['name'];?></a>
				<?php  } } ?>
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
			<a href="<?php  echo iurl('secondKill/goods/post');?>" class="btn btn-primary btn-sm">添加商品</a>
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
						<td class="store_td1 col-md-1">顺序</td>
						<td class="col-md-1">商品图片</td>
						<td class="col-md-1">商品名称</td>
						<td class="col-md-1">所属分类</td>
						<td class="col-md-1">开始时间</td>
						<td class="col-md-1">结束时间</td>
						<td class="col-md-1">总数量</td>
						<td class="col-md-1">剩余数量</td>
						<td class="col-md-1">售价</td>
						<td class="col-md-1">销量</td>
						<td class="col-md-1">状态</td>
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
						<td><div><?php  echo $item['num'];?></div></td>
						<td><img src="<?php  echo tomedia($item['thumb']);?>" width="38" style="border-radius: 3px;"></td>
						<td>
							<!--<input type="text" name="name[]" class="form-control width-100" value="<?php  echo $item['name'];?>">-->
							<?php  echo $item['name'];?>
						</td>
						<td>
							<!--<input type="text" name="type_id[]" class="form-control width-100" value="<?php  echo $item['type_id'];?>">-->
							<?php  if(is_array($category)) { foreach($category as $v) { ?>
								<?php  if($v['id']==$item['type_id']) { ?>
									<?php  echo $v['name'];?>
								<?php  } ?>
							<?php  } } ?>
						</td>
						<td>
							<?php  echo date('Y-m-d H:i:s',$item['start_time'])?>
						</td>

						<td>
							<?php  echo date('Y-m-d H:i:s',$item['end_time'])?>
						</td>
						<td>
							<?php  echo $item['number'];?>
						</td>
						<td>
							<?php  echo $item['surplus'];?>
						</td>
						<td>
							<!--<input type="text" name="dd_price[]" class="form-control width-100" value="<?php  echo $item['dd_price'];?>">-->
							<?php  echo $item['s_price'];?>
						</td>
						<td>
							<?php  echo $item['sale_num'];?>
						</td>
						<td>
							<?php  if($item['is_shelves']==1) { ?>
								已上架
							<?php  } else { ?>
								已下架
							<?php  } ?>
						</td>
						<!--<td>-->
							<!--<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('secondKill/goods/status', array('id' => $item['id']));?>" data-name="status" value="<?php  echo $item['status'];?>" <?php  if($item['status'] == 1) { ?>checked<?php  } ?>>-->
						<!--</td>-->
						<td style="text-align:right;">
							<a href="<?php  echo iurl('secondKill/goods/post', array('id' => $item['id']))?>" class="btn btn-default btn-sm" title="编辑" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"> </i></a>
							<a href="<?php  echo iurl('secondKill/goods/del', array('id' => $item['id']))?>" class="btn btn-default btn-sm js-remove" title="删除" data-toggle="tooltip" data-placement="top" data-confirm="删除后将不可恢复，确定删除吗?"><i class="fa fa-times"> </i></a>
						</td>
					</tr>
					<?php  } } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<div class="pull-left">
					<!--<input type="submit" class="btn btn-primary btn-sm" value="提交修改">-->
					<a href="<?php  echo iurl('secondKill/goods/del')?>" class="btn btn-danger btn-sm js-batch" data-batch="remove" data-confirm="确定删除选中的商品吗?">批量删除</a>
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