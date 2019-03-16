<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];
$userinfo=$this->getUserInfo();
$userinfo = json_decode($userinfo,true);
$pindex = max(1,intval($_GPC['page']));	
$psize = 10;
$op = $_GPC['op'];
$marketing=1;
if(!empty($_GPC['marketing'])){
	$marketing = intval($_GPC['marketing']);
}
$sql="select * from ".tablename('dg_article')."where uniacid={$uniacid} and marketing={$marketing} and status=2 limit ".($pindex - 1)*$psize . ',' . $psize;
$article=pdo_fetchall($sql);

foreach($article as &$item){
    $item['thumb']=tomedia($item['thumb']);
    $item['createtime']=date('Y-m-d',$item['createtime']);
    unset($item);
}
if(!empty($op)&&$op=='mo'){
	exit(json_encode($article));
}


include $this->template('marketing');
