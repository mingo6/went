<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page rush-to-buy-detail">
	<header class="bar bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title"><?php  echo $_W['page']['title'];?></h1>
	</header>
	<form action="<?php  echo imurl('wmall/order/create/goods', array('sid' => $goods_info['sid']));?>" method="post" id="goods-form">
		<div class="content">
			<div class="swiper-container-box">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<img src="/attachment/<?php  echo $goods_info['thumb'];?>">
						</div>
					</div>
					<div class="swiper-pagination"></div>
				</div>
				<script type="text/javascript">
                    $(".swiper-container").swiper({
                        autoplay: 4500,
                        speed: 500,
                    });
				</script>
			</div>
			<div class="rush-to-buy-detail-title"><?php  echo $_W['page']['title'];?></div>
			<div class="time-box">
				<div class="btn">限时特惠</div>
				<div class="status">抢购中</div>
				<div class="progress">
					<div class="time daijishi" id="daijishi"><?php  echo $date_time_text;?>
						<div class="icon">0</div>
						<div>天</div>
						<div class="icon">0</div>
						<div>:</div>
						<div class="icon">0</div>
						<div>:</div>
						<div class="icon">0</div>
					</div>
					<div class="number-box">
						<div class="number">仅剩<?php  echo $goods_info['surplus'];?>份，总<?php  echo $goods_info['number'];?>份</div>
					</div>
				</div>
			</div>
			<div class='price-follow flex_end'>
				<div>
					<span class="dis-price">￥<?php  echo $goods_info['s_price'];?></span>
					<span class="price"><?php  echo $goods_info['y_price'];?>元</span>
				</div>
				<div class="follow" style="display: none;"><img src="../addons/we7_wmall/plugin/secondKill/static/img/degree_of_heat.png">1人关注</div>
			</div>
			<div class='buy flex_end no'>
				<div class="buy-title">抢购时间</div>
				<div class="buy-time"><?php  echo date("m-d H:i:s",$goods_info['start_time'])?>至<?php  echo date("m-d H:i:s",$goods_info['end_time'])?></div>
			</div>
			<div class="blank10"></div>
			<div class='explain flex_end'>
				<div class="explain-title">商品简介</div>
			</div>
			<div class='number-box flex_end no'>
				<div class="number-title"><?php  echo $goods_info['introduction'];?></div>
			</div>
			<div class="blank10"></div>
			<div class='explain flex_end'>
				<div class="explain-title">店铺</div>
			</div>
			<div class="store_info flex_end">
				<div class="img_content" onclick="goStore(<?php  echo $goods_info['sid'];?>)">
					<div class="img">
						<img src="/attachment/<?php  echo $store_info['logo'];?>">
					</div>
					<div class="img_content_content">
						<div><?php  echo $store_info['title'];?></div>
						<!--<div class="time">营业时间：8:20-12:00 13:00-23:00</div>-->
					</div>
				</div>
				<div class="tel">
					<a href="tel:<?php  echo $store_info['telephone'];?>">
						<img src="../addons/we7_wmall/plugin/secondKill/static/img/phone_color.png">
					</a>
				</div>
			</div>
			<div class="location-box flex_end no">
				<div class="location"><img src="../addons/we7_wmall/plugin/secondKill/static/img/location.png"><?php  echo $store_info['address'];?></div>
				<div class="right"><img src="../addons/we7_wmall/plugin/secondKill/static/img/right_ccc.png"></div>
			</div>
			<div class="blank10"></div>
			<div class='liucheng flex_end'>
				<div class="liucheng-title">抢购流程</div>
			</div>
			<div class="liucheng-list">
				<div class="liucheng-list-li color1">
					<div class="img"><img src="../addons/we7_wmall/plugin/secondKill/static/img/participate_in.png"></div>
					<div class="txt">参与抢购</div>
				</div>
				<div class="jiange"></div>
				<div class="liucheng-list-li color2">
					<div class="img"><img src="../addons/we7_wmall/plugin/secondKill/static/img/payment.png"></div>
					<div class="txt">付款成功</div>
				</div>
				<div class=jiange></div>
				<div class="liucheng-list-li color3">
					<div class="img"><img src="../addons/we7_wmall/plugin/secondKill/static/img/verify.png"></div>
					<div class="txt">配送签收</div>
				</div>
			</div>
			<div class="blank10"></div>
			<div class='hint flex_end'>
				<div class="hint-title">购买须知</div>
			</div>
			<div class="hint-list">
				<div class="hint-list-li">
					<div class="hint-list-li-icon"></div>
					<div class="hint-list-li-title">商品限购：</div>
					<div class="hint-list-li-explain">每人限购1份</div>
				</div>
			</div>
			<div class="blank10"></div>
			<div class='store-detail flex_end'>
				<div class="store-detail-title">商品详情</div>
			</div>
			<div class='store-detail-txt flex_end no'><?php  echo $goods_info['details'];?></div>
			<div class="blank10"></div>
		</div>


		<div class="shortcut-key-screen">
			<div class="shortcut-key-screen-li">
				<a href="">
					<div class="img"><img src="../addons/we7_wmall/plugin/secondKill/static/img/home.png"></div>
					<div class="txt">首页</div>
				</a>
			</div>
			<div class="shortcut-key-screen-li">
				<a href="">
					<div class="img"><img src="../addons/we7_wmall/plugin/secondKill/static/img/dingdan2.png"></div>
					<div class="txt">订单</div>
				</a>
			</div>
			<div class="shortcut-key-screen-li">
				<a href="">
					<div class="img"><img src="../addons/we7_wmall/plugin/secondKill/static/img/my.png"></div>
					<div class="txt">我的</div>
				</a>
			</div>
		</div>

		<div class="black-screen"></div>
		<div class="shortcut-key" style="display: none;">快捷导航<div class="close"><img src="../addons/we7_wmall/plugin/secondKill/static/img/close.png"></div></div>
		<script type="text/javascript">
            $('.shortcut-key').click(function(){
                if($('.shortcut-key .close').css('display') == 'none'){
                    $('.shortcut-key .close').show();
                    $('.black-screen').show();
                    $('.shortcut-key-screen').show();
                }else{
                    $('.shortcut-key .close').hide();
                    $('.black-screen').hide();
                    $('.shortcut-key-screen').hide();
                }
            })
		</script>

		<div class="lrt-tab">
			<div class="lrt-tab-li">
				<a href="javascript:goStore(<?php  echo $goods_info['sid'];?>);">
					<img src="../addons/we7_wmall/plugin/secondKill/static/img/store.png">
					<div class="txt">店铺</div>
				</a>
			</div>
			<div class="lrt-tab-li">
				<a href="tel:<?php  echo $store_info['telephone'];?>">
					<img src="../addons/we7_wmall/plugin/secondKill/static/img/phone.png">
					<div class="txt">联系</div>
				</a>
			</div>
			<div class="lrt-tab-li">
				<a href="javascript:goOrder(<?php  echo $order_id;?>);">
					<img src="../addons/we7_wmall/plugin/secondKill/static/img/dingdan.png">
					<div class="txt">订单</div>
				</a>
			</div>
			<div class="lrt-tab-li-2">
				<input type="hidden" name="goods" value="<?php  echo $goodsInfo;?>"/>
				<?php  if($status==1) { ?>
				<input type="submit" value="立即抢购">
				<?php  } else { ?>
				<input type="button" value="<?php  echo $status_text;?>" style="color: white;background-color: #A9A9A9;">
				<?php  } ?>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
    // require(['../addons/we7_wmall/plugin/errander/static/js/index.js'], function(res){
    // 	res.init({
    // 		map: {
    // 			location_y: "<?php  echo $_config_plugin['map']['location_y'];?>",
    // 			location_x: "<?php  echo $_config_plugin['map']['location_x'];?>"
    // 		}
    // 	});
    // });


    /* 活动结束时间 */
    var endTimeJieshu = <?php echo $status==0?$goods_info['start_time']:$goods_info['end_time']?>;
    var startTimeKaishi = <?php  echo time();?>;

    /*结束时间 年*/
    var year = <?php  echo $year;?>;
    /*结束时间 月*/
    var yue = <?php  echo $month;?>;
    /*结束时间 日*/
    var date = <?php  echo $day;?>;
    /*结束时间 时*/
    var shi = <?php  echo $hours;?>;
    /*结束时间 分*/
    var fen = <?php  echo $minutes;?>;


    var timeDiff = null;
    function ShowCountDown(l, k, n, e, d, h) {
        var b = new Date();
        var c = new Date(endTimeJieshu * 1000).getTime();
        var j = new Date(startTimeKaishi * 1000).getTime();
        if (timeDiff == null) {
            timeDiff = b.getTime() - j
        }
        var a = c - b.getTime() + timeDiff;
        var c = new Date(l, k - 1, n, e, d);
        var q = parseInt(a / 1000);
        var p = Math.floor(q / (60 * 60 * 24));
        var f = Math.floor((q - p * 24 * 60 * 60) / 3600);
        var g = Math.floor((q - p * 24 * 60 * 60 - f * 3600) / 60);
        var i = Math.floor(q - p * 24 * 60 * 60 - f * 3600 - g * 60);
        var m = document.getElementById(h);
        // var o = $("#wo").text();
        $(m).html('<?php  echo $date_time_text;?><div class="icon">' + p + "</div><div>天</div><div class=\"icon\">" + f + "</div><div>时</div><div class=\"icon\">" + g + "</div><div>分</div><div class=\"icon\">" + i + "</div>秒");

        if (p == 0 && f == 0 && g == 0 && i == 0) {
            if (<?php  echo $status;?>==0){
                clearInterval(qingchuTime);
                $("#daijishi").text("活动已结束")
            }else{
                window.location.reload();
            }
        }
        if (p < 0 || f < 0 || g < 0) {
            // window.location.reload();
            $("#daijishi").text("当前状态：活动已结束")
        }
    }

    if ($(".daijishi").get(0)) {
        var interval = 1000;
        var dqDate = new Date(), dqyear = dqDate.getFullYear(), dqmonth = dqDate.getMonth() + 1, dqdate = dqDate.getDate(), dqhoutes = dqDate.getHours(), dqMinutes = dqDate.getMinutes(), dqseconds = dqDate.getSeconds();

        if ( dqyear > year || (dqyear == year && dqmonth > yue) || (dqyear == year && dqmonth == yue && dqdate > date) || (dqyear == year && dqmonth == yue && dqdate == date && dqhoutes > shi) || (dqyear == year && dqmonth == yue && dqdate == date && dqhoutes == shi && dqMinutes > fen)) {
            $("#daijishi").text("活动时间已结束")
        } else {
            var qingchuTime = window.setInterval(function () {
                ShowCountDown(year, yue, date, shi, fen, "daijishi")
            }, interval)
        }
    }

    //订单
    function goOrder(id){
        if (id!=0){
            window.location.href = "<?php  echo imurl('wmall/order/index/detail')?>&id="+id;
        }else{
            alert("您还未下单！");
        }
    }

    //商户
    function goStore(id){
        window.location.href = "<?php  echo imurl('wmall/store/goods')?>&sid="+id;
    }


</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>