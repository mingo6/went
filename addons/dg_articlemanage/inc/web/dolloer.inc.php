<?php

global $_GPC, $_W;
load()->model('mc');
$op= $_GPC['op'] ? $_GPC['op'] : 'display';
$uniacid= $_W['uniacid'];
$article_id=$_GPC["article_id"];
$pindex= max(1, intval($_GPC['page']));

$psize= 20; //每页显示
$sql="SELECT A1.*,A2.nickname,A2.avatar  FROM ".tablename('dg_article_payment')." A1 left join ".tablename('dg_article_user')." A2 on A1.openid=A2.openid where article_id=:article_id and order_status=1 AND A1.uniacid=:uniacid ORDER BY ID DESC LIMIT ".($pindex -1) * $psize.','.$psize;
$list=pdo_fetchall($sql,array(':article_id'=>$article_id,':uniacid' => $uniacid));
$total=count($list);

$all=pdo_fetch("select sum(pay_money) as sum from ".tablename('dg_article_payment')." where article_id=:article_id and uniacid=:uniacid and order_status=1",array(":article_id"=>$article_id,":uniacid"=>$uniacid));
$sum=empty($all["sum"])?0.00:$all["sum"];
$pager= pagination($total, $pindex, $psize);

include $this->template('article');
