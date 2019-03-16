<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/9/5
 * Time: 17:27
 */
global $_W,$_GPC;
load()->func('tpl');
$uniacid=$_W['uniacid'];
$aid=$_GPC['aid'];
$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$openid=$userinfo['openid'];
$author1=pdo_fetch("select * from ".tablename("dg_article_author")." where openid=:openid",array(":openid"=>$openid));
$aid=$author1['id'];

$sql="select * from ".tablename('dg_article_author')." where uniacid=:uniacid and id=:aid";
$parms=array(":uniacid"=>$uniacid,":aid"=>$aid);
$author=pdo_fetch($sql,$parms);
$scale=floatval($author['scale']);

$lastsql="select * from ".tablename("dg_article_income")." where uniacid=:uniacid and author_id=:aid order by createtime desc limit 1";
$last=pdo_fetch($lastsql,$parms);
if(!empty($last)){
    $lasttime=$last['createtime'];
    $pcondition="and pay_time>$lasttime";
    $scondition="and shang_time>$lasttime";
}

$articlesql="select id from ".tablename('dg_article')." where uniacid=$uniacid and author_id=$aid";
$pall=pdo_fetch("select sum(pay_money) pay from ".tablename('dg_article_payment')." where order_status=1 and uniacid=$uniacid and article_id in ($articlesql)");
$sall=pdo_fetch("select sum(shang_money) shang from ".tablename('dg_article_shang')." where shang_status=1 and uniacid=$uniacid and article_id in ($articlesql)");
$serializeall=pdo_fetch("select sum(pay_money) pay from ".tablename('dg_article_payment')." where order_status=1 and uniacid=$uniacid and serialize_id is not null and author_id=:author_id",array(':author_id'=>$aid));

$all=number_format($pall['pay']*$scale*0.98+$sall['shang']*$scale*0.98+$serializeall['pay']*0.98*$scale,2);

$paysql=pdo_fetch("select sum(pay_money) pay from ".tablename('dg_article_payment')." where order_status=1 and uniacid=$uniacid ".$pcondition." and article_id in($articlesql)");

$shangsql=pdo_fetch("select sum(shang_money) shang from ".tablename('dg_article_shang')." where shang_status=1 and uniacid=$uniacid ".$scondition." and article_id in($articlesql)");
$serialize=pdo_fetch("select sum(pay_money) pay from ".tablename('dg_article_payment')." where order_status=1 and uniacid=$uniacid ".$pcondition." and serialize_id is not null and author_id=:author_id",array(':author_id'=>$aid));

$pay=number_format($paysql['pay']*$scale*0.98+$serialize['pay']*$scale*0.98,2);
$shang=$shangsql['shang']*$scale*0.98;

$sum=$pay+$shang;//可提现金额
$sum=number_format($sum,2);
$user = pdo_get("dg_article_user",array("uniacid"=>$uniacid,'openid'=>$openid));



$insql="select * from ".tablename("dg_article_income")." where author_id=:aid and uniacid=:uniacid order by createtime desc";
$insum=pdo_fetch("select sum(income_money) insum from ".tablename("dg_article_income")." where author_id=:aid and uniacid=:uniacid",$parms);
$incomesum=$insum['insum'];
$income=pdo_fetchall($insql,$parms);
foreach($income as &$item){
    $item['income_status']=$item['income_status']==1? "处理中" : "已结算";
}
// if($user['all_money']==0.00||empty($user['all_money'])){
    $arr = array(
        "all_money"=>$all,
        "profit"=>$pay,
        "withdrawals"=>$sum,
        "shang_profit"=>$shang,
        "no_withdrawals"=>$incomesum
    );
    pdo_update('dg_article_user',$arr,array("uniacid"=>$uniacid,'openid'=>$openid));
// }
$shou_yi=pdo_get("dg_article_user",array("uniacid"=>$uniacid,'openid'=>$openid));

$all=$shou_yi['all_money'];
$pay=$shou_yi['profit'];
$sum=$shou_yi['withdrawals'];
$incomesum=$shou_yi['no_withdrawals'];
$shang=$shou_yi['shang_profit'];
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
        "author_id"=>$aid,
        "income_money"=>$sum,
        "createtime"=>TIMESTAMP,
        "income_status"=>1,
        "batch_num"=>$ordernum
    );
    pdo_insert("dg_article_income",$data);
    $no_withdrawals=$sum+$incomesum;
    pdo_update('dg_article_user',array('no_withdrawals'=>$no_withdrawals,'withdrawals'=>0.00,'shang_profit'=>0.00),array("uniacid"=>$uniacid,'openid'=>$openid));
    $fmdata=array(
        "success"=>1,
        "data"=>"正在结算"
    );
    echo json_encode($fmdata);
    exit;
}
include $this->template('income');