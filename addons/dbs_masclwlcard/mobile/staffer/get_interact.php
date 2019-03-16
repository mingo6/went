<?php

$status = $this->check_qylogin();
if ($status == -1) {
    $this->dexit(array("error" => 1, "msg" => "请在企业微信打开"));
    exit;
}
if ($status == -2) {
    $this->dexit(array("error" => 1, "msg" => "没有绑定对应的名片"));
    exit;
}
$UserId = $_SESSION["session_dbs_masclwlcard_usderid"];
$card_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and UserId=:UserId", array(":uniacid" => $_W["uniacid"], ":UserId" => $UserId));
$pindex = max(1, intval($_GPC["page"]));
$psize = 10;
$condition = " uniacid = :uniacid ";
$startTime = null;
$endTime = null;
if ($_GPC["startTime"] && $_GPC["endTime"]) {
    $startTime = strtotime($_GPC["startTime"]);
    $endTime = strtotime($_GPC["endTime"]);
} else {
    $startTime = time() - 7 * 24 * 60 * 60;
    $endTime = time();
}
$condition .= " AND  addtime BETWEEN :startTime AND :endTime ";
$Data = pdo_fetchall("SELECT act_content,addtime,openId,card_id,nickname,avatarUrl,count(*) AS nums FROM " . tablename("dbs_masclwlcard_act_report") . " WHERE {$condition} and card_id=:card_id GROUP BY openId  ORDER BY nums DESC  LIMIT " . ($pindex - 1) * $psize . "," . $psize, array(":uniacid" => $_W["uniacid"], ":card_id" => $card_info["id"], ":startTime" => $startTime, ":endTime" => $endTime));
$this->dexit(array("error" => 0, "Data" => $Data));
exit;