<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
icheckauth();
$_W['page']['title'] = "秒杀活动";
$ta = trim($_GPC['ta']) ? trim($_GPC['ta']) : 'index';
$uid = $_W["member"]["uid"];

//秒杀活动详情
if ($ta == 'index'){

    $sid = $_GPC['sid'];//活动id
    //活动商品信息
    $goods_info = pdo_get('tiny_wmall_secondKill_goods',array('id'=>$sid));
    if (empty($goods_info))imessage('活动不存在！', '', 'error');

    //店铺信息
    $store_info = pdo_get('tiny_wmall_store',array('id'=>$goods_info['sid']),array('title','logo','address','telephone'));

    $date_time_array = getdate($goods_info['end_time']);
    $date_time_text = "距离结束";

    $order_id = 0;
    //活动状态码
    if (time() < $goods_info['start_time']) {
        $status = 0;//活动未开始
        $status_text = "活动未开始";
        $date_time_array = getdate($goods_info['start_time']);
        $date_time_text = "距离开始";
    }
    elseif (time() > $goods_info['end_time']) {
        $status = 2;//活动已结束
        $status_text = "活动已结束";
    }
    elseif ($goods_info['surplus']<=0){
        $status = 3;//已抢光
        $status_text = "已抢光";
    }
    else{
        $status = 1;//正常
        //判断是否已经抢购过
        $user_record = pdo_get('tiny_wmall_secondKill_user',array('uid'=>$uid,'sid'=>$sid),array('id'));
        if (!empty($user_record)){
            $order_status = pdo_getall('tiny_wmall_order',array('type'=>3,'active_id'=>$user_record['id']),array('id','status','is_pay'));
            foreach ($order_status as $k => $v)
            {
                if ($v['status']!=6 && $v['is_pay']==1){
                    $status = 4;//用户抢购过
                    $status_text = "已抢购";
                    $order_id = $v['id'];
                }
            }
        }
    }

    //倒计时

    $hours = $date_time_array["hours"];
    $minutes = $date_time_array["minutes"];
    $seconds = $date_time_array["seconds"];
    $month = $date_time_array["mon"];
    $day = $date_time_array["mday"];
    $year = $date_time_array["year"];

    $goods = pdo_fetch("select * from " . tablename('tiny_wmall_goods') . " where id=:id", array(':id' => $goods_info['gid']));
    $goodsInfo = '{
        "'.$goods['id'].'":{
            "goods_id":"'.$goods['id'].'",
            "title":"'.$goods['title'].'",
            "options":{
                "0":{
                    "option_id":"0",
                    "name":"",
                    "num":1,
                    "price_num":1,
                    "discount_num":0,
                    "bargain_id":0,
                    "price_total":"'.$goods_info['s_price'].'"
                    }
                }
            },
        "88888":{
                "title":"餐盒费",
                "goods_id":0,
                "options":{
                    "0":{
                        "num":1,
                        "name":"",
                        "discount_num":0,
                        "price_num":0,
                        "price_total":"0.00"
                        }
                    },
                "type":"3",
                "price":"'.$goods_info['s_price'].'",
                "active_id":"'.$goods_info['id'].'"
            }
    }';
    $goodsInfo = str_replace("+","",urlencode($goodsInfo));

}

include itemplate('details');

