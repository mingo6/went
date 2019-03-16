<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];
$serialize_id=$_GPC['serialize_id'];
$operation=$_GPC['op'] ? $_GPC['op']:'';
$pindex=max(1,intval($_GPC['page']));
$psize=10;
$list = pdo_fetchall("SELECT * FROM ".tablename('dg_article_serializefb')." WHERE uniacid=:uniacid AND serialize_id=:serialize_id ORDER BY displayorder ASC LIMIT ".intval($pindex-1)*$psize.",".$psize,array(':uniacid'=>$uniacid,":serialize_id"=>$serialize_id));
$total=pdo_fetchcolumn("SELECT count(0) FROM ".tablename('dg_article_serializefb')." WHERE uniacid=:uniacid AND serialize_id=:serialize_id",array(':uniacid'=>$uniacid,":serialize_id"=>$serialize_id));
$pager=pagination($total,$pindex,$psize);
$chapter_article=pdo_get("dg_article_serializefb",array('id'=>$_GPC['chapter_id']));
$zj = pdo_fetch("SELECT MAX(displayorder) as num FROM ".tablename('dg_article_serializefb')." WHERE uniacid=:uniacid AND serialize_id=:serialize_id",array(":uniacid"=>$uniacid,":serialize_id"=>$serialize_id));
if(empty($zj['num'])){
	$chapter=1;
}else{
	$chapter=$zj['num']+1;
}
if(checksubmit('submit')){

	if(empty($_GPC['thumb'])){
		message('请选择封面',"","error");
	}
	if(empty($_GPC['title'])){
		message('请填写标题',"","error");
	}
	if(empty($_GPC['description'])){
		message('请填写简介',"","error");
	} 
	if(empty($_GPC['content'])){
		message('请填写内容',"","error");
	}
	$id=$_GPC['chapter_id'];
	$a=stripos($_GPC['thumb'],"attachment/");
	if($a!=false){
		$ava=$_GPC['thumb'];
	}else{
		$ava=$_W['attachurl'].$_GPC['thumb'];
	}
	$data=array(
		"uniacid"=>$uniacid,
		"thumb"=>$ava,
		"title"=>$_GPC['title'],
		"description"=>$_GPC['description'],
		"content"=>$_GPC['content'],
		"serialize_id"=>$_GPC['serialize_id'],
		"displayorder"=>$_GPC['displayorder'],
		"createtime"=>time()
	);

	if($id){
		pdo_update("dg_article_serializefb",$data,array("id"=>$id));
	}else{
		pdo_insert("dg_article_serializefb",$data);
	}
	 message('保存成功！', $this->createWebUrl('serialize_release',array('serialize_id' => $serialize_id)), 'success');
}
if($_GPC['type']=="delete"){
	
	pdo_delete("dg_article_serializefb",array('id'=>$_GPC['chapter_id']));
}

include $this->template('serialize_release');