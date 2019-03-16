<?php
global $_W,$_GPC;
$uniacid=$_W['uniacid'];
$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nickname=$userinfo['nickname'];
$avatar=$userinfo['headimgurl'];
$serialize_id=$_GPC['id'];
$temp_url=$this->createMobileUrl('serialize_detail');
    $temp_url=substr($temp_url, 1);
    $send_url=$_W['siteroot']."app".$temp_url;
$is_pay = pdo_get('dg_article_payment',array('openid'=>$openid,'serialize_id'=>$serialize_id,'order_status'=>1));
$is_vip = pdo_get('dg_article_user',array('uniacid'=>$uniacid,'openid'=>$openid,'info_status'=>2));
$serialize = pdo_fetch("SELECT *,(SELECT count(0)+A2.pay_num FROM ".tablename('dg_article_payment')." A3 WHERE A3.order_status=1 AND A3.serialize_id=A2.id) as pay_num,(SELECT nickname FROM ".tablename('dg_article_author')." A1 WHERE A1.openid=A2.author_openid) as author_name,(SELECT id FROM ".tablename('dg_article_author')." A1 WHERE A1.openid=A2.author_openid) as author_id FROM ".tablename('dg_article_serialize')." A2 WHERE A2.uniacid=:uniacid AND A2.id=:id",array(":uniacid"=>$uniacid,":id"=>$serialize_id));
$shareimg = $serialize['serialize_img'];
$url=$_W['siteroot']."app/".substr($this->createMobileUrl('serialize_detail',array('id'=>$serialize['id'],'uniacid'=>$uniacid),true),2);

$is_author=pdo_get("dg_article_author",array('openid'=>$openid,'uniacid'=>$uniacid,'id'=>$serialize['author_id']));
$pcate = pdo_get("dg_article_category",array('id'=>$serialize['pcate']));
$ccate = pdo_get("dg_article_category",array('id'=>$serialize['ccate']));
$new_serialize = pdo_fetch("SELECT * FROM ".tablename('dg_article_serializefb')." WHERE serialize_id=:serialize_id ORDER BY displayorder DESC",array(":serialize_id"=>$serialize['id']));
$pindex=max(1,intval($_GPC['page']));
$psize=5;
$total = pdo_fetchcolumn("SELECT count(*) FROM ".tablename('dg_article_serializedis')." WHERE uniacid=:uniacid AND status=2 AND reply_id=0 AND serialize_id=:serialize_id",array(':uniacid'=>$uniacid,":serialize_id"=>$serialize_id));

$dis_list = pdo_fetchall("SELECT * FROM ".tablename('dg_article_serializedis')." WHERE uniacid=:uniacid AND reply_id=0 AND serialize_id=:serialize_id AND status=2 ORDER BY id DESC limit ".intval($pindex-1)*$psize.",".$psize,array(':uniacid'=>$uniacid,":serialize_id"=>$serialize_id));
foreach ($dis_list as $k => $v) {
	$dis_list[$k]['createtime']=date("Y-m-d H:i:s",$v['createtime']);
}
$length=strlen($serialize['serialize_desc']);
if($_GPC['page']){
	$data['list']=$dis_list;
	$data['page']=$pindex;
	$data['total']=$total;
	$data['psize']=$psize;
	header('Content-type: application/json');
	echo json_encode($data);
	exit;
}
if($_GPC['type']=='discuss'){
	$data=array(
		"uniacid"=>$uniacid,
		"serialize_id"=>$serialize_id,
		"openid"=>$openid,
		"nickname"=>$nickname,
		"avatar"=>$avatar,
		"discuss"=>$_GPC['discuss'],
		"reply_id"=>0,
		"createtime"=>time()
	);
	pdo_insert("dg_article_serializedis",$data);
	header('Content-type: application/json');
	$res['con']=1;
	echo json_encode($res);
	exit;
}
$collect = pdo_get("dg_article_collect",array('uniacid'=>$uniacid,'serialize_id'=>$serialize_id,'openid'=>$openid));
if($_GPC['type']=='collect'){
	if($_GPC['status']==2){
		$data=array(
			"uniacid"=>$uniacid,
			"openid"=>$openid,
			"serialize_id"=>$serialize_id,
			'createtime'=>time()
		);
		pdo_insert("dg_article_collect",$data);
		$res['con']='收藏成功';
	}elseif($_GPC['status']==1){
		pdo_delete('dg_article_collect',array('uniacid'=>$uniacid,'serialize_id'=>$serialize_id,'openid'=>$openid),"AND");
		$res['con']='已取消收藏';
	}
	header('Content-type: application/json');
	
	echo json_encode($res);
	exit;
}
if($_GPC['type']=='pay'){
	$money= floatval($_GPC['money']);
    $money=(int)($money*100);
    $kjSetting=$this->findKJsetting();
     $out_trade_no =  date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    if($_GPC['pay_type']=='uni'){
		$jsApi = new JsApi_pub($kjSetting);
		
		$openid=$openid;
		if($_W["account"]["level"]<4){
	        $openid=$_SESSION['oauth_openid'];
	    }
	    $unifiedOrder = new UnifiedOrder_pub($kjSetting);
	    $unifiedOrder->setParameter("openid", "$openid");//商品描述
	    $unifiedOrder->setParameter("body", "专栏付费阅读");//商品描述
	    $timeStamp = time();
	   
	    $unifiedOrder->setParameter("out_trade_no", "$out_trade_no");//商户订单号
	    $unifiedOrder->setParameter("total_fee", $money);//总金额
	    $notifyUrl = $_W['siteroot'] . "addons/dg_articlemanage/notify.php";
	    $unifiedOrder->setParameter("notify_url", $notifyUrl);//通知地址
	    $unifiedOrder->setParameter("trade_type", "JSAPI");//交易类型
	    $prepay_id = $unifiedOrder->getPrepayId();
	    $jsApi->setPrepayId($prepay_id);
	    $jsApiParameters = $jsApi->getParameters();
	   }
    $user=pdo_get("dg_article_user",array('uniacid'=>$uniacid,'openid'=>$openid));
    $data=array(
        "uniacid"=>$uniacid,
        "article_id"=>'',
        "openid"=>$openid,
        "oauth_openid"=>empty($_SESSION['oauth_openid'])?$_W['fans']['from_user']:$_SESSION['oauth_openid'],
        "pay_money"=>$money,
        "out_trade_no"=>$out_trade_no,
        "order_status"=>0,
        "author_id"=>$serialize['author_id'],
        "serialize_id"=>$serialize_id,
        "fromer"=>$user['fopenid'],
        "pay_time"=>time()
    );
    pdo_insert('dg_article_payment',$data);
    header('Content-type: application/json');
    $res['out_trade_no']=$out_trade_no;
    $res['money']=$money/100;
    $res['jsApiParameters']=$jsApiParameters;
	echo  json_encode($res);
	//echo  $out_trade_no;

	exit;
}
include $this->template('serialize_detail');   