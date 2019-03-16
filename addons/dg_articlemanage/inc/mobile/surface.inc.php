<?php
global $_W,$_GPC;
$uniacid=$_W['uniacid'];
$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$type = $_GPC['type'];
$fuser = $userinfo['uid'];
$url = $this->createmobileurl('surface');
if($type=='add'){
	$data = array(
		'uniacid'=>$uniacid,
		'openid'=>$userinfo['openid'],
		'nickname'=>$userinfo['nickname'],
		'userid'=>$userinfo['uid'],
		'username'=>$_GPC['username'],
		'age'=>$_GPC['age'],
		'phone'=>$_GPC['phone'],
		'address'=>$_GPC['address'],
		'bank'=>$_GPC['bank'],
		'alipay'=>$_GPC['alipay'],
		'shenfenzheng'=>$_GPC['shenfenzheng'],
		'endtime'=>$_GPC['endtime'],
		'wangdai'=>$_GPC['wangdai'],
		'ffpc_name'=>$_GPC['ffpc_name'],
		'ffpc_address'=>$_GPC['ffpc_address'],
		'ffpc_phone'=>$_GPC['ffpc_phone'],
		'status'=>1, //1申请中 2申请成功 3申请失败
		'time'=>time()
	);
	
	
	if(!empty($_GPC['contact1'])){
		$contact1 = json_encode($_GPC['contact1']);
	}
	if(!empty($_GPC['contact2'])){
		$contact2 = json_encode($_GPC['contact2']);
	}
	if(!empty($_GPC['contact3'])){
		$contact3 = json_encode($_GPC['contact3']);
	}
	$data['contact1']=$contact1;
	$data['contact2']=$contact2;
	$data['contact3']=$contact3;
	pdo_insert('dg_article_surface',$data);
	
	exit(json_encode(array('status'=>1)));
}
include $this->template('shuju');
?>