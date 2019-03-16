<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<style type="text/css">
	.home .slide.swiper-container{height: 8.5rem;padding: 0 0 .5rem;}
	.home .search{position: absolute;background: none;display: flex;justify-content: space-between;align-items: center;}
	.home .search .search-inner{background: rgba(0,0,0,0.4);border-radius:.7rem;top:50%;margin-top: -.7rem;right:1rem;left:auto;width:1.4rem;height:1.4rem}
	.home .search .icon-lbs-fill{float: none;margin-top:0;margin-left:.15rem;vertical-align: top;}
	.home .search .external{background: none;-webkit-text-fill-color:#fff;margin-left: 0.4rem;text-overflow:ellipsis;}
	.zhishi{position: absolute;font-size: 1.2rem;margin-left: 0.5rem;}
	.zhishi img{width:14px;height:14px;margin-top: -1px;vertical-align:middle;}
	.home .search-block{background: rgba(0,0,0,0.4);height: 1.4rem;line-height:1.4rem;border-radius:.7rem;text-align:left;padding:0 .7rem 0 .5rem;color: #fff;width:auto;font-size: 0.7rem;margin-top:0.7rem;margin-left:10%;}
	.home .search-block .icon-search{color: #fff;font-size: 0.8rem;margin-top:-.05rem;margin-right:.3rem;}
	.home .fiexd-searchbar{background: none;}
	.peisong{margin: .3rem .5rem 0 .5rem;color: #808080;font-size: .55rem;max-width: 90%;}
	.peisong img{width: 0.75rem;margin-right: 0.2rem;margin-bottom: -0.15rem;}
	.peisong span{position: absolute;}
	.home .store-list .store-info{padding-bottom: 0;}
	.home .star-rank{margin-top:.15rem;}
	.home .delivery-conditions{margin-top: .25rem;}
	.footmark-warpper{bottom:3.2rem;}
	.home .store-list .common-no-con{margin-top:-5rem;top:50%;position:absolute;}
	.home header.bar{background-color: #7da6e8;}
	.position-box{position: fixed;bottom:6rem;right: 1rem;z-index: 10001;text-align: center;}
	.position-box a{display: block;width: 2rem;height: 2rem;border-radius: 100%;border: 1px solid #999;background-color: rgba(255,255,255,0.8);margin-bottom: 0.2rem;}
	.position-box a .icon{font-size: 1rem;line-height: 2rem;color: #666;}
	.swiper-container{height:8rem;padding-bottom:0;}
	.swiper-container img{width:100%;height:100%;}
	.errander-index .com-title-list{padding-top:.9rem;}
</style>
<div class="page errander-index home" id="page-app-index">
	<span id="js-lat" class="hide"><?php  if(!empty($_GPC['lat'])) { ?><?php  echo $_GPC['lat'];?><?php  } else { ?><?php  echo $_GPC['__lat'];?><?php  } ?></span>
	<span id="js-lng" class="hide"><?php  if(!empty($_GPC['lng'])) { ?><?php  echo $_GPC['lng'];?><?php  } else { ?><?php  echo $_GPC['__lng'];?><?php  } ?></span>
	<span id="spread_code" class="hide"><?php  echo $_GPC['code'];?></span>
	<header class="bar bar-nav common-bar-nav">
		<h1 class="title">生活服务</h1>
		<a class="pull-right" href="<?php  echo imurl('errander/order/list');?>">订单</a>
	</header>
	<?php  get_mall_menu();?>
	<div class="content">
		<?php  if(!empty($slides)) { ?>
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php  if(is_array($slides)) { foreach($slides as $slide) { ?>
				<div class="swiper-slide">
					<img src="<?php  echo tomedia($slide['thumb'])?>" alt="">
				</div>
				<?php  } } ?>
			</div>
			<div class="swiper-pagination"></div>
		</div>
		<script type="text/javascript">
            $(".swiper-container").swiper({
                autoplay: 4500,
                speed: 500,
            });
		</script>
		<?php  } ?>
		<div class="com-title-list">
			<?php  if(is_array($categorys)) { foreach($categorys as $index => $item) { ?>
			<div class="com-title-item" id="<?php  echo $index;?>" onclick="goCatyegoryOrder(<?php  echo $item['id'];?>)">
				<img src="<?php  echo tomedia($item['thumb']);?>">
				<div><?php  echo $item['errander_name'];?></div>
			</div>
			<?php  } } ?>
		</div>
		<div class="com-cate-list-title">推荐商户</div>
		<div id="home-container"></div>
		<?php  include itemplate('public/copyright', TEMPLATE_INCLUDEPATH);?>
	</div>
	<?php  get_mall_danmu();?>
</div>
<?php  get_mall_superRedpacket();?>

<script id="tpl-home" type="text/html">


	<div class="store-list lazyload-container" id="store-list">
		<{# var _stores = d.stores;}>
		<{# if(!_stores || _stores.length <= 0) { }>
		<div class="common-no-con">
			<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/store_no_con.png" alt="" />
			<p>附近没有推荐商户,我们正在努力覆盖中</p>
			<a href="<?php  echo imurl('wmall/home/location')?>" class="btn-location">切换地址</a>
		</div>
		<{# } else { }>
		<{# for(var i = 0, len = _stores.length; i < len; i++){ }>
		<div class="no-dist list-item border-1px-t" <{# if(_stores[i].is_rest == 1){ }>style="opacity: 0.3;"<{#}}> data-lat="<{_stores[i].location_x}>" data-lng="<{_stores[i].location_y}>">
		<a href="<{_stores[i].url}>">
			<div class="store-info row no-gutter">
				<div class="store-img col-25">
					<{# if(_stores[i].label_cn){ }>
					<span class="store-label" style="background-color:<{_stores[i].label_color}>"><{_stores[i].label_cn}></span>
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
							<!-- <div class="plateform-delivery"><span><?php  echo $_config_mall['delivery_title'];?></span></div> -->
							<{# } }>
						</div>
						<div class="delivery-conditions">
							起送<span class="color-danger">￥<{_stores[i].send_price}></span><span class="pipe">|</span>配送<span class="color-danger">￥<{_stores[i].delivery_price}></span><!-- <span class="pipe">|</span>约<span class="color-danger"><{_stores[i].delivery_time}>分钟</span> -->
							<div class="distance <{#if(!_stores[i].distance) {}>hide<{# } }>" data-in-business-hours="<{# if(_stores[i].is_in_business_hours){ }>1<{# } else { }>100000000<{# } }>"><i class="icon icon-lbs"></i>
								<{# if(_stores[i].distance < 1){ }>
								<{_stores[i].distance * 1000}>m
								<{# } }>

								<{# if(_stores[i].distance <= 10 & _stores[i].distance >= 1){ }>
								<{_stores[i].distance.toFixed(1)}>km
								<{# } }>

								<{# if(_stores[i].distance > 10){ }>
								<{_stores[i].distance.toFixed()}>km
								<{# } }>

								<{# if(isNaN(_stores[i].distance)){ }>
								<{_stores[i].distance}>
								<{# } }>
							</div>
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


<script type="text/javascript" src="//webapi.amap.com/maps?v=1.4.1&key=550a3bf0cb6d96c3b43d330fb7d86950"></script>
<script>

    function goCatyegoryOrder(id) {
		window.location.href = "<?php  echo imurl('errander/category');?>&id="+id;
    }

    require(['tiny'], function(tiny){
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
                tiny.cookie.set('__lat', params.lat, 7200);
                tiny.cookie.set('__lng', params.lng, 7200);
                if(params.position) {
                    tiny.cookie.set('__address', encodeURI(params.position), 7200);
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

                    laytpl(tplHome).render(result.message.message, function(html){

                        $('#home-container').html(html);
                        var memoryHeight = sessionStorage.getItem(pageId);
                        $pageId.find('.content').scrollTop(parseInt(memoryHeight));


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
            tiny.cookie.set('__address', encodeURI(position.address), 7200);
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