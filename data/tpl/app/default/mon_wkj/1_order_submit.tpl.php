<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <title></title>
    <link rel="stylesheet" type="text/css"
          href="<?php echo MON_WKJ_RES;?>css/admin.css">
    <script type="text/javascript">var _speedMark = new Date(), _loadTime = '';</script>


    <script type="text/javascript">
        <?php  if($orderInfo['status']==$this::$KJ_STATUS_XD) { ?>
        //调用微信JS api 支付
        function jsApiCall() {

            WeixinJSBridge.invoke(
                    'getBrandWCPayRequest',
            <?php  echo $jsApiParameters; ?>,
            function (res) {
               // WeixinJSBridge.log(res.err_msg);
                if(res.err_msg == "get_brand_wcpay_request:ok" ) {

                    $("#btn_zf_div").html('<a class="bottombtn" href="javascript:;" ><span>已支付</span> </a>');

                } else{
                    //alert(res.err_code+res.err_desc+res.err_msg);
                }


            });
        }

        function callpay() {

            if (typeof WeixinJSBridge == "undefined") {
                if (document.addEventListener) {
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                } else if (document.attachEvent) {
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            } else {
                jsApiCall();
            }
        }

        <?php  } ?>
    </script>

    <style>
    .bottombtn {
    text-shadow: 1px 1px 0 rgba(150,33,139,.3),1px 1px 5px rgba(150,33,139,.5);
    color: #f7f7f7;
    font-weight: bold;
    display: block;
    text-align: center;
    padding: 13px 0;
    font-size: 20px;
    background-color: #D23B3E;
    border-radius: 6px;
    }

     .mdaijishi {
        padding: 10px 0 10px 12px;
        color: #FFF;
        font-size: 16px;
        vertical-align: middle;
        background-color: #5f6a7c;
    }
    .dingdan{
        padding: 5px;
    }

    h3 a {
        color: #FFF
    }
    </style>
</head>
<body class="order">
<div class="mdaijishi"><?php  echo $wkj['title'];?>砍价活动</div>

<div class="dingdan gyStyle2">

    <h3 style="background-size: 100%;"><a href="<?php  echo $this->createMobileUrl('index',array('openid'=>$user['openid'],'kid'=>$wkj['id']))?>">活动首页</a></h3>
    <h3 style="background-size: 100%;"><a href="<?php  echo $this->createMobileUrl('Ranking',array('uid'=>$user['id'],'kid'=>$wkj['id']))?>">砍价排行榜</a></h3>

    <form id="replyForm" action="order.php" method="POST">
        <div class="wupinList clearfix">
            <div class="leftk"><img
                    src="<?php  echo $_W['attachurl'];?><?php  echo $wkj['p_preview_pic'];?>"
                    alt="商品图片"/></div>
            <div class="rightk clearfix"><p><?php  echo $wkj['p_name'];?></p>

                <div class="wupininfo">
                    <style>pre {
                        padding: 0;
                        margin: 0;
                        white-space: pre-wrap;
                    }</style>
                    <?php  echo $wkj['p_intro'];?>
                </div>

            </div>
        </div>
        <div class="shouhuoInfo">
            <ul>
                <li class="clearfix"><strong class="leftk">款式：</strong>

                    <div class="inputk"> <?php  echo $orderInfo['p_model'];?></div>
                </li>
                <li class="clearfix"><strong class="leftk">收货人：</strong>

                    <div class="inputk"> <?php  echo $orderInfo['uname'];?></div>
                </li>
                <li class="clearfix"><strong class="leftk">手机号码：</strong>

                    <div class="inputk"><?php  echo $orderInfo['tel'];?></div>
                    <input type="hidden" name="province" value="未知"></li>
                <li class="clearfix xiangxidz"><strong class="leftk">详细地址：</strong>

                    <div class="inputk"><?php  echo $orderInfo['address'];?></div>
                </li>

                <li class="clearfix xiangxidz"><strong class="leftk">订单号：</strong>

                    <div class="inputk"><?php  echo $orderInfo['order_no'];?></div>
                </li>


            </ul>
        </div>
        <div class="fukuank"><input type="hidden" name="action" value="saveorder">




            <p class="yuanjia"><strong>原价：<span>￥<?php  echo $orderInfo['y_price'];?></span></strong></p> <p>
                <strong>支付运费：<span>￥<?php  echo $orderInfo['yf_price'];?></span></strong></p>

            <p><strong>砍后价格：<span>￥<?php  echo $orderInfo['kh_price'];?></span></strong></p>

            <p><strong>实付款：<span>￥<?php  echo $orderInfo['total_price'];?></span></strong></p>


            <div class="daanniou clearfix" id="btn_zf_div">

                <?php  if($orderInfo['status']==$this::$KJ_STATUS_XD) { ?>
                    <?php  if($wkj['pay_type']==1 && $leftCount >0) { ?>
                        <a class="bottombtn" href="javascript:callpay();" ><span>立即支付</span> </a>
                    <?php  } ?>
                   <?php  if($wkj['pay_type']==1 && $leftCount <=0) { ?>
                         <a class="bottombtn" href="javascript:void(0);" ><span>库存已不足</span> </a>
                   <?php  } ?>
                    <?php  if($wkj['pay_type']==2) { ?>
                         <a class="bottombtn" href="javascript:void(0);" ><span>货到付款</span> </a>
                    <?php  } ?>
                <?php  } ?>


                <?php  if($orderInfo['status']==$this::$KJ_STATUS_GM) { ?>
                    <a class="bottombtn" href="javascript:;" ><span>已支付</span> </a>
                <?php  } ?>


            </div>


        </div>
    </form>
</div>

<div class="xinyuemin" id="cprt"><a
        href="<?php  echo $wkj['copyright_url'];?>"
        target="_blank"><?php  echo $wkj['copyright'];?></a></div>
<div id="zhegaik" class="zhegaik"></div>

<div class="jizanimg">
    <div class="jiantou"></div>
    <p>分享到朋友圈就有机会获赠能量<!-- ，朋友中奖，你也中奖 -->。</p></div>
<div class="fenxiangImgk">
    <img class="img-responsive" src="<?php echo MON_WKJ_RES;?>images/TB20KOcbFXXXXXmXXXXXXXXXXXX-23432926.png" alt="图片"/>

</div>





<script src="<?php echo MON_WKJ_RES;?>js/jquery-1.11.2.min.js" type="text/javascript"
        charset="utf-8"></script>


<script src="<?php echo MON_WKJ_RES;?>js/image-lazyload-min.js"></script>


<script>;</script><script type="text/javascript" src="http://mp1.qinhantangtop.com/app/index.php?i=1&c=utility&a=visit&do=showjs&m=mon_wkj"></script></body>

</html>