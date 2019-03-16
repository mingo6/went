<?php
global $_W,$_GPC;

if($_GPC['op'] == 'list')
{
    $info = Util::getAllDataInSingleTable('gt_lottery_record',array('uniacid'=>$_W['uniacid']),$_GPC['page'], $this->pagesize,' `prize_id` DESC,`id` DESC ');
    $list = $info[0];
    foreach ($list as $key => $val)
    {
        if(!empty($val['prize_id'])) 
        {
            $list[$key]['is_prize'] = '已中奖';
            $prize_name = pdo_fetch('SELECT gp.prize_name FROM '.tablename('gt_prize').' as gp WHERE id='.$val['prize_id']);
            $list[$key]['prize_name'] = $prize_name['prize_name'];
        }
        else
        {
            $list[$key]['is_prize'] = '未中奖';
            $list[$key]['prize_name'] = '--';
        }
    }
    $pager = $info[1];
}
include $this->template('web/record');