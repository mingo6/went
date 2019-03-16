<?php

$userinfo = $_SESSION["userinfo"];
$userinfo = base64_decode($_SESSION["userinfo"]);
$userinfo = unserialize($userinfo);
$address_list = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops_address") . " WHERE uniacid =:uniacid  And openId=:openId ORDER BY id DESC ", array(":uniacid" => $_W["uniacid"], ":openId" => $userinfo["openId"]));
$message = "返回消息";
return $this->result(0, $message, $address_list);