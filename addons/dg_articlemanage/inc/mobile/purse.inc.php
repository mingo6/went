<?php
global $_W,$_GPC;
load()->func('tpl');
$uniacid=$_W['uniacid'];
$userinfo=$this->getuserinfo();
$userinfo = json_decode($userinfo,true);
$openid=$userinfo['openid'];
$cfg=$this->module['config'];
$cfg['dg_article_scale']=empty($cfg['dg_article_scale'])? 0.3 :floatval($cfg['dg_article_scale']);//分享收益;
$author=pdo_fetch("select * from ".tablename("dg_article_author")." where uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$openid));
$scale=floatval($author['scale']);
$countart=0.00;
$mysharepay=0.00;
if(!empty($author)){
    $last=pdo_fetch("select `createtime` from ".tablename("dg_article_income")." where author_id=:aid order by createtime desc limit 1",array(":aid"=>$author['id']));
    if(!empty($last)){
        $lasttime=$last['createtime'];
        $pcondition=" and pay_time>$lasttime";
        $scondition="and shang_time>$lasttime";
    }
    $payart=pdo_fetch("select sum(pay_money) pay from ".tablename('dg_article_payment')." where order_status=1 and uniacid=:uniacid ".$pcondition." and author_id=:author_id",array(":uniacid"=>$uniacid,":author_id"=>$author['id']));
    $shangart=pdo_fetch("select sum(shang_money) shang from ".tablename('dg_article_shang')." where shang_status=1 and uniacid=:uniacid  ".$scondition." and author_id=:author_id",array(":uniacid"=>$uniacid,":author_id"=>$author['id']));
    $mypayart=$payart['pay']*$scale*0.98;
    $myshangart=$shangart['pay']*$scale*0.98;
    $countart=$mypayart+$myshangart;
}

$lastshare=pdo_fetch("select `createtime` from ".tablename('dg_article_sharep')." where openid=:openid and uniacid=:uniacid order by id desc limit 1",array(":openid"=>$openid,":uniacid"=>$uniacid));
if(!empty($lastshare)){
    $last=$lastshare['createtime'];
    $condition=" and `pay_time`>$last";
}
$shaerpay=pdo_fetch("select sum(pay_money) pay from ".tablename('dg_article_payment')." where order_status=1 ".$condition." and fromer=:fromer and uniacid=:uniacid",array(":fromer"=>$openid,":uniacid"=>$uniacid));
$mysharepay=$shaerpay['pay']*0.98*$cfg['dg_article_scale'];

include $this->template('purse');