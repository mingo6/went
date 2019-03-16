<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="alert alert-info">注意：如果你需要将目前平台上所有的幻灯片、公告、投诉、魔方、商户、商户分类、配送员、资讯分配到某一个代理下,您可以使用该功能进行初始化</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择代理</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="0" name="agentid" id="agentid-0" checked>
					<label for="agentid-0">总平台（注意：选中此项后,平台上所有的幻灯片、公告、投诉、魔方、商户、商户分类、配送员、资讯都将分配到总平台）</label>
				</div>
				<br>
				<?php  if(is_array($_W['agents'])) { foreach($_W['agents'] as $agent) { ?>
					<div class="radio radio-inline">
						<input type="radio" value="<?php  echo $agent['id'];?>" name="agentid" id="agentid-<?php  echo $agent['id'];?>">
						<label for="agentid-<?php  echo $agent['id'];?>"><?php  echo $agent['title'];?></label>
					</div>
					<br>
				<?php  } } ?>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<input type="submit" value="确定初始化" class="btn btn-primary" data-confirm="确定要执行初始化操作么?">
		</div>
	</form>
</div>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>