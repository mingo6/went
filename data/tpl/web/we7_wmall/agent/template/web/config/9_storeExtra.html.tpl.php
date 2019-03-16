<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix page-config-store-delivery">
	<h2>其他批量操作</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data" >
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">支付方式</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<?php  if(is_array($payments)) { foreach($payments as $payment) { ?>
					<?php  if(!empty($payment['value'])) { ?>
						<div class="checkbox checkbox-inline">
							<input type="checkbox" name="payment[]" id="payment-<?php  echo $payment['value'];?>" value="<?php  echo $payment['value'];?>" <?php  if(in_array($payment['value'], $extra['payment'])) { ?>checked<?php  } ?>>
							<label for="payment-<?php  echo $payment['value'];?>"><?php  echo $payment['title'];?></label>
						</div>
					<?php  } ?>
				<?php  } } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否允许商家自己设置商品已售份数</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="custom_goods_sailed_status" id="custom-goods-sailed-status-1" <?php  if($extra['custom_goods_sailed_status'] == 1) { ?>checked<?php  } ?>>
					<label for="custom-goods-sailed-status-1">允许</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="custom_goods_sailed_status" id="custom-goods-sailed-status-0" <?php  if($extra['custom_goods_sailed_status'] == 0 ||  !$extra['custom_goods_sailed_status']) { ?>checked<?php  } ?>>
					<label for="custom-goods-sailed-status-0">不允许</label>
				</div>
				<div class="help-block text-danger">当设置为不允许时, 商品的销量会按照销量就行递增</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否允许商家审核顾客评价</label>
			<div class="col-sm-8 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="self_audit_comment" id="self_audit_comment-1" required="true" onclick="$('.comment').show();" <?php  if($extra['self_audit_comment'] == 1) { ?>checked<?php  } ?>>
					<label for="self_audit_comment-1">允许</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="self_audit_comment" id="self_audit_comment-0" onclick="$('.comment').hide();" <?php  if($extra['self_audit_comment'] == 0 || !$extra['self_audit_comment']) { ?>checked<?php  } ?>>
					<label for="self_audit_comment-0">不允许</label>
				</div>
				<span class="help-block">注意:设置为不允许后,顾客对于商家的评价将直接审核通过并显示到手机端</span>
			</div>
		</div>
		<div class="form-group comment" <?php  if($extra['self_audit_comment'] == 0) { ?> style="display: none" <?php  } ?>>
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">顾客评价是否需要直接通过审核</label>
			<div class="col-sm-8 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="comment_status" id="comment_status-1" <?php  if($extra['comment_status'] == 1) { ?>checked<?php  } ?>>
					<label for="comment_status-1">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="comment_status" id="comment_status-0" <?php  if($extra['comment_status'] == 0 || !$extra['comment_status']) { ?>checked<?php  } ?>>
					<label for="comment_status-0">否</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">预计送达时间计算方式</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" value="1" name="delivery_time_type" id="delivery_time_type-1" <?php  if($extra['delivery_time_type'] == 1) { ?>checked<?php  } ?>>
					<label for="delivery_time_type-1">门店手动设置</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" value="0" name="delivery_time_type" id="delivery_time_type-0" <?php  if($extra['delivery_time_type'] == 0 ||  !$extra['delivery_time_type']) { ?>checked<?php  } ?>>
					<label for="delivery_time_type-0">平台根据门店近30天的配送时间计算得出</label>
				</div>
				<div class="help-block text-danger">平台计算时间为近30天顾客支付成功到订单完成时间的平均值</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">支付后自动接单</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="radio radio-inline">
					<input type="radio" name="auto_handel_order" id="auto-handel-order-1" value="1" <?php  if($extra['auto_handel_order'] == 1) { ?>checked<?php  } ?>>
					<label for="auto-handel-order-1">开启</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="auto_handel_order" id="auto-handel-order-0" value="0" <?php  if(!$extra['auto_handel_order'] || $extra['auto_handel_order'] == 0) { ?>checked<?php  } ?>>
					<label for="auto-handel-order-0">关闭</label>
				</div>
				<span class="help-block">开启后, 用户下单支付后,系统会自动接单(设置订单为处理中.)</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">接单后自动通知配送员配送</label>
			<div class="col-sm-9 col-xs-9 col-md-9">
				<div class="radio radio-inline">
					<input type="radio" name="auto_notice_deliveryer" id="auto-notice-deliveryer-1" value="1" <?php  if($extra['auto_notice_deliveryer'] == 1) { ?>checked<?php  } ?>>
					<label for="auto-notice-deliveryer-1">开启</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="auto_notice_deliveryer" id="auto-notice-deliveryer-0" value="0" <?php  if(!$extra['auto_notice_deliveryer'] || $extra['auto_notice_deliveryer'] == 0) { ?>checked<?php  } ?>>
					<label for="auto-notice-deliveryer-0">关闭</label>
				</div>
				<span class="help-block">开启后, 店员接单后,系统会自动通知配送员进行配送(设置订单为待配送.仅对外卖订单有效).</span>
				<span class="help-block"><span class="bg-danger">注意：设置支付后自动接单, 也会自动通知配送员抢单</span></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">顾客催单开始时间</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="number" name="remind_time_start" class="form-control" value="<?php  echo $extra['remind_time_start'];?>">
					<span class="input-group-addon">分钟</span>
				</div>
				<span class="help-block">用户在下单后多少分钟可以开始催单，如设置3分钟，那么用户下单后3分钟之后才可以进行催单操作。不填写为不限制。</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">催单时间间隔</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="number" name="remind_time_limit" class="form-control" value="<?php  echo $extra['remind_time_limit'];?>">
					<span class="input-group-addon">分钟</span>
				</div>
				<span class="help-block">用户在下单后可进行多次催单,该项可设置催单间隔.如:用户现在进行催单,如果设置了10分钟的间隔,那么用户下次催单只能在10分钟以后</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">商家额外承担配送费</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">每单</span>
					<input type="number" name="store_bear_deliveryprice" class="form-control" value="<?php  echo $delivery['delivery_extra']['store_bear_deliveryprice'];?>">
					<span class="input-group-addon">元</span>
				</div>
				<span class="help-block">设置了商家额外承担配送费,将会从商家利润中扣除相应的这部分金额<br>
