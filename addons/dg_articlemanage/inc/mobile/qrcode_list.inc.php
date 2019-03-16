<?php
global $_W,$_GPC;
$uniacid=$_W['uniacid'];
$user_info = json_decode($this->getUserInfo());
$openid = $user_info->openid;
$avatar=$user_info->headimgurl;
$pindex=max(1,intval($_GPC['page']));
$psize=20;
$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('dg_article_user')." WHERE uniacid=:uniacid AND fopenid=:openid",array(":uniacid"=>$uniacid,':openid'=>$openid));
$list=pdo_fetchall("SELECT * FROM ".tablename('dg_article_user')." WHERE uniacid=:uniacid AND fopenid=:openid ORDER BY id DESC LIMIT ".intval($pindex-1)*$psize.",".$psize,array(":uniacid"=>$uniacid,':openid'=>$openid));
if($_GPC['pindex']){
	$data['list']=$list;
	$data['page']=$pindex;
	$data['total']=$total;
	$data['psize']=$psize;
	header('Content-type: application/json');
	echo json_encode($data);
	exit;
}
include $this->template('qrcode_list');