<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<a id="href" href="<?php  echo imurl('errander/category/index');?>"></a>
<div class="page errander-index">
	<header class="bar bar-nav common-bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">跑腿</h1>
		<a class="pull-right" href="<?php  echo imurl('errander/order/list');?>">订单</a>
	</header>
	<?php  get_mall_menu()?>
	<div class="content">
		<div class="border-1px-t">
			<div class="comindex-main">
				<div class="com-cate-type-list-box">
					<div class="com-cate-type-list">
						<div class="com-cate-type-li active" id="0" data-type="pickup">废品回收</div>
						<div class="com-cate-type-li" id="1" data-type="delivery">家电维修</div>
						<div class="com-cate-type-li" id="2" data-type="buy">家政服务</div>
						<div class="com-cate-type-li" id="3" data-type="errand">社区跑腿</div>
					</div>
				</div>
				<div class="com-map" id="com-map"></div>
				<?php  if(!empty($orders)) { ?>
					<!--<div class="com-status">-->
						<!--<div class="swiper-container" data-direction="vertical" data-space-between="100" data-autoplay="2000">-->
							<!--<div class="swiper-wrapper">-->
								<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
									<!--<div class="swiper-slide">-->
										<!--<a href="<?php  echo imurl('errander/category/index', array('id' => $order['order_cid']));?>">-->
											<!--<img src="<?php  echo tomedia($order['thumb']);?>">-->
											<?php  echo $order['anonymous_username'];?>购买了<?php  echo $order['goods_name'];?>
											<!--<i class="icon icon-arrow-right"></i>-->
										<!--</a>-->
									<!--</div>-->
								<?php  } } ?>
							<!--</div>-->
						<!--</div>-->
					<!--</div>-->
				<?php  } ?>
				<div class="com-cate">
					<p class="com-cate-title">平台共有<span class="color-danger"><?php  echo $delivery_num;?></span>位骑士为您服务</p>
					<div class="com-cate-list-box">
						<ul class="com-cate-list">

						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
require([we7_wmall.pluginStaticRoot + 'index.js'], function(index){
	index.init({
		map: {
			location_y: "<?php  echo $_config_plugin['map']['location_y'];?>",
			location_x: "<?php  echo $_config_plugin['map']['location_x'];?>"
		}
	});
});
// 类型列表切换
$('.com-cate-type-list .com-cate-type-li').click(function(){
	if(!$(this).hasClass('active')){
		for (var i = 0; i < $('.com-cate-type-list .com-cate-type-li').length; i++) {
			if($('.com-cate-type-list .com-cate-type-li').eq(i).hasClass('active')){
				$('.com-cate-type-list .com-cate-type-li').eq(i).removeClass('active')
			}
		}
		$(this).addClass('active')
		// id为类型id，get_cate_list是获取该类型对应的列表
		get_cate_list($(this).attr('data-type'))
	}
})

function get_cate_list(type){
    $.ajax({
        url: '<?php  echo $ajax_url;?>',
        type: 'GET',
        data: { type: type },
        dataType:'json',
        success: function(res) {
            if(res.status == 1){
                var html = ''
                for (var i = 0; i < res.data.length; i++) {
                    html += '<li>'
                    html += 	'<img src="/attachment/' + res.data[i].thumb + '" alt="" style="width: 10px;height: 10px;">'

                    html += 	'<span>价格:' + res.data[i].start_fee + '起</span><br>'
                    html += 	'<a href="' + $('#href').attr('href') + '&id=' + res.data[i].id + '">' + res.data[i].title + '</a>'
                    // <img src="<?php  echo tomedia($category['thumb']);?>" alt="">
                    html += '</li>'
                }
            }else{
                var html = '<div>暂无数据！</div>'
			}
            $('.com-cate-list').html(html)
        }
    })
}

get_cate_list($('.com-cate-type-list .com-cate-type-li.active').attr('data-type'));


// function get_cate_list(id){
// 	$.ajax({
// 		url: '',
// 		type: 'GET',
// 		data: { id: id },
// 		dataType:'json',
// 		success: function(res) {
// 			if(res.status == 1){
// 				var html = ''
// 				for (var i = 0; i < res.data.length; i++) {
// 					html += '<li>'
// 					html += 	'<a href="' + $('#href').attr('href') + '&id=' + res.data[i].id + '">' + res.data[i].title + '</a>'
// 					// <img src="<?php  echo tomedia($category['thumb']);?>" alt="">
// 					html += '</li>'
// 				}
// 				$('.com-cate-list').html(html)
// 			}
// 			// else{
// 			// 	if(res.msg){
//    //          		alert(res.msg)
//    //          	}else{
//    //          		alert('网络异常！')
//    //          	}
// 			// }
// 		},
// 		// error: function(e) {
// 		// 	alert("网络异常！")
// 		// }
// 	})
// }
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>