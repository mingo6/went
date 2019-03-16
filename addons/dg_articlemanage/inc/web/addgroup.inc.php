<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/12/19
 * Time: 10:32
 */
global $_W,$_GPC;
load()->func('tpl');
$id=$_GPC['id'];
$uniacid=$_W['uniacid'];
//添加分组
$groupname=$_GPC['groupname'];
if(!empty($groupname)){
    $data=array(
        'groupname'=>$_GPC['groupname'],
        'createtime'=>time(),
        'uniacid'=>$uniacid,
    );
    $re=pdo_insert('dg_article_group',$data);
    if(!empty($re)){
        $pindex=max(1,intval($_GPC['page']));
        $psize=10;
        $sql="select * from ".tablename('dg_article_group')." where  uniacid=:uniacid  order by createtime desc limit ".intval($pindex-1)*$psize.",".$psize;
        $parms=array(":uniacid"=>$uniacid);
        $records=pdo_fetchall($sql,$parms);
        $total=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_group')." where uniacid=:uniacid  ",$parms);
        $pager=pagination($total,$pindex,$psize);
        include $this->template('grouping');
        die;
   }
}

include $this->template('addgroup');

