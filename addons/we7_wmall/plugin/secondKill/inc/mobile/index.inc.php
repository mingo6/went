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

//分类列表
$category = pdo_fetchall('select * from ' . tablename('tiny_wmall_secondKill_category') . ' where uniacid = :uniacid  order by displayorder desc ', array(':uniacid'=>$_W['uniacid']));

//ajax请求url
$ajax_url = imurl('secondKill/index')."&ta=list";

//秒杀活动列表
if ($ta == 'list'){

    //分类搜索条件
    $type_id = $_GPC['type_id'];//分类id
    $order_by_type = $_GPC['type'];//排序类型

    $condition = ' where uniacid = :uniacid and is_shelves = 1';
    $params = array(':uniacid' => $_W['uniacid']);

    //分类搜索
    if (!empty($type_id)){
        $condition .= ' and type_id = '.$type_id;
    }

    //排序
    if(!empty($order_by_type)) {
        if ($order_by_type=="s_price"){
            $order_by = " order by {$order_by_type} asc";
        }
        elseif($order_by_type=="sale_num"){
            $order_by = " order by {$order_by_type} desc";
        }
        $order_by .= ", num desc";
    }else{
        $order_by = " order by num desc ";
    }

    //活动列表
    $active_list = pdo_fetchall('select * from ' . tablename('tiny_wmall_secondKill_goods') . "{$condition} {$order_by}", $params);

    foreach ($active_list as $k => $v)
    {
        $active_list[$k]['url'] = imurl('secondKill/details',array('sid' => $v['id']));
        $active_list[$k]['progress'] = round($v['surplus']/$v['number']*100);
        $active_list[$k]['is_end'] = $v['end_time']<time()?1:0;
    }

    if (!empty($active_list)){
        exit(json_encode(['status'=>1,'data'=>$active_list,'msg'=>'成功！']));
    }else{
        exit(json_encode(['status'=>2,'msg'=>'没有数据！']));
    }
}

include itemplate('index');

