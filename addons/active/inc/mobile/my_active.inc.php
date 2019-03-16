<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];
$userinfo = $_SESSION['userinfo'];

//我的活动列表
if ( pdo_get('active_users_activity', array('user_id' => $userinfo['id']), array('id'))){
    $is_haveactive = 0;
}else{
    $is_haveactive = 1;
}


include $this->template('my_active');