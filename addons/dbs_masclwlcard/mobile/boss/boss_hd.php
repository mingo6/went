<?php

$status = $this->check_bossqylogin();
if ($status == -1) {
    $this->dexit(array("Code" => 1, "msg" => "错误1"));
    exit;
}
if ($status == -2) {
    $this->dexit(array("Code" => 1, "msg" => "错误2"));
    exit;
}
$UserId = $_SESSION["session_dbs_masclwlcard_usderid"];
$card_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and UserId=:UserId", array(":uniacid" => $_W["uniacid"], ":UserId" => $UserId));
if (empty($card_info)) {
    $this->dexit(array("Code" => 1, "msg" => "错误3"));
    exit;
}
if (!$card_info["open_boss"]) {
    $this->dexit(array("Code" => 1, "msg" => "错误4"));
    exit;
}
$condition = " uniacid = :uniacid";
$value = array();
$paras = array(":uniacid" => $_W["uniacid"]);
$value[0]["total"] = pdo_fetchall("SELECT  *  FROM " . tablename("dbs_masclwlcard_chat") . "where {$condition} and is_send=0 group by openId ", $paras);
$value[0]["total"] = count($value[0]["total"]) ? count($value[0]["total"]) : 0;
$value[0]["type"] = 1;
$value[1]["total"] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_card_member") . "where {$condition} and isPopCard=1 ", $paras);
$value[1]["type"] = 2;
$value[1]["total"] = $value[1]["total"] ? $value[1]["total"] : 0;
$value[2]["total"] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_card_member") . "where {$condition} and showZan=1 ", $paras);
$value[2]["type"] = 3;
$value[2]["total"] = $value[2]["total"] ? $value[2]["total"] : 0;
$this->dexit(array("Code" => 0, "value" => $value));
exit;