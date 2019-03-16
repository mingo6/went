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
if (!$_GPC["group"]) {
    $this->dexit(array("Code" => 1, "msg" => "错误5"));
    exit;
}
if (!$_GPC["days"]) {
    $_GPC["days"] = 1;
}
$condition = " uniacid = :uniacid";
$value = array();
$value_new = array();
$i = 0;
if ($_GPC["group"] == 1) {
    $paras = array(":uniacid" => $_W["uniacid"]);
    $value = pdo_fetchall("SELECT  aid,count(*) as num FROM " . tablename("dbs_masclwlcard_card_member") . "where {$condition} group by aid order by num desc ", $paras);
    if (!empty($value)) {
        foreach ($value as $k => $v) {
            $info = array();
            $info = pdo_fetch("SELECT  card_logo,card_name FROM " . tablename("dbs_masclwlcard") . "where uniacid=:uniacid and id=:aid ", array(":uniacid" => $_W["uniacid"], ":aid" => $v["aid"]));
            if (!empty($info)) {
                $value_new[$i]["avaterUrl"] = tomedia($info["card_logo"]);
                $value_new[$i]["nickname"] = $info["card_name"];
                $value_new[$i]["num"] = $v["num"];
                $value_new[$i]["id"] = $v["aid"];
                $i = $i + 1;
            }
        }
    }
}
if ($_GPC["group"] == 2) {
    if ($_GPC["days"] == 1) {
        $startTime = strtotime(date("Y-m-d", time() - 24 * 60 * 60));
        $endTime = strtotime(date("Y-m-d", time()));
    } else {
        $startTime = time() - $_GPC["days"] * 24 * 60 * 60;
        $endTime = time();
    }
    $condition .= " AND  addtime BETWEEN :startTime AND :endTime ";
    $paras = array(":uniacid" => $_W["uniacid"], ":startTime" => $startTime, ":endTime" => $endTime);
    $value = pdo_fetchall("SELECT  aid,count(*) as num FROM " . tablename("dbs_masclwlcard_card_member") . "where {$condition} group by aid order by num desc ", $paras);
    if (!empty($value)) {
        foreach ($value as $k => $v) {
            $info = array();
            $info = pdo_fetch("SELECT  card_logo,card_name FROM " . tablename("dbs_masclwlcard") . "where uniacid=:uniacid and id=:aid ", array(":uniacid" => $_W["uniacid"], ":aid" => $v["aid"]));
            if (!empty($info)) {
                $value_new[$i]["avaterUrl"] = tomedia($info["card_logo"]);
                $value_new[$i]["nickname"] = $info["card_name"];
                $value_new[$i]["num"] = $v["num"];
                $value_new[$i]["id"] = $v["aid"];
                $i = $i + 1;
            }
        }
    }
}
if ($_GPC["group"] == 3) {
    if ($_GPC["days"] == 1) {
        $startTime = strtotime(date("Y-m-d", time() - 24 * 60 * 60));
        $endTime = date("Y-m-d", time());
    } else {
        $startTime = time() - $_GPC["days"] * 24 * 60 * 60;
        $endTime = time();
    }
    $condition .= " AND  addtime BETWEEN :startTime AND :endTime ";
    $paras = array(":uniacid" => $_W["uniacid"], ":startTime" => $startTime, ":endTime" => $endTime);
    $value = pdo_fetchall("SELECT  card_id,count(*) as num FROM " . tablename("dbs_masclwlcard_card_closer") . "where {$condition} group by card_id  order by num desc ", $paras);
    if (!empty($value)) {
        foreach ($value as $k => $v) {
            $info = array();
            $info = pdo_fetch("SELECT  card_logo,card_name FROM " . tablename("dbs_masclwlcard") . "where uniacid=:uniacid and id=:card_id ", array(":uniacid" => $_W["uniacid"], ":card_id" => $v["card_id"]));
            if (!empty($info)) {
                $value_new[$i]["avaterUrl"] = tomedia($info["card_logo"]);
                $value_new[$i]["nickname"] = $info["card_name"];
                $value_new[$i]["num"] = $v["num"];
                $value_new[$i]["id"] = $v["card_id"];
                $i = $i + 1;
            }
        }
    }
}
if ($_GPC["group"] == 4) {
    if ($_GPC["days"] == 1) {
        $startTime = strtotime(date("Y-m-d", time() - 24 * 60 * 60));
        $endTime = date("Y-m-d", time());
    } else {
        $startTime = time() - $_GPC["days"] * 24 * 60 * 60;
        $endTime = time();
    }
    $condition .= " AND  addtime BETWEEN :startTime AND :endTime ";
    $paras = array(":uniacid" => $_W["uniacid"], ":startTime" => $startTime, ":endTime" => $endTime);
    $value = pdo_fetchall("SELECT  card_id,count(*) as num FROM " . tablename("dbs_masclwlcard_chat") . "where {$condition} and is_send = 0 group by card_id  order by num desc ", $paras);
    if (!empty($value)) {
        foreach ($value as $k => $v) {
            $info = array();
            $info = pdo_fetch("SELECT  card_logo,card_name FROM " . tablename("dbs_masclwlcard") . "where uniacid=:uniacid and id=:card_id ", array(":uniacid" => $_W["uniacid"], ":card_id" => $v["card_id"]));
            if (!empty($info)) {
                $value_new[$i]["avaterUrl"] = tomedia($info["card_logo"]);
                $value_new[$i]["nickname"] = $info["card_name"];
                $value_new[$i]["num"] = $v["num"];
                $value_new[$i]["id"] = $v["card_id"];
                $i = $i + 1;
            }
        }
    }
}
if ($_GPC["group"] == 5) {
    $condition .= "  AND gailv BETWEEN :min AND :max ";
    $paras = array(":uniacid" => $_W["uniacid"], ":min" => $_GPC["min"], ":max" => $_GPC["max"]);
    $value = pdo_fetchall("SELECT  aid,count(*) as num FROM " . tablename("dbs_masclwlcard_card_member") . "where {$condition}  group by aid  order by num desc ", $paras);
    if (!empty($value)) {
        foreach ($value as $k => $v) {
            $info = array();
            $info = pdo_fetch("SELECT  card_logo,card_name FROM " . tablename("dbs_masclwlcard") . "where uniacid=:uniacid and id=:aid ", array(":uniacid" => $_W["uniacid"], ":aid" => $v["aid"]));
            if (!empty($info)) {
                $value_new[$i]["avaterUrl"] = tomedia($info["card_logo"]);
                $value_new[$i]["nickname"] = $info["card_name"];
                $value_new[$i]["num"] = $v["num"];
                $value_new[$i]["id"] = $v["aid"];
                $i = $i + 1;
            }
        }
    }
}
$this->dexit(array("Code" => 0, "value" => $value_new, "min" => $_GPC["min"], "max" => $_GPC["max"], "group" => $_GPC["group"]));
exit;