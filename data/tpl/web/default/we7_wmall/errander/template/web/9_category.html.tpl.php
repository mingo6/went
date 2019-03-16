<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'post') { ?>
<style>
	.form-group.discount{display: none;}
</style>
<div class="page clearfix">
	<h2>编辑跑腿分类</h2>
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跑腿类型</label>
			<div class="col-sm-9 col-xs-12">
				<select class="form-control" name="type">
					<?php  if(is_array($type)) { foreach($type as $category) { ?>
					<option value="<?php  echo $category['value'];?>" <?php  if($category['value'] == $item['type']) { ?>selected<?php  } ?>><?php  echo $category['errander_name'];?></option>
					<?php  } } ?>
				</select>
			</div>
		</div>

		<!--<div class="form-group">-->
			<!--<label class="col-xs-12 col-sm-3 col-md-2 control-label">跑腿类型</label>-->
			<!--<div class="col-sm-9 col-xs-12 toggle-tabs" data-content=".category-type">-->
				<!--<div class="radio radio-inline">-->
					<!--<input type="radio" name="type" value="buy" id="type-buy" <?php  if($item['type'] == 'buy' || !$item['type']) { ?>checked<?php  } ?>>-->
					<!--<label for="type-buy" class="toggle-role" data-target="category-type-1">家政服务</label>-->
				<!--</div>-->
				<!--<div class="radio radio-inline">-->
					<!--<input type="radio" name="type" value="delivery" id="type-delivery" <?php  if($item['type'] == 'delivery') { ?>checked<?php  } ?>>-->
					<!--<label for="type-delivery" class="toggle-role" data-target="category-type-1">家电维修</label>-->
				<!--</div>-->
				<!--<div class="radio radio-inline">-->
					<!--<input type="radio" name="type" value="pickup" id="type-pickup" <?php  if($item['type'] == 'pickup') { ?>checked<?php  } ?>>-->
					<!--<label for="type-pickup" class="toggle-role" data-target="category-type-1">废品回收</label>-->
				<!--</div>-->
				<!--<div class="radio radio-inline">-->
					<!--<input type="radio" name="type" value="errand" id="type-errand" <?php  if($item['type'] == 'errand') { ?>checked<?php  } ?>>-->
					<!--<label for="type-errand" class="toggle-role" data-target="category-type-1">社区跑腿</label>-->
				<!--</div>-->
			<!--</div>-->
		<!--</div>-->
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">标题</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>" required="true">
				<div class="help-block">例如: 家电维修，填写：电视</div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">图标</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_image('thumb', $item['thumb']);?>
				<div class="help-block">设置分类图标</div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">价格表</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_form_field_image('price_thumb', $item['price_thumb']);?>
				<div class="help-block">废品回收必须设置,其它可不设</div>
			</div>
		</div>

		<div class="form-group" style="display: none;">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">顾客是否上传相关图片</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="goods_thumbs_status" value="1" id="goods-thumbs-status-1" <?php  if($item['goods_thumbs_status'] == 1) { ?>checked<?php  } ?>>
					<label for="goods-thumbs-status-1">是</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="goods_thumbs_status" value="0" id="goods-thumbs-status-0" <?php  if($item['goods_thumbs_status'] == 0) { ?>checked<?php  } ?>>
					<label for="goods-thumbs-status-0">否</label>
				</div>
				<div class="help-block">此处开启上传图片以便于明确顾客需求,可选填</div>
			</div>
		</div>
		<div class="form-group" style="display: none;">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>商品类型</label>
			<div class="col-sm-9 col-xs-12">
				<?php  if(!empty($item['label'])) { ?>
					<?php  if(is_array($item['label'])) { foreach($item['label'] as $label) { ?>
						<div class="btn-group btn-label">
							<input type="hidden" name="label[]" value="<?php  echo $label;?>">
							<a class="btn btn-default"><?php  echo $label;?></a>
							<a class="btn btn-default label-delete">
								<span class="fa fa-times-circle"></span>
							</a>
						</div>
					<?php  } } ?>
				<?php  } ?>
				<a class="btn btn-success label-add"><i class="icon icon-plus-circle"></i> 添加</a>
				<div class="help-block">例如: 设置的标题是修家电, 商品标签可设置为: 修电视, 修空调, 修冰箱等</div>
			</div>
		</div>
		<div class="form-group" id="labels" style="display: none;">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>商品类型</label>
			<div class="col-sm-9 col-xs-12">
				<div class="tpl">
				<?php  if(!empty($item['labels'])) { ?>
					<?php  if(is_array($item['labels'])) { foreach($item['labels'] as $labels) { ?>
						<div class="input-group margin-b-10">
							<input type="hidden" name="labels[icon][]" value="<?php  echo $labels['icon'];?>">
							<span class="input-group-addon selectIcon">选择图标</span>
							<span class="input-group-addon">
								<span class="icon <?php  echo $labels['icon'];?>"></span>
							</span>
							<span class="input-group-addon">商品名称</span>
							<input type="text" name="labels[name][]" value="<?php  echo $labels['name'];?>" class="form-control" placeholder="商品名称">
							<span class="input-group-addon">搜索关键词</span>
							<input type="text" name="labels[keywords][]" value="<?php  echo $labels['keywords'];?>" class="form-control" placeholder="关键词">
							<span class="input-group-addon">开启自动搜索</span>
							<span class="input-group-btn">
								<input type="hidden" name="labels[autosearch][]" value="<?php  echo $labels['autosearch'];?>">
								<a href="javascript:;" class="btn btn-autosearch <?php  if($labels['autosearch'] == 1) { ?>btn-success<?php  } else { ?>btn-default<?php  } ?>"><?php  if($labels['autosearch'] == 1) { ?>是<?php  } else { ?>否<?php  } ?></a>
							</span>
							<span class="input-group-addon"><a href="javascript:;" class="labels-del"><i class="fa fa-times"></i></a></span>
						</div>
					<?php  } } ?>
				<?php  } ?>
				</div>
				<div class="help-block">设置多个搜索关键词用 “|” 分隔.<span class="text-danger" style="display:none;">当跑腿类型为“随意购”时,可设置顾客在小程序端点击是否自动自动搜索要购买商品的地址。注意：此功能仅对小程序有效</span></div>
				<a href="javascript:;" class="btn btn-success labels-add"><i class="icon icon-plus-circle"></i>添加商品</a>
			</div>
		</div>
		<!--<div class="form-group">-->
			<!--<label class="col-xs-12 col-sm-3 col-md-2 control-label">跑腿类型</label>-->
			<!--<div class="col-sm-9 col-xs-12 toggle-tabs" data-content=".category-type">-->
				<!--<div class="radio radio-inline">-->
					<!--<input type="radio" name="type" value="buy" id="type-buy" <?php  if($item['type'] == 'buy' || !$item['type']) { ?>checked<?php  } ?>>-->
					<!--<label for="type-buy" class="toggle-role" data-target="category-type-1">随意购</label>-->
				<!--</div>-->
				<!--<div class="radio radio-inline">-->
					<!--<input type="radio" name="type" value="delivery" id="type-delivery" <?php  if($item['type'] == 'delivery') { ?>checked<?php  } ?>>-->
					<!--<label for="type-delivery" class="toggle-role" data-target="category-type-1">快速送</label>-->
				<!--</div>-->
				<!--<div class="radio radio-inline">-->
					<!--<input type="radio" name="type" value="pickup" id="type-pickup" <?php  if($item['type'] == 'pickup') { ?>checked<?php  } ?>>-->
					<!--<label for="type-pickup" class="toggle-role" data-target="category-type-1">快速取</label>-->
				<!--</div>-->
				<!--<div class="radio radio-inline">-->
					<!--<input type="radio" name="type" value="multiaddress" id="type-multiaddress" <?php  if($item['type'] == 'multiaddress') { ?>checked<?php  } ?>>-->
					<!--<label for="type-multiaddress" class="toggle-role" data-target="category-type-2">多地址(仅限随意购)</label>-->
				<!--</div>-->
				<!--<div class="help-block">随意购: 帮顾客购买商品. 例如: 香烟,咖啡,早餐等.</div>-->
				<!--<div class="help-block">快速送: 帮顾客送货.</div>-->
				<!--<div class="help-block">快速取: 帮顾客取货.</div>-->
				<!--<div class="help-block">多地址: 顾客下单时,可填写多个购买地址,运营方可以设置每个地址不同的配送费.注意:此类随意购不支持距离和重量计费</div>-->
			<!--</div>-->
		<!--</div>-->

		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">费用设置</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<input type="number" class="form-control" name="start_fee" value="<?php  echo $item['start_fee'];?>">
					<span class="input-group-addon">元</span>
				</div>
			</div>
		</div>
		
		<div class="toggle-content category-type" style="display:none;">
			<div class="toggle-pane active" id="category-type-1">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">费用设置</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group margin-b-10">
							<!--<span class="input-group-addon">起步价</span>-->
							<!--<input type="number" class="form-control" name="start_fee" value="<?php  echo $item['start_fee'];?>">-->
							<!--<span class="input-group-addon border-0-lr">元包含</span>-->
							<input type="number" class="form-control" name="start_km" value="<?php  echo $item['start_km'];?>">
							<span class="input-group-addon">公里</span>
						</div>
						<div class="input-group margin-b-10">
							<span class="input-group-addon">每增加</span>
							<input type="number" class="form-control" name="pre_km" value="<?php  echo $item['pre_km'];?>">
							<span class="input-group-addon border-0-lr">公里加</span>
							<input type="number" class="form-control" name="pre_km_fee" value="<?php  echo $item['pre_km_fee'];?>">
							<span class="input-group-addon">元</span>
						</div>
						<label class="col-xs-12 col-sm-2 col-md-2 control-label" style="padding-left: 0">距离计算方式</label>
						<div class="col-sm-9 col-xs-12">
							<div class="radio radio-inline">
								<input type="radio" name="distance_calculate_type" value="0" id="distance_calculate_type-0" <?php  if($item['distance_calculate_type'] == 0) { ?>checked<?php  } ?>>
								<label for="distance_calculate_type-0">直线距离</label>
							</div>
							<div class="radio radio-inline">
								<input type="radio" name="distance_calculate_type" value="2" id="distance_calculate_type-2" <?php  if($item['distance_calculate_type'] == 2) { ?>checked<?php  } ?>>
								<label for="distance_calculate_type-2">骑行规划距离</label>
							</div>
							<div class="radio radio-inline">
								<input type="radio" name="distance_calculate_type" value="1" id="distance_calculate_type-1" <?php  if($item['distance_calculate_type'] == 1) { ?>checked<?php  } ?>>
								<label for="distance_calculate_type-1">驾车导航距离</label>
							</div>
							<div class="radio radio-inline">
								<input type="radio" name="distance_calculate_type" value="3" id="distance_calculate_type-3" <?php  if($item['distance_calculate_type'] == 3) { ?>checked<?php  } ?>>
								<label for="distance_calculate_type-3">步行距离</label>
							</div>
							<div class="help-block">提示：设置为按步行距离计算，如果距离超过5千米，系统会自动按骑行距离计算；设置的按骑行距离计算，如果距离过长，系统会自动按驾车距离计算。</div>
						</div>
						<div class="margin-b-10">
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="weight_fee_status" value="1" id="weight-fee-status" <?php  if($item['weight_fee_status'] == 1) { ?>checked<?php  } ?>>
								<label for="weight-fee-status">是否启用重量计费</label>
							</div>
						</div>
						<div id="weight-container" class="<?php  if(empty($item['weight_fee_status'])) { ?>hide<?php  } ?>">
							<div class="input-group margin-b-10">
								<span class="input-group-addon">起步价包含</span>
								<input type="number" class="form-control" name="start_weight" value="<?php  echo $item['weight_fee']['start_weight'];?>">
								<span class="input-group-addon">千克</span>
							</div>
							<?php  if(!empty($item['weight_fee']['weight'])) { ?>
								<?php  if(is_array($item['weight_fee']['weight'])) { foreach($item['weight_fee']['weight'] as $key => $weight) { ?>
									<div class="input-group margin-b-10">
										<span class="input-group-addon">超过</span>
										<input type="number" class="form-control" name="pre_kgs[]" value="<?php  echo $key;?>">
										<span class="input-group-addon border-0-lr">千克</span>
										<span class="input-group-addon">每千克增加</span>
										<input type="number" class="form-control border-0-lr" name="pre_kg_fees[]" value="<?php  echo $weight;?>">
										<span class="input-group-addon">元</span>
										<div class="input-group-btn">
											<a href="javascript:;" class="btn btn-danger weight-fee-del">删除</a>
										</div>
									</div>
								<?php  } } ?>
							<?php  } ?>
						</div>
						<a class="btn btn-default add-weight-fee <?php  if(empty($item['weight_fee_status'])) { ?>hide<?php  } ?>" href="javascript:;"><i class="fa fa-plus"></i> 添加收费规则</a>
					</div>
				</div>
			</div>
			<!--<div class="toggle-pane <?php  if($item['type'] == 'multiaddress') { ?>active<?php  } ?>" id="category-type-2">-->
				<!--<div class="form-group">-->
					<!--<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送费设置</label>-->
					<!--<div class="col-sm-9 col-xs-12">-->
						<!--<div class="input-group">-->
							<!--<span class="input-group-addon">最多可添加</span>-->
							<!--<input type="number" class="form-control" name="multiaddress[max]" value="<?php  echo $item['multiaddress']['max'];?>">-->
							<!--<span class="input-group-addon">个地址</span>-->
						<!--</div>-->
					<!--</div>-->
				<!--</div>-->
				<!--<div class="form-group">-->
					<!--<label class="col-xs-12 col-sm-3 col-md-2 control-label">每个地址的配送费</label>-->
					<!--<div class="col-sm-9 col-xs-12">-->
						<!--<input type="text" class="form-control" name="multiaddress[fee]" value="<?php  echo implode(',', $item['multiaddress']['fee'])?>">-->
						<!--<div class="help-block">每个地址的配送费用","隔开。例如：设置最多可添加3个地址,第一个地址配送费8元，第二个地址配送费5元， 第三个地址配送费3元，可设置为："8,5,3"</div>-->
					<!--</div>-->
				<!--</div>-->
			<!--</div>-->
		</div>
		<div class="form-group"  style="display:none;">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">物品价值设置</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<div class="radio radio-inline">
						<input type="radio" name="goods_value_status" value="0" id="goods_value_status-0" <?php  if($item['goods_value_status'] == 0 || !$item['goods_value_status']) { ?>checked<?php  } ?>>
						<label for="goods_value_status-0">关闭</label>
					</div>
					<div class="radio radio-inline">
						<input type="radio" name="goods_value_status" value="1" id="goods_value_status-1" <?php  if($item['goods_value_status'] == 1) { ?>checked<?php  } ?>>
						<label for="goods_value_status-1">启用</label>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">小费设置</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">最低</span>
					<input type="number" class="form-control" name="tip_min" value="<?php  echo $item['tip_min'];?>">
					<span class="input-group-addon border-0-lr">最高</span>
					<input type="number" class="form-control" name="tip_max" value="<?php  echo $item['tip_max'];?>">
					<span class="input-group-addon">元</span>
				</div>
			</div>
		</div>
		<div class="form-group"  style="display:none;">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">优惠方式</label>
			<div class="col-sm-9 col-xs-12">
				<div class="radio radio-inline">
					<input type="radio" name="discount_type" value="0" id="discount-type-0" required="true" <?php  if($item['group_discount']['type'] == 0 || !$item['group_discount']['type']) { ?>checked<?php  } ?> onclick="$('.discount').hide();">
					<label for="discount-type-0">不优惠</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="discount_type" value="1" id="discount-type-1" required="true" <?php  if($item['group_discount']['type'] == 1) { ?>checked<?php  } ?> onclick="$('.discount').hide();$('.discount-1').show();">
					<label for="discount-type-1">按满减优惠</label>
				</div>
				<div class="radio radio-inline">
					<input type="radio" name="discount_type" value="2" id="discount-type-2" required="true" <?php  if($item['group_discount']['type'] == 2) { ?>checked<?php  } ?> onclick="$('.discount').hide();$('.discount-2').show();">
					<label for="discount-type-2">按折扣优惠</label>
				</div>
			</div>
		</div>
		<div class="form-group discount discount-1" <?php  if($item['group_discount']['type'] == 1) { ?>style="display: block"<?php  } ?>>
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-12 containter">
				<?php  if(is_array($groups)) { foreach($groups as $group) { ?>
					<div class="input-group margin-b-10">
						<input type="hidden" name="groupids[]" value="<?php  echo $group['id'];?>">
						<span class="input-group-addon"><?php  echo $group['title'];?>满</span>
						<input type="number" class="form-control" name="condition1[]" value="<?php  echo $item['group_discount']['data'][$group['id']]['condition'];?>">
						<span class="input-group-addon">元,减</span>
						<input type="number" class="form-control" name="back1[]" value="<?php  echo $item['group_discount']['data'][$group['id']]['back'];?>">
						<span class="input-group-addon">元</span>
					</div>
				<?php  } } ?>
			</div>
		</div>
		<div class="form-group discount discount-2" <?php  if($item['group_discount']['type'] == 2) { ?>style="display: block"<?php  } ?>>
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-12">
				<?php  if(is_array($groups)) { foreach($groups as $group) { ?>
					<div class="input-group margin-b-10">
						<input type="hidden" name="groupid[]" value="<?php  echo $group['id'];?>">
						<span class="input-group-addon"><?php  echo $group['title'];?>满</span>
						<input type="number" class="form-control" name="condition2[]" value="<?php  echo $item['group_discount']['data'][$group['id']]['condition'];?>">
						<span class="input-group-addon">元,打</span>
						<input type="number" class="form-control" name="back2[]" value="<?php  echo $item['group_discount']['data'][$group['id']]['back'];?>">
						<span class="input-group-addon">折</span>
					</div>
				<?php  } } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>可提前几天下单</label>
			<div class="col-sm-9 col-xs-12">
				<input type="text" class="form-control" name="delivery_within_days" value="<?php  echo $item['delivery_within_days'];?>"/>
				<div class="help-block">单位：天，如果只接受当天订单，请填写0. 最多可提前6天</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送时间段</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group">
					<span class="input-group-addon">间隔</span>
					<input type="text" class="form-control" name="pre_delivery_time_minute" digits="true" value="<?php  echo $item['pre_delivery_time_minute'];?>">
					<span class="input-group-addon border-0-l">分钟</span>
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
					<?php  if(is_array($item['delivery_times'])) { foreach($item['delivery_times'] as $time) { ?>
						<div class="col-sm-6">
							<div class="input-group">
								<span class="input-group-addon"><?php  echo $time['start'];?> ~ <?php  echo $time['end'];?></span>
								<span class="input-group-addon">附加费</span>
								<input type="text" class="form-control border-0-lr" name="times[fee][]" value="<?php  echo $time['fee'];?>" placeholder="增加附加费">
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
		<div class="form-group" style="display: none;">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">进入分类提示信息</label>
			<div class="col-sm-9 col-xs-12">
				<div class="input-group margin-b-10">
					<span class="input-group-addon">提示文字</span>
					<input type="text" class="form-control" name="text" value="<?php  echo $item['notice']['text'];?>">
				</div>
				<div class="input-group margin-b-10">
					<span class="input-group-addon">跳转链接</span>
					<input type="text" class="form-control" name="url" value="<?php  echo $item['notice']['url'];?>">
				</div>
				<div class="input-group margin-b-10">
					<span class="input-group-addon">按钮文字</span>
					<input type="text" class="form-control" name="btn_text" value="<?php  echo $item['notice']['btn_text'];?>">
				</div>
				<div class="input-group margin-b-10">
					<span class="input-group-addon">提示间隔时间</span>
					<input type="text" class="form-control" name="between_time" value="<?php  echo $item['notice']['between_time'];?>">
					<span class="input-group-addon">分钟</span>
				</div>
				<div class="help-block">如不填写跳转连接,点击按钮默认关闭弹出框</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
			<div class="col-sm-9 col-xs-12">
				<input type="number" class="form-control" name="displayorder" value="<?php  echo $item['displayorder'];?>">
				<div class="help-block">数字越大越靠前</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">跑腿规则</label>
			<div class="col-sm-9 col-xs-12">
				<?php  echo tpl_ueditor('rule', $item['rule']);?>
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
<script id="tpl-delivery-time" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
		<div class="col-sm-6">
			<div class="input-group">
				<span class="input-group-addon"><{d[i].start}> ~ <{d[i].end}></span>
				<span class="input-group-addon">附加费</span>
				<input type="text" class="form-control border-0-lr" name="times[fee][]" value="<{d[i].fee}>" placeholder="增加附加费">
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

<script type="text/javascript">
irequire(['web/tiny'], function(tiny){
	$(document).on('click','.labels-add',function(){
		var html = '<div class="input-group margin-b-10">'+
						'<input type="hidden" name="labels[icon][]">'+
						'	<span class="input-group-addon selectIcon">选择图标</span>'+
						'	<span class="input-group-addon">'+
						'		<span></span>'+
						'	</span>'+
						'<span class="input-group-addon">商品名称</span>'+
						'<input type="text" name="labels[name][]" value="" class="form-control" placeholder="商品名称">'+
						'<span class="input-group-addon">搜索关键词</span>'+
						'<input type="text" name="labels[keywords][]" value="" class="form-control" placeholder="关键词">'+
						'<span class="input-group-addon">开启自动搜索</span>'+
						'<span class="input-group-btn">'+
						'	<input type="hidden" name="labels[autosearch][]" value="0">'+
						'	<a href="javascript:;" class="btn btn-autosearch btn-default">否</a>'+
						'</span>'+
						'<span class="input-group-addon"><a href="javascript:;" class="labels-del"><i class="fa fa-times"></i></a></span>'+
					'</div>'
		$('#labels .tpl').append(html);
	});

	$(document).on('click', '.btn-autosearch', function(){
		if($(this).hasClass('btn-success')) {
			$(this).prev().val(0);
			$(this).removeClass('btn-success').addClass('btn-default');
			$(this).html('否');
		} else {
			$(this).prev().val(1);
			$(this).removeClass('btn-default').addClass('btn-success');
			$(this).html('是');
		}
	});

	$(document).on('click', '.selectIcon', function(){
		var temp = $(this);
		irequire(["web/tiny"], function(tiny){
			tiny.selectIcon(function(icon){
				temp.prev().val(icon).trigger("change");
				temp.next().children().removeAttr("class").addClass("icon " + icon);
			});
		});
	});

	$(document).on('click','.labels-del',function(){
		alert('确定删除?');
		$(this).parent().parent().remove();
	});

	$(document).on('click', '.label-add', function(){
		var $this = $(this);
		tiny.prompt($(this), '', function(data) {
			if(!data) {
				return false;
			}
			var html = '<div class="btn-group btn-label">'+
					'		<input type="hidden" name="label[]" value="'+ data +'">'+
					'		<a class="btn btn-default">'+data+'</a>'+
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

	$(document).on('click', 'input[name="weight_fee_status"]', function() {
		$('#weight-container').addClass('hide');
		$('.add-weight-fee').addClass('hide');
		if($(this).prop('checked')) {
			$('#weight-container').removeClass('hide');
			$('.add-weight-fee').removeClass('hide');
		}
	});

	$(document).on('click', '.add-weight-fee', function() {
		var html = '<div class="input-group margin-b-10">'+
				'		<span class="input-group-addon">超过</span>'+
				'		<input type="number" class="form-control" name="pre_kgs[]">'+
				'		<span class="input-group-addon border-0-lr">千克</span>'+
				'		<span class="input-group-addon">每千克增加</span>'+
				'		<input type="number" class="form-control border-0-lr" name="pre_kg_fees[]">'+
				'		<span class="input-group-addon">元</span>'+
				'		<div class="input-group-btn">'+
				'			<a href="javascript:;" class="btn btn-danger weight-fee-del">删除</a>'+
				'		</div>'+
				'	</div>';
		$("#weight-container").append(html);
	});

	$(document).on('click', '.weight-fee-del', function() {
		$(this).parents('.input-group').remove();
	});
});
</script>
<script>
	irequire(['tiny', 'laytpl'], function(tiny, laytpl){
		$(document).on('click', '.btn-deliveryer-item', function(){
			$(this).parents('tr').remove();
		});
	});
</script>
<?php  } ?>

<?php  if($op == 'list') { ?>
<form action="" class="form-table form form-validate" method="post">
	<div class="panel panel-table">
		<div class="panel-heading">
			<a href="<?php  echo iurl('errander/category/post');?>" class="btn btn-primary btn-sm">添加跑腿分类</a>
		</div>
		<div class="panel-body table-responsive js-table">
			<?php  if(empty($categorys)) { ?>
				<div class="no-result">
					<p>还没有相关数据</p>
				</div>
			<?php  } else { ?>
				<table class="table table-hover">
					<thead class="navbar-inner">
						<tr>
							<th width="70">图标</th>
							<th>跑腿类型</th>
							<th>分类名称</th>
							<?php  if($_W['is_agent']) { ?>
								<th>所属代理</th>
							<?php  } ?>
							<th>排序</th>
							<th>收费标准</th>
							<th>小费设置</th>
							<th>状态</th>
							<th style="width:150px; text-align:right;">操作</th>
						</tr>
					</thead>
					<tbody>
					<?php  if(is_array($categorys)) { foreach($categorys as $item) { ?>
						<tr>
							<input type="hidden" name="ids[]" value="<?php  echo $item['id'];?>">
							<td><img src="<?php  echo tomedia($item['thumb']);?>" width="50"></td>
							<td><?php  echo $item['type'];?></td>
							<td><input type="text" name="title[]" class="form-control width-130" value="<?php  echo $item['title'];?>"></td>
							<?php  if($_W['is_agent']) { ?>
								<td><?php  echo $agents[$item['agentid']]['title'];?></td>
							<?php  } ?>
							<td><input type="text" name="displayorder[]" class="form-control width-100" value="<?php  echo $item['displayorder'];?>"></td>
							<td>
								<span class="label label-info">起步价<?php  echo $item['start_fee'];?>元包含<?php  echo $item['start_km'];?>公里</span>
								<br>
								<span class="label label-default label-br">每超过1公里增加<?php  echo $item['pre_km_fee'];?>元</span>
							</td>
							<td>
								<span class="label label-danger">最低<?php  echo $item['tip_min'];?>元, 最高<?php  echo $item['tip_max'];?>元</span>
							</td>
							<td>
								<input type="checkbox" class="js-checkbox" data-href="<?php  echo iurl('errander/category/status', array('id' => $item['id']));?>" data-name="status" value="1" <?php  if($item['status'] == 1) { ?>checked<?php  } ?>>
							</td>
							<td style="text-align:right;">
								<a href="<?php  echo iurl('errander/category/post', array('id' => $item['id']))?>" class="btn btn-default btn-sm">编辑</a>
								<a href="<?php  echo iurl('errander/category/del', array('id' => $item['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="确定删除吗">删除</a>
							</td>
						</tr>
					<?php  } } ?>
					</tbody>
				</table>
				<div class="btn-region clearfix">
					<div class="pull-left">
						<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
						<input type="submit" class="btn btn-primary btn-sm" name="submit" value="提交修改" />
					</div>
				</div>
			<?php  } ?>
		</div>
	</div>
</form>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
