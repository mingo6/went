<?php
global $_W,$_GPC;
$uniacid=$_W['uniacid'];
$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nickname=$userinfo['nickname'];
$avatar=$userinfo['headimgurl'];
$dis_id=$_GPC['dis_id'];

$dis = pdo_get("dg_article_serializedis",array('id'=>$dis_id));
$pindex=max(1,intval($_GPC['page']));
$psize=5;
$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('dg_article_serializedis')." WHERE uniacid=:uniacid AND status=2 AND reply_id=:reply_id",array(':uniacid'=>$uniacid,":reply_id"=>$dis_id));

$dis_reply=pdo_fetchall("SELECT * FROM ".tablename('dg_article_serializedis')." WHERE uniacid=:uniacid AND status=2 AND reply_id=:reply_id ORDER BY id DESC limit ".intval($pindex-1)*$psize.",".$psize,array(':uniacid'=>$uniacid,":reply_id"=>$dis_id));
foreach ($dis_reply as $k => $v) {
	$dis_reply[$k]['createtime']=date("Y-m-d H:i:s",$v['createtime']);
}
if($_GPC['page']){
	
	$data['list']=$dis_reply;
	$data['page']=$pindex;
	$data['total']=$total;
	$data['psize']=$psize;
	header('Content-type: application/json');
	echo json_encode($data);
	exit;
}
if($_GPC['type']=='discuss'){
	$data=array(
		"uniacid"=>$uniacid,
		"serialize_id"=>$serialize_id,
		"openid"=>$openid,
		"nickname"=>$nickname,
		"avatar"=>$avatar,
		"discuss"=>$_GPC['discuss'],
		"reply_id"=>$dis_id,
		"createtime"=>time()
	);
	pdo_insert("dg_article_serializedis",$data);
	header('Content-type: application/json');
	$res['con']=1;
	echo json_encode($res);
	exit;
}
include $this->template('discuss_detail');