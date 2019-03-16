<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<style type="text/css">

	.home .slide.swiper-container{
		height: 8.5rem;
	}
	.home .search{
		position: absolute;
		background: none;
	}
	.home .search .search-inner{
		background: rgba(0,0,0,0.4);
		border-radius: 1.4rem;
		padding-left: 1rem;
		padding-right: 2.5rem;
		margin: 5% 27%;
		line-height: 1.1;
	}
	.home .search .external{
		background: none;
		-webkit-text-fill-color:#fff;
		margin-left: 0.4rem;
		text-overflow:ellipsis;
		max-width: 4.5rem;
	}
	.zhishi{
		position: absolute;
		font-size: 1.2rem;
		margin-left: 0.5rem;
	}
	.home .search-block{
		background: rgba(0,0,0,0.4);
		width: 1.4rem;
		height: 1.4rem;
		border-radius: 2rem;
		margin-top:0.9rem;
		margin-left: 85%;
	}
	.home .search-block .icon-search{
		color: #fff;
		font-size: 0.8rem;
		margin-right: 0;
	}
	.home .fiexd-searchbar{
		background: none;
	}
	.peisong{
		margin: 0 .5rem 0 .5rem;
		color: #808080;
		font-size: .55rem;
		max-width: 90%;
	}
	.peisong img{
		width: 0.75rem;
		margin-top: 0.17rem;
	    margin-right: 0.2rem;
	    margin-bottom: -0.15rem;
	}
	.peisong span{
		position: absolute;
		margin-top: 0.1rem;
	}
</style>
<div class="page home" id="page-app-index">
	<span id="js-lat" class="hide"><?php  if(!empty($_GPC['lat'])) { ?><?php  echo $_GPC['lat'];?><?php  } else { ?><?php  echo $_GPC['__lat'];?><?php  } ?></span>
	<span id="js-lng" class="hide"><?php  if(!empty($_GPC['lng'])) { ?><?php  echo $_GPC['lng'];?><?php  } else { ?><?php  echo $_GPC['__lng'];?><?php  } ?></span>
	<span id="spread_code" class="hide"><?php  echo $_GPC['code'];?></span>
	<?php  get_mall_menu();?>
	<div class="content">
		<div class="search">
			<span class="search-inner">
				<i class="icon icon-lbs-fill"></i>
				<a id="position" class="external" href="<?php  echo imurl('wmall/home/location');?>"><?php  if(!empty($_GPC['address'])) { ?><?php  echo $_GPC['address'];?><?php  } else { ?><?php  echo $_GPC['__address'];?><?php  } ?></a>
				<span class="zhishi">></span>
				<!--<i class="icon icon-arrow-down-fill"></i>-->
			</span>
			<!--<div id="tp-weather-widget" style="position:absolute;right:.5rem;top:.2rem;pointer-events: none;"></div>-->
			<a class="search-block" href="<?php  echo imurl('wmall/home/hunt');?>">
				<i class="icon icon-search"></i><!--输入商家、商品名称-->
			</a>
		</div>
		<div id="fixed-searchbar-container"></div>
		<div id="home-container">
			<div class="store-list" id="store-list">
				<div class="common-no-con geolocationing">
					<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/store_no_con.png" alt="" />
					<p>努力加载中...</p>
				</div>
				<div class="common-no-con geolocationfail hide">
					<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/store_no_con.png" alt="" />
					<p>获取定位失败!您可以选择手动搜索地址</p>
					<a href="<?php  echo imurl('wmall/home/location')?>" class="btn-location">手动搜索地址</a>
				</div>
			</div>
		</div>
		<?php  include itemplate('public/copyright', TEMPLATE_INCLUDEPATH);?>
	</div>
	<div class="footmark-warpper">
		<a href="javascript:;" id="go-top" class="icon icon-up"></a>
		<a href="<?php  echo imurl('wmall/home/footmark')?>" class="footmark"><i class="icon icon-footprint"></i></a>
	</div>
	<?php  get_mall_danmu();?>
</div>
<?php  get_mall_superRedpacket();?>

