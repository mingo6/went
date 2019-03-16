<?php

$userinfo = $_SESSION["userinfo"];
$userinfo = base64_decode($_SESSION["userinfo"]);
$userinfo = unserialize($userinfo);
if (!intval($_GPC["card_id"])) {
    $msg["error"] = 1;
    $msg["message"] = "缺少名片id";
    return $this->result(0, "返回消息", $msg);
}
$order_list = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops_order") . " WHERE uniacid =:uniacid and card_id=:card_id and paid=1 and from_user=:openId ORDER BY id DESC ", array(":uniacid" => $_W["uniacid"], "card_id" => intval($_GPC["card_id"]), ":openId" => $userinfo["openId"]));
if (!empty($order_list)) {
    foreach ($order_list as $k => $v) {
        $order_list[$k]["shops"] = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_shops") . " WHERE uniacid =:uniacid and id=:id  ", array(":uniacid" => $_W["uniacid"], ":id" => $v["shops_id"]));
        $order_list[$k]["shops"]["g_img"] = tomedia($order_list[$k]["shops"]["gimg"]);
        $order_list[$k]["dateline"] = date("Y-m-d H:i:s", $v["addtime"]);
    }
}
$message = "返回消息";
return $this->result(0, $message, $order_list);