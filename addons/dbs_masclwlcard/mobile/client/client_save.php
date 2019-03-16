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
if (!$_GPC["name"]) {
}
if (!$_GPC["phone"]) {
}
if (!$_GPC["m_id"]) {
    $this->dexit(array("Code" => 1, "msg" => "参数有误"));
    exit;
}
$get_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and id=:m_id ", array(":uniacid" => $_W["uniacid"], ":m_id" => $_GPC["m_id"]));
if (empty($get_info)) {
    $this->dexit(array("Code" => 1, "msg" => "不存在" . $_GPC["m_id"]));
    exit;
}
$data = array();
$data = array("phone" => $_GPC["phone"], "name" => $_GPC["name"], "hmd_status" => $_GPC["hmd_status"], "pb_status" => $_GPC["pb_status"]);
$result = pdo_update("dbs_masclwlcard_card_member", $data, array("uniacid" => $_W["uniacid"], "id" => $_GPC["m_id"]));
if (!empty($result)) {
    $this->dexit(array("Code" => 0));
    exit;
} else {
    $this->dexit(array("Code" => 1, "msg" => "保存失败"));
    exit;
}