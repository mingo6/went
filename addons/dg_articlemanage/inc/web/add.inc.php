<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/9/1
 * Time: 10:09
 */
global $_W,$_GPC;
$op=!empty($_GPC['op']) ? $_GPC['op'] : 'display';
if($op=='mem'){
    $num=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_user')." where openid=:openid and
    uniacid=:uniacid and info_status=2",array(":openid"=>$_GPC['openid'],":uniacid"=>$_GPC['uniacid']));
}else{
    $num=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_author')." where openid=:openid and uniacid=:uniacid",array(":openid"=>$_GPC['openid'],":uniacid"=>$_GPC['uniacid']));
}
if(empty($num)){
    $mem=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_user')." where openid=:openid and
    uniacid=:uniacid ",array(":openid"=>$_GPC['openid'],":uniacid"=>$_GPC['uniacid']));
    $insert=array(
        'uniacid'=>$_GPC['uniacid'],
        'openid'=>$_GPC['openid'],
        'nickname'=>$_GPC['nickname'],
        'avatar'=>$_GPC['avatar'],
        'createtime'=>TIMESTAMP
    );
    if($op=='mem'){
        $insert['info_status']=2;
        $insert['setmem']=1;
        $insert['settime']=time();
        if(empty($mem)){
            $result=pdo_insert('dg_article_user',$insert);
        }else{
            $result=pdo_update('dg_article_user',$insert,array('openid'=>$_GPC['openid'],"uniacid"=>$_GPC['uniacid']));
        }
    }else{
        $result=pdo_insert('dg_article_author',$insert);
    }
    $id=pdo_insertid();
}
header("Content-type:application/json");
$res=array();
$res['success']=0;
if(!empty($result)){
    if($op=='mem'){
        $user=pdo_fetch("select * from ".tablename('dg_article_user')." where openid=:openid",array
        (":openid"=>$_GPC['openid']));
    }else{
        $user=pdo_fetch("select * from ".tablename('dg_article_author')." where openid=:openid",array(":openid"=>$_GPC['openid']));
    }
    $res=$user;
    if($op!='mem'){
        if(empty($res['money'])){
            $res['money']=0;
        }
    }
    $res['createtime']=date("Y/m/d H:i:s",$res['createtime']);
    $res['success']=1;
}
echo json_encode($res);


