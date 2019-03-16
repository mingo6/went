<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="" class="form-table form form-validate" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('secondKill/category/post');?>" class="btn btn-primary btn-sm">添加新商品分类</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($categorys)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead>
					<tr>
						<th>标题</th>
						<th>显示顺序</th>
						<th class="text-right">操作</th>
					</tr>
					</thead>
					<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
						<tr>
							<input type="hidden" name="ids[]" value="<?php  echo $category['id'];?>">
							<td>
								<!--<input name="name[]" value="<?php  echo $category['name'];?>" class="form-control width-100" required="true" >-->
								<?php  echo $category['name'];?>
							</td>
							<td>
								<!--<input name="displayorders[]" value="<?php  echo $category['displayorder'];?>" class="form-control width-100" required="true" >-->
								<?php  echo $category['displayorder'];?>
							</td>
							<td class="text-right">
								<a href="<?php  echo iurl('secondKill/category/post', array('id' => $category['id']))?>" class="btn btn-default btn-sm" title="编辑" data-toggle="tooltip" data-placement="top" ><i class="fa fa-edit"> </i> 编辑</a>
								<a href="<?php  echo iurl('secondKill/category/del', array('id' => $category['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="确定删除该商品分类?"><i class="fa fa-times"> </i> 删除</a>
							</td>
						</tr>
					<?php  } } ?>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-left">
						<!--<input type="submit" class="btn btn-primary btn-sm" name="submit" value="提交修改" />-->
					</div>
				</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>

<?php  if($op == 'post') { ?>
<div class="page clearfix">
	<h2>编辑商品分类</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">分类名称</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="name" value="<?php  echo $category['name'];?>" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
			<div class="col-sm-9 col-xs-12">
				<input type="number" class="form-control" name="displayorder" value="<?php  echo $category['displayorder'];?>">
				<span class="help-block">数字越大越靠前</span>
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