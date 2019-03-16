<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<link href="../addons/we7_wmall/plugin/errander/static/css/mobile/index.css" rel="stylesheet" type="text/css"/>
<style>
.errander-submit .nav-button a{left:0;text-align: center;}
.errander-index .com-title-list{padding:0;border-bottom:1px solid #e7e7e7;}
.errander-index .com-title-list .com-title-item{flex:1;text-align: center;margin:0;border-right:1px solid #e7e7e7;}
.errander-index .com-title-list .com-title-item:last-child{border-right:none;}
.errander-index .com-title-list .com-title-item > div{padding:.5rem 0;}
.errander-index .com-title-list .com-title-item .active{border-bottom:2px solid #ff2d4b;}
</style>
<script type='text/javascript' src='<?php echo WE7_WMALL_URL;?>static/js/components/light7/iscroll-probe.js' charset='utf-8'></script>
<div class="page errander-index errander-submit">
	<header class="bar bar-nav common-bar-nav">
		<a class="pull-left back"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title"><?php  echo $title;?></h1>
		<a class="pull-right open-popup" data-popup=".popup-errander-rule" href="javascript:;">规则</a>
	</header>
	<nav class="bar bar-tab footer-bar border-1px-t nav-button">
		<!--<div class="fee-block">-->
			<!--<div>配送费 <span class="tip hide"> + 小费</span><span class="color-danger">¥ <span id="final-fee">0</span></span></div>-->
			<!--<div>费用<span class="color-danger">¥ <span id="final-fee">0</span></span></div>-->
			<!--<div class="color-gray">废品费用与回收员结算</div>-->
		<!--</div>-->
		<a href="javascript:;" id="order-submit">提交预约</a>
	</nav>
	<div class="content">


		<div class="com-title-list">
			<?php  if(is_array($category_list)) { foreach($category_list as $item) { ?>
			<div class="com-title-item" onclick="goCatyegoryOrder(<?php  echo $item['id'];?>)">
				<!-- <img src="/attachment/<?php  echo $item['thumb'];?>"> -->
				<div <?php  if($item['id'] == $_GPC['id']) { ?>class="active"<?php  } ?>><?php  echo $item['title'];?></div>
			</div>
			<?php  } } ?>
		</div>
		<div style="font-size:0;">
			<img src="/attachment/<?php  echo $category['price_thumb'];?>" style="width:100%;">
		</div>
		
		

		<input type="hidden" name="delivery_time" id="delivery-time" value="<?php  echo $predict_time;?>">
		<input type="hidden" name="delivery_day" id="delivery-day" value="<?php  echo $predict_day;?>">
		<div class="list-block">
			<ul class="border-1px-tb" style="display: none;">
				<li class="item-content">
					<div class="item-media"><i class="icon icon-buy-cart"></i></div>
					<div class="item-inner border-1px-b">
						<div class="item-input">
							<input type="text" name="goods_name" value="无" id="goods-title" placeholder="请输入需求">
						</div>
					</div>
				</li>
				<?php  if(!empty($category['label'])) { ?>
					<li class="goods-label border-1px-b">
						<?php  if(is_array($category['label'])) { foreach($category['label'] as $label) { ?>
						<span><?php  echo $label;?></span>
						<?php  } } ?>
					</li>
				<?php  } ?>
				<?php  if($category['weight_fee_status'] == 1) { ?>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title label">重量</div>
							<div class="item-input weight">
								<input type="text" name="goods_weight" value="<?php  if(!empty($errander_order['goods_weight'])) { ?><?php  echo $errander_order['goods_weight'];?><?php  } else { ?><?php  echo $category['weight_fee']['start_weight'];?><?php  } ?>" class="text-right" placeholder="请输入物品重量（kg）<?php  if(empty($category['weight_fee_status'])) { ?> （选填）<?php  } ?>" >
								<small>公斤</small>
							</div>
						</div>
					</li>
				<?php  } ?>
				<?php  if($caretory['goods_value_status'] == 1) { ?>
					<li class="item-content item-link">
						<div class="item-inner border-1px-t">
							<div class="item-title">物品价值</div>
							<div class="item-after">
								<?php  echo tpl_select('物品价值', 'goods_price', $errander_order['goods_price'], $price_select);?>
							</div>
						</div>
					</li>
					<li class="item-tips">
						贵重物品请您慎重，请将物品打包至可配送状态
					</li>
				<?php  } ?>
			</ul>
		</div>
		<div class="list-block">
			<ul>
				<!--<li class="item-content item-link border-1px-t">-->
					<!--<div class="item-media"><i class="icon icon-qu"></i></div>-->
					<!--<div class="item-inner open-popup" data-popup=".popup-select-start-address" id="start-address">-->
						<?php  if(!empty($start_address)) { ?>
							<!--<div class="item-title">-->
								<!--<div><?php  echo $start_address['address'];?></div>-->
								<!--<div class="fontsm"><span><?php  echo $start_address['realname'];?></span> <?php  echo $start_address['sex'];?> <span><?php  echo $start_address['mobile'];?></span></div>-->
							<!--</div>-->
						<?php  } else { ?>
							<!--<div class="item-title color-gray">请输入取货地址(必填)</div>-->
						<?php  } ?>
					<!--</div>-->
				<!--</li>-->
				<li class="item-content item-link border-1px-tb">
					<div class="item-media"><i class="icon icon-shou"></i></div>
					<div class="item-inner open-popup" data-popup=".popup-select-end-address" id="end-address">
						<?php  if(!empty($end_address)) { ?>
							<div class="item-title">
								<div><?php  echo $end_address['address'];?></div>
								<div class="fontsm"><span><?php  echo $end_address['realname'];?></span> <?php  echo $end_address['sex'];?> <span><?php  echo $end_address['mobile'];?></span></div>
							</div>
						<?php  } else { ?>
							<div class="item-title color-gray">请输入收取地址(必填)</div>
						<?php  } ?>
					</div>
				</li>
			</ul>
		</div>
		<div class="content-block-title">备注</div>
		<textarea name="note" class="note border-1px-tb"  placeholder="输入详细要求,可选填" rows="3"><?php  echo $errander_order['note'];?></textarea>
		<!-- <?php  if($category['goods_thumbs_status'] == 1) { ?>
		<div class="content-block-title" style="margin-top: .3rem">上传相关照片(有图最好，无图也行)</div>
		<?php  echo tpl_mutil_image('thumbs', $errander_order['thumbs'], 4);?>
		<?php  } ?> -->
		<div class="content-block-title" style="display: none;">选择支付方式</div>
		<div class="list-block media-list pay-method" style="display: none;">
			<ul>
				<?php  if(is_array($payment)) { foreach($payment as $row) { ?>
					<?php  $i++?>
					<li>
						<label class="label-checkbox item-content <?php  if($i == 1) { ?>border-1px-tb<?php  } else { ?>border-1px-b<?php  } ?>">
							<div class="item-inner">
								<div class="item-title"><?php  echo $pay_types[$row]['text'];?></div>
							</div>
							<input type="radio" name="pay_type" class="pay_type" value="<?php  echo $row;?>" <?php  if($row == 'credit') { ?>checked<?php  } ?>>
							<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
						</label>
					</li>
				<?php  } } ?>
			</ul>
		</div>
		<div class="list-block">
			<ul>
				<li class="item-content item-link border-1px-tb delivery-time" id="delivery-time-1">
					<div class="item-inner">
						<div class="item-title">收取时间</div>
						<div class="item-after"><span class="color-black delivery-time-show">立刻收取</span></div>
					</div>
				</li>
				<!--<li class="item-content no-bottom">-->
					<!--<div class="item-inner">-->
						<!--<div class="item-title delivery-fee-modal js-open-delivery-fee-modal" data-modal=".modal-delivery-fee">配送费 <i class="icon icon-question-circle"></i></div>-->
						<!--<div class="item-after"><span id="delivery-fee">0</span>元</div>-->
					<!--</div>-->
				<!--</li>-->
				<li class="distance border-1px-b">
					<div class="text-right gray hide">购买距离<span id="distance">0</span>千米</div>
				</li>
				<?php  if($groupid > 0) { ?>
				<li class="item-content no-bottom border-1px-b" id="discount-box">
					<div class="item-inner">
						<div class="item-title" ><?php  echo $member_group['title'];?>优惠</div>
						<div class="item-after"><span id="discount-fee">0</span>元</div>
					</div>
				</li>
				<?php  } ?>
				<li class="item-content no-bottom" style="display: none;">
					<div class="item-inner">
						<div class="item-title">小费 <small class=" color-danger"> &nbsp;&nbsp;加小费抢单更快哦</small></div>
						<div class="item-after"><span id="tip"><?php  if(!empty($errander_order['delivery_tips'])) { ?><?php  echo $errander_order['delivery_tips'];?><?php  } else { ?><?php  echo $category['tip_min'];?><?php  } ?></span> 元</div>
					</div>
				</li>
				<li class="tip-range border-1px-b" style="display: none;">
					<input type="hidden" class="single-slider" id="tip_fee" value="<?php  if(!empty($errander_order['delivery_tips'])) { ?><?php  echo $errander_order['delivery_tips'];?><?php  } else { ?><?php  echo $category['tip_min'];?><?php  } ?>" />
				</li>
				<li class="item-content anonymous border-1px-b">
					<div class="item-inner">
						<div class="item-title">匿名购买</div>
						<div class="item-after">
							<label class="label-switch invoice-status">
								<input type="checkbox" name="is_anonymous" value="1" <?php  if($errander_order['is_anonymous'] == 1) { ?>checked<?php  } ?>>
								<div class="checkbox"></div>
							</label>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="agreement">
			<label class="label-checkbox item-content" style="display: none;">
				<input type="checkbox" name="agree-rule" checked="checked">
				<div class="item-media"><i class="icon icon-form-checkbox"></i> 同意并接受<a href="javascript:;" class="open-popup" data-popup=".popup-errander-agreement">《随意购用户协议》</a></div>
			</label>
		</div>
	</div>
</div>
<script>

    function goCatyegoryOrder(id) {
        window.location.href = "<?php  echo imurl('errander/category');?>&id="+id;
    }

require([we7_wmall.pluginStaticRoot + 'order.js'], function(order){
	order.init({
		config: {
			map: {
				location_y: "<?php  echo $_config_plugin['map']['location_y'];?>",
				location_x: "<?php  echo $_config_plugin['map']['location_x'];?>"
			},
			serve_radius: "<?php  echo $_config_plugin['serve_radius'];?>"
		},
		category: {
			tip_min: "<?php  echo $category['tip_min'];?>",
			tip_max: "<?php  echo $category['tip_max'];?>"
		},
		errander_id: <?php  echo $id;?>,
		time_flag: <?php  echo $time_flag;?>,
		rule: <?php  echo json_encode($rule);?>,
		end_address: <?php  echo json_encode($end_address)?>,
		start_address: <?php  echo json_encode($start_address)?>,
	});
});
</script>
<?php  include itemplate('categoryCommon', TEMPLATE_INCLUDEPATH);?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>