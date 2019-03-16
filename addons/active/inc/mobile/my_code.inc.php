<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];
$userinfo = $_SESSION['userinfo'];

//我的活动码
$my_code = pdo_fetchall("select a.*,b.id aid,b.title from ".tablename('active_users_activity')." as a left join ".tablename('active_activity')." as b on a.activity_id = b.id where a.user_id = :id order by a.id desc",array(':id'=>$userinfo['id']));


include $this->template('my_code');