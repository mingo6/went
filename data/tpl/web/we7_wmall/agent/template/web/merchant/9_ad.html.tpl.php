<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="" class="form-table form form-validate" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('merchant/ad/post');?>" class="btn btn-primary btn-sm">添加广告</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($ads)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead>
					<tr>
						<th>图片</th>
						<th>排序</th>
						<th>广告名称</th>
						<th>跳转链接</th>
						<th>状态</th>
						<th class="text-right">操作</th>
					</tr>
					</thead>
					<?php  if(is_array($ads)) { foreach($ads as $ad) { ?>
					<tr>
						<input type="hidden" name="ids[]" value="<?php  echo $ad['id'];?>">
						<td><img width="50" height="30" src="<?php  echo tomedia($ad['thumb'])?>" alt=""></td>
						<td>
							<input type="text" name="displayorders[]" class="form-control width-100" value="<?php  echo $ad['displayorder'];?>">
						</td>
						<td>
							<input type="text" name="titles[]" class="form-control width-130" value="<?php  echo $ad['title'];?>" required="true">
						</td>
						<td><?php  echo $ad['link'];?></td>
						<td>
							<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('merchant/ad/status', array('id' => $ad['id']));?>" data-name="status" value="1" <?php  if($ad['status'] == 1) { ?>checked<?php  } ?>>
						</td>
						<td class="text-right">
							<a href="<?php  echo iurl('merchant/ad/post', array('id' => $ad['id']))?>" class="btn btn-default btn-sm" title="编辑" data-toggle="tooltip" data-placement="top" ><i class="fa fa-edit"> </i> 编辑</a>
							<a href="<?php  echo iurl('merchant/ad/del', array('id' => $ad['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="确定删除该广告?"><i class="fa fa-times"> </i> 删除</a>
						</td>
					</tr>
					<?php  } } ?>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-left">
						<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
						<input type="submit" class="btn btn-primary btn-sm" value="保存" />
					</div>
					<div class="pull-right">
						<?php  echo $pager;?>
					</div>
				</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>

<?php  if($op == 'post') { ?>
<div class="page clearfix">
	<h2>编辑广告</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">广告排序</label>
			<div class="col-sm-9 col-xs-12">
				<input type="number" class="form-control" name="displayorder" value="<?php  echo $ad['displayorder'];?>">
				<span class="help-block">数字越大越靠前</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">广告名称</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="title" value="<?php  echo $ad['title'];?>" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">图片</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_image('thumb', $ad['thumb']);?>
				<div class="help-block">建议图片尺寸:640*240</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跳转链接</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_tiny_link('link', $ad['link']);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否启用</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="status" value="1" id="status-1" <?php  if($ad['status'] == 1) { ?>checked<?php  } ?>>
					<label for="status-1">启用</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="status" value="0" id="status-0" <?php  if(!$ad['status']) { ?>checked<?php  } ?>>
					<label for="status-0">不启用</label>
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
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
