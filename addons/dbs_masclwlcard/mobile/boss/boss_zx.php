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
if (!$_GPC["days"]) {
    $this->dexit(array("Code" => 1, "msg" => "错误5"));
    exit;
}
$condition = " uniacid = :uniacid";
$condition .= " AND  addtime BETWEEN :startTime AND :endTime ";
$value = array();
$i = 0;
while ($i < $_GPC["days"]) {
    $value[$i]["newdates"] = date("Y-m-d", time() - $i * 24 * 60 * 60);
    $startTime = 0;
    $endTime = 0;
    $startTime = strtotime(date("Y-m-d", time() - $i * 24 * 60 * 60));
    $endTime = strtotime(date("Y-m-d", time() - ($i - 1) * 24 * 60 * 60));
    $paras = array();
    $paras = array(":uniacid" => $_W["uniacid"], ":startTime" => $startTime, ":endTime" => $endTime);
    $total = 0;
    $total = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_chat") . "where {$condition} and is_send = 0  group by openId ", $paras);
    $value[$i]["total"] = count($total) ? count($total) : 0;
    $i++;
}
$this->dexit(array("Code" => 0, "value" => $value, ''));
exit;