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
$psize = 20;
$condition = " uniacid = :uniacid";
$startTime = null;
$endTime = null;
if ($_GPC["startTime"] && $_GPC["endTime"]) {
    $startTime = strtotime($_GPC["startTime"]);
    $endTime = strtotime($_GPC["endTime"]);
} else {
    $startTime = time() - 7 * 24 * 60 * 60;
    $endTime = time();
}
$type = intval($_GPC["type"]) ? intval($_GPC["type"]) : 0;
$footertype = 0;
$copytype = 0;
switch ($type) {
    case 0:
        $footertype = 1;
        $act_id = 657;
        break;
    case 1:
        $footertype = 3;
        $act_id = 657;
        break;
    case 2:
        $copytype = "wxid";
        $act_id = 655;
        break;
    case 4:
        $footertype = 0;
        $act_id = 657;
        break;
    case 5:
        $footertype = 2;
        $act_id = 657;
        break;
    case 7:
        $act_id = 654;
        break;
    default:
        $this->dexit(array("error" => 1, "msg" => "没有对应的"));
        exit;
        break;
}
if ($type == 2) {
    $condition .= " AND  act_id=:act_id AND copytype=:copytype ";
    $pram = array(":uniacid" => $_W["uniacid"], ":card_id" => $card_info["id"], ":copytype" => $copytype, ":act_id" => $act_id, ":startTime" => $startTime, ":endTime" => $endTime);
} else {
    if ($type == 7) {
        $condition .= " AND  act_id=:act_id  ";
        $pram = array(":uniacid" => $_W["uniacid"], ":card_id" => $card_info["id"], ":act_id" => $act_id, ":startTime" => $startTime, ":endTime" => $endTime);
    } else {
        $condition .= " AND  footertype=:footertype AND  act_id=:act_id AND copytype=:copytype ";
        $pram = array(":uniacid" => $_W["uniacid"], ":card_id" => $card_info["id"], ":footertype" => $footertype, ":copytype" => $copytype, ":act_id" => $act_id, ":startTime" => $startTime, ":endTime" => $endTime);
    }
}
$condition .= " AND  addtime BETWEEN :startTime AND :endTime ";
$Data = pdo_fetchall("SELECT act_content,id,addtime,openId,card_id,nickname,avatarUrl FROM " . tablename("dbs_masclwlcard_act_report") . " WHERE {$condition} and card_id=:card_id ORDER BY addtime DESC LIMIT " . ($pindex - 1) * $psize . "," . $psize, $pram);
$this->dexit(array("error" => 0, "Data" => $Data));
exit;