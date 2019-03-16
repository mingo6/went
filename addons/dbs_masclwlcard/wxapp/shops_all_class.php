<?php

$data_all = array();
$titles = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops_category") . " WHERE uniacid = :uniacid and parentid=0 and  enabled=1 ORDER BY sort DESC ", array(":uniacid" => $_W["uniacid"]));
$data_all[0]["title"] = "全部产品";
$data_all[0]["id"] = 0;
$shops = array();
$shops = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops") . " WHERE uniacid = :uniacid and is_show=1  ORDER BY sort DESC ", array(":uniacid" => $_W["uniacid"]));
if (!empty($shops)) {
    foreach ($shops as $key => $val) {
        $shops[$key]["gimg"] = tomedia($val["gimg"]);
    }
}
$data_all[0]["childClassify"] = $shops;
$i = 1;
if (!empty($titles)) {
    foreach ($titles as $k => $v) {
        $shops = array();
        $shops = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops") . " WHERE uniacid = :uniacid and is_show=1 and typeid=:typeid ORDER BY sort DESC ", array(":uniacid" => $_W["uniacid"], ":typeid" => $v["id"]));
        if (!empty($shops)) {
            foreach ($shops as $key => $val) {
                $shops[$key]["gimg"] = tomedia($val["gimg"]);
            }
        }
        $data_all[$i]["title"] = $v["title"];
        $data_all[$i]["id"] = $v["id"];
        $data_all[$i]["childClassify"] = $shops;
        $i = $i + 1;
    }
}
$info["card_id"] = $_GPC["card_id"];
$info["data_all"] = $data_all;
$message = "返回消息";
return $this->result(0, $message, $info);