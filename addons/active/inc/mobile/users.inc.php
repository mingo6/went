<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];
//个人中心

$userinfo = $_SESSION['userinfo'];

include $this->template('users');