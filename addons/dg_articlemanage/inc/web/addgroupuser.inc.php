<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2017/1/16
 * Time: 17:30
 */
global $_W,$_GPC;
load()->func('tpl');
$id=$_GPC['id'];
$uniacid=$_W['uniacid'];
$keyword=$_GPC['keyword'];
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$pindex=max(1,intval($_GPC['page']));
$psize=10;
//多选操作
if($op=='checkbox'){
    $newid=$_GPC['checkbox_val'];   //传过来的用户id组
    $gid=$_GPC['gid'];              //分组的id
    $sql="select * from ".tablename('dg_article_group')." where  uniacid=:uniacid and id=:gid" ;
    $parms=array(":uniacid"=>$uniacid,":gid"=>$gid);
    $array=pdo_fetch($sql,$parms);  //查找此分组中已经存在的用户id
    $endid= array(
        'userid'=>$array['userid'].$newid // 组合成最后要存的用户id
            );
    $new=pdo_update('dg_article_group',$endid,array('id'=>$gid));   //更新用户id
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

//搜索
if(!empty($keyword)){
     $condition=" nickname like '%".$keyword."%' and ";
      //查此分组下面用户的id
    $sql="select * from ".tablename('dg_article_group')." where  uniacid=:uniacid and id=:id" ;
    $parms=array(":uniacid"=>$uniacid,":id"=>$id);
    $array=pdo_fetch($sql,$parms);  //查找此分组中已经存在的用户id
    $arrid=$array['userid'];
    $arrid=substr($arrid,0,-1);
    //如果此分组是否有成员
    if(!empty($arrid)){
        //根据昵称查找并且此分组不在存在的成员
        $sql="select * from ".tablename('dg_article_user')." where ".$condition." uniacid=:uniacid and id not in ($arrid) order by id desc limit ".intval($pindex-1)*$psize.",".$psize;;
        $parms=array(":uniacid"=>$uniacid);
        $total=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_user')." where ".$condition." uniacid=:uniacid and id not in ($arrid)",$parms);
    }else{
        $aa=2;
        $sql="select * from ".tablename('dg_article_user')." where ".$condition." uniacid=:uniacid  order by createtime desc limit ".intval($pindex-1)*$psize.",".$psize;
        $parms=array(":uniacid"=>$uniacid);
        $total=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_user')." where ".$condition." uniacid=:uniacid ",$parms);
    }
} else {
    //查此分组下面用户的id
    $sql="select * from ".tablename('dg_article_group')." where  uniacid=:uniacid and id=:id" ;
    $parms=array(":uniacid"=>$uniacid,":id"=>$id);
    $array=pdo_fetch($sql,$parms);  //查找此分组中已经存在的用户id
    $arrid=$array['userid'];
    $arrid=substr($arrid,0,-1);
    //如果此分组是否有成员
    if(!empty($arrid)){
        //查找此分组不在存在的成员
        $sql="select * from ".tablename('dg_article_user')." where  uniacid=:uniacid and id not in ($arrid) order by createtime desc limit ".intval($pindex-1)*$psize.",".$psize;
        $parms=array(":uniacid"=>$uniacid);
        $total=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_user')." where uniacid=:uniacid and id not in ($arrid)",$parms);
    }  else {
        $sql="select * from ".tablename('dg_article_user')." where  uniacid=:uniacid  order by createtime desc limit ".intval($pindex-1)*$psize.",".$psize;
        $parms=array(":uniacid"=>$uniacid);
        $total=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_user')." where uniacid=:uniacid ",$parms);
    }
}

$records=pdo_fetchall($sql,$parms);
$pager=pagination($total,$pindex,$psize);
include $this->template('addgroupuser');


