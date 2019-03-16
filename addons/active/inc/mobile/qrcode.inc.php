<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];
$userinfo = $_SESSION['userinfo'];

//我的活动列表

include 'QRcode.php';

$url = $_GPC['url'];
$QR = new QRcode();
$QR::png($url, false, QR_ECLEVEL_L, 10);