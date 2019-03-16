<?php

$status = $this->check_qylogin();
if ($status == -1) {
    echo "请在企业微信打开";
    exit;
}
if ($status == -2) {
    echo "没有绑定对应的名片";
    exit;
}
$UserId = $_SESSION["session_dbs_masclwlcard_usderid"];
$card_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and UserId=:UserId", array(":uniacid" => $_W["uniacid"], ":UserId" => $UserId));
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
$Data = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_act_report") . " WHERE {$condition} and   card_id=:card_id ORDER BY addtime DESC  ", array(":uniacid" => $_W["uniacid"], ":card_id" => $card_info["id"], ":startTime" => $startTime, ":endTime" => $endTime));
$type0_num = 0;
$type1_num = 0;
$type2_num = 0;
$type3_num = 0;
$type4_num = 0;
$type5_num = 0;
$type6_num = 0;
$type7_num = 0;
foreach ($Data as $k => $v) {
    switch (intval($v["act_id"])) {
        case 654:
            $Data[$k]["type"] = 5;
            $type7_num = $type7_num + 1;
            break;
        case 655:
            if ($v["copytype"] == "wxid") {
                $Data[$k]["type"] = 2;
                $type2_num = $type2_num + 1;
            }
            break;
        case 657:
            if ($v["footertype"] == 0) {
                $Data[$k]["type"] = 3;
                $type4_num = $type4_num + 1;
            } else {
                if ($v["footertype"] == 1) {
                    $Data[$k]["type"] = 0;
                    $type0_num = $type0_num + 1;
                } else {
                    if ($v["footertype"] == 2) {
                        $Data[$k]["type"] = 4;
                        $type5_num = $type5_num + 1;
                    } else {
                        if ($v["footertype"] == 3) {
                            $Data[$k]["type"] = 1;
                            $type1_num = $type1_num + 1;
                        }
                    }
                }
            }
            break;
        case 659:
            $Data[$k]["type"] = 6;
            break;
        case 701:
            $Data[$k]["type"] = 7;
            break;
        default:
            $Data[$k]["type"] = -1;
            break;
    }
    $Data[$k]["num"] = 1;
}
include $this->template("member_act");