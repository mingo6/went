<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/8/17
 * Time: 10:48
 */
global $_W,$_GPC;
$pcate=$_GPC['pcate'];
$ccate=$_GPC['ccate'];
$uniacid=$_W['uniacid'];
$pindex = max(1, intval($_GPC['page']));
$cfg=$this->module['config'];
$psize=empty($cfg['dg_article_num']) ? 20 : intval($cfg['dg_article_num']);
if($_GPC['recommend']==2){
    $status=' and A2.recommend=2';
}else{
    $status=' and A2.status=2';
}

$conditions=" A2 where A2.uniacid=:uniacid ".$status;
$parms[':uniacid']=$uniacid;

if($_GPC['search']){
     $conditions.=" AND A2.title like '%".$_GPC['search']."%' ";
}
if($_GPC['pcate'] && empty($_GPC['ccate'])){
    $conditions.=" and A2.pcate=:pcate";
    $parms[':pcate']=$_GPC['pcate'];
}
if($_GPC['pcate'] && $_GPC['ccate']){
    $conditions.=" and A2.pcate=:pcate AND A2.ccate=:ccate";
    $parms[':pcate']=$_GPC['pcate'];
    $parms[':ccate']=$_GPC['ccate'];
}

$total = pdo_fetchcolumn("SELECT count(0) FROM ".tablename("dg_article").$conditions,$pars);
$pages = ceil($total / $psize);

$sql="select *,(SELECT nickname FROM ".tablename('dg_article_author')." A1 WHERE A1.id=A2.author_id) as author_name from ".tablename('dg_article').$conditions." order by A2.displayorder desc,A2.id desc limit ".intval($pindex-1)*$psize.",".$psize;
$list=pdo_fetchall($sql,$parms);

foreach($list as &$item) {
    $ausql="select * from ".tablename('dg_article_author')." where uniacid=:uniacid and id=:id";
    $auparms=array(":uniacid"=>$uniacid,":id"=>$item['author_id']);
    $authorinfo=pdo_fetch($ausql,$auparms);
    $item['content']=htmlspecialchars_decode($item['content']);
    $item['description']=strip_tags(htmlspecialchars_decode($item['description']));
    $item['thumb'] = tomedia($item['thumb']);
    $item['time']=date('Y-m-d',$item['createtime']);
    if(!empty($authorinfo['nickname'])){
        $item['aname']=$authorinfo['nickname'];
    }
    unset($item);
}

$data=array();
$data['list']=$list;

$data['page']=$pindex;
$data['total']=$total;
$data['psize']=$psize;
header('Content-type: application/json');
echo json_encode($data);