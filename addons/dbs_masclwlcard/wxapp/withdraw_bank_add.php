<?php

$userinfo = $_SESSION["userinfo"];
$userinfo = base64_decode($_SESSION["userinfo"]);
$userinfo = unserialize($userinfo);
if (!intval($_GPC["card_id"])) {
    $msg["error"] = 1;
    $msg["message"] = "缺少名片id";
    return $this->result(0, "返回消息", $msg);
}
$user = array();
$user["uniacid"] = $_W["uniacid"];
$user["openId"] = $userinfo["openId"];
$user["nickname"] = $userinfo["nickname"];
$user["gender"] = $userinfo["gender"];
$user["city"] = $userinfo["city"];
$user["province"] = $userinfo["province"];
$user["language"] = $userinfo["language"];
$user["avatarUrl"] = $userinfo["avatarUrl"];
$user["name"] = $_GPC["realname"];
$user["phone"] = $_GPC["phone"];
$user["bankCard"] = $_GPC["bankCard"];
$bank_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_bank") . " WHERE uniacid =:uniacid  And openId=:openId ", array(":uniacid" => $_W["uniacid"], ":openId" => $userinfo["openId"]));
if (!empty($bank_info)) {
    $result = pdo_update("dbs_masclwlcard_bank", $user, array("id" => $bank_info["id"]));
} else {
    $result = pdo_insert("dbs_masclwlcard_bank", $user);
}
if ($result) {
    $info["error"] = 0;
} else {
    $info["error"] = 1;
}
$message = "返回消息";
return $this->result(0, $message, $info);