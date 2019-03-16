<?php  defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
icheckauth();
$op = (trim($_GPC["op"]) ? trim($_GPC["op"]) : "index");
if( $op == "index" ) 
{
	$result = array( "adv" => secondKill_adv_get(1), "goods" => secondKill_goodsall_get(array( "type" => "goods", "psize" => 4 )), "goods_credit2" => secondKill_goodsall_get(array( "type" => "credit2" )), "goods_redpacket" => secondKill_goodsall_get(array( "type" => "redpacket" )), "category" => secondKill_category_get(1), "member" => $_W["member"] );
	imessage(error(0, $result), "", "ajax");
}
if( $op == "goods" ) 
{
	$goods = secondKill_goodsall_get();
	$result = array( "goods" => $goods );
	imessage(error(0, $result), "", "ajax");
}
if( $op == "detail" ) 
{
	$id = $_GPC["id"];
	$good = secondKill_goods_get($id);
	$can = secondKill_can_exchange_goods($id);
	if( $can["errno"] == -2 ) 
	{
		$good["can"] = 0;
	}
	else 
	{
		$good["can"] = 1;
	}
	$goods = secondKill_goodsall_get(array( "page" => 1, "psize" => 4, "type" => $good["type"] ));
	$records = secondKill_record_get();
	$goods_keys = array( );
	if( !empty($goods) ) 
	{
		foreach( $goods as $key => $value ) 
		{
			if( $value["id"] == $id ) 
			{
				unset($goods[$key]);
			}
		}
	}
	$member = $_W["member"];
	$member["credit1"] = intval($member["credit1"]);
	$result = array( "good" => $good, "goods" => $goods, "member" => $member, "records" => $records );
	imessage(error(0, $result), "", "ajax");
}
?>