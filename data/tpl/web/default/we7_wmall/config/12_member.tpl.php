<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<h2>顾客等级升级条件</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-5 col-md-2 control-label">顾客等级升级依据</label>
			<div class="col-sm-5 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="group_update_mode" id="group_update_mode-order_money" value="order_money" <?php  if($config['group_update_mode'] == 'order_money') { ?>checked <?php  } ?>>
					<label for="group_update_mode-order_money">外卖订单消费总额(完成的订单)</label>
				</div>
				<br/>
				<div class="radio radio-inline">
					<input type="radio" name="group_update_mode" id="group_update_mode-order_count" value="order_count" <?php  if($config['group_update_mode'] == 'order_count') { ?>checked<?php  } ?>>
					<label for="group_update_mode-order_count">外卖订单消费次数(完成的订单)</label>
				</div>
				<br/>
				<div class="radio radio-inline">
					<input type="radio" name="group_update_mode" id="group_update_mode-delivery_money" value="delivery_money" <?php  if($config['group_update_mode'] == 'delivery_money') { ?>checked<?php  } ?>>
					<label for="group_update_mode-delivery_money">跑腿订单消费总额(完成的订单)</label>
				</div>
				<br/>
				<div class="radio radio-inline">
					<input type="radio" name="group_update_mode" id="group_update_mode-delivery_count" value="delivery_count" <?php  if($config['group_update_mode'] == 'delivery_count') { ?>checked<?php  } ?>>
					<label for="group_update_mode-delivery_count">跑腿订单消费次数(完成的订单)</label>
				</div>
				<br/>
				<div class="radio radio-inline">
					<input type="radio" name="group_update_mode" id="group_update_mode-count_money" value="count_money" <?php  if($config['group_update_mode'] == 'count_money') { ?>checked<?php  } ?>>
					<label for="group_update_mode-count_money">外卖订单和跑腿订单消费总额(完成的订单)</label>
				</div>
			</div>
		</div>

		<!--<div class="form-group">-->
			<!--<label class="col-xs-12 col-sm-3 col-md-2 control-label">分销设置：</label>-->
			<!--<div class="col-sm-9 col-xs-12">-->
				<!--一级分佣比例：<input type="text" name="commission_sale_1" value="<?php  echo $config['commission_sale_1'];?>" class="form-control" required>-->
				<!--二级分佣比例：<input type="text" name="commission_sale_2" value="<?php  echo $config['commission_sale_2'];?>" class="form-control" required>-->
				<!--三级分佣比例：<input type="text" name="commission_sale_3" value="<?php  echo $config['commission_sale_3'];?>" class="form-control" required>-->
				<!--<div class="help-block">如设置10，相当于10%，抽取订单总付款金额的10%作为分佣</div>-->
			<!--</div>-->
		<!--</div>-->

		<h3>分销设置</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>分佣比例</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">一级分佣</span>
					<input type="text" name="commission_sale_1" required="true" value="<?php  echo $config['commission_sale_1'];?>" class="form-control"/>
					<span class="input-group-addon">%</span>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">二级分佣</span>
					<input type="text" name="commission_sale_2" required="true" value="<?php  echo $config['commission_sale_2'];?>" class="form-control"/>
					<span class="input-group-addon">%</span>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">三级分佣</span>
					<input type="text" name="commission_sale_3" required="true" value="<?php  echo $config['commission_sale_3'];?>" class="form-control"/>
					<span class="input-group-addon">%</span>
				</div>
				<div class="help-block">如设置10，相当于10%，抽取订单总付款金额的10%作为分佣<br>设置0，则不分佣</div>
			</div>
		</div>

		<h3>提现设置</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>最低提现金额</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" name="fee_getcash[get_cash_fee_limit]" digits="true" value="<?php  echo $config['fee_getcash']['get_cash_fee_limit'];?>" class="form-control"/>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block">只能填写整数，不填写为不限制</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>提现费率</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" name="fee_getcash[get_cash_fee_rate]" required="true" value="<?php  echo $config['fee_getcash']['get_cash_fee_rate'];?>" class="form-control"/>
					<span class="input-group-addon">%</span>
				</div>
				<div class="help-block">
					顾客申请提现时，每笔申请提现扣除的费用，默认为空，即提现不扣费，支持填写小数
					<br>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>提现费用</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">最低</span>
					<input type="text" name="fee_getcash[get_cash_fee_min]" required="true" value="<?php  echo $config['fee_getcash']['get_cash_fee_min'];?>" class="form-control"/>
					<span class="input-group-addon">元</span>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">最高</span>
					<input type="text" name="fee_getcash[get_cash_fee_max]" required="true" value="<?php  echo $config['fee_getcash']['get_cash_fee_max'];?>" class="form-control"/>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block">
					<strong class="text-danger">最高金额设置为0， 表示不限制最高提现费用。</strong>
					<br>
					顾客提现时，提现费用的上下限，最高为空时，表示不限制扣除的提现费用
					<br>
					例如：提现100元，费率5%，最低1元，最高2元，配送员最终提现金额=100-2=98
					<br>
					例如：提现100元，费率5%，最低1元，最高10元，配送员最终提现金额=100-100*5%=95
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>提现周期</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="number" name="fee_getcash[get_cash_fee_period]" required="true" value="<?php  echo $config['fee_getcash']['get_cash_fee_period'];?>" class="form-control"/>
					<span class="input-group-addon">天</span>
				</div>
				<div class="help-block">
					<strong class="text-danger">提现周期设置为0， 表示不限制提现周期。</strong>
					<br>
					例如：提现周期设置为7天，即至少在上次提现7天后，才可以进行下次提现。
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