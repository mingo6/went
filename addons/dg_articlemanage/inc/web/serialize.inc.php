<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];
$operation=$_GPC['op'] ? $_GPC['op']:'';
$pindex=max(1,intval($_GPC['page']));
$psize=10;
$list=pdo_fetchall("SELECT * FROM ".tablename('dg_article_serialize')." WHERE uniacid=:uniacid ORDER BY id DESC limit ".intval($pindex-1)*$psize.",".$psize,array(':uniacid'=>$uniacid));

$total=pdo_fetchcolumn("select count(0) from ".tablename('dg_article_serialize').' WHERE uniacid='.$uniacid);
$pager=pagination($total,$pindex,$psize);
$serialize = pdo_get("dg_article_serialize",array("id"=>$_GPC['serialize_id']));
$catagroy_parent=pdo_fetchall("SELECT * FROM ".tablename('dg_article_category')." WHERE uniacid=".$uniacid." AND parentid=0 ORDER BY id DESC");
if(!empty($serialize['pcate'])){
	$catagroy_child=pdo_fetchall("SELECT * FROM ".tablename('dg_article_category')." WHERE uniacid=".$uniacid." AND parentid=".$serialize['pcate']." ORDER BY id DESC");
}
if(checksubmit('submit')){

	if(empty($_GPC['serialize_img'])){
		message('请选择封面',"","error");
	}
	if(empty($_GPC['serialize_title'])){
		message('请填写标题',"","error");
	}
	if(empty($_GPC['serialize_desc'])){
		message('请填写简介',"","error");
	} 
	if(empty($_GPC['pcate'])){
		message('请选择一级分类',"","error");
	}
	if(empty($_GPC['openid'])){
		message('请选择作者',"","error");
	}
	$id=$_GPC['id'];
	$a=stripos($_GPC['serialize_img'],"attachment/");
	if($a!=false){
		$ava=$_GPC['serialize_img'];
	}else{
		$ava=$_W['attachurl'].$_GPC['serialize_img'];
	}
	$data=array(
		"uniacid"=>$uniacid,
		"author_openid"=>$_GPC['openid'],
		"author_nickname"=>$_GPC['nickname'],
		"author_avatar"=>$_GPC['avatar'],
		"serialize_img"=>$ava,
		"serialize_title"=>$_GPC['serialize_title'],
		"serialize_desc"=>$_GPC['serialize_desc'],
		"serialize_price"=>$_GPC['serialize_price'],
		"pcate"=>$_GPC['pcate'],
		"ccate"=>$_GPC['ccate'],
		"displayorder"=>$_GPC['displayorder'],
		"pay_num"=>$_GPC['pay_num'],
		"bg_music_set"=>$_GPC['bg_music_set'],
		"bg_music"=>$_GPC['bg_music'],
		"free_chapter"=>$_GPC['free_chapter'],
		"create_time"=>time()
	);

	if($id){
		pdo_update("dg_article_serialize",$data,array("id"=>$id));
	}else{
		pdo_insert("dg_article_serialize",$data);
	}
	 message('保存成功！', $this->createWebUrl('serialize'), 'success');
}
if($_GPC['type']=="search"){

	$author = $_GPC['author'];
	$ds = pdo_fetch('SELECT id,avatar,nickname,openid,realname,mobile FROM ' . tablename('dg_article_author') . " WHERE nickname like '%".$author."%' and uniacid=".$uniacid);
	$res['user']=$ds;
	if(empty($ds)){
		$res['cus']=1;
	}
	header('content-type:application/json;charset=utf8');
	echo json_encode($res);
	exit;
}
if($_GPC['type']=="cate"){

	$parentid = $_GPC['parentid'];
	$cata=pdo_fetchall("SELECT * FROM ".tablename('dg_article_category')." WHERE uniacid=".$uniacid." AND parentid=".$parentid." ORDER BY id DESC");
	$res['list']=$cata;

	header('content-type:application/json;charset=utf8');
	echo json_encode($res);
	exit;
}
if($_GPC['type']=="delete"){

	pdo_delete("dg_article_serialize",array('id'=>$_GPC['id']));
}
if($_GPC['type']=="sy"){
	$sy_id=$_GPC['sy_id'];
	$recommend=pdo_get("dg_article_serialize",array('id'=>$sy_id));
	if($recommend['recommend']==1){
		$recommend['recommend']=2;
	}else{
		$recommend['recommend']=1;
	}
	pdo_update("dg_article_serialize",array('recommend'=>$recommend['recommend']),array('id'=>$sy_id));
	header('content-type:application/json;charset=utf8');
	$res['success']=1;
	echo json_encode($res);
	exit;
}
if($_GPC['type']=="zs"){
	$zs_id=$_GPC['zs_id'];
	$recommend=pdo_get("dg_article_serialize",array('id'=>$zs_id));
	if($recommend['status']==1){
		$recommend['status']=2;
	}else{
		$recommend['status']=1;
	}
	pdo_update("dg_article_serialize",array('status'=>$recommend['status']),array('id'=>$zs_id));
	header('content-type:application/json;charset=utf8');
	$res['success']=1;
	echo json_encode($res);
	exit;
}
include $this->template('serialize');