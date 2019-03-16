<?php
defined('IN_IA') or exit('Access Denied');
define("MON_WKJ", "we7_wmall");
define("MON_WKJ_RES", "../addons/" . MON_WKJ . "/plugin/cutPrice/static/");
global $_W, $_GPC;
icheckauth();
$_W['page']['title'] = "砍价活动";
$ta = trim($_GPC['ta']) ? trim($_GPC['ta']) : 'index';
$openid = $_W["member"]['openid'];

//用户砍价页
if ($ta == 'index')
{
    $kid = $_GPC['kid'];
    $uopenid = $_GPC['openid'];
    $wkj = pdo_fetch("select * from " . tablename('tiny_wmall_cutPrice_goods') . " where id=:id", array(':id' => $kid));
    if (empty($wkj))imessage('活动不存在！', '', 'error');
    $join = false;
    //如果不是分享链接
    if (empty($uopenid))
    {
        //判断自己是否参与活动
        $user = pdo_fetch("select * from " . tablename('tiny_wmall_cutPrice_user') . " where kid=:kid and openid=:openid", array(':kid' => $kid,':openid' => $openid));
        if (!empty($user)){
            $uid = $user['id'];
        }else{
            $uid = 0;
        }
        $is_my = 1;
        //用户头像名称
        $userInfo = $_W["member"];
        //砍价提示语
        $u_fist_tip = '快给自己来一刀吧，下手就得狠点啊！';
        $u_already_tip = '继续找朋友帮你砍吧，砍到死为止！';
    }else{
        $user = pdo_fetch("select * from " . tablename('tiny_wmall_cutPrice_user') . " where kid=:kid and openid=:openid", array(':kid' => $kid,':openid' => $uopenid));
        if (empty($user))imessage('活动不存在！', '', 'error');
        $uid = $user['id'];
        $is_my = 2;
        //用户头像名称
        $userInfo = $user;
        $openid = $_W["member"]['openid'];
        //砍价提示语
        $u_fist_tip = '快帮我砍一刀！';
        $u_already_tip = '继续找朋友帮你砍吧，砍到死为止！';
    }

    //查看自己是否已经砍价
    $joinUser = pdo_fetch("select * from " . tablename('tiny_wmall_cutPrice_firend') . " where uid=:uid and openid = :openid", array(':uid' => $uid,':openid' => $openid));
    if (!empty($joinUser)) {
        $join = true;
    }
    //倒计时
    $date_time_array = getdate($wkj['end_time']);
    $hours = $date_time_array["hours"];
    $minutes = $date_time_array["minutes"];
    $seconds = $date_time_array["seconds"];
    $month = $date_time_array["mon"];
    $day = $date_time_array["mday"];
    $year = $date_time_array["year"];
    //活动状态码
    if (time() < $wkj['start_time']) {
        $status = 0;
    }
    elseif (time() > $wkj['end_time']) {
        $status = 2;
    }
    else{
        //查找订单
        $orderInfo = pdo_fetch("select * from " . tablename('tiny_wmall_order') . " where active_id=:active_id", array(':active_id' => $user['id']));
        if (empty($orderInfo)) {
            $status = 1;
        } else {
            //订单状态
            if ($orderInfo['status']==6)
                $status = 1;
            elseif ($orderInfo['status']==2)
                $status = 3;
            else
                $status = $orderInfo['status'];
        }
    }
    //活动状态
    $statusText = getStatus($status);

    //微信分享
    if ($is_my==1){
        $shareUrl = $_W['siteroot'].'app/index.php?i='.$_W['uniacid'].'&c=entry&ctrl=cutPrice&ac=active&do=mobile&m=we7_wmall&kid='.$kid.'&openid='.$openid;
        $wx_title = '我在参加"'.$wkj['name'].'"的砍价活动，快来帮我砍一刀！';
        $wx_desc = $wkj['introduction'];
        $wx_imgUrl = $_W['siteroot'].'attachment/'.$wkj['thumb'];
    }else{
        $shareUrl = $_W['siteroot'].'app/index.php?i='.$_W['uniacid'].'&c=entry&ctrl=cutPrice&ac=active&do=mobile&m=we7_wmall&kid='.$kid.'&openid='.$uopenid;
        $wx_title = '我朋友在参加"'.$wkj['name'].'"的砍价活动，快来帮他/她砍一刀！';
        $wx_desc = $wkj['introduction'];
        $wx_imgUrl = $_W['siteroot'].'attachment/'.$wkj['thumb'];
    }

    header("Cache-control:no-cache,no-store,must-revalidate");
    header("Pragma:no-cache");
    header("Expires:0");
    include(itemplate("index"));
}


