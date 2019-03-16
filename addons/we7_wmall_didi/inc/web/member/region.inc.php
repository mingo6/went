<?php 
echo "\t";
defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
$op = (trim($_GPC["op"]) ? trim($_GPC["op"]) : "index");
$config = get_system_config("member.group_update_mode");
if( $op == "index" ) 
{
    $_W["page"]["title"] = "区域列表";
    $regionList = pdo_fetchall("select * from" . tablename("tiny_wmall_region") . "where uniacid = :uniacid", array( "uniacid" => $_W["uniacid"] ));
}

if( $op == "post" ) 
{
    $_W["page"]["title"] = "编辑区域列表";
    $id = intval($_GPC["id"]);
    if( 0 < $id ) 
    {
        $region = pdo_get("tiny_wmall_region", array( "uniacid" => $_W["uniacid"], "id" => $id ));
    }

    if( $_W["ispost"] ) 
    {
        $name = trim($_GPC["name"]);
        if( empty($name) ) 
        {
            imessage(error(-1, "区域名称不能为空！"), "", "ajax");
        }

        $data = array( "uniacid" => $_W["uniacid"], "name" => $name);
        if( empty($region["id"]) ) 
        {
            pdo_insert("tiny_wmall_region", $data);
        }
        else
        {
            pdo_update("tiny_wmall_region", $data, array( "uniacid" => $_W["uniacid"], "id" => $id ));
        }

        $regionList = pdo_fetchall("select * from" . tablename("tiny_wmall_region") . "where uniacid = :uniacid order by id asc", array( ":uniacid" => $_W["uniacid"] ), "id");
        set_system_config("member.region", $regionList);
        imessage(error(0, "区域列表更新成功"), iurl("member/region/index"), "ajax");
    }

}

if( $op == "del" ) 
{
    $id = intval($_GPC["id"]);
    pdo_delete("tiny_wmall_region", array( "uniacid" => $_W["uniacid"], "id" => $id ));
    $regionList = pdo_fetchall("select * from" . tablename("tiny_wmall_region") . "where uniacid = :uniacid order by id asc", array( ":uniacid" => $_W["uniacid"] ), "id");
    set_system_config("member.region", $regionList);
    imessage(error(0, "删除区域列表成功"), iurl("member/region/index"), "ajax");
}

include(itemplate("member/region"));
?>