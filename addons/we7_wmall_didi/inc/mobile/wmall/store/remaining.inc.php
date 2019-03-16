<?php

defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
$ta = (trim($_GPC['ta']) ? trim($_GPC['ta']) : 'index');
include itemplate('store/remaining');

?>
