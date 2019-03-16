<?php

if (intval($_GPC["classifyCode"])) {
    $shops = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops") . " WHERE uniacid = :uniacid and is_show=1 and typeid=:classifyCode ORDER BY sort DESC LIMIT 0,8", array(":uniacid" => $_W["uniacid"], ":classifyCode" => $_GPC["classifyCode"]));
} else {
    $shops = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops") . " WHERE uniacid = :uniacid and is_show=1  ORDER BY sort DESC LIMIT 0,8", array(":uniacid" => $_W["uniacid"]));
}
if (!empty($shops)) {
    foreach ($shops as $k => $v) {
        $shops[$k]["gimg"] = tomedia($v["gimg"]);
        if ($v["cp_bs_img"]) {
            $shops[$k]["cp_bs_img"] = unserialize($v["cp_bs_img"]);
            if (!empty($shops[$k]["cp_bs_img"])) {
                foreach ($shops[$k]["cp_bs_img"] as $key => $val) {
                    $shops[$k]["cp_bs_img"][$key] = tomedia($val);
                }
            }
        }
        if ($v["top_pic"]) {
            $shops[$k]["top_pic"] = unserialize($v["top_pic"]);
            if (!empty($shops[$k]["top_pic"])) {
                foreach ($shops[$k]["top_pic"] as $key => $val) {
                    $shops[$k]["top_pic"][$key] = tomedia($val);
                }
            }
        }
    }
}
$info["shops"] = $shops;
$message = "返回消息";
return $this->result(0, $message, $info);