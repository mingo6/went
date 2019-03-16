<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<style>
.home .store-list .common-no-con{
	margin-top:-5rem;
	top:50%;
	position: absolute;
}
.home header.bar{
	background-color: #7da6e8;
}
</style>
<div class="page home search" id="page-app-store-search">
	<header class="bar bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<a class="pull-right" href="<?php  echo imurl('wmall/home/hunt');?>" style="display: none;">
			<i class="icon icon-search"></i>
		</a>
		<h1 class="title">砍价活动列表</h1>
	</header>

	<div class="content">
		<div class="hide bind-data" data-lat="22.606651" data-lng="114.059868" data-cid="<?php  echo $_GPC['cid'];?>" data-dis="<?php  echo $_GPC['dis'];?>" data-order="<?php  echo $_GPC['order'];?>"></div>
		<div id="search-container">
			<div class="store-list" id="store-list">
				<div class="common-no-con">
					<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/store_no_con.png" alt="" />
					<p>暂无数据!</p>
				</div>
			</div>
		</div>
		<?php  include itemplate('public/copyright', TEMPLATE_INCLUDEPATH);?>
	</div>
	<?php  get_mall_danmu();?>
</div>

<script type="text/html" id="tpl-search">
	<div class="buttons-tab select-tab">
		<a href="javascript:;" class="button">分类<span class="icon"></span></a>
		<div class="drop-menu-list">
			<div class="list-block">
				<ul>
					<li><a class="list-button item-link border-1px-tb" href="<?php  echo imurl('cutPrice/index')?>&type=<?php  echo $order_by_type;?>">全部</a></li>
					<?php  if(is_array($category)) { foreach($category as $item) { ?>
						<li>
							<a class="list-button item-link border-1px-b" href="<?php  echo imurl('cutPrice/index')?>&type_id=<?php  echo $item['id'];?>&type=<?php  echo $order_by_type;?>">
								<?php  echo $item['name'];?>
								<?php  if($item['id']==$type_id) { ?>
								<i class="icon icon-selected"></i>
								<?php  } ?>
							</a>
						</li>
					<?php  } } ?>
				</ul>
			</div>
		</div>

		<a href="javascript:;" class="button">排序<span class="icon"></span></a>
		<div class="drop-menu-list">
			<div class="list-block">
				<ul>
					<li><a class="list-button item-link border-1px-tb" href="<?php  echo imurl('cutPrice/index')?>&type_id=<?php  echo $type_id;?>"><span class="icon"></span>默认</a></li>
					<li>
						<a class="list-button item-link border-1px-b"  href="<?php  echo imurl('cutPrice/index')?>&type_id=<?php  echo $type_id;?>&type=s_price">
							<span class=""></span>
							价格
							<?php  if($order_by_type=="s_price") { ?>
							<i class="icon icon-selected"></i>
							<?php  } ?>
						</a>
					</li>
					<li>
						<a class="list-button item-link border-1px-b"  href="<?php  echo imurl('cutPrice/index')?>&type_id=<?php  echo $type_id;?>&type=sale_num">
							<span class=""></span>
							销量
							<?php  if($order_by_type=="sale_num") { ?>
							<i class="icon icon-selected"></i>
							<?php  } ?>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="store-list lazyload-container" id="store-list">
		<?php  if(empty($cutPrice_goods)) { ?>
			<div class="common-no-con">
				<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/store_no_con.png" alt="" />
				<p>暂无数据!</p>
			</div>
		<?php  } else { ?>
			<?php  if(is_array($cutPrice_goods)) { foreach($cutPrice_goods as $item) { ?>
			<div class="no-dist list-item border-1px-t" data-lat="22.606651" data-lng="114.059868">
				<a href="<?php  echo imurl('cutPrice/active',array('kid' => $item['id']))?>">
					<div class="store-info row no-gutter">
						<div class="store-img col-25">
							<img src="/attachment/<?php  echo $item['thumb'];?>" class="lazyload lazyload-store" data-original="" style="background: url('') center center no-repeat;">
							<?php  if($item['end_time']<time()) { ?>
							<div class="order-status">
								<span>活动已结束</span>
							</div>
							<?php  } ?>
						</div>
						<div class="col-75">
							<div class="row no-gutter">
								<div class="col-60 text-ellipsis">
									<?php  echo $item['name'];?>
								</div>
							</div>
							<div class="rel-info">
								<div class="row no-gutter">
								</div>
								<div class="delivery-conditions">
									原价<span class="color-danger">￥<?php  echo $item['y_price'];?></span><span class="pipe">|</span>最低价<span class="color-danger">￥<?php  echo $item['s_price'];?></span><span class="pipe">|</span>销量<span class="color-danger"><?php  echo $item['sale_num'];?></span>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<?php  } } ?>
		<?php  } ?>
	</div>
</script>

<script type="text/javascript" src="//webapi.amap.com/maps?v=1.4.1&key=550a3bf0cb6d96c3b43d330fb7d86950"></script>
<script>
$(function(){
	$(document).on('click', '.swiper-slide, .discount-item', function(){
		var url = $(this).data('link');
		if(!url) {
			return false;
		}
		location.href = url;
		return;
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

	$(document).on("pageInit", "#page-app-store-search", function(e, id, page) {
		var $this = $(page).find('.bind-data');
		var params = {
			lat: $this.data('lat'),
			lng: $this.data('lng'),
			dis: $this.data('dis'),
			cid: $this.data('cid'),
			order: $this.data('order')
		}
		if(!params.lat || !params.lng) {
			tiny.getLocation(function(location) {
				params.lat = location.lat;
				params.lng = location.lng;
				getStoreList();
			});
			return false;
		} else {
			getStoreList();
		}
		function getStoreList() {
			if(!params.lat || !params.lng) {
				$('#store-list .geolocationing').addClass('hide');
				$('#store-list .geolocationfail').removeClass('hide');
				return false;
			}
			$.post("<?php  echo imurl('wmall/home/search/list');?>", params, function(data){
				var result = $.parseJSON(data);
				if(result.message.error != 0) {
					$.toast(result.message.message);
					return false;
				}
				require(['laytpl', 'tiny', 'jquery.lazyload'], function(laytpl, tiny){
					var tplHome = $('#tpl-search').html();
					laytpl(tplHome).render(result.message.message, function(html){
						$('#search-container').html(html);
						var memoryHeight = sessionStorage.getItem(pageId);
						$pageId.find('.content').scrollTop(parseInt(memoryHeight));

						$(".swiper-container.slide").swiper({
							autoplay: 3000
						});
						$('#search-container').find("img.lazyload").lazyload({
							container: $('.lazyload-container'),
							effect : 'fadeIn',
							threshold : 200
						});
					});
				});
			});
		}
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>