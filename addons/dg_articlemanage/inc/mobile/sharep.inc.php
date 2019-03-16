<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/9/23
 * Time: 10:55
 */
global $_W,$_GPC;
load()->func('tpl');
$uniacid=$_W['uniacid'];

$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nickname=$userinfo['nickname'];
$avatar=$userinfo['headimgurl'];
$sex=$userinfo['sex'];

$cfg=$this->module['config'];
$cfg['dg_article_scale']=empty($cfg['dg_article_scale'])? 0.3 :floatval($cfg['dg_article_scale']);
$sql="select * from ".tablename('dg_article_sharep')." where openid=:openid and uniacid=:uniacid order by createtime desc limit 1";
$parms=array(":openid"=>$openid,":uniacid"=>$uniacid);
$fromer=pdo_fetch($sql,$parms);
if(!empty($fromer)){
    $last=$fromer['createtime'];
    $condition=" and `pay_time`>$last";
}
$ssql="select sum(pay_money) pay from ".tablename('dg_article_payment')." where order_status=1 and fromer=:fromer and uniacid=:uniacid";
$sparms=array(":fromer"=>$openid,":uniacid"=>$uniacid);
$sharepay=pdo_fetch($ssql,$sparms);
$all=floatval($sharepay['pay'])*floatval($cfg['dg_article_scale'])*0.98;

$csql="select sum(pay_money) pay from ".tablename('dg_article_payment')." where order_status=1".$condition." and fromer=:fromer and uniacid=:uniacid";
$cparms=array(":fromer"=>$openid,":uniacid"=>$uniacid);
$pay=pdo_fetch($csql,$cparms);
$sum=floatval($pay['pay'])*floatval($cfg['dg_article_scale'])*0.98;
$sum=number_format($sum,2);

$user = pdo_get("dg_article_user",array("uniacid"=>$uniacid,'openid'=>$openid));
$insql="select * from ".tablename("dg_article_sharep")." where openid=:openid and uniacid=:uniacid order by createtime desc";
$insum=pdo_fetch("select sum(share_money) insum from ".tablename("dg_article_sharep")." where openid=:openid and uniacid=:uniacid",$parms);
$incomesum=$insum['insum'];
$income=pdo_fetchall($insql,$parms);
if(!empty($income)){
    foreach($income as &$item){
        $item['share_status'] = $item['share_status']==1 ? "处理中" : "已结算";
    }
}

if($user['share_all']==0.00||empty($user['share_all'])){
    if(empty($all)){
        $all=0.00;
    }
    
    if(empty($sum)){
        $sum=0.00;
    }
    if(empty($incomesum)){
        $incomesum=0.00;
    }
    $arr = array(
        "share_all"=>$all,
        "share_profit"=>$sum,
        "share_nodrawals"=>$sum,
        "share_drawals"=>$incomesum
    );
    pdo_update('dg_article_user',$arr,array("uniacid"=>$uniacid,'openid'=>$openid));
}
$shou_yi=pdo_get("dg_article_user",array("uniacid"=>$uniacid,'openid'=>$openid));
$all=$shou_yi['share_all'];
$pay=$shou_yi['share_profit'];
$sum=$shou_yi['share_nodrawals'];
$incomesum=$shou_yi['share_drawals'];
$vip=$shou_yi['share_vip'];
if($_GPC['submit']){
    header("Content-type:application/json");
    $ordernum=$this->build_order_sn();
    if($sum<1){
        $fmdata = array(
            "success" => -1,
            "data" =>"当前金额小于1元,不能提现"
        );
        echo json_encode($fmdata);
        exit;
    }
    $data=array(
        "uniacid"=>$uniacid,
        "openid"=>$openid,
        'nickname'=>$nickname,
        'avatar'=>$avatar,
        "share_money"=>$sum,
        "createtime"=>TIMESTAMP,
        "share_status"=>1,
        "batch_num"=>$ordernum
    );
    $re=pdo_insert("dg_article_sharep",$data);
     $share_drawals=$sum+$incomesum;
    pdo_update('dg_article_user',array('share_drawals'=>$share_drawals,'share_nodrawals'=>0.00,'share_profit'=>0.00,'share_vip'=>0),array("uniacid"=>$uniacid,'openid'=>$openid));
    $fmdata=array(
        "success"=>$re,
        "data"=>"正在结算"
    );
    echo json_encode($fmdata);
    exit;
}
include $this->template('sharep');