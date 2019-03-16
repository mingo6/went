<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/12/19
 * Time: 10:32
 */
global $_W,$_GPC;
load()->func('tpl');
$id=$_GPC['id'];
$uniacid=$_W['uniacid'];
$user=pdo_fetch("select * from ".tablename('dg_article_user')." where uniacid=:uniacid and id=:id",array
(":uniacid"=>$uniacid,":id"=>$id));
if(checksubmit()){
    $data=array(
        'realname'=>$_GPC['realname'],
        'mobile'=>$_GPC['mobile'],
        'settime'=>time(),
    );
    $re=pdo_update('dg_article_user',$data,array('id'=>$id));
    if($re){
        message("操作成功",referer(),"success");
    }
}
include $this->template('setusers');