<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<style type="text/css">
@media (min-width: 1024px) {
	.store-discount-notice{
		top:5.45rem !important;
	}
	.store .store-notice{
		top: 4.1rem !important;
	}
}
	.shop-cart-bar, .order-bar{
		background: #fff;
		color: #000;
	}
	.shop-cart-bar .bg-grey, .order-bar .bg-grey{
		background: #eee;
	}
	.shop-cart-bar .empty .cart{
		background: #aaa;
	}
	.shop-cart-bar .cart{
		border: .25rem solid #ddd;
	}
	.page header.bar {
	    background-color: rgba(255,255,255,0);
	}
	.page header.bar a,.page header.bar .title{
		color: #393d45;
	}
	.store-top{
		width: 100%;
		height: 170px;
		position: absolute;
		z-index: 9;
		background: url(../addons/we7_wmall/static/img/store_top.png) no-repeat;
		background-size: auto auto;
		background-size: cover;
	}
	.store_logo{
		position: absolute;
		width: 3rem;
		height: 3rem;
		margin:2rem 1.3rem;
		border-radius: 2rem;
	}
	.store .store-notice{
		top: 4.5rem;
		z-index: 10201;
		background: none;
		left: 4.7rem;
		color: #000;
	}
	.store .buttons-tab{
		top: 8.6rem;
		z-index: 10200;
	}
	.store-discount-notice{
		bottom:0;
		top:7.3rem;
		z-index: 10200;
	}
	.store .parent-category-wrapper,.store .content{
		top:10.6rem;
	}
	.title{
		top:1.8rem;
		left: 5.6rem;
		text-align: left;
	}
	.star-rank{
		margin: 3.5rem 5rem;
	}
	.star-rank-outline{
		width: 110px;
		height: 20px;
	}
	.shoucang{
		color: #7da6e8 !important;
	}
	.sale-badge{
        display: inline-block;
	    width: 1.4rem;
	    text-align: center;
	    color: #fff;
	    font-size: .5rem;
	    position: absolute;
	    left: 3rem;
	    top: 1rem;
	    background: linear-gradient(to bottom,#FF9F00,#ff2d4b) !important;
	    border-radius: 3px;
	}
</style>
<script type='text/javascript' src='<?php echo WE7_WMALL_URL;?>static/js/components/light7/iscroll-probe.js' charset='utf-8'></script>
<div class="page store shopcategory" id="page-app-goods">
	<nav class="bar bar-tab no-gutter shop-cart-bar">
		<div class="" id="cartEmpty">
			<div class="left empty">
				<span class="cart">
					<span class="icon icon-cart"></span>
				</span>
				购物车是空的
			</div>
			<div class="right text-center bg-grey"><?php  echo $store['send_price'];?>元起送</div>
		</div>
		<div class="hide" id="cartNotEmpty">
			<div class="left">
				<span class="cart">
					<span class="icon icon-cart"></span>
					<span class="badge bg-danger" id="cartNum">0</span>
				</span>
				共<span class="sum">￥<span id="totalPrice">0</span>元</span>
			</div>
			<div class="right text-center bg-grey" id="categoryCondition">还差￥0元起送</div>
			<div class="right text-center bg-grey">还差￥<span id="sendCondition"><?php  echo $store['send_price'];?></span>元起送</div>
			<?php  if(!$store['is_in_business_hours']) { ?>
				<div class="right text-center bg-grey hide" id="btnSubmit">休息中</div>
			<?php  } else { ?>
				<div class="right text-center bg-danger hide" id="btnSubmit">选好了</div>
			<?php  } ?>
		</div>
	</nav>
	<?php  if(!empty($activity['items'])) { ?>
		<div class="store-discount-notice txtScroll-top" style="opacity: 0.95;">
			<ul>
				<?php  if(is_array($activity['items'])) { foreach($activity['items'] as $v) { ?>
					<li style="text-align: center; font-size: 0.6rem; line-height: 1.2rem; height: 22.08px;">
						<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/<?php  echo $v['type'];?>_b.png" alt="" style="width:0.7rem; height:0.7rem; vertical-align:middle; margin-top:-0.2rem; margin-right:0.3rem;border-radius:2px;"/>
						<?php  echo $v['title'];?>
					</li>
				<?php  } } ?>
			</ul>
		</div>
	<?php  } ?>
	<header class="bar bar-nav common-bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<a class="pull-right" href="javascript:;" style="margin-left: 5px"><i class="icon icon-search"></i></a>
		<a class="pull-right shoucang" href="javascript:;" id="btn-favorite" data-id="<?php  echo $store['id'];?>" data-uid="<?php  echo $_W['member']['uid'];?>"><i class="fa <?php  if(!empty($is_favorite)) { ?>icon icon-favorfill<?php  } else { ?>icon icon-favor<?php  } ?>"></i></a>
	</header>
	<div class="store-top">
			<img src="<?php  echo $store['logo'];?>" class="store_logo">
			<h1 class="title open-popup" data-popup=".popup-privilege"><?php  echo $store['title'];?></h1>
			<div class="star-rank">
				<span class="star-rank-outline">
					<span class="star-rank-active" style="width:<?php  echo $store['score_cn'];?>"></span>
				</span>
			</div>
	</div>
	<div class="store-notice open-popup" data-popup=".popup-privilege">
		<span class="js-scroll-notice">
			<span class="icon icon-voice"></span>
			<?php  if(!empty($store['notice'])) { ?>
				<?php  echo $store['notice'];?>
			<?php  } else { ?>
				营业时间: <?php  echo $store['business_hours_cn'];?>
			<?php  } ?>
		</span>
	</div>
	<div class="buttons-tab">
		<a href="<?php  echo imurl('wmall/store/goods', array('sid' => $store['id']));?>" class="button active">商品</a>
		<a href="<?php  echo imurl('wmall/store/comment', array('sid' => $store['id']));?>" class="button">评价</a>
		<a href="<?php  echo imurl('wmall/store/index', array('sid' => $store['id']));?>" class="button">商家</a>
		<?php  if(!empty($store['sns']['qq'])) { ?>
			<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php  echo $store['sns']['qq'];?>&site=qq&menu=yes" class="button">客服</a>
		<?php  } ?>
	</div>
	<div class="parent-category-wrapper">
		<div class="parent-category">
			<div id="cateMenu">
				<ul class="category-list">
					<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
						<?php  if(!empty($cate_goods[$category['id']])) { ?>
							<li class="border-1px-b">
								<a href="javascript:;">
									<?php  if($category['bargain_id'] > 0) { ?>
										<svg class="svg" aria-hidden="true">
											<use xlink:href="#svg-tag"></use>
										</svg>
									<?php  } ?>
									<?php  echo $category['title'];?>
								</a>
							</li>
						<?php  } ?>
					<?php  } } ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="content lazyload-container">
		<div class="category-container row no-gutter" style="padding-left: 20%">
			<?php  if(!empty($tokens)) { ?>
				<div class="coupon-show-container">
					<div class="coupon-show">
						<div class="coupon-sum">
							<span>￥</span><?php  echo $token_price;?>
						</div>
						<div class="division">
							<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/division.png" alt="" />
						</div>
						<div class="coupon-info">
							<div class="coupon-title">商家代金券</div>
							<?php  if($token_nums > 1) { ?>
								<div class="condition">内含<?php  echo $token_nums;?>张券</div>
							<?php  } else { ?>
								<div class="condition">满<?php  echo $token['condition'];?>元可用</div>
							<?php  } ?>
						</div>
						<div class="get">
							<span class="btn-get" id="get-coupon">领券</span>
						</div>
					</div>
				</div>
			<?php  } ?>
		</div>
		<div class="category-container row no-gutter" id="category-container">
			<div class="children-category col-100">
				<form action="<?php  echo imurl('wmall/order/create/goods', array('sid' => $sid));?>" method="post" id="goods-form">
					<input type="hidden" name="goods" value=""/>
					<?php  if(is_array($categorys)) { foreach($categorys as $cate_row) { ?>
						<?php  if(!empty($cate_goods[$cate_row['id']])) { ?>
							<div class="children-category-wrapper">
								<div class="heading"><span><?php  echo $cate_row['title'];?></span> <?php  if($cate_row['min_fee'] > 0) { ?><small>最低消费<?php  echo $cate_row['min_fee'];?>元</small><?php  } ?></div>
								<ul class="list-block media-list">
								<?php  if(is_array($cate_goods[$cate_row['id']])) { foreach($cate_goods[$cate_row['id']] as $ds) { ?>
									<li id="goods-<?php  echo $ds['id'];?>" <?php  if($_GPC['goods_id'] == $ds['id']) { ?>class="active"<?php  } ?>>
										<a class="item-content" href="javascript:;">
											<div class="item-media goods-popup"  data-id="<?php  echo $ds['id'];?>">
												<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/hm.gif" class="lazyload" data-original="<?php  echo tomedia($ds['thumb']);?>" alt=""/>
											</div>
											<div class="item-inner">
												<div class="item-title-row">
													<div class="item-title"><?php  echo $ds['title'];?></div>
												</div>
												<div class="item-text">
													<?php  if(!empty($ds['content'])) { ?>
														<div class="goods-info"><?php  echo $ds['content'];?></div>
													<?php  } ?>
													<div class="sell-info">已售<?php  echo $ds['sailed'];?><?php  echo $ds['unitname'];?>&nbsp;&nbsp; 好评<?php  echo $ds['comment_good'];?>
													</div>
													<?php  if(!empty($ds['label'])) { ?>
														<span class="sale-badge bg-danger"><?php  echo $ds['label'];?></span>
													<?php  } ?>
													<div class="price">
														<span class="fee"><span>￥</span><?php  echo $ds['discount_price'];?></span>
														<?php  if(!empty($ds['bargain_id'])) { ?>
															<span class="original-fee">￥<?php  echo $ds['price'];?></span>
														<?php  } ?>
													</div>
													<?php  if(!empty($ds['discount'])) { ?>
														<span class="tag tag-danger"><?php  if($ds['poi_user_type'] == 'new') { ?>新用户专享<?php  } ?> <?php  echo $ds['discount'];?>折 每单仅限<?php  echo $ds['max_buy_limit'];?>份</span>
													<?php  } ?>
												</div>
											</div>
										</a>
										<?php  if($store['is_in_business_hours']) { ?>
											<?php  if($ds['is_sail_now'] == 1) { ?>
												<?php  if(!$ds['is_options'] && !$ds['is_attrs']) { ?>
													<?php  if(!$ds['discount_available_total'] && !$ds['total']) { ?>
														<div class="goods-tips">已售完</div>
													<?php  } else { ?>
														<div class="operate-num operate-goods">
															<span class="hide minus">
																<span class="icon icon-minus" data-goods-id="<?php  echo $ds['id'];?>" data-option-id="0"></span>
																<span class="num">0</span>
															</span>
															<span class="icon icon-plus" data-goods-id="<?php  echo $ds['id'];?>" data-option-id="0"></span>
														</div>
													<?php  } ?>
												<?php  } else if($ds['is_options'] == 1 || $ds['is_attrs'] == 1) { ?>
													<div class="operate-goods">
														<span class="select-spec goods-option" data-id="<?php  echo $ds['id'];?>">可选规格</span>
														<span class="badge hide">0</span>
													</div>
												<?php  } ?>
											<?php  } else { ?>
												<div class="goods-tips no-sail" data-id="<?php  echo $ds['id'];?>">非可售时间 <span class="icon icon-question1"></span></div>
											<?php  } ?>
										<?php  } else { ?>
											<div class="goods-tips">店铺休息中</div>
										<?php  } ?>
									</li>
								<?php  } } ?>
								</ul>
							</div>
						<?php  } ?>
					<?php  } } ?>
				</form>
			</div>
		</div>
	</div>
</div>
<?php  include itemplate('store/goodsCommon', TEMPLATE_INCLUDEPATH);?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>

