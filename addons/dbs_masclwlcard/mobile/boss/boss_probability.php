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
$startTime = time() - 30 * 24 * 60 * 60;
$endTime = time();
$condition = " uniacid = :uniacid";
$condition .= " AND  addtime BETWEEN :startTime AND :endTime ";
$paras = array(":uniacid" => $_W["uniacid"], ":startTime" => $startTime, ":endTime" => $endTime);
$rate = array("50%~70%", "70%~80%", "80%~90%", "90%以上");
$value = array();
$value[0] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_card_member") . "where {$condition} and gailv BETWEEN 50 AND 70 ", $paras);
$value[1] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_card_member") . "where {$condition} and gailv BETWEEN 70 AND 80 ", $paras);
$value[2] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_card_member") . "where {$condition} and gailv BETWEEN 80 AND 90 ", $paras);
$value[3] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_card_member") . "where {$condition} and gailv>=90 ", $paras);
foreach ($value as $k => $v) {
    $value[$k] = $v ? $v : 0;
}
$this->dexit(array("Code" => 0, "rate" => $rate, "value" => $value));
exit;