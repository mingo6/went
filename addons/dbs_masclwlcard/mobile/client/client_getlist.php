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
$pindex = max(1, intval($_GPC["page"]));
$psize = 20;
$condition = " uniacid = :uniacid ";
if ($_GPC["type"] == 1) {
    $Data = pdo_fetchall("SELECT *  FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE {$condition} AND aid=:card_id ORDER BY addtime DESC LIMIT " . ($pindex - 1) * $psize . "," . $psize, array(":uniacid" => $_W["uniacid"], ":card_id" => $card_info["id"]));
} else {
    $Data = pdo_fetchall("SELECT *  FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE {$condition} AND aid=:card_id ORDER BY gailv DESC LIMIT " . ($pindex - 1) * $psize . "," . $psize, array(":uniacid" => $_W["uniacid"], ":card_id" => $card_info["id"]));
}
if (!empty($Data)) {
    foreach ($Data as $k => $v) {
        $Data[$k]["now_status"] = -1;
        $info = array();
        if ($v["addtime"] < strtotime(date("Y-m-d", time() - 24 * 60 * 60))) {
            $info = pdo_fetch("SELECT *  FROM " . tablename("dbs_masclwlcard_card_closer") . " WHERE {$condition}   AND card_mid=:card_mid AND card_id=:card_id order by addtime desc ", array(":uniacid" => $_W["uniacid"], ":card_id" => $card_info["id"], ":card_mid" => $v["id"]));
            if ($info) {
                if ($info["addtime"] >= strtotime(date("Y-m-d", time() - 24 * 60 * 60))) {
                    $Data[$k]["now_status"] = 0;
                } else {
                    $Data[$k]["now_status"] = 1;
                }
            } else {
                $Data[$k]["now_status"] = -1;
            }
        } else {
            $Data[$k]["now_status"] = -2;
        }
        $phone = array();
        $phone = pdo_fetch("SELECT *  FROM " . tablename("dbs_masclwlcard_member") . " WHERE {$condition}  AND openId=:openId ", array(":uniacid" => $_W["uniacid"], ":openId" => $v["openId"]));
        $Data[$k]["phone"] = $phone["phone"] ? $phone["phone"] : "暂无";
        $source = array();
        if ($v["source_id"]) {
            $source = pdo_fetch("SELECT *  FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE {$condition}  AND id=:source_id ", array(":uniacid" => $_W["uniacid"], ":source_id" => $v["source_id"]));
            if (empty($source)) {
                $Data[$k]["Source_name"] = "暂无";
            } else {
                $Data[$k]["Source_name"] = $source["name"] ? $source["name"] : ($source["nickname"] ? $source["nickname"] : "匿名");
            }
        } else {
            if ($v["send_cardid"]) {
                $Data[$k]["Source_name"] = "来自交接";
            } else {
                $Data[$k]["Source_name"] = "暂无";
            }
        }
    }
}
$this->dexit(array("error" => 0, "ss" => $_GPC["card_id"], "Data" => $Data));
exit;