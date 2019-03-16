<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php?" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('member/recharge/index');?>
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择充值类型</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo iurl('member/recharge')?>" class="btn <?php  if($type == '') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo iurl('member/recharge', array('pay_type' => 'wechat'))?>" class="btn <?php  if($type == 'wechat') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">微信</a>
				<a href="<?php  echo iurl('member/recharge', array('pay_type' => 'alipay'))?>" class="btn <?php  if($type == 'alipay') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">支付宝</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-9 col-xs-12">
			<?php  echo itpl_form_field_daterange('addtime', array('placeholder' => '充值时间'));?> <input class="form-control" style="display: inline-block" name="keyword" placeholder="输入会员名或手机号" type="text" value="<?php  echo $_GPC['keyword'];?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<button class="btn btn-primary">筛选</button>
		</div>
	</div>
</form>
<form action="" class="form-table form" method="post">
	<div class="panel panel-table">
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($recharge)) { ?>
			<div class="no-result">还没有相关数据</div>
			<?php  } else { ?>
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th>充值单号</th>
					<th>粉丝</th>
					<th>UID</th>
					<th>会员信息</th>
					<th>充值金额</th>
					<th>充值时间</th>
					<th>充值方式</th>
					<th>状态</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($recharge)) { foreach($recharge as $item) { ?>
				<tr>
					<td><?php  echo $item['order_sn'];?></td>
					<td><img width="48" height="48" src="<?php  echo tomedia($item['avatar'])?>" alt=""/>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $item['nickname'];?></td>
					<td><strong><?php  echo $item['uid'];?></strong></td>
					<td>
						<?php  echo $item['realname'];?>
						<br/>
						<?php  echo $item['mobile'];?>
					</td>
					<td><?php  echo $item['fee'];?></td>
					<td><?php  echo date('Y-m-d H:i:s', $item['addtime'])?></td>
					<td><span class="<?php  echo member_recharge_type($item['pay_type'], css)?>"><?php  echo member_recharge_type($item['pay_type'], text)?></span></td>
					<td>
						<?php  if($item['is_pay'] == 1) { ?>
							<span class="text-success">成功</span>
						<?php  } else { ?>
							<span>待支付</span>
						<?php  } ?>
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
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
