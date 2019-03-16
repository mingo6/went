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
$openid=$_W['openid'];
$nickname=$_W['fans']['tag']['nickname'];
$avatar=$_W['fans']['tag']['avatar'];
//判断用户属于那种代理
$user_id =pdo_get("dg_article_user",array('openid'=>$openid,'uniacid'=>$uniacid));
$sql_agent = "select * from ".tablename('dg_article_agent')." where uniacid=:uniacid";
$pram = array(":uniacid"=>$uniacid);
$agent = pdo_fetchall($sql_agent,$pram);
$persont = "";
foreach ($agent as $key => $value) {
	$val = explode(',', $value['user_id']);
	$exis = in_array($openid, $val);
	if(in_array($user_id['id'], $val)){
		$persont = $value['persent'];
	}
}
// $cfg=$this->module['config'];
// $cfg['dg_article_scale']=empty($cfg['dg_article_scale'])? 0.3 :floatval($cfg['dg_article_scale']);

//分销查取已提款
$sql="select * from ".tablename('dg_article_fenxiao')." where openid=:openid and uniacid=:uniacid order by createtime desc limit 1";
$parms=array(":openid"=>$openid,":uniacid"=>$uniacid);
$fromer=pdo_fetch($sql,$parms);
if(!empty($fromer)){
    $last=$fromer['createtime'];
    $condition=" and `rec_time`>$last";
}
//找下线统计金钱
$sql2 = "select * from ".tablename('dg_article_count')." where fid=:fid and uniacid=:uniacid";
$pram2 = array(':fid'=>$openid,':uniacid'=>$uniacid);
$downline_per = pdo_fetchall($sql2,$pram2);
$all = 0;
foreach ($downline_per as $key => $value) {
    $ssql="select sum(recharge) pay from ".tablename('dg_article_recharge')." where openid=:openid and uniacid=:uniacid and rec_status=1";
    $sparms=array(":openid"=>$value['userid'],":uniacid"=>$uniacid);
    $sharepay=pdo_fetch($ssql,$sparms);
    //总额度
    $all=$all+floatval($sharepay['pay'])/100*floatval($persont);
    
}
// $ssql="select sum(recharge) pay from ".tablename('dg_article_recharge')." where openid=:openid and uniacid=:uniacid";
// $sparms=array(":openid"=>$openid,":uniacid"=>$uniacid);
// $sharepay=pdo_fetch($ssql,$sparms);
//总额度
// $all=floatval($sharepay['pay'])*floatval($persont);

//提现
$sum = 0;
foreach ($downline_per as $key => $val) {
    $csql="select sum(recharge) pay from ".tablename('dg_article_recharge')." where openid=:openid ".$condition." and uniacid=:uniacid and rec_status=1";
    $cparms=array(":openid"=>$val['userid'],":uniacid"=>$uniacid);
    $pay=pdo_fetch($csql,$cparms);
    $sum=floatval($pay['pay'])/100*floatval($persont);
    $sum=$sum+number_format($sum,2);
}

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
    $re=pdo_insert("dg_article_fenxiao",$data);
    $fmdata=array(
        "success"=>$re,
        "data"=>"正在结算"
    );
    echo json_encode($fmdata);
    exit;
}

$insql="select * from ".tablename("dg_article_fenxiao")." where openid=:openid and uniacid=:uniacid order by createtime desc";
$insum=pdo_fetch("select sum(share_money) insum from ".tablename("dg_article_fenxiao")." where openid=:openid and uniacid=:uniacid",$parms);
$incomesum=$insum['insum'];
$incomesum = !empty($incomesum)?$incomesum:0;
$income=pdo_fetchall($insql,$parms);
if(!empty($income)){
    foreach($income as &$item){
        $item['share_status'] = $item['share_status']==1 ? "处理中" : "已结算";
    }
}

include $this->template('fenxiao');