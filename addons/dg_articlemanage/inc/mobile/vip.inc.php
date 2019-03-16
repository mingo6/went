<?php
global $_W,$_GPC;
load()->func('tpl');
$uniacid=$_W['uniacid'];
$cfg=$this->module['config'];
$cfg['dg_article_recharge']=empty($cfg['dg_article_recharge'])? 5 :floatval($cfg['dg_article_recharge']);
$cfg['dg_article_recharge_qua']=empty($cfg['dg_article_recharge_qua'])? 5 :floatval($cfg['dg_article_recharge_qua']);
$cfg['dg_article_recharge_year']=empty($cfg['dg_article_recharge_year'])? 5 :floatval($cfg['dg_article_recharge_year']);

$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nickname=$userinfo['nickname'];
$avatar=$userinfo['headimgurl'];
$sex=$userinfo['sex'];


$member=pdo_fetch("select * from ".tablename('dg_article_user')." where uniacid=:uniacid and openid=:openid ",array(":uniacid"=>$uniacid,":openid"=>$openid));
function ordersubmit($orderid,$moneynum){
    global $_W,$_GPC;
    $month=intval($_GPC['month']);
    $mode=intval($_GPC['mode']);
    $uniacid=$_W['uniacid'];

    $data=array();
    $data['uniacid']=$uniacid;
    $data['openid']=$openid;
    $data['recharge']=$moneynum;
    $data['out_trade_no']=$orderid;
    $data['rec_status']=0;
    $data['rec_time']=time();
    $data['month']=$month;
    $data['mode']=$mode;
    pdo_insert('dg_article_recharge',$data);
}
$kjSetting=$this->findKJsetting();
function getpayment($money,$kjSetting){
    global $_W;
    $money= floatval($money);
    $money=(int)($money*100);
    $jsApi = new JsApi_pub($kjSetting);
    //$openid=$_W['openid'];
    $unifiedOrder = new UnifiedOrder_pub($kjSetting);
    $unifiedOrder->setParameter("openid", "$openid");//商品描述
    $unifiedOrder->setParameter("body", "阅读会员支付");//商品描述
    $timeStamp = time();
    $out_trade_no =  date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    $unifiedOrder->setParameter("out_trade_no", "$out_trade_no");//商户订单号
    $unifiedOrder->setParameter("total_fee", $money);//总金额
    $notifyUrl = $_W['siteroot'] . "addons/dg_articlemanage/recharge.php";
    $unifiedOrder->setParameter("notify_url", $notifyUrl);//通知地址
    $unifiedOrder->setParameter("trade_type", "JSAPI");//交易类型
    $prepay_id = $unifiedOrder->getPrepayId();
    $jsApi->setPrepayId($prepay_id);
    $jsApiParameters = $jsApi->getParameters();

    //插入数据到赞赏表中

    ordersubmit($out_trade_no,$money);
    return $jsApiParameters;
}

if($_GPC['op']=="post"){
    $rec=floatval($_GPC['rec']);
    $mode=$_GPC['mode'];
    $month=$_GPC['month'];
    switch($mode){
        case 1:
            $rec=floatval($cfg['dg_article_recharge']*$month);
            break;
        case 2:
            $rec=floatval($cfg['dg_article_recharge_qua']*$month);
            break;
        case 3:
            $rec=floatval($cfg['dg_article_recharge_year']*$month);
            break;
        default:
            $rec=floatval($cfg['dg_article_recharge']*$month);
            break;
    }
    $pay_parameters=getpayment($rec,$kjSetting);
    $data=$pay_parameters;
    header("Content-type:application/json");
    echo $data;
    exit();
}
include $this->template('vip');