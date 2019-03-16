<?php
global $_W,$_GPC;
$uniacid=$_W['uniacid'];
$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nickname=$userinfo['nickname'];
$avatar=$userinfo['headimgurl'];
$recommend = $_GPC['recommend'];
$condition='';
if($_GPC['search']){
	 $condition.=' and (A2.serialize_title like "%'.$_GPC['search'].'%" OR A2.serialize_desc like "%'.$_GPC['search'].'%")';
}
if($_GPC['pcate'] && empty($_GPC['ccate'])){
	$condition.=" and A2.pcate=".$_GPC['pcate'];
}
if($_GPC['pcate'] && $_GPC['ccate']){
	$condition.=" and A2.pcate=".$_GPC['pcate']." AND A2.ccate=".$_GPC['ccate'];
}
if($_GPC['clickNum']){
	$order=" ,A2.clickNum DESC";
}
if($_GPC['times']){
	$order=" ,A2.create_time DESC";
}
if($recommend==2){
    $condition.=' and A2.recommend=2';
}else{
    $condition.=' and A2.status=2';
}
$category=pdo_fetchall("select id,name,parentid from ".tablename('dg_article_category')."where uniacid=:uniacid  order by displayorder desc,id desc",array(":uniacid"=>$uniacid));
$pindex=max(1,intval($_GPC['page']));
$psize=8;
$total=pdo_fetchcolumn("select count(0) from ".tablename('dg_article_serialize').' A2 WHERE A2.uniacid='.$uniacid.$condition.
$order);

$list=pdo_fetchall("SELECT *,(SELECT nickname FROM ".tablename('dg_article_author')." A1 WHERE A1.openid=A2.author_openid) as author_name FROM ".tablename('dg_article_serialize')." A2 WHERE A2.uniacid=:uniacid ".$condition." ORDER BY A2.id DESC ".$order." limit ".intval($pindex-1)*$psize.",".$psize,array(':uniacid'=>$uniacid));

if($_GPC['page']){
	$data['list']=$list;
	$data['page']=$pindex;
	$data['total']=$total;
	$data['psize']=$psize;
	header('Content-type: application/json');
	echo json_encode($data);
	exit;
}
include $this->template('serialize');