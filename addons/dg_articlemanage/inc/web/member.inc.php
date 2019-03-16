<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/9/12
 * Time: 11:50
 */
global $_W,$_GPC;
load()->func("tpl");
$uniacid=$_W['uniacid'];

$op= $_GPC['op'] ? $_GPC['op'] : 'display';
$pindex=max(1,intval($_GPC['page']));
$psize=10;
$keyword=$_GPC['keyword'];
if(!empty($keyword)){
    $condition=" nickname like '%".$keyword."%' and ";
}
$sql="select * from ".tablename('dg_article_user')." where ".$condition." uniacid=:uniacid and info_status=2 order by id desc limit ".intval($pindex-1)*$psize.",".$psize;
$parms=array(":uniacid"=>$uniacid);
$records=pdo_fetchall($sql,$parms);
$total=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_user')." where uniacid=:uniacid and info_status=2",$parms);
$pager=pagination($total,$pindex,$psize);


if(!empty($_GPC['del'])){
    $id=$_GPC['id'];
    $data=array(
        'info_status'=>1
    );
    pdo_update('dg_article_user',$data,array('id'=>$id,'uniacid'=>$uniacid));

    header('content-type:application/json;charset=utf8');

    $fmdata = array(
        "success" => 1,
        "data" =>"删除成功",
    );

    echo json_encode($fmdata);
    exit;
}
if($op=="config"){
	$configlist=pdo_fetchall("select * from ".tablename("dg_article_vipconfig")." where uniacid=:uniacid",array(":uniacid"=>$uniacid));
}else if($op=="editconfig"){
	$id=$_GPC["id"];
	$config=pdo_fetch("select * from ".tablename("dg_article_vipconfig")." where uniacid=:uniacid and id=:id",array(":uniacid"=>$uniacid,":id"=>$id));
	if(checksubmit()){
        empty($_GPC['title'])&&message('标题不能为空');
        empty($_GPC['day'])&&message('有效期不能为空');
		empty($_GPC['money'])&&message('金额不能为空');
		
        $data=array(
            'uniacid'=>$uniacid,
            'title'=>$_GPC['title'],
            'day'=>$_GPC['day'],
            'money'=>$_GPC['money'],
            'status'=>$_GPC['status']
        );
        if(empty($_GPC['id'])){
            $re=pdo_insert('dg_article_vipconfig',$data);
        }else{
            $re=pdo_update('dg_article_vipconfig',$data,array('id'=>$id));
        }
        if($re){
            message('设置成功',referer(),"success");
        }
    }
}else if($op=="deleteconfig"){
	$id=$_GPC["id"];
	pdo_delete("dg_article_vipconfig",array("id"=>$id));
    message('设置成功',referer(),"success");
}

include $this->template('member');


