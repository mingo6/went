<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/9/1
 * Time: 10:09
 */
global $_W,$_GPC;
load()->func('tpl');
$id=$_GPC['id'];
$pindex=max(1,intval($_GPC['page']));
$psize=10;
$uniacid=$_W['uniacid'];
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
//全选设置
if($op=='checkbox'){
    $newid=$_GPC['checkbox_val'];   //传过来的用户id组
    $aid=$_GPC['aid'];              //课程的id
    $sql="select * from ".tablename('dg_article')." where  uniacid=:uniacid and id=:aid" ;
    $parms=array(":uniacid"=>$uniacid,":aid"=>$aid);
    $array=pdo_fetch($sql,$parms);  //查找此分组中已经存在的用户id
    
    $endid= array(
        'appo_users'=>$array['appo_users'].$newid // 组合成最后要存的用户id
            );
    $new=pdo_update('dg_article',$endid,array('id'=>$aid));   //更新用户id
    if ($new){
        $data=array(
            'success'=>1
        );
    } else {
      $data=array(
            'success'=>0
        );
    }
    header("Content-type:application/json");
    echo json_encode($data);
    die;
    
}

//查询此课程添加的分组id
$sql="select appo_users from ".tablename('dg_article')."  where  id=".$_GET['id']." and uniacid=:uniacid ";
$parms=array(":uniacid"=>$uniacid);
$appointid=pdo_fetch($sql,$parms);
$appointid=  substr($appointid['appo_users'], 0, -1);
//查询不在此课程指定分组的分组
if(!empty($appointid)){
    $sql="select * from ".tablename('dg_article_group')."  where id not in ($appointid) and uniacid=:uniacid limit ".intval($pindex-1)*$psize.",".$psize;
    $parms=array(":uniacid"=>$uniacid);
    $records=pdo_fetchall($sql,$parms);
    $total = pdo_fetchcolumn("select count(*) from ".tablename('dg_article_group')."  where id not in ($appointid) ",array(":uniacid"=>$uniacid));    
    
}else{
    $sql="select * from ".tablename('dg_article_group')."  where  uniacid=:uniacid limit ".intval($pindex-1)*$psize.",".$psize;
    $parms=array(":uniacid"=>$uniacid);
    $records=pdo_fetchall($sql,$parms);
    $total = pdo_fetchcolumn("select count(*) from ".tablename('dg_article_group')."  where uniacid=:uniacid ",array(":uniacid"=>$uniacid));    
    
}
$pager=pagination($total,$pindex,$psize);
include $this->template('add_appoint');

