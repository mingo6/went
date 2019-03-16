<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<h2>跑腿设置</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="status" id="status-1" <?php  if($config_errander['status'] == '1') { ?>checked<?php  } ?>>
					<label for="status-1">开启</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="status" id="status-0" <?php  if($config_errander['status'] == '0') { ?>checked<?php  } ?>>
					<label for="status-0">关闭</label>
				</div>
				<div class="help-block">设置跑腿状态</div>
			</div>
		</div>
		<div class="form-group close-reason">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">关闭跑腿原因</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="close_reason" value="<?php  echo $config_errander['close_reason'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跑腿中心点</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_tiny_coordinate('map', $config_errander['map'], true);?>
				<div class="help-block">设置跑腿服务中心点</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跑腿服务半径</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="number" class="form-control" name="serve_radius" value="<?php  echo $config_errander['serve_radius'];?>">
					<span class="input-group-addon">KM</span>
				</div>
				<div class="help-block">设置服务半径</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跑腿服务城市(省/市)</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="city" value="<?php  echo $config_errander['city'];?>">
				<div class="help-block">填写跑腿服务所属的"市"或"省". 比如:你在县城里做跑腿, 需要填写该县城所属的"市"或"省".</div>
				<div class="help-block">该项的作用是:用户在搜索地址的时候, 只返回该"省"或"市"内的相关地址</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">客服电话</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="mobile" value="<?php  echo $config_errander['mobile'];?>">
				<div class="help-block">设置客服电话.</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">支付时间限制</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="number" class="form-control" name="pay_time_limit" value="<?php  echo $config_errander['pay_time_limit'];?>">
					<span class="input-group-addon">分钟</span>
				</div>
				<div class="help-block">例如:设置为15分钟,那么用户在提交订单后15分钟内未支付,系统会自动取消该订单.如果没有支付时间限制,请设置为0</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">接单时间限制</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="number" class="form-control" name="handle_time_limit" value="<?php  echo $config_errander['handle_time_limit'];?>">
					<span class="input-group-addon">分钟</span>
				</div>
				<div class="help-block">例如:设置为10分钟,那么用户在付款10分钟后仍然没有配送员接单,系统会自动取消该订单.如果没有接单时间限制,请设置为0</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单自动完成（仅限配送员已接单的订单）</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="input-group">
					<input type="text" class="form-control" name="auto_success_hours" digits="true" value="<?php  echo $config_errander['auto_success_hours'];?>">
					<span class="input-group-addon">小时</span>
				</div>
				<span class="help-block">只有被配送员接单后的订单在超过设置的时间才会被自动设置为完成. </span>
				<span class="help-block">自动完成时间只能是整数, 如果你不需要自动完成, 可以设置为0. </span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单配送提前</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="input-group">
					<input type="text" class="form-control" name="delivery_before_limit" value="<?php  echo $config_errander['delivery_before_limit'];?>">
					<span class="input-group-addon">分钟</span>
				</div>
				<span class="help-block">从配送员接单开始计算到订单完成的时间小于此时间, 则会被标记, 便于管理员查看</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">订单配送超时</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="input-group">
					<input type="text" class="form-control" name="delivery_timeout_limit" value="<?php  echo $config_errander['delivery_timeout_limit'];?>">
					<span class="input-group-addon">分钟</span>
				</div>
				<span class="help-block">从配送员接单开始计算到订单完成的时间超过此时间, 则会被标记, 便于管理员查看</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员跑腿订单是否开启自动刷新</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="auto_refresh" id="auto_refresh-1" <?php  if($config_errander['auto_refresh'] == '1') { ?>checked<?php  } ?>>
					<label for="auto_refresh-1">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="auto_refresh" id="auto_refresh-2" <?php  if($config_errander['auto_refresh'] == '2') { ?>checked<?php  } ?>>
					<label for="auto_refresh-2">否</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员送达后是否要向顾客获取收货码</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="verification_code" id="verification_code-1" <?php  if($config_errander['verification_code'] == '1') { ?>checked<?php  } ?>>
					<label for="verification_code-1">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="verification_code" id="verification_code-2" <?php  if($config_errander['verification_code'] == '2') { ?>checked<?php  } ?>>
					<label for="verification_code-2">否</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跑腿单派单模式</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="dispatch_mode" id="dispatch-mode-1" <?php  if($config_errander['dispatch_mode'] == '1') { ?>checked<?php  } ?>>
					<label for="dispatch-mode-1">抢单模式</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="2" name="dispatch_mode" id="dispatch-mode-2" <?php  if($config_errander['dispatch_mode'] == '2') { ?>checked<?php  } ?>>
					<label for="dispatch-mode-2">管理员派单</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="3" name="dispatch_mode" id="dispatch-mode-3" <?php  if($config_errander['dispatch_mode'] == '3') { ?>checked<?php  } ?>>
					<label for="dispatch-mode-3">系统分配</label>
				</div>
				<div class="help-block">
					<strong class="text-danger">
						系统分配算法需要配送员使用app接单,如果你没有授权配送员app,请不要选择该模式。<br>
						系统分配算法：当跑腿订单有购买地址时， 系统把订单分配给离购买地址最近的配送员。当跑腿订单没有购买地址时，系统把订单分配给离收货地址最近的配送员
					</strong>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">管理员派单/系统分配是否允许配送员抢单</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="can_collect_order" id="can_collect_order-1" <?php  if($config_errander['can_collect_order'] == '1') { ?>checked<?php  } ?>>
					<label for="can_collect_order-1">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="can_collect_order" id="can_collect_order-0" <?php  if(!$config_errander['can_collect_order']) { ?>checked<?php  } ?>>
					<label for="can_collect_order-0">否</label>
				</div>
				<div class="help-block">
					设置不允许配送员抢单，则派单模式为管理员派单/系统分配时，配送员不可以进行抢单操作。抢单模式不受此设置限制。
				</div>
			</div>
		</div>
<!--		<div style="display: none">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员同时最多可抢</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="number" class="form-control" name="deliveryer_collect_max" value="<?php  echo $config_errander['deliveryer_collect_max'];?>">
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
					<input type="radio" value="1" name="over_collect_max_notify" id="over-collect-max-notify-1" <?php  if($config_errander['over_collect_max_notify'] == 1) { ?>checked<?php  } ?>>
					<label for="over-collect-max-notify-1">通知</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="over_collect_max_notify" id="over-collect-max-notify-0" <?php  if(!$config_errander['over_collect_max_notify']) { ?>checked<?php  } ?>>
					<label for="over-collect-max-notify-0">不通知</label>
				</div>
				<span class="help-block">设置当配送员已抢单数超过最多可抢单数后,是否继续通知配送员有新的待配送订单</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否允许配送员转单</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="deliveryer_transfer_status" id="deliveryer-transfer-status-1" <?php  if($config_errander['deliveryer_transfer_status'] == '1') { ?>checked<?php  } ?>>
					<label for="deliveryer-transfer-status-1">允许</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="deliveryer_transfer_status" id="deliveryer-transfer-status-0" <?php  if($config_errander['deliveryer_transfer_status'] == '0') { ?>checked<?php  } ?>>
					<label for="deliveryer-transfer-status-0">禁止</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员每天最多可转</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="text" class="form-control" name="deliveryer_transfer_max" value="<?php  echo $config_errander['deliveryer_transfer_max'];?>" digits="true">
					<span class="input-group-addon">单</span>
				</div>
				<div class="help-block">配送员在遇到特殊情况下可申请转单，设置每天最多可转几次单。0为不限制</div>
			</div>
		</div>
		</div>-->
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">转单理由</label>
			<div class="col-sm-9 col-xs-12">
				<textarea name="deliveryer_transfer_reason" cols="30" rows="7" class="form-control"><?php  echo $config_errander['deliveryer_transfer_reason'];?></textarea>
				<div class="help-block">可设置多个转单理由.每行一个</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送员取消订单理由</label>
			<div class="col-sm-9 col-xs-12">
				<textarea name="deliveryer_cancel_reason" cols="30" rows="7" class="form-control"><?php  echo $config_errander['deliveryer_cancel_reason'];?></textarea>
				<div class="help-block">可设置多个取消订单理由.每行一个</div>
			</div>
		</div>
<!--		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">平台给配送员每单支付金额(跑腿单)</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_fee_type" value="1" <?php  if($config_errander['deliveryer_fee_type'] == 1 || !$config_errander['deliveryer_fee_type']) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单固定</span>
					<input type="text" class="form-control" name="deliveryer_fee_1" <?php  if($config_errander['deliveryer_fee_type'] == 1) { ?>value="<?php  echo $config_errander['deliveryer_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元</span>
				</div>
				<br>
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_fee_type" value="2" <?php  if($config_errander['deliveryer_fee_type'] == 2) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单按照订单配送费提成</span>
					<input type="text" class="form-control" name="deliveryer_fee_2" <?php  if($config_errander['deliveryer_fee_type'] == 2) { ?>value="<?php  echo $config_errander['deliveryer_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">%</span>
				</div>
				<br>
				<div class="input-group">
					<label class="input-group-addon">
						<input type="radio" name="deliveryer_fee_type" value="3" <?php  if($config_errander['deliveryer_fee_type'] == 3) { ?>checked<?php  } ?>>
					</label>
					<span class="input-group-addon">每单基础配送费</span>
					<input type="text" class="form-control" name="deliveryer_fee_3[start_fee]" <?php  if($config_errander['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $config_errander['deliveryer_fee']['start_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元,超过</span>
					<input type="text" class="form-control" name="deliveryer_fee_3[start_km]" <?php  if($config_errander['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $config_errander['deliveryer_fee']['start_km'];?>"<?php  } ?>>
					<span class="input-group-addon">公里,超过部分每公里增加</span>
					<input type="text" class="form-control" name="deliveryer_fee_3[pre_km]" <?php  if($config_errander['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $config_errander['deliveryer_fee']['pre_km'];?>"<?php  } ?>>
					<span class="input-group-addon">元,最高</span>
					<input type="text" class="form-control" name="deliveryer_fee_3[max_fee]" <?php  if($config_errander['deliveryer_fee_type'] == 3) { ?>value="<?php  echo $config_errander['deliveryer_fee']['max_fee'];?>"<?php  } ?>>
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block text-danger">第三种提成模式仅适用于开启按照距离收取配送费的计费模式。</div>
			</div>
		</div>-->
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>匿名自定义</label>
			<div class="col-sm-6 col-xs-6">
				<?php  if(!empty($config_errander['anonymous'])) { ?>
					<?php  if(is_array($config_errander['anonymous'])) { foreach($config_errander['anonymous'] as $anonymous) { ?>
						<div class="btn-group btn-label">
							<input type="hidden" name="anonymous[]" value="<?php  echo $anonymous;?>">
							<a class="btn btn-default border-radius-4"><?php  echo $anonymous;?></a>
							<a class="btn btn-default label-delete">
								<span class="fa fa-times-circle"></span>
							</a>
						</div>
					<?php  } } ?>
				<?php  } ?>
				<a class="btn btn-success label-add"><i class="fa fa-plus-circle"></i> 添加</a>
				<div class="help-block">例如: 范冰冰，李冰冰，章子怡等</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跑腿服务用户协议</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_ueditor('agreement', $agreement_errander);?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input type="submit" value="提交" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
irequire(['web/tiny'], function(tiny){
	$(document).on('click', '.label-add', function(){
		var $this = $(this);
		tiny.prompt($(this), '', function(data) {
			if(!data) {
				return false;
			}
			var html = '<div class="btn-group btn-label">'+
					'		<input type="hidden" name="anonymous[]" value="'+ data +'">'+
					'		<a class="btn btn-default border-radius-4">'+data+'</a>'+
					'		<a class="btn btn-default label-delete">'+
					'		    <span class="fa fa-times-circle"></span>'+
					'	    </a>'+
					'	</div>';
			$this.before(html);
		});
	});

	$(document).on('click', '.label-delete', function(){
		$(this).parents('.btn-group').remove();
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>