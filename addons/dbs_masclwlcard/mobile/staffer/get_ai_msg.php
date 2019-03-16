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
$Data = pdo_fetchall("SELECT act_content,id,addtime,openId,card_id,nickname,avatarUrl FROM " . tablename("dbs_masclwlcard_act_report") . " WHERE {$condition} and card_id=:card_id ORDER BY addtime DESC LIMIT " . ($pindex - 1) * $psize . "," . $psize, array(":uniacid" => $_W["uniacid"], ":card_id" => $card_info["id"]));
$this->dexit(array("error" => 0, "Data" => $Data));
exit;