<?php

$status = $this->check_qylogin();
if ($status == -1) {
    $this->dexit(array("Code" => 1));
    exit;
}
if ($status == -2) {
    $this->dexit(array("Code" => 1));
    exit;
}
$UserId = $_SESSION["session_dbs_masclwlcard_usderid"];
$card_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and UserId=:UserId", array(":uniacid" => $_W["uniacid"], ":UserId" => $UserId));
if (empty($card_info)) {
    $this->dexit(array("Code" => 1, "msg" => "找不到对应的名片"));
    exit;
}
if (!$_GPC["email"]) {
    $this->dexit(array("Code" => 1, "msg" => "请填写邮箱"));
    exit;
}
if (!$_GPC["mobile"]) {
    $this->dexit(array("Code" => 1, "msg" => "请填写手号机"));
    exit;
}
$data = array();
$data = array("card_tel" => $_GPC["mobile"], "card_instr" => $_GPC["content"], "zd_msg" => $_GPC["zd_msg"], "email" => $_GPC["email"], "weixinid" => $_GPC["wxid"]);
$result = pdo_update("dbs_masclwlcard", $data, array("uniacid" => $_W["uniacid"], "id" => $card_info["id"]));
if (!empty($result)) {
    $this->dexit(array("Code" => 0));
    exit;
} else {
    $this->dexit(array("Code" => 1, "msg" => "保存失败"));
    exit;
}