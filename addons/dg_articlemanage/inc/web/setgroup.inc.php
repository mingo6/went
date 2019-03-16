<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2017/1/12
 * Time: 11:50
 */
global $_W,$_GPC;
load()->func("tpl");
$uniacid=$_W['uniacid'];
$pindex=max(1,intval($_GPC['page']));
$psize=10;
$keyword=$_GPC['keyword'];
$id=$_GPC['id'];
//$gid=$_GPC['gid'];
//$condition=" id =$id and ";

if(!empty($keyword)){
    $id=$_GPC['id'];
    $condition=" nickname like '%".$keyword."%' and ";
    $sql="select id from ".tablename('dg_article_user')." where ".$condition." uniacid=:uniacid  order by id desc";
    $parms=array(":uniacid"=>$uniacid);
    $users=pdo_fetchall($sql,$parms);
    foreach ($users as $k => $v) {
       $ids.= $v['id'].',';
    }
    $users=substr($ids,0,-1);   //根据关键词搜索用户表查找的用户id（字符串）
    $users=  explode(',', $users);
    // 查找分组中的用户id
    $sql="select * from ".tablename('dg_article_group')." where id=".$id."  and uniacid=:uniacid";
    $groupuser=pdo_fetch($sql,$parms);
    $groupuser=substr($groupuser['userid'],0,-1);
    $groupuser=  explode(',', $groupuser);
    //判断查询的是否在分组中
    $result = array_intersect($users, $groupuser);
    $result=  implode(',', $result);
    if(!empty($result)){
         //查询数据
        $sql="select * from ".tablename('dg_article_user')." where id in (".$result.") and uniacid=:uniacid  limit ".intval($pindex-1)*$psize.",".$psize;
        $record=pdo_fetchall($sql,$parms);
        $total=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_user')." where id in (".$result.") and uniacid=:uniacid  ",$parms);
        $pager=pagination($total,$pindex,$psize);
    }
   
 }else{
    $sql="select * from ".tablename('dg_article_group')." where id=".$id."  and uniacid=:uniacid";
    $parms=array(":uniacid"=>$uniacid);
    $groupuser=pdo_fetch($sql,$parms);
    $groupuser=  substr($groupuser['userid'], 0,-1);
     //如果分组中有成员
    if(!empty($groupuser)){
        $sql="select * from ".tablename('dg_article_user')." where id in (".$groupuser.") and uniacid=:uniacid  limit ".intval($pindex-1)*$psize.",".$psize;
        $record=pdo_fetchall($sql,$parms);
        $total=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_user')." where id in (".$groupuser.") and uniacid=:uniacid  ",$parms);
        $pager=pagination($total,$pindex,$psize);

    }
 }

//删除
if(!empty($_GPC['del'])){
    $id=$_GPC['id'];
    $uid=$_GPC['uid'];
    $sq="select userid from ".tablename('dg_article_group')."  where id=$id and uniacid=:uniacid ";
    $parms=array(":uniacid"=>$uniacid);
    $arr=pdo_fetchall($sq,$parms);
    $arrid=explode(',',$arr[0]['userid']);
    foreach ($arrid as $key=>$value){
        if ($value === $uid)
        unset($arrid[$key]);
    }
    $arrid=  implode(',', $arrid);
    $save['userid']=$arrid;
    pdo_update('dg_article_group',$save,array('id'=>$_GPC['id']));
    header('content-type:application/json;charset=utf8');
    $fmdata = array(
        "success" => 1,
        "data" =>"删除成功",
    );
    echo json_encode($fmdata);
    exit;

}
include $this->template('setgroup');



