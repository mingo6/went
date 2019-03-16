<?php
global $_W,$_GPC;
$uniacid=$_W['uniacid'];

if($_GPC['type']=='cate'){
	$catagroy_parent=pdo_fetchall("SELECT * FROM ".tablename('dg_article_category')." WHERE uniacid=".$uniacid." AND parentid=0 ORDER BY id DESC");
	$catagroy_child=pdo_fetchall("SELECT * FROM ".tablename('dg_article_category')." WHERE uniacid=".$uniacid." AND parentid!=0 AND parentid is not null ORDER BY id DESC");
	$res['parent']=$catagroy_parent;
	$res['child']=$catagroy_child;
	 header('content-type:application/json;charset=utf8');
	exit(json_encode($res));
}
$openid=$_W['openid'];
if(empty($openid)){
	$userinfo=$this->getUserInfo();
	$userinfo=json_decode($userinfo,true);
	$openid=$userinfo['openid'];
}

if($_GPC['type']=='add'){
	$author=pdo_get('dg_article_author',array('uniacid'=>$uniacid,'openid'=>$openid));
	$data=array(
		'uniacid'=>$uniacid,
		'title'=>$_GPC['title'],
		'pcate'=>$_GPC['pid'],
		'ccate'=>$_GPC['cid'],
		'description'=>$_GPC['describ'],
		'author_id'=>$author['id'],
		'author'=>$author['nickname'],
		'thumb'=>$_GPC['thumb'],
		'types'=>$_GPC['types'],
		'createtime'=>time()
	);
	if($_GPC['types']==1){
		$content=$_GPC['textall'];
		$cont='';
		foreach($content as $k=>$v){
			$img=array_filter(explode(',',$v[0]));
			for($i=0;$i<count($img);$i++){
				$cont.='<p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 16px; color: rgb(68, 68, 68); font-family: " microsoft="" helvetica="" font-size:="" white-space:=""><span style="box-sizing: border-box; font-size: 18px;"><img src="'.$img[$i].'" width="100%" alt="img-5.jpg"></span></p>';
			}
			$cont.='<p style="text-indent:2em;box-sizing: border-box; margin-top: 0px; margin-bottom: 16px; color: rgb(68, 68, 68); font-family: " microsoft="" helvetica="" font-size:="" white-space:=""><span style="box-sizing: border-box; font-size: 18px;">'.$v[1].'</span></p>';
		}
		$data['content']=$cont;
	}else{
		$data['images']=$_GPC['images'];
	}
	if($_GPC['price']){
		$data['pay_money']=$_GPC['price'];
		$data['img_free']=$_GPC['free_num'];
	}
	if(empty($_GPC['textall'])&&empty($_GPC['images'])){
		$res['success']=-1;
	}else{
		$res['success']=1;
		pdo_insert('dg_article',$data);
	}
	
	header('content-type:application/json;charset=utf8');
	exit(json_encode($res));
}

$mediaid=$_GPC['mediaids'];
$mediaids = substr($mediaid,0,-1);
$filename=substr($this->downloadImage($mediaids),0,-1);
$filenames = explode(',',$filename);
if($_GPC['type']=="preview"){
    header('content-type:application/json;charset=utf8');
    $res['img_s'] = $filenames;
    exit(json_encode($res));
}

include $this->template('relase_art');