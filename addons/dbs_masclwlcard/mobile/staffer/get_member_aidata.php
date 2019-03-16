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
if (empty($card_info)) {
    $this->dexit(array("error" => 1, "msg" => "没有绑定对应的名片"));
    exit;
}
if (!$_GPC["card_id"]) {
    $this->dexit(array("error" => 1, "msg" => "参数错误-1"));
    exit;
}
if (!$_GPC["openid"]) {
    $this->dexit(array("error" => 1, "msg" => "参数错误-2"));
    exit;
}
if ($card_info["id"] != $_GPC["card_id"]) {
    $this->dexit(array("error" => 1, "msg" => "参数错误-1"));
    exit;
}
$condition = " uniacid = :uniacid";
$startTime = time() - 7 * 24 * 60 * 60;
$endTime = time();
$condition .= " AND  addtime BETWEEN :startTime AND :endTime ";
$Data = pdo_fetchall("SELECT uniacid,footertype,addtime,openId,act_id,card_id,count('*') as Total  FROM " . tablename("dbs_masclwlcard_act_report") . " WHERE {$condition} and act_id=657 and card_id=:card_id and  openId=:openId group by footertype ", array(":uniacid" => $_W["uniacid"], ":card_id" => $card_info["id"], ":openId" => $_GPC["openid"], ":startTime" => $startTime, ":endTime" => $endTime));
$this->dexit(array("error" => 0, "Data" => $Data));
exit;