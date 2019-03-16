<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
$_W['page']['title'] = "砍价活动";
$ta = trim($_GPC['ta']) ? trim($_GPC['ta']) : 'index';
$config = $_W['we7_wmall']['config']['mall'];
$config_takeout = $_W['we7_wmall']['config']['takeout'];

if ($ta == 'index')
{
    //分类列表
    $category = pdo_fetchall('select * from ' . tablename('tiny_wmall_cutPrice_category') . ' where uniacid = :uniacid  order by displayorder desc ', array(':uniacid'=>$_W['uniacid']));
    //分类搜索条件
    $type_id = $_GPC['type_id'];
    $order_by_type = $_GPC['type'];
    $condition = ' where uniacid = :uniacid and is_shelves = 1';
    $params = array(':uniacid' => $_W['uniacid']);

    //分类搜索
    if (!empty($type_id)) $condition .= ' and type_id = '.$type_id;
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

    $cutPrice_goods = pdo_fetchall('select * from ' . tablename('tiny_wmall_cutPrice_goods') . "{$condition} {$order_by}", $params);
}

include itemplate('search');

