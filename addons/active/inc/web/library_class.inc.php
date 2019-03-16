<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];

//活动列表
if($_GPC['op'] == 'list')
{
    if (empty($_GPC['page'])){
        $_GPC['page']=1;
    }
    $info = Util::getAllDataInSingleTable('active_activity',array('is_default'=>1,'uniacid'=>$uniacid),$_GPC['page'],10);

    $list = $info[0];
    $pager = $info[1];
}
//发布活动
elseif($_GPC['op'] == 'add' || $_GPC['op'] == 'edit')
{
	if(checksubmit('submit')){
        $_GPC = Util::trimWithArray($_GPC);


        $dat = array(
            'active_img' => $_GPC['active_img'],
            'share_img' => $_GPC['share_img'],
            'title' => $_GPC['title'],
            'index_synopsis' => $_GPC['index_synopsis'],
            'address' => $_GPC['address'],
            'sham_people_num' => $_GPC['sham_people_num'],
            'is_sham_people_num' => $_GPC['is_sham_people_num'],
            'start_time' => strtotime($_GPC['start_time']),
            'end_time' => strtotime($_GPC['end_time']),
            'need_fabulous_num' => $_GPC['need_fabulous_num'],
            'limited_num' => $_GPC['limited_num'],
            'product_video_url' => empty($_GPC['product_video_url'])?1:$_GPC['product_video_url'],
            'product_introduce' => $_GPC['product_introduce'],
            'synopsis' => $_GPC['synopsis'],
            'rule' => $_GPC['rule'],
            'create_time' => time()
        );

        foreach($dat as $k=>$v)
        {
            if ($v=='') message('请填写完整信息！');
        }

        if($dat['limited_num'] < 0) message('奖品数量需大于0！');
        if($dat['sham_people_num'] < 0) message('参与人数需大于0！');
        if($dat['need_fabulous_num'] < 1) message('集赞数需大于1！');
        if($dat['start_time'] >= $dat['end_time']) message('开始时间不能大于结束时间！');

        if ($dat['product_video_url']==1){
            $dat['product_video_url']='';
        }

        //添加或更新数据库
        if (!empty($_GPC['id'])){
            $id = intval($_GPC['id']);
            $res = pdo_update('active_activity', $dat ,array('id'=>$id));
            if ($res) {
                message('编辑成功', 'refresh');
            }
        }else{
            $res = Util::inserData('active_activity',$dat);
            if ($res) {
                message('发布成功', 'refresh');
            }
        }
    }
    if($_GPC['id'] > 0){
        $id = intval($_GPC['id']);
        $info = pdo_get('active_activity',array('id'=>$id));
    }
}
//删除活动
elseif($_GPC['op'] == 'delete')
{
    $res = pdo_update('active_activity', array('is_default'=>0) ,array('id'=>$_GPC['id']));
    if($res) message('删除成功',referer(),'success');
}

include $this->template('web/library_class');