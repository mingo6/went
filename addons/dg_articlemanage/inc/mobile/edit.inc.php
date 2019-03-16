<?php

global $_W,$_GPC;
load()->func('tpl');
$op = !empty($_GPC['op']) ? $_GPC['op'] : "display";
$uniacid=$_W['uniacid'];


$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nick=$userinfo['nickname'];
$avatar=$userinfo['headimgurl'];
$sex=$userinfo['sex'];


$info=pdo_fetch("select * from ".tablename('dg_article_user')." where uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$openid));
if($op=="post"){
    $name=$_GPC['realname'];
    $mobile=$_GPC['mobile'];
	$zfb = $_GPC['zfb'];
	$sex= $_GPC['sex'];

    $desc=$_GPC['desc'];
    $data=array();
   header('content-type:application/json;charset=utf8');
    if(empty($name)){
        $data['msg']="姓名不能为空";
        echo json_encode($data);
        exit;
    }
    if(empty($mobile)){
        $data['msg']="手机号不能为空";
        echo json_encode($data);
        exit;
    }
    if(strlen($name)>16){
        $data['msg']="姓名不能超过8字符";
        echo json_encode($data);
        exit;
    }
    if(!preg_match("/^1[34578]{1}\d{9}$/",$mobile)){
        $data['msg']="手机号不正确";
        echo json_encode($data);
        exit;
    }
    $insert=array(
        'uniacid'=>$uniacid,
        'openid'=>$openid,
        'nickname'=>$nickname,
        'avatar'=>$avatar,
        'realname'=>$name,
        'mobile'=>$mobile,
        'createtime'=>TIMESTAMP,
        'desc'=>$desc,
        'sex'=>$sex,
		'zfb'=>$zfb
    );
    if(empty($info)){
        $result=pdo_insert('dg_article_user',$insert);
    }else{
        $result=pdo_update('dg_article_user',$insert,array("id"=>$info['id']));
    }
    if($result){
        $data['success']=1;
        $data['msg']="保存成功";
    }
    echo json_encode($data);
    exit;
}
include $this->template('edit');