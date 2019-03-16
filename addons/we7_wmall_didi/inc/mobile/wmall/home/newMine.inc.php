<?php




defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
$ta = ((trim($_GPC['ta']) ? trim($_GPC['ta']) : 'index'));
$_W['page']['title'] = '我的';
include itemplate('home/newMine');
?>