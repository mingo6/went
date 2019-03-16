<?php
global $_GPC,$_W;	
$uniacid = $_W['uniacid'];
$user_info=$this->getUserInfo();
$invite_uid= $_GPC['uid'];
$fuid = $_GPC['s'];
$myself = pdo_get("dg_article_user",array('uniacid'=>$uniacid,'id'=>$fuid));
$art_url = $this->createMobileUrl('new_index',array('fopenid'=>$myself['openid']));

header('location:'.$art_url);