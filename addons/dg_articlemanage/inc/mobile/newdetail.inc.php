<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/11/24
 * Time: 15:56
 */
global $_W,$_GPC;
load()->func('tpl');
$id=$_GPC['id'];
$uniacid=$_W['uniacid'];
$detail=pdo_fetch("select * from ".tablename('dg_article')." WHERE `id`=:id and uniacid=:uniacid", array(':id'=>$id,':uniacid' => $uniacid));
$data=array();
$data['clickNum']=$detail['clickNum']+1;
pdo_update('dg_article',$data,array('id'=>$id));
include $this->template('newdetail');