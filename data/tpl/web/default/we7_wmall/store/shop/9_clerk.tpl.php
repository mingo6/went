<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($ta == 'list') { ?>
<form action="" class="form-table form" id="form-deliveryer" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="javascript:;" class="btn btn-primary btn-sm btn-add">添加店员</a>
		</div>
		<div class="alert alert-warning">每个店铺可设置一个管理员, 管理员可在电脑端登陆商户后台,店员只能在手机上登陆管理门店。电脑端登陆地址:<a href="<?php  echo iurl('store/oauth/login', array(), true);?>" target="_blank"><?php  echo iurl('store/oauth/login', array(), true);?></a></div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($data)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead class="navbar-inner">
					<tr>
						<th width="40">
							<div class="checkbox checkbox-inline">
								<input type="checkbox">
								<label></label>
							</div>
						</th>
						<th width="85">头像</th>
						<th>微信昵称</th>
						<th>店员名称</th>
						<th>手机号</th>
						<th>
							微信模板消息提醒 <br>
							语音电话提醒
						</th>
						<th>身份</th>
						<th>添加时间</th>
						<th style="width:350px; text-align:right;">操作</th>
					</tr>
					</thead>
					<tbody>
					<?php  if(is_array($data)) { foreach($data as $item) { ?>
					<tr>
						<td>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="ids[]" value="<?php  echo $item['aid'];?>">
								<label></label>
							</div>
						</td>
						<td>
							<img src="<?php  echo tomedia($item['avatar']);?>" width="48">
						</td>
						<td><?php  echo $item['nickname'];?></td>
						<td><?php  echo $item['title'];?></td>
						<td><?php  echo $item['mobile'];?></td>
						<td>
							<div style="margin-bottom: 10px;">
								<input type="checkbox" data-on-text="模板" data-off-text="关闭" class="js-checkbox" data-href="<?php  echo iurl('store/shop/clerk/extra', array('id' => $item['id'], 'type' => 'accept_wechat_notice', 'value' => $item['extra']['accept_wechat_notice']));?>" value="1" <?php  if($item['extra']['accept_wechat_notice'] == 1) { ?>checked<?php  } ?>>
							</div>
							<input type="checkbox" data-on-text="语音" data-off-text="关闭" class="js-checkbox" data-href="<?php  echo iurl('store/shop/clerk/extra', array('id' => $item['id'], 'type' => 'accept_voice_notice', 'value' => $item['extra']['accept_voice_notice']));?>" value="1" <?php  if($item['extra']['accept_voice_notice'] == 1) { ?>checked<?php  } ?>>
						</td>
						<td>
							<?php  if($item['role'] == 'manager') { ?>
							<span class="label label-danger">管理员</span>
							<?php  } else { ?>
							<span class="label label-success">店员</span>
							<?php  } ?>
						</td>
						<td><?php  echo date('Y-m-d H:i', $item['addtime']);?></td>
						<td style="text-align:right;">
							<?php  if($item['role'] != 'manager') { ?>
								<a href="<?php  echo iurl('store/shop/clerk/manager', array('id' => $item['aid']))?>" class="btn btn-default btn-sm js-post" data-confirm="确定设置该店员为店铺管理员吗?">设为管理员</a>
							<?php  } ?>
							<a href="<?php  echo iurl('store/shop/clerk/del', array('id' => $item['aid']))?>" class="btn btn-default btn-sm js-remove" data-confirm="确定取消店员权限吗?">删除</a>
						</td>
					</tr>
					<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-left">
						<a href="<?php  echo iurl('store/shop/clerk/del')?>" class="btn btn-primary btn-danger js-batch" data-batch="remove" data-confirm="确定取消店员权限吗?">删除</a>
					</div>
					<div class="pull-right">
						<?php  echo $pager;?>
					</div>
				</div>
			<?php  } ?>
		</div>
	</div>
</form>
<div class="modal fade" id="add-container">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">添加店员</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-info">添加店员之前, 你需要新增一个店员账户(<a href="<?php  echo iurl('store/shop/clerk/cover');?>" target="_blank">注册链接</a>), 然后通过搜索"手机号"把他添加进来</div>
				<form onkeydown="if(event.keyCode==13) {$('.btn-submit').trigger('click');return false};">
					<div class="form-group">
						<label for="mobile">店员手机号</label>
						<input type="text" class="form-control" id="mobile" name="mobile" placeholder="请输入店员手机号" required="true">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary btn-submit">添加</button>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	$(document).on('click', '.btn-add', function(){
		$('#add-container').modal('show');
	});

	$(document).on('click', '.btn-submit', function(){
		var $this = $(this);
		if($this.hasClass('disabled')) {
			return false;
		}
		var mobile = $('#mobile').val();
		if(!mobile) {
			Notify.info('手机号不能为空');
			return false;
		}
		$this.addClass('disabled');
		$.post("<?php  echo iurl('store/shop/clerk/add');?>", {mobile: mobile}, function(data){
			$this.removeClass('disabled');
			var result = $.parseJSON(data);
			if(result.message.errno == -1) {
				Notify.info(result.message.message);
				return false;
			} else {
				Notify.success('添加店员成功', location.href);
			}
		});
	});
});
</script>
<?php  } ?>

<?php  if($ta == 'cover') { ?>
<div class="page clearfix">
	<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
		<h3 class="margin-t-0">电脑端登陆入口</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">直接URL</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static js-clip" data-text="<?php  echo $urls['index'];?>" title="点击复制">
					<a href="javascript:;"><?php  echo $urls['index'];?></a>
				</p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">访问二维码</label>
			<div class="col-sm-9 col-xs-12">
				<div class="qrcode-block js-qrcode" data-text="<?php  echo $urls['index'];?>"></div>
			</div>
		</div>
		<h3 class="margin-t-0">手机注册入口</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">直接URL</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static js-clip" data-text="<?php  echo $urls['register'];?>" title="点击复制">
					<a href="javascript:;"><?php  echo $urls['register'];?></a>
				</p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">访问二维码</label>
			<div class="col-sm-9 col-xs-12">
				<div class="qrcode-block js-qrcode" data-text="<?php  echo $urls['register'];?>"></div>
			</div>
		</div>
		<h3>手机登陆入口</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">直接URL</label>
			<div class="col-sm-9 col-xs-12">
				<p class="form-control-static js-clip" data-text="<?php  echo $urls['login'];?>" title="点击复制">
					<a href="javascript:;"><?php  echo $urls['login'];?></a>
				</p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">访问二维码</label>
			<div class="col-sm-9 col-xs-12">
				<div class="qrcode-block js-qrcode" data-text="<?php  echo $urls['login'];?>"></div>
			</div>
		</div>
	</form>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>