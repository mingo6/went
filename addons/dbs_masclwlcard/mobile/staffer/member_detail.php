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
if (!$_GPC["member_id"]) {
    echo "信息拉取失败-1";
    exit;
}
if (!$_GPC["card_id"]) {
    echo "信息拉取失败-2";
    exit;
}
$condition = " uniacid = :uniacid";
if ($_GPC["type"]) {
    $member_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE {$condition} and id=:member_id and aid=:card_id ", array(":uniacid" => $_W["uniacid"], ":card_id" => $_GPC["card_id"], ":member_id" => $_GPC["member_id"]));
} else {
    $info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_act_report") . " WHERE {$condition} and id=:member_id and card_id=:card_id ", array(":uniacid" => $_W["uniacid"], ":card_id" => $_GPC["card_id"], ":member_id" => $_GPC["member_id"]));
    if (empty($info)) {
        echo "信息拉取失败-3";
        exit;
    }
    $member_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE {$condition} and openId=:openId and aid=:card_id ", array(":uniacid" => $_W["uniacid"], ":card_id" => $_GPC["card_id"], ":openId" => $info["openId"]));
}
if (empty($member_info)) {
    echo "信息拉取失败-4";
    exit;
}
include $this->template("member_detail");