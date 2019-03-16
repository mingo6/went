<?php

global $_W,$_GPC;
load()->func('tpl');
$uniacid=$_W['uniacid'];
$op=!empty($_GPC['op']) ? $_GPC['op'] : "display";
$pindex=max(1,intval($_GPC['page']));
$psize=10;
$condition='';
if(!empty($_GPC['keyword'])) {
    $condition .= " where discuss LIKE '%".$_GPC['keyword']."%'";
}

$sql1="select A1.id,A1.aritcle_id,A1.reply,A1.nickname,A1.status,A1.discuss,A1.createtime,A2.title,'课程' as type from ".tablename('dg_article_dis')." A1 inner join ".tablename("dg_article")." A2 on A1.aritcle_id=A2.id where A1.uniacid=:uniacid ";

$sql2="select A3.id,A3.serialize_id as aritcle_id,A3.reply_id as reply,A3.nickname,A3.status,A3.discuss,A3.createtime,A4.serialize_title as title,'专栏' as type from ".tablename('dg_article_serializedis')." A3 inner join ".tablename("dg_article_serialize")." A4 on A3.serialize_id=A4.id where A3.uniacid=:uniacid AND A3.reply_id=0";

$sql="select * from (".$sql1." union all ".$sql2.") as a ".$condition." ORDER BY createtime DESC LIMIT ".($pindex -1) * $psize.','.$psize;
$total_sql="select count(*) from (".$sql1." union all ".$sql2.") as a ".$condition;
$total=pdo_fetchcolumn($total_sql,array(":uniacid"=>$uniacid));
$parms=array(":uniacid"=>$uniacid);
$list=pdo_fetchall($sql,$parms);
foreach($list as $k=>$v){
    if($v['type']=='专栏'){
        $reply=pdo_get('dg_article_serializedis',array('reply_id'=>$v['id']));
        if(empty($reply)){
            $list[$k]['reply']='';
        }else{
            $list[$k]['reply']='已回复';
        }
    }
}
$pager=pagination($total,$pindex,$psize);
if($op=='on'){
    $id=$_GPC['id'];
    $st=pdo_fetch("select * from ".tablename('dg_article_dis')." where uniacid=:uniacid and id=:id",array(':uniacid'=>$uniacid,":id"=>$id));
    $result=array();
    if($st['status']==1){
        $data=array(
            'status'=>2,
        );
        $result['res']=1;
    }else{
        $data=array(
            'status'=>1,
        );
    }
    $up=pdo_update('dg_article_dis',$data,array('id'=>$id));
    header("Content-type:application/json");
    echo json_encode($result);
    exit;
}
if($op=='serialize_op'){
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
if($op=="aritcle"){
    $id=$_GPC['id'];
    pdo_delete('dg_article_dis',array('id'=>$id));
    header("Content-type:application/json");
    echo json_encode($result);
    exit();
}
if($op=="serialize"){
    $id=$_GPC['id'];
    pdo_delete('dg_article_serializedis',array('id'=>$id));
    pdo_delete('dg_article_serializedis',array('reply_id'=>$id));
    header("Content-type:application/json");
    echo json_encode($result);
    exit();
}
include $this->template('discuss');