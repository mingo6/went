<?php  defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
mload()->model("cloud");
$op = (trim($_GPC["op"]) ? trim($_GPC["op"]) : "index");
if( $op == "index" ) 
{
	$_W["page"]["title"] = "基础设置";
	if( $_W["ispost"] ) 
	{
		$url = cloud_w_get_wxapp_authorize_url();
		imessage($url, "", "ajax");
	}
	$wxapp = cloud_w_get_wxapp_authorize_info();
	if( is_error($wxapp) ) 
	{
		imessage($wxapp["message"], "", "error");
	}
	$wxapp = $wxapp["message"];
	include(itemplate("release/index"));
	exit();
}
if( $op == "commit" ) 
{
	$result = cloud_w_wxapp_commit();
	imessage($result, iurl("wxapp/release/index"), "error");
}
if( $op == "get_category" ) 
{
	$result = cloud_w_wxapp_get_category();
	if( is_error($result) ) 
	{
		imessage($result["message"], iurl("wxapp/release/index"), "error");
	}
	include(itemplate("release/category"));
	exit();
}
if( $op == "submit_audit" && $_W["ispost"] ) 
{
	if( !$_GPC["first_id"] || !$_GPC["second_id"] || !$_GPC["first_class"] || !$_GPC["second_class"] ) 
	{
		imessage("所选信息有误,请重新选择", iurl("wxapp/release/index"), "error");
	}
	$result = cloud_w_wxapp_submit_audit();
	imessage($result["message"], iurl("wxapp/release/index"), "error");
}
if( $op == "release" ) 
{
	$result = cloud_w_wxapp_release();
	imessage($result, iurl("wxapp/release/index"), "error");
}
if( $op == "bind_tester" ) 
{
	if( $_W["ispost"] ) 
	{
		$wechatid = trim($_GPC["wechatid"]);
		if( empty($wechatid) ) 
		{
			imessage("体验者微信号不能为空", iurl("wxapp/release/index"), "error");
		}
		$result = cloud_w_wxapp_bind_tester($wechatid);
		imessage($result, iurl("wxapp/release/index"), "success");
	}
	include(itemplate("release/category"));
	exit();
}
if( $op == "undocodeaudit" ) 
{
	$result = cloud_w_wxapp_undocodeaudit();
	if( is_error($result) ) 
	{
		imessage($result, iurl("wxapp/release/index"), "error");
	}
	imessage(error(0, "撤销审核成功"), iurl("wxapp/release/index"), "success");
}
?>