<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix page-config-store-delivery">
	<h2>订单相关</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data" style="max-width: 90%">
		<h3>订单设置</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否允许顾客删除订单列表中的历史订单</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="customer_delete_order" id="customer_delete_order-1" <?php  if($order['customer_delete_order'] == '1') { ?>checked<?php  } ?>>
					<label for="customer_delete_order-1">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="customer_delete_order" id="customer_delete_order-2" <?php  if($order['customer_delete_order'] == '0' || !$order['customer_delete_order']) { ?>checked<?php  } ?>>
					<label for="customer_delete_order-2">否</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">通知店员规则</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group" style="margin-bottom: 10px;">
					<div class="input-group-addon">下单后</div>
					<input type="text" class="form-control" name="clerk[notify_delay]" value="<?php  echo $order['notify_rule_clerk']['notify_delay'];?>">
					<div class="input-group-addon">分钟之内未接单,则微信模板消息/商家APP语音通知</div>
				</div>
				<div class="input-group">
					<div class="input-group-addon">通知频率为每</div>
					<input type="text" class="form-control" name="clerk[notify_frequency]" value="<?php  echo $order['notify_rule_clerk']['notify_frequency'];?>">
					<div class="input-group-addon">分钟通知一次,总共通知</div>
					<input type="text" class="form-control" name="clerk[notify_total]" value="<?php  echo $order['notify_rule_clerk']['notify_total'];?>">
					<div class="input-group-addon">次</div>
				</div>
				<span class="help-block">
					规则为:下单后几分钟之内未接单,通知店员,通知过第一次之后几分钟之后仍未接单,则通知第二次,以此类推 <br>
					<span class="text-danger">如需下单后立即通知店员接单，可设置为0; 注意：商家设置了自动接单后，只会通知一次; 注意:通知频率最低为1分钟</span>
					<span class="text-danger">如果一个订单只需要通知一次，需要将总通知次数设置为1</span>
				</span>
				<div class="input-group">
					<div class="input-group-addon">微信模板消息/商家APP语音通知第</div>
					<input type="text" class="form-control" name="clerk[notify_phonecall_time]" value="<?php  echo $order['notify_rule_clerk']['notify_phonecall_time'];?>">
					<div class="input-group-addon">次时,同时电话通知</div>
				</div>
				<span class="help-block">
					规则为:例如设置为微信模板消息/商家APP语音通知3(不能超过微信模板消息/商家APP语音通知的总次数)次时，同时电话通知，即微信模板消息/商家APP语音通知2次后仍未接单，则微信模板消息/商家APP语音继续通知商家，同时电话通知店员 <br>
					<span class="text-danger">如需下单后立即电话通知店员接单，可设置为0</span>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">通知配送员规则</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<div class="input-group-addon">商户通知配送员接单后</div>
					<input type="text" class="form-control" name="deliveryer[notify_delay]" value="<?php  echo $order['notify_rule_deliveryer']['notify_delay'];?>">
					<div class="input-group-addon">分钟之内未接单,则微信模板消息/配送员APP语音通知</div>
					<div class="input-group-addon">通知频率为每</div>
					<input type="text" class="form-control" name="deliveryer[notify_frequency]" value="<?php  echo $order['notify_rule_deliveryer']['notify_frequency'];?>">
					<div class="input-group-addon">分钟通知一次,总共通知</div>
					<input type="text" class="form-control" name="deliveryer[notify_total]" value="<?php  echo $order['notify_rule_deliveryer']['notify_total'];?>">
					<div class="input-group-addon">次</div>
				</div>
				<span class="help-block">规则为:商户通知配送员接单后几分钟之内未接单,通知配送员,通知过第一次之后几分钟之后仍未接单,则通知第二次,以此类推</span>
				<span class="text-danger">注意:该规则仅适用外卖单派单模式为"配送员抢单",其他模式不会生效。如需商家在通知配送员接单后立即通知配送员抢单，可设置为0; 注意:通知频率最低为1分钟。</span>
				<span class="text-danger">如果一个订单只需要通知一次，需要将总通知次数设置为1</span>
				<div class="input-group">
					<div class="input-group-addon">微信模板消息/配送员APP语音通知</div>
					<input type="text" class="form-control" name="deliveryer[notify_phonecall_time]" value="<?php  echo $order['notify_rule_deliveryer']['notify_phonecall_time'];?>">
					<div class="input-group-addon">次时，同时电话通知</div>
				</div>
				<span class="help-block">
					规则为:例如设置为微信模板消息/配送员APP语音通知3(不能超过微信模板消息/配送员APP语音通知的总次数)次时，同时电话通知，即微信模板消息/配送员APP语音通知2次后配送员仍未接单，则继续微信模板消息/配送员APP语音通知，同时电话通知配送员 <br>
					<span class="text-danger">如需下单后立即电话通知配送员接单，可设置为0</span>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>支付时间限制</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="input-group">
					<input type="text" class="form-control" name="pay_time_limit" digits="true" value="<?php  echo $order['pay_time_limit'];?>">
					<span class="input-group-addon">分钟</span>
				</div>
				<span class="help-block">例如:设置为15分钟,那么用户在提交订单后15分钟内未支付,系统会自动取消该订单。如果没有支付时间限制,请设置为0</span>
				<span class="help-block">该设置仅对"外卖订单"有效.店内订单不受此设置影响</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>未支付提醒</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="input-group">
					<input type="text" class="form-control" name="pay_time_notice" digits="true" value="<?php  echo $order['pay_time_notice'];?>">
					<span class="input-group-addon">分钟</span>
				</div>
				<span class="help-block">例如:设置为5分钟,那么用户在提交订单后5分钟内未支付,系统会自动发送微信模板消息提醒顾客。如果没有待支付提醒,请设置为0</span>
				<span class="help-block">该设置仅对"外卖订单"有效.店内订单不受此设置影响</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>商家接单时间限制</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="input-group">
					<input type="text" class="form-control" name="handle_time_limit" digits="true" value="<?php  echo $order['handle_time_limit'];?>">
					<span class="input-group-addon">分钟</span>
				</div>
				<span class="help-block">例如:设置为15分钟,那么用户支付后,商家在15分钟内未接单,系统会自动取消该订单.如果没有接单时间限制,请设置为0</span>
				<span class="help-block">该设置仅对"外卖订单"有效.店内订单不受此设置影响</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>配送员接单时间限制</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="input-group">
					<input type="text" class="form-control" name="deliveryer_collect_time_limit" digits="true" value="<?php  echo $order['deliveryer_collect_time_limit'];?>">
					<span class="input-group-addon">分钟</span>
				</div>
				<span class="help-block">例如:设置为10分钟,那么商家通知配送员接单后,配送员在10分钟内未接单,系统会自动取消该订单.如果没有接单时间限制,请设置为0</span>
				<span class="help-block">该设置仅对"外卖订单"有效.店内订单不受此设置影响</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单自动完成（仅限商家已接单的订单）</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="input-group">
					<input type="text" class="form-control" name="auto_success_hours" digits="true" value="<?php  echo $order['auto_success_hours'];?>">
					<span class="input-group-addon">小时</span>
				</div>
				<span class="help-block">只有被商家接单后的订单在超过设置的时间才会被自动设置为完成. </span>
				<span class="help-block">自动完成时间只能是整数, 如果你不需要自动完成, 可以设置为0. </span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商家接单后是否允许取消订单</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="cancel_after_handle" id="cancel_after_handle-2" <?php  if($order['cancel_after_handle'] == '1') { ?>checked<?php  } ?>>
					<label for="cancel_after_handle-2">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="cancel_after_handle" id="cancel_after_handle-1" <?php  if($order['cancel_after_handle'] == '0' || !$order['cancel_after_handle']) { ?>checked<?php  } ?>>
					<label for="cancel_after_handle-1">否</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商家或系统取消订单是否自动退款</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="auto_refund_cancel_order" id="auto_refund_cancel_order-1" <?php  if($order['auto_refund_cancel_order'] == '1') { ?>checked<?php  } ?>>
					<label for="auto_refund_cancel_order-1">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="auto_refund_cancel_order" id="auto_refund_cancel_order-0" <?php  if($order['auto_refund_cancel_order'] == '0' || !$order['auto_refund_cancel_order']) { ?>checked<?php  } ?>>
					<label for="auto_refund_cancel_order-0">否</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">未支付的订单是否在待接单列表中显示</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="0" name="show_no_pay" id="show_no_pay-1" <?php  if($order['show_no_pay'] == '0') { ?>checked<?php  } ?>>
					<label for="show_no_pay-1">显示</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="1" name="show_no_pay" id="show_no_pay-2" <?php  if($order['show_no_pay'] == '1') { ?>checked<?php  } ?>>
					<label for="show_no_pay-2">隐藏</label>
				</div>
				<span class="help-block">此开关仅对微信端以及APP端有效</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员外卖订单是否开启自动刷新</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="auto_refresh" id="auto-refresh-1" <?php  if($order['auto_refresh'] == '1') { ?>checked<?php  } ?>>
					<label for="auto-refresh-1">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="auto_refresh" id="auto-refresh-2" <?php  if($order['auto_refresh'] == '2') { ?>checked<?php  } ?>>
					<label for="auto-refresh-2">否</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员接单后是否通知商户</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="deliveryer_collect_notify_clerk" id="deliveryer-collect-notify-clerk-1" <?php  if($order['deliveryer_collect_notify_clerk'] == 1) { ?>checked<?php  } ?>>
					<label for="deliveryer-collect-notify-clerk-1">通知</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="deliveryer_collect_notify_clerk" id="deliveryer-collect-notify-clerk-0" <?php  if(!$order['deliveryer_collect_notify_clerk']) { ?>checked<?php  } ?>>
					<label for="deliveryer-collect-notify-clerk-0">不通知</label>
				</div>
				<div>此项设置配送员接单后,是否通知商户。通知方式为:微信模板消息和打印机打印(如果门店配置了打印机的话)</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">外卖单派单模式</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="dispatch_mode" id="dispatch-mode-1" <?php  if($order['dispatch_mode'] == '1') { ?>checked<?php  } ?>>
					<label for="dispatch-mode-1">抢单模式</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="dispatch_mode" id="dispatch-mode-2" <?php  if($order['dispatch_mode'] == '2') { ?>checked<?php  } ?>>
					<label for="dispatch-mode-2">管理员派单</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="3" name="dispatch_mode" id="dispatch-mode-3" <?php  if($order['dispatch_mode'] == '3') { ?>checked<?php  } ?>>
					<label for="dispatch-mode-3">系统分配</label>
				</div>
				<div class="help-block">
					系统分配算法需要配送员使用app接单,如果你没有授权配送员app,请不要选择该模式<br>
					系统分配算法：系统自动派单将根据配送员到店铺的距离自动选择最优配送员<br>
					注意：以上都会在配送员端显示待配送的订单，在“管理员派单”和“系统分配”的模式下，不会通知所有的配送员抢单，但是配送员可以自己在订单列表里抢单<br>
					注意：外卖单派单模式仅对平台配送订单有效，对店内配送单无效
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">管理员派单/系统分配是否允许配送员抢单</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="can_collect_order" id="can_collect_order-1" <?php  if($order['can_collect_order'] == '1') { ?>checked<?php  } ?>>
					<label for="can_collect_order-1">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="can_collect_order" id="can_collect_order-0" <?php  if(!$order['can_collect_order']) { ?>checked<?php  } ?>>
					<label for="can_collect_order-0">否</label>
				</div>
				<div class="help-block">
					设置不允许配送员抢单，则派单模式为管理员派单/系统分配时，配送员不可以进行抢单操作。抢单模式不受此设置限制。
				</div>
			</div>
		</div>
		<!--<div style="display: none">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员同时最多可抢</label>
				<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<input type="text" class="form-control" name="deliveryer_collect_max" digits="true" value="<?php  echo $order['deliveryer_collect_max'];?>">
						<span class="input-group-addon">单</span>
					</div>
					<div class="help-block">
						设置配送员同一时间最多可抢几单,超出后将不能在抢。0为不限制
						<br>
						<strong class="text-danger">注意：管理员派单不受此数量限制，抢单/系统分配受限制</strong>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">超出最多可抢单后,是否还通知配送员</label>
				<div class="col-sm-9 col-xs-12">
					<div class="radio radio-inline">
						<input type="radio" value="1" name="over_collect_max_notify" id="over-collect-max-notify-1" <?php  if($order['over_collect_max_notify'] == 1) { ?>checked<?php  } ?>>
						<label for="over-collect-max-notify-1">通知</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" value="0" name="over_collect_max_notify" id="over-collect-max-notify-0" <?php  if(!$order['over_collect_max_notify']) { ?>checked<?php  } ?>>
						<label for="over-collect-max-notify-0">不通知</label>
					</div>
					<span class="help-block">设置当配送员已抢单数超过最多可抢单数后,是否继续通知配送员有新的待配送订单</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否允许配送员转单</label>
				<div class="col-sm-9 col-xs-12">
					<div class="radio radio-inline">
						<input type="radio" value="1" name="deliveryer_transfer_status" id="deliveryer-transfer-status-1" <?php  if($order['deliveryer_transfer_status'] == '1') { ?>checked<?php  } ?>>
						<label for="deliveryer-transfer-status-1">允许</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" value="0" name="deliveryer_transfer_status" id="deliveryer-transfer-status-0" <?php  if($order['deliveryer_transfer_status'] == '0') { ?>checked<?php  } ?>>
						<label for="deliveryer-transfer-status-0">禁止</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员每天最多可转</label>
				<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<input type="text" class="form-control" name="deliveryer_transfer_max" value="<?php  echo $order['deliveryer_transfer_max'];?>" digits="true">
						<span class="input-group-addon">单</span>
					</div>
					<div class="help-block">配送员在遇到特殊情况下可申请转单，设置每天最多可转几次单。0为不限制</div>
				</div>
			</div>
		</div>-->
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">转单理由</label>
			<div class="col-sm-9 col-xs-12">
				<textarea name="deliveryer_transfer_reason" cols="30" rows="7" class="form-control"><?php  echo $order['deliveryer_transfer_reason'];?></textarea>
				<div class="help-block">可设置多个转单理由.每行一个</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员取消订单理由</label>
			<div class="col-sm-9 col-xs-12">
				<textarea name="deliveryer_cancel_reason" cols="30" rows="7" class="form-control"><?php  echo $order['deliveryer_cancel_reason'];?></textarea>
				<div class="help-block">可设置多个取消订单理由.每行一个</div>
			</div>
		</div>
		<h3>积分赠送</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">积分赠送状态</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="credit1[status]" id="credit1-status-1"<?php  if($order['grant_credit']['credit1']['status'] == 1) { ?>checked<?php  } ?>>
					<label for="credit1-status-1">开启</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="credit1[status]" id="credit1-status-0"<?php  if($order['grant_credit']['credit1']['status'] == 0) { ?>checked<?php  } ?>>
					<label for="credit1-status-0">关闭</label>
				</div>
				<div class="help-block text-danger">开启后,平台会在"订单完成后"给下单人赠送积分</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">积分赠送模式</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="credit1[grant_type]" value="1" <?php  if($order['grant_credit']['credit1']['grant_type'] == 1 || !$config['credit']['credit1']['grant_type']) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单固定</span>
					<input type="text" class="form-control" name="credit1[grant_num_1]" <?php  if($order['grant_credit']['credit1']['grant_type'] == 1) { ?>value="<?php  echo $order['grant_credit']['credit1']['grant_num'];?>"<?php  } ?>>
					<span class="input-group-addon">积分</span>
				</div>
				<br>
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="credit1[grant_type]" value="2" <?php  if($order['grant_credit']['credit1']['grant_type'] == 2) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">按1元赠送</span>
					<input type="text" class="form-control" name="credit1[grant_num_2]" <?php  if($order['grant_credit']['credit1']['grant_type'] == 2) { ?>value="<?php  echo $order['grant_credit']['credit1']['grant_num'];?>"<?php  } ?>>
					<span class="input-group-addon">积分的比例赠送</span>
				</div>
				<div class="help-block">例如:设置赠送比例为1元赠送10积分.订单总额为:20元, 那本订单工赠送:20*10=200积分</div>
			</div>
		</div>
		<h3>高级设置</h3>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">防客户拖定位降配送费</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="0" name="check_member_drag_address" id="check_member_drag_address-0"<?php  if($order['check_member_drag_address'] == '0' || !$order['check_member_drag_address']) { ?>checked<?php  } ?>>
					<label for="check_member_drag_address-0">关闭</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="1" name="check_member_drag_address" id="check_member_drag_address-1"<?php  if($order['check_member_drag_address'] == '1') { ?>checked<?php  } ?>>
					<label for="check_member_drag_address-1">开启</label>
				</div>
				<div class="help-block">此设置只对配送费设置为按距离收取有效。<span class="text-danger">开启此功能可能导致配送费计算偏差较大，不建议开启。</span></div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单调度页配送员排序</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="deliveryer_id" name="dispatch_sort" id="dispatch_sort-1"<?php  if($order['dispatch_sort'] == 'deliveryer_id') { ?>checked<?php  } ?>>
					<label for="dispatch_sort-1">配送员编号倒序</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="store2deliveryer_distance" name="dispatch_sort" id="dispatch_sort-0"<?php  if($order['dispatch_sort'] == 'store2deliveryer_distance' || !$order['dispatch_sort']) { ?>checked<?php  } ?>>
					<label for="dispatch_sort-0">配送员距离门店的距离排序</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">待抢订单列表是否显示收货地址</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="show_acceptaddress_when_firstdelivery" id="show_acceptaddress_when_firstdelivery-1"<?php  if($order['show_acceptaddress_when_firstdelivery'] == 1) { ?>checked<?php  } ?>>
					<label for="show_acceptaddress_when_firstdelivery-1">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="show_acceptaddress_when_firstdelivery" id="show_acceptaddress_when_firstdelivery-0"<?php  if($order['show_acceptaddress_when_firstdelivery'] == 0 || !$order['show_acceptaddress_when_firstdelivery']) { ?>checked<?php  } ?>>
					<label for="show_acceptaddress_when_firstdelivery-0">否</label>
				</div>
				<div class="help-block">此设置只针对配送员无未完成订单时,接新的一单时生效</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">待抢订单列表排序方式</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="desc" name="deliverynoassign_sort_type" id="deliverynoassign_sort_type-1"<?php  if($order['deliverynoassign_sort_type'] == 'desc') { ?>checked<?php  } ?>>
					<label for="deliverynoassign_sort_type-1">按下单时间倒序</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="asc" name="deliverynoassign_sort_type" id="deliverynoassign_sort_type-0"<?php  if($order['deliverynoassign_sort_type'] == 'asc' || !$order['deliverynoassign_sort_type']) { ?>checked<?php  } ?>>
					<label for="deliverynoassign_sort_type-0">按下单时间正序</label>
				</div>
				<div class="help-block">正序是先下单的在最先显示,倒序是后下单的在最先显示</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单超时</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="input-group">
					<input type="text" class="form-control" name="timeout_limit" value="<?php  echo $order['timeout_limit'];?>">
					<span class="input-group-addon">分钟</span>
				</div>
				<span class="help-block">从订单支付完成开始计算到订单完成的时间超过此时间, 则会被标记, 便于管理员查看</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单配送提前</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="input-group">
					<input type="text" class="form-control" name="delivery_before_limit" value="<?php  echo $order['delivery_before_limit'];?>">
					<span class="input-group-addon">分钟</span>
				</div>
				<span class="help-block">从配送员接单开始计算到订单完成的时间小于此时间, 则会被标记, 便于管理员查看</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单配送超时</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="input-group">
					<input type="text" class="form-control" name="delivery_timeout_limit" value="<?php  echo $order['delivery_timeout_limit'];?>">
					<span class="input-group-addon">分钟</span>
				</div>
				<span class="help-block">从配送员接单开始计算到订单完成的时间超过此时间, 则会被标记, 便于管理员查看</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">待抢订单最多显示</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" name="max_dispatching" value="<?php  echo $order['max_dispatching'];?>" digits="true">
					<span class="input-group-addon">单</span>
				</div>
				<div class="help-block">此项设置仅在配送员待抢列表中按顾客下单时间排列显示限制。0为不限制</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">待抢订单超时时间</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" name="delivery_status_3[timeout_limit]" value="<?php  echo $order['delivery_status_3']['timeout_limit'];?>" digits="true">
					<span class="input-group-addon">分钟</span>
				</div>
				<div class="help-block">从商家通知配送员接单到配送员接单之间的时间</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">待抢订单接单显示</label>
			<div class="col-sm-9 col-xs-12">
				<div id="delivery-status-3-container">
					<div class="attr-item">
						<div class="input-group">
							<span class="input-group-addon">已过</span>
							<input type="text" class="form-control" name="delivery_status_3[timeout_remind][minute][]" value="<?php  echo $order['delivery_status_3']['timeout_remind'][0]['minute'];?>" digits="true">
							<span class="input-group-addon">分钟,提示</span>
							<input class="form-control" type="text" name="delivery_status_3[timeout_remind][color][]"  placeholder="显示颜色" value="<?php  echo $order['delivery_status_3']['timeout_remind'][0]['color'];?>">
							<span class="input-group-addon" style="width:35px;border-left:none;background-color:<?php  echo $order['delivery_status_3']['timeout_remind'][0]['color'];?>;"></span>
							<span class="input-group-btn">
								<button class="btn btn-default colorpicker" type="button">选择颜色 <i class="fa fa-caret-down"></i></button>
								<button class="btn btn-default colorclean" type="button"><span><i class="fa fa-remove"></i></span></button>
							</span>
						</div>
					</div>
					<br>
					<div class="attr-item">
						<div class="input-group">
							<span class="input-group-addon">已过</span>
							<input type="text" class="form-control" name="delivery_status_3[timeout_remind][minute][]" value="<?php  echo $order['delivery_status_3']['timeout_remind'][1]['minute'];?>" digits="true">
							<span class="input-group-addon">分钟,提示</span>
							<input class="form-control" type="text" name="delivery_status_3[timeout_remind][color][]"  placeholder="显示颜色" value="<?php  echo $order['delivery_status_3']['timeout_remind'][1]['color'];?>">
							<span class="input-group-addon" style="width:35px;border-left:none;background-color: <?php  echo $order['delivery_status_3']['timeout_remind'][1]['color'];?>;"></span>
							<span class="input-group-btn">
								<button class="btn btn-default colorpicker" type="button">选择颜色 <i class="fa fa-caret-down"></i></button>
								<button class="btn btn-default colorclean" type="button"><span><i class="fa fa-remove"></i></span></button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">待取餐订单超时时间</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" name="delivery_status_7[timeout_limit]" value="<?php  echo $order['delivery_status_7']['timeout_limit'];?>" digits="true">
					<span class="input-group-addon">分钟</span>
				</div>
				<div class="help-block">从配送员接单到配送员到店之间的时间</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">待取餐订单接单显示</label>
			<div class="col-sm-9 col-xs-12">
				<div id="delivery-status-7-container">
					<div class="attr-item">
						<div class="input-group">
							<span class="input-group-addon">已过</span>
							<input type="text" class="form-control" name="delivery_status_7[timeout_remind][minute][]" value="<?php  echo $order['delivery_status_7']['timeout_remind'][0]['minute'];?>" digits="true">
							<span class="input-group-addon">分钟,提示</span>
							<input class="form-control" type="text" name="delivery_status_7[timeout_remind][color][]"  placeholder="显示颜色" value="<?php  echo $order['delivery_status_7']['timeout_remind'][0]['color'];?>">
							<span class="input-group-addon" style="width:35px;border-left:none;background-color:<?php  echo $order['delivery_status_7']['timeout_remind'][0]['color'];?>;"></span>
							<span class="input-group-btn">
								<button class="btn btn-default colorpicker" type="button">选择颜色 <i class="fa fa-caret-down"></i></button>
								<button class="btn btn-default colorclean" type="button"><span><i class="fa fa-remove"></i></span></button>
							</span>
						</div>
					</div>
					<br>
					<div class="attr-item">
						<div class="input-group">
							<span class="input-group-addon">已过</span>
							<input type="text" class="form-control" name="delivery_status_7[timeout_remind][minute][]" value="<?php  echo $order['delivery_status_7']['timeout_remind'][1]['minute'];?>" digits="true">
							<span class="input-group-addon">分钟,提示</span>
							<input class="form-control" type="text" name="delivery_status_7[timeout_remind][color][]"  placeholder="显示颜色" value="<?php  echo $order['delivery_status_7']['timeout_remind'][1]['color'];?>">
							<span class="input-group-addon" style="width:35px;border-left:none;background-color: <?php  echo $order['delivery_status_7']['timeout_remind'][1]['color'];?>;"></span>
							<span class="input-group-btn">
								<button class="btn btn-default colorpicker" type="button">选择颜色 <i class="fa fa-caret-down"></i></button>
								<button class="btn btn-default colorclean" type="button"><span><i class="fa fa-remove"></i></span></button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">待送达订单超时时间</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" name="delivery_status_4[timeout_limit]" value="<?php  echo $order['delivery_status_4']['timeout_limit'];?>" digits="true">
					<span class="input-group-addon">分钟</span>
				</div>
				<div class="help-block">从配送员到店取货到配送员送达之间的时间</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">待送达订单接单显示</label>
			<div class="col-sm-9 col-xs-12">
				<div id="delivery-status-4-container">
					<div class="attr-item">
						<div class="input-group">
							<span class="input-group-addon">已过</span>
							<input type="text" class="form-control" name="delivery_status_4[timeout_remind][minute][]" value="<?php  echo $order['delivery_status_4']['timeout_remind'][0]['minute'];?>" digits="true">
							<span class="input-group-addon">分钟,提示</span>
							<input class="form-control" type="text" name="delivery_status_4[timeout_remind][color][]"  placeholder="显示颜色" value="<?php  echo $order['delivery_status_4']['timeout_remind'][0]['color'];?>">
							<span class="input-group-addon" style="width:35px;border-left:none;background-color:<?php  echo $order['delivery_status_4']['timeout_remind'][0]['color'];?>;"></span>
							<span class="input-group-btn">
								<button class="btn btn-default colorpicker" type="button">选择颜色 <i class="fa fa-caret-down"></i></button>
								<button class="btn btn-default colorclean" type="button"><span><i class="fa fa-remove"></i></span></button>
							</span>
						</div>
					</div>
					<br>
					<div class="attr-item">
						<div class="input-group">
							<span class="input-group-addon">已过</span>
							<input type="text" class="form-control" name="delivery_status_4[timeout_remind][minute][]" value="<?php  echo $order['delivery_status_4']['timeout_remind'][1]['minute'];?>" digits="true">
							<span class="input-group-addon">分钟,提示</span>
							<input class="form-control" type="text" name="delivery_status_4[timeout_remind][color][]"  placeholder="显示颜色" value="<?php  echo $order['delivery_status_4']['timeout_remind'][1]['color'];?>">
							<span class="input-group-addon" style="width:35px;border-left:none;background-color: <?php  echo $order['delivery_status_4']['timeout_remind'][1]['color'];?>;"></span>
							<span class="input-group-btn">
								<button class="btn btn-default colorpicker" type="button">选择颜色 <i class="fa fa-caret-down"></i></button>
								<button class="btn btn-default colorclean" type="button"><span><i class="fa fa-remove"></i></span></button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="submit" value="提交" class="btn btn-primary col-lg-1">
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
require(["jquery", "util"], function($, util){
	$(".colorpicker").each(function(){
		var elm = this;
		util.colorpicker(elm, function(color){
			$(elm).parent().prev().prev().val(color.toHexString());
			$(elm).parent().prev().css("background-color", color.toHexString());
		});
	});
	$(".colorclean").click(function(){
		$(this).parent().prev().prev().val("");
		$(this).parent().prev().css("background-color", "#FFF");
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
