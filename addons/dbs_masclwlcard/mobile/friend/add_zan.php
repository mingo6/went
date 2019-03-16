<?php

$status = $this->check_qylogin();
if ($status == -1) {
    $this->dexit(array("Code" => 1, "msg" => "不存在的参数-1"));
    exit;
}
if ($status == -2) {
    $this->dexit(array("Code" => 1, "msg" => "不存在的参数-2"));
    exit;
}
$UserId = $_SESSION["session_dbs_masclwlcard_usderid"];
$card_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and UserId=:UserId", array(":uniacid" => $_W["uniacid"], ":UserId" => $UserId));
if (empty($card_info)) {
    $this->dexit(array("Code" => 1, "msg" => "不存在的参数-3"));
    exit;
}
$id = intval($_GPC["fid"]);
if (empty($id)) {
    $this->dexit(array("Code" => 1, "msg" => "不存在的参数-4"));
    exit;
}
$zaninfo = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_zan") . " WHERE uniacid =:uniacid and openId=:card_id and fid=:fid", array(":uniacid" => $_W["uniacid"], ":card_id" => $card_info["id"], ":fid" => $_GPC["fid"]));
$user = array();
$user["uniacid"] = $_W["uniacid"];
$user["openId"] = $card_info["id"];
$user["nickname"] = $card_info["card_name"];
$user["fid"] = $_GPC["fid"];
if (empty($zaninfo)) {
    $user["addtime"] = time();
    $user["status"] = 1;
    $result = pdo_insert("dbs_masclwlcard_zan", $user);
} else {
    $user["addtime"] = $info["addtime"] ? $info["addtime"] : time();
    $user["updatetime"] = time();
    if ($zaninfo["status"]) {
        $user["status"] = 0;
    } else {
        $user["status"] = 1;
    }
    $result = pdo_update("dbs_masclwlcard_zan", $user, array("id" => $zaninfo["id"]));
}
$condition = " uniacid = :uniacid";
$Data = pdo_fetchall("SELECT nickname FROM " . tablename("dbs_masclwlcard_zan") . " WHERE {$condition} and fid=:fid and status=1", array(":uniacid" => $_W["uniacid"], ":fid" => $id));
if (!empty($result)) {
    $this->dexit(array("Code" => 0, "Data" => $Data));
    exit;
} else {
    $this->dexit(array("Code" => 1, "msg" => "失败-5"));
    exit;
}