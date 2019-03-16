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
if (!$_GPC["mid"]) {
    echo "信息拉取失败-1";
    exit;
}
if (!$_GPC["card_id"]) {
    echo "信息拉取失败-2";
    exit;
}
$condition = " uniacid = :uniacid";
$member_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE {$condition} and id=:id and aid=:card_id ", array(":uniacid" => $_W["uniacid"], ":card_id" => $_GPC["card_id"], ":id" => $_GPC["mid"]));
if (empty($member_info)) {
    echo "信息拉取失败-4";
    exit;
}
include $this->template("get_member_follow");