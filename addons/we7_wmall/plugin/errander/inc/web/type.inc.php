<?php  defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
$op = (trim($_GPC["op"]) ? trim($_GPC["op"]) : "list");
if( $op == "list" )
{
    $_W["page"]["title"] = "类型列表";
    $categorys = pdo_fetchall("select * from" . tablename("tiny_wmall_errander_type") . " where uniacid = :uniacid and status = 1 order by id asc", array( ":uniacid" => $_W["uniacid"] ));
}
if( $op == "post" )
{
    $_W["page"]["title"] = "编辑类型";
    $id = intval($_GPC["id"]);
    if( 0 < $id )
    {
        $category = pdo_get("tiny_wmall_errander_type", array( "uniacid" => $_W["uniacid"], "id" => $id ));
        if( empty($category) ) imessage("类型不存在或已删除", referer(), "error");
    }
    if( $_W["ispost"] )
    {
        $errander_name = (trim($_GPC["errander_name"]) ? trim($_GPC["errander_name"]) : imessage(error(-1, "类型名称不能为空"), "", "ajax"));
        $deliveryer_name = (trim($_GPC["deliveryer_name"]) ? trim($_GPC["deliveryer_name"]) : imessage(error(-1, "对应的配送员名称名称不能为空"), "", "ajax"));
        $value = (trim($_GPC["value"]) ? trim($_GPC["value"]) : imessage(error(-1, "字段名不能为空"), "", "ajax"));
        $thumb = (trim($_GPC["thumb"]) ? trim($_GPC["thumb"]) : imessage(error(-1, "图标不能为空"), "", "ajax"));

        $is_value = pdo_get("tiny_wmall_errander_type", array( "uniacid" => $_W["uniacid"], "value" => $value, "id !=" => $id, "status" =>1 ));
        if (!empty($is_value)) imessage(error(-1, "字段名不能重复"), "", "ajax");

        $data = array( "uniacid" => $_W["uniacid"], "errander_name" => $errander_name,"deliveryer_name" => $deliveryer_name,"value" => $value,"thumb" => $thumb);
        if( !empty($category) )
        {
            pdo_update("tiny_wmall_errander_type", $data, array( "uniacid" => $_W["uniacid"], "id" => $id ));
        }
        else
        {
            $data['create_time'] = time();
            pdo_insert("tiny_wmall_errander_type", $data);
        }
        imessage(error(0, "编辑商品分类成功"), iurl("errander/type/list"), "ajax");
    }
}
if( $op == "del" )
{
    $id = intval($_GPC["id"]);
    pdo_update("tiny_wmall_errander_type",array("status"=>0), array( "uniacid" => $_W["uniacid"], "id" => $id ));
    imessage(error(0, "删除成功"), "", "ajax");
}
include(itemplate("type"));
?>