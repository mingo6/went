<?php

$userinfo = $_SESSION["userinfo"];
$userinfo = base64_decode($_SESSION["userinfo"]);
$userinfo = unserialize($userinfo);
if (empty($_GPC["shops_id"])) {
    $msg["error"] = 1;
    $msg["message"] = "缺少商品id";
    return $this->result(0, "返回消息", $msg);
}
$shop_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_shops") . " WHERE uniacid =:uniacid and id=:shops_id", array(":uniacid" => $_W["uniacid"], ":shops_id" => $_GPC["shops_id"]));
if (empty($shop_info)) {
    $msg["error"] = 1;
    $msg["message"] = "不存在的商品";
    return $this->result(0, "返回消息", $msg);
}
if ($shop_info["shops_num"] <= 0) {
    $msg["error"] = 1;
    $msg["message"] = "无库存";
    return $this->result(0, "返回消息", $msg);
}
if ($shop_info["is_show"] < 1) {
    $msg["error"] = 1;
    $msg["message"] = "商品已经下架";
    return $this->result(0, "返回消息", $msg);
}
if (!intval($_GPC["shops_num"])) {
    $msg["error"] = 1;
    $msg["message"] = "购买数量不能为空";
    return $this->result(0, "返回消息", $msg);
}
if (!$_GPC["address"]) {
    $msg["error"] = 1;
    $msg["message"] = "请填写地址";
    return $this->result(0, "返回消息", $msg);
}
if (!$_GPC["name"]) {
    $msg["error"] = 1;
    $msg["message"] = "请填写姓名";
    return $this->result(0, "返回消息", $msg);
}
if (!$_GPC["phone"]) {
    $msg["error"] = 1;
    $msg["message"] = "请填写电话";
    return $this->result(0, "返回消息", $msg);
}
list($msec, $sec) = explode(" ", microtime());
$orderid = date("YmdHis", $sec) . substr($msec, 2, 4);
$orderid = "nicecard" . $orderid;
$order = array("tid" => $orderid, "user" => $_W["openid"], "fee" => floatval($shop_info["price"]) * intval($_GPC["shops_num"]), "title" => $shop_info["shop_name"] ? $shop_info["shop_name"] : "支付");
if (floatval($shop_info["price"]) >= 0.01) {
    $pay_params = $this->pay($order);
    if (is_error($pay_params)) {
        $msg["error"] = 1;
        $msg["message"] = $pay_params["message"];
        return $this->result(0, "返回消息", $msg);
    }
} else {
    $msg["error"] = 1;
    $msg["message"] = "金额不得少于0.01";
    return $this->result(0, "返回消息", $msg);
}
if (!intval($_GPC["card_id"])) {
    $msg["error"] = 1;
    $msg["message"] = "缺少名片id";
    return $this->result(0, "返回消息", $msg);
}
$data = array();
$data["price"] = $shop_info["price"];
$data["all_price"] = $order["fee"];
$data["uniacid"] = $_W["uniacid"];
$data["shop_name"] = $shop_info["shop_name"];
$data["from_user"] = $_W["openid"];
$data["name"] = $_GPC["name"];
$data["phone"] = $_GPC["phone"];
$data["shops_id"] = $shop_info["id"];
$data["shops_num"] = intval($_GPC["shops_num"]);
$data["address"] = $_GPC["address"];
$data["card_id"] = intval($_GPC["card_id"]);
$data["new_spec"] = $_GPC["new_spec"];
$data["addtime"] = time();
$data["orderid"] = $orderid;
$result = pdo_insert("dbs_masclwlcard_shops_order", $data);
if ($result) {
    $pay_params["error"] = 0;
    $pay_params["orderid"] = $orderid;
    return $this->result(0, "返回消息", $pay_params);
} else {
    $msg["error"] = 1;
    $msg["message"] = "数据录入失败";
    return $this->result(0, "返回消息", $msg);
}