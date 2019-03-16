<?php defined('IN_IA') or exit('Access Denied');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no, viewport-fit=cover" />
    <link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/we7_wmall/static/css/swiper-3.4.2.min.css" />
    <?php  echo register_jssdk(false);?>
    <title>拼团详情页</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            -webkit-tap-highlight-color: transparent;
        }
        a:active {
            color: #333;
            appearance: none;
        }
        body {
            background-color: #f8f8f8;
        }
        .swiper-slide img {
            width: 100%;
        }
        .swiper-slide {
            font-size: 0;
        }

        .cell-bar {
            display: flex;
            display: -webkit-flex;
            align-items: center;
            -webkit-align-items: center;
            justify-content: space-between;
            -webkit-justify-content: space-between;
        }
        .cell-bar {
            padding: 5px 15px;
            background: -webkit-linear-gradient(left, #F94A02 , #FEBD4D); /* Safari 5.1 - 6.0 */
            background: -o-linear-gradient(right, #F94A02, #FEBD4D); /* Opera 11.1 - 12.0 */
            background: -moz-linear-gradient(right, #F94A02, #FEBD4D); /* Firefox 3.6 - 15 */
            background: linear-gradient(to right, #F94A02 , #FEBD4D); /* 标准的语法 */
        }
        .cell-left > div {
            display: inline-block;
        }
        .cell-left .member {
            font-size: 14px;
            color: #fff;
            border: 1px solid #fff;
            padding: 2px 4px;
            line-height: 1;
            border-radius: 2px;
            vertical-align: text-bottom;
        }
        .cell-left .price {
            color: #fff;
            vertical-align: text-bottom;
        }
        .price span {
            display: inline-block;
            vertical-align: baseline;
        }
        .price .unit {
            font-size: 12px;
            line-height: 1;
        }
        .price .now {
            font-size: 16px;
            line-height: 1;
        }
        .price .old {
            font-size: 12px;
            text-decoration: line-through;
        }
        .cell-right .title {
            font-size: 12px;
            color: #CB4E13;
            color: #fff;
            text-align: center;
        }
        .cell-right .time span {
            display: inline-block;
            vertical-align: middle;
            font-size: 12px;
            color: #fff;
        }
        .cell-right .time span.text {
            padding: 3px 2px;
            border-radius: 2px;
            line-height: 1;
            background-color: #FE8316;
        }
        .share-bar {
            display: flex;
            display: -webkit-flex;
            align-items: center;
            -webkit-align-items: center;
            justify-content: space-between;
            padding: 5px 15px;
            margin-bottom: 7px;
            background-color: #fff;
        }
        .share-bar .content {
            flex: 1;
            width: 0;
            margin-right: 10px;
            padding-right: 10px;
            border-right: 1px solid #999;
        }
        .share-bar .content .title {
            font-size: 14px;
            color: #212121;
        }
        .share-bar .content .subtitle {
            font-size: 14px;
            color: #7a7a7a;
        }
        .share-bar .icon img {
            width: 20px;
            height: 20px;
        }
        .share-bar .icon div {
            font-size: 12px;
            color: #7a7a7a;
            margin-top: 5px;
        }
        .limit {
            padding: 0 15px;
            margin-bottom: 7px;
            background-color: #fff;
        }
        .limit > div {
            padding: 5px;
        }
        .limit > div.activity-time {
            /* display: flex;
            display: -webkit-flex; */
            border-bottom: 1px solid #eee;
        }
        .limit > div.activity-time span:last-child {
            flex: 1;
            -webkit-flex: 1;
            -webkit-flex-wrap: nowrap;
        }
        .limit > div span {
            font-size: 12px;
            color: #7a7a7a;
        }
        .limit > div span:last-child {
            color: #A3C5C9;
        }
        .store-info {
            padding: 0 15px;
            margin-bottom: 7px;
            background-color: #fff;
        }
        .store-info .contact {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .cell-title {
            font-size: 14px;
            color: #7a7a7a;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .store-info .contact {
            display: flex;
            display: -webkit-flex;
            align-items: center;
            -webkit-align-items: center;
            justify-content: space-between;
            -webkit-justify-content: space-between;
        }
        .store-info .contact img.avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .store-info .contact img.phone {
            width: 20px;
            height: 20px;
            border-radius: none;
        }
        .store-info .info-text {
            flex: 1;
            -webkit-flex: 1;
            margin: 0 10px;
        }
        .store-info .info-text .name {
            font-size: 14px;
            color: #212121;
        }
        .store-info .info-text .time {
            font-size: 12px;
            color: #7a7a7a;
        }
        .location {
            padding: 10px 0;
        }
        .location {
            display: flex;
            display: -webkit-flex;
            align-items: center;
            -webkit-align-items: center;
            justify-content: space-between;
            -webkit-justify-content: space-between;
        }
        .location img {
            width: 24px;
            height: 24px;
        }
        .location > div {
            font-size: 14px;
            color: #212121;
            flex-basis: 100%;
            -webkit-flex-basis: 100%;
            margin: 0 10px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .rules {
            padding: 0 15px;
            background-color: #fff;
        }

        .rules-step {
            display: flex;
            display: -webkit-flex;
            padding: 10px 0;
            align-items: center;
            -webkit-align-items: center;
            justify-content: space-between;
            -webkit-justify-content: space-between;
            margin-bottom: 7px;
        }
        .rules-step .step {
            font-size: 12px;
            color: #7a7a7a;
        }
        .rules-step .step span, .rules-step .step > div {
            display: inline-block;
            vertical-align: baseline;
            text-align: center;
        }
        .rules-step .step.tip span,
        .rules-step .step.tip > div {
            vertical-align: middle;
        }
        .rules-step .order {
            width: 14px;
            height: 14px;
            text-align: center;
            line-height: 14px;
            border: 1px solid #7a7a7a;
            border-radius: 50%;
        }
        .other-info {
            padding: 0 15px;
            background-color: #fff;
        }
        .other-info > .cell-title {
            border-bottom: 0;
        }
        .main-content {
            padding-bottom: 100px;
        }
        .oparetion {
            display: flex;
            display: -webkit-flex;
            text-align: center;
            position: fixed;
            width: 100%;
            left: 0;
            bottom: 0;
        }
        .oparetion > div {
            padding: 5px 0;
            font-size: 14px;
            display: flex;
            display: -webkit-flex;
            flex-wrap: wrap;
            -webkit-flex-wrap: wrap;
            align-items: center;
            -webkit-align-items: center;
            align-content: space-around;
            justify-content: center;
            -webkit-justify-content: center;
            text-align: center;
        }
        .oparetion > div > div {
            flex-basis: 100%;
        }
        .oparetion .back {
            flex: 2;
            color: #7a7a7a;
            background-color: #fff;
        }
        .oparetion .back img {
            width: 20px;
            height: 20px;
        }
        .single {
            flex: 3;
            color: #fff;
            background-color: #FA9D06;
        }
        .oparetion .team {
            flex: 5;
            color: #fff;
            background-color: #A3C5C9;
        }
        .oparetion > div > div span {
            vertical-align: baseline;
        }
        .oparetion > div > div span:first-child {
            font-size: 12px;
        }
        .share-mask {
            width: 100%;
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 2;
            font-size: 0;
            padding: 15px;
            box-sizing: border-box;
            text-align: right;
            display: none;
        }
        .share-mask span {
            font-size: 16px;
            color: #fff;
            vertical-align: baseline;
            margin-right: 10px;
        }
        .share-mask img {
            width: 30px;
            vertical-align: baseline;
        }
    </style>
</head>
<body>
    <div class="page">
        <?php  if(!empty($goodsInfo['goods']['arr_img'])) { ?>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php  if(is_array($goodsInfo['goods']['arr_img'])) { foreach($goodsInfo['goods']['arr_img'] as $img) { ?>
                    <div class="swiper-slide"><img src="<?php  echo $img;?>"></div>
                <?php  } } ?>
                <!--<div class="swiper-slide"><img src="<?php  echo $_W['siteroot'];?>addons/we7_wmall/static/img/banner2.jpg"></div>-->
                <!--<div class="swiper-slide"><img src="<?php  echo $_W['siteroot'];?>addons/we7_wmall/static/img/banner3.jpg"></div>-->
            </div>
        </div>
        <?php  } ?>
        <div class="main-content">

            <div class="cell-bar">
                <div class="cell-left">
                    <div class="member"><?php  echo $goodsInfo['goods']['people'];?>人拼</div>
                    <div class="price">
                        <span class="unit">￥</span><span class="now"><?php  echo $goodsInfo['goods']['pt_price'];?></span>
                        <span class="old">￥<?php  echo $goodsInfo['goods']['y_price'];?></span>
                    </div>
                </div>
                <div class="cell-right">
                    <div class="title">距拼购结束还剩</div>
                    <div class="time">
                        <span class="text day">00</span>
                        <span>天</span>
                        <span class="text hour">00</span>
                        <span>:</span>
                        <span class="text minutes">00</span>
                        <span class="text second">00</span>
                    </div>
                </div>
            </div>
            <div class="share-bar">
                <div class="content">
                    <div class="title"><?php  echo $goodsInfo['goods']['name'];?></div>
                    <!-- <div class="subtitle">江山如画，一时多少豪杰。</div> -->
                </div>
                <div class="icon">
                    <img src="<?php  echo $_W['siteroot'];?>addons/we7_wmall/static/img/share.png" onclick="showMask()">
                    <div>分享</div>
                </div>
            </div>
            <div class="limit">
                <div class="end-time activity-time">
                    <span>活动开始时间：</span>
                    <span><?php  echo date('Y-m-d H:i:s', $goodsInfo['goods']['start_time'])?></span>
                </div>
                <div class="end-time">
                    <span>活动结束时间：</span>
                    <span><?php  echo date('Y-m-d H:i:s', $goodsInfo['goods']['end_time'])?></span>
                </div>
                <!-- <div class="activity-time">
                    <span>消费结束时间：</span>
                    <span><?php  echo date('Y-m-d H:i:s', $goodsInfo['goods']['end_time'])?></span>
                </div> -->
            </div>
            <div class="store-info">
                <div class="cell-title">适用店铺</div>
                <div class="contact">
                    <img class="avatar" src="<?php  echo $goodsInfo['goods']['logo'];?>">
                    <div class="info-text">
                        <div class="name"><?php  echo $goodsInfo['goods']['title'];?></div>
                        <?php  if(!empty($goods['arr_business_hours'])) { ?>
                        <div class="time">
                            营业时间：
                            <?php  if(is_array($goodsInfo['goods']['arr_business_hours'])) { foreach($goodsInfo['goods']['arr_business_hours'] as $v) { ?>
                                <?php  echo $v['s'];?> - <?php  echo $v['e'];?>
                            <?php  } } ?>
                        </div>
                        <?php  } ?>
                    </div>
                    <a href="tel:<?php  echo $goodsInfo['goods']['telephone'];?>">
                        <img class="phone" src="<?php  echo $_W['siteroot'];?>addons/we7_wmall/static/img/phone.png">
                    </a>
                </div>
                <div class="location">
                    <img src="<?php  echo $_W['siteroot'];?>addons/we7_wmall/static/img/location.png">
                    <div><?php  echo $goodsInfo['goods']['address'];?></div>
                    <img src="<?php  echo $_W['siteroot'];?>addons/we7_wmall/static/img/arrow-right.png">
                </div>
            </div>
            <div class="rules">
                <div class="cell-title">拼购玩法</div>
                <div class="rules-step">
                    <div class="step"><span class="order">1</span>开团/参团</div>
                    <div class="step">></div>
                    <div class="step"><span class="order">2</span>邀请好友</div>
                    <div class="step">></div>
                    <div class="step tip">
                        <span class="order">3</span>
                        <div class="tips">
                            <div>满员发货</div>
                            <div>(不满自动退款)</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="other-info">
                <div class="cell-title"><?php  echo $goodsInfo['goods']['details'];?></div>
            </div>
        </div>
        <div class="oparetion">
            <div class="back">
                <img src="<?php  echo $_W['siteroot'];?>addons/we7_wmall/static/img/back.png">
                <div>返回</div>
            </div>

                <div class="single">
                    <div><span>￥</span><span><?php  echo $goodsInfo['goods']['dd_price'];?></span></div>
                    <div>单独购买</div>
                </div>
                <!--<div class="team">-->
                    <!--<div><span>￥</span><span><?php  echo $goodsInfo['goods']['pt_price'];?></span></div>-->
                    <!--<div><?php  echo $goodsInfo['goods']['people'];?>人成团</div>-->
                <!--</div>-->
                <?php  if($status==1) { ?>
                    <div class="team">
                        <div><span>￥</span><span><?php  echo $goodsInfo['goods']['pt_price'];?></span></div>
                        <div>开团</div>
                    </div>
                <?php  } else if($status==2) { ?>
                    <div class="order" style="flex: 5;color: #fff;background-color: #A3C5C9;">
                        <div>还差<?php  echo $goods['people']-$group['yg_num']?>人成团</div>
                        <div>查看订单</div>
                    </div>
                <?php  } else if($status==3) { ?>
                    <div class="team">
                        <div><span>￥</span><span><?php  echo $goodsInfo['goods']['pt_price'];?></span></div>
                        <div>参团</div>
                    </div>
                <?php  } else if($status==4) { ?>
                    <div class="order" style="flex: 5;color: #fff;background-color: #A3C5C9;">
                        <div>查看订单</div>
                        <div>拼团成功</div>
                    </div>
                <?php  } ?>


        </div>
        <div class="share-mask" onclick="hideMask()">
            <span>请点击右上角分享</span>
            <img src="<?php  echo $_W['siteroot'];?>addons/we7_wmall/static/img/share-arrow.png">
        </div>
    </div>
    <script type='text/javascript' src="<?php  echo $_W['siteroot'];?>addons/we7_wmall/static/js/components/jquery/jquery-2.2.1.min.js"></script>
    <script type="text/javascript" src="<?php  echo $_W['siteroot'];?>addons/we7_wmall/static/js/swiper-3.4.2.jquery.min.js"></script>
    <script type="text/javascript">
        // 轮播
        var mySwiper = new Swiper('.swiper-container', {
            autoplay: 3000, //可选选项，自动滑动
            autoHeight: true,
            loop: true
        })
        // 倒计时
        function countDown(times){
            var timer=null;
            var now = Math.round(new Date().getTime()/1000)
            times = times - now
            timer=setInterval(function(){
            var day=0,
            hour=0,
            minute=0,
            second=0;//时间默认值
            if(times > 0){
                day = Math.floor(times / (60 * 60 * 24));
                hour = Math.floor(times / (60 * 60)) - (day * 24);
                minute = Math.floor(times / 60) - (day * 24 * 60) - (hour * 60);
                second = Math.floor(times) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
            }
            if (day <= 9) day = '0' + day;
            if (hour <= 9) hour = '0' + hour;
            if (minute <= 9) minute = '0' + minute;
            if (second <= 9) second = '0' + second;
            //
            // console.log(day+"天:"+hour+"小时："+minute+"分钟："+second+"秒");
            $('.day').html(day)
            $('.hour').html(hour)
            $('.minutes').html(minute)
            $('.second').html(second)
            times--;
            },1000);
            if(times<=0){
                clearInterval(timer);
            }
        }
        countDown("<?php  echo $goodsInfo['goods']['end_time'];?>") // 未来某个日期的时间戳
        // 显隐分享遮罩层
        function showMask() {
            $('.share-mask').show()
        }
        function hideMask() {
            $('.share-mask').hide()
        }

        function createOrder(type)
        {
            var url = "<?php  echo imurl('allgroupgoods/order/index', array('goods_id' => $goodsInfo['goods']['id']))?>&type=" + type;
            var group_id = "<?php  echo $_GPC['group_id'];?>";
            if(type == 2){
                url += '&group_id=' + group_id;
            }
            location.href=url;
            return;
            /* var data = {
                type:type,
                location_x: '<?php  echo $goodsInfo['goods']['location_x'];?>', 
                location_y:'<?php  echo $goodsInfo['goods']['location_y'];?>',
                goods_num:1,
                goods_id:'<?php  echo $goodsInfo['goods']['id'];?>',
            }
            $.ajax({
                type: "POST",
                url : "<?php  echo imurl('allgroupgoods/details/saveGroupOrder');?>",
                data: data,
                success: function(res){
                    flag = false
                    if(!res || res.resultCode != 0){
                        if(res.resultCode == 1){
                            alert(res.resultMessage);
                            location.href="<?php  echo imurl('wmall/auth/login', array('forward' => ''));?>";
                            return false;
                        }
                        alert(res.resultMessage);
                        return;
                    }
                    alert('拼团成功！');
                },
                error: function(){
                    alert('网络错误！');
                },
                dataType: "json"
            }); */
        }

        //单独购买
        $('.single').click(function(){
            createOrder(1);
        })

        //拼团
        $('.team').click(function(){
            createOrder(2)
        })

        //查看订单
        $('.order').click(function(){
            location.href="<?php  echo imurl('wmall/order/index/detail',array('id'=>$order_info['id'],'type'=>1));?>";
        })

        $('.back').click(function(){
            location.href="<?php  echo imurl('allgroupgoods/index');?>";
        })
    </script>

    <?php  echo register_jssdk(false);?>
    <script type="text/javascript">


        wx.ready(function () {
            sharedata = {
                title: '<?php  echo $wx_title;?>',
                desc: '<?php  echo $wx_desc;?>',
                link: '<?php  echo $shareUrl;?>',
                imgUrl: '<?php  echo $wx_imgUrl;?>',
                success: function(){

                },
                cancel: function(){
                    // alert("分享失败，可能是网络问题，一会儿再试试？");
                }
            };
            wx.onMenuShareAppMessage(sharedata);
            wx.onMenuShareTimeline(sharedata);
        });


    </script>

</body>
</html>