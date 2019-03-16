<?php
global $_W,$_GPC;
$uniacid=$_W['uniacid'];
$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nickname=$userinfo['nickname'];
$avatar=$userinfo['headimgurl'];
$serialize_id=$_GPC['serialize_id'];
$is_pay = pdo_get('dg_article_payment',array('openid'=>$openid,'serialize_id'=>$serialize_id,'order_status'=>1));
if($is_pay){
	$is_pay=true;
}
$pindex=max(1,intval($_GPC['page']));
$psize=15;
$is_vip = pdo_get('dg_article_user',array('uniacid'=>$uniacid,'openid'=>$openid,'info_status'=>2));
if($is_vip){
	$is_vip=true;
}
$is_author = pdo_fetch("SELECT * FROM ".tablename('dg_article_serialize')." WHERE uniacid=:uniacid AND author_openid=:openid AND id=:id",array(":uniacid"=>$uniacid,":id"=>$serialize_id,':openid'=>$openid));
$serialize = pdo_fetch("SELECT * FROM ".tablename('dg_article_serialize')." WHERE uniacid=:uniacid AND id=:id",array(":uniacid"=>$uniacid,":id"=>$serialize_id));

if($is_author){
	$is_author=true;
}
$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('dg_article_serializefb')." WHERE uniacid=:uniacid AND serialize_id=:serialize_id",array(':uniacid'=>$uniacid,":serialize_id"=>$serialize_id));
if($_GPC['order']){
	$order=' displayorder DESC';
}else{
	$order=' displayorder ASC';
}

$cata_list=pdo_fetchall("SELECT * FROM ".tablename('dg_article_serializefb')." WHERE uniacid=:uniacid AND serialize_id=:serialize_id ORDER BY ".$order." limit ".intval($pindex-1)*$psize.",".$psize,array(':uniacid'=>$uniacid,":serialize_id"=>$serialize_id));
if($_GPC['page'] || $_GPC['click']){
	$data['list']=$cata_list;
	$data['page']=$pindex;
	$data['total']=$total;
	$data['psize']=$psize;
	$data['order']=$_GPC['order'];
	header('Content-type: application/json');
	echo json_encode($data);
	exit;
}
include $this->template('cata_list');   