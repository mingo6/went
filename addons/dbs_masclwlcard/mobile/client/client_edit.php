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
if (!$_GPC["card_id"]) {
    echo "参数不对-1";
    exit;
}
if (!$_GPC["openid"]) {
    echo "参数不对-1";
    exit;
}
$base = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_set") . " WHERE uniacid =:uniacid", array(":uniacid" => $_W["uniacid"]));
$UserId = $_SESSION["session_dbs_masclwlcard_usderid"];
$card_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and UserId=:UserId", array(":uniacid" => $_W["uniacid"], ":UserId" => $UserId));
if (empty($card_info)) {
    echo "没有找到对应的名片-1";
    exit;
}
if ($card_info["id"] != $_GPC["card_id"]) {
    echo "没有找到对应的名片-2";
    exit;
}
$info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and openId=:openid and aid=:card_id ", array(":uniacid" => $_W["uniacid"], ":card_id" => $_GPC["card_id"], ":openid" => $_GPC["openid"]));
if (!$info["phone"]) {
    $get_phone = array();
    $get_phone = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_member") . " WHERE uniacid =:uniacid and openId=:openid ", array(":uniacid" => $_W["uniacid"], ":openid" => $_GPC["openid"]));
    if ($get_phone["phone"]) {
        $info["phone"] = $get_phone["phone"];
    }
}
include $this->template("client_edit");