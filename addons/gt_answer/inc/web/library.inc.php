<?php
global $_W,$_GPC;
if(checksubmit('deleteall')){
    if(empty($_GPC['checkall'])) {message('请选择要删除的题目！');}
    $param = array('uniacid'=>$_W['uniacid'], 'is_delete' => 0);
    foreach($_GPC['checkall'] AS $id){
        $param['id'] = $id;
        $res = pdo_update('gt_library', array('is_delete' => 1), $param);
    }
    message('操作完成',referer(),'success');
}
if($_GPC['op'] == 'list')
{
    $info = Util::getAllDataInSingleTable('gt_library',array('uniacid'=>$_W['uniacid'], 'is_delete' => 0),$_GPC['page'],$this->pagesize,' `id` DESC ');
    $list = $info[0];
    $pager = $info[1];
}
elseif($_GPC['op'] == 'add' || $_GPC['op'] == 'edit')
{
    //添加，编辑
	if(checksubmit('create')){
		$_GPC = Util::trimWithArray($_GPC);
        empty($_GPC['title']) && message('标题不能为空！');
        empty($_GPC['class_id']) && message('分类不能为空！');
        empty($_GPC['grade']) && message('正确答案不能为空！');
        empty($_GPC['bg_time']) && message('背景持续时间不能为空！');
        $libraryClassInfo = pdo_get('gt_library_class', array('id' => $_GPC['class_id'], 'uniacid'=>$_W['uniacid']));
        if(empty($libraryClassInfo)){
            message('分类不存在！');
        }

		$data['class_id'] = $_GPC['class_id'];
		$data['title'] = $_GPC['title'];
		$data['content'] = '';
		$data['bg_img'] = $_GPC['bg_img'];
		$data['correct_response'] = $_GPC['correct_response'];
        $data['grade'] = $_GPC['grade'];
        $data['bg_time'] = $_GPC['bg_time'];
        $data['sort'] = $_GPC['sort'];
        
		if(!empty($_GPC['id'])){
			$id = intval($_GPC['id']);
			$res = pdo_update('gt_library', $data ,array('uniacid'=>$_W['uniacid'] ,'id'=>$id));	
		}else{
            $data['create_time'] = TIMESTAMP;
			$res = Util::inserData('gt_library',$data);
			$id = pdo_insertid();
		}
		message('操作成功',$this->createWebUrl('library',array('op'=>'list','page'=>$_GPC['page'])),'success');
    }
    $classArr = pdo_getall('gt_library_class', array('uniacid'=>$_W['uniacid']));
    if($_GPC['id'] > 0){
        $id = intval($_GPC['id']);
        $info = pdo_get('gt_library',array('uniacid'=>$_W['uniacid'],'id'=>$id));
    }
}
elseif($_GPC['op'] == 'delete')
{
    if(empty($_GPC['id']) || $_GPC['id'] <= 0) {message('请选择要删除的题目！');}
    $param = array('id' => $_GPC['id'], 'uniacid'=>$_W['uniacid'], 'is_delete' => 0);
    $libraryInfo = pdo_get('gt_library', $param);
    if(empty($libraryInfo)){
        message('题目不存在！');
    }
    $res = pdo_update('gt_library', array('is_delete' => 1), $param);
    if($res) message('删除成功',referer(),'success');
    else message('删除失败');
}
include $this->template('web/library');