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
$result = pdo_delete("dbs_masclwlcard_pl", array("id" => $id, "uniacid" => $uniacid));
if (!empty($result)) {
    $this->dexit(array("Code" => 0));
    exit;
} else {
    $this->dexit(array("Code" => 1, "msg" => "删除失败-5"));
    exit;
}