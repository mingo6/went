<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'index') { ?>
<form action="" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('merchant/activity/index');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动类型</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo ifilter_url('type:' . '');?>" class="btn <?php  if($type == '') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<?php  if(is_array($all_activity)) { foreach($all_activity as $key => $discount) { ?>
					<a href="<?php  echo ifilter_url('type:' . $key);?>" class="btn <?php  if($type == $key) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>"><?php  echo $discount['title'];?></a>
				<?php  } } ?>
			</div>
		</div>
	</div>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">其他</label>
		<div class="col-sm-9 col-xs-12">
			<select name="sid" class="form-control select2 js-select2">
			<option value="0" <?php  if(!$sid) { ?>selected<?php  } ?>>全部门店</option>
				<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
					<option value="<?php  echo $store['id'];?>" <?php  if($sid == $store['id']) { ?>selected<?php  } ?>><?php  echo $store['title'];?></option>
				<?php  } } ?>
			</select>
			<div style="display: inline-block">
				<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d H:i', $starttime), 'end' => date('Y-m-d H:i', $endtime)), true);?>
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
<form action="" class="form-table form" method="post" id="form-activity">
	<div class="panel panel-table">
		<div class="panel-heading clearfix">
			<a href="<?php  echo iurl('merchant/activity/add');?>" class="btn btn-primary btn-sm">创建活动</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($activitis)) { ?>
				<div class="no-result">暂时没有相关数据</div>
			<?php  } else { ?>
				<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th>
						<div class="checkbox checkbox-inline">
							<input type="checkbox">
							<label></label>
						</div>
					</th>
					<th>门店</th>
					<th>活动类型</th>
					<th>活动内容</th>
					<th>活动时间</th>
					<th>活动状态</th>
					<th style="width:350px; text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($activitis)) { foreach($activitis as $activity) { ?>
				<tr>
					<td>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="id[]" value="<?php  echo $activity['id'];?>">
							<label></label>
						</div>
					</td>
					<td>
						<?php  echo $stores[$activity['sid']]['title'];?>
					</td>
					<td>
						<span class="label <?php  echo $all_activity[$activity['type']]['label'];?>"><?php  echo $all_activity[$activity['type']]['title'];?></span>
					</td>
					<td><?php  echo $activity['title'];?></td>
					<td><?php  echo date('Y-m-d', $activity['starttime'])?>~<?php  echo date('Y-m-d', $activity['endtime'])?></td>
					<td>
						<?php  if($activity['status'] == 0) { ?>
							<span class="label label-danger label-br">已结束</span>
						<?php  } else if($activity['status'] == 1) { ?>
							<span class="label label-info label-br">进行中</span>
						<?php  } else { ?>
							<span class="label label-warning label-br">待开启</span>
						<?php  } ?>
					</td>
					<td style="text-align:right;">
						<a href="<?php  echo iurl('merchant/activity/del', array('id' => $activity['id']))?>" class="btn btn-default btn-sm js-post" data-confirm="确定撤销吗?">撤销活动</a>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
				<div class="btn-region clearfix">
				<div class="pull-left">
					<a href="<?php  echo iurl('merchant/activity/del')?>" class="btn btn-danger btn-sm js-batch" data-batch="remove" data-confirm="确定撤销吗?">撤销活动</a>
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
<?php  if($op == 'add') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form2" action="" method="post" enctype="multipart/form-data">
		<div class="alert alert-danger">创建活动将会覆盖商户已经创建的同类型活动，请谨慎操作！</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动类型</label>
			<div class="col-sm-9 col-xs-12" style="padding: 0">
				<?php  if(is_array($all_activity)) { foreach($all_activity as $item) { ?>
					<div class="col-sm-3 col-xs-3 toggle-tabs" data-content=".activity-content">
						<div class="radio radio-inline">
							<input type="radio" value="<?php  echo $item['key'];?>" class="activity-type" name="type" id="<?php  echo $item['key'];?>">
							<label for="<?php  echo $item['key'];?>" class="toggle-role" data-target="activity-<?php  echo $item['key'];?>"><?php  echo $item['title'];?></label>
						</div>
					</div>
				<?php  } } ?>
			</div>
		</div>
		<h3>活动信息</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动开始时间</label>
			<div class="col-sm-6 col-xs-6 col-md-4">
				<?php  echo tpl_form_field_date('starttime', '', true);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动结束时间</label>
			<div class="col-sm-6 col-xs-6 col-md-4">
				<?php  echo tpl_form_field_date('endtime', '', true);?>
			</div>
		</div>
		<h3>优惠信息</h3>
		<div class="toggle-content activity-content">
			<div class="toggle-pane" id="activity-selfDelivery">
				<?php  if(is_array($length)) { foreach($length as $index) { ?>
				<div class="form-group item">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">自提优惠</label>
					<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">满</span>
							<input type="text" name="condition_selfDelivery[]" value="" class="form-control">
							<span class="input-group-addon">元</span>
							<span class="input-group-addon">打</span>
							<input type="text" name="back_selfDelivery[]" value="" class="form-control">
							<span class="input-group-addon">折</span>
							<?php  if(!empty($_W['ismanager'])) { ?>
								<span class="input-group-addon">平台承担</span>
								<input type="text" name="plateform_charge_selfDelivery[]" value="" class="form-control">
								<span class="input-group-addon">折</span>
								<span class="input-group-addon">代理商承担</span>
								<input type="text" name="agent_charge_selfDelivery[]" value="" class="form-control">
								<span class="input-group-addon">折</span>
							<?php  } else if(!empty($_W['isagenter'])) { ?>
								<span class="input-group-addon">代理商承担</span>
								<input type="text" name="agent_charge_selfDelivery[]" value="" class="form-control">
								<span class="input-group-addon">折</span>
							<?php  } ?>
							<div class="input-group-btn">
								<a href="javascript:;" class="btn btn-danger btn-turncate">清空</a>
							</div>
						</div>
					<span class="help-block">
						在线支付满<?php  echo $item['condition'];?>元打<?php  echo $item['back'];?>折 (平台承担: <?php  echo $item['plateform_charge'];?>折, 代理商承担: <?php  echo $item['agent_charge'];?>折, 商户承担: <?php  echo $item['store_charge'];?>折)
					</span>
					</div>
				</div>
				<?php  } } ?>
			</div>
			<div class="toggle-pane" id="activity-grant">
				<?php  if(is_array($length)) { foreach($length as $index) { ?>
					<div class="form-group item">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">满赠优惠</label>
					<div class="col-sm-6">
						<div class="input-group">
							<span class="input-group-addon">满</span>
							<input type="text" name="condition_grant[]" value="" class="form-control">
							<span class="input-group-addon">元</span>
							<span class="input-group-addon">赠送</span>
							<input type="text" name="back_grant[]" value="" class="form-control">
							<div class="input-group-btn">
								<a href="javascript:;" class="btn btn-danger btn-turncate">清空</a>
							</div>
						</div>
					</div>
				</div>
				<?php  } } ?>
			</div>
			<div class="toggle-pane" id="activity-cashGrant">
				<?php  if(is_array($length)) { foreach($length as $index) { ?>
					<div class="form-group item">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">返现优惠<?php  echo $item['condition'];?></label>
					<div class="col-sm-8">
						<div class="input-group">
							<span class="input-group-addon">满</span>
							<input type="text" name="condition_cashGrant[]" value="" class="form-control">
							<span class="input-group-addon">元</span>
							<span class="input-group-addon">返</span>
							<input type="text" name="back_cashGrant[]" value="" class="form-control">
							<?php  if(!empty($_W['ismanager'])) { ?>
								<span class="input-group-addon">平台承担</span>
								<input type="text" name="plateform_charge_cashGrant[]" value="" class="form-control">
								<span class="input-group-addon">元</span>
								<span class="input-group-addon">代理商承担</span>
								<input type="text" name="agent_charge_cashGrant[]" value="" class="form-control">
								<span class="input-group-addon">元</span>
							<?php  } else if(!empty($_W['isagenter'])) { ?>
								<span class="input-group-addon">代理商承担</span>
								<input type="text" name="agent_charge_cashGrant[]" value="" class="form-control">
								<span class="input-group-addon">元</span>
							<?php  } ?>
							<div class="input-group-btn">
								<a href="javascript:;" class="btn btn-danger btn-turncate">清空</a>
							</div>
						</div>
						<span class="help-block">
						</span>
					</div>
				</div>
				<?php  } } ?>
			</div>
			<div class="toggle-pane active" id="activity-mallNewMember">
				<div class="form-group item">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">平台新客立减</label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" name="back_mallNewMember" value="" class="form-control">
							<span class="input-group-addon">元</span>
							<?php  if(!empty($_W['ismanager'])) { ?>
								<span class="input-group-addon">代理商承担</span>
								<input type="text" name="agent_charge_mallNewMember" value="" class="form-control">
								<span class="input-group-addon">元</span>
								<span class="input-group-addon">平台承担</span>
								<input type="text" name="plateform_charge_mallNewMember" value="" class="form-control">
								<span class="input-group-addon">元</span>
							<?php  } else if(!empty($_W['isagenter'])) { ?>
								<span class="input-group-addon">代理商承担</span>
								<input type="text" name="agent_charge_mallNewMember" value="" class="form-control">
								<span class="input-group-addon">元</span>
							<?php  } ?>
							<div class="input-group-btn">
								<a href="javascript:;" class="btn btn-danger btn-turncate">清空</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="toggle-pane" id="activity-newMember">
				<div class="form-group item">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">门店新客立减</label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" name="back_newMember" value="" class="form-control">
							<span class="input-group-addon">元</span>
							<?php  if(!empty($_W['ismanager'])) { ?>
								<span class="input-group-addon">代理商承担</span>
								<input type="text" name="agent_charge_newMember" value="" class="form-control">
								<span class="input-group-addon">元</span>
								<span class="input-group-addon">平台承担</span>
								<input type="text" name="plateform_charge_newMember" value="" class="form-control">
								<span class="input-group-addon">元</span>
							<?php  } else if(!empty($_W['isagenter'])) { ?>
								<span class="input-group-addon">代理商承担</span>
								<input type="text" name="agent_charge_newMember" value="" class="form-control">
								<span class="input-group-addon">元</span>
							<?php  } ?>
							<div class="input-group-btn">
								<a href="javascript:;" class="btn btn-danger btn-turncate">清空</a>
							</div>
						</div>
						<span class="help-block">
						</span>
					</div>
				</div>
			</div>
			<div class="toggle-pane" id="activity-discount">
				<?php  if(is_array($length)) { foreach($length as $index) { ?>
					<div class="form-group item">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">满减优惠<?php  echo $item['condition'];?></label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon">满</span>
								<input type="text" name="condition_discount[]" value="" class="form-control">
								<span class="input-group-addon">元</span>
								<span class="input-group-addon">减</span>
								<input type="text" name="back_discount[]" value="" class="form-control">
								<?php  if(!empty($_W['ismanager'])) { ?>
									<span class="input-group-addon">平台承担</span>
									<input type="text" name="plateform_charge_discount[]" value="" class="form-control">
									<span class="input-group-addon">元</span>
									<span class="input-group-addon">代理商承担</span>
									<input type="text" name="agent_charge_discount[]" value="" class="form-control">
									<span class="input-group-addon">元</span>
								<?php  } else if(!empty($_W['isagenter'])) { ?>
									<span class="input-group-addon">代理商承担</span>
									<input type="text" name="agent_charge_discount[]" value="" class="form-control">
									<span class="input-group-addon">元</span>
								<?php  } ?>
								<div class="input-group-btn">
									<a href="javascript:;" class="btn btn-danger btn-turncate">清空</a>
								</div>
							</div>
							<span class="help-block">
								在线支付满<?php  echo $item['condition'];?>元减<?php  echo $item['back'];?>元 (平台承担: <?php  echo $item['plateform_charge'];?>元, 代理商承担: <?php  echo $item['agent_charge'];?>元, 商户承担: <?php  echo $item['store_charge'];?>元)
							</span>
						</div>
					</div>
				<?php  } } ?>
			</div>
			<div class="toggle-pane" id="activity-deliveryFeeDiscount">
				<?php  if(is_array($length)) { foreach($length as $index) { ?>
				<div class="form-group item">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">满减配送费</label>
					<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">满</span>
							<input type="text" name="condition_deliveryFeeDiscount[]" value="" class="form-control">
							<span class="input-group-addon">元</span>
							<span class="input-group-addon">减</span>
							<input type="text" name="back_deliveryFeeDiscount[]" value="" class="form-control">
							<?php  if(!empty($_W['ismanager'])) { ?>
								<span class="input-group-addon">平台承担</span>
								<input type="text" name="plateform_charge_deliveryFeeDiscount[]" value="" class="form-control">
								<span class="input-group-addon">元</span>
								<span class="input-group-addon">代理商承担</span>
								<input type="text" name="agent_charge_deliveryFeeDiscount[]" value="" class="form-control">
								<span class="input-group-addon">元</span>
							<?php  } else if(!empty($_W['isagenter'])) { ?>
								<span class="input-group-addon">代理商承担</span>
								<input type="text" name="agent_charge_deliveryFeeDiscount[]" value="" class="form-control">
								<span class="input-group-addon">元</span>
							<?php  } ?>
							<div class="input-group-btn">
								<a href="javascript:;" class="btn btn-danger btn-turncate">清空</a>
							</div>
						</div>
					<span class="help-block">
						配送费满<?php  echo $item['condition'];?>元减<?php  echo $item['back'];?>元 (平台承担: <?php  echo $item['plateform_charge'];?>元, 代理商承担: <?php  echo $item['agent_charge'];?>元, 商户承担: <?php  echo $item['store_charge'];?>元)
					</span>
					</div>
				</div>
				<?php  } } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">将服务费率设置同步到商户</label>
			<div class="col-sm-9 col-xs-12 toggle-tabs" data-content=".sync-type">
				<div class="input-group">
					<div class="radio radio-inline">
						<input type="radio" value="1" name="sync" id="sync-1">
						<label for= "sync-1" class="toggle-role" data-target="sync-type-1">同步到所有商户</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" value="2" name="sync" id="sync-2">
						<label for= "sync-2" class="toggle-role" data-target="sync-type-2">同步到指定商户</label>
					</div>
					<div class="help-block">同步后,将为所有商户添加该活动</div>
				</div>
			</div>
		</div>
		<div class="toggle-content sync-type">
			<div class="toggle-pane" id="sync-type-2">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
						<div class="col-xs-3">
							<div class="checkbox checkbox-inline">
								<input type="checkbox" value="<?php  echo $store['id'];?>" name="store_ids[]" id="store_<?php  echo $store['id'];?>">
								<label for="store_<?php  echo $store['id'];?>"><?php  echo $store['title'];?></label>
							</div>
						</div>
						<?php  } } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<?php  if(empty($activity['id']) || !empty($_W['ismanager']) || !empty($_W['isagenter'])) { ?>
				<input type="submit" value="提交" class="btn btn-primary">
				<?php  } ?>
			</div>
		</div>
	</form>
