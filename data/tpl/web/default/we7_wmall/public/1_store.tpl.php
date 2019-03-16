<?php defined('IN_IA') or exit('Access Denied');?><?php  if($op == 'list') { ?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button data-dismiss="modal" class="close" type="button">×</button>
			<h4 class="modal-title">选择商户</h4>
		</div>
		<div class="modal-body clearfix store-container">
			<div class="form-group" style="margin: 0; margin-bottom: 20px">
				<div class="input-group">
					<input class="form-control" name="keyword" id="keyword" type="text" placeholder="输入商户名称进行搜索"/>
					<div class="input-group-btn">
						<a class="btn btn-primary" href="javascript:;" id="search"><i class="fa fa-search"></i> 搜索</a>
					</div>
				</div>
			</div>
			<table class="table table-hover table-bordered text-center">
				<thead>
				<tr>
					<th class="text-center">logo</th>
					<th class="text-center">商户ID</th>
					<th class="text-center">名称</th>
					<th class="text-center">操作</th>
				</tr>
				</thead>
				<tbody class="content">
				<tr>
					<td colspan="4">
						<h4><i class="fa fa-info-circle"></i> <span id="info">输入商户名称进行搜索</span></h4>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
		<div class="modal-footer hide">
			<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
			<button type="button" class="btn btn-primary btn-submit">确定</button>
		</div>
	</div>
</div>
<script type="text/html" id="select-store-data">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<tr>
		<td><img src="<{d[i].logo_cn}>" width="50" alt=""/></td>
		<td><{d[i].id}></td>
		<td><{d[i].title}></td>
		<td><a href="javascript:;" class="btn btn-default btn-item" data-id="<{d[i].id}>">选择</a></td>
	</tr>
	<{# } }>
</script>
<?php  } ?>

<?php  if($op == 'category') { ?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button data-dismiss="modal" class="close" type="button">×</button>
			<h4 class="modal-title">选择门店分类</h4>
		</div>
		<div class="modal-body clearfix category-container">
			<div class="form-group" style="margin: 0; margin-bottom: 20px">
				<div class="input-group">
					<input class="form-control" name="keyword" id="keyword" type="text" placeholder="输入分类名称进行搜索"/>
					<div class="input-group-btn">
						<a class="btn btn-primary" href="javascript:;" id="search"><i class="fa fa-search"></i> 搜索</a>
					</div>
				</div>
			</div>
			<table class="table table-hover table-bordered text-center">
				<thead>
				<tr>
					<th class="text-center">图标</th>
					<th class="text-center">分类ID</th>
					<th class="text-center">名称</th>
					<th class="text-center">操作</th>
				</tr>
				</thead>
				<tbody class="content">
				<tr>
					<td colspan="4">
						<h4><i class="fa fa-info-circle"></i> <span id="info">输入分类名称进行搜索</span></h4>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
		<div class="modal-footer hide">
			<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
			<button type="button" class="btn btn-primary btn-submit">确定</button>
		</div>
	</div>
</div>
<script type="text/html" id="select-category-data">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<tr>
		<td><img src="<{d[i].thumb_cn}>" width="50" alt=""/></td>
		<td><{d[i].id}></td>
		<td><{d[i].title}></td>
		<td><a href="javascript:;" class="btn btn-default btn-item" data-id="<{d[i].id}>">选择</a></td>
	</tr>
	<{# } }>
</script>
<?php  } ?>

