<?php

$userinfo = $_SESSION["userinfo"];
$userinfo = base64_decode($_SESSION["userinfo"]);
$userinfo = unserialize($userinfo);
$info = array();
if (!intval($_GPC["card_id"])) {
    $msg["error"] = 1;
    $msg["message"] = "缺少名片id";
    return $this->result(0, "返回消息", $msg);
}
$message = "返回消息";
$userinfo["card_id"] = intval($_GPC["card_id"]);
$userinfo["member_card"] = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and aid=:aid and openId=:openId", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"], ":openId" => $userinfo["openId"]));
return $this->result(0, $message, $userinfo);