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
$op=!empty($_GPC['op']) ? $_GPC['op'] :'display';
$keyword=$_GPC['keyword'];
$uniacid=$_W['uniacid'];
$condition="uniacid=:uniacid";
if(!empty($keyword)){
    $condition.=" and nickname like '%".$keyword."%' ";
}
$sql="select * from ".tablename('mc_mapping_fans')." where ".$condition ." order by followtime desc ";

$parms=array(":uniacid"=>$uniacid);
$ds=pdo_fetchall($sql,$parms);
foreach($ds as &$item){
    $header=mc_fetch($item['openid']);
    if($header['avatar']){
    	$item['avatar']=$header['avatar'];
    }else{
    	$user=pdo_get('dg_article_user',array('uniacid'=>$uniacid,'openid'=>$item['openid']));
    	$item['avatar']=$user['avatar'];
    }
    
}
include $this->template('author');