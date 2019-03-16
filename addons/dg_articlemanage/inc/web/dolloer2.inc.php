<?php

global $_GPC, $_W;
$op= $_GPC['op'] ? $_GPC['op'] : 'display';
$uniacid= $_W['uniacid'];
$pindex= max(1, intval($_GPC['page']));
$condition="";
if(!empty($_GPC['keyword'])) {
    $condition .= " where title LIKE '%".$_GPC['keyword']."%'";
}
$psize= 20; //每页显示
$sql1="SELECT A1.*,A2.title,'课程' as type FROM ".tablename('dg_article_payment')." A1 INNER JOIN ".tablename('dg_article')." A2 ON A1.article_id=A2.id WHERE order_status=1 AND A2.uniacid=:uniacid ";
$sql2="SELECT A1.*,A2.serialize_title as title,'专栏' as type FROM ".tablename('dg_article_payment')." A1 INNER JOIN ".tablename('dg_article_serialize')." A2 ON A1.serialize_id=A2.id WHERE order_status=1 AND A2.uniacid=:uniacid ";

$sql="select * from (".$sql1." union all ".$sql2.") as a ".$condition." ORDER BY ID DESC LIMIT ".($pindex -1) * $psize.','.$psize;

// $sql="SELECT A1.*,A2.title FROM ".tablename('dg_article_payment')." A1 INNER JOIN ".tablename('dg_article')." A2 ON A1.article_id=A2.id WHERE order_status=1 AND A2.uniacid=:uniacid ".$condition." ORDER BY ID DESC LIMIT ".($pindex -1) * $psize.','.$psize;
$list=pdo_fetchall($sql,array(':uniacid' => $uniacid));
load()->model('mc');

foreach($list as &$v) {
    if(!empty($v['openid'])) {
        $user = mc_fetch($v['openid'], array('realname', 'nickname', 'mobile', 'email', 'avatar'));
    }
    if(empty($user)){
        $user=mc_fansinfo($v['openid']);
    }
        $v['nickname']=$user['nickname'];


    unset($user);
}
$all_sql="select count(1) as mcount,sum(pay_money) as mmoney from (".$sql1." union all ".$sql2.") as a ".$condition." ORDER BY ID DESC LIMIT ".($pindex -1) * $psize.','.$psize;
$amount=pdo_fetch($all_sql,array(':uniacid' => $uniacid));
$total=$amount['mcount'];
$sum=$amount['mmoney'];
$pager= pagination($total, $pindex, $psize);

include $this->template('dolloer');
