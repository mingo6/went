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
if (empty($_GPC["content"])) {
    $this->dexit(array("Code" => 1, "msg" => "不存在的参数-5"));
    exit;
}
$user = array();
$user["uniacid"] = $_W["uniacid"];
$user["openId"] = $card_info["id"];
$user["nickname"] = $card_info["card_name"];
$user["fid"] = $_GPC["fid"];
$user["addtime"] = time();
$user["content"] = $_GPC["content"];
$result = pdo_insert("dbs_masclwlcard_pl", $user);
$condition = " uniacid = :uniacid";
$info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_friend") . " WHERE {$condition}   and id=:fid ", array(":uniacid" => $_W["uniacid"], ":fid" => $id));
if (empty($info)) {
    $this->dexit(array("Code" => 1, "msg" => "失败-6"));
    exit;
}
if ($info["card_id"] != $card_info["id"]) {
    $is_my = 0;
} else {
    $is_my = 1;
}
$Data = pdo_fetchall("SELECT content,id,nickname FROM " . tablename("dbs_masclwlcard_pl") . " WHERE {$condition} and fid=:fid ", array(":uniacid" => $_W["uniacid"], ":fid" => $id));
if (!empty($result)) {
    $this->dexit(array("Code" => 0, "Data" => $Data, "is_my" => $is_my));
    exit;
} else {
    $this->dexit(array("Code" => 1, "msg" => "失败-7"));
    exit;
}