此项设置的费用将进入平台的收益，与配送员的订单提成没有关系</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">附加费</label>
			<div class="col-sm-9 col-xs-12">
				<div id="extra-fee-container">
					<?php  if(!empty($extra['extra_fee'])) { ?>
						<?php  if(is_array($extra['extra_fee'])) { foreach($extra['extra_fee'] as $fee) { ?>
							<div class="attr-item">
								<div class="input-group">
									<div class="input-group-addon">名称</div>
									<input type="text" class="form-control" name="extra[name][]" value="<?php  echo $fee['name'];?>">
									<div class="input-group-addon">金额</div>
									<input type="text" class="form-control" name="extra[fee][]" value="<?php  echo $fee['fee'];?>">
									<input type="hidden" name="extra[status][]" value="<?php  echo $fee['status'];?>">
									<div class="input-group-btn">
										<a href="javascript:;" class="btn btn-extra-fee <?php  if($fee['status'] == 1) { ?>btn-success<?php  } else { ?>btn-default<?php  } ?>"><?php  if($fee['status'] == 1) { ?>开启<?php  } else { ?>关闭<?php  } ?></a>
										<a href="javascript:;" class="btn btn-danger btn-del">删除</a>
									</div>
								</div>
							</div>
							<br>
						<?php  } } ?>
					<?php  } else { ?>
					<div class="attr-item">
						<div class="input-group">
							<div class="input-group-addon">名称</div>
							<input type="text" class="form-control" name="extra[name][]" value="">
							<div class="input-group-addon">金额</div>
							<input type="text" class="form-control" name="extra[fee][]" value="">
							<input type="hidden" name="extra[status][]" value="0">
							<div class="input-group-btn">
								<a href="javascript:;" class="btn btn-extra-fee btn-default">关闭</a>
								<a href="javascript:;" class="btn btn-danger btn-del">删除</a>
							</div>
						</div>
					</div>
					<br>
					<?php  } ?>
				</div>
				<a class="btn btn-primary btn-sm" id="add-extra-fee" href="javascript:;">添加附加费</a>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">将以上设置</label>
			<div class="col-sm-9 col-xs-12 toggle-tabs" data-content=".sync-type">
				<div class="input-group" >
					<div class="radio radio-inline">
						<input type="radio" name="extra_sync" id="extra-sync-1" value="1"/>
						<label for="extra-sync-1" class="toggle-role" data-target="sync-type-1">同步到所有商户</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" value="2" name="extra_sync" id="extra_sync-2"/>
						<label for="extra_sync-2" class="toggle-role" data-target="sync-type-2">同步到指定商户</label>
					</div>
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
		<div class="form-group col-sm-12">
			<input type="submit" value="提交" class="btn btn-primary">
		</div>
	</form>
</div>
<script>
	$(document).on('click', '#add-extra-fee', function() {
		var html =  '<div class="attr-item">'+
					'	<div class="input-group">'+
					'		<div class="input-group-addon">名称</div>'+
					'		<input type="text" class="form-control" name="extra[name][]" value="">'+
					'		<div class="input-group-addon">金额</div>'+
					'		<input type="text" class="form-control" name="extra[fee][]" value="">'+
					'		<input type="hidden" name="extra[status][]" value="0">'+
					'		<div class="input-group-btn">'+
					'			<a href="javascript:;" class="btn btn-extra-fee btn-default">关闭</a>'+
					'			<a href="javascript:;" class="btn btn-danger btn-del">删除</a>'+
					'		</div>'+
					'	</div>'+
					'</div>'+
					'<br>'
		$('#extra-fee-container').append(html);
	});

	$(document).on('click', '#extra-fee-container .btn-del', function() {
		$(this).parent().parent().parent().remove();
	});

	$(document).on('click', '#extra-fee-container .btn-extra-fee', function(){
		if($(this).hasClass('btn-success')) {
			$(this).parent().prev().val(0);
			$(this).removeClass('btn-success').addClass('btn-default');
			$(this).html('关闭');
		} else {
			$(this).parent().prev().val(1);
			$(this).removeClass('btn-default').addClass('btn-success');
			$(this).html('开启');
		}
	});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>