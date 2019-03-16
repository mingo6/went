<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<?php  if($_W['is_agent']) { ?>
<form action="" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('dashboard/cube/list');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择代理区域</label>
		<div class="col-sm-4 col-xs-4">
			<select name="agentid" class="select2 js-select2 form-control width-130">
				<option value="0">选择代理区域</option>
				<?php  if(is_array($_W['agents'])) { foreach($_W['agents'] as $agent) { ?>
					<option value="<?php  echo $agent['id'];?>" <?php  if($agentid == $agent['id']) { ?>selected<?php  } ?>><?php  echo $agent['area'];?></option>
				<?php  } } ?>
			</select>
		</div>
	</div>
</form>
<?php  } ?>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table js-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('dashboard/cube/post');?>" class="btn btn-primary btn-sm">添加图片魔方</a>
		</div>
		<div class="panel-body table-responsive">
			<table class="table table-hover">
				<thead>
				<tr>
					<th>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="id[]"/>
							<label></label>
						</div>
					</th>
					<th>排序</th>
					<?php  if($_W['is_agent']) { ?>
						<th>所属城市</th>
					<?php  } ?>
					<th>图片</th>
					<th>标题</th>
					<th>副标题</th>
					<th>跳转链接</th>
					<th>小程序跳转连接</th>
					<th class="text-right">操作</th>
				</tr>
				</thead>
				<tbody id="tpl-cube-container">
				<?php  if(is_array($cubes)) { foreach($cubes as $cube) { ?>
					<tr class="cube-item">
						<td>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="id[]" value="<?php  echo $cube['id'];?>"/>
								<label></label>
							</div>
						</td>
						<input type="hidden" name="ids[]" value="<?php  echo $cube['id'];?>">
						<td>
							<input type="text" name="displayorder[]" value="<?php  echo $cube['displayorder'];?>" class="form-control width-100">
						</td>
						<?php  if($_W['is_agent']) { ?>
							<td><?php  echo toagent($cube['agentid'])?></td>
							<input type="hidden" name="agentids[]" value="<?php  echo $cube['agentid'];?>">
						<?php  } ?>
						<td>
							<div class="input-group ">
								<div class="input-group-addon">
									<img src="<?php  echo tomedia($cube['thumb']);?>" width="20" height="20">
								</div>
								<input type="text" name="thumbs[]" value="<?php  echo $cube['thumb'];?>" class="form-control" autocomplete="off">
								<span class="input-group-btn">
									<button class="btn btn-default btn-image" type="button">选择图片</button>
								</span>
							</div>
						</td>
						<td>
							<input type="text" name="titles[]" value="<?php  echo $cube['title'];?>" class="form-control width-130">
						</td>
						<td>
							<input type="text" name="tips[]" value="<?php  echo $cube['tips'];?>" class="form-control width-130">
						</td>
						<td>
							<div class="input-group">
								<input type="text" value="<?php  echo $cube['link'];?>" name="links[]" class="form-control">
								<span class="input-group-btn">
									<button class="btn btn-default btn-links" type="button">选择链接</button>
								</span>
							</div>
						</td>
						<td>
							<div class="input-group">
								<input type="text" value="<?php  echo $cube['wxapp_link'];?>" name="wxapp_links[]" class="form-control">
								<span class="input-group-btn">
									<button class="btn btn-default btn-wxapp-links" type="button">选择小程序跳转连接</button>
								</span>
							</div>
						</td>
						<td class="text-right">
							<a href="<?php  echo iurl('dashboard/cube/post', array('id' => $cube['id']))?>" class="btn btn-default btn-sm" title="编辑" data-toggle="tooltip" data-placement="top" >编辑</a>
							<a href="<?php  echo iurl('dashboard/cube/del', array('id' => $cube['id']))?>" class="btn btn-default btn-sm  js-post" data-confirm="确定删除吗">删除</a>
						</td>
					</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
				<input type="submit" class="btn btn-primary btn-sm" name="submit" value="提交修改" />
				<?php  if($_W['is_agent']) { ?>
					<a href="<?php  echo iurl('dashboard/cube/cubeagent')?>" class="btn btn-default btn-sm js-batch" data-batch="modal">批量操作</a>
				<?php  } ?>
			</div>
		</div>
	</div>
</form>
<?php  } ?>
<?php  if($op == 'post') { ?>
<div class="page clearfix">
	<h2>编辑图片魔方</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
			<div class="col-sm-9 col-xs-12">
				<input type="number" class="form-control" name="displayorder" value="<?php  echo $cube['displayorder'];?>">
				<span class="help-block">数字越大越靠前</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">标题</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="title" value="<?php  echo $cube['title'];?>" required="true">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">副标题</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="tips" value="<?php  echo $cube['tips'];?>" required="true">
			</div>
		</div>
		<?php  if($_W['is_agent']) { ?>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择代理</label>
				<div class="col-sm-9 col-xs-12">
					<select name="agentid" class="select2 js-select2 form-control width-130">
						<option value="0">选择代理区域</option>
						<?php  if(is_array($_W['agents'])) { foreach($_W['agents'] as $agent) { ?>
						<option value="<?php  echo $agent['id'];?>" <?php  if($cube['agentid'] == $agent['id']) { ?>selected<?php  } ?>><?php  echo $agent['area'];?></option>
						<?php  } } ?>
					</select>
				</div>
			</div>
		<?php  } ?>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">魔方图片</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_image('thumb', $cube['thumb'])?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跳转链接</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_tiny_link('link', $cube['link']);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">小程序跳转链接</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<?php  echo tpl_form_field_tiny_wxapp_link('wxapp_link', $cube['wxapp_link']);?>
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
<script type="text/javascript">
	irequire(['web/tiny'], function(tiny){
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

		$(document).on('click', '.btn-wxapp-links', function() {
			var ipt = $(this).parent().prev();
			tiny.selectWxappLink(function(href){
				ipt.val(href);
			});
		});

	});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
