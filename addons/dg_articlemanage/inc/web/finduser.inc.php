<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/8/31
 * Time: 17:46
 */
global $_W,$_GPC;
load()->func('tpl');
load()->model('mc');
//$op=!empty($_GPC['op']) ? $_GPC['op'] :'display';
$keyword=$_GPC['keyword'];
$uniacid=$_W['uniacid'];
$condition="uniacid=:uniacid";
if(!empty($keyword)){
    $condition.=" and nickname like '%".$keyword."%' ";
}
$sql="select * from ".tablename('dg_article_user')." where ".$condition ." order by  createtime desc ";

$parms=array(":uniacid"=>$uniacid);
$ds=pdo_fetchall($sql,$parms);
foreach($ds as &$item){
    $header=mc_fetch($item['openid']);
    $item['avatar']=$header['avatar'];
}
include $this->template('author');

