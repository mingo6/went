<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];

//模拟登录
//$userinfo = Util::getSingelDataInSingleTable('active_users',array('id'=>1));
//$_SESSION['userinfo'] = $userinfo;

//unset($_SESSION['userinfo']);die;

include $this->template('index');