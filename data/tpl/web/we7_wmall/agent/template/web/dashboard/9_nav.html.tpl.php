<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="" class="form-table" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('dashboard/nav/post');?>" class="btn btn-primary btn-sm">添加导航图标</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($navs)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead>
					<tr>
						<th width="70">图标</th>
						<th>排序</th>
						<?php  if($_W['is_agent']) { ?>
							<th>所属城市</th>
						<?php  } ?>
						<th>分类名称</th>
						<th>分类类型</th>
						<th>是否显示</th>
						<th style="width:150px; text-align:right;">操作</th>
					</tr>
					</thead>
					<tbody>
					<?php  if(is_array($navs)) { foreach($navs as $item) { ?>
					<tr>
						<input type="hidden" name="ids[]" value="<?php  echo $item['id'];?>">
						<td><img src="<?php  echo tomedia($item['thumb']);?>" width="50"></td>
						<td><input type="text" name="displayorder[]" class="form-control width-100" value="<?php  echo $item['displayorder'];?>"></td>
						<?php  if($_W['is_agent']) { ?>
							<td><?php  echo toagent($item['agentid'])?></td>
						<?php  } ?>
						<td><input type="text" name="title[]" class="form-control width-130" value="<?php  echo $item['title'];?>"></td>
						<td>
							<?php  if(empty($item['link'])) { ?>
								<span class="label label-success">系统链接</span>
							<?php  } else { ?>
								<span class="label label-danger">自定义链接</span>
							<?php  } ?>
						</td>
						<td>
							<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('dashboard/nav/status', array('id' => $item['id']));?>" data-name="status" value="1" <?php  if($item['status'] == 1) { ?>checked<?php  } ?>>
						</td>
						<td style="text-align:right;">
							<a href="<?php  echo iurl('dashboard/nav/post', array('id' => $item['id']))?>" class="btn btn-default btn-sm">编辑</a>
							<a href="<?php  echo iurl('dashboard/nav/del', array('id' => $item['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="确定删除该导航?">删除</a>
						</td>
					</tr>
					<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-left">
						<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
						<input type="submit" class="btn btn-primary btn-sm" name="submit" value="提交修改" />
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
	<h2>编辑导航</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
			<div class="col-sm-9 col-xs-12">
				<input type="number" class="form-control" name="displayorder" value="<?php  echo $category['displayorder'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">分类名称</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="title" value="<?php  echo $category['title'];?>" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">图标</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_image('thumb', $category['thumb']);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跳转链接(选填)</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<?php  echo tpl_form_field_tiny_link('link', $category['link']);?>
				<span class="help-block">
					如果设置了跳转链接，客户点击分类， 将直接跳转到设置的链接。<storng class="text-danger">同时， 商家在后台选择店铺所属分类时，该分类不会显示在可选项中。</storng>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">小程序跳转链接(选填)</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<?php  echo tpl_form_field_tiny_wxapp_link('wxapp_link', $category['wxapp_link']);?>
				<span class="help-block">
					如果设置了小程序跳转链接，客户点击分类，将直接跳转到设置的小程序链接。
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启幻灯片</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="radio radio-inline">
					<input type="radio" name="slide_status" value="1" id="slide-status-1" <?php  if($category['slide_status'] == 1) { ?>checked<?php  } ?> onclick="$('#slide-container').removeClass('hide')">
					<label for="slide-status-1">启用</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="slide_status" value="0" id="slide-status-0" <?php  if(!$category['slide_status']) { ?>checked<?php  } ?> onclick="$('#slide-container').addClass('hide')">
					<label for="slide-status-0">关闭</label>
				</div>
			</div>
		</div>
		<div class="form-group <?php  if(!$category['slide_status']) { ?>hide<?php  } ?>" id="slide-container">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">幻灯片列表</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<table class="table table-hover table-bordered">
					<thead class="navbar-inner">
					<tr>
						<th>缩略图</th>
						<th>跳转链接</th>
						<th width="200">排序</th>
						<th class="text-right">操作</th>
					</tr>
					</thead>
					<tbody id="tpl-slide-container">
					<?php  if(!empty($category['slide'])) { ?>
					<?php  if(is_array($category['slide'])) { foreach($category['slide'] as $slide) { ?>
						<tr>
							<td>
								<div class="input-group ">
									<div class="input-group-addon">
										<img src="<?php  echo tomedia($slide['thumb']);?>" width="20" height="20">
									</div>
									<input type="text" name="slide_image[]" value="<?php  echo $slide['thumb'];?>" class="form-control" autocomplete="off">
									<span class="input-group-btn">
										<button class="btn btn-default btn-image" type="button">选择图片</button>
									</span>
								</div>
							</td>
							<td>
								<div class="input-group">
									<input type="text" value="<?php  echo $slide['link'];?>" name="slide_links[]" class="form-control " autocomplete="off">
									<span class="input-group-btn">
										<button class="btn btn-default btn-links" type="button">选择链接</button>
									</span>
								</div>
							</td>
							<td><input type="text" name="slide_displayorder[]" class="form-control" value="<?php  echo $slide['displayorder'];?>"></td>
							<td class="text-right">
								<a href="javascript:;" class="btn btn-default btn-del" title="删除" data-toggle="tooltip" data-placement="top"><i class="fa fa-times"> </i></a>
							</td>
						</tr>
					<?php  } } ?>
					<?php  } ?>
					</tbody>
					<tfooter>
						<tr>
							<td colspan="4">
								<a href="javascipt:;" class="text-primary" id="edit-add"><i class="fa fa-plus-circle"></i> 继续添加</a>
							</td>
						</tr>
					</tfooter>
				</table>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启导航栏</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="radio radio-inline">
					<input type="radio" name="nav_status" value="1" id="nav-status-1" <?php  if($category['nav_status'] == 1) { ?>checked<?php  } ?> onclick="$('#nav-container').removeClass('hide')">
					<label for="nav-status-1">启用</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="nav_status" value="0" id="nav-status-0" <?php  if(!$category['nav_status']) { ?>checked<?php  } ?> onclick="$('#nav-container').addClass('hide')">
					<label for="nav-status-0">关闭</label>
				</div>
			</div>
		</div>
		<div class="form-group <?php  if(!$category['nav_status']) { ?>hide<?php  } ?>" id="nav-container">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">导航栏</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<table class="table table-hover table-bordered">
					<thead class="navbar-inner">
					<tr>
						<th>图标</th>
						<th>标题</th>
						<th>副标题</th>
						<th>跳转链接</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>
							<div class="input-group ">
								<div class="input-group-addon">
									<img src="<?php  echo tomedia($category['nav'][0]['thumb'])?>" width="20" height="20">
								</div>
								<input type="text" name="nav_thumb[]" value="<?php  echo $category['nav'][0]['thumb'];?>" class="form-control" autocomplete="off">
								<span class="input-group-btn">
									<button class="btn btn-default btn-image" type="button">选择图片</button>
								</span>
							</div>
						</td>
						<td><input type="text" name="nav_title[]" class="form-control" value="<?php  echo $category['nav'][0]['title'];?>"></td>
						<td><input type="text" name="nav_sub_title[]" class="form-control" value="<?php  echo $category['nav'][0]['sub_title'];?>"></td>
						<td>
							<div class="input-group">
								<input type="text" value="<?php  echo $category['nav'][0]['link'];?>" name="nav_links[]" class="form-control " autocomplete="off">
								<span class="input-group-btn">
									<button class="btn btn-default btn-links" type="button">选择链接</button>
								</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<div class="input-group-addon">
									<img src="<?php  echo tomedia($category['nav'][1]['thumb'])?>" width="20" height="20">
								</div>
								<input type="text" name="nav_thumb[]" value="<?php  echo $category['nav'][1]['thumb'];?>" class="form-control" autocomplete="off">
								<span class="input-group-btn">
									<button class="btn btn-default btn-image" type="button">选择图片</button>
								</span>
							</div>
						</td>
						<td><input type="text" name="nav_title[]" class="form-control" value="<?php  echo $category['nav'][1]['title'];?>"></td>
						<td><input type="text" name="nav_sub_title[]" class="form-control" value="<?php  echo $category['nav'][1]['sub_title'];?>"></td>
						<td>
							<div class="input-group">
								<input type="text" value="<?php  echo $category['nav'][1]['link'];?>" name="nav_links[]" class="form-control " autocomplete="off">
								<span class="input-group-btn">
									<button class="btn btn-default btn-links" type="button">选择链接</button>
								</span>
							</div>
						</td>
					</tr>
					</tbody>
				</table>
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
irequire(['web/tiny'], function(tiny){
	var html = '<tr>'+
			'	<td>'+
			'		<div class="input-group ">'+
			'			<div class="input-group-addon">'+
			'				<img src="" width="20" height="20">'+
			'			</div>'+
			'			<input type="text" name="slide_image[]" value="" class="form-control" autocomplete="off">'+
			'			<span class="input-group-btn">'+
			'				<button class="btn btn-default btn-image" type="button">选择图片</button>'+
			'			</span>'+
			'		</div>'+
			'	</td>'+
			'	<td>'+
			'		<div class="input-group">'+
			'			<input type="text" value="" name="slide_links[]" class="form-control " autocomplete="off">'+
			'			<span class="input-group-btn">'+
			'				<button class="btn btn-default btn-links " type="button">选择链接</button>'+
			'			</span>'+
			'		</div>'+
			'	</td>'+
			'	<td><input type="text" name="slide_displayorder[]" class="form-control" value=""></td>'+
			'	<td class="text-right">'+
			'		<a href="javascript:;" class="btn btn-default btn-del" title="删除" data-toggle="tooltip" data-placement="top"><i class="fa fa-times"> </i></a>'+
			'	</td>'+
			'</tr>';

	$(document).on('click', '.btn-image', function(){
		var btn = $(this);
		var ipt = btn.parent().prev();
		var val = ipt.val();
		var img = ipt.parent().parent().find(".input-group-addon img");
		util.image(val, function(url){
			if(url.url){
				if(img.length > 0){
					img.get(0).src = url.url;
				}
				ipt.val(url.attachment);
				ipt.attr("filename",url.filename);
				ipt.attr("url",url.url);
			}
		}, null);
	});

	$(document).on('click', '.btn-links', function() {
		var ipt = $(this).parent().prev();
		tiny.selectLink(function(href){
			ipt.val(href);
		});
	});

	$(document).on('click', '#edit-add', function(){
		$('#tpl-slide-container').append(html);
	});

	$(document).on('click', '.btn-del', function(){
		$(this).parent().parent().remove();
	});
});
</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
