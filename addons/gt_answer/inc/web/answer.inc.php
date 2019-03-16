<?php
global $_W,$_GPC;
$libraryInfo = pdo_get('gt_library', array('uniacid'=>$_W['uniacid'], 'id' => $_GPC['library_id']));
if(empty($libraryInfo)){
    message('题目不存在！');
}

if(checksubmit('deleteall')){
    if(empty($_GPC['checkall'])) {message('请选择要删除的题目！');}
    $rs = WebCommon::deleteDataInWeb($_GPC['checkall'], 'gt_library_answer');
    if($rs){
        message('删除成功！',referer(),'success');
    }else{
        message('删除失败！');
    }
}


if($_GPC['op'] == 'list')
{
    $info = Util::getAllDataInSingleTable('gt_library_answer',array('uniacid'=>$_W['uniacid'], 'library_id' => $_GPC['library_id']),$_GPC['page'],10,' `id` DESC ');
    $list = $info[0];
    $pager = $info[1];
}
elseif($_GPC['op'] == 'add' || $_GPC['op'] == 'edit')
{
    //添加，编辑
	if(checksubmit('create')){
        empty($_GPC['library_id']) && message('题目id不能为空！');
        empty($_GPC['answer_no']) && message('答案编号不能为空！');
        empty($_GPC['answer_content']) && message('答案内容不能为空！');
		$data['library_id'] = $_GPC['library_id'];
		$data['answer_content'] = $_GPC['answer_content'];
		$data['answer_no'] = $_GPC['answer_no'];
		$data['sort'] = $_GPC['sort'];
		if(!empty($_GPC['id'])){
			$id = intval($_GPC['id']);
			$res = pdo_update('gt_library_answer', $data ,array('uniacid'=>$_W['uniacid'] ,'id'=>$id));	
		}else{
			$res = Util::inserData('gt_library_answer',$data);
			$id = pdo_insertid();
		}
		message('操作成功',$this->createWebUrl('answer',array('op'=>'list','page'=>$_GPC['page'], 'library_id' => $_GPC['library_id'])),'success');
    }
    $classArr = pdo_getall('gt_library_class', array('uniacid'=>$_W['uniacid']));
    if($_GPC['id'] > 0){
        $id = intval($_GPC['id']);
        $info = pdo_get('gt_library_answer',array('uniacid'=>$_W['uniacid'],'id'=>$id));
    }
}
elseif($_GPC['op'] == 'delete')
{
    $res = WebCommon::deleteSingleData($_GPC['id'], 'gt_library_answer');
    if($res) message('删除成功',referer(),'success');
    else message('删除失败');
}
include $this->template('web/answer');