<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/9/18
 * Time: 15:24
 */
global $_W,$_GPC;
load()->func('tpl');
$uniacid=$_W['uniacid'];
$article_id=$_GPC["article_id"];
$op=!empty($_GPC['op']) ? $_GPC['op'] : "display";
$pindex=max(1,intval($_GPC['page']));
$psize=10;
$total=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_dis')." where aritcle_id=:article_id and uniacid=:uniacid",array(":article_id"=>$article_id,":uniacid"=>$uniacid));
$total=empty($total)?0:$total;
$sql="select * from ".tablename('dg_article_dis')." where aritcle_id=:article_id and uniacid=:uniacid order by id desc limit ".intval($pindex-1)*$psize.",".$psize;

$parms=array(":article_id"=>$article_id,":uniacid"=>$uniacid);
$list=pdo_fetchall($sql,$parms);
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
if($op=="delete"){
    $id=$_GPC['id'];
    pdo_delete('dg_article_dis',array('id'=>$id));
    header("Content-type:application/json");
    echo json_encode($result);
    exit();
}
include $this->template('article');