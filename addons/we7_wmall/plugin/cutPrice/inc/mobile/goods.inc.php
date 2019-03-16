<?php 
defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
mload()->model("goods");
icheckauth();
$sid = intval($_GPC["sid"]);
store_business_hours_init($sid);
$store = store_fetch($sid);
if( empty($store) ) 
{
    imessage("门店不存在或已经删除", referer(), "error");
}

$_W["page"]["title"] = "商品列表";
mload()->model("activity");
activity_store_cron($sid);
$_share = array( "title" => $store["title"], "desc" => $store["content"], "imgUrl" => tomedia($store["logo"]), "link" => imurl("wmall/store/share", array( "sid" => $sid ), true) );
$footmark = pdo_get("tiny_wmall_member_footmark", array( "uniacid" => $_W["uniacid"], "uid" => $_W["member"]["uid"], "sid" => $sid, "stat_day" => date("Ymd") ), array( "id" ));
if( empty($footmark) ) 
{
    $insert = array( "uniacid" => $_W["uniacid"], "uid" => $_W["member"]["uid"], "sid" => $sid, "addtime" => TIMESTAMP, "stat_day" => date("Ymd") );
    pdo_insert("tiny_wmall_member_footmark", $insert);
}

$ta = (trim($_GPC["ta"]) ? trim($_GPC["ta"]) : $store["template"]);
if( $_GPC["from"] == "search" ) 
{
    pdo_query("update " . tablename("tiny_wmall_store") . " set click = click + 1 where uniacid = :uniacid and id = :id", array( ":uniacid" => $_W["uniacid"], ":id" => $sid ));
}

if( 0 < $_GPC["address_id"] ) 
{
    isetcookie("__aid", $_GPC["address_id"], 180);
}
$price = store_order_condition($store);
$store["send_price"] = $price["send_price"];
if( $ta == "index" ) 
{
    $title = (string) $store["title"] . "-商品列表";
    $activity = store_fetch_activity($sid);
    $is_favorite = pdo_get("tiny_wmall_store_favorite", array( "uniacid" => $_W["uniacid"], "uid" => $_W["member"]["uid"], "sid" => $sid ));
    $result = goods_avaliable_fetchall($sid);
    $categorys = $result["category"];
    $cate_goods = $result["cate_goods"];
    $goods = $result["goods"];
    $bargains = $result["bargains"];
    $categorys_limit_status = 0;
    $categorys_limit = array(  );
    foreach( $categorys as $row ) 
    {
        if( 0 < $row["min_fee"] ) 
        {
            $categorys_limit_status = 1;
            $row["fee"] = 0;
            $categorys_limit[$row["id"]] = $row;
        }

    }
    $categorys_index = array_keys($categorys_limit);
    mload()->model("coupon");
    $tokens = coupon_collect_member_available($sid);
    if( !empty($tokens) ) 
    {
        $token_nums = $tokens["num"];
        $token_price = $tokens["price"];
        $token = $tokens["coupons"][0];
    }

    if( !$_GPC["f"] ) 
    {
        $cart = order_fetch_member_cart($sid);
    }
    else
    {
        $cart = order_place_again($sid, $_GPC["id"]);
        if( empty($cart) ) 
        {
            $cart = order_fetch_member_cart($sid);
        }

    }

    include(itemplate("goodsIndex"));
}
?>