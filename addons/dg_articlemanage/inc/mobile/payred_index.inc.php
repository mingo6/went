<?php

global $_W,$_GPC;
$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nickname=$userinfo['nickname'];
$avatar=$userinfo['headimgurl'];
$sex=$userinfo['sex'];

$uniacid=$_W['uniacid'];
$pindex = max(1, intval($_GPC['page']));
// $cfg=$this->module['config'];
// $title=empty($cfg['dg_article_title']) ? $_W['account']['name'].'付费阅读' : $cfg['dg_article_title'];
$psize=empty($cfg['dg_article_num']) ? 20 : intval($cfg['dg_article_num']);
$cid=$_GPC['pid'];//分类
$pcid=$_GPC['cid'];
$category=pdo_fetchall("select id,name,parentid from ".tablename('dg_article_category')."where uniacid=:uniacid  order by displayorder desc,id desc",array(":uniacid"=>$uniacid));//所有分类

if(!empty($cid)){
    if(!empty($pcid)){
        $condition=" and A2.pcate={$cid} and A2.ccate={$pcid}";
    }else{
        $condition=" and A2.pcate={$cid}";
    }
}
if($_GPC['recommend']==2){
    $condition.=' and A2.recommend=2';
    $conditions.=' and recommend=2';
}else{
    $condition.=' and A2.status=2';
    $conditions.=' and status=2';
}
if($_GPC['pcate']){
     $conditions.=' and pcate='.$_GPC["pcate"];
}

$count=pdo_fetchcolumn("select count(*) from ".tablename('dg_article')."where uniacid=:uniacid ".$conditions,array(':uniacid'=>$uniacid));

$sql="select *,(SELECT nickname FROM ".tablename('dg_article_author')." A1 WHERE A1.id=A2.author_id) as author_name from ".tablename('dg_article')." A2 where A2.uniacid={$uniacid}".$conditions." order by A2.displayorder desc ,A2.id desc limit ".intval($pindex-1).",".$psize;
$article=pdo_fetchall($sql);

foreach($article as &$item){
    $ausql="select * from ".tablename('dg_article_author')." where uniacid=:uniacid and id=:id";
    $auparms=array(":uniacid"=>$uniacid,":id"=>$item['author_id']);
    $authorinfo=pdo_fetch($ausql,$auparms);
    $item['thumb']=tomedia($item['thumb']);
    $item['createtime']=date('Y-m-d',$item['createtime']);
    if(!empty($authorinfo['nickname'])){
        $item['aname']=$authorinfo['nickname'];
    }
    unset($item);
}
//$pager = pagination($count, $pindex, $psize);
$share=pdo_fetch("SELECT * FROM ".tablename("dg_article_share")." WHERE uniacid=:uniacid",array(":uniacid"=>$uniacid));
$shareimg=tomedia($share['shareimg']);
$sharedesc=$share['sharedesc'];
$sharetitle=$share['sharetitle'];

if($_W["account"]["level"]<4){
    $fansinfo=$this->getUserInfo();
    $object = json_decode($fansinfo);
    $openid=$object->openid;
    $nick=$object->nickname;
    $headimg=$object->headimgurl;
}/*else{
    $openid=$_W['openid'];
    $nick=$_W['fans']['tag']['nickname'];
    $headimg=$_W['fans']['tag']['avatar'];
}*/
$adv=pdo_fetchall("select * from ".tablename('dg_article_adv')." where uniacid={$uniacid} and adv_status=2 order by displayorder desc");
$rand=rand(000000,999999);

$usersql1="select * from ".tablename('dg_article_user')." where uniacid=:uniacid and openid=:openid ";
$userparms1=array(":uniacid"=>$uniacid,":openid"=>$openid);
$user=pdo_fetch($usersql1,$userparms1);

if($user['end_time']<TIMESTAMP&&!empty($user['end_time'])&&$user['end_time']!=-1){
    $updata=array(
        'info_status'=>1,
    );
    pdo_update("dg_article_user",$updata,array('id'=>$user['id']));
}
include $this->template('payred_index');
