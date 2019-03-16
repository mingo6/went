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
$UserId = $_SESSION["session_dbs_masclwlcard_usderid"];
$card_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and UserId=:UserId", array(":uniacid" => $_W["uniacid"], ":UserId" => $UserId));
if (empty($card_info)) {
    echo "没有找到对应的名片";
    exit;
}
$wx_png = tomedia("/addons/dbs_masclwlcard/sea/" . $_W["uniacid"] . "/" . $card_info["id"] . ".png");
include $this->template("my_ewm");