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
$startTime = null;
$endTime = null;
if ($_GPC["days"]) {
    $now = strtotime(date("Y-m-d", time()));
    if ($_GPC["days"] == 1) {
        $startTime = $now;
        $endTime = time();
    }
    if ($_GPC["days"] == 7) {
        $startTime = time() - 7 * 24 * 60 * 60;
        $endTime = time();
    }
    if ($_GPC["days"] == 30) {
        $startTime = time() - 30 * 24 * 60 * 60;
        $endTime = time();
    }
} else {
    $startTime = 0;
    $endTime = time();
}
$condition = " uniacid = :uniacid";
$condition .= " AND  addtime BETWEEN :startTime AND :endTime ";
$paras = array(":uniacid" => $_W["uniacid"], ":startTime" => $startTime, ":endTime" => $endTime);
$clientCount = pdo_fetchall("SELECT openId,addtime  FROM " . tablename("dbs_masclwlcard_card_member") . " where {$condition} group by openId ", $paras);
if ($clientCount) {
    $clientCount = count($clientCount);
} else {
    $clientCount = 0;
}
$followUp = pdo_fetchall("SELECT id,addtime  FROM " . tablename("dbs_masclwlcard_card_closer") . " where {$condition} ", $paras);
if ($followUp) {
    $followUp = count($followUp);
} else {
    $followUp = 0;
}
$browse = pdo_fetchall("SELECT *  FROM " . tablename("dbs_masclwlcard_act_report") . " WHERE {$condition} and act_id=657 and card_id=:card_id ", array(":uniacid" => $_W["uniacid"], ":card_id" => $card_info["id"], ":startTime" => $startTime, ":endTime" => $endTime));
if ($browse) {
    $browse = count($browse);
} else {
    $browse = 0;
}
$isPopCard = pdo_fetchall("SELECT id,addtime  FROM " . tablename("dbs_masclwlcard_card_member") . " where {$condition} and isPopCard=1 ", $paras);
if ($isPopCard) {
    $isPopCard = count($isPopCard);
} else {
    $isPopCard = 0;
}
$showzan = pdo_fetchall("SELECT id,addtime  FROM " . tablename("dbs_masclwlcard_card_member") . " where {$condition} and showZan=1 ", $paras);
if ($showzan) {
    $showzan = count($showzan);
} else {
    $showzan = 0;
}
$this->dexit(array("Code" => 0, "days" => $_GPC["days"], "clientCount" => $clientCount, "followUp" => $followUp, "browse" => $browse, "isPopCard" => $isPopCard, "showzan" => $showzan));
exit;