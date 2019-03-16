<?php
global $_W,$_GPC;
$uniacid=$_W['uniacid'];
$cfg=$this->module['config'];
$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nickname=$userinfo['nickname'];
$avatar=$userinfo['headimgurl'];
$cata_id=$_GPC['cata_id'];
$serialize_id=$_GPC['serialize_id'];
$is_pay = pdo_get('dg_article_payment',array('openid'=>$openid,'serialize_id'=>$serialize_id,'order_status'=>1));
if($is_pay){
	$is_pay=true;
}
$pindex=max(1,intval($_GPC['page']));
$psize=15;
$serialize = pdo_fetch("SELECT * FROM ".tablename('dg_article_serialize')." WHERE uniacid=:uniacid AND id=:id",array(":uniacid"=>$uniacid,":id"=>$serialize_id));
$is_author = pdo_fetch("SELECT * FROM ".tablename('dg_article_serialize')." WHERE uniacid=:uniacid AND author_openid=:openid AND id=:id",array(":uniacid"=>$uniacid,":id"=>$serialize_id,':openid'=>$openid));
if($is_author){
	$is_author=true;
}
$is_vip = pdo_get('dg_article_user',array('uniacid'=>$uniacid,'openid'=>$openid,'info_status'=>2));
if($is_vip){
	$is_vip=true;
}
$cata_detail=pdo_fetch("SELECT * FROM ".tablename('dg_article_serializefb')." WHERE uniacid=:uniacid AND id=:id",array(':uniacid'=>$uniacid,":id"=>$cata_id));
if(((int)$cata_detail['displayorder']>(int)$serialize['free_chapter']) && ($is_author!=true && $is_pay!=true && $is_vip!=true)){
	$cata_detail['content']=htmlspecialchars_decode($cata_detail['description']);
}else{
	$cata_detail['content']=htmlspecialchars_decode($cata_detail['content']);
}
$max = pdo_fetch("SELECT max(displayorder) as num FROM ".tablename('dg_article_serializefb')." WHERE uniacid=:uniacid AND serialize_id=:serialize_id",array(':uniacid'=>$uniacid,":serialize_id"=>$serialize_id));
if($_GPC['type']=='chapter'){
	$displayorder=$_GPC['displayorder'];
	$chapter = pdo_fetch("SELECT * FROM ".tablename('dg_article_serializefb')." WHERE  uniacid=:uniacid AND serialize_id=:serialize_id AND displayorder=:displayorder",array(':uniacid'=>$uniacid,":serialize_id"=>$serialize_id,':displayorder'=>$_GPC['displayorder']));
	if(((int)$chapter['displayorder']>(int)$serialize['free_chapter']) && ($is_author!=true && $is_pay!=true && $is_vip!=true)){
		$chapter['content']=htmlspecialchars_decode($chapter['description']);
	}else{
		$chapter['content']=htmlspecialchars_decode($chapter['content']);
	}
	$data['chapter']=$chapter;
	$data['num']=$max['num'];
	header('Content-type: application/json');
	echo json_encode($data);
	exit;
}
include $this->template('cata_detail');   