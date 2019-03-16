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
if (!$_GPC["card_mid"]) {
    $this->dexit(array("error" => 1, "msg" => "参数错误-1"));
    exit;
}
if (!$_GPC["card_id"]) {
    $this->dexit(array("error" => 1, "msg" => "参数错误-2"));
    exit;
}
if ($card_info["id"] != $_GPC["card_id"]) {
    $this->dexit(array("error" => 1, "msg" => "参数错误-3"));
    exit;
}
$pindex = max(1, intval($_GPC["page"]));
$psize = 10;
$condition = " uniacid = :uniacid";
$Data = pdo_fetchall("SELECT *  FROM " . tablename("dbs_masclwlcard_card_closer") . " WHERE {$condition} and  card_id=:card_id and  card_mid=:card_mid order by addtime desc LIMIT " . ($pindex - 1) * $psize . "," . $psize, array(":uniacid" => $_W["uniacid"], ":card_id" => $card_info["id"], ":card_mid" => $_GPC["card_mid"]));
if (!empty($Data)) {
    foreach ($Data as $k => $v) {
        $Data[$k]["addtime"] = date("y年m月d日 H时", $v["addtime"]);
    }
}
$this->dexit(array("error" => 0, "Data" => $Data));
exit;