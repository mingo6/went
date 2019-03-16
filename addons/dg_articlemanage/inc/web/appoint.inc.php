<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/8/31
 * Time: 12:29
 */
global $_W,$_GPC;
load()->func('tpl');
$id=$_GPC['id'];
$pindex=max(1,intval($_GPC['page']));
$psize=10;
$uniacid=$_W['uniacid'];
$condition=" uniacid=:uniacid ";
//查找此课程下面的分组
$sql="select appo_users from ".tablename('dg_article')."  where  id=".$_GET['id']." and uniacid=:uniacid ";
$parms=array(":uniacid"=>$uniacid);
$groupid=pdo_fetch($sql,$parms);
$groupid=  substr($groupid['appo_users'], 0, -1);

//根据课程指定的分组id查找分组信息
if(!empty($groupid)){
    $sql="select * from ".tablename('dg_article_group')."  where id in ($groupid) and uniacid=:uniacid order by createtime desc limit ".intval($pindex-1)*$psize.",".$psize;
    $records=pdo_fetchall($sql,$parms);
    $total = pdo_fetchcolumn("select count(*) from ".tablename('dg_article_group')."  where id in ($groupid) ",array(":uniacid"=>$uniacid));    
   
}  else {
   $total=0;
}

//删除分组
if(!empty($_GPC['del'])){
    $id=$_GPC['aid'];   //课程的id
    $gid=$_GPC['gid'];  //分组的id
    $sql="select appo_users from ".tablename('dg_article')."  where id=$id";
    $groupid=pdo_fetchall($sql);
    
    $groupid=explode(',',$groupid[0]['appo_users']);
    foreach ($groupid as $key=>$value){
        if ($value === $gid)
        unset($groupid[$key]);
    }
    $groupid=  implode(',', $groupid);
    $save['appo_users']=$groupid;
    pdo_update('dg_article',$save,array('id'=>$_GPC['aid']));
    header('content-type:application/json;charset=utf8');
    $fmdata = array(
        "success" => 1,
        "data" =>"删除成功",
    );
    echo json_encode($fmdata);
    exit;

}

$pager=pagination($total,$pindex,$psize);
include $this->template('appoint');

