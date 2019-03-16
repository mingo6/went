<?php 
defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
$_W["page"]["title"] = "用户设置";
if( $_W["ispost"] ) 
{
    $group_update_mode = trim($_GPC["group_update_mode"]);
    if( empty($group_update_mode) ) 
    {
        imessage(error(-1, "请选择用户等级升级依据"));
    }

    set_system_config("member.group_update_mode", $group_update_mode);
    imessage(error(0, "设置用户等级升级依据成功"), referer(), "ajax");
}

$group_update_mode = get_system_config("member.group_update_mode");
include(itemplate("config/member"));
?>