//排行榜页面
if ($ta=='ranking')
{
    $kid = $_GPC['kid'];
    $uid = $_GPC['uid'];
    $wkj = pdo_fetch("select * from " . tablename('tiny_wmall_cutPrice_goods') . " where id=:id", array(':id' => $kid));
    $user = pdo_fetch("select * from " . tablename('tiny_wmall_cutPrice_user') . " where id=:uid", array(':uid' => $uid));

    //活动倒计时
    $date_time_array = getdate($wkj['end_time']);
    $hours = $date_time_array["hours"];
    $minutes = $date_time_array["minutes"];
    $seconds = $date_time_array["seconds"];
    $month = $date_time_array["mon"];
    $day = $date_time_array["mday"];
    $year = $date_time_array["year"];

    $params = array(':kid' => $kid, ':uid' => $uid);
    $firends = pdo_fetchall("SELECT * FROM " . tablename('tiny_wmall_cutPrice_firend') . " WHERE kid =:kid and uid=:uid  ORDER BY createtime DESC, id DESC ", $params);
    $ftotal = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('tiny_wmall_cutPrice_firend') . " WHERE kid =:kid and  uid=:uid", $params);

    //判断是自己查看排行榜还是别人查看排行榜
    if ($user['openid']==$openid){
        $is_my = 1;
    }else{
        $fopenid = $openid;
        $is_my = 2;
    }

    $firendJoined = false;
    if (!empty($fopenid)) {
        $joinFirend = pdo_fetch("select * from " . tablename('tiny_wmall_cutPrice_user') . " where kid=:kid and openid=:openid", array(':kid' => $kid,':openid' => $fopenid));//查找该帮助人有没有参加过活动
        if (!empty($joinFirend)) {
            $firendJoined = true;// 用户有参加过活动
        }
    }

    //活动状态码
    if (time() < $wkj['start_time']) {
        $status = 0;
    }
    elseif (time() > $wkj['end_time']) {
        $status = 2;
    }
    else{
        //查找订单
        $orderInfo = pdo_fetch("select * from " . tablename('tiny_wmall_order') . " where active_id=:active_id", array(':active_id' => $user['id']));
        if (empty($orderInfo)) {
            $status = 1;
        } else {
            //订单状态
            if ($orderInfo['status']==6)
                $status = 1;
            elseif ($orderInfo['status']==2)
                $status = 3;
            else
                $status = $orderInfo['status'];
        }
    }
    //活动状态
    $statusText = getStatus($status);
    //砍价提示语
    $rank_tip = '';
    //剩余商品数量
    $leftCount = $wkj['number'];
    //首页url
    $indexUrl = $_W['siteroot'].'/app/index.php?i='.$_W['uniacid'].'&c=entry&ctrl=cutPrice&ac=active&do=mobile&m=we7_wmall&kid='.$kid;
    //下单时提交的商品信息
    $goods = pdo_fetch("select * from " . tablename('tiny_wmall_goods') . " where id=:id", array(':id' => $wkj['gid']));
    $sid = $wkj['sid'];
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
                    "price_total":"'.$user['price'].'"
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
                "type":"1",
                "price":"'.$user['price'].'",
                "active_id":"'.$user['id'].'"
            }
    }';
    $goodsInfo = str_replace("+","",urlencode($goodsInfo));

    header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
    include(itemplate("ranking"));
}

//砍价方法
if ($ta=='kanjia')
{
    $kid = $_GPC['kid'];
    $uopenid = empty($_GPC['openid'])?$openid:$_GPC['openid'];

    $wkj = pdo_fetch("select * from " . tablename('tiny_wmall_cutPrice_goods') . " where id=:id", array(':id' => $kid));
    $res = array();
    if (empty($wkj)) {
        $res['code'] = 501;
        $res['msg'] = "活动删除或不存在";
        return json_encode($res);
    }
    if (time() < $wkj['start_time']) {
        $res['code'] = 502;
        $res['msg'] = "活动还未开始呢!";
        return json_encode($res);
    }
    if (time() > $wkj['end_time']) {
        $res['code'] = 503;
        $res['msg'] = "活动已经结束了，下次再参加吧!";
        return json_encode($res);
    }
    $userInfo = $_W["member"];
    if(empty($userInfo)) {
        $res['code'] = 504;
        $res['msg'] = "请授权登录后再进行砍价!";
        return json_encode($res);
    }
    //判断是否帮别人砍价
    if ($uopenid==$openid) {
        $dbJoinUser=pdo_fetch("select * from " . tablename('tiny_wmall_cutPrice_user') . " where kid=:kid and openid = :openid", array(":kid"=>$kid,":openid"=>$userInfo['openid']));
        if(empty($dbJoinUser)) {
            $userData = array(
                'kid' => $wkj['id'],
                'openid' => $userInfo['openid'],
                'nickname' => $userInfo['nickname'],
                'headimgurl' => $userInfo['avatar'],
                'price' => $wkj['y_price'],
                'ip' => $_W['clientip'],
                'createtime' => time()
            );
            pdo_insert('tiny_wmall_cutPrice_user',$userData);
            $uid = pdo_insertid();//用户活动ID
            $dbJoinUser['id'] = pdo_insertid();//用户活动ID
            $kj_res = kj($userData,$wkj,$uid,$userInfo);
        } else {
            $uid=$dbJoinUser['id'];
            $kj_res=array("0","你已经参加过了，不能再给自己砍了，请重新进入活动或刷新要页面");
        }
    } else {
        $dbJoinUser=pdo_fetch("select * from " . tablename('tiny_wmall_cutPrice_user') . " where kid=:kid and openid = :openid", array(":kid"=>$kid,":openid"=>$uopenid));
        $kj_res = kj($dbJoinUser,$wkj,$dbJoinUser['id'],$userInfo);
    }
    $json = '{"code":200,"uid":' . $dbJoinUser['id'] . ',"msg":"' . $kj_res[1] . '","ret":1,"status":1,"kanjiaPrice":' . $kj_res[0] . ',"action":"kanjia"}';
    echo $json;
}
