<?php
global $_W,$_GPC;

function ajaxreturn($code, $msg)
{
    echo json_encode(array('code'=>$code, 'msg'=>$msg));
    exit;
}

$type = $_GPC['type'];

if (empty($type)) 
{
    include $this->template('dusk');
}
elseif($type == 'post')
{
    $quest_one = $_GPC['quest_one'];
    if(empty($_GPC['quest_one'])) ajaxreturn(10000, '请选择乘客服务类!');
    
    $quest_two = $_GPC['quest_two'];
    if(empty($_GPC['quest_two'])) ajaxreturn(10000, '请选择乘客安全类!');

    $content = $_GPC['content'];
    if(empty($_GPC['content'])) $_GPC['content'] = '--';

    $data = array(
        'uniacid' => $_W['uniacid'],
        'quest_one' => $quest_one,
        'quest_two' => $quest_two,
        'content' => $content,
        'create_time' => time()
    );
    $res = Util::inserData('gt_dusk',$data);
    if(!$res) ajaxreturn('系统错误！');

    ajaxreturn(200, '成功');
}