<?php
global $_W,$_GPC;
if(checksubmit('deleteall')){
    if(empty($_GPC['checkall'])) {message('请选择要删除的奖品！');}
    $rs = WebCommon::deleteDataInWeb($_GPC['checkall'], 'gt_prize');
    if($rs){
        message('删除成功！',referer(),'success');
    }else{
        message('删除失败！');
    }
}

if($_GPC['op'] == 'list')
{
    $info = Util::getAllDataInSingleTable('gt_prize',array('uniacid'=>$_W['uniacid']),$_GPC['page'], $this->pagesize,' `id` DESC ');
    $list = $info[0];
    $pager = $info[1];
}
elseif($_GPC['op'] == 'add' || $_GPC['op'] == 'edit')
{
    //添加，编辑
	if(checksubmit('create')){
		$_GPC = Util::trimWithArray($_GPC);
        empty($_GPC['prize_name']) && message('奖品名称不能为空！');
		$data['prob'] = $_GPC['prob'];
		$data['prize_name'] = $_GPC['prize_name'];
        $data['prize_img'] = $_GPC['prize_img'];
        $data['num'] = $_GPC['num'];
        $data['sort'] = $_GPC['sort'];
		if(!empty($_GPC['id'])){
			$id = intval($_GPC['id']);
			$res = pdo_update('gt_prize', $data ,array('uniacid'=>$_W['uniacid'] ,'id'=>$id));	
		}else{
            $data['create_time'] = TIMESTAMP;
			$res = Util::inserData('gt_prize',$data);
			$id = pdo_insertid();
		}
		message('操作成功',$this->createWebUrl('prize',array('op'=>'list','page'=>$_GPC['page'])),'success');
    }
    if($_GPC['id'] > 0){
        $id = intval($_GPC['id']);
        $info = pdo_get('gt_prize',array('uniacid'=>$_W['uniacid'],'id'=>$id));
    }
}
elseif($_GPC['op'] == 'delete')
{
    $res = WebCommon::deleteSingleData($_GPC['id'], 'gt_prize');
    if($res) message('删除成功',referer(),'success');
    else message('删除失败');
}
include $this->template('web/prize');