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
    //$mode=$_GPC['mode'];
    //$time=$_GPC['timeset'];
    // if(empty($user['end_time'])||($user['end_time']<time())){
        // $endtime=time();
    // }else{
        // $endtime=$user['end_time'];
    // }

    $data=array(
        'realname'=>$_GPC['realname'],
        'mobile'=>$_GPC['mobile'],
        //'mode'=>$_GPC['mode'],
        'end_time'=>strtotime($_GPC['end_time']),
        'setmem'=>1,
        'settime'=>time(),
        'timeset'=>$time
    );
    $re=pdo_update('dg_article_user',$data,array('id'=>$id));
    if($re){
        message("操作成功",referer(),"success");
    }
}
include $this->template('setmem');