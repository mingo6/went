<?php
defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
icheckauth();

$_W["page"]["title"] = "我的二维码";
//测试退出登录
if ( $_GPC['ta'] == 'logout' )
{
    $key = "we7_wmall_member_session_" . $_W["uniacid"];
    isetcookie($key, "", -100);
    header('Location: '.$_W['siteroot'].'app/index.php?i='.$_W['uniacid'].'&c=entry&ctrl=wmall&ac=auth&op=login&do=mobile&m=we7_wmall');
    exit;
}

//用户信息
$user_info = $_W['member'];

//总收入
$commission_money = floatval(pdo_fetchcolumn('select round(sum(money), 2) from ' . tablename('tiny_wmall_order_commission_log') . ' WHERE uniacid = :uniacid and userId = :uid', array(":uniacid"=>$_W['uniacid'],":uid"=>$user_info["uid"])));

//二维码图片
$code_url = $_W['siteroot'].'app/index.php?i='.$_W['uniacid'].'&c=entry&ctrl=wmall&ac=home&op=guide&do=mobile&m=we7_wmall&pid='.$user_info['uid'];



include(itemplate("member/myCode"));