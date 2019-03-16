<?php
global $_W,$_GPC;
$uniacid=$_W['uniacid'];
$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nickname=$userinfo['nickname'];
$avatar=$userinfo['headimgurl'];
$pindex=max(1,intval($_GPC['page']));
$psize=6;
$total=pdo_fetchcolumn("select count(0) from ".tablename('dg_article_payment')." WHERE uniacid=:uniacid AND order_status=1 AND openid=:openid",array(':uniacid'=>$uniacid,":openid"=>$openid));
$list = pdo_fetchall("SELECT * FROM ".tablename('dg_article_payment')." WHERE uniacid=:uniacid AND order_status=1 AND openid=:openid ORDER BY id DESC LIMIT ".intval($pindex-1)*$psize.",".$psize,array(':uniacid'=>$uniacid,":openid"=>$openid));
$list_collect=array();
foreach ($list as $k=> $v) {
	if($v['serialize_id']){
		$serialize = pdo_fetch("select * from ".tablename('dg_article_serialize')." where uniacid=:uniacid and id=:id",array(':uniacid'=>$uniacid,':id'=>$v['serialize_id']));
		
		$serialize['lx']='serialize';
		array_push($list_collect, $serialize);
	}
	if($v['article_id']){
		$article = pdo_fetch("select * from ".tablename('dg_article')." where uniacid=:uniacid and id=:id",array(':uniacid'=>$uniacid,':id'=>$v['article_id']));
		$article['description']=strip_tags(htmlspecialchars_decode($article['description']));
		$article['lx']='article';
		$article['thumb']=$_W['attachurl'].$article['thumb'];
		array_push($list_collect, $article);
	}
	
}
if($_GPC['page']){
	$data['list']=$list_collect;
	$data['page']=$pindex;
	$data['total']=$total;
	$data['psize']=$psize;
	header('Content-type: application/json');
	echo json_encode($data);
	exit;
}
include $this->template('mypay');