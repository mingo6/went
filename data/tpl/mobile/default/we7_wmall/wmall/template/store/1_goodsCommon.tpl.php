<?php defined('IN_IA') or exit('Access Denied');?><style type="text/css">
	.popup-goods-detail .goods-img .icon-close{
		top: -2.7rem;
	    color: #fff;
	    position: absolute;
	}
	.icon-close:before {
    	content: "\e661";
	}
</style>

<audio id="beep-one" controls preload="auto" style="display:none;">
	<source src="<?php echo WE7_WMALL_URL;?>static/add.mp3"></source>
</audio>
<script type="text/javascript" src="<?php echo WE7_WMALL_URL;?>static/js/components/jquery/jquery.SuperSlide.js"></script>
<script type="text/javascript">
	jQuery(".txtScroll-top").slide({mainCell:"ul",autoPage:true,effect:"topLoop",autoPlay:true,easing:"easeInBack",vis:1});
</script>
<div class="popup popup-privilege">
	<div class="popup-opacity">
		<div class="content-block">
			<div class="store-name"><?php  echo $store['title'];?></div>
			<div class="star-rank">
				<span class="star-rank-outline">
					<span class="star-rank-active" style="width:<?php  echo $store['score_cn'];?>%"></span>
					<span class="star-rank-value"><?php  echo $store['score'];?></span>
				</span>
			</div>
			<div class="sell-info">已售<?php  echo $store['sailed'];?>份&nbsp;&nbsp;营业时间: <?php  echo $store['business_hours_cn'];?></div>
			<?php  if(!empty($activity['items']) || $store['delivery_free_price'] > 0) { ?>
				<div class="evaluate">优惠活动</div>
				<?php  if(is_array($activity['items'])) { foreach($activity['items'] as $row) { ?>
					<div class="<?php  echo $row['type'];?> text-left">
						<?php  echo $row['title'];?>
					</div>
				<?php  } } ?>
				<?php  if($store['delivery_free_price'] > 0) { ?>
					<div class="free text-left">
						满<?php  echo $store['delivery_free_price'];?>元免配送费
					</div>
				<?php  } ?>
			<?php  } ?>
			<div class="announcement">商家公告</div>
			<div class="announcement-con">
				<?php  if(!empty($store['notice'])) { ?>
					<?php  echo $store['notice'];?><br>
				<?php  } ?>
				本店欢迎您下单，用餐高峰请提前下单，谢谢！
			</div>
			<p><a href="#" class="close-popup"><span class="icon icon-close"></span></a></p>
		</div>
	</div>
</div>

<div class="popup popup-search" id="popop-search-goods">
	<div class="page search-result search-goods">
		<div class="bar bar-header-secondary">
			<div class="searchbar">
				<a class="searchbar-arrow close-popup" data-popup=".popup-search" ><i class="icon icon-arrow-left"></i></a>
				<a class="searchbar-cancel">搜索</a>
				<div class="search-input">
					<label class="icon icon-search" for="search"></label>
					<input type="search" id='search' name="key" value="<?php  echo $_GPC['key'];?>" placeholder="搜索<?php  echo $store['title'];?>的商品"/>
				</div>
			</div>
		</div>
		<div class="content">
			<ul class="list-block media-list">
				<div class="common-no-con hide">
					<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/search_no_con.png" alt="">
					<p>没有符合条件的搜索结果!</p>
				</div>
				<div class="search-result-container"></div>
			</ul>
		</div>
	</div>
</div>

<div class="modal modal-no-buttons modal-notice modal-store-notice">
	<div class="modal-inner">
		<div class="modal-title">
			<div>温馨提示</div>
		</div>
		<div class="modal-text">
			<div class="notice">
				<?php  echo $store['tips'];?>
			</div>
			<a href="javascript:;" onclick="$.closeModal('.modal-store-notice');" class="button button-big button-fill button-danger close-modal">开始购物</a>
		</div>
	</div>
</div>

<!--非可售时间弹框-->
<div class="modal modal-no-buttons modal-notice modal-sailtime-notice">
	<div class="modal-inner">
		<div class="modal-title">
			<div>可售时间段提示</div>
		</div>
		<div class="modal-text">
			<div class="notice">
				每周可售日期
				<div class="week_cn"></div>
			</div>
			<div class="notice">
				每天可售时间
				<div class="time_cn"></div>
			</div>
			<a href="javascript:;" onclick="$.icloseModal('.modal-sailtime-notice', true);" class="button button-big button-fill button-danger close-modal">知道了</a>
		</div>
	</div>
</div>

<div class="modal modal-no-buttons modal-notice modal-store-business">
	<div class="modal-inner">
		<div class="modal-title">
			<div>店铺休息中</div>
		</div>
		<div class="modal-text">
			<div class="notice">
				店铺休息中，给各位带来不便敬请谅解
			</div>
			<a href="javascript:;" onclick="$.closeModal('.modal-store-business');" class="button button-big button-fill button-danger close-modal">我知道了</a>
		</div>
	</div>
</div>

