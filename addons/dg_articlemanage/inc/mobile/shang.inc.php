<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/8/27
 * Time: 11:48
 */
global $_W,$_GPC;
load()->func('tpl');
function ordersubmit($orderid,$moneynum){
    global $_W,$_GPC;
    $article_id=intval($_GPC['article_id']);

    $uniacid=$_W['uniacid'];
     $openid=$_W['openid'];
    /*$userinfo=$this->getUserInfo();

	$userinfo=json_decode($userinfo,true);
	$openid=$userinfo['openid'];
	$nickname=$userinfo['nickname'];
	$avatar=$userinfo['headimgurl'];
	$sex=$userinfo['sex'];*/
    if($_W["account"]["level"]<4){
        $openid=$_SESSION['oauth_openid'];
    }
    $data=array(
        "uniacid"=>$_W['uniacid'],
        "article_id"=>$article_id,
        "openid"=>$openid,
        "oauth_openid"=>empty($_SESSION['oauth_openid'])?$_W['fans']['from_user']:$_SESSION['oauth_openid'],
        "shang_money"=>$moneynum,
        "out_trade_no"=>$orderid,
        "shang_status"=>0,
        "shang_time"=>time(),
        "headimg"=>tomedia($_W['fans']['tag']['avatar'])
    );
    pdo_insert('dg_article_shang',$data);

}
$kjSetting=$this->findKJsetting();
function getpayment($money,$kjSetting){
    global $_W,$_GPC;
    $money= floatval($money);
    $money=(int)($money*100);
 
    $out_trade_no =  date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    if($_GPC['pay_type']=='uni'){
        $jsApi = new JsApi_pub($kjSetting);
        $openid=$_W['openid'];
        if($_W["account"]["level"]<4){
            $openid=$_SESSION['oauth_openid'];
        }
        $unifiedOrder = new UnifiedOrder_pub($kjSetting);
        $unifiedOrder->setParameter("openid", "$openid");//商品描述
        $unifiedOrder->setParameter("body", "课程打赏");//商品描述
        $timeStamp = time();
        
        $unifiedOrder->setParameter("out_trade_no", "$out_trade_no");//商户订单号
        $unifiedOrder->setParameter("total_fee", $money);//总金额
        $notifyUrl = $_W['siteroot'] . "addons/dg_articlemanage/shang.php";
        $unifiedOrder->setParameter("notify_url", $notifyUrl);//通知地址
        $unifiedOrder->setParameter("trade_type", "JSAPI");//交易类型
        $prepay_id = $unifiedOrder->getPrepayId();
        $jsApi->setPrepayId($prepay_id);
        $jsApiParameters = $jsApi->getParameters();
    }

    //插入数据到赞赏表中

    ordersubmit($out_trade_no,$money);
        $data=array(
            'money'=>$money,
            'out_trade_no'=>$out_trade_no,
            'jsApiParameters'=>$jsApiParameters
        );
    return $data;
}
$money=$_GPC['sdol'];
$id=$_GPC['article_id'];
$uniacid=$_W['uniacid'];

$detail = pdo_fetch("SELECT * FROM " . tablename('dg_article') . " WHERE `id`=:id and uniacid=:uniacid", array(':id'=>$id,':uniacid' => $uniacid));

if(!empty($money)){
    $pay_parameters="{}";
    $pay_parameters=getpayment($money,$kjSetting);
    $data=$pay_parameters;
    header("Content-type:application/json");
   echo json_encode($data);
    exit();
}

