<?php
global $_W,$_GPC;
if($_GPC['op'] == 'list')
{
    $info = Util::getAllDataInSingleTable('gt_users',array('uniacid'=>$_W['uniacid']),$_GPC['page'], $this->pagesize,' `id` DESC ');
    $list = $info[0];
    $pager = $info[1];
    include $this->template('web/users');
}