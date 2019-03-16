<?php

$userinfo = $_SESSION["userinfo"];
$userinfo = base64_decode($_SESSION["userinfo"]);
$userinfo = unserialize($userinfo);
$user = array();
$user["uniacid"] = $_W["uniacid"];
$user["openId"] = $userinfo["openId"];
$user["nickname"] = $userinfo["nickname"];
$user["gender"] = $userinfo["gender"];
$user["city"] = $userinfo["city"];
$user["province"] = $userinfo["province"];
$user["language"] = $userinfo["language"];
$user["avatarUrl"] = $userinfo["avatarUrl"];
$user["userName"] = $_GPC["userName"];
$user["telNumber"] = $_GPC["telNumber"];
$user["provinceName"] = $_GPC["provinceName"];
$user["cityName"] = $_GPC["cityName"];
$user["countyName"] = $_GPC["countyName"];
$user["detailInfo"] = $_GPC["detailInfo"];
$result = pdo_insert("dbs_masclwlcard_shops_address", $user);
if ($result) {
    $info["error"] = 0;
} else {
    $info["error"] = 1;
    $info["error"] = $user;
}
$message = "返回消息";
return $this->result(0, $message, $info);