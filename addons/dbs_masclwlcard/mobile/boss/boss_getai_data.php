<?php

$status = $this->check_bossqylogin();
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
if (!$card_info["open_boss"]) {
    $this->dexit(array("error" => 1, "msg" => "没有BOSS雷达权限"));
    exit;
}
$condition = " uniacid = :uniacid ";
$StaffList = pdo_fetchall("SELECT *  FROM " . tablename("dbs_masclwlcard") . " WHERE  {$condition}  ORDER BY sort DESC ", array(":uniacid" => $_W["uniacid"]));
$s = 0;
foreach ($StaffList as $k => $v) {
    $StaffList[$k]["card_logo"] = tomedia($v["card_logo"]);
    $ActionRecordList[$s]["Total"] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_act_report") . "where uniacid=:uniacid and act_id=657 and footertype=1 and card_id=:card_id", array(":uniacid" => $_W["uniacid"], ":card_id" => $v["id"]));
    $ActionRecordList[$s]["card_id"] = $v["id"];
    $ActionRecordList[$s]["actionType"] = 0;
    $s = $s + 1;
    $ActionRecordList[$s]["Total"] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_act_report") . "where uniacid=:uniacid and act_id=657 and footertype=2 and card_id=:card_id", array(":uniacid" => $_W["uniacid"], ":card_id" => $v["id"]));
    $ActionRecordList[$s]["card_id"] = $v["id"];
    $ActionRecordList[$s]["actionType"] = 1;
    $s = $s + 1;
    $ActionRecordList[$s]["Total"] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_act_report") . "where uniacid=:uniacid and act_id=657 and footertype=0 and card_id=:card_id", array(":uniacid" => $_W["uniacid"], ":card_id" => $v["id"]));
    $ActionRecordList[$s]["card_id"] = $v["id"];
    $ActionRecordList[$s]["actionType"] = 2;
    $s = $s + 1;
    $ActionRecordList[$s]["Total"] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_card_member") . "where uniacid=:uniacid and aid=:card_id", array(":uniacid" => $_W["uniacid"], ":card_id" => $v["id"]));
    $ActionRecordList[$s]["card_id"] = $v["id"];
    $ActionRecordList[$s]["actionType"] = 3;
    $s = $s + 1;
    $ActionRecordList[$s]["Total"] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_card_closer") . "where uniacid=:uniacid and card_id=:card_id", array(":uniacid" => $_W["uniacid"], ":card_id" => $v["id"]));
    $ActionRecordList[$s]["card_id"] = $v["id"];
    $ActionRecordList[$s]["actionType"] = 4;
    $s = $s + 1;
    $ActionRecordList[$s]["Total"] = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_chat") . "where uniacid=:uniacid and  card_id=:card_id", array(":uniacid" => $_W["uniacid"], ":card_id" => $v["id"]));
    $ActionRecordList[$s]["card_id"] = $v["id"];
    $ActionRecordList[$s]["actionType"] = 5;
    $s = $s + 1;
}
$Data["StaffList"] = $StaffList;
$Data["ActionRecordList"] = $ActionRecordList;
$this->dexit(array("error" => 0, "Data" => $Data));
exit;