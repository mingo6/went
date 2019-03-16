<?php
global $_W,$_GPC;
$uniacid=$_W['uniacid'];
$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nickname=$userinfo['nickname'];
$avatar=$userinfo['headimgurl'];

$cfg=$this->module['config'];
$pay_template=$cfg['pay_template'];
$dg_article_scale=empty($cfg['dg_article_scale'])? 0.3 :floatval($cfg['dg_article_scale']);

if($_GPC['type']=='zl'||$_GPC['type']=='dp'){
	$payment=pdo_get('dg_article_payment',array("out_trade_no"=>$_GPC['out_trade_no'],'uniacid'=>$uniacid));
	$author=pdo_get("dg_article_author",array('id'=>$payment['author_id']));
	$user = pdo_get("dg_article_user",array("openid"=>$author['openid'],'uniacid'=>$uniacid));
	if($payment['fromer']){
		$withdrawals=number_format((floatval($_GPC['money']))*0.98*floatval($author['scale'])*(1-$dg_article_scale)+$user['withdrawals'],2);
		$profit=number_format((floatval($_GPC['money']))*0.98*floatval($author['scale'])*(1-$dg_article_scale)+$user['profit'],2);
		$all_money=number_format((floatval($_GPC['money']))*0.98*floatval($author['scale'])*(1-$dg_article_scale)+$user['all_money'],2);
	}else{
		$withdrawals=number_format((floatval($_GPC['money']))*0.98*floatval($author['scale'])+floatval($user['withdrawals']),2);
		$profit=number_format((floatval($_GPC['money']))*0.98*floatval($author['scale'])+floatval($user['profit']),2);
		$all_money=number_format((floatval($_GPC['money']))*0.98*floatval($author['scale'])+floatval($user['all_money']),2);
	}
	pdo_update("dg_article_user",array('all_money'=>$all_money,'withdrawals'=>$withdrawals,'profit'=>$profit),array("openid"=>$author['openid'],'uniacid'=>$author['uniacid']));
	if($payment['fromer']){
		$user = pdo_get("dg_article_user",array("uniacid"=>$uniacid,'openid'=>$payment['fromer']));
		$share_all=number_format(floatval($_GPC['money'])*0.98*floatval($dg_article_scale)+floatval($user['share_all']),2);
		$share_nodrawals=number_format(floatval($_GPC['money'])*0.98*floatval($dg_article_scale)+floatval($user['share_nodrawals']),2);
		$share_profit=number_format(floatval($_GPC['money'])*0.98*floatval($dg_article_scale)+floatval($user['share_profit']),2);
		pdo_update("dg_article_user",array('share_all'=>$share_all,'share_nodrawals'=>$share_nodrawals,'share_profit'=>$share_profit),array("uniacid"=>$uniacid,'openid'=>$payment['fromer']));
	}
}else{
	$payment=pdo_get('dg_article_recharge',array("out_trade_no"=>$_GPC['out_trade_no'],'uniacid'=>$uniacid));
	if($payment['fopenid']){
		$user = pdo_get("dg_article_user",array("uniacid"=>$uniacid,'openid'=>$payment['fopenid']));
		$share_all=number_format(floatval($_GPC['money'])*0.98*$dg_article_scale+$user['share_all'],2);
		$share_nodrawals=number_format(floatval($_GPC['money'])*0.98*$dg_article_scale+$user['share_nodrawals'],2);
		$share_vip=number_format(floatval($_GPC['money'])*0.98*$dg_article_scale+$user['share_vip'],2);
		pdo_update("dg_article_user",array('share_all'=>$share_all,'share_nodrawals'=>$share_nodrawals,'share_vip'=>$share_vip),array("uniacid"=>$uniacid,'openid'=>$payment['fopenid']));
	}
}
if($_GPC['type']=='zl'){
	$type="专栏:".$_GPC['title'];
	$url=$this->get_normal_url('serialize_detail',array("id"=>$_GPC['id']));
}elseif($_GPC['type']=='dp'){
	$type="单篇:".$_GPC['title'];
	$url=$this->get_normal_url('detail',array("id"=>$_GPC['id']));
}else{
	$type="会员充值";
	
	$url=$this->get_normal_url('center');
}
$post_data=array(
	'first' => array(
		'value' => "付费阅读消费提醒",
		"color" => "#4a5077"
	),
	'keyword1' => array(
		'value' =>$_GPC['money'].'元',
		"color" => "#4a5077"
	),
	'keyword2' => array(
		'value' =>$type,
		"color" => "#4a5077"
	), 
	'keyword3' => array(
		'value' => $_GPC['out_trade_no'],
		"color" => "#4a5077"
	), 
	'remark' => array(
	    'value' => "点击查看购买的商品！",
	    "color" => "#09BB07"
	)
);

$sendResult=$this->sendTplNotice($openid,$pay_template,$post_data,$url);
header('Content-type: application/json');
$res['con']=1;
echo json_encode($res);
exit;