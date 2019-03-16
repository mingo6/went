<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];

//活动列表
if($_GPC['op'] == 'list')
{
    $id = $_GPC['id'];
    $user_info = pdo_fetchall("select * from ".tablename('active_users_activity')." as a left join ".tablename('active_users')." as b on a.user_id = b.id where a.activity_id = :id and a.uniacid = :uniacid",array(':id'=>$id,':uniacid'=>$uniacid));

}
//核销活动码
elseif($_GPC['op'] == 'cancel')
{
    $code = $_GPC['activity_code'];
    $result = pdo_update('active_users_activity', array('iscode_time'=>time(),'is_code'=>1), array('activity_code'=>$code,'uniacid'=>$uniacid));
    if (!empty($result)){
        message('核销成功！');
    }else{
        message('核销失败，请稍后重试！');
    }

}
//查询活动码，进行核销
elseif($_GPC['op'] == 'query_code')
{
    $code = $_GPC['activity_code'];
    $user_info = pdo_fetchall("select * from ".tablename('active_users_activity')." as a left join ".tablename('active_users')." as b on a.user_id = b.id where a.activity_code = :id and a.uniacid = :uniacid",array(':id'=>$code,':uniacid'=>$uniacid));

}
//查询页面
elseif($_GPC['op'] == 'query')
{
    include $this->template('web/code_query');exit();
}

include $this->template('web/user_list');