</div>
<script>
$(function(){
	$(':radio[value="mallNewMember"]').next().trigger('click');
	$(document).on('click', '.btn-turncate', function(){
		$(this).parents('.input-group').find(':text').val('');
	})
});
</script>
<?php  } ?>
<?php  if($op == 'displayorder') { ?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="formdisplayorder" action="" method="post" enctype="multipart/form-data">
		<div class="alert alert-danger">小程序和公众号商家列表默认显示两条商家活动，大于两条的活动信息需要顾客点击展开后查看，您可以修改活动排序，使某活动优先展示(排序越大越靠前1-255)，使顾客第一眼看到有该条活动信息。</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">修改活动排序</label>
		</div>
		<?php  if(is_array($all_activity)) { foreach($all_activity as $activity) { ?>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
				<div class="col-sm-9 col-xs-12">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><?php  echo $activity['title'];?></label>
					<div class="col-sm-9 col-xs-4 col-md-9">
						<input type="number" name="displayorder[<?php  echo $activity['key'];?>]" class="form-control" placeholder="排序越大越靠前" value="<?php  echo $displayorder[$activity['key']];?>">
					</div>
				</div>
			</div>
		<?php  } } ?>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">将服务费率设置同步到商户</label>
			<div class="col-sm-9 col-xs-12 toggle-tabs" data-content=".sync-type">
				<div class="input-group">
					<div class="radio radio-inline">
						<input type="radio" value="1" name="sync" id="sync-1">
						<label for= "sync-1" class="toggle-role" data-target="sync-type-1">同步到所有商户</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" value="2" name="sync" id="sync-2">
						<label for= "sync-2" class="toggle-role" data-target="sync-type-2">同步到指定商户</label>
					</div>
					<div class="help-block">同步后,将为所有商户添加该活动</div>
				</div>
			</div>
		</div>
		<div class="toggle-content sync-type">
			<div class="toggle-pane" id="sync-type-2">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
							<div class="col-xs-3">
								<div class="checkbox checkbox-inline">
									<input type="checkbox" value="<?php  echo $store['id'];?>" name="store_ids[]" id="store_<?php  echo $store['id'];?>">
									<label for="store_<?php  echo $store['id'];?>"><?php  echo $store['title'];?></label>
								</div>
							</div>
						<?php  } } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
