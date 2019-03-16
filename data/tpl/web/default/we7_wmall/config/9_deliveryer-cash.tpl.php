<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix page-config-store-delivery">
	<h2>提成及提现设置</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<h3>配送权限</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送权限</label>
			<div class="col-sm-9 col-xs-12">
				<div class="checkbox checkbox-inline">
					<input type="checkbox" name="is_takeout" id="is_takeout" value="1" <?php  if($deliveryer['is_takeout'] == 1) { ?>checked<?php  } ?>>
					<label for="is_takeout">外卖单</label>
				</div>
				<?php  if(check_plugin_perm('errander')) { ?>
				<div class="checkbox checkbox-inline">
					<input type="checkbox" name="is_errander" id="is_errander" value="1" <?php  if($deliveryer['is_errander'] == 1) { ?> checked<?php  } ?>>
					<label for="is_errander">跑腿单</label>
				</div>
				<?php  } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否允许配送员取消订单（外卖单）</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="perm_cancel[status_takeout]" id="perm_cancel_takeout-1" <?php  if($deliveryer['perm_cancel']['status_takeout'] == '1') { ?>checked<?php  } ?>>
					<label for="perm_cancel_takeout-1">允许</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="perm_cancel[status_takeout]" id="perm_cancel_takeout-0" <?php  if($deliveryer['perm_cancel']['status_takeout'] == '0') { ?>checked<?php  } ?>>
					<label for="perm_cancel_takeout-0">禁止</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否允许配送员取消订单（跑腿单）</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="perm_cancel[status_errander]" id="perm_cancel_errander-1" <?php  if($deliveryer['perm_cancel']['status_errander'] == '1') { ?>checked<?php  } ?>>
					<label for="perm_cancel_errander-1">允许</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="perm_cancel[status_errander]" id="perm_cancel_errander-0" <?php  if($deliveryer['perm_cancel']['status_errander'] == '0') { ?>checked<?php  } ?>>
					<label for="perm_cancel_errander-0">禁止</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">外卖单是否允许转单</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="perm_transfer[status_takeout]" id="perm_transfer_status_takeout-1" <?php  if($deliveryer['perm_transfer']['status_takeout'] == '1') { ?>checked<?php  } ?>>
					<label for="perm_transfer_status_takeout-1">允许</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="perm_transfer[status_takeout]" id="perm_transfer_status_takeout-0" <?php  if($deliveryer['perm_transfer']['status_takeout'] == '0') { ?>checked<?php  } ?>>
					<label for="perm_transfer_status_takeout-0">禁止</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跑腿单是否允许转单</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="perm_transfer[status_errander]" id="perm_transfer_status_errander-1" <?php  if($deliveryer['perm_transfer']['status_errander'] == '1') { ?>checked<?php  } ?>>
					<label for="perm_transfer_status_errander-1">允许</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="perm_transfer[status_errander]" id="perm_transfer_status_errander-0" <?php  if($deliveryer['perm_transfer']['status_errander'] == '0') { ?>checked<?php  } ?>>
					<label for="perm_transfer_status_errander-0">禁止</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员每天最多可转</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">外卖单</span>
					<input type="text" class="form-control" name="perm_transfer[max_takeout]" value="<?php  echo $deliveryer['perm_transfer']['max_takeout'];?>" digits="true">
					<span class="input-group-addon">单</span>
				</div>
				</br>
				<div class="input-group">
					<span class="input-group-addon">跑腿单</span>
					<input type="text" class="form-control" name="perm_transfer[max_errander]" value="<?php  echo $deliveryer['perm_transfer']['max_errander'];?>" digits="true">
					<span class="input-group-addon">单</span>
				</div>
				<div class="help-block">配送员在遇到特殊情况下可申请转单，设置每天最多可转几次单。0为不限制</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员最多可抢 <br>（外卖单）</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" name="collect_max_takeout" value="<?php  echo $deliveryer['collect_max_takeout'];?>" digits="true">
					<span class="input-group-addon">单</span>
				</div>
				<div class="help-block">配送员最多可抢外卖单数。0为不限制</div>
				<div class="help-block">注意：系统派单和配送员自己抢单模式受此项限制，平台调度给配送员分配订单不受此项限制</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员最多可抢 <br>（跑腿单）</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" name="collect_max_errander" value="<?php  echo $deliveryer['collect_max_errander'];?>" digits="true">
					<span class="input-group-addon">单</span>
				</div>
				<div class="help-block">配送员最多可抢跑腿单数。0为不限制</div>
				<div class="help-block">注意：系统派单和配送员自己抢单模式受此项限制，平台调度给配送员分配订单不受此项限制</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">平台给配送员每单支付金额(外卖单)</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_takeout_fee_type" value="1" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 1 || !$deliveryer['fee_delivery']['takeout']['deliveryer_fee_type']) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单固定</span>
					<input type="text" class="form-control" name="deliveryer_takeout_fee_1" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 1) { ?>value="<?php  echo $deliveryer['fee_delivery']['takeout']['deliveryer_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元</span>
				</div>
				<br>
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_takeout_fee_type" value="2" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 2) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单按照订单配送费提成</span>
					<input type="text" class="form-control" name="deliveryer_takeout_fee_2" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 2) { ?>value="<?php  echo $deliveryer['fee_delivery']['takeout']['deliveryer_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">%</span>
				</div>
				<br>
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_takeout_fee_type" value="3" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 3) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单基础配送费</span>
					<input type="text" class="form-control" name="deliveryer_takeout_fee_3[start_fee]" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['takeout']['deliveryer_fee']['start_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元,超过</span>
					<input type="text" class="form-control" name="deliveryer_takeout_fee_3[start_km]" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['takeout']['deliveryer_fee']['start_km'];?>"<?php  } ?>>
					<span class="input-group-addon">公里,超过部分每公里增加</span>
					<input type="text" class="form-control" name="deliveryer_takeout_fee_3[pre_km]" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['takeout']['deliveryer_fee']['pre_km'];?>"<?php  } ?>>
					<span class="input-group-addon">元,最高</span>
					<input type="text" class="form-control" name="deliveryer_takeout_fee_3[max_fee]" <?php  if($deliveryer['fee_delivery']['takeout']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['takeout']['deliveryer_fee']['max_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block"><span class="text-danger">第三种提成模式仅适用于开启按照距离收取配送费的计费模式。最高设置为0表示不限制。</span></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">平台给跑腿员每单支付金额(跑腿单)</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_errander_fee_type" value="1" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 1 || !$deliveryer['fee_delivery']['errander']['deliveryer_fee_type']) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单固定</span>
					<input type="text" class="form-control" name="deliveryer_errander_fee_1" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 1) { ?>value="<?php  echo $deliveryer['fee_delivery']['errander']['deliveryer_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元</span>
				</div>
				<br>
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_errander_fee_type" value="2" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 2) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单按照订单配送费提成</span>
					<input type="text" class="form-control" name="deliveryer_errander_fee_2" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 2) { ?>value="<?php  echo $deliveryer['fee_delivery']['errander']['deliveryer_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">%</span>
				</div>
				<br>
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_errander_fee_type" value="3" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 3) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单基础配送费</span>
					<input type="text" class="form-control" name="deliveryer_errander_fee_3[start_fee]" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['errander']['deliveryer_fee']['start_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元,超过</span>
					<input type="text" class="form-control" name="deliveryer_errander_fee_3[start_km]" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['errander']['deliveryer_fee']['start_km'];?>"<?php  } ?>>
					<span class="input-group-addon">公里,超过部分每公里增加</span>
					<input type="text" class="form-control" name="deliveryer_errander_fee_3[pre_km]" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['errander']['deliveryer_fee']['pre_km'];?>"<?php  } ?>>
					<span class="input-group-addon">元,最高</span>
					<input type="text" class="form-control" name="deliveryer_errander_fee_3[max_fee]" <?php  if($deliveryer['fee_delivery']['errander']['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $deliveryer['fee_delivery']['errander']['deliveryer_fee']['max_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block"><span class="text-danger">第三种提成模式仅适用于开启按照距离收取配送费的计费模式。最高设置为0表示不限制。</span></div>
			</div>
		</div>
		<h3>提现设置</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>最低提现金额</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" name="fee_getcash[get_cash_fee_limit]" digits="true" value="<?php  echo $deliveryer['fee_getcash']['get_cash_fee_limit'];?>" class="form-control"/>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block">只能填写整数，不填写为不限制</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>提现费率</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" name="fee_getcash[get_cash_fee_rate]" required="true" value="<?php  echo $deliveryer['fee_getcash']['get_cash_fee_rate'];?>" class="form-control"/>
					<span class="input-group-addon">%</span>
				</div>
				<div class="help-block">
					配送员申请提现时，每笔申请提现扣除的费用，默认为空，即提现不扣费，支持填写小数
					<br>
					<strong clas="text-danger">配送员入驻时的默认提现费率</strong>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>提现费用</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">最低</span>
					<input type="text" name="fee_getcash[get_cash_fee_min]" required="true" value="<?php  echo $deliveryer['fee_getcash']['get_cash_fee_min'];?>" class="form-control"/>
					<span class="input-group-addon">元</span>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">最高</span>
					<input type="text" name="fee_getcash[get_cash_fee_max]" required="true" value="<?php  echo $deliveryer['fee_getcash']['get_cash_fee_max'];?>" class="form-control"/>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block">
					<strong class="text-danger">最高金额设置为0， 表示不限制最高提现费用。</strong>
					<br>
					配送员提现时，提现费用的上下限，最高为空时，表示不限制扣除的提现费用
					<br>
					例如：提现100元，费率5%，最低1元，最高2元，配送员最终提现金额=100-2=98
					<br>
					例如：提现100元，费率5%，最低1元，最高10元，配送员最终提现金额=100-100*5%=95
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">提现到账周期</label>
			<div class="col-sm-9 col-xs-12 toggle-tabs" data-content=".get-cash-period-type">
				<div class="radio radio-inline">
					<input type="radio" value="0" name="fee_getcash[get_cash_period]" id="get_cash_period-0" <?php  if(empty($deliveryer['fee_getcash']['get_cash_period'])) { ?>checked<?php  } ?>>
					<label for="get_cash_period-0" class="toggle-role" data-target="get_cash_period-0">管理员审核</label>
					<div class="help-block"></div>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="1" name="fee_getcash[get_cash_period]" id="get_cash_period-1" <?php  if($deliveryer['fee_getcash']['get_cash_period'] == 1) { ?>checked<?php  } ?>>
					<label for= "get_cash_period-1" class="toggle-role" data-target="get_cash_period-1">极速到账</label>
				</div>
				<div class="help-block">
					商户提现默认为需要管理员审核确定后才能转账 <br>
					极速转账:不需要管理员审核直接转账
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">将此设置设置同步到配送员</label>
			<div class="col-sm-9 col-xs-12 toggle-tabs" data-content=".sync-type">
				<div class="input-group">
					<div class="radio radio-inline">
						<input type="radio" value="1" name="sync" id="sync-1" <?php  if($deliveryer['sync'] == 1) { ?>checked<?php  } ?>>
						<label for= "sync-1" class="toggle-role" data-target="sync-type-1">同步到所有配送员</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" value="2" name="sync" id="sync-2" <?php  if($deliveryer['sync'] == 2) { ?>checked<?php  } ?>>
						<label for= "sync-2" class="toggle-role" data-target="sync-type-2">同步到指定配送员</label>
					</div>
					<div class="help-block">同步后,所选择配送员的设置都会被设置为这个规则</div>
				</div>
			</div>
		</div>
		<div class="toggle-content sync-type">
			<div class="toggle-pane" id="sync-type-2">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<?php  if(is_array($deliveryers)) { foreach($deliveryers as $deliveryer) { ?>
						<div class="col-xs-3">
							<div class="checkbox checkbox-inline">
								<input type="checkbox" value="<?php  echo $deliveryer['id'];?>" name="deliveryer_ids[]" id="deliveryer_<?php  echo $deliveryer['id'];?>">
								<label for="deliveryer_<?php  echo $deliveryer['id'];?>"><?php  echo $deliveryer['title'];?></label>
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
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
