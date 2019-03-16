<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];

if($_GPC['type']=='hot_buy'){
	$art_condition=",(SELECT count(0)+A1.pay_num FROM ".tablename('dg_article_payment')." A2 WHERE A2.order_status=1 AND A2.article_id=A1.id) as real_num";
	$ser_condition=",(SELECT count(0)+A1.pay_num FROM ".tablename('dg_article_payment')." A2 WHERE A2.order_status=1 AND A2.serialize_id=A1.id) as real_num";
	$order=' order by real_num desc';
}else{
	$order=' order by A1.id desc';
}
if($_GPC['type']=='free'){
	if($_GPC['my_type']=='article' || $_GPC['my_type']==''){
		$condition=" AND (A1.pay_money is null or A1.pay_money='0.00')";
	}else{
		$condition=" AND (A1.serialize_price is null or A1.serialize_price='0.00')";
	}
	
}
if($_GPC['type']=='money'){
	if($_GPC['my_type']=='article' || $_GPC['my_type']==''){
		$condition=" AND (A1.pay_money is not null AND A1.pay_money!='0.00')";
	}else{
		$condition=" AND (A1.serialize_price is not null AND A1.serialize_price!='0.00')";
	}
	
}
if($_GPC['pid']){
	if($_GPC['cid']){
		$condition=" AND A1.pcate=".$_GPC['pid']." AND A1.ccate=".$_GPC['cid'];
	}else{
		$condition=" AND A1.pcate=".$_GPC['pid'];
	}
}
$pindex = max(1, intval($_GPC['pindex']));
$psize=10;
if($_GPC['my_type']=='article' || $_GPC['my_type']==''){
	$article_list = pdo_fetchall('SELECT A1.*,(SELECT nickname FROM '.tablename("dg_article_author").' A3 WHERE A3.id=A1.author_id) as author_name'.$art_condition.' FROM '.tablename('dg_article')." A1 WHERE A1.uniacid=:uniacid ".$condition." and A1.status=2 ".$order." LIMIT ".intval($pindex-1)*$psize.",".$psize,array(':uniacid'=>$uniacid));
	foreach($article_list as $k=>$v){
		$article_list[$k]['thumb']=$_W['attachurl'].$v['thumb'];
		if(empty($v['author_name'])){
			$article_list[$k]['author_name']='';
		}
	    $article_list[$k]['description']=strip_tags(htmlspecialchars_decode($v['description']));
	}
}else{
	$serialize_list=pdo_fetchall("SELECT A1.*,(SELECT nickname FROM ".tablename('dg_article_author')." A2 WHERE A2.openid=A1.author_openid) as author_name".$ser_condition." FROM ".tablename('dg_article_serialize')." A1 WHERE A1.uniacid=:uniacid ".$condition.$order." limit ".intval($pindex-1)*$psize.",".$psize,array(':uniacid'=>$uniacid));
}
if($_GPC['pindex']){
	if($_GPC['my_type']=='article'){
		$data['list']=$article_list;
	}else{
		$data['list']=$serialize_list;
	}	

	$data['pindex']=$pindex;
	$data['psize']=$psize;
	header('Content-type: application/json');
	echo json_encode($data);
	exit;
}
include $this->template('navi_list');