<?php 
defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
$_W["page"]["title"] = "资料修改";
$ta = (trim($_GPC["ta"]) ? trim($_GPC["ta"]) : "info");
if( $ta == "edit" ) 
{
    $type = trim($_GPC["type"]);
    $id = $_deliveryer["id"];
    if( $_W["ispost"] ) 
    {
        $data = array(  );
        if($type == "region"){
            $region_id = trim($_GPC["region_id"]);
            if( $region_id <= 0 ) 
            {
                imessage(error(-1, "区域不能为空！"), "", "ajax");
            }
            $regionInfo = pdo_get('tiny_wmall_region', array('id' => $region_id, 'uniacid' => $_W["uniacid"]));
            if(!$regionInfo){
                imessage(error(-1, "区域不存在"), "", "ajax");
            }
            $data = array( "region_id" => $region_id );
            if(!pdo_update("tiny_wmall_deliveryer", $data, array( "id" => $id, "uniacid" => $_W["uniacid"] ))){
                imessage(error(-1, "修改失败"), "", "ajax");
            }
        }
        else
        {
            if( $type == "work_hours" ) 
            {
                if(empty($_GPC['start_work_time'])){
                    imessage(error(-1, "开始工作时间不能为空！"), "", "ajax");
                }
                if(empty($_GPC['end_work_time'])){
                    imessage(error(-1, "结束工作时间不能为空！"), "", "ajax");
                }
                $work_hours = iserializer(array('start' => $_GPC['start_work_time'], 'end' => $_GPC['end_work_time']));
                $data = array( "work_hours" => $work_hours );
                if(!pdo_update("tiny_wmall_deliveryer", $data, array( "id" => $id, "uniacid" => $_W["uniacid"] ))){
                    imessage(error(-1, "修改失败"), "", "ajax");
                }
            }
        }
        imessage(error(0, "修改成功"), "", "ajax");
    }

    if($type == "region"){
        $regionList = pdo_fetchall("select * from" . tablename("tiny_wmall_region") . "where uniacid = :uniacid order by id asc", array( ":uniacid" => $_W["uniacid"] ), "id");
    }
}

if($_deliveryer['region_id'] > 0){
    $regionInfo = pdo_get('tiny_wmall_region', array('id' => $_deliveryer['region_id'], 'uniacid' => $_W['uniacid']), array('name'));
    if(empty($regionInfo)){
        //查不到区域，更新用户数据。
        pdo_update('tiny_wmall_members', array('region_id' => 0), array('id' => $_deliveryer['id']));
    }else{
        $_deliveryer['region_name'] = $regionInfo['name'];
    }
}
if(!empty($_deliveryer['work_hours'])){
    $_deliveryer['work_hours'] = iunserializer($_deliveryer['work_hours']);
    if(!empty($_deliveryer['work_hours']) && is_array($_deliveryer['work_hours'])){
        $work_hours_str = $_deliveryer['work_hours']['start'] . '~' . $_deliveryer['work_hours']['end'];
    }
}else{
    $_deliveryer['work_hours'] = array();
    $work_hours_str = '未设置';
}
include(itemplate("member/profile"));
?>