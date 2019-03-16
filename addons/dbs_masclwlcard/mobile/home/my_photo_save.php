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
$old_photo = $card_info["photo"];
if (!$_GPC["imgs"]) {
    $this->dexit(array("Code" => 1, "msg" => "请上传图片"));
    exit;
}
if ($old_photo) {
}
$photo = explode(",", $_GPC["imgs"]);
$data = array();
$data = array("photo" => serialize($photo));
$result = pdo_update("dbs_masclwlcard", $data, array("id" => $card_info["id"]));
if (!empty($result)) {
    $this->dexit(array("Code" => 0));
    exit;
} else {
    $this->dexit(array("Code" => 1, "msg" => "更新失败"));
    exit;
}