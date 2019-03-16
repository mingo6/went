<?php

$status = $this->check_qylogin();
if ($status == -1) {
    echo "请在企业微信打开";
    exit;
}
if ($status == -2) {
    echo "没有绑定对应的名片";
    exit;
}
$set_qy = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_set_qy") . " WHERE uniacid =:uniacid", array(":uniacid" => $_W["uniacid"]));
$access_token = $this->getAccessqyToken($set_qy["corpid"], $set_qy["secret"]);
$ticket = $this->getqy_jsapi_ticket($set_qy["secret"], $access_token);
if (!empty($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) !== "off") {
    $http_type = "https://";
} else {
    if (isset($_SERVER["HTTP_X_FORWARDED_PROTO"]) && $_SERVER["HTTP_X_FORWARDED_PROTO"] === "https") {
        $http_type = "https://";
    } else {
        if (!empty($_SERVER["HTTP_FRONT_END_HTTPS"]) && strtolower($_SERVER["HTTP_FRONT_END_HTTPS"]) !== "off") {
            $http_type = "https://";
        } else {
            $http_type = "http://";
        }
    }
}
$url = $http_type . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$Sign = $this->addSign($set_qy["corpid"], $ticket, $url);
include $this->template("my_photo");