<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];
$userinfo = $_SESSION['userinfo'];

if (empty($_GPC['page'])){
    $_GPC['page']=1;
}

//活动列表
if (empty($_GET['my'])){
    $info = Util::getAllDataInSingleTable('active_activity',array('is_default'=>1,'uniacid'=>$uniacid),$_GPC['page'],3);
    $list = $info[0];
    $pageAll = ceil($info[2]/3);
    $my=0;
}
//我的活动列表
else{
    $id = Util::getColumnDataInSingleTable('active_users_activity',array('uniacid'=>$uniacid,'user_id'=>$userinfo['id']),'id');

    $list = pdo_fetchall("select b.*,a.id aid from ".tablename('active_users_activity')." as a left join ".tablename('active_activity')." as b on a.activity_id = b.id where a.user_id = :id and a.uniacid = :uniacid order by a.id desc",array(':id'=>$userinfo['id'],':uniacid'=>$uniacid));

    $pageAll = 1;
    $my=$userinfo['id'];
}


$html= '';

foreach ($list as $k=>$v)
{
    $html .= "<a href='".$this->createMobileUrl('info')."&id=".$v['id']."&ua=".$v['aid']."'>";
    $html .= "<div class='list-item'>";
    $html .= "<img src='/attachment/".$v['active_img']."'>";
    $html .= "<p class='title'>".$v['title']."</p>";
    $html .= "<p class='subtitle ellipsis--1'>".$v['index_synopsis']."</p>";
    $html .= "<div class='release-time'>";
    $html .= "<img src='../addons/".MODULE."/template/mobile/icon/time.png'>";
    $html .= "<span>".date('m月d日 H:i:s',$v['start_time'])."-".date('m月d日 H:i:s',$v['end_time'])."</span>";
    $html .= "</div></div></a>";
}

exit(json_encode(['page'=>$_GPC['page'],'msg'=>$html,'pageAll'=>(int)$pageAll]));