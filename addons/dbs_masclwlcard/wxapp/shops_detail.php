<?php

$userinfo = $_SESSION["userinfo"];
$userinfo = base64_decode($_SESSION["userinfo"]);
$userinfo = unserialize($userinfo);
$card_membr = array();
if (empty($_W["openid"]) || empty($userinfo["nickname"])) {
    $isAuthorize = 0;
} else {
    $isAuthorize = 1;
    $card_membr = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and aid=:aid and openId=:openId", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"], ":openId" => $userinfo["openId"]));
}
$shops = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_shops") . " WHERE uniacid =:uniacid and is_show=1 and id=:shops_id", array(":uniacid" => $_W["uniacid"], "shops_id" => $_GPC["shops_id"]));
if (!empty($shops)) {
    $shops["gimg"] = tomedia($shops["gimg"]);
    $spec = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_shops_spec") . "WHERE uniacid =:uniacid and id=:specid", array(":uniacid" => $_W["uniacid"], ":specid" => $shops["specid"]));
    $spec["spec_content"] = unserialize($spec["spec_content"]);
    if (!empty($spec["spec_content"])) {
        foreach ($spec["spec_content"] as $key => $val) {
            $spec["new_spec"][$key]["spec_content"] = $val;
        }
    }
    $shops["spec"] = $spec;
    if ($shops["cp_bs_img"]) {
        $shops["cp_bs_img"] = unserialize($shops["cp_bs_img"]);
        if (!empty($shops["cp_bs_img"])) {
            foreach ($shops["cp_bs_img"] as $key => $val) {
                $shops["cp_bs_img"][$key] = tomedia($val);
            }
        }
    }
    if ($shops["top_pic"]) {
        $shops["top_pic"] = unserialize($shops["top_pic"]);
        if (!empty($shops["top_pic"])) {
            foreach ($shops["top_pic"] as $key => $val) {
                $shops["top_pic"][$key] = tomedia($val);
            }
        }
    }
}
$card = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid ", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
$card["card_logo"] = tomedia($card["card_logo"]);
if (empty($card_membr)) {
    $showUser = 1;
} else {
    $showUser = 0;
}
$data = array();
$data["isAuthorize"] = $isAuthorize;
$data["showUser"] = $showUser;
$data["showUser"] = $showUser;
$data["shops"] = $shops;
$data["member"] = $card_membr;
$data["card"] = $card;
$data["openid"] = $_W["openid"];
$data["userinfo"] = $userinfo;
$message = "返回消息";
return $this->result(0, $message, $data);