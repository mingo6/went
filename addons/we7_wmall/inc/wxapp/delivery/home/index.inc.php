<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
mload()->model('deliveryer');
if(empty($_W['deliveryer']['perm_takeout']) && empty($_W['deliveryer']['is_errander'])) {
	imessage('您没有配送权限，请联系管理员授权', imurl('wmall/member/mine'), 'error');
}
$url = 'delivery/order/takeout/list';
if(empty($_W['deliveryer']['perm_takeout'])) {
	$url = 'delivery/order/errander/list';
}
header('location:' . imurl($url));
die;

