<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'post') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div id="tpl">
			<div class="form-group">
				<input type="hidden" name="id" value="<?php  echo $id;?>">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">分类名称</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">分类描述</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" class="form-control" name="description" value="<?php  echo $item['description'];?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">可售时间段</label>
				<div class="col-sm-9 col-xs-12">
					<div class="radio radio-inline">
						<input type="radio" name="is_showtime" id="is_showtime-0" value="0" <?php  if($item['is_showtime'] == 0 || !$item['is_showtime']) { ?>checked<?php  } ?> onclick="$('#is_showtime').hide();">
						<label for="is_showtime-0">不限</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" name="is_showtime" id="is_showtime-1" value="1" <?php  if($item['is_showtime'] == 1) { ?>checked<?php  } ?> onclick="$('#is_showtime').show();">
						<label for="is_showtime-1">指定时间段</label>
					</div>
				</div>
			</div>
			<div id="is_showtime" <?php  if($item['is_showtime'] == 1) { ?>style="display: block"<?php  } else { ?>style="display: none;"<?php  } ?>>
				<div class="clockpicker">
					<div class="form-group hour-item">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
						<div class="col-sm-9 col-xs-12">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">分类显示时段</label>
							<div class="input-group">
								<input type="text" readonly name="start_time" class="form-control" placeholder="" value="<?php  echo $item['start_time'];?>">
								<span class="input-group-addon">至</span>
								<input type="text" readonly name="end_time" class="form-control" placeholder="" value="<?php  echo $item['end_time'];?>">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">星期几显示</label>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="week[]" id="week-1" value="1" <?php  if($item['week'] && in_array(1, $item['week'])) { ?>checked<?php  } ?>>
							<label for="week-1">星期一</label>
						</div>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="week[]" id="week-2" value="2" <?php  if($item['week'] && in_array(2, $item['week'])) { ?>checked<?php  } ?>>
							<label for="week-2">星期二</label>
						</div>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="week[]" id="week-3" value="3" <?php  if($item['week'] && in_array(3, $item['week'])) { ?>checked<?php  } ?>>
							<label for="week-3">星期三</label>
						</div>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="week[]" id="week-4" value="4" <?php  if($item['week'] && in_array(4, $item['week'])) { ?>checked<?php  } ?>>
							<label for="week-4">星期四</label>
						</div>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="week[]" id="week-5" value="5" <?php  if($item['week'] && in_array(5, $item['week'])) { ?>checked<?php  } ?>>
							<label for="week-5">星期五</label>
						</div>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="week[]" id="week-6" value="6" <?php  if($item['week'] && in_array(6, $item['week'])) { ?>checked<?php  } ?>>
							<label for="week-6">星期六</label>
						</div>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="week[]" id="week-7" value="7" <?php  if($item['week'] && in_array(7, $item['week'])) { ?>checked<?php  } ?>>
							<label for="week-7">星期日</label>
						</div>
						<div class="help-block" style="padding-left: 15px;">
							此项若不勾选，默认为周一至周日均为可售时间段。
						</div>
					</div>
				</div>

			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">分类内最低消费金额</label>
				<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<input type="text" class="form-control" name="min_fee" value="<?php  echo $item['min_fee'];?>">
						<div class="input-group-addon">元</div>
					</div>
					<div class="help-block">
						限制在该分类内， 购买的商品不能少于多少元。适用场景：快餐分类，这个分类内的商品，下单金额必须满足元才能下单。该设置仅对外卖有效。消费金额不包括餐盒费
					</div>
				</div>
			</div>
			<div class="form-group" style="border-bottom: 0">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">分类排序</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" class="form-control" name="displayorder" value="<?php  echo $item['displayorder'];?>">
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
});
</script>
<?php  } else if($ta == 'child') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div id="tpl">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">父级分类</label>
				<div class="col-sm-9 col-xs-12 col-md-5">
					<select class="form-control select2" id="parentid" name="parentid">
					<?php  if(is_array($parents)) { foreach($parents as $parent) { ?>
						<option value="<?php  echo $parent['id'];?>" <?php  if($item['parentid'] == $parent['id'] || $_GPC['parentid'] == $parent['id']) { ?>selected<?php  } ?>><?php  echo $parent['title'];?></option>
					<?php  } } ?>
				</select>
				</div>
			</div>
			<div class="form-group">
				<input type="hidden" name="id" value="<?php  echo $id;?>">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">子分类名称</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>">
				</div>
			</div>
			<div class="form-group" style="border-bottom: 0">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">子分类排序</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" class="form-control" name="displayorder" value="<?php  echo $item['displayorder'];?>">
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
<?php  } else if($ta == 'list') { ?>
<form action="" class="form-table form form-validate" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('store/goods/category/post');?>" class="btn btn-primary btn-sm">添加分类</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<th>分类名称</th>
						<th>最低消费金额（元）</th>
						<th>排序</th>
						<th>显示时间段</th>
						<th>星期几显示</th>
						<th>是否显示</th>
						<th style="text-align:right;">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($lists)) { foreach($lists as $item) { ?>
					<tr>
						<input type="hidden" name="ids[]" value="<?php  echo $item['id'];?>">
						<td><input type="text" name="title[]" class="form-control width-100" value="<?php  echo $item['title'];?>"></td>
						<td><input type="text" name="min_fee[]" class="form-control width-100" value="<?php  echo $item['min_fee'];?>"></td>
						<td><input type="text" name="displayorder[]" class="form-control width-100" value="<?php  echo $item['displayorder'];?>"></td>
						<td>
							<?php  if($item['is_showtime'] == 0) { ?>
								不限
							<?php  } else if($item['is_showtime'] == 1) { ?>
								<?php  if(empty($item['start_time'])) { ?>
									不限
								<?php  } else { ?>
									<?php  echo $item['start_time'];?>到<?php  echo $item['end_time'];?>
								<?php  } ?>
							<?php  } ?>
						</td>
						<td>
							<?php  if($item['is_showtime'] == 1) { ?>
								<?php  if(!empty($item['week'])) { ?>
									<?php  if(is_array($item['week'])) { foreach($item['week'] as $row) { ?>
									<?php  if($row == 1) { ?>
										星期一
									<?php  } else if($row == 2) { ?>
										星期二
									<?php  } else if($row == 3) { ?>
										星期三
									<?php  } else if($row == 4) { ?>
										星期四
									<?php  } else if($row == 5) { ?>
										星期五
									<?php  } else if($row == 6) { ?>
										星期六
									<?php  } else if($row == 7) { ?>
										星期日
									<?php  } ?>
									<?php  } } ?>
								<?php  } ?>
							<?php  } else { ?>
								不限
							<?php  } ?>
						</td>
						<td>
							<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('store/goods/category/status', array('id' => $item['id']));?>" data-name="status" value="<?php  echo $item['status'];?>" <?php  if($item['status'] == 1) { ?>checked<?php  } ?>>
						</td>
						<td style="text-align:right;">
							<!--<a href="<?php  echo iurl('store/goods/category/child', array('parentid' => $item['id']))?>" class="btn btn-default btn-sm">添加子分类</a>-->
							<a href="<?php  echo iurl('store/goods/category/post', array('id' => $item['id']))?>" class="btn btn-default btn-sm">修改分类</a>
							<a href="<?php  echo iurl('store/goods/index/list', array('cid' => $item['id']))?>" class="btn btn-default btn-sm" title="查看商品" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"> </i></a>
							<a href="<?php  echo iurl('store/goods/index/post', array('cid' => $item['id']))?>" class="btn btn-default btn-sm" title="添加商品" data-toggle="tooltip" data-placement="top" ><i class="fa fa-plus"> </i></a>
							<a href="<?php  echo iurl('store/goods/category/del', array('id' => $item['id']))?>" class="btn btn-default btn-sm js-remove" title="删除" data-toggle="tooltip" data-placement="top" data-confirm="确定删除该分类吗?"><i class="fa fa-times"> </i></a>
						</td>
					</tr>
						<?php  if(!empty($item['child'])) { ?>
							<?php  if(is_array($item['child'])) { foreach($item['child'] as $row) { ?>
							<tr>
								<input type="hidden" name="ids[]" value="<?php  echo $row['id'];?>">
								<td style="padding-left: 35px;"><input type="text" name="title[]" class="form-control width-100" value="<?php  echo $row['title'];?>"></td>
								<td></td>
								<td><input type="text" name="displayorder[]" class="form-control width-100" value="<?php  echo $row['displayorder'];?>"></td>
								<td></td>
								<td></td>
								<td>
									<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('store/goods/category/status', array('id' => $row['id']));?>" data-name="status" value="<?php  echo $row['status'];?>" <?php  if($row['status'] == 1) { ?>checked<?php  } ?>>
								</td>
								<td style="text-align:right;">
									<a href="<?php  echo iurl('store/goods/category/child', array('id' => $row['id']))?>" class="btn btn-default btn-sm">修改分类</a>
									<a href="<?php  echo iurl('store/goods/index/list', array('cid' => $item['id'].':'.$row['id']))?>" class="btn btn-default btn-sm" title="查看商品" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"> </i></a>
									<a href="<?php  echo iurl('store/goods/index/post', array('cid' => $row['id']))?>" class="btn btn-default btn-sm" title="添加商品" data-toggle="tooltip" data-placement="top" ><i class="fa fa-plus"> </i></a>
									<a href="<?php  echo iurl('store/goods/category/del', array('id' => $row['id']))?>" class="btn btn-default btn-sm js-remove" title="删除" data-toggle="tooltip" data-placement="top" data-confirm="确定删除该分类吗?"><i class="fa fa-times"> </i></a>
								</td>
							</tr>
							<?php  } } ?>
						<?php  } ?>
					<?php  } } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<div class="pull-left">
					<input type="submit" class="btn btn-primary btn-sm" value="提交修改">
				</div>
				<div class="pull-right">
					<?php  echo $pager;?>
				</div>
			</div>
		</div>
	</div>
</form>
<?php  } else if($ta == 'export') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<div class="col-sm-9 col-xs-12">
				<a class="btn btn-default" href="<?php echo WE7_WMALL_URL;?>resource/excel/goods_category.xls">下载导入模板</a>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-12">
				<input type="file" name="file" value="" required="true">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="导入" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>