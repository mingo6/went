<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];

$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nickname=$userinfo['nickname'];
$avatar=$userinfo['headimgurl'];
 $shares=pdo_get('dg_article_share',array('uniacid'=>$uniacid));
 $share_url=$_W['siteroot']."app/".substr($this->createMobileUrl('new_index'),2);
$cfg=$this->module['config'];
$title=empty($cfg['dg_article_title']) ? $_W['account']['name'].'付费阅读' : $cfg['dg_article_title'];

$user=pdo_get('dg_article_user',array('uniacid'=>$uniacid,'openid'=>$openid));
$fopenid=$_GPC['fopenid'];
if($fopenid && empty($user['fopenid'])){
    pdo_update('dg_article_user',array('fopenid'=>$fopenid),array('uniacid'=>$uniacid,'openid'=>$openid));
}
$category=pdo_fetchall("select id,name,parentid from ".tablename('dg_article_category')." where uniacid=:uniacid  order by displayorder desc,id desc",array(":uniacid"=>$uniacid));
$one_article = pdo_fetchall("select *,(SELECT nickname FROM ".tablename('dg_article_author')." A1 WHERE A1.id=A2.author_id) as author_name from ".tablename('dg_article')." A2 where A2.uniacid={$uniacid} and A2.status=2 order by displayorder desc ,id desc limit 0,5");
$tj_article = pdo_fetchall("select *,(SELECT nickname FROM ".tablename('dg_article_author')." A1 WHERE A1.id=A2.author_id) as author_name from ".tablename('dg_article')." A2 where A2.uniacid={$uniacid} and A2.recommend=2 order by displayorder desc ,id desc limit 0,5");
$adv=pdo_fetchall("select * from ".tablename('dg_article_adv')." where uniacid={$uniacid} and adv_status=2 order by displayorder desc");
$list=pdo_fetchall("SELECT *,(SELECT nickname FROM ".tablename('dg_article_author')." A1 WHERE A1.openid=A2.author_openid) as author_name FROM ".tablename('dg_article_serialize')." A2 WHERE A2.uniacid=:uniacid and A2.recommend=2 ORDER BY A2.id DESC limit 0,5",array(':uniacid'=>$uniacid));
$list_s=pdo_fetchall("SELECT *,(SELECT nickname FROM ".tablename('dg_article_author')." A1 WHERE A1.openid=A2.author_openid) as author_name FROM ".tablename('dg_article_serialize')." A2 WHERE A2.uniacid=:uniacid and A2.status=2 ORDER BY A2.id DESC limit 0,5",array(':uniacid'=>$uniacid));
$navi_list=pdo_fetchall("select * from ".tablename('dg_article_navi')." where uniacid=:uniacid and enabled=1 order by displayorder desc limit 0,5",array(":uniacid"=>$uniacid));

include $this->template('new_index');