<?php

global $_W,$_GPC;
load()->func('tpl');
$uniacid=$_W['uniacid'];

$configlist=pdo_fetchall("select * from ".tablename("dg_article_vipconfig")." where uniacid=:uniacid",array(":uniacid"=>$uniacid));

$userinfo=$this->getuserinfo(); 
$userinfo = json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nickname=$userinfo['nickname'];
$avatar=tomedia($userinfo['headimgurl']);
$sex=$userinfo['sex'];
$temp_url=$this->createMobileUrl('center');
    $temp_url=substr($temp_url, 1);
    $send_url=$_W['siteroot']."app".$temp_url;
$cfg=$this->module['config'];
$cfg['dg_article_recharge']=empty($cfg['dg_article_recharge'])? 5 :floatval($cfg['dg_article_recharge']);
$cfg['dg_article_recharge_qua']=empty($cfg['dg_article_recharge_qua'])? 5 :floatval($cfg['dg_article_recharge_qua']);
$cfg['dg_article_recharge_year']=empty($cfg['dg_article_recharge_year'])? 5 :floatval($cfg['dg_article_recharge_year']);
$cfg['dg_article_scale']=empty($cfg['dg_article_scale'])? 0.3 :floatval($cfg['dg_article_scale']);
$op=!empty($_GPC['op'])?$_GPC['op']:"display";
/*
 * 用户信息
 * */
$sql="select * from ".tablename('dg_article_user')." where uniacid=:uniacid and openid=:openid ";
$parms=array(":uniacid"=>$uniacid,":openid"=>$openid);
$user=pdo_fetch($sql,$parms);
if(!empty($user)){
	$avatar=tomedia($user['avatar']);
}
 $shares=pdo_get('dg_article_share',array('uniacid'=>$uniacid));
 $share_url=$_W['siteroot']."app/".substr($this->createMobileUrl('center'),2);

if($user['end_time']<TIMESTAMP&&!empty($user['end_time']) && $user['end_time']!=-1){
    $updata=array(
        'info_status'=>1,
    );
    pdo_update("dg_article_user",$updata,array('id'=>$user['id']));
}
/*
 * 购买成为会员
 * */

function ordersubmit($orderid,$moneynum,$day,$openid){
    global $_W,$_GPC;
    
    $uniacid=$_W['uniacid'];
	$user=pdo_get("dg_article_user",array('uniacid'=>$uniacid,'openid'=>$openid));
    $data=array();
    $data['uniacid']=$uniacid;
    $data['openid']=$openid;
    $data['recharge']=$moneynum;
    $data['out_trade_no']=$orderid;
    $data['rec_status']=0;
    $data['rec_time']=time();
    $data['month']=$day;
    //$data['mode']=$mode;
    $data['fopenid']=$user['fopenid'];
    pdo_insert('dg_article_recharge',$data);
}
$kjSetting=$this->findKJsetting();

function getpayment($money,$day,$kjSetting,$openid){
    global $_W,$_GPC;
    $money= (int)(floatval($money)*100);
    $out_trade_no =  date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
   
	 if($_GPC['pay_type']=='uni'){
        $jsApi = new JsApi_pub($kjSetting);
        $unifiedOrder = new UnifiedOrder_pub($kjSetting);
        $unifiedOrder->setParameter("openid", "$openid");//商品描述
        $unifiedOrder->setParameter("body", "阅读会员支付");//商品描述
        $timeStamp = time();
        
        $unifiedOrder->setParameter("out_trade_no", "$out_trade_no");//商户订单号
        $unifiedOrder->setParameter("total_fee", $money);//总金额
        $notifyUrl = $_W['siteroot'] . "addons/dg_articlemanage/recharge.php";
        $unifiedOrder->setParameter("notify_url", $notifyUrl);//通知地址
        $unifiedOrder->setParameter("trade_type", "JSAPI");//交易类型
        $prepay_id = $unifiedOrder->getPrepayId();
        $jsApi->setPrepayId($prepay_id);
        $jsApiParameters = $jsApi->getParameters();
 }
        $data=array(
            'money'=>$money,
            'out_trade_no'=>$out_trade_no,
            'jsApiParameters'=>$jsApiParameters
        );
   
    //插入数据到赞赏表中

    ordersubmit($out_trade_no,$money,$day,$openid);
    // return $jsApiParameters;
    return $data;
}

if($op=="post"){
    $id=intval($_GPC['id']);
	$vipconfig=pdo_fetch("select * from ".tablename("dg_article_vipconfig")." where id=:id",array(":id"=>$id));
	$num = intval($_GPC['num']);
	$day=$num*intval($vipconfig["day"]);
	$money=$num*floatval($vipconfig["money"]);
	
    $pay_parameters=getpayment($money,$day,$kjSetting,$openid);
    $data=$pay_parameters;
    header("Content-type:application/json");
    echo json_encode($data);
    exit();
}

/*
 * 判断是否是作者
 * */
$author=pdo_fetch("select * from ".tablename("dg_article_author")." where uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$openid));
$authorurl=$this->createmobileurl('income');

$pubarticle=$this->createmobileurl('pubarticle',array('aid'=>$author['id']));

$myarticle=$this->createmobileurl('myarticle',array('aid'=>$author['id']));
include $this->template('center');