<?php
global $_W,$_GPC;
load()->func('tpl');
$uniacid=$_W['uniacid'];
$reply_id = $_GPC['id'];
if(!empty($_GPC['keyword'])) {
    $condition = " AND discuss LIKE '%".$_GPC['keyword']."%'";
}

$pindex=max(1,intval($_GPC['page']));
$psize=10;
$reply_list = pdo_fetchall('SELECT * FROM '.tablename("dg_article_serializedis").' WHERE uniacid=:uniacid AND reply_id=:reply_id '.$condition.' ORDER BY id DESC LIMIT '.($pindex -1) * $psize.','.$psize,array(':uniacid'=>$uniacid,':reply_id'=>$reply_id));
$total=pdo_fetchcolumn('SELECT count(*) FROM '.tablename("dg_article_serializedis").' WHERE uniacid=:uniacid AND reply_id=:reply_id '.$condition,array(':uniacid'=>$uniacid,':reply_id'=>$reply_id));

if($_GPC['op']=="serialize"){
    $id=$_GPC['del_id'];

    pdo_delete('dg_article_serializedis',array('id'=>$id));
    header("Content-type:application/json");
    echo json_encode($result);
    exit();
}
if($_GPC['op']=='serialize_op'){
    $id=$_GPC['id'];
    $st=pdo_fetch("select * from ".tablename('dg_article_serializedis')." where uniacid=:uniacid and id=:id",array(':uniacid'=>$uniacid,":id"=>$id));
    $result=array();
    if($st['status']!=2){
        $data=array(
            'status'=>2,
        );
        $result['res']=1;
    }else{
        $data=array(
            'status'=>1,
        );
    }
    $up=pdo_update('dg_article_serializedis',$data,array('id'=>$id));
    header("Content-type:application/json");
    echo json_encode($result);
    exit;
}
$pager=pagination($total,$pindex,$psize);
include $this->template('serialize_reply');