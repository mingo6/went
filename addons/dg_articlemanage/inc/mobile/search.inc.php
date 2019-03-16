<?php
global $_W,$_GPC;
load()->func('tpl');
$uniacid=$_W['uniacid'];
$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nickname=$userinfo['nickname'];
$avatar=$userinfo['headimgurl'];
$pindex=max(1,intval($_GPC['page']));
$pindex=max(1,$_GPC['pindex']);
$psize=5;
$keyword=$_GPC['keyword'];
$pcate=$_GPC['pcate'];
$ccate=$_GPC['ccate'];
$condition='';
if($keyword){
	if($_GPC['my_type']=='article'){
		$condition.=' AND title like "%'.$keyword.'%"';
	}else{
		$condition.=' AND serialize_title like "%'.$keyword.'%"';
	}
}
if($pcate && $ccate){
	$condition.=" AND pcate=".$pcate." AND ccate=".$ccate;
}
if($pcate && empty($ccate)){
	$condition.=" AND pcate=".$pcate;
}
$author=pdo_fetch("select * from ".tablename("dg_article_author")." where uniacid=:uniacid  AND openid=:openid",array(':uniacid'=>$uniacid,":openid"=>$openid));
$a_total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('dg_article')." WHERE status=2 and uniacid=:uniacid ".$condition,array(':uniacid'=>$uniacid,':author_id'=>$author['id']));
$article_list = pdo_fetchall('SELECT * FROM '.tablename('dg_article')." WHERE status=2 and uniacid=:uniacid ".$condition."  ORDER BY id DESC LIMIT ".intval($pindex-1)*$psize.",".$psize,array(':uniacid'=>$uniacid));

foreach($article_list as $k=>$v){
	$article_list[$k]['thumb']="../attachment/".$v['thumb'];
	$article_list[$k]['content']=htmlspecialchars_decode($v['content']);
    $article_list[$k]['description']=strip_tags(htmlspecialchars_decode($v['description']));
}

$s_total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('dg_article_serialize')." WHERE status=2 and uniacid=:uniacid ".$condition,array(':uniacid'=>$uniacid));
$serialize_list=pdo_fetchall("SELECT * FROM ".tablename('dg_article_serialize')." WHERE status=2 and uniacid=:uniacid ".$condition." ORDER BY id DESC  limit ".intval($pindex-1)*$psize.",".$psize,array(':uniacid'=>$uniacid));

if($_GPC['pindex']){
	if($_GPC['my_type']=='article'){
		$data['list']=$article_list;
		$data['total']=$a_total;
	}else{
		$data['list']=$serialize_list;
		$data['total']=$s_total;
	}	

	$data['pindex']=$pindex;
	$data['psize']=$psize;
	header('Content-type: application/json');
	echo json_encode($data);
	exit;
}
include $this->template('search');