<script id="tpl-home" type="text/html">
	<{# var _slides = d.slides;}>
	<{# if(_slides && _slides.length > 0) { }>
	<div class="swiper-container slide" data-space-between='0' data-pagination='.swiper-slide-pagination' data-autoplay="1000">
		<div class="swiper-wrapper">
			<{# for(var i = 0, len = _slides.length; i < len; i++) { }>
				<div class="swiper-slide" data-link="<{_slides[i].link}>">
					<img src="<{tiny.tomedia(_slides[i].thumb)}>" alt="">
				</div>
			<{# } }>
		</div>
		<div class="swiper-pagination swiper-slide-pagination"></div>
	</div>
	<{# } }>

	<{# var _categorys_chunk = d.categorys_chunk}>
	<{# if(_categorys_chunk && _categorys_chunk.length > 0) { }>
		<div class="swiper-container category" data-space-between='0' data-pagination='.swiper-category-pagination' data-autoplay="0">
			<div class="swiper-wrapper">
				<{# for(var i = 0, len = _categorys_chunk.length; i < len; i++) { }>
					<div class="swiper-slide">
						<div class="row no-gutter nav">
							<{# for(var j = 0, length = _categorys_chunk[i].length; j < length; j++) { }>
								<div class="col-25">
									<a href="<{_categorys_chunk[i][j].link}>">
										<img src="<{_categorys_chunk[i][j].thumb}>" alt="<{_categorys_chunk[i][j].title}>" />
										<div class="text-center"><{_categorys_chunk[i][j].title}></div>
									</a>
								</div>
							<{# } }>
						</div>
					</div>
				<{# } }>
			</div>
			<{# if(_categorys_chunk.length > 1) { }>
				<div class="swiper-pagination swiper-category-pagination"></div>
			<{# } }>
		</div>
	<{# } }>

	<{# var _notices = d.notices}>
	<{# if(_notices && _notices.length > 0) { }>
	<div class="swiper-container headlines border-1px-t">
		<div class="headline-logo pull-left"><img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/head_line.png" alt=""></div>
		<div class="headline-news pull-left swiper-wrapper">
			<{# for(var i = 0, len = _notices.length; i < len; i++) { }>
			<div class="swiper-slide">
				<{# if (_notices[i].link) { }>
					<a href="<{_notices[i].link}>"><{_notices[i].title}></a>
				<{# } else { }>
					<a href="<?php  echo imurl('wmall/home/notice');?>&id=<{_notices[i].id}>"><{_notices[i].title}></a>
				<{# } }>
			</div>
			<{# } }>
		</div>
		<i class="icon icon-arrow-right pull-left"></i>
	</div>
	<{# } }>

	<{# var _cubes = d.cubes}>
	<{# if(_cubes && _cubes.length > 0) { }>
		<div class="row no-gutter sborder activity" style="z-index: 1000">
			<{# for(var i = 0, len = _cubes.length; i < len; i++) { }>
				<div class="col-50 sborder">
					<a href="<{_cubes[i].link}>">
						<div class="row no-gutter">
							<{# if(i % 2 == 0) { }>
								<div class="col-60">
									<div class="heading"><{_cubes[i].title}></div>
									<div class="sub-heading"><{_cubes[i].tips}></div>
								</div>
								<div class="col-40 text-center">
									<img src="<{tiny.tomedia(_cubes[i].thumb)}>" alt="" />
								</div>
							<{# } else { }>
								<div class="col-40 text-center">
									<img src="<{tiny.tomedia(_cubes[i].thumb)}>" alt="" />
								</div>
								<div class="col-60">
									<div class="heading"><{_cubes[i].title}></div>
									<div class="sub-heading"><{_cubes[i].tips}></div>
								</div>
							<{# } }>
						</div>
					</a>
				</div>
			<{# }}>
		</div>
	<{# } }>

	<{# var _bargains = d.bargains}>
	<{# if(_bargains && _bargains.length > 0) { }>
		<div class="bargain-activity">
			<div class="activity-header text-center">
				天天特价
				<a class="more" href="<?php  echo imurl('bargain/index')?>">更多 <i class="icon icon-arrow-right"></i></a>
			</div>
			<div class="goods-list row">
				<{# for(var i = 0, len = _bargains.length; i < len; i++) {}>
					<div class="goods-item col-25">
						<a href="<?php  echo imurl('wmall/store/goods');?>&sid=<{_bargains[i].sid}>&goods_id=<{_bargains[i].goods_id}>">
							<div class="goods-image">
								<div class="label"><{_bargains[i].discount}>折</div>
								<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/hm.gif" alt="" class="lazyload" data-original="<{tiny.tomedia(_bargains[i].thumb)}>">
							</div>
							<div class="goods-title"><{_bargains[i].title}></div>
							<div class="price">
								<i>￥</i><span class="now-price"><{_bargains[i].discount_price}></span>&nbsp;<span class="original-price">￥<{_bargains[i].price}></span>
							</div>
						</a>
					</div>
				<{# } }>
			</div>
		</div>
	<{# } }>

	<{# var _recommends = d.recommends}>
	<{# if(_recommends && _recommends.length > 0) { }>
		<div class="selective">
			<div class="selective-tab">
				为您优选
				<a class="more" href="<?php  echo imurl('wmall/channel/brand')?>">更多<i class="icon icon-arrow-right"></i></a>
			</div>
			<div class="selective-info row">
				<{# for(var i = 0, len = _recommends.length; i < len; i++) { }>
					<a href="<?php  echo imurl('wmall/store/goods');?>&sid=<{_recommends[i].id}>" class="col-33 selective-item">
						<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/hm.gif" data-original="<{tiny.tomedia(_recommends[i].logo)}>" class="lazyload lazyload-store" alt="">
						<p class="selective-title"><{_recommends[i].title}></p>
					</a>
				<{# } }>
				<div class="clearfix"></div>
			</div>
		</div>
	<{# } }>
	<div class="buttons-tab select-tab">
		<a href="javascript:;" class="button">商家分类 <span class="icon"></span></a>
		<div class="drop-menu-list">
			<div class="list-block">
				<ul>
					<li><a class="list-button item-link border-1px-tb" href="">全部</a></li>
					<{# var _categorys = d.categorys}>
					<{# if(_categorys) { }>
						<{# for(var i = 0, len = _categorys.length; i < len; i++) { }>
							<li><a class="list-button item-link border-1px-b" href="<{_categorys[i].link}>"><{_categorys[i].title}></a></li>
						<{# } }>
					<{# } }>
				</ul>
			</div>
		</div>
		<a href="javascript:;" class="button">智能排序 <span class="icon"></span></a>
		<div class="drop-menu-list">
			<div class="list-block">
				<ul>
					<li><a class="list-button item-link border-1px-tb" href="<?php  echo imurl('wmall/home/search', array('order' => ''));?>"><span class="icon"></span>全部</a></li>
					<{# var _orderbys = d.orderbys}>
					<{# for(var i in _orderbys) { }>
						<li><a class="list-button item-link border-1px-b"  href="<?php  echo imurl('wmall/home/search');?>&order=<{_orderbys[i].key}>"><span class="<{_orderbys[i].css}>"></span><{_orderbys[i].title}></a></li>
					<{# } }>
				</ul>
			</div>
		</div>
		<a href="javascript:;" class="button">优惠活动 <span class="icon"></span></a>
		<div class="drop-menu-list">
			<div class="list-block">
				<ul>
					<li><a class="list-button item-link border-1px-tb" href="<?php  echo imurl('wmall/home/search', array('dis' => ''));?>"><span class="icon"></span>全部</a></li>
					<{# var _discounts = d.discounts}>
					<{# for(var i in _discounts) { }>
						<li><a class="list-button item-link border-1px-b" href="<?php  echo imurl('wmall/home/search');?>&dis=<{_discounts[i].key}>"><span class="<{_discounts[i].css}>"></span><{_discounts[i].title}></a></li>
					<{# } }>
				</ul>
			</div>
		</div>
	</div>
	<div class="store-list lazyload-container" id="store-list">
		<{# var _stores = d.stores;}>
		<{# if(!_stores || _stores.length <= 0) { }>
			<div class="common-no-con">
				<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/store_no_con.png" alt="" />
				<p>附近没有发现门店,我们正在努力覆盖中</p>
				<a href="<?php  echo imurl('wmall/home/location')?>" class="btn-location">切换地址</a>
			</div>
		<{# } else { }>
			<{# for(var i = 0, len = _stores.length; i < len; i++){ }>
			<div class="no-dist list-item border-1px-t" <{# if(_stores[i].is_rest == 1){ }>style="opacity: 0.3;"<{#}}> data-lat="<{_stores[i].location_x}>" data-lng="<{_stores[i].location_y}>">
				<a href="<{_stores[i].url}>">
					<div class="store-info row no-gutter">
						<div class="store-img col-25">
							<{# if(_stores[i].label_cn){ }>
							<span class="store-label" style="background-color: <{_stores[i].label_color}>"><{_stores[i].label_cn}></span>
							<{# } }>
							<img src="<?php echo WE7_WMALL_TPL_URL;?>static/img/hm.gif" class="lazyload lazyload-store" data-original="<{tiny.tomedia(_stores[i].logo)}>"  style="background: url('') center center no-repeat;">
							<{# if(_stores[i].is_rest == 1){ }>
							<div class="order-status">
								<span>店铺休息中</span>
							</div>
							<{# } }>
						</div>
						<div class="col-75">
							<div class="row no-gutter">
								<div class="col-60 text-ellipsis">
									<{_stores[i].title}>
								</div>
								<div class="money-info text-right">
									<{# if(_stores[i].token_status == '1'){ }>
									<span>券</span>
									<{# } }>
									<{# if(_stores[i].invoice_status == '1'){ }>
									<span>票</span>
									<{# } }>
									<span>付</span>
								</div>
							</div>
							<div class="rel-info">
								<div class="row no-gutter">
									<div class="col-60">
										<div class="star-rank">
											<span class="star-rank-outline">
												<span class="star-rank-active" style="width:<{_stores[i].score_cn}>%"></span>
											</span>
											<span class="sailed">
												月售 <{_stores[i].sailed}>
											</span>
										</div>
									</div>
									<{# if(_stores[i].delivery_mode == 2){ }>
									<div class="plateform-delivery"><span><?php  echo $_config_mall['delivery_title'];?></span></div>
									<{# } }>
								</div>
								<div class="delivery-conditions">
									起送<span class="color-danger">￥<{_stores[i].send_price}></span><span class="pipe">|</span><!--配送<span class="color-danger">￥<{_stores[i].delivery_price}></span><span class="pipe">|</span>-->约<span class="color-danger"><{_stores[i].delivery_time}>分钟</span>
									<div class="distance <{#if(!_stores[i].distance) {}>hide<{# } }>" data-in-business-hours="<{# if(_stores[i].is_in_business_hours){ }>1<{# } else { }>100000000<{# } }>"><i class="icon icon-lbs"></i><{_stores[i].distance}>km</div>
								</div>
							</div>
						</div>
					</div>
				</a>
				<div class="activity-containter">
					<{# var num = 0; }>
					<{# if(_stores[i].activity.num > 0){ }>
						<div class="dashed-line"></div>
						<div class="peisong"><img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/peisong.png" alt="" /><span>配送费<{_stores[i].delivery_price}>元</span></div>
						<{# if(_stores[i].activity.num > 2){ }>
							<div class="activity-num"><i class="icon icon-arrow-down"></i></div>
						<{# } }>
						<{# for(var j in _stores[i].activity['items']){ }>
							<{# num++ }>
							<{# var item = _stores[i].activity['items'][j]; }>
							<div class="<{item.type}> <{# if(num > 2){ }>activity-row hide<{# } }>"> <{item.title}></div>
						<{# } }>
					<{# } }>
				</div>
			</div>
			<{# } }>
		<{# } }>
	</div>
</script>

<script id="tpl-searchbar" type="text/html">
	<div class="fiexd-searchbar">
		<a class="search-block" href="<?php  echo imurl('wmall/home/hunt');?>">
			<i class="icon icon-search"></i><!--输入商家、商品名称-->
		</a>
		<div class="buttons-tab select-tab fixed-select-tab" style="display: none;">
			<a href="javascript:;" class="button">商家分类 <span class="icon"></span></a>
			<div class="drop-menu-list">
				<div class="list-block">
					<ul>
						<li><a class="list-button item-link border-1px-tb" href="<?php  echo imurl('wmall/home/search', array('cid' => 0));?>">全部</a></li>
						<{# var _categorys = d.categorys}>
						<{# if(_categorys) { }>
							<{# for(var i = 0, len = _categorys.length; i < len; i++) { }>
								<li><a class="list-button item-link border-1px-b" href="<{_categorys[i].link}>"><{_categorys[i].title}></a></li>
							<{# } }>
						<{# } }>
					</ul>
				</div>
			</div>
			<a href="javascript:;" class="button">智能排序 <span class="icon"></span></a>
			<div class="drop-menu-list">
				<div class="list-block">
					<ul>
						<li><a class="list-button item-link border-1px-tb" href="<?php  echo imurl('wmall/home/search', array('order' => ''));?>"><span class="icon"></span>全部</a></li>
						<{# var _orderbys = d.orderbys}>
						<{# for(var i in _orderbys) { }>
							<li><a class="list-button item-link border-1px-b"  href="<?php  echo imurl('wmall/home/search');?>&order=<{_orderbys[i].key}>"><span class="<{_orderbys[i].css}>"></span><{_orderbys[i].title}></a></li>
						<{# } }>
					</ul>
				</div>
			</div>
			<a href="javascript:;" class="button">优惠活动 <span class="icon"></span></a>
			<div class="drop-menu-list">
				<div class="list-block">
					<ul>
						<li><a class="list-button item-link border-1px-tb" href="<?php  echo imurl('wmall/home/search', array('dis' => ''));?>"><span class="icon"></span>全部</a></li>
						<{# var _discounts = d.discounts}>
						<{# for(var i in _discounts) { }>
							<li><a class="list-button item-link border-1px-b" href="<?php  echo imurl('wmall/home/search');?>&dis=<{_discounts[i].key}>"><span class="<{_discounts[i].css}>"></span><{_discounts[i].title}></a></li>
						<{# } }>
					</ul>
				</div>
			</div>
		</div>
	</div>
</script>

<script type="text/javascript" src="//webapi.amap.com/maps?v=1.4.1&key=550a3bf0cb6d96c3b43d330fb7d86950"></script>
<script>
require(['tiny'], function(tiny){
	$('.content').on("scroll", function(){
		$('.content').scrollTop() >= 100 ? $('.fiexd-searchbar').show() : $('.fiexd-searchbar').hide();
		$('.content').scrollTop() >= 800 ? $('.fixed-select-tab').css('display', '-webkit-box') : $('.fixed-select-tab').css('display',' none');
	});

	$(document).on('click', '.activity-containter', function(){
		if($(this).hasClass('active')) {
			$(this).find('.activity-row').addClass('hide');
			$(this).find('.activity-num i').addClass('fa-arrow-down').removeClass('fa-arrow-up');
		} else {
			$(this).find('.activity-row').removeClass('hide');
			$(this).find('.activity-num i').addClass('fa-arrow-up').removeClass('fa-arrow-down');
		}
		$(this).toggleClass('active');
	});

	$(document).on('click', '.home .select-tab a.button', function(){
		var flag = false;
		if($(this).hasClass('button-active')) {
			flag = true;
		}
		$('.home .select-tab a.button').removeClass('button-active');
		$('.home .drop-menu-list').hide();
		if(!flag) {
			$(this).addClass('button-active');
			$(this).next('.drop-menu-list').show();
		}
	});

	$(document).on('click', '.slide .swiper-slide', function(){
		var url = $(this).data('link');
		if(!url) {
			return false;
		}
		location.href = url;
		return;
	});

	function getStoreList() {
		var params = {
			lat: $('#js-lat').html(),
			lng: $('#js-lng').html(),
			position: $('#position').html(),
			code: $('#spread_code').html()
		};
		if(!params.lat || !params.lng) {
			$('#store-list .geolocationing').addClass('hide');
			$('#store-list .geolocationfail').removeClass('hide');
			return false;
		} else {
			tiny.cookie.set('__lat', params.lat, 600);
			tiny.cookie.set('__lng', params.lng, 600);
			if(params.position) {
				tiny.cookie.set('__address', encodeURI(params.position), 600);
			}
		}

		$.post("<?php  echo imurl('wmall/home/index/data')?>", params, function(data){
			var result = $.parseJSON(data);
			if(result.message.error != 0) {
				$.toast(result.message.message);
				return false;
			}
			var spread = result.message.message.spread;
			var mall_title = result.message.message.config.title;
			if(spread && spread.errno == 0) {
				$.toptip(spread.nickname + '向您推荐了' + mall_title + ',快去下单吧!', 10000, 'success');
			}
			require(['laytpl', 'jquery.lazyload'], function(laytpl){
				var tplHome = $('#tpl-home').html();
				var tplSearchbar = $('#tpl-searchbar').html();
				laytpl(tplSearchbar).render(result.message.message, function(html){
					$('#fixed-searchbar-container').html(html);
				});
				laytpl(tplHome).render(result.message.message, function(html){
					$('#home-container').html(html);
					var memoryHeight = sessionStorage.getItem(pageId);
					$pageId.find('.content').scrollTop(parseInt(memoryHeight));

					$(".swiper-container.slide").swiper({
						autoplay: 3000,
						pagination: '.swiper-slide-pagination'
					});
					$(".swiper-container.headlines").swiper({
						autoplay: 2000,
						direction: 'vertical',
						spaceBetween: 8,
						pagination: ''
					});
					$('.swiper-container.category').swiper({
						pagination: '.swiper-category-pagination'
					});
					$("img.lazyload").lazyload({
						container: $('.content'),
						effect : 'fadeIn',
						threshold : 200
					});
				});
			});
		});
	}
	<?php  if(!$_GPC['lat'] && !$_GPC['__lat']) { ?>
		tiny.getLocation(function(location) {
			$('#js-lat').html(location.lat);
			$('#js-lng').html(location.lng);
			getStoreList();
		}, function(position){
			$('#position').html(position.address);
			tiny.cookie.set('__address', encodeURI(position.address), 600);
		}, function(){
			getStoreList();
		});
	<?php  } else { ?>
		getStoreList();
	<?php  } ?>
});
</script>
<?php  if(!empty($config['seniverse'])) { ?>
	<?php  echo $config['seniverse'];?>
<?php  } else { ?>
	<script>(function(T,h,i,n,k,P,a,g,e){g=function(){P=h.createElement(i);a=h.getElementsByTagName(i)[0];P.src=k;P.charset="utf-8";P.async=1;a.parentNode.insertBefore(P,a)};T["ThinkPageWeatherWidgetObject"]=n;T[n]||(T[n]=function(){(T[n].q=T[n].q||[]).push(arguments)});T[n].l=+new Date();if(T.attachEvent){T.attachEvent("onload",g)}else{T.addEventListener("load",g,false)}}(window,document,"script","tpwidget","//widget.seniverse.com/widget/chameleon.js"))</script>
	<script>
		tpwidget("init", {
			"flavor": "slim",
			"location": "WX4FBXXFKE4F",
			"geolocation": "enabled",
			"language": "zh-chs",
			"unit": "c",
			"theme": "chameleon",
			"container": "tp-weather-widget",
			"bubble": "disabled",
			"alarmType": "badge",
			"color": "#FFFFFF",
			"uid": "UE7850A8B2",
			"hash": "165ced0b9eb27b0b5cf87185cc28a3ec"
		});
		tpwidget("show");
	</script>
<?php  } ?>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>



