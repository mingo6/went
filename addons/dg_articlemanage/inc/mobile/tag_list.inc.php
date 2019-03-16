<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];
$category=pdo_fetchall("select id,name,parentid from ".tablename('dg_article_category')." where uniacid=:uniacid  order by displayorder desc,id desc",array(":uniacid"=>$uniacid));
include $this->template('tag_list');