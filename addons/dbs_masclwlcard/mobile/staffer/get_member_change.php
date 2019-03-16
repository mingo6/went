<?php

$status = $this->check_qylogin();
if ($status == -1) {
    $this->dexit(array("error" => 1, "msg" => "请在企业微信打开"));
    exit;
}
if ($status == -2) {
    $this->dexit(array("error" => 1, "msg" => "没有绑定对应的名片"));
    exit;
}
if (!$_GPC["mid"]) {
    $this->dexit(array("error" => 1, "msg" => "信息拉取失败-1"));
    exit;
}
$condition = " uniacid = :uniacid";
$member_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE {$condition} and id=:id ", array(":uniacid" => $_W["uniacid"], ":id" => $_GPC["mid"]));
if (empty($member_info)) {
    $this->dexit(array("error" => 1, "msg" => "信息拉取失败-4"));
    exit;
}
$result = pdo_update("dbs_masclwlcard_card_member", array("gailv" => $_GPC["gailv"]), array("id" => $_GPC["mid"]));
if (!empty($result)) {
    $this->dexit(array("error" => 0));
    exit;
} else {
    $this->dexit(array("error" => 1, "msg" => "更新失败"));
    exit;
}