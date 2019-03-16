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
if(!empty($keyword)){
    $condition=" nickname like '%".$keyword."%' and ";
}
$sql="select * from ".tablename('dg_article_user')." where ".$condition." uniacid=:uniacid  order by id desc limit ".intval($pindex-1)*$psize.",".$psize;
$parms=array(":uniacid"=>$uniacid);
$records=pdo_fetchall($sql,$parms);
$total=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_user')." where uniacid=:uniacid  ",$parms);
$pager=pagination($total,$pindex,$psize);


if(!empty($_GPC['del'])){
    $id=$_GPC['id'];
    pdo_delete('dg_article_user',array('id'=>$id,'uniacid'=>$uniacid));

    header('content-type:application/json;charset=utf8');

    $fmdata = array(
        "success" => 1,
        "data" =>"删除成功",
    );

    echo json_encode($fmdata);
    exit;

}
include $this->template('users');



