<?php
global $_W,$_GPC;
load()->func('tpl');
$uniacid=$_W['uniacid'];
$userinfo=$this->getuserinfo();
$userinfo = json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nickname=$userinfo['nickname'];
$avatar=tomedia($userinfo['headimgurl']);
$user=pdo_fetch("select * from ".tablename('dg_article_user')." where openid=:openid and uniacid=:uniacid",array(":openid"=>$openid,":uniacid"=>$uniacid));
if($_GPC['info']){
    $data=array(
        'realname'=>$_GPC['username'],
        'mobile'=>$_GPC['userphone'],
        'desc'=>$_GPC['desc']
    );
    $re=pdo_update('dg_article_user',$data,array('id'=>$user['id']));
    header("Content-type:application/json");
    $fdata=array(
        'success'=>-1
    );
    if($re){
        $fdata=array(
            'success'=>1,
            'data'=>"更新信息成功"
        );
    }
    echo json_encode($fdata);
    exit();
}
include $this->template('myinfo');