<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<form action="./index.php?" class="form-horizontal form-filter">
	<?php  echo tpl_form_filter_hidden('paycenter/paybill/index');?>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">支付方式</label>
		<div class="col-sm-9 col-xs-12">
			<div class="btn-group">
				<div class="btn-group">
					<a href="<?php  echo ifilter_url('pay_type:');?>" class="btn <?php  if($pay_type == '') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
					<a href="<?php  echo ifilter_url('pay_type:wechat');?>" class="btn <?php  if($pay_type == 'wechat') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">微信支付</a>
					<a href="<?php  echo ifilter_url('pay_type:alipay');?>" class="btn <?php  if($pay_type == 'alipay') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">支付宝</a>
					<a href="<?php  echo ifilter_url('pay_type:credit');?>" class="btn <?php  if($pay_type == 'credit') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">余额支付</a>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label">其他</label>
		<div class="col-sm-9 col-xs-12">
			<select name="sid" class="form-control select2 width-130">
				<option value="0" <?php  if($sid == 0) { ?>select<?php  } ?>>所属门店</option>
				<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
					<option value="<?php  echo $store['id'];?>"<?php  if($sid == $store['id']) { ?>selected<?php  } ?>><?php  echo $store['title'];?></option>
				<?php  } } ?>
			</select>
			<div style="display: inline-block">
				<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d H:i', $starttime), 'end' => date('Y-m-d H:i', $endtime)), true);?>
			</div>
			<input type="text" name="keyword" value="<?php  echo $keyword;?>" class="form-control" placeholder="输入用户名/手机号/订单编号" style="display: inline-block; width: 200px;">
			<input type="text" name="uid" value="<?php  if(!empty($uid)) { ?><?php  echo $uid;?><?php  } ?>" class="form-control" placeholder="用户UID" style="display: inline-block; width: 150px;">
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<button class="btn btn-primary">筛选</button>
		</div>
	</div>
</form>
<div class="clearfix order-list panel-table">
	<?php  if(!empty($orders)) { ?>
	<div class="panel-body table-responsive js-table">
		<table class="table table-hover">
			<thead style="background-color: #f8f8f8;">
				<tr>
					<th>顾客</th>
					<th>支付方式</th>
					<th>支付时间</th>
					<th>消费总额</th>
					<th>不参与优惠金额</th>
					<th>优惠金额</th>
					<th>顾客实付金额</th>
					<th>平台抽取佣金</th>
					<th>商户预计收入</th>
				</tr>
			</thead>
			<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
			<tr>
				<td>
					<img src="<?php  echo tomedia($order['avatar']);?>" alt="" width="50"/><?php  echo $order['nickname'];?>
				</td>
				<td><span class="<?php  echo to_paytype($order['pay_type'], 'css')?>"><?php  echo to_paytype($order['pay_type'], 'text')?></div></td>
				<td><?php  echo date('Y-m-d H:i:s', $order['addtime'])?></td>
				<td>¥ <?php  echo $order['total_fee'];?></td>
				<td>¥ <?php  echo $order['no_discount_part'];?></td>
				<td>¥ <?php  echo $order['discount_fee'];?></td>
				<td>¥ <?php  echo $order['final_fee'];?></td>
				<td>¥ <?php  echo $order['plateform_serve_fee'];?></td>
				<td>¥ <?php  echo $order['store_final_fee'];?></td>
			</tr>
			<?php  } } ?>
		</table>
	</div>
	<?php  } else { ?>
		<div class="no-result">
			<p>还没有相关数据</p>
		</div>
	<?php  } ?>
	<div class="col-md-12">
		<?php  echo $pager;?>
	</div>
</div>

<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>