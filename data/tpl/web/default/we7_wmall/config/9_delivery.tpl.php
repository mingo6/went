<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix page-config-store-delivery">
	<h2>服务费率</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data" style="max-width: 100%">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>配送模式</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="delivery_mode" value="1" id="delivery-mode-1" required="true" <?php  if($delivery['delivery_mode'] == 1) { ?>checked<?php  } ?>>
					<label for="delivery-mode-1">店内配送员</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="delivery_mode" value="2" id="delivery-mode-2" required="true" <?php  if($delivery['delivery_mode'] == 2) { ?>checked<?php  } ?>>
					<label for="delivery-mode-2">平台配送员</label>
				</div>
				<div class="help-block">
					门店只能选择一个配送方式, 不能同时使用"平台配送员"和"店内配送员". <br>
					如需单独设置某个门店的配送模式,配送费,配送时间段等信息, 请到"<a href="<?php  echo iurl('merchant/account/index');?>" target="_blank">财务中心-门店账户</a>"进行设置.
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送费</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="delivery_fee_mode" value="1" id="delivery-fee-mode-1" required="true" <?php  if($delivery['delivery_fee_mode'] == 1 || !$delivery['delivery_fee_mode']) { ?>checked<?php  } ?> onclick="$('.delivery-fee-mode').hide();$('.delivery-fee-mode-1').show();">
					<label for="delivery-fee-mode-1">固定金额</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="delivery_fee_mode" value="2" id="delivery-fee-mode-2" required="true" <?php  if($delivery['delivery_fee_mode'] == 2) { ?>checked<?php  } ?> onclick="$('.delivery-fee-mode').hide();$('.delivery-fee-mode-2').show();">
					<label for="delivery-fee-mode-2">按距离收取</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="delivery_fee_mode" value="3" id="delivery-fee-mode-3" required="true" <?php  if($delivery['delivery_fee_mode'] == 3) { ?>checked<?php  } ?> onclick="$('.delivery-fee-mode').hide();$('.delivery-fee-mode-3').show();">
					<label for="delivery-fee-mode-3">按区域收取</label>
				</div>
			</div>
		</div>
		<div class="form-group delivery-fee-mode delivery-fee-mode-1" <?php  if($delivery['delivery_fee_mode'] == 1 || !$delivery['delivery_fee_mode']) { ?>style="display: block"<?php  } ?>>
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<div class="input-group-addon">起送价</div>
					<input type="number" name="send_price_1" value="<?php  echo $delivery['send_price'];?>" class="form-control"/>
					<div class="input-group-addon">元</div>
					<div class="input-group-addon">满</div>
					<input type="number" name="delivery_free_price_1" value="<?php  echo $delivery['delivery_free_price'];?>" class="form-control"/>
					<div class="input-group-addon">元免配送费</div>
				</div>
				<br>
				<div class="input-group">
					<div class="input-group-addon">每单</div>
					<input type="text" name="delivery_fee" value="<?php  echo $delivery['delivery_fee'];?>" required="true" class="form-control"/>
					<div class="input-group-addon">元</div>
				</div>
				<div class="help-block">
					如需单独设置某个门店的配送模式,配送费,配送时间段等信息, 请到"<a href="<?php  echo iurl('merchant/account/index');?>" target="_blank">财务中心-门店账户</a>"进行设置.
					<br/>
					此项设置: 商家使用平台配送模式后, 下单人需要支付的配送费.使用平台配送模式后, 商家将不能自己变更配送费, 只能由平台管理员设置配送费.
				</div>
			</div>
		</div>
		<div class="form-group delivery-fee-mode delivery-fee-mode-2" <?php  if($delivery['delivery_fee_mode'] == 2) { ?>style="display: block"<?php  } ?>>
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<div class="input-group-addon">起送价</div>
					<input type="number" name="send_price_2" value="<?php  echo $delivery['send_price'];?>" class="form-control"/>
					<div class="input-group-addon">元</div>
					<div class="input-group-addon">满</div>
					<input type="number" name="delivery_free_price_2" value="<?php  echo $delivery['delivery_free_price'];?>" class="form-control"/>
					<div class="input-group-addon">元免配送费</div>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">起步价</span>
					<input type="text" class="form-control" name="start_fee" required="true" value="<?php  echo $delivery['delivery_fee']['start_fee'];?>">
					<span class="input-group-addon">元包含</span>
					<input type="text" class="form-control" name="start_km" required="true" value="<?php  echo $delivery['delivery_fee']['start_km'];?>">
					<span class="input-group-addon">公里</span>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">每增加1公里加</span>
					<input type="text" class="form-control" name="pre_km_fee" required="true" value="<?php  echo $delivery['delivery_fee']['pre_km_fee'];?>">
					<span class="input-group-addon">元</span>
					<span class="input-group-addon">最高收取</span>
					<input type="text" class="form-control" name="max_fee" value="<?php  echo $delivery['delivery_fee']['max_fee'];?>">
					<span class="input-group-addon">元</span>
				</div>
				<div class="help-block">
					如需单独设置某个门店的配送模式,配送费,配送时间段等信息, 请到"<a href="<?php  echo iurl('merchant/account/index');?>" target="_blank">财务中心-门店账户</a>"进行设置.
					<br/>
					特别注意: 设置按照"按距离收取"配送费后,系统会自动变更使用"平台配送"模式商家的某些配置。包括:收货地址被设置为自动获取, 超过配送范围是仍可下单
					<br/>
					此项设置: 商家使用平台配送模式后, 下单人需要支付的配送费.使用平台配送模式后, 商家将不能自己变更配送费, 只能由平台管理员设置配送费.
					<br/>
					最高收取:根据距离计算所得配送费超过此设置，配送费将收取此项设置的金额，设置为0，表示不限制。
				</div>
				<div class="input-group" style="width: 80%;">
					<label class="col-xs-12 col-sm-2 col-md-2 control-label">路径计算方式</label>
					<div class="col-sm-9 col-xs-12">
						<div class="radio radio-inline">
							<input type="radio" name="distance_type" value="0" id="distance_type-0" <?php  if($delivery['delivery_fee']['distance_type'] == 0) { ?>checked<?php  } ?>>
							<label for="distance_type-0">直线距离</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="distance_type" value="2" id="distance_type-2" <?php  if($delivery['delivery_fee']['distance_type'] == 2) { ?>checked<?php  } ?>>
							<label for="distance_type-2">骑行规划距离</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="distance_type" value="1" id="distance_type-1" <?php  if($delivery['delivery_fee']['distance_type'] == 1) { ?>checked<?php  } ?>>
							<label for="distance_type-1">驾车导航距离</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="distance_type" value="3" id="distance_type-3" <?php  if($delivery['delivery_fee']['distance_type'] == 3) { ?>checked<?php  } ?>>
							<label for="distance_type-3">步行距离</label>
						</div>
						<div class="help-block">提示：设置为按步行距离计算，如果距离超过5千米，系统会自动按骑行距离计算；设置的按骑行距离计算，如果距离过长，系统会自动按驾车距离计算。</div>
					</div>
				</div>
				<div class="input-group" style="width: 80%;">
					<label class="col-xs-12 col-sm-2 col-md-2 control-label">配送距离取整</label>
					<div class="col-sm-9 col-xs-12">
						<div class="radio radio-inline">
							<input type="radio" name="calculate_distance_type" id="calculate_distance_type-0" value="0" <?php  if($delivery['delivery_fee']['calculate_distance_type'] == 0 || !$delivery['delivery_fee']['calculate_distance_type']) { ?>checked<?php  } ?>>
							<label for="calculate_distance_type-0">默认</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="calculate_distance_type" id="calculate_distance_type-1" value="1" <?php  if($delivery['delivery_fee']['calculate_distance_type'] == 1) { ?>checked<?php  } ?>>
							<label for="calculate_distance_type-1">向上取整</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="calculate_distance_type" id="calculate_distance_type-2" value="2" <?php  if($delivery['delivery_fee']['calculate_distance_type'] == 2) { ?>checked<?php  } ?>>
							<label for="calculate_distance_type-2">向下取整</label>
						</div>
						<div class="help-block">例:配送距离为3.5公里,向上取整为4公里,向下取整为3公里,默认为不变</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group delivery-fee-mode delivery-fee-mode-3" <?php  if($delivery['delivery_fee_mode'] == 3) { ?>style="display: block"<?php  } ?>>
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-12">
				<?php  include itemplate('store/shop/geofence', TEMPLATE_INCLUDEPATH);?>
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
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">平台额外承担配送费</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">每单</span>
					<input type="number" name="plateform_bear_deliveryprice" class="form-control" value="<?php  echo $delivery['delivery_extra']['plateform_bear_deliveryprice'];?>">
					<span class="input-group-addon">元</span>
				</div>
				<span class="help-block">此项设置的费用将在配送员订单提成的基础上，额外给配送员加上此费用，属于平台针对某个商户的订单，额外补贴给配送员的费用。如果您不需要此功能，请忽略此设置</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">满金额免配送费由谁承担</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="delivery_free_bear" id="delivery_free_bear-plateform" value="plateform" <?php  if($delivery['delivery_extra']['delivery_free_bear'] == 'plateform' || !$delivery['delivery_extra']['delivery_free_bear']) { ?>checked<?php  } ?>>
					<label for="delivery_free_bear-plateform">平台</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="delivery_free_bear" id="delivery_free_bear-store" value="store" <?php  if($delivery['delivery_extra']['delivery_free_bear'] == 'store') { ?>checked<?php  } ?>>
					<label for="delivery_free_bear-store">商家</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送时间段</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">间隔</span>
					<input type="text" class="form-control" name="pre_delivery_time_minute" required="true" digits="true" value="<?php  echo $delivery['pre_delivery_time_minute'];?>">
					<span class="input-group-addon">分钟</span>
					<div class="input-group-btn btn-build-delivery-time">
						<a href="javascript:;" class="btn btn-primary">生成配送时间段</a>
					</div>
				</div>
			</div>
		</div>
		<div id="delivery-times" class="delivery-times">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
				<div class="col-sm-9 col-xs-12 containter">
					<?php  if(is_array($delivery_times)) { foreach($delivery_times as $time) { ?>
						<div class="col-sm-6">
							<div class="input-group">
								<span class="input-group-addon"><?php  echo $time['start'];?> ~ <?php  echo $time['end'];?></span>
								<span class="input-group-addon">附加费</span>
								<input type="text" class="form-control" name="times[fee][]" value="<?php  echo $time['fee'];?>" placeholder="增加附加费">
								<input type="hidden" name="times[start][]" value="<?php  echo $time['start'];?>"/>
								<input type="hidden" name="times[end][]" value="<?php  echo $time['end'];?>"/>
								<input type="hidden" name="times[status][]" value="<?php  echo $time['status'];?>">
								<span class="input-group-addon">元</span>
								<div class="input-group-btn">
									<a href="javascript:;" class="btn btn-delivery-time-item <?php  if($time['status'] == 1) { ?>btn-success<?php  } else { ?>btn-default<?php  } ?>"><?php  if($time['status'] == 1) { ?>使用中<?php  } else { ?>已弃用<?php  } ?></a>
								</div>
							</div>
						</div>
					<?php  } } ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">将配送模式和配送费同步到商户</label>
			<div class="col-sm-9 col-xs-12 toggle-tabs" data-content=".sync-type">
				<div class="input-group">
					<div class="radio radio-inline">
						<input type="radio" name="delivery_sync" id="delivery-sync-1" value="1"/>
						<label for="delivery-sync-1" class="toggle-role" data-target="sync-type-1">同步到所有商户</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" value="2" name="delivery_sync" id="delivery-sync-2">
						<label for= "delivery-sync-2" class="toggle-role" data-target="sync-type-2">同步到指定商户</label>
					</div>
				</div>
				<div class="help-block">同步后,所有商户的配送员模式都会被设置为这个规则</div>
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
<script id="tpl-delivery-time" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
		<div class="col-sm-6">
			<div class="input-group">
				<span class="input-group-addon"><{d[i].start}> ~ <{d[i].end}></span>
				<span class="input-group-addon">附加费</span>
				<input type="text" class="form-control" name="times[fee][]" value="<{d[i].fee}>" placeholder="增加附加费">
				<input type="hidden" name="times[start][]" value="<{d[i].start}>"/>
				<input type="hidden" name="times[end][]" value="<{d[i].end}>"/>
				<input type="hidden" name="times[status][]" value="1">
				<span class="input-group-addon">元</span>
				<div class="input-group-btn">
					<a href="javascript:;" class="btn btn-success btn-delivery-time-item">使用中</a>
				</div>
			</div>
		</div>
	<{# } }>
</script>
<script>
$(function(){
	$('#form1').submit(function(){
		var delivery_times_length = $('#delivery-times .containter .input-group').size();
		if(!delivery_times_length) {
			Notify.error('请先生成配送时间段');
			return false;
		}
	});

	$(document).on('click', '.btn-build-delivery-time', function(){
		var pre_minute = parseInt($.trim($(':text[name="pre_delivery_time_minute"]').val()));
		if(!pre_minute) {
			Notify.error('时间间隔必须大于0');
			return false;
		}
		$.post("<?php  echo iurl('common/utility/build_time');?>", {pre_minute: pre_minute}, function(data) {
			var result = $.parseJSON(data);
			if(result.message.errno == -1) {
				Notify.error(result.message.message);
				return false;
			}
			var gettpl = $('#tpl-delivery-time').html();
			irequire(['laytpl'], function(laytpl){
				laytpl(gettpl).render(result.message.message, function(html){
					$('#delivery-times .containter').html(html);
				});
			});
		});
	});

	$(document).on('click', '.btn-delivery-time-item', function(){
		if($(this).hasClass('btn-success')) {
			$(this).parent().prev().prev().val(0);
			$(this).removeClass('btn-success').addClass('btn-default');
			$(this).html('已弃用');
		} else {
			$(this).parent().prev().prev().val(1);
			$(this).removeClass('btn-default').addClass('btn-success');
			$(this).html('使用中');
		}
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>