<?php
global $_W,$_GPC;
if($_GPC['op'] == 'list')
{
    $info = Util::getAllDataInSingleTable('gt_library_class',array('uniacid'=>$_W['uniacid']),$_GPC['page'],10,' `id` DESC ');
    $list = $info[0];
    $pager = $info[1];
}
elseif($_GPC['op'] == 'add' || $_GPC['op'] == 'edit')
{
    //添加，编辑
	if(checksubmit('create')){
		$_GPC = Util::trimWithArray($_GPC);
		
		$data['name'] = $_GPC['name'];
		$data['uniacid'] = $_W['uniacid'];
		if(!empty($_GPC['id'])){
			$id = intval($_GPC['id']);
			$res = pdo_update('gt_library_class', $data ,array('uniacid'=>$_W['uniacid'] ,'id'=>$id));	
		}else{
            $data['create_time'] = TIMESTAMP;
			$res = Util::inserData('gt_library_class',$data);
			$id = pdo_insertid();
		}
		message('操作成功',$this->createWebUrl('library_class',array('op'=>'list','page'=>$_GPC['page'])),'success');
    }
    if($_GPC['id'] > 0){
        $id = intval($_GPC['id']);
        $info = pdo_get('gt_library_class',array('uniacid'=>$_W['uniacid'],'id'=>$id));
    }
}
elseif($_GPC['op'] == 'delete')
{
    $res = WebCommon::deleteSingleData($_GPC['id'],'gt_library_class');
    if($res) message('删除成功',referer(),'success');
}

include $this->template('web/library_class');