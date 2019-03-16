<?php

/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
mload()->model("AllgroupgoodsGoods");
icheckauth();
$_W['page']['title'] = "拼团活动详情";
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'index';

if ($op == 'index') {
	global $_W, $_GPC;
	$gsql = " select a.*,b.telephone,b.title,b.logo,b.business_hours,b.location_x,b.location_y,b.address from" . tablename('tiny_wmall_allgroupgoods_goods') . " a left join " . tablename('tiny_wmall_store') . " b on a.sid=b.id where a.id=:id AND a.uniacid";
	$goods = pdo_fetch($gsql, array(':id' => $_GPC['goods_id']));
	if (empty($goods)) {
		imessage("拼团商品不存在", imurl("allgroupgoods/index"), "error");
	}
	$goodsMod = new AllgroupgoodsGoods();
	$state = $goodsMod->checkGoodsPasd($goods['start_time'], $goods['end_time']);
	if (is_error($state)) {
		imessage($state['message'], imurl("allgroupgoods/index"), "error");
	}

    //状态
    $uid = $_W["member"]["uid"];
    $order_info = pdo_get('tiny_wmall_allgroupgoods_order', array('goods_id' => $_GPC['goods_id'], 'uid' => $_W["member"]["uid"], 'group_id !=' => 0, 'is_pay' => 1),array('id','group_id'));

    //未参团
    if (empty($order_info)){
        //别人的团
        if($_GPC['group_id'] > 0){
            $group = pdo_get('tiny_wmall_allgroupgoods_group', array('id' => $_GPC['group_id'], 'state'=>[1,2]));
            if(empty($group)){
                imessage(error(-1, '拼团不存在！'), imurl("allgroupgoods/index"), 'error');
            }
            if($group['state'] != 1){
                imessage(error(-1, '拼团已失效或未支付！'), imurl("allgroupgoods/index"), 'error');
            }
            $status = 3;//参加别人的团
        }else{
            $status = 1;//正常
        }
    }
    //已参团
    else{
        $group = pdo_get('tiny_wmall_allgroupgoods_group', array('id' => $order_info['group_id'],'state'=>[1,2]));
        $status = empty($group)?1:2;//已下单
    }
    if (isset($group)) $status = $group['state']==2?4:$status; //拼团已成功，查看订单

    //把一些预定义的 HTML 实体转换为字符
    $html_string = htmlspecialchars_decode($goods['details']);
    $content = str_replace(" ", "", $html_string);
    $contents = strip_tags($content);
    $text = mb_substr($contents, 0, 30, "utf-8");
    //微信分享
    if ($status==2&&$status==3){
        $shareUrl = $_W['siteroot'].'app/index.php?i='.$_W['uniacid'].'&c=entry&ctrl=allgroupgoods&ac=details&do=mobile&m=we7_wmall&goods_id='.$_GPC['goods_id'].'&group_id='.$group['id'];
        $wx_title = '我在参加"'.$goods['name'].'"的拼团活动，还差'.$goods['people']-$group['yg_num'].'人成团，快来参团！';
        $wx_desc = $text;
        $wx_imgUrl = $_W['siteroot'].'attachment/'.$wkj['thumb'];
    }else{
        $shareUrl = $_W['siteroot'].'app/index.php?i='.$_W['uniacid'].'&c=entry&ctrl=allgroupgoods&ac=details&do=mobile&m=we7_wmall&goods_id='.$_GPC['goods_id'];
        $wx_title = '"'.$goods['name'].'"拼团活动！超优惠！快来参团！';
        $wx_desc = $text;
        $wx_imgUrl = $_W['siteroot'].'attachment/'.$wkj['thumb'];
    }

	//$goods=pdo_get('tiny_wmall_allgroupgoods_goods',array('id'=>$_GPC['goods_id']));
	//拼团情况
	//$sql = " select a.id,a.kt_num,a.yg_num,a.uid,b.nickname,b.avatar from" . tablename('tiny_wmall_allgroupgoods_group') . " a left join " . tablename('tiny_wmall_members') . " b on a.uid=b.id  where a.goods_id=:goods_id and a.state=1 and a.uniacid=:uniacid";
	//$group = pdo_fetchall($sql, array(':uniacid' => $_W['uniacid'], ':goods_id' => $_GPC['goods_id']));


	$goods['arr_business_hours'] = unserialize($goods['business_hours']);
	$goodsInfo['goods'] = $goods;
	if (!empty($goodsInfo['goods']['img'])) {
		$goodsInfo['goods']['arr_img'] = array_map('tomedia', explode(',', $goodsInfo['goods']['img']));
	} else {
		$goodsInfo['goods']['arr_img'] = array();
	}
	$goodsInfo['goods']['logo'] = tomedia($goodsInfo['goods']['logo']);
//	$goodsInfo['group'] = $group;
} else {
	imessage('错误方法！', imurl("allgroupgoods/index"), "error");
}
include itemplate('details');