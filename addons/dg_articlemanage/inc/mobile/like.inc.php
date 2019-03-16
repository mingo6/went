<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/8/22
 * Time: 10:12
 */
global $_W,$_GPC;
$userinfo=$this->getUserInfo();
$userinfo=json_decode($userinfo,true);
$openid=$userinfo['openid'];
$nickname=$userinfo['nickname'];
$avatar=$userinfo['headimgurl'];
$sex=$userinfo['sex'];

$uniacid=$_W['uniacid'];
$id=$_GPC['articleid'];
$sql="select * from ".tablename('dg_articlelike')." where tid=:tid and openid=:openid and uniacid=:uniacid order by id desc";
$parms=array(":tid"=>$id,":openid"=>$openid,":uniacid"=>$uniacid);
$result=pdo_fetch($sql,$parms);
$likenum=pdo_fetch("select * from ".tablename('dg_article')." where id=$id and uniacid=$uniacid order by id desc");
$data=array();
header('Content-type: application/json');
if(empty($result)){
    $insert=array(
        'tid'=>$id,
        'openid'=>$openid,
        'likenum'=>1,
        'uniacid'=>$uniacid,
        'createtime'=>TIMESTAMP
    );
    pdo_insert('dg_articlelike',$insert);
    $zancount=pdo_fetchcolumn("select count(*) from ".tablename('dg_articlelike')." where tid=:tid and uniacid=:uniacid",array(":tid"=>$id,":uniacid"=>$uniacid));
    $data['zannum']=intval($likenum['zanNum']+1);
    $up=array('zannum'=>$data['zannum']);
    pdo_update('dg_article',$up,array("id"=>$id));
   $data['success']=1;
}else{
    $data['zannum']=intval($likenum['zanNum']-1);
    $up=array('zannum'=>$data['zannum']);
    pdo_update('dg_article',$up,array("id"=>$id));
    pdo_delete('dg_articlelike',array('uniacid'=>$uniacid,'openid'=>$openid,'tid'=>$id),'AND');
     $data['success']=-1;
}
 echo json_encode($data);
exit;
$data['zannum']=$likenum['zanNum'];
echo json_encode($data);


