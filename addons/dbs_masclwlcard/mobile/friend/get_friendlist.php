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
    $this->dexit(array("error" => 1, "msg" => "没有找到对应的名片"));
    exit;
}
$pindex = max(1, intval($_GPC["page"]));
$psize = 20;
$condition = " uniacid = :uniacid";
$Data = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_friend") . " WHERE {$condition}   ORDER BY time DESC LIMIT " . ($pindex - 1) * $psize . "," . $psize, array(":uniacid" => $_W["uniacid"]));
if (!empty($Data)) {
    foreach ($Data as $k => $v) {
        $Data[$k]["time"] = date("Y-m-d H:i:s", $v["time"]);
        if ($v["card_id"] == $card_info["id"]) {
            $Data[$k]["is_my"] = 1;
        } else {
            $Data[$k]["is_my"] = 0;
        }
        if ($v["card_id"]) {
            $Data[$k]["card_info"] = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE {$condition}  and id=:aid ", array(":uniacid" => $_W["uniacid"], ":aid" => $v["card_id"]));
            $Data[$k]["card_info"]["card_logo"] = tomedia($Data[$k]["card_info"]["card_logo"]);
        } else {
            $Data[$k]["head_img"] = tomedia($v["head_img"]);
            $Data[$k]["base_set"] = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_set") . " WHERE {$condition} ", array(":uniacid" => $_W["uniacid"]));
            $Data[$k]["base_set"]["company_logo"] = tomedia($Data[$k]["base_set"]["company_logo"]);
        }
        $Data[$k]["pl_list"] = pdo_fetchall("SELECT content,id,nickname FROM " . tablename("dbs_masclwlcard_pl") . " WHERE {$condition} and fid=:fid ", array(":uniacid" => $_W["uniacid"], ":fid" => $v["id"]));
        $Data[$k]["z_list"] = pdo_fetchall("SELECT nickname FROM " . tablename("dbs_masclwlcard_zan") . " WHERE {$condition} and fid=:fid and status=1", array(":uniacid" => $_W["uniacid"], ":fid" => $v["id"]));
    }
}
$this->dexit(array("error" => 0, "Data" => $Data));
exit;