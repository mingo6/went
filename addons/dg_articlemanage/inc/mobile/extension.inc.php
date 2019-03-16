<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];
$userinfo=$this->getUserInfo();
$userinfo = json_decode($userinfo,true);
$openid=$userinfo['openid'];
$user_sql="select * from ".tablename('dg_article_user')." where uniacid=:uniacid and openid=:openid";
$member=pdo_fetch($user_sql,array(":uniacid"=>$uniacid,":openid"=>$openid));
$count=0;
$y_count=0;
if($member['agent']==1){
	//代理商
	$count = pdo_fetchcolumn('select count(id) from '.tablename('dg_article_user').' where uniacid=:uniacid and user=:user',array(':uniacid'=>$uniacid,':user'=>$member['id']));//累计邀请的客户
	//邀请成功的客户
	$sql = 'select count(b.id) from '.tablename('dg_article_user').' as a,'.tablename('dg_article_surface').' as b where b.userid=a.id and b.status=3 and a.uniacid=:uniacid and a.user=:user';
	$y_count = pdo_fetchcolumn($sql,array(':uniacid'=>$uniacid,':user'=>$member['id']));
	
	$sql="select * from ".tablename('dg_article')."where uniacid={$uniacid} and top=1";
	$article=pdo_fetchall($sql);
	//var_dump($article);
}else{
	$extension = pdo_get('dg_article_extension',array('uniacid'=>$uniacid,'userid'=>$member['id']));
	
}
if(!empty($_GPC['type'])){
	$data = array(
		'name'=>$_GPC['name'],
		'uniacid'=>$uniacid,
		'userid'=>$member['id'],
		'nickname'=>$member['nickname'],
		'phone'=>$_GPC['phone'],
		'address'=>$_GPC['address'],
		'status'=>1,
		'time'=>time()
	);
	pdo_insert('dg_article_extension',$data);
	exit(json_encode(array('success'=>1)));
}
include $this->template('extension');
?>