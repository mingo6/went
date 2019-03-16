<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'config') { ?>
<div class="page clearfix">
	<div class="alert alert-warning">
		霸王餐活动玩法：<br>
		&nbsp; &nbsp; &nbsp;1. 顾客支付活动设置的金额（例如：参加活动需支付金额1元）,可获得一个唯一奖券号,同时支付的金额会以红包或者顾客账户余额的形式放入顾客的账户
		<br>
		霸王餐幸运号码的计算方式：<br>
		&nbsp; &nbsp; &nbsp;1. 当前活动所有奖券号分配完毕后，选取当期所有参与者参与时间；<br>
		&nbsp; &nbsp; &nbsp;2. 将这些时间的数值进行求和，得到数值A（每个时间按时、分、秒、毫秒的顺序组合，如17：27：57：117则为172757117）；<br>
		&nbsp; &nbsp; &nbsp;3. 用数值A除以商品所需人次数，得到的余数+10001，得到幸运号码，拥有该奖券号码者，即获得该期霸王餐红包.<br>
		霸王餐红包规则：<br>
		&nbsp; &nbsp; &nbsp;1. 目前霸王餐的返现红包都是无门槛使用（即:订单满0元就可使用）<br>
	</div>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#base" aria-controls="base" role="tab" data-toggle="pill">基本设置</a></li>
			<li role="presentation"><a href="#common" aria-controls="common" role="tab" data-toggle="pill">霸王餐设置</a></li>
			<li role="presentation"><a href="#plus" aria-controls="plus" role="tab" data-toggle="pill">霸王餐PLUS设置</a></li>
			<li role="presentation"><a href="#share" aria-controls="share" role="tab" data-toggle="pill">分享设置</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" role="tabpanel" id="base">
				<h3>基本设置</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启</label>
					<div class="col-sm-9 col-xs-12">
						<div class="radio radio-inline">
							<input type="radio" value="1" name="status" id="status-1" <?php  if($activity['status'] == 1) { ?>checked<?php  } ?>>
							<label for="status-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" value="0" name="status" id="status-0" <?php  if($activity['status'] == 0) { ?>checked<?php  } ?>>
							<label for="status-0">关闭</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动名称</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="title" value="<?php  echo $activity['title'];?>" class="form-control" required="true">
						<input type="hidden" name="id" value="<?php  echo $activity['id'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动开始时间</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_form_field_date('starttime', $activity['starttime'], true);?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动结束时间</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_form_field_date('endtime', $activity['endtime'], true);?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">每个顾客每天最多可参与</label>
					<div class="col-sm-9 col-xs-12">
						<input type="number" name="max_partake_times" value="<?php  echo $activity['max_partake_times'];?>" class="form-control" required="true">
						<span class="help-block">0为不限制</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">参与者返现方式</label>
					<div class="col-sm-9 col-xs-12">
						<div class="radio radio-inline">
							<input type="radio" value="0" name="partake_grant_type" id="partake-grant-type-0" <?php  if(!$activity['partake_grant_type']) { ?>checked<?php  } ?>>
							<label for="partake-grant-type-0">不返现</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" value="1" name="partake_grant_type" id="partake-grant-type-1" <?php  if($activity['partake_grant_type'] == 1) { ?>checked<?php  } ?>>
							<label for="partake-grant-type-1">账户红包</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" value="2" name="partake_grant_type" id="partake-grant-type-2" <?php  if($activity['partake_grant_type'] == 2) { ?>checked<?php  } ?>>
							<label for="partake-grant-type-2">账户余额</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">获奖者返现方式</label>
					<div class="col-sm-9 col-xs-12">
						<div class="radio radio-inline">
							<input type="radio" value="1" name="reward_grant_type" id="reward-grant-type-1" <?php  if($activity['reward_grant_type'] == 1 || !$activity['reward_grant_type']) { ?>checked<?php  } ?>>
							<label for="reward-grant-type-1">账户红包</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" value="2" name="reward_grant_type" id="reward-grant-type-2" <?php  if($activity['reward_grant_type'] == 2) { ?>checked<?php  } ?>>
							<label for="reward-grant-type-2">账户余额</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">红包有效期限</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<input type="number" name="redpacket_days_limit" value="<?php  echo $activity['redpacket_days_limit'];?>" class="form-control"  required="true" digtis="true">
							<span class="input-group-addon">天</span>
						</div>
						<span class="help-block">设置红包发放后几天内有效。</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动规则</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_ueditor('agreement', $activity['agreement']);?>
					</div>
				</div>
			</div>
			<div class="tab-pane" role="tabpanel" id="common">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动宣传图</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_form_field_image('thumb', $activity['thumb'])?>
					</div>
				</div>
				<div class="alert alert-info">
					注意: 修改以下活动参数后,只针对修改后、新增的活动期数有效。
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">参加活动需支付金额</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<input type="number" name="pre_partaker_fee" value="<?php  echo $activity['pre_partaker_fee'];?>" class="form-control"  required="true" number="true">
							<span class="input-group-addon">元</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">获奖金额</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<input type="number" name="pre_reward_fee" value="<?php  echo $activity['pre_reward_fee'];?>" class="form-control"  required="true" number="true">
							<span class="input-group-addon">元</span>
						</div>
						<span class="help-block">注意:获奖金额将以红包或账户余额的形式发放给参与者</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">满多少人开奖</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<input class="form-control" type="number" value="<?php  echo $activity['pre_partaker_num'];?>" name="pre_partaker_num" required="true" digtis="true" aria-required="true">
							<span class="input-group-addon">人</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">每人每期最多可参与</label>
					<div class="col-sm-9 col-xs-12">
						<input class="form-control" type="number" value="<?php  echo $activity['pre_max_partake_times'];?>" name="pre_max_partake_times" required="true" digtis="true">
						<span class="help-block">0为不限制</span>
					</div>
				</div>
			</div>
			<div class="tab-pane" role="tabpanel" id="plus">
				<h3>霸王餐PLUS设置</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启霸王餐PLUS</label>
					<div class="col-sm-9 col-xs-12">
						<div class="radio radio-inline">
							<input type="radio" value="1" name="plus_status" id="plus-status-1" <?php  if(!$activity['plus_status'] || $activity['plus_status'] == 1) { ?>checked<?php  } ?>>
							<label for="plus-status-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" value="2" name="plus_status" id="plus-status-2" <?php  if($activity['plus_status'] == 2) { ?>checked<?php  } ?>>
							<label for="plus-status-2">关闭</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">霸王餐PLUS活动宣传图</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_form_field_image('plus_thumb', $activity['plus_thumb'])?>
					</div>
				</div>
				<div class="alert alert-info">
					注意: 修改以下活动参数后,只针对修改后、新增的活动期数有效。
				</div>
				<div class="plus-area">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">霸王餐PLUS参加活动需支付金额</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="number" name="plus_pre_partaker_fee" value="<?php  echo $activity['plus_pre_partaker_fee'];?>" class="form-control"  required="true" number="true">
								<span class="input-group-addon">元</span>
							</div>
						</div>
					</div>
					<div class="form-group hide">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">霸王餐PLUS每期获奖人数</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="number" name="plus_reward_num" min="1" value="<?php  echo $activity['plus_reward_num'];?>" class="form-control"  required="true" digtis="true">
								<span class="input-group-addon">元</span>
							</div>
							<span class="help-block">人数最少为1</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">霸王餐PLUS获奖金额</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="number" name="pre_plus_reward_fee" value="<?php  echo $activity['pre_plus_reward_fee'];?>" class="form-control"  required="true" number="true">
								<span class="input-group-addon">元</span>
							</div>
							<span class="help-block">注意:获奖金额将以红包或账户余额的形式发放给参与者</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">霸王餐PLUS满多少人开奖</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input class="form-control" type="number" value="<?php  echo $activity['plus_partaker_num'];?>" name="plus_partaker_num" required="true" digtis="true" aria-required="true">
								<span class="input-group-addon">人</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">霸王餐PLUS每人每期最多可参与</label>
						<div class="col-sm-9 col-xs-12">
							<input class="form-control" type="number" value="<?php  echo $activity['plus_pre_max_partake_times'];?>" name="plus_pre_max_partake_times" required="true" digtis="true">
							<span class="help-block">0为不限制</span>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" role="tabpanel" id="share">
				<h3>分享设置</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">分享标题</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="share_title" value="<?php  echo $activity['share']['title'];?>" class="form-control" required="true">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">分享描述</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="desc" value="<?php  echo $activity['share']['desc'];?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">活动图片</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_form_field_image('imgUrl', $activity['share']['imgUrl'])?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">分享链接</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_form_field_tiny_link('link', $activity['share']['link']);?>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-12">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<?php  } ?>

<?php  if($op == 'period') { ?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('freeLunch/activity/period');?>
	<input type="hidden" name="type" value="<?php  echo $type;?>">
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">类型</label>
		<div class="col-sm-4 col-xs-4">
			<div class="btn-group">
				<a href="<?php  echo iurl('freeLunch/activity/period')?>" class="btn <?php  if(empty($type)) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo iurl('freeLunch/activity/period', array('type' => 'common'))?>" class="btn <?php  if($type == 'common') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">普通</a>
				<a href="<?php  echo iurl('freeLunch/activity/period', array('type' => 'plus'))?>" class="btn <?php  if($type == 'plus') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">Plus</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">开始时间</label>
		<div class="col-sm-4 col-xs-4">
			<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d H:i', $starttime), 'end' => date('Y-m-d H:i', $endtime)), true);?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-4 col-xs-4">
			<input type="text" name="serial_sn" value="<?php  echo $serial_sn;?>" class="form-control" placeholder="搜索活动期号">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-4 col-xs-4">
			<input type="submit" value="筛选" class="btn btn-primary">
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($periods)) { ?>
			<div class="no-result">
				<p>还没有相关数据</p>
			</div>
			<?php  } else { ?>
			<table class="table table-hover">
				<thead>
				<tr>
					<th>活动主题</th>
					<th>活动期号</th>
					<th>获奖人</th>
					<th>活动状态</th>
					<th>需参与人数</th>
					<th>剩余参与人数</th>
					<th>支付金额</th>
					<th>获奖金额</th>
					<th>开始时间</th>
					<th style="text-align: right; width: 200px">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($periods)) { foreach($periods as $period) { ?>
				<tr>
					<td><?php  echo $period['title'];?></td>
					<td><?php  echo $period['serial_sn'];?></td>
					<td>
						<?php  if(!empty($period['reward_uid'])) { ?>
							<?php  echo $period['nickname'];?>&nbsp;&nbsp;&nbsp;
							<img width="40" height="40" src="<?php  echo $period['avatar'];?>" alt="">
						<?php  } ?>
					</td>
					<td>
						<?php  if($period['status'] == 1) { ?>
							<span class="label label-info">活动正在进行中</span>
						<?php  } else { ?>
							<span class="label label-success">已开奖</span>
						<?php  } ?>
					</td>
					<td><?php  echo $period['partaker_total'];?></td>
					<td><?php  echo $period['partaker_dosage'];?></td>
					<td><?php  echo $period['partaker_fee'];?></td>
					<td><?php  echo $period['reward_fee'];?></td>
					<td><?php  echo $period['startime'];?></td>
					<td align="right">
						<a href="<?php  echo iurl('freeLunch/activity/partaker', array('id' => $period['id']))?>" class="btn btn-default btn-sm">查看</a>
						<a href="<?php  echo iurl('freeLunch/activity/period_del', array('id' => $period['id']))?>" class="btn btn-danger btn-sm js-remove" data-confirm="删除后将不可恢复，确定删除吗?">删除</a>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<div class="pull-right">
					<?php  echo $pager;?>
				</div>
			</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>

<?php  if($op == 'partaker') { ?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('freeLunch/activity/partaker');?>
	<input type="hidden" name="id" value="<?php  echo $record_id;?>">
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">参加时间</label>
		<div class="col-sm-4 col-xs-4">
			<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d H:i', $starttime), 'end' => date('Y-m-d H:i', $endtime)), true);?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-4 col-xs-4">
			<input type="text" name="number" value="<?php  echo $number;?>" class="form-control" placeholder="搜索期号、参与号">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-4 col-xs-4">
			<input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="搜索的姓名、昵称、手机号">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-4 col-xs-4">
			<input type="submit" value="筛选" class="btn btn-primary">
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($partakers)) { ?>
			<div class="no-result">
				<p>还没有相关数据</p>
			</div>
			<?php  } else { ?>
			<table class="table table-hover">
				<thead>
				<tr>
					<th width="40"></th>
					<th>参与人昵称</th>
					<th>参与人uid</th>
					<th>参与人手机号</th>
					<th>活动主题</th>
					<th>活动期号</th>
					<th>支付金额</th>
					<th>参与号码</th>
					<th>是否获奖</th>
					<th style="text-align: right">参与时间</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($partakers)) { foreach($partakers as $partaker) { ?>
				<tr>
					<td><img width="40" height="40" src="<?php  echo $partaker['avatar'];?>" alt=""></td>
					<td>
						<?php  echo $partaker['nickname'];?> &nbsp;&nbsp;
					</td>
					<td><?php  echo $partaker['uid'];?></td>
					<td><?php  echo $partaker['mobile'];?></td>
					<td><?php  echo $partaker['title'];?></td>
					<td><?php  echo $partaker['serial_sn'];?></td>
					<td><?php  echo $partaker['final_fee'];?></td>
					<td><?php  echo $partaker['number'];?></td>
					<td>
						<?php  if($partaker['is_reward'] == 0) { ?>
							<span class="label label-danger">未获奖</span>
						<?php  } else { ?>
							<span class="label label-success">获奖</span>
						<?php  } ?>
					</td>
					<td align="right"><?php  echo $partaker['addtime'];?></td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<div class="pull-right">
					<?php  echo $pager;?>
				</div>
			</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>

<?php  if($op == 'record') { ?>
<form action="./index.php" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('freeLunch/activity/record');?>
	<input type="hidden" name="type" value="<?php  echo $type;?>">
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">类型</label>
		<div class="col-sm-4 col-xs-4">
			<div class="btn-group">
				<a href="<?php  echo iurl('freeLunch/activity/record')?>" class="btn <?php  if(empty($type)) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo iurl('freeLunch/activity/record', array('type' => 'common'))?>" class="btn <?php  if($type == 'common') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">普通</a>
				<a href="<?php  echo iurl('freeLunch/activity/record', array('type' => 'plus'))?>" class="btn <?php  if($type == 'plus') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">Plus</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">获奖时间</label>
		<div class="col-sm-4 col-xs-4">
			<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d H:i', $starttime), 'end' => date('Y-m-d H:i', $endtime)), true);?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-4 col-xs-4">
			<div class="input-group">
				<input type="text" name="number" value="<?php  echo $number;?>" class="form-control" placeholder="搜索期号、获奖号">
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-4 col-xs-4">
			<input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="搜索的姓名、昵称、手机号">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-4 col-xs-4">
			<input type="submit" value="筛选" class="btn btn-primary">
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($records)) { ?>
			<div class="no-result">
				<p>还没有相关数据</p>
			</div>
			<?php  } else { ?>
			<table class="table table-hover">
				<thead>
				<tr>
					<th width="40"></th>
					<th>获奖人昵称</th>
					<th>获奖人uid</th>
					<th>获奖人手机号</th>
					<th>活动主题</th>
					<th>活动期号</th>
					<th>获奖金额</th>
					<th>获奖号码</th>
					<th style="text-align: right">获奖时间</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($records)) { foreach($records as $record) { ?>
				<tr>
					<td><img width="40" height="40" src="<?php  echo tomedia($record['avatar'])?>" alt=""></td>
					<td>
						<?php  echo $record['nickname'];?>&nbsp;&nbsp;
					</td>
					<td><?php  echo $record['reward_uid'];?></td>
					<td><?php  echo $record['mobile'];?></td>
					<td><?php  echo $record['title'];?></td>
					<td><?php  echo $record['serial_sn'];?></td>
					<td><?php  echo $record['reward_fee'];?></td>
					<td><?php  echo $record['reward_number'];?></td>
					<td align="right"><?php  echo $record['endtime'];?></td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
			<div class="btn-region clearfix">
				<div class="pull-right">
					<?php  echo $pager;?>
				</div>
			</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>