<script id="goods-detail" type="text/html">
	<div class="popup popup-goods-detail">
		<div class="content-block">
		<header class="bar bar-nav common-bar-nav" style="background-color: #7da6e8;">
			<h1 class="title open-popup" data-popup=".popup-privilege" style="text-align: center;left: 0.6rem;top: 0;color: #fff;"><?php  echo $store['title'];?></h1>
		</header>
			<div class="goods-img">
				<{# if(!d.slides.length){ }>
					<img src="<{d.thumb_}>" width= alt="" style="margin-top:3rem;"/>
				<{# } else { }>
					<div class="swiper-container" data-space-between='0' data-pagination='.swiper-pagination'>
						<div class="swiper-wrapper">
							<{# for(var j = 0, len = d.slides.length; j < len; j++){ }>
							<div class="swiper-slide"><img src="<{d.slides[j]}>" alt=""></div>
							<{# } }>
						</div>
						<div class="swiper-pagination"></div>
					</div>
				<{# } }>
				<a href="#" class="close-popup" data-popup=".popup-goods-detail"><span class="icon icon-close"></span></a>
			</div>
			<div class="goods-name">
				<{d.title}>
			</div>
			<div class="sell-info">已售<{d.sailed}>&nbsp;&nbsp;好评<{d.comment_good}></div>
			<{# if(d.is_options == 0 && d.is_attrs == 0){ }>
				<div class="row no-gutter goods-num">
					<div class="col-50 price">￥<span class="fee"><{d.price}></span></div>
					<div class="col-50 text-right operate-num <?php  if(!$store['is_in_business_hours']) { ?>hide<?php  } ?>">
						<span class="minus hide">
							<span class="icon icon-minus goods-detail-minus" data-goods-id="<{d.id}>" data-option-id="0"></span>
							<span class="num"><{d.hasNum}></span>
						</span>
						<{# if(d.is_sail_now == 1){ }>
							<span class="icon icon-plus goods-detail-plus" data-goods-id="<{d.id}>" data-option-id="0"></span>
						<{# } else { }>
							<span class="goods-detail-plus no-sail" data-id="<{d.id}>">非可售时间 <span class="icon icon-question1"></span></span>
						<{# } }>
					</div>
				</div>
			<{# } else { }>
				<div class="row no-gutter goods-num">
					<div class="col-50 price">￥<span class="fee"><{d.price}></span></div>
					<div class="col-50 text-right operate-num <?php  if(!$store['is_in_business_hours']) { ?>hide<?php  } ?>">
						<div class="operate-goods">
							<{# if(d.is_sail_now == 1){ }>
								<span class="select-spec goods-option" data-id="<{d.id}>">可选规格</span>
							<{# } else { }>
								<span class="goods-detail-plus no-sail" data-id="<{d.id}>">非可售时间 <span class="icon icon-question1"></span></span>
							<{# } }>
						</div>

					</div>
				</div>
			<{# } }>
			<div class="goods-evaluate">商品评价</div>
			<div class="praise text-center">好评率 <span class="rate"><{d.comment_good_percent}></span><span class="num">(共<{d.comment_total}>人评价)</span></div>
			<div class="progress">
				<div class="progress-bar">
					<div class="progress-active" style="width:<{d.comment_good_percent}>;"></div>
				</div>
			</div>
			<div class="goods-desc">商品介绍</div>
			<div class="goods-desc-con">
				<{d.description}><br>
				温馨提示: 图片仅供参考,请以实物为准;<br>
				高峰时段及恶劣天气,请提前下单
			</div>
		</div>
	</div>
</script>

<script id="goods-option" type="text/html">
	<div class="popup popup-spec specs goods-option" data-goods-id="<{d.id}>" style="overflow: visible;">
		<div class="content-block">
			<div class="goods-title">
				<{d.title}>
				<a href="#" class="close-popup" data-popup=".popup-spec.goods-option"><span class="icon icon-close"></span></a>
			</div>
			<!--<div class="sell-info">已售<{d.sailed}>&nbsp;&nbsp;好评<{d.comment_good}></div>-->
			<div class="select-requirement-container">
				<{# if(d.is_options == 1){ }>
					<dl class="standard-con container-option">
						<dt>规格</dt>
						<{# for(var i = 0, len = d.options.length; i < len; i++){ }>
							<dd data-price="<{d.options[i].price}>" data-goods-id="<{d.options[i].goods_id}>" data-option-id="<{d.options[i].id}>" data-option="1" class="goods-option-dd <{# if(i == 0){ }> selected<{# } }>" ><{d.options[i].name}></dd>
						<{# } }>
					</dl>
				<{# } }>
				<{# if(d.is_attrs == 1){ }>
					<{# for(var j = 0, lens = d.attrs.length; j < lens; j++){ }>
						<dl class="standard-con container-attr">
							<dt><{d.attrs[j].name}></dt>
							<{# var label = d.attrs[j].label;}>
							<{# for(var k = 0, len = label.length; k < len; k++){ }>
								<dd class="goods-option-dd goods-attr-dd <{# if(k == 0){ }> selected<{# } }>" data-attr-id="<{j}>s<{k}>" data-option="0"><{label[k]}></dd>
							<{# } }>
						</dl>
					<{# } }>
				<{# } }>
			</div>
			<div class="row no-gutter goods-num">
				<div class="col-50 price">￥<{d.price}></div>
				<div class="col-50 text-right operate-num">
					<span class="minus <{# if(d.num == 0){ }>hide<{# } }>">
						<span class="icon icon-minus from-goods-option" data-goods-id="<{d.id}>"></span>
						<span class="num"><{d.num}></span>
					</span>
					<span class="icon icon-plus from-goods-option" data-goods-id="<{d.id}>"></span>
				</div>
			</div>
		</div>
	</div>
</script>

<script id="goods-cart" type="text/html">
	<div class="popup popup-shop-cart">
		<div class="shop-cart-list">
			<div class="row no-gutter popup-shop-cart-header border-1px-b">
				<div class="col-50"><span><?php  echo $store['title'];?></span></div>
				<div class="col-50 text-right shop-cart-truncate"><img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/icon-trash.png" alt="" /><span class="color-gray">清空购物车</span></div>
			</div>
			<{# for(var i in d){ }>
				<{# for(var j in d[i]['options']){ }>
					<{# if(d[i]['options'][j]['num'] > 0){ }>
						<div class="row no-gutter list-item border-1px-b <{# if(d[i].goods_id == 0){ }>box-price-item<{# } }>" id="shop-cart-list-item-<{d[i].goods_id}>-<{d[i]['options'][j]['option_id']}>">
							<div class="col-42">
								<{# var isActive = d[i]['options'][j]['name'] || (d[i]['options'][j]['discount_num'] > 0 && d[i]['options'][j]['price_num'] > 0);}>
								<div class="goods-title <{# if(isActive){ }>active<{# } }>"><{d[i].title}></div>
								<{# if(isActive){ }>
									<span class="discount-info">
										<{# if(d[i]['options'][j]['name']){ }>
											<{d[i]['options'][j]['name']}>
										<{# } }>
										<{# if(d[i]['options'][j]['discount_num'] > 0 && d[i]['options'][j]['price_num'] > 0){ }>
											&nbsp;含<{d[i]['options'][j]['price_num']}>份原价商品
										<{# } }>
									</span>
								<{# } }>
							</div>
							<div class="col-25 color-orange text-right goods-price <{# if(d[i].goods_id == 0){ }>box-price<{# } }>">￥<{d[i]['options'][j]['price_total']}></div>
							<div class="col-33 text-right">
								<{# if(d[i].goods_id != 0){ }>
									<div class="operate-num">
										<span class="minus">
											<span class="icon icon-minus from-goods-cart" data-option-id="<{d[i]['options'][j]['option_id']}>" data-goods-id="<{d[i].goods_id}>"></span>
											<span class="num"><{d[i]['options'][j]['num']}></span>
										</span>
										<span class="icon icon-plus from-goods-cart" data-option-id="<{d[i]['options'][j]['option_id']}>" data-goods-id="<{d[i].goods_id}>"></span>
									</div>
								<{# } }>
							</div>
						</div>
					<{# } }>
				<{# } }>
			<{# } }>
		</div>
	</div>
</script>

<script id="goods-list" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<li>
		<a class="item-content" href="javascript:;">
			<div class="item-media">
				<{# if(d[i].label != ''){ }>
					<span class="sale-badge bg-danger"><{d[i].label}></span>
				<{# } }>
				<img class="goods-popup" data-id="<{d[i].id}>" src="<{d[i].thumb_cn}>" alt=""/>
			</div>
			<div class="item-inner">
				<div class="item-title-row">
					<div class="item-title"><{d[i].title}></div>
				</div>
				<div class="item-text">
					<div class="sell-info">已售<{d[i].sailed}><{d[i].unitname}>&nbsp;&nbsp; 好评<{d[i].comment_good}></div>
					<div class="price">￥<span class="fee"><{d[i].price}></span></div>
				</div>
			</div>
		</a>
		<{# if(d[i].is_in_business_hours){ }>
			<{# if(d[i].is_options != 1 && d[i].is_attrs != 1){ }>
				<div class="operate-num operate-goods">
					<span class="minus <{# if(!d[i].num) {}>hide<{# } }>">
						<span class="icon icon-minus" data-goods-id="<{d[i].id}>" data-option-id="0"></span>
						<span class="num"><{d[i].num}></span>
					</span>
					<span class="icon icon-plus" data-goods-id="<{d[i].id}>" data-option-id="0"></span>
				</div>
			<{# } else { }>
				<div class="operate-goods">
					<span class="select-spec goods-option" data-id="<{d[i].id}>">可选规格</span>
				</div>
			<{# } }>
		<{# } else { }>
			<div class="goods-tips">店铺休息中</div>
		<{# } }>
	</li>
	<{# } }>
</script>
<script>
$.modal.prototype.defaults.closePrevious = false;
require(['laytpl', 'member', 'jquery.fly'], function(laytpl, member){
	member.initFavorite();
	var categorys_limit_status = <?php  echo $categorys_limit_status;?>;
	var categorys_limit = <?php  echo json_encode($categorys_limit);?>;
	var categorys_limit_temp = <?php  echo json_encode($categorys_limit);?>;
	var categorys_index = <?php  echo json_encode($categorys_index)?>;
	var goods = <?php  echo json_encode($goods);?>;
	console.log(goods)
	var bargains = <?php  echo json_encode($bargains);?>;
	var bargain_goods = {};
	var cart_new = {};
	var is_newmember = <?php  echo $_W['member']['is_store_newmember'];?>;
	var cart_data = <?php  echo json_encode($cart['original_data'])?>;

	$('.parent-category .category-list li:first').addClass('active');

	$(document).on('click', '.no-sail', function(){
		var goods_id = $(this).data('id');
		$('.week_cn').html(goods[goods_id].week_cn);
		$('.time_cn').html(goods[goods_id].time_cn);
		$.iopenModal('.modal-sailtime-notice', function(){});
	});


	$(document).on('click', '.shop-cart-truncate', function(){
		$.post("<?php  echo imurl('wmall/store/goods/cart_truncate', array('sid' => $sid));?>", {}, function(data){
			var result = $.parseJSON(data);
			if(result.message.errno != 0) {
				$.toast(result.message.message);
				return false;
			} else {
				var send_price = "<?php  echo $store['send_price'];?>";
				cart_new = {};
				bargain_goods= {};
				categorys_limit = categorys_limit_temp;
				$('.children-category-wrapper span.minus .num').html(0);
				$('.children-category-wrapper span.minus').addClass('hide');
				$('.children-category-wrapper span.badge').html(0);
				$('.children-category-wrapper span.badge').addClass('hide');
				$('#popop-search-goods .minus').addClass('hide');
				$('#popop-search-goods .minus .num').html(0);
				$('.selection-goods .minus').addClass('hide');
				$('.selection-goods .minus .num').html(0);
				$('.selection-goods .badge').html(0).addClass('hide');
				$('.goods-option .minus').addClass('hide');
				$('.goods-option .minus .num').html(0);

				$('#cartNotEmpty').addClass('hide');
				$('#cartNotEmpty #totalPrice, #cartNotEmpty #cartNum').html(0);
				$('#cartNotEmpty #sendCondition').html(send_price);
				$('#cartEmpty').removeClass('hide');
				$.closeModal('.popup-shop-cart');
				return false;
			}
		});
	});

	$('#btnSubmit').click(function(){
		<?php  if(!$store['is_in_business_hours']) { ?>
			$.toast('店铺休息中,请稍后下单');
			return false;
		<?php  } ?>
		$('#goods-form :hidden[name="goods"]').val((encodeURI(JSON.stringify((cart_new)))));
		$('#goods-form').submit();
	});

	<?php  if(!empty($store['notice'])) { ?>
		var left = 0, notice = $('.js-scroll-notice');
		setInterval(function(){
			left--;
			0 > left + notice.width() && (left = notice.width());
			notice.css({
				'left': left
			});
		}, 25);
	<?php  } ?>

	<?php  if(!empty($store['tips'])) { ?>
		require(['tiny'], function(tiny){
			var storeNotice = 'storeNotice' + <?php  echo $store['id'];?>;
			if(!tiny.cookie.get(storeNotice)) {
				$.iopenModal('.modal-store-notice', function(){});
				tiny.cookie.set(storeNotice, 1, 300);
			}
		});
	<?php  } ?>

	<?php  if(!$store['is_in_business_hours']) { ?>
		$.iopenModal('.modal-store-business', function(){});
	<?php  } ?>

	//超市模板专用
	$(document).on('click', '.category-row', function(){
		$.showIndicator();
		var cid = $(this).data('id');
		var action = "<?php  echo imurl('wmall/store/goods/cate', array('sid' => $sid));?>" + '&cid=' + cid + '#' + cid;
		var goods= encodeURI(JSON.stringify(cart_new));
		$.post("<?php  echo imurl('wmall/store/goods/cart', array('sid' => $sid));?>", {goods: goods}, function(){
			$.hideIndicator();
			location.href = action;
		});
	});

	$('#category-toggle').click(function(){
		if($(this).find('i').hasClass('icon-arrow-down')) {
			$('.goods-category-con a').removeClass('hide');
			$(this).html('收起 <i class="icon icon-arrow-up"></i>');
		} else {
			$('.goods-category-con a:gt(4)').addClass('hide');
			$(this).removeClass('hide').html('更多 <i class="icon icon-arrow-down"></i>');
		}
	});

	//超市模板分类专用
	var mySwiper2 = $('.goods-categories-container').swiper({
		freeMode:true,
		freeModeFluid:true,
		slidesPerView: 'auto',
		simulateTouch:false,
		hashnav: true
	});

	$(document).on('click', '#category-more', function(){
		if($(this).find('span').hasClass('icon-arrow-down')) {
			$(this).find('span').removeClass('icon-arrow-down').addClass('icon-arrow-up');
			$('.select-container').show();
		} else {
			$(this).find('span').removeClass('icon-arrow-up').addClass('icon-arrow-down');
			$('.select-container').hide();
		}
	});

	$(document).on('click', '.bar-nav .icon-search,.goods-categories-top .icon-search', function(){
		$('.search-input input').val('');
		$('.search-result-container').html('');
		$.popup('.popup-search');
	});

	$(document).on('click', '#popop-search-goods .searchbar-cancel', function(){
		var key = $('.search-input input').val();
		if(!key) {
			return false;
		}
		$('.search-result-container').html('');
		$.showIndicator();
		$.post("<?php  echo imurl('wmall/store/goods/search', array('sid' => $sid));?>", {key: key}, function(data){
			var result = $.parseJSON(data);
			if(result.message.errno == -1) {
				$.toast(result.message.message);
				return false;
			} else {
				var goods = result.message.message;
				if(goods.length <= 0) {
					$.hideIndicator();
					$('#popop-search-goods .common-no-con').removeClass('hide');
					return false;
				}
				$('#popop-search-goods .common-no-con').addClass('hide');
				$.each(goods, function(i, v){
					if(v['is_options'] == 1 || v['is_attrs'] == 1) {
						goods[i].num = goodsNum(v['id'], v['option_id']);
					} else {
						goods[i].num = goodsNum(v['id'], 0);
					}
				});
				var gettpl = $('#goods-list').html();
				laytpl(gettpl).render(goods, function(html){
					$.hideIndicator();
					$('#popop-search-goods').find('.search-result-container').html(html);
				});
			}
		});
		return false;
	});

	$(document).on('click', '#cartNotEmpty .cart', function(){
		if(!$(this).hasClass('show')) {
			$(this).addClass('show');
			var gettpl = $('#goods-cart').html();
			laytpl(gettpl).render(cart_new, function(html){
				$.popup(html);
			});
		} else {
			$(this).removeClass('show')
			$.closeModal('.popup-shop-cart');
		}
	});

	$(document).on('click', '#category-container .goods-option, #popop-search-goods .goods-option, .popup-goods-detail .goods-option', function(){
		var id = $(this).data('id');
		$.showIndicator();
		$.post("<?php  echo imurl('wmall/store/goods/detail', array('sid' => $sid));?>", {id: id}, function(data) {
			var result = $.parseJSON(data);
			if(result.message.errno != 0) {
				$.hideIndicator();
				$.toast(result.message.message);
			} else {
				var goods = result.message.message;
				if(goods['is_options'] == 1 || goods['is_attrs'] == 1) {
					goods['num'] = goodsNum(id, goods['option_id']);
				} else {
					goods['num'] = goodsNum(id);
				}
				var gettpl = $('#goods-option').html();
				laytpl(gettpl).render(goods, function(html){
					$.hideIndicator();
					$.popup(html);
				});
			}
			return false;
		});
	});

	$(document).on('click', '.goods-popup', function(){
		var id = $(this).data('id');
		var num = goodsNum(id, 0);
		$.showIndicator();
		$.post("<?php  echo imurl('wmall/store/goods/detail', array('sid' => $sid));?>", {id: id}, function(data) {
			var result = $.parseJSON(data);
			if(result.message.errno != 0) {
				$.hideIndicator();
				$.toast(result.message.message);
			} else {
				result.message.message.hasNum = num;
				var gettpl = $('#goods-detail').html();
				laytpl(gettpl).render(result.message.message, function(html){
					$.hideIndicator();
					$.popup(html);
					if(num > 0) {
						$('.popup-goods-detail').find('.minus').removeClass('hide')
					}
					$(".swiper-container").swiper({autoplay: 1000});
				});
			}
			return false;
		});
	});

	$(document).on('click', '.goods-option-dd', function(){
		var $parent = $(this).parents('.popup-spec');
		var goods_id = $parent.data('goods-id');
		var item = goods[goods_id];
		if(!item) {
			$.toast('商品不存在');
			return false;
		}
		$(this).siblings().removeClass('selected');
		$(this).addClass('selected');

		var option_id = getOptionid(item, $(this));
		var price = item['options_data'][option_id]['price'];
		$('.goods-option .no-gutter .price').html('¥ ' + price);

		var num = goodsNum(goods_id, option_id);
		$('.goods-option .no-gutter .num').html(num);
		if(num > 0) {
			$parent.find('.minus').removeClass('hide');
		}
	});

	$(document).on('click', '.icon-plus', function(){
		$("#beep-one")[0].play();
		var goods_id = $(this).data('goods-id');
		var item = goods[goods_id];
		if(!item) {
			$.toast('商品不存在');
			return false;
		}
		var option_id = getOptionid(item, $(this));
		var curNum = goodsCartNew(goods_id, option_id, '+');
		if(curNum === false) {
			return false;
		}
		var $num = $(this).prev().find('.num');
		$num.text(curNum);
		$('#goods-' + goods_id + ' .minus .num').html(curNum);
		var totalNum = goodsNum(goods_id, '-1');
		if(totalNum > 0){
			$(this).prev().removeClass('hide');
			$('#goods-' + goods_id + ' .minus').removeClass('hide');
			$('#goods-' + goods_id).find('.badge').html(totalNum).removeClass('hide');
		}
		var from_goods_cart = $(this).hasClass('from-goods-cart');
		if(from_goods_cart) {
			var price = cart_new[goods_id]['options'][option_id]['price_total'];
			$('#shop-cart-list-item-' + goods_id + '-' + option_id + ' .goods-price').html('￥' + price);
		}
		if(flag) {
			return false;
		}
		if(!$(".cart").hasClass('flicker')) {
			$(".cart").addClass('flicker')
			setTimeout(function () {
				$(".cart").removeClass('flicker')
			}, 500);
		}
		var flyer = $('<div class="u-flyer"></div>');
		flyer.fly({
			speed: 1.8,
			start: {
				left: event.pageX,
				top: event.pageY
			},
			end: {
				left: 25,
				top: $(window).height() - 20,
			},
			onEnd: function(){
				flyer.remove();
			}
		});
	});

	$(document).on('click', '.icon-minus', function(){
		$("#beep-one")[0].play();
		var goods_id = $(this).data('goods-id');
		var item = goods[goods_id];
		if(!item) {
			$.toast('商品不存在');
			return false;
		}
		var option_id = getOptionid(item, $(this));
		var curNum = goodsCartNew(goods_id, option_id, '-');
		if(curNum === false) {
			return false;
		}
		var $num = $(this).next();
		$num.text(curNum);
		$('#goods-' + goods_id + ' .minus .num').text(curNum);
		var from_goods_cart = $(this).hasClass('from-goods-cart');
		if(from_goods_cart) {
			var price = cart_new[goods_id]['options'][option_id]['price_total'];
			$('#shop-cart-list-item-' + goods_id + '-' + option_id + ' .goods-price').html('￥' + price);
		}
		var num = goodsNum(goods_id, option_id);
		if(num < 1) {
			$(this).parent().addClass('hide');
			$('#goods-' + goods_id + ' .minus').addClass('hide');
			if(from_goods_cart) {
				$(this).parents('.popup-shop-cart').find('#shop-cart-list-item-' + goods_id + '-' + option_id).remove();
				if($('.popup-shop-cart .shop-cart-list .row.list-item:not(".box-price-item")').length == 0) {
					$.closeModal('.popup-shop-cart');
				}
			}
		}
		var totalNum = goodsNum(goods_id, -1);
		if(totalNum < 1) {
			$('#goods-' + goods_id).find('.badge').html(0).addClass('hide');
		} else {
			$('#goods-' + goods_id).find('.badge').html(totalNum).removeClass('hide');
		}
	});

	var goodsCartNew = function(goods_id, option_id, sign) {
		var goods_item = goods[goods_id];
		if(!goods_item) {
			return false;
		}
		var goods_option_id = transferOptionid(option_id);
		var cart_item = cart_new[goods_id];
		var curNum = 0;
		if(cart_item && cart_item['options'] && cart_item['options'][option_id]) {
			var curNum = cart_item['options'][option_id]['num'];
		}
		var price = goods_item['price'];
		var original_price = goods_item['price'];
		var discount_price = goods_item['discount_price'];
		if(goods_option_id != 0) {
			price = goods_item['options'][goods_option_id]['price'];
			original_price = goods_item['options'][goods_option_id]['price'];
			discount_price = goods_item['options'][goods_option_id]['discount_price'];
		}
		var price_change = 0;
		if(sign == '+') {
			if(goods_item['bargain_id'] > 0 && bargains[goods_item['bargain_id']]) {
				var bargain = bargains[goods_item['bargain_id']];
				if(bargain['avaliable_order_limit'] <= 0) {
					if(!curNum && !flag) {
						$.toast(bargain['title'] + '活动每天限购一单,超出后恢复原价');
					}
					price = original_price;
					price_change = 1;
				}
				if(goods_item['poi_user_type'] == 'new' && !is_newmember) {
					if(!curNum && !flag) {
						//只提示一次
						$.toast('仅限门店新用户优惠');
					}
					price = original_price;
					price_change = 1;
				}
				if(!price_change) {
					//天天特价限制商品种数
					var bargain_goods_item = bargain['hasgoods'] ? bargain['hasgoods'] : new Array();
					var marks = 0;
					for(var i in bargain_goods_item) {
						if(bargain_goods_item[i] == goods_id) {
							marks = 1;
							break;
						}
					}
					if(!marks && bargain_goods_item.length == bargain.goods_limit && !flag) {
						$.toast(bargain['title'] + '每单特价商品限购'+ bargain.goods_limit +'种,超出后恢复原价');
					}
					if(!marks) {
						bargain_goods_item.push(goods_id);
					}
					if(bargain_goods_item.length > bargain.goods_limit) {
						price = original_price;
						price_change = 1;
					}
					//天天特价限制单个商品购买数量
					if(!price_change) {
						var totalNum = goodsNum(goods_id, -1);
						if(totalNum == goods_item['max_buy_limit'] && !flag) {
							$.toast('每单特价商品限购' + goods_item.max_buy_limit + '份,超出后恢复原价');
						}
						var discountNum = goodsNum(goods_id, -1, 'discount_num');
						if(discountNum >= goods_item['max_buy_limit']) {
							price = original_price;
							price_change = 1;
						} else {
							price = discount_price;
							price_change = 2;
							if(!flag && goods_item.discount_available_total != -1 && discountNum >= goods_item.discount_available_total) {
								$.toast('活动库存不足,恢复原价购买');
								price = original_price;
								price_change = 1;
							}
						}
					}
				}
				if(price_change <= 1) {
					var max = parseInt(goods_item.total);
					if(!max && !flag) {
						$.toast('库存不足,下次再来');
						return false;
					} else {
						if(max != -1 && cart_item && cart_item['options'] && goodsNum(goods_id, '-1') >= max && !flag) {
							$.toast('库存不足,下次再来');
							return false;
						}
					}
				}
			} else {
				var max = goods_item.total;
				if(goods_option_id != 0) {
					max = goods_item['options'][goods_option_id]['total'];
				}
				if(null != max && max != "" && max != "-1" && curNum >= max && !flag) {
					$.toast('库存不足,下次再来');
					return false;
				}
			}

			if(!cart_item) {
				var item = {
					goods_id: goods_id,
					title: goods_item['title'],
					options: {}
				};
				goods_id = goods_id + '';
				cart_new[goods_id] = item;
			}
			var options = cart_new[goods_id]['options'];
			option_id = option_id + '';
			if(!options[option_id]) {
				options[option_id] = {
					option_id: option_id,
					name: (goods_item['is_options'] == 1 || goods_item['is_attrs'] == 1) ? goods_item['options_data'][option_id]['name'] : '',
					num: 1,
					price_num: price_change <= 1 ? 1: 0,
					discount_num: price_change == 2 ? 1: 0,
					bargain_id: price_change == 2 ? goods_item['bargain_id']: 0,
					price_total: price
				}
			} else {
				options[option_id]['num'] = parseInt(options[option_id]['num']) + 0 + 1;
				if(price_change <= 1) {
					options[option_id]['price_num'] = parseInt(options[option_id]['price_num']) + 1;
				} else {
					options[option_id]['bargain_id'] = goods_item['bargain_id'];
					options[option_id]['discount_num'] =  parseInt(options[option_id]['discount_num']) + 1;
				}
				options[option_id]['price_total'] = (parseFloat(options[option_id]['price_total']) + parseFloat(price)).toFixed(2);
			}
			curNum = options[option_id]['num'];
		} else {
			if(!cart_item) {
				return false;
			}
			var options = cart_item['options']
			if(!options) {
				return false;
			}
			var option = options[option_id];
			if(!option) {
				return false;
			}
			if(option && option['num'] > 0) {
				option['num']--;
				if(option['price_num'] > 0) {
					price = original_price;
					option['price_num']--;
				} else if(option['discount_num'] > 0) {
					price = discount_price;
					option['discount_num']--;
					if(option['discount_num'] <= 0) {
						option['bargain_id'] = 0;
					}
				}
				option['price_total'] = (parseFloat(options[option_id]['price_total']) - parseFloat(price)).toFixed(2);
			}
			curNum--;
			if(goods_item['bargain_id'] > 0 && bargains[goods_item['bargain_id']]) {
				var bargain = bargains[goods_item['bargain_id']];
				var bargain_goods_item = bargain['hasgoods'];
				if(curNum <= 0 && bargain_goods_item) {
					for(var i in bargain_goods_item) {
						if(bargain_goods_item[i] == goods_id) {
							bargain_goods_item.splice(i, 1);
							break;
						}
					}
				}
			}
			curNum = option['num'];
		}
		var goods_box_price = parseFloat(goods_item['box_price']);
		if(goods_box_price > 0) {
			var box_price_item = cart_new['88888'];
			if(!box_price_item) {
				cart_new['88888'] = {
					title: '餐盒费',
					goods_id: 0,
					options: {
						'0': {
							num: 0,
							name: '',
							discount_num: 0,
							price_num: 0,
							price_total: 0
						}
					}
				}
				box_price_item = cart_new['88888'];
			}
			box_price_item = box_price_item['options']['0'];
			if(sign == '+') {
				box_price_item['num'] += 1;
			} else {
				box_price_item['num'] -= 1;
			}
			box_price_item['price_total'] = (parseFloat(box_price_item['price_total']) + parseFloat(sign + 1) * goods_box_price).toFixed(2);
		}
		var params = {
			price: price,
			box_price: goods_item['box_price'] ? goods_item['box_price']: 0,
			cid: goods_item['cid']
		};

		count(params, sign);
		return curNum;
	}

	//获取某个商品的数量
	var goodsNum = function(goods_id, option_id, type) {
		var type = type ? type : 'num';
		var cart_goods_item = cart_new[goods_id];
		if(!cart_goods_item) {
			return 0;
		}
		if(option_id != -1) {
			var option = cart_goods_item['options'][option_id];
			if(!option) {
				return 0;
			} else {
				return option[type];
			}
		} else {
			var num = 0;
			$.each(cart_goods_item['options'], function(k, v){
				if(v[type]) {
					num += v[type];
				}
			});
			return num;
		}
	};

	var transferOptionid = function(option_id) {
		if(option_id == 0) {
			return 0;
		}
		var params = option_id.split('_');
		return params[0];
	};

	var getOptionid = function(goods, $obj) {
		if(goods['is_options'] != 1 && goods['is_attrs'] != 1) {
			return 0;
		}
		if($obj.hasClass('from-goods-cart') && $obj.data('option-id')) {
			return $obj.data('option-id');
		}
		$parent = $('.goods-option.popup-spec');
		if($parent.data('goods-id') != goods['id']) {
			return false;
		}
		var option_id = 0;
		if(goods['is_options'] == 1) {
			var $container_option = $('.container-option', $parent);
			var $option = $('.goods-option-dd.selected', $container_option);
			option_id = $option.data('option-id');
		}
		if(goods['is_attrs'] == 1) {
			var $container_attr = $('.container-attr', $parent);
			var attr_ids = [];
			$('.goods-option-dd.selected', $container_attr).each(function(){
				attr_ids.push($(this).data('attr-id'));
			});
			var attr_id = attr_ids.sort().join('v');
			option_id = option_id + '_' + attr_id;
		}
		return option_id;
	};

	var count = function(goods, sign) {
		var $condition = $('#sendCondition'),
			$total = $('#totalPrice'),
			$cartNum = $('#cartNum'),
			$cartEmpty = $('#cartEmpty'),
			$cartNotEmpty = $('#cartNotEmpty'),
			sendCondition = parseFloat($condition.text()).toFixed(3),
			totalPrice = parseFloat($total.text()) || 0,
			disPrice = parseFloat(sign + 1) * parseFloat(goods['price']),
			boxPrice = parseFloat(sign + 1) * parseFloat(goods['box_price']),
			price = totalPrice + disPrice + boxPrice,
			price = parseFloat(price.toFixed(3)),
			number = $cartNum.text() == '' ? 0 : parseInt($cartNum.text()),
			disNumber = number + parseInt(sign + 1);
		$total.text(price);
		$condition.text(parseFloat((sendCondition - disPrice - boxPrice).toFixed(3)));
		$cartNum.text(disNumber);

		var category_flag = 0;
		if(categorys_limit_status == 1) {
			var cid = parseInt(goods['cid']);
			var index = $.inArray(cid, categorys_index);
			if(index != -1) {
				categorys_limit[cid].fee = (parseFloat(categorys_limit[cid].fee) + parseFloat(disPrice)).toFixed(3);
			}
			for(var i in categorys_limit) {
				var category = categorys_limit[i];
				if(category.fee > 0 && parseFloat(category.fee) < parseFloat(category.min_fee)) {
					category_flag = 1;
					break;
				} else {
					category_flag = 0;
				}
			}
		}

		if(sendCondition - disPrice - boxPrice <= 0){
			if(category_flag == 1) {
				$condition.parent().hide();
				$condition.parent().next().hide();
				$condition.parent().hide().prev().show();
				$('#categoryCondition').off('click');
				$('#categoryCondition').on('click', function(){
					$.toast(categorys_limit[i].title + '分类最低消费' + categorys_limit[i].min_fee + '元才能下单');
					return;
				});
			} else {
				$condition.parent().hide();
				$condition.parent().prev().hide();
				$condition.parent().hide().next().show();
			}
		} else {
			$condition.parent().prev().hide();
			$condition.parent().next().hide();
			$condition.parent().show();
		}
		if(disNumber > 0){
			$cartEmpty.addClass('hide');
			$cartNotEmpty.removeClass('hide');
		} else {
			$cartEmpty.removeClass('hide');
			$cartNotEmpty.addClass('hide');
		}
		return false;
	}

	var flag = 0;
	function __init() {
		if(cart_data) {
			flag = 1;
			for(var n in cart_data) {
				if(cart_data[n]['options']) {
					for(var m in cart_data[n]['options']) {
						var option = cart_data[n]['options'][m];
						if(option['num'] > 0) {
							for(var i = 0; i < option['num']; i++) {
								var curNum = goodsCartNew(n, m, '+');
							}
						}
					}
				}
				var totalNum = goodsNum(n , -1);
				if(totalNum > 0) {
					$('#goods-' + n + ' .minus .num').html(curNum);
					$('#goods-' + n + ' .minus').removeClass('hide');
					$('#goods-' + n + ' .badge').html(totalNum).removeClass('hide');
				}
			}
		}
		flag = 0;
	}
	__init();

	var menu = {
		offsetAry: [0],
		_is_left_menu_addclass: true,
		init: function(){
			var _this = this;
			var windowHeight = $(window).height();
			var maxLeftHeight = windowHeight - 200;
			$('#cateMenu').height(maxLeftHeight);
			if($('.parent-category ul').height() > maxLeftHeight) {
				if($.device.iphone) {
					new IScroll('#cateMenu', {probeType: 3, mouseWheel: true, click: false, tap: true})
				} else {
					new IScroll('#cateMenu', {probeType: 3, mouseWheel: true, click: true})
				}
			}

			$(document).on('click', '.parent-category li', function(){
				$('.parent-category li').removeClass('active');
				$(this).addClass('active');
				_this._is_left_menu_addclass = false;
				var t = $('.content').scrollTop();
				var t1 = _this.offsetAry[$('.parent-category li').index(this) + 1] - 125;
				var _t = Math.abs(t1-t);
				$('.content').scrollTop(t1);
				setTimeout(function(){
					_this._is_left_menu_addclass=true;
				}, 300);
			});

			$('.children-category-wrapper .heading').each(function(){
				_this.offsetAry.push($(this).offset().top);
			});

			$('.content').bind('scroll', function(){
				_this.scroll.call(_this);
			});
		},

		getIndex: function(ary, value){
			var i = 0;
			for(; i < ary.length; i++){
				if(value >= ary[i] && value < ary[i + 1]){
					return i;
				}
			}
			return ary.length -1;
		},

		scroll: function(){
			var st = $('.content').scrollTop() + 125;
			var index = this.getIndex(this.offsetAry, st);
			var i = index - 1;
			if(this.curIndex !== index){
				if(this._is_left_menu_addclass) {
					$('.parent-category li').removeClass('active');
				}
				if(i >= 0){
					$('#category-container .parent-category').addClass('fixed');
					if(this._is_left_menu_addclass) {
						$('.parent-category li').eq(i).addClass('active');
					}
				} else {
					$('.parent-category li').eq(0).addClass('active');
					$('#category-container .parent-category').removeClass('fixed');
				}
				this.curIndex = index;
			}
		}
	};
	<?php  if($ta == 'index' || $ta == 'index1') { ?>
		menu.init();
	<?php  } ?>

	<?php  if(!empty($_GPC['goods_id'])) { ?>
		var goods_id = "<?php  echo $_GPC['goods_id'];?>";
		$('.content').scrollTop($('#goods-' + goods_id).offset().top - 125);
	<?php  } ?>

	<?php  if(!empty($_GPC['key'])) { ?>
		$('#popop-search-goods .searchbar-cancel').trigger('click');
		$.popup('.popup-search');
	<?php  } ?>

	//领取优惠券
	$(document).on('click', '#get-coupon', function(){
		$.showIndicator();
		$.post("<?php  echo imurl('wmall/channel/coupon/get', array('sid' => $sid))?>", {}, function(data){
			var result = $.parseJSON(data);
			$.hideIndicator();
			if(result.message.errno != 0) {
				$.toast(result.message.message);
				return false;
			} else {
				$('.coupon-show-container').hide();
				$.toast('领取优惠券成功');
				return false;
			}
		});
	});
});
</script>