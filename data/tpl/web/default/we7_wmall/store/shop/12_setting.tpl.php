<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page clearfix">
	<form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data" style="max-width: 100%">
		<input type="hidden" name="id" value="<?php  echo $id;?>">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" <?php  if($_GPC['type'] == 'basic' || !$_GPC['type']) { ?>class="active"<?php  } ?>><a href="#basic" aria-controls="basic" role="tab" data-toggle="pill">基本信息</a></li>
			<li role="presentation" <?php  if($_GPC['type'] == 'qualification') { ?>class="active"<?php  } ?>><a href="#qualification" aria-controls="qualification" role="tab" data-toggle="pill">营业资质</a></li>
			<li role="presentation" <?php  if($_GPC['type'] == 'instore') { ?>class="active"<?php  } ?>><a href="#instore" aria-controls="instore" role="tab" data-toggle="pill">店内点餐设置</a></li>
			<li role="presentation" <?php  if($_GPC['type'] == 'takeout') { ?>class="active"<?php  } ?>><a href="#takeout" aria-controls="takeout" role="tab" data-toggle="pill">外卖设置</a></li>
			<li role="presentation" <?php  if($_GPC['type'] == 'page') { ?>class="active"<?php  } ?>><a href="#page" aria-controls="page" role="tab" data-toggle="pill">页面设置</a></li>
			<li role="presentation" <?php  if($_GPC['type'] == 'high') { ?>class="active"<?php  } ?>><a href="#high" aria-controls="high" role="tab" data-toggle="pill">支付设置</a></li>
			<li role="presentation" <?php  if($_GPC['type'] == 'remind') { ?>class="active"<?php  } ?>><a href="#remind" aria-controls="remind" role="tab" data-toggle="pill">催单回复</a></li>
			<li role="presentation" <?php  if($_GPC['type'] == 'comment') { ?>class="active"<?php  } ?>><a href="#comment" aria-controls="comment" role="tab" data-toggle="pill">评价回复</a></li>
			<li role="presentation" <?php  if($_GPC['type'] == 'template') { ?>class="active"<?php  } ?>><a href="#template" aria-controls="template" role="tab" data-toggle="pill">模板配置</a></li>
			<?php  if(check_plugin_perm('eleme') && get_plugin_config('eleme.status') && $item['eleme_status'] == 1) { ?>
				<li role="presentation" <?php  if($_GPC['type'] == 'eleme') { ?>class="active"<?php  } ?>><a href="#eleme" aria-controls="eleme" role="tab" data-toggle="pill">饿了么对接</a></li>
			<?php  } ?>
			<?php  if(check_plugin_perm('meituan') && get_plugin_config('meituan.status') && $item['meituan_status'] == 1) { ?>
				<li role="presentation" <?php  if($_GPC['type'] == 'meituan') { ?>class="active"<?php  } ?>><a href="#meituan" aria-controls="meituan" role="tab" data-toggle="pill">美团对接</a></li>
			<?php  } ?>
			<?php  if(check_plugin_perm('dada') && get_plugin_config('dada.status')) { ?>
			<li role="presentation" <?php  if($_GPC['type'] == 'dada') { ?>class="active"<?php  } ?>><a href="#dada" aria-controls="dada" role="tab" data-toggle="pill">达达对接</a></li>
			<?php  } ?>
		</ul>
		<div class="tab-content">
			<div class="tab-pane <?php  if($_GPC['type'] == 'basic' || !$_GPC['type']) { ?>active<?php  } ?>" role="tabpanel" id="basic">
				<h3>商户基本信息</h3>
				<?php  if($item['id'] > 0) { ?>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">商户访问地址</label>
						<div class="col-sm-9 col-xs-12">
							<p class="form-control-static js-clip" data-href="<?php  echo $sys_url;?>">系统：<a href="javascript:;" title="点击复制链接"><?php  echo $sys_url;?></a></p>
						</div>
					</div>
				<?php  } ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">门店名称</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>" required="true">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">所属分类</label>
					<div class="col-sm-9 col-xs-12">
						<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
							<?php  if($category['is_sys'] == 1) { ?>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="cid[]" id="cid-<?php  echo $category['id'];?>" value="<?php  echo $category['id'];?>" <?php  if(in_array($category['id'], $item['cid'])) { ?>checked<?php  } ?> <?php  if(empty($_W['ismanager']) && empty($_W['isoperator'])) { ?>disabled<?php  } ?>>
								<label for="cid-<?php  echo $category['id'];?>"><?php  echo $category['title'];?></label>
							</div>
							<?php  } ?>
						<?php  } } ?>
						<span class="help-block">选择门店分类，可多选.<?php  if(empty($_W['ismanager']) && empty($_W['isoperator'])) { ?>如需调整，请联系平台管理员修改<?php  } ?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">门店LOGO</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_form_field_image('logo', $item['origin_logo']);?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">门店描述</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="content" value="<?php  echo $item['content'];?>" required="true">
						<div class="help-block">粉丝分享时调用.</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">门店电话</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="telephone" value="<?php  echo $item['telephone'];?>" required="true">
					</div>
				</div>
				<div id="hour">
					<div id="hour-tpl" class="clockpicker">
						<?php  if(!empty($item['business_hours'])) { ?>
							<?php  if(is_array($item['business_hours'])) { foreach($item['business_hours'] as $hour) { ?>
								<div class="form-group hour-item">
									<label class="col-xs-12 col-sm-3 col-md-2 control-label">营业时间</label>
									<div class="col-sm-9 col-xs-4 col-md-3">
										<div class="input-group">
											<input type="text" readonly name="business_start_hours[]" class="form-control" placeholder="" value="<?php  echo $hour['s'];?>">
											<span class="input-group-addon">至</span>
											<input type="text" readonly name="business_end_hours[]" class="form-control" placeholder="" value="<?php  echo $hour['e'];?>">
										</div>
									</div>
									<div class="col-sm-9 col-xs-4 col-md-3" style="padding-top:6px">
										<a href="javascript:;" onclick="$(this).parent().parent().remove()"><i class="fa fa-times-circle" title="删除时间段"> </i></a>
									</div>
								</div>
							<?php  } } ?>
						<?php  } else { ?>
							<div class="form-group hour-item">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">营业时间</label>
								<div class="col-sm-9 col-xs-4 col-md-3">
									<div class="input-group">
										<input type="text" readonly name="business_start_hours[]" class="form-control" placeholder="">
										<span class="input-group-addon">至</span>
										<input type="text" readonly name="business_end_hours[]" class="form-control" placeholder="">
									</div>
								</div>
								<div class="col-sm-9 col-xs-4 col-md-3" style="padding-top:6px">
									<a href="javascript:;" onclick="$(this).parent().parent().remove()"><i class="fa fa-times-circle" title="删除时间段"> </i></a>
								</div>
							</div>
						<?php  } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<a href="javascript:;" id="hour-add"><i class="fa fa-plus-circle"></i> 添加营业时间</a>
						<div class="help-block">请完善营业时间信息。最多可添加3个时间段。如果开始时间大于结束时间：例如22：00至2：00，则系统会默认营业时间为当天22:00至下一天2:00。</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">门店特色</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<?php  echo tpl_ueditor('description', $item['description']);?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">门店实景</label>
					<div class="col-sm-9 col-xs-9 col-md-9 thumbs">
						<a href="javascript:;" class="btn btn-primary" id="selectThumb">选择图片</a>
						<div class="help-block">建议图片尺寸:640*120</div>
						<?php  if(!empty($item['thumbs'])) { ?>
							<?php  if(is_array($item['thumbs'])) { foreach($item['thumbs'] as $slide) { ?>
								<div class="col-lg-4">
									<input type="hidden" name="thumbs[image][]" value="<?php  echo $slide['image'];?>">
									<div class="panel panel-default panel-slide">
										<div class="btnClose" onclick="$(this).parent().parent().remove()"><i class="fa fa-times"></i></div>
										<div class="panel-body">
											<img src="<?php  echo tomedia($slide['image']);?>" alt="" width="100%" height="170">
											<div>
												<input class="form-control last pull-right" placeholder="跳转链接" name="thumbs[url][]" value="<?php  echo $slide['url'];?>">
											</div>
										</div>
									</div>
								</div>
							<?php  } } ?>
						<?php  } ?>
						<div id="slideContainer"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">详细地址</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input type="text" name="address" class="form-control" value="<?php  echo $item['address'];?>" required="true">
						<div class="help-block">请尽可能详细. 商家自提地址为这里设置的地址.</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">地图标识</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<?php  echo tpl_form_field_tiny_coordinate('map', $item['map']);?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">商家QQ</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input type="text" class="form-control" name="sns[qq]" value="<?php  echo $item['sns']['qq'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">商家微信</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input type="text" class="form-control" name="sns[weixin]" value="<?php  echo $item['sns']['weixin'];?>">
					</div>
				</div>
				<div class="form-group <?php  if($_W['role'] == 'merchanter') { ?>hide<?php  } ?>">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input type="text" class="form-control" name="displayorder" value="<?php  echo $item['displayorder'];?>">
						<div class="help-block">数字越大，越靠前</div>
					</div>
				</div>
			</div>
			<div class="tab-pane <?php  if($_GPC['type'] == 'qualification') { ?>active<?php  } ?>" role="qualification" id="qualification">
				<h3>营业资质设置</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">营业执照</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<?php  echo tpl_form_field_image('qualification[business]', $item['qualification']['business']['thumb']);?>
						<div class="help-block">请上传营业执照照片。建议上传前加水印</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">餐饮服务许可证</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<?php  echo tpl_form_field_image('qualification[service]', $item['qualification']['service']['thumb']);?>
						<div class="help-block">请上传餐饮服务许可证。建议上传前加水印</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">更多资质一</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<?php  echo tpl_form_field_image('qualification[more1]', $item['qualification']['more1']['thumb']);?>
						<div class="help-block">请上传资质图片。建议上传前加水印</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">更多资质二</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<?php  echo tpl_form_field_image('qualification[more2]', $item['qualification']['more2']['thumb']);?>
						<div class="help-block">请上传资质图片。建议上传前加水印</div>
					</div>
				</div>
			</div>
			<div class="tab-pane <?php  if($_GPC['type'] == 'instore') { ?>active<?php  } ?>" role="tabpanel" id="instore">
				<h3>店内点餐设置</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">排号功能</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="is_assign" id="is-assign-1" value="1" <?php  if($item['is_assign'] == 1) { ?>checked<?php  } ?>>
							<label for="is-assign-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="is_assign" id="is-assign-0" value="0" <?php  if(!$item['is_assign']) { ?>checked<?php  } ?>>
							<label for="is-assign-0">关闭</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">预定功能</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="is_reserve" id="is-reserve-1" value="1" <?php  if($item['is_reserve'] == 1) { ?>checked<?php  } ?>>
							<label for="is-reserve-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="is_reserve" id="is-reserve-0" value="0" <?php  if(!$item['is_reserve']) { ?>checked<?php  } ?>>
							<label for="is-reserve-0">关闭</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">店内点餐</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="is_meal" id="is-meal-1" value="1" <?php  if($item['is_meal'] == 1) { ?>checked<?php  } ?>>
							<label for="is-meal-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="is_meal" id="is-meal-0" value="0" <?php  if(!$item['is_meal']) { ?>checked<?php  } ?>>
							<label for="is-meal-0">关闭</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">买单</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="is_paybill" id="is_paybill-1" value="1" <?php  if($item['is_paybill'] == 1) { ?>checked<?php  } ?>>
							<label for="is_paybill-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="is_paybill" id="is_paybill-0" value="0" <?php  if(!$item['is_paybill']) { ?>checked<?php  } ?>>
							<label for="is_paybill-0">关闭</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">点击门店直接跳转到</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="forward_mode" id="forward-mode-0" value="0" <?php  if(!$item['forward_mode']) { ?>checked<?php  } ?> onclick="$('.forward-url').hide();">
							<label for="forward-mode-0">默认页(外卖)</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="forward_mode" id="forward-mode-1" value="1" <?php  if($item['forward_mode'] == 1) { ?>checked<?php  } ?> onclick="$('.forward-url').hide();">
							<label for="forward-mode-1">门店详情页</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="forward_mode" id="forward-mode-3" value="3" <?php  if($item['forward_mode'] == 3) { ?>checked<?php  } ?> onclick="$('.forward-url').hide();">
							<label for="forward-mode-3">排队</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="forward_mode" id="forward-mode-4" value="4" <?php  if($item['forward_mode'] == 4) { ?>checked<?php  } ?> onclick="$('.forward-url').hide();">
							<label for="forward-mode-4">预定</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="forward_mode" id="forward-mode-6" value="6" <?php  if($item['forward_mode'] == 6) { ?>checked<?php  } ?> onclick="$('.forward-url').hide();">
							<label for="forward-mode-6">买单</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="forward_mode" id="forward-mode-5" value="5" <?php  if($item['forward_mode'] == 5) { ?>checked<?php  } ?> onclick="$('.forward-url').show();">
							<label for="forward-mode-5">自定义链接</label>
						</div>
					</div>
				</div>
				<div class="form-group forward-url" <?php  if($item['forward_mode'] != 5) { ?>style="display: none"<?php  } ?>>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-6 col-xs-6">
						<input type="text" class="form-control" name="forward_url" value="<?php  echo $item['forward_url'];?>" placeholder="填写自定义链接">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">服务费设置</label>
					<div class="col-sm-6 col-xs-6">
						<div class="input-group">
							<label class="input-group-addon">
								<input type="radio" name="serve_fee[type]" value="1" <?php  if($item['serve_fee']['type'] == 1 || !$item['serve_fee']['type']) { ?>checked<?php  } ?>>
							</label>
							<span class="input-group-addon">每单固定</span>
							<input type="text" class="form-control" name="serve_fee[fee_1]" <?php  if($item['serve_fee']['type'] == 1) { ?>value="<?php  echo $item['serve_fee']['fee'];?>"<?php  } ?>>
							<span class="input-group-addon">元</span>
						</div>
						<br>
						<div class="input-group">
							<label class="input-group-addon">
								<input type="radio" name="serve_fee[type]" value="2" <?php  if($item['serve_fee']['type'] == 2) { ?>checked<?php  } ?>>
							</label>
							<span class="input-group-addon">每单按照订单价格收取</span>
							<input type="text" class="form-control" name="serve_fee[fee_2]" <?php  if($item['serve_fee']['type'] == 2) { ?>value="<?php  echo $item['serve_fee']['fee'];?>"<?php  } ?>>
							<span class="input-group-addon">%</span>
						</div>
						<div class="help-block text-danger">服务费只在店内点餐时候有效, 外卖订单无效</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">人均消费</label>
					<div class="col-sm-6 col-xs-6">
						<div class="input-group">
							<input type="text" class="form-control" name="consume_per_person" value="<?php  echo $item['consume_per_person'];?>">
							<span class="input-group-addon">元</span>
						</div>
					</div>
				</div>
			</div>
			<div class="page-config-store-delivery tab-pane <?php  if($_GPC['type'] == 'takeout') { ?>active<?php  } ?>" role="tabpanel" id="takeout">
				<h3>外卖设置</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送方式</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="delivery_type" id="delivery-type-1" value="1" <?php  if($item['delivery_type'] == 1 || !$item['delivery_type']) { ?>checked<?php  } ?>>
							<label for="delivery-type-1">仅支持商家配送</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="delivery_type" id="delivery-type-2" value="2" <?php  if($item['delivery_type'] == 2) { ?>checked<?php  } ?>>
							<label for="delivery-type-2">仅支持到店自提</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="delivery_type" id="delivery-type-3" value="3" <?php  if($item['delivery_type'] == 3) { ?>checked<?php  } ?>>
							<label for="delivery-type-3">商家配送,到店自提都支持</label>
						</div>
						<div class="help-block">商家自提地址为门店信息里的地址.</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">可提前几天点外卖</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input type="text" class="form-control" name="delivery_within_days" value="<?php  echo $item['delivery_within_days'];?>">
						<div class="help-block">单位：天，如果只接受当天订单，请填写0. 最多可提前6天</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">需提前几天预定外卖</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input type="text" class="form-control" name="delivery_reserve_days" value="<?php  echo $item['delivery_reserve_days'];?>">
						<div class="help-block">单位：天，如果不需要提前预定，请填写0. 如果设置提前1天预定, 用户今天下单后, 能选择明天的配送时间进行配送</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">包装费</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="input-group">
							<input type="text" class="form-control" name="pack_price" value="<?php  echo $item['pack_price'];?>">
							<span class="input-group-addon">元</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">预计送达时间</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="input-group">
							<input type="text" class="form-control" name="delivery_time" value="<?php  echo $item['delivery_time'];?>" <?php  if($item['delivery_mode'] == 2 || $item['data']['delivery_time_type'] === 0) { ?>disabled<?php  } ?>>
							<span class="input-group-addon">分钟</span>
						</div>
						<div class="help-block">
							<?php  if($item['delivery_mode'] == 2) { ?>
								<span class="text-danger">当前门店的配送模式为平台配送,如需修改该项设置,请联系平台管理员</span>、
							<?php  } ?>
							<?php  if($item['data']['delivery_time_type'] === 0) { ?>
								<span class="text-danger">当前设置为平台根据近30天顾客支付成功到订单完成时间计算得出的平均值,不能手动填写</span>
							<?php  } ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">服务半径</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="input-group">
							<input type="text" class="form-control" name="serve_radius" value="<?php  echo $item['serve_radius'];?>" <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
							<span class="input-group-addon">KM</span>
						</div>
						<div class="help-block">
							<span class="text-danger"><?php  if($item['delivery_mode'] == 2) { ?>当前门店的配送模式为平台配送,如需修改该项设置,请联系平台管理员<?php  } ?></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">配送区域</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input type="text" class="form-control" name="delivery_area" value="<?php  echo $item['delivery_area'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">在配送半径之外是否允许下单</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="not_in_serve_radius" value="1" id="not-in-serve-radius-1" <?php  if($item['not_in_serve_radius'] == 1) { ?>checked<?php  } ?> <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
							<label for="not-in-serve-radius-1">允许</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="not_in_serve_radius" value="0" id="not-in-serve-radius-0" <?php  if(!$item['not_in_serve_radius']) { ?>checked<?php  } ?> <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
							<label for="not-in-serve-radius-0">不允许</label>
						</div>
						<div class="help-block">
							<span class="text-danger"><?php  if($item['delivery_mode'] == 2) { ?>当前门店的配送模式为平台配送,如需修改该项设置,请联系平台管理员<?php  } ?></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">收货地址是否自动获取</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="auto_get_address" value="1" id="auto-get-address-1" <?php  if($item['auto_get_address'] == 1) { ?>checked<?php  } ?> <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
							<label for="auto-get-address-1">是, 高德地图自动获取</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="auto_get_address" value="0" id="auto-get-address-0" <?php  if(!$item['auto_get_address']) { ?>checked<?php  } ?> <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
							<label for="auto-get-address-0">否, 用户自己填写</label>
						</div>
						<span class="help-block">设置为用户自己填写后, 将不能获取用户的具体位置, 不能实现超出服务范围禁制下单的功能</span>
						<div class="help-block">
							<span class="text-danger"><?php  if($item['delivery_mode'] == 2) { ?>当前门店的配送模式为平台配送,如需修改该项设置,请联系平台管理员<?php  } ?></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>配送费</label>
					<div class="col-sm-9 col-xs-12">
						<div class="radio radio-inline">
							<input type="radio" name="delivery_fee_mode" value="1" id="delivery-fee-mode-1" <?php  if($item['delivery_fee_mode'] == 1 || !$item['delivery_fee_mode']) { ?>checked<?php  } ?> <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?> onclick="$('.delivery-fee-mode').hide();$('.delivery-fee-mode-1').show();">
							<label for="delivery-fee-mode-1">固定金额</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="delivery_fee_mode" value="2" id="delivery-fee-mode-2" <?php  if($item['delivery_fee_mode'] == 2) { ?>checked<?php  } ?> <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?> onclick="$('.delivery-fee-mode').hide();$('.delivery-fee-mode-2').show();">
							<label for="delivery-fee-mode-2">按距离收取</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="delivery_fee_mode" id="delivery-fee-mode-3" value="3" <?php  if($store['delivery_fee_mode'] == 3) { ?>checked<?php  } ?> <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?> onclick="$('.delivery-fee-mode').hide();$('.delivery-fee-mode-3').show();">
							<label for="delivery-fee-mode-3">按区域收取</label>
						</div>
					</div>
				</div>
				<div class="form-group delivery-fee-mode delivery-fee-mode-1" <?php  if($item['delivery_fee_mode'] == 1 || !$item['delivery_fee_mode']) { ?>style="display: block"<?php  } ?>>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<div class="input-group-addon">起送价</div>
							<input type="number" name="send_price_1" value="<?php  echo $store['send_price'];?>" class="form-control" <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>/>
							<div class="input-group-addon">元</div>
							<div class="input-group-addon">满</div>
							<input type="number" name="delivery_free_price_1" value="<?php  echo $store['delivery_free_price'];?>" class="form-control" <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>/>
							<div class="input-group-addon">元免配送费</div>
						</div>
						<br>
						<div class="input-group">
							<div class="input-group-addon">每单</div>
							<input type="text" name="delivery_price" value="<?php  echo $item['delivery_price'];?>" class="form-control" <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>/>
							<div class="input-group-addon">元</div>
						</div>
					</div>
				</div>
				<div class="form-group delivery-fee-mode delivery-fee-mode-2" <?php  if($item['delivery_fee_mode'] == 2) { ?>style="display: block"<?php  } ?>>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<div class="input-group-addon">起送价</div>
							<input type="number" name="send_price_2" value="<?php  echo $store['send_price'];?>" class="form-control" <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>/>
							<div class="input-group-addon">元</div>
							<div class="input-group-addon">满</div>
							<input type="number" name="delivery_free_price_2" value="<?php  echo $store['delivery_free_price'];?>" class="form-control" <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>/>
							<div class="input-group-addon">元免配送费</div>
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon">起步价</span>
							<input type="text" class="form-control" name="start_fee" value="<?php  echo $item['delivery_price_extra']['start_fee'];?>" <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
							<span class="input-group-addon">元包含</span>
							<input type="text" class="form-control" name="start_km" value="<?php  echo $item['delivery_price_extra']['start_km'];?>" <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
							<span class="input-group-addon">公里</span>
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon">每增加1公里加</span>
							<input type="text" class="form-control" name="pre_km_fee" value="<?php  echo $item['delivery_price_extra']['pre_km_fee'];?>" <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
							<span class="input-group-addon">元</span>
							<span class="input-group-addon">最高收取</span>
							<input type="text" class="form-control" name="max_fee" value="<?php  echo $item['delivery_price_extra']['max_fee'];?>" <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
							<span class="input-group-addon">元</span>
						</div>
						<div class="help-block">
							<strong class="text-danger">
								特别注意: 设置按照"按距离收取"配送费后,系统会自动变更使用"平台配送"模式商家的某些配置。包括:收货地址被设置为自动获取, 超过配送范围是仍可下单
							</strong>
							<br/>
							最高收取:根据距离计算所得配送费超过此设置，配送费将收取此项设置的金额，设置为0，表示不限制。
						</div>
						<div class="input-group" style="width: 80%;">
							<label class="col-xs-12 col-sm-2 col-md-2 control-label">路径计算方式</label>
							<div class="col-sm-9 col-xs-12">
								<div class="radio radio-inline">
									<input type="radio" name="distance_type" value="0" id="distance_type-0" <?php  if($item['delivery_price_extra']['distance_type'] == 0) { ?>checked<?php  } ?> <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
									<label for="distance_type-0">直线距离</label>
								</div>
								<div class="radio radio-inline">
									<input type="radio" name="distance_type" value="2" id="distance_type-2" <?php  if($item['delivery_price_extra']['distance_type'] == 2) { ?>checked<?php  } ?> <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
									<label for="distance_type-2">骑行规划距离</label>
								</div>
								<div class="radio radio-inline">
									<input type="radio" name="distance_type" value="1" id="distance_type-1" <?php  if($item['delivery_price_extra']['distance_type'] == 1) { ?>checked<?php  } ?> <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
									<label for="distance_type-1">驾车导航距离</label>
								</div>
								<div class="radio radio-inline">
									<input type="radio" name="distance_type" value="3" id="distance_type-3" <?php  if($item['delivery_price_extra']['distance_type'] == 3) { ?>checked<?php  } ?> <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
									<label for="distance_type-3">步行距离</label>
								</div>
								<div class="help-block">提示：设置为按步行距离计算，如果距离超过5千米，系统会自动按骑行距离计算；设置的按骑行距离计算，如果距离过长，系统会自动按驾车距离计算。</div>
							</div>
						</div>
						<div class="input-group" style="width: 80%;">
							<label class="col-xs-12 col-sm-2 col-md-2 control-label">配送距离取整</label>
							<div class="col-sm-9 col-xs-12">
								<div class="radio radio-inline">
									<input type="radio" name="calculate_distance_type" id="calculate_distance_type-0" value="0" <?php  if($item['delivery_price_extra']['calculate_distance_type'] == 0 || !$item['delivery_price_extra']['calculate_distance_type']) { ?>checked<?php  } ?> <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
									<label for="calculate_distance_type-0">默认</label>
								</div>
								<div class="radio radio-inline">
									<input type="radio" name="calculate_distance_type" id="calculate_distance_type-1" value="1" <?php  if($item['delivery_price_extra']['calculate_distance_type'] == 1) { ?>checked<?php  } ?> <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
									<label for="calculate_distance_type-1">向上取整</label>
								</div>
								<div class="radio radio-inline">
									<input type="radio" name="calculate_distance_type" id="calculate_distance_type-2" value="2" <?php  if($item['delivery_price_extra']['calculate_distance_type'] == 2) { ?>checked<?php  } ?> <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
									<label for="calculate_distance_type-2">向下取整</label>
								</div>
								<div class="help-block">例:配送距离为3.5公里,向上取整为4公里,向下取整为3公里,默认为不变</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group delivery-fee-mode delivery-fee-mode-3" <?php  if($store['delivery_fee_mode'] == 3) { ?>style="display: block"<?php  } ?>>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<?php  include itemplate('store/shop/geofence', TEMPLATE_INCLUDEPATH);?>
					</div>
				</div>
				<?php  if($item['delivery_mode'] == 1) { ?>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>配送时间段</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<span class="input-group-addon">间隔</span>
								<input type="text" class="form-control" name="pre_delivery_time_minute" value="">
								<span class="input-group-addon">分钟</span>
								<div class="input-group-btn btn-build-delivery-time">
									<a href="javascript:;" class="btn btn-primary" >生成配送时间段</a>
								</div>
							</div>
						</div>
					</div>
				<?php  } ?>
				<div id="delivery-times" class="delivery-times">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
						<div class="col-sm-9 col-xs-12 containter">
							<?php  if(is_array($item['delivery_times'])) { foreach($item['delivery_times'] as $time) { ?>
							<div class="col-sm-6">
								<div class="input-group">
									<span class="input-group-addon"><?php  echo $time['start'];?> ~ <?php  echo $time['end'];?></span>
									<span class="input-group-addon">附加费</span>
									<input type="text" class="form-control" name="times[fee][]" value="<?php  echo $time['fee'];?>" placeholder="增加附加费" <?php  if($item['delivery_mode'] == 2) { ?>disabled<?php  } ?>>
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
			</div>
			<div class="tab-pane <?php  if($_GPC['type'] == 'page') { ?>active<?php  } ?>" role="tabpanel" id="page">
				<h3>页面设置</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">公告</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input type="text" name="shopnotice" value="<?php  echo $item['notice'];?>" class="form-control">
						<div class="help-block">手机端将以滚动的方式展示</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">进入商品列表页提示</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input type="text" name="tips" value="<?php  echo $item['tips'];?>" class="form-control">
						<div class="help-block">用户进入页面后, 将弹框提示设置的内容</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>自定义订单备注</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<?php  if(!empty($item['order_note'])) { ?>
							<?php  if(is_array($item['order_note'])) { foreach($item['order_note'] as $order_note) { ?>
								<div class="btn-group btn-label">
									<input type="hidden" name="order_note[]" value="<?php  echo $order_note;?>">
									<a class="btn btn-default border-radius-4"><?php  echo $order_note;?></a>
									<a class="btn btn-default label-delete">
										<span class="fa fa-times-circle"></span>
									</a>
								</div>
							<?php  } } ?>
						<?php  } ?>
						<a class="btn btn-success label-add"><i class="fa fa-plus-circle"></i> 添加</a>
						<div class="help-block">例如: 带点醋, 不吃辣, 自带零钱, 延时送餐等</div>
					</div>
				</div>
				<?php  if($store['self_audit_comment'] == 1) { ?>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>是否需要审核评论</label>
						<div class="col-sm-9 col-xs-12">
							<div class="radio radio-inline">
								<input type="radio" value="1" name="comment_status" id="comment-status-1" <?php  if($item['comment_status'] == 1) { ?>checked<?php  } ?>>
								<label for="comment-status-1">不需要审核</label>
							</div>
							<div class="radio radio-inline">
								<input type="radio" value="0" name="comment_status" id="comment-status-0" <?php  if($item['comment_status'] == 0) { ?>checked<?php  } ?>>
								<label for="comment-status-0">需要审核</label>
							</div>
							<span class="help-block">设置为"需要审核",用户评论后,需要管理员审核后才能显示到前台</span>
						</div>
					</div>
				<?php  } ?>
				<div id="custom-url">
					<?php  if(!empty($item['custom_url'])) { ?>
						<?php  if(is_array($item['custom_url'])) { foreach($item['custom_url'] as $url) { ?>
							<div class="form-group item">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">门店详情页自定义链接</label>
								<div class="col-sm-6">
									<div class="input-group">
										<span class="input-group-addon">链接文字</span>
										<input type="text" class="form-control" name="custom_title[]" value="<?php  echo $url['title'];?>">
										<span class="input-group-addon">链接地址</span>
										<input type="text" class="form-control" name="custom_link[]" value="<?php  echo $url['url'];?>">
										<span class="input-group-addon">小程序跳转链接</span>
										<input type="text" class="form-control" name="custom_wxapplink[]" value="<?php  echo $url['wxapp_link'];?>">
										<span class="input-group-addon btn-wxapp-links">选择小程序跳转连接</span>
									</div>
								</div>
								<div class="col-sm-1" style="margin-top:5px">
									<a href="javascript:;" class="custom-url-del"><i class="fa fa-times-circle"></i> </a>
								</div>
							</div>
						<?php  } } ?>
					<?php  } else { ?>
						<div class="form-group item">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">门店详情页自定义链接</label>
							<div class="col-sm-6">
								<div class="input-group">
									<span class="input-group-addon">链接文字</span>
									<input type="text" class="form-control" name="custom_title[]" value="">
									<span class="input-group-addon">链接地址</span>
									<input type="text" class="form-control" name="custom_link[]" value="">
									<span class="input-group-addon">小程序跳转链接</span>
									<input type="text" class="form-control" name="custom_wxapplink[]" value="">
									<span class="input-group-addon btn-wxapp-links">选择小程序跳转连接</span>
								</div>
							</div>
							<div class="col-sm-1" style="margin-top:5px">
								<a href="javascript:;" class="custom-url-del"><i class="fa fa-times-circle"></i> </a>
							</div>
						</div>
					<?php  } ?>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<a href="javascript:;" id="custom-url-add"><i class="fa fa-plus-circle"></i> 添加门店详情页自定义链接</a>
						<span class="help-block">该链接将在门店详情页面显示</span>
					</div>
				</div>
			</div>
			<div class="tab-pane <?php  if($_GPC['type'] == 'high') { ?>active<?php  } ?>" role="tabpanel" id="high">
				<h3>高级设置</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">自动接单方式</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="auto_handel_order" id="auto-handel-order-1" value="1" <?php  if($item['auto_handel_order'] == 1) { ?>checked<?php  } ?>>
							<label for="auto-handel-order-1">支付后自动接单</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="auto_handel_order" id="auto-handel-order-0" value="0" <?php  if(!$item['auto_handel_order']) { ?>checked<?php  } ?>>
							<label for="auto-handel-order-0">不自动接单</label>
						</div>
						<!--<div class="radio radio-inline">-->
							<!--<input type="radio" name="auto_handel_order" id="auto-handel-order-2" value="2" <?php  if($item['auto_handel_order'] == 2) { ?>checked<?php  } ?>>-->
							<!--<label for="auto-handel-order-2">打印机出单后自动接单(注:仅飞鹅打印机和喜讯打印机支持,其他打印机不支持)</label>-->
						<!--</div>-->
						<span class="help-block">开启自动接单后, 用户下单支付后,系统会根据自动接单设置将订单设置为处理中</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">接单后自动通知配送员配送</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="auto_notice_deliveryer" id="auto-notice-deliveryer-1" value="1" <?php  if($item['auto_notice_deliveryer'] == 1) { ?>checked<?php  } ?>>
							<label for="auto-notice-deliveryer-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="auto_notice_deliveryer" id="auto-notice-deliveryer-0" value="0" <?php  if(!$item['auto_notice_deliveryer']) { ?>checked<?php  } ?>>
							<label for="auto-notice-deliveryer-0">关闭</label>
						</div>
						<span class="help-block">开启后, 店员接单后,系统会自动通知配送员进行配送(设置订单为待配送.仅对外卖订单有效).</span>
						<span class="help-block"><span class="bg-danger">注意：设置支付后自动接单, 也会自动通知配送员抢单</span></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">支持开发票</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="invoice_status" id="invoice-status-1" value="1" <?php  if($item['invoice_status'] == 1) { ?>checked<?php  } ?>>
							<label for="invoice-status-1">支持</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="invoice_status" id="invoice-status-0" value="0" <?php  if(!$item['invoice_status']) { ?>checked<?php  } ?>>
							<label for="invoice-status-0">不支持</label>
						</div>
						<span class="help-block">选择支持开发票后,用户在提交订单时可选择是否开发票</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">支持使用代金券抵付现金</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="token_status" id="token-status-1" value="1" <?php  if($item['token_status'] == 1) { ?>checked<?php  } ?>>
							<label for="token-status-1">支持</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="token_status" id="token-status-0" value="0" <?php  if(!$item['token_status']) { ?>checked<?php  } ?>>
							<label for="token-status-0">不支持</label>
						</div>
						<span class="help-block">选择支持使用代金券抵付现金,用户在满足代金券使用条件时(必须是在线支付才能使用代金券),可选择是否使用代金券</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">支付方式</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<?php  if(in_array('wechat', $pay)) { ?>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="payment[]" id="payment-wechat" value="wechat" <?php  if(in_array('wechat', $item['payment'])) { ?>checked<?php  } ?>>
								<label for="payment-wechat">微信支付</label>
							</div>
						<?php  } ?>
						<?php  if(in_array('yimafu', $pay)) { ?>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="payment[]" id="payment-yimafu" value="yimafu" <?php  if(in_array('yimafu', $item['payment'])) { ?>checked<?php  } ?>>
								<label for="payment-yimafu">一码付</label>
							</div>
						<?php  } ?>
						<?php  if(in_array('alipay', $pay)) { ?>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="payment[]" id="payment-alipay" value="alipay" <?php  if(in_array('alipay', $item['payment'])) { ?>checked<?php  } ?>>
								<label for="payment-alipay">支付宝</label>
							</div>
						<?php  } ?>
						<?php  if(in_array('credit', $pay)) { ?>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="payment[]" id="payment-credit" value="credit" <?php  if(in_array('credit', $item['payment'])) { ?>checked<?php  } ?>>
								<label for="payment-credit">余额支付</label>
							</div>
						<?php  } ?>
						<?php  if(in_array('delivery', $pay)) { ?>
							<div class="checkbox checkbox-inline">
								<input type="checkbox" name="payment[]" id="payment-delivery" value="delivery" <?php  if(in_array('delivery', $item['payment'])) { ?>checked<?php  } ?>>
								<label for="payment-delivery">货到付款</label>
							</div>
						<?php  } ?>
						<?php  if($store['is_meal'] == 1) { ?>
							<?php  if(in_array('finishMeal', $pay)) { ?>
								<div class="checkbox checkbox-inline">
									<input type="checkbox" name="payment[]" id="payment-finishMeal" value="finishMeal" <?php  if(in_array('finishMeal', $item['payment'])) { ?>checked<?php  } ?>>
									<label for="payment-finishMeal">餐后付款</label>
								</div>
							<?php  } ?>
						<?php  } ?>
						<span class="help-block">商户可根据自己的情况选择支付方式.更多支付方式请联系公众号管理员开通</span>
					</div>
				</div>
			</div>
			<div class="tab-pane <?php  if($_GPC['type'] == 'remind') { ?>active<?php  } ?>" role="tabpanel" id="remind">
				<h3>催单回复</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>可催单开始时间</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="input-group">
							<input type="text" class="form-control" name="remind_time_start" value="<?php  echo $item['remind_time_start'];?>">
							<span class="input-group-addon">分钟</span>
						</div>
						<span class="help-block">用户在下单后多少分钟可以开始催单，如设置3分钟，那么用户下单后3分钟之后才可以进行催单操作。不填写为不限制。</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>催单时间间隔</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="input-group">
							<input type="text" class="form-control" name="remind_time_limit" value="<?php  echo $item['remind_time_limit'];?>">
							<span class="input-group-addon">分钟</span>
						</div>
						<span class="help-block">用户在下单后可进行多次催单,该项可设置催单间隔.如:用户现在进行催单,如果设置了10分钟的间隔,那么用户下次催单只能在10分钟以后</span>
					</div>
				</div>
				<div id="remind-reply">
					<?php  if(!empty($item['remind_reply'])) { ?>
						<?php  if(is_array($item['remind_reply'])) { foreach($item['remind_reply'] as $reply) { ?>
						<div class="form-group item">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">自定义催单回复</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="remind_reply[]" value="<?php  echo $reply;?>">
							</div>
							<div class="col-sm-1" style="margin-top:5px">
								<a href="javascript:;" class="remind-reply-del"><i class="fa fa-times-circle"></i> </a>
							</div>
						</div>
						<?php  } } ?>
					<?php  } else { ?>
						<div class="form-group item">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">自定义催单回复</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="remind_reply[]" value="<?php  echo $reply;?>">
							</div>
							<div class="col-sm-1" style="margin-top:5px">
								<a href="javascript:;" class="remind-reply-del"><i class="fa fa-times-circle"></i> </a>
							</div>
						</div>
					<?php  } ?>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<a href="javascript:;" class="remind-reply-add"><i class="fa fa-plus-circle"></i> 添加自定义催单回复</a>
					</div>
				</div>
			</div>
			<div class="tab-pane <?php  if($_GPC['type'] == 'comment') { ?>active<?php  } ?>" role="tabpanel" id="comment">
				<h3>评价回复</h3>
				<div id="comment-reply">
					<?php  if(!empty($item['comment_reply'])) { ?>
						<?php  if(is_array($item['comment_reply'])) { foreach($item['comment_reply'] as $creply) { ?>
						<div class="form-group item">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">自定义评价回复</label>
							<div class="col-sm-6">
								<textarea class="form-control" name="comment_reply[]"><?php  echo $creply;?></textarea>
							</div>
							<div class="col-sm-1" style="margin-top:5px">
								<a href="javascript:;" class="comment-reply-del"><i class="fa fa-times-circle"></i> </a>
							</div>
						</div>
						<?php  } } ?>
					<?php  } else { ?>
						<div class="form-group item">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">自定义评价回复</label>
							<div class="col-sm-6">
								<textarea class="form-control" name="comment_reply[]"></textarea>
							</div>
							<div class="col-sm-1" style="margin-top:5px">
								<a href="javascript:;" class="comment-reply-del"><i class="fa fa-times-circle"></i> </a>
							</div>
						</div>
					<?php  } ?>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<a href="javascript:;" class="comment-reply-add"><i class="fa fa-plus-circle"></i> 添加自定义评价回复</a>
					</div>
				</div>
			</div>
			<div class="tab-pane <?php  if($_GPC['type'] == 'template') { ?>active<?php  } ?>" role="tabpanel" id="template">
				<h3>模板配置</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">商品列表页风格</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<a href="<?php  echo iurl('store/shop/setting/template', array('id' => $item['id'], 't' => 'index'));?>" data-confirm="确定更换模块类型吗" class="js-post thumbnail <?php  if($item['template'] == 'index' || !$item['template']) { ?>active<?php  } ?>" style="width:200px; float:left; margin-right:20px; border-width: 5px">
							<img src="<?php echo WE7_WMALL_URL;?>static/img/purview/wechat-store-index.png">
						</a>
						<a href="<?php  echo iurl('store/shop/setting/template', array('id' => $item['id'], 't' => 'market'));?>" data-confirm="确定更换模块类型吗" class="js-post thumbnail <?php  if($item['template'] == 'market') { ?>active<?php  } ?>" style="width:200px; float:left; margin-right:20px; border-width: 5px">
							<img src="<?php echo WE7_WMALL_URL;?>static/img/purview/wechat-store-market.png">
						</a>
						<a href="<?php  echo iurl('store/shop/setting/template', array('id' => $item['id'], 't' => 'index1'));?>" data-confirm="确定更换模块类型吗" class="js-post thumbnail <?php  if($item['template'] == 'index1') { ?>active<?php  } ?>" style="width:200px; float:left; margin-right:20px; border-width: 5px">
							<img src="<?php echo WE7_WMALL_URL;?>static/img/purview/wechat-store-index1.png">
						</a>
					</div>
				</div>
			</div>
			<div class="tab-pane <?php  if($_GPC['type'] == 'eleme') { ?>active<?php  } ?>" role="tabpanel" id="eleme">
				<h3>饿了么对接</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>饿了么门店ID</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="elemeShopId" value="<?php  echo $item['elemeShopId'];?>">
						<div class="help-block">打开饿了么商家版，找到您的饿了么店铺号</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否接收饿了么订单推送</label>
					<div class="col-sm-9 col-xs-12">
						<div class="radio radio-inline">
							<input type="radio" name="eleme[accept_order]" id="accept_order-1" value="1" <?php  if($config_eleme['order']['accept_order'] == 1) { ?>checked<?php  } ?>>
							<label for="accept_order-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="eleme[accept_order]" id="accept_order-0" value="0" <?php  if(!$config_eleme['order']['accept_order']) { ?>checked<?php  } ?>>
							<label for="accept_order-0">关闭</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">饿了么订单自动接单</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="eleme[auto_handel_order]" id="eleme-auto-handel-order-1" value="1" <?php  if($config_eleme['order']['auto_handel_order'] == 1) { ?>checked<?php  } ?>>
							<label for="eleme-auto-handel-order-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="eleme[auto_handel_order]" id="eleme-auto-handel-order-0" value="0" <?php  if(!$config_eleme['order']['auto_handel_order']) { ?>checked<?php  } ?>>
							<label for="eleme-auto-handel-order-0">关闭</label>
						</div>
						<span class="help-block">开启后, 系统接单到饿了么订单后,系统会自动接单。<span class="text-danger">此项仅适用没有在饿了么管理后台设置自动接单。如果在饿了么管理后台设置了自动接单,请设置本系统不自动接单,否则会造成接单错误</span></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">接单后自动通知配送员配送</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="eleme[auto_notice_deliveryer]" id="eleme-auto-notice-deliveryer-1" value="1" <?php  if($config_eleme['order']['auto_notice_deliveryer'] == 1) { ?>checked<?php  } ?>>
							<label for="eleme-auto-notice-deliveryer-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="eleme[auto_notice_deliveryer]" id="eleme-auto-notice-deliveryer-0" value="0" <?php  if(!$config_eleme['order']['auto_notice_deliveryer']) { ?>checked<?php  } ?>>
							<label for="eleme-auto-notice-deliveryer-0">关闭</label>
						</div>
						<span class="help-block">开启后, 店员接单后,系统会自动通知配送员进行配送<span class="text-danger">此项仅适用您的饿了么店铺是自己配送,并且你想用本平台的配送员就行配送</span></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">饿了么订单自动打印</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="eleme[auto_print]" id="eleme-auto-print-1" value="1" <?php  if($config_eleme['order']['auto_print'] == 1) { ?>checked<?php  } ?>>
							<label for="eleme-auto-print-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="eleme[auto_print]" id="eleme-auto-print-0" value="0" <?php  if(!$config_eleme['order']['auto_print']) { ?>checked<?php  } ?>>
							<label for="eleme-auto-print-0">关闭</label>
						</div>
					</div>
				</div>
				<h3>授权信息</h3>
				<div class="alert alert-warning">
					请点击下方链接地址或者用手机扫描二维码进行授权
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">授权URL</label>
					<div class="col-sm-9 col-xs-12">
						<a href="<?php  echo imurl('eleme/oauth', array('state' => $item['id']), true);?>">
							<?php  echo imurl('eleme/oauth', array('state' => $item['id']), true);?>
						</a>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">授权二维码</label>
					<div class="col-sm-9 col-xs-12">
						<div class="qrcode-block js-qrcode" data-text="<?php  echo imurl('eleme/oauth', array('state' => $item['id']), true);?>"></div>
					</div>
				</div>
			</div>
			<div class="tab-pane <?php  if($_GPC['type'] == 'meituan') { ?>active<?php  } ?>" role="tabpanel" id="meituan">
				<h3>美团对接</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否接收美团订单推送</label>
					<div class="col-sm-9 col-xs-12">
						<div class="radio radio-inline">
							<input type="radio" name="meituan[accept_order]" id="meituan-accept_order-1" value="1" <?php  if($config_meituan['order']['accept_order'] == 1) { ?>checked<?php  } ?>>
							<label for="meituan-accept_order-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="meituan[accept_order]" id="meituan-accept_order-0" value="0" <?php  if(!$config_meituan['order']['accept_order']) { ?>checked<?php  } ?>>
							<label for="meituan-accept_order-0">关闭</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">美团订单自动接单</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="meituan[auto_handel_order]" id="meituan-auto-handel-order-1" value="1" <?php  if($config_meituan['order']['auto_handel_order'] == 1) { ?>checked<?php  } ?>>
							<label for="meituan-auto-handel-order-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="meituan[auto_handel_order]" id="meituan-auto-handel-order-0" value="0" <?php  if(!$config_meituan['order']['auto_handel_order']) { ?>checked<?php  } ?>>
							<label for="meituan-auto-handel-order-0">关闭</label>
						</div>
						<span class="help-block">开启后, 系统接单到美团订单后,系统会自动接单。<span class="text-danger">此项仅适用没有在美团管理后台设置自动接单。如果在美团管理后台设置了自动接单,请设置本系统不自动接单,否则会造成接单错误</span></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">接单后自动通知配送员配送</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="meituan[auto_notice_deliveryer]" id="meituan-auto-notice-deliveryer-1" value="1" <?php  if($config_meituan['order']['auto_notice_deliveryer'] == 1) { ?>checked<?php  } ?>>
							<label for="meituan-auto-notice-deliveryer-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="meituan[auto_notice_deliveryer]" id="meituan-auto-notice-deliveryer-0" value="0" <?php  if(!$config_meituan['order']['auto_notice_deliveryer']) { ?>checked<?php  } ?>>
							<label for="meituan-auto-notice-deliveryer-0">关闭</label>
						</div>
						<span class="help-block">开启后, 店员接单后,系统会自动通知配送员进行配送<span class="text-danger">此项仅适用您的美团店铺是自己配送,并且你想用本平台的配送员就行配送</span></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">美团订单自动打印</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="meituan[auto_print]" id="meituan-auto-print-1" value="1" <?php  if($config_meituan['order']['auto_print'] == 1) { ?>checked<?php  } ?>>
							<label for="meituan-auto-print-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="meituan[auto_print]" id="meituan-auto-print-0" value="0" <?php  if(!$config_meituan['order']['auto_print']) { ?>checked<?php  } ?>>
							<label for="meituan-auto-print-0">关闭</label>
						</div>
					</div>
				</div>
				<h3>授权信息</h3>
				<div class="alert alert-warning">
					<?php  if(empty($config_meituan['basic']['status'])) { ?>
						<span class="text-danger">您当前没有进行美团绑定</span>,如需绑定,请点击下方授权URL进行授权
					<?php  } else { ?>
						您已进行美团绑定,如需解绑,请点击下方解绑URL进行解绑
					<?php  } ?>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">授权URL</label>
					<div class="col-sm-9 col-xs-12">
						<a href="<?php  echo imurl('meituan/oauth/storemap', array('state' => $item['id']), true);?>">
							<?php  echo imurl('meituan/oauth/storemap', array('state' => $item['id']), true);?>
						</a>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">解绑URL</label>
					<div class="col-sm-9 col-xs-12">
						<a href="<?php  echo imurl('meituan/oauth/releasebinding', array('state' => $item['id']), true);?>">
							<?php  echo imurl('meituan/oauth/releasebinding', array('state' => $item['id']), true);?>
						</a>
					</div>
				</div>
			</div>
			<div class="tab-pane <?php  if($_GPC['type'] == 'dada') { ?>active<?php  } ?>" role="tabpanel" id="dada">
				<h3>达达对接</h3>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">达达第三方配送</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="radio radio-inline">
							<input type="radio" name="dada[status]" id="dada-status-1" value="1" <?php  if($config_dada['status'] == 1) { ?>checked<?php  } ?>>
							<label for="dada-status-1">开启</label>
						</div>
						<div class="radio radio-inline">
							<input type="radio" name="dada[status]" id="dada-status-0" value="0" <?php  if(!$config_dada['status']) { ?>checked<?php  } ?>>
							<label for="dada-status-0">关闭</label>
						</div>
						<span class="help-block">开启后可以使用达达配送,此功能开启需要向达达申请，获得门店编号</span>
					</div>
				</div>
				<div class="form-group item">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">门店编号</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="dada[shopno]" value="<?php  echo $config_dada['shopno'];?>">
					</div>
				</div>
				<div class="form-group item">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">城市编码</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="dada[citycode]" value="<?php  echo $config_dada['citycode'];?>">
						<div class="help-block">城市编码对应各城市电话区号，如北京，城市编码为010。</div>
					</div>
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
<script type="text/javascript">
require(['clockpicker'], function($){
	$('.clockpicker :text').clockpicker({autoclose: true});

	$('#selectImage').click(function(){
		util.uploadMultiPictures(function(images){
			var s = '';
			$.each(images, function(){
				s += '<div class="col-lg-4">'+
						'	<input type="hidden" name="thumbs[image][]" value="'+this.filename+'">' +
						'	<div class="panel panel-default panel-slide">'+
						'		<div class="btnClose" onclick="$(this).parent().parent().remove()"><i class="fa fa-times"></i></div>' +
						'		<div class="panel-body">'+
						'			<img src="'+this.url+'" width="100%" height="170">'+
						'			<div>'+
						'				<input class="form-control last pull-right" placeholder="跳转链接" name="thumbs[url][]">'+
						'			</div>'+
						'		</div>'+
						'	</div>'+
						'</div>'
			});
			$('#slideContainer').append(s);
		});
	});

	$('#hour-add').click(function(){
		var hour_length = $('#hour .hour-item').length;
		if(hour_length < 3) {
			var html = '<div class="form-group hour-item clockpicker">' +
					'<label class="col-xs-12 col-sm-3 col-md-2 control-label">营业时间</label>'+
					'<div class="col-sm-9 col-xs-4 col-md-3">'+
					'<div class="input-group">'+
					'<input type="text" readonly name="business_start_hours[]" class="form-control" placeholder=""> '+
					'<span class="input-group-addon">至</span>'+
					'<input type="text" readonly name="business_end_hours[]" class="form-control" placeholder=""> '+
					'</div>'+
					'</div>'+
					'<div class="col-sm-9 col-xs-4 col-md-3" style="padding-top:6px">'+
					'<a href="javascript:;" onclick="$(this).parent().parent().remove()"><i class="fa fa-times-circle" title="删除时间段"> </i></a>'+
					'</div>'+
					'</div>';
			$('#hour').append(html);
			$('.clockpicker :text').clockpicker({autoclose: true});
		} else {
			util.message('最多可添加3个时间段', '', 'error');
			return false;
		}
	});

	$('.remind-reply-add').click(function(){
		var html ='	<div class="form-group item">'+
				'	<label class="col-xs-12 col-sm-3 col-md-2 control-label">自定义催单回复</label>'+
				'	<div class="col-sm-6">'+
				'		<input type="text" class="form-control" name="remind_reply[]" value="">'+
				'	</div>'+
				'	<div class="col-sm-1" style="margin-top:5px">'+
				'		<a href="javascript:;" class="remind-reply-del"><i class="fa fa-times-circle"></i> </a>'+
				'	</div>'+
				'</div>';
		if($('#remind-reply .item').size() >= 15) {
			util.message('最多可添加15个自定义催单回复', '', 'error');
			return false;
		}
		$('#remind-reply').append(html);
	});

	$('.comment-reply-add').click(function(){
		var html ='	<div class="form-group item">'+
				'	<label class="col-xs-12 col-sm-3 col-md-2 control-label">自定义评价回复</label>'+
				'	<div class="col-sm-6">'+
				'		<textarea class="form-control" name="comment_reply[]"></textarea>'+
				'	</div>'+
				'	<div class="col-sm-1" style="margin-top:5px">'+
				'		<a href="javascript:;" class="comment-reply-del"><i class="fa fa-times-circle"></i> </a>'+
				'	</div>'+
				'</div>';
		if($('#comment-reply .item').size() >= 15) {
			util.message('最多可添加15个自定义评价回复', '', 'error');
			return false;
		}
		$('#comment-reply').append(html);
	});

	$('#times-add').click(function(){
		var html ='	<div class="input-group clockpicker" style="margin-bottom: 15px">'+
				'		<input type="hidden" class="form-control" name="ids[]" value="">'+
				'		<input type="text" class="form-control" name="starttime[]" value="">'+
				'		<span class="input-group-addon">至</span>'+
				'	<input type="text" class="form-control" name="endtime[]" value="">'+
				'			<span class="input-group-addon"> <a href="javascript:;" class="times-del"><i class="fa fa-times"></i></a></span>'+
				'	</div>';
		$('#times-container').append(html);
		$('.clockpicker :text').clockpicker({autoclose: true});
	});

	$('#custom-url-add').click(function(){
		var html = '<div class="form-group item">'+
					'	<label class="col-xs-12 col-sm-3 col-md-2 control-label">门店详情页自定义链接</label>'+
					'		<div class="col-sm-6">'+
					'			<div class="input-group">'+
					'				<span class="input-group-addon">链接文字</span>'+
					'				<input type="text" class="form-control" name="custom_title[]" value="">'+
					'				<span class="input-group-addon">链接地址</span>'+
					'				<input type="text" class="form-control" name="custom_link[]" value="">'+
					'				<span class="input-group-addon">小程序跳转链接</span>'+
					'				<input type="text" class="form-control" name="custom_wxapplink[]" value="">'+
					'				<span class="input-group-addon btn-wxapp-links">选择小程序跳转连接</span>'+
					'			</div>'+
					'		</div>'+
					'	<div class="col-sm-1" style="margin-top:5px">'+
					'		<a href="javascript:;" class="custom-url-del"><i class="fa fa-times-circle"></i> </a>'+
					'	</div>'+
					'</div>';
				;
		if($('#custom-url .item').size() >= 3) {
			Notify.error('最多可添加3个门店详情页自定义链接');
			return false;
		}
		$('#custom-url').append(html);
	});

	$('#selectThumb').click(function(){
		util.uploadMultiPictures(function(images){
			var s = '';
			$.each(images, function(){
				s += '<div class="col-lg-4">'+
						'	<input type="hidden" name="thumbs[image][]" value="'+this.filename+'">' +
						'	<div class="panel panel-default panel-slide">'+
						'		<div class="btnClose" onclick="$(this).parent().parent().remove()"><i class="fa fa-times"></i></div>' +
						'		<div class="panel-body">'+
						'			<img src="'+this.url+'" width="100%" height="170">'+
						'			<div>'+
						'				<input class="form-control last pull-right" placeholder="跳转链接" name="thumbs[url][]">'+
						'			</div>'+
						'		</div>'+
						'	</div>'+
						'</div>'
			});
			$('#slideContainer').append(s);
		});
	});

	$(document).on('click', '.remind-reply-del, .comment-reply-del, .times-del, .custom-url-del', function(){
		$(this).parent().parent().remove();
		return false;
	});
});

irequire(['tiny', 'laytpl'], function(tiny, laytpl){
	$(document).on('click', '.label-add', function(){
		var $this = $(this);
		tiny.prompt($this, '', function(data) {
			if(!data) {
				return false;
			}
			var html = '<div class="btn-group btn-label">'+
					'		<input type="hidden" name="order_note[]" value="'+ data +'">'+
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

	<?php  if($item['delivery_mode'] == 1) { ?>
		$(document).on('click', '.btn-build-delivery-time', function(){
			tiny.confirm($(this), '确定重新生成配送时间段吗?', function(){
				var pre_minute = parseInt($.trim($(':text[name="pre_delivery_time_minute"]').val()));
				if(isNaN(pre_minute)) {
					util.message('时间间隔只能是整数');
					return false;
				}
				if(!pre_minute) {
					util.message('时间间隔必须大于0');
					return false;
				}
				$.post("<?php  echo iurl('common/utility/build_time');?>", {pre_minute: pre_minute}, function(data) {
					var result = $.parseJSON(data);
					if(result.message.errno == -1) {
						util.message(result.message.message);
						return false;
					}
					var gettpl = $('#tpl-delivery-time').html();
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
	<?php  } ?>

	$(document).on('click', '.btn-wxapp-links', function() {
		var ipt = $(this).prev();
		tiny.selectWxappLink(function(href){
			ipt.val(href);
		});
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>