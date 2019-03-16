<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php?" class="form-horizontal form-filter" id="form1">
	<?php  echo tpl_form_filter_hidden('member/credit');?>
	<input type="hidden" name="credit" value="<?php  echo $credit;?>">
	<div class="form-group form-inline">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">选择变化类型</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<a href="<?php  echo iurl('member/credit')?>" class="btn <?php  if($type == '') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
				<a href="<?php  echo iurl('member/credit', array('type' => 'add', 'credit' => $credit))?>" class="btn <?php  if($type == 'add') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">收入</a>
				<a href="<?php  echo iurl('member/credit', array('type' => 'minus', 'credit' => $credit))?>" class="btn <?php  if($type == 'minus') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">支出</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">搜索</label>
		<div class="col-sm-9 col-xs-12">
			<?php  echo itpl_form_field_daterange('createtime', array('placeholder' => '操作时间'));?> <input class="form-control" style="display: inline-block" name="keyword" placeholder="输入会员名或手机号" type="text" value="<?php  echo $_GPC['keyword'];?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<button class="btn btn-primary">筛选</button>
		</div>
	</div>
</form>
<form action="" class="form-table">
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
					<th>会员</th>
					<th>会员信息</th>
					<th>
						<?php  if($credit == 'credit1') { ?>
						积分变化
						<?php  } else { ?>
						余额变化
						<?php  } ?>
					</th>
					<th>备注</th>
					<th>操作时间</th>
				</tr>
				</thead>
				<?php  if(is_array($records)) { foreach($records as $record) { ?>
				<tr>
					<td><img width="48" height="48" src="<?php  echo tomedia($record['avatar'])?>" alt=""/>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $record['nickname'];?></td>
					<td>
						<?php  echo $record['realname'];?>
						<br/>
						<?php  echo $record['mobile'];?>
					</td>
					<td>
						<span <?php  if($record['num'] > 0) { ?>class="text-success"<?php  } else { ?>class="text-danger"<?php  } ?>><?php  echo $record['num'];?></span>
					</td>
					<td><?php  echo $record['remark'];?></td>
					<td><?php  echo date('Y-m-d H:i:s', $record['createtime'])?></td>
				</tr>
				<?php  } } ?>
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