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
if (!$_GPC["content"]) {
    $this->dexit(array("Code" => 1, "msg" => "请填写内容"));
    exit;
}
if (!$_GPC["card_mid"]) {
    $this->dexit(array("Code" => 1, "msg" => "参数错误-1"));
    exit;
}
if (!$_GPC["card_id"]) {
    $this->dexit(array("Code" => 1, "msg" => "参数错误-2"));
    exit;
}
$UserId = $_SESSION["session_dbs_masclwlcard_usderid"];
$card_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and UserId=:UserId", array(":uniacid" => $_W["uniacid"], ":UserId" => $UserId));
if (empty($card_info)) {
    $this->dexit(array("Code" => 1, "msg" => "没有对应的名片"));
    exit;
}
if ($card_info["id"] != $_GPC["card_id"]) {
    $this->dexit(array("Code" => 1, "msg" => "没有对应的名片-1"));
    exit;
}
$data = array();
$data = array("uniacid" => $_W["uniacid"], "addtime" => time(), "card_mid" => $_GPC["card_mid"], "card_id" => $_GPC["card_id"], "content" => $_GPC["content"]);
$result = pdo_insert("dbs_masclwlcard_card_closer", $data);
if (!empty($result)) {
    $this->dexit(array("Code" => 0));
    exit;
} else {
    $this->dexit(array("Code" => 1, "msg" => "保存失败"));
    exit;
}