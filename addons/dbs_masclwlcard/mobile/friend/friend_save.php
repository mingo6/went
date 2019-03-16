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
    $this->dexit(array("Code" => 1));
    exit;
}
if (!$_GPC["content"]) {
    $this->dexit(array("Code" => 1, "msg" => "请填写内容"));
    exit;
}
if (!$_GPC["imgs"]) {
    $this->dexit(array("Code" => 1, "msg" => "请上传图片"));
    exit;
}
$data = array();
$data = array("uniacid" => $_W["uniacid"], "time" => time(), "all_img" => $_GPC["imgs"], "is_card" => 1, "card_id" => $card_info["id"], "content_card" => $_GPC["content"]);
$result = pdo_insert("dbs_masclwlcard_friend", $data);
if (!empty($result)) {
    $this->dexit(array("Code" => 0));
    exit;
} else {
    $this->dexit(array("Code" => 1, "msg" => "保存失败"));
    exit;
}