<?php

$status = $this->check_bossqylogin();
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
    echo "没有绑定对应的名片";
    exit;
}
if (!$card_info["open_boss"]) {
    echo "没有BOSS雷达权限";
    exit;
}
include $this->template("boss_client_detail");