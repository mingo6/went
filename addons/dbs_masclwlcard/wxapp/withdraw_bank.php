<?php

$userinfo = $_SESSION["userinfo"];
$userinfo = base64_decode($_SESSION["userinfo"]);
$userinfo = unserialize($userinfo);
if (!intval($_GPC["card_id"])) {
    $msg["error"] = 1;
    $msg["message"] = "缺少名片id";
    return $this->result(0, "返回消息", $msg);
}
$bank_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_bank") . " WHERE uniacid =:uniacid  And openId=:openId ", array(":uniacid" => $_W["uniacid"], ":openId" => $userinfo["openId"]));
$bank_info["card_id"] = intval($_GPC["card_id"]);
$message = "返回消息";
$info["bank_info"] = $bank_info;
return $this->result(0, $message, $bank_info);