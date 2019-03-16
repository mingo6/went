<?php

$userinfo = $_SESSION["userinfo"];
$userinfo = base64_decode($_SESSION["userinfo"]);
$userinfo = unserialize($userinfo);
if (!$_GPC["card_id"]) {
    $info["is_send_status"] = 1;
    return $this->result(0, "返回消息", $info);
} else {
    $info_find = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
    if (empty($info_find)) {
        $info["is_send_status"] = 2;
        return $this->result(0, "返回消息", $info);
    } else {
        if ($info_find["is_sendcard"]) {
            $info["is_send_status"] = 3;
            return $this->result(0, "返回消息", $info);
        }
        $card_membr = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and openId=:openId", array(":uniacid" => $_W["uniacid"], ":openId" => $userinfo["openId"]));
        if($card_membr['aid'] != $info_find['id']){
            $set = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_set") . " WHERE uniacid =:uniacid ", array(":uniacid" => $_W["uniacid"]));
            if($set){
                if($set['is_public']){
                    if(!$_GPC["password"]){
                        $info["is_send_status"] = 4;
                        return $this->result(0, "请输入密码查看",$info);
                    }elseif($set['public_password'] != md5($_GPC["password"])){
                        $info["is_send_status"] = 4;
                        return $this->result(0, "密码错误!",$info);
                    }
                }
            }
        }
    }
}
if ($_GPC["type"] == 1 && $_GPC["fid"]) {
    if ($userinfo["openId"]) {
        $zaninfo = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_zan") . " WHERE uniacid =:uniacid and openId=:openId and fid=:fid", array(":uniacid" => $_W["uniacid"], ":openId" => $userinfo["openId"], ":fid" => $_GPC["fid"]));
        $user = array();
        $user["uniacid"] = $_W["uniacid"];
        $user["openId"] = $userinfo["openId"];
        $user["nickname"] = $userinfo["nickname"];
        $user["phone"] = $data["purePhoneNumber"];
        $user["gender"] = $userinfo["gender"];
        $user["city"] = $userinfo["city"];
        $user["province"] = $userinfo["province"];
        $user["city"] = $userinfo["city"];
        $user["fid"] = $_GPC["fid"];
        $user["language"] = $userinfo["language"];
        $user["avatarUrl"] = $userinfo["avatarUrl"];
        if (empty($zaninfo)) {
            $user["addtime"] = time();
            $user["status"] = 1;
            $result = pdo_insert("dbs_masclwlcard_zan", $user);
        } else {
            $user["addtime"] = $info["addtime"] ? $info["addtime"] : time();
            $user["updatetime"] = time();
            if ($zaninfo["status"]) {
                $user["status"] = 0;
            } else {
                $user["status"] = 1;
            }
            pdo_update("dbs_masclwlcard_zan", $user, array("id" => $zaninfo["id"]));
        }
    }
}
if ($_GPC["type"] == 2 && $_GPC["fid"]) {
    if ($userinfo["openId"]) {
        $user = array();
        $user["uniacid"] = $_W["uniacid"];
        $user["openId"] = $userinfo["openId"];
        $user["nickname"] = $userinfo["nickname"];
        $user["phone"] = $data["purePhoneNumber"];
        $user["gender"] = $userinfo["gender"];
        $user["city"] = $userinfo["city"];
        $user["province"] = $userinfo["province"];
        $user["city"] = $userinfo["city"];
        $user["fid"] = $_GPC["fid"];
        $user["language"] = $userinfo["language"];
        $user["avatarUrl"] = $userinfo["avatarUrl"];
        $user["addtime"] = time();
        $user["content"] = $_GPC["content"];
        $result = pdo_insert("dbs_masclwlcard_pl", $user);
    }
}
$info_old = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
if ($userinfo["openId"] && $_GPC["card_id"]) {
    $card_membr = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and aid=:aid and openId=:openId", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"], ":openId" => $userinfo["openId"]));
    if (empty($card_membr)) {
        $user = array();
        $user["uniacid"] = $_W["uniacid"];
        $user["openId"] = $userinfo["openId"];
        $user["nickname"] = $userinfo["nickname"];
        $user["aid"] = $_GPC["card_id"];
        $user["gender"] = $userinfo["gender"];
        $user["city"] = $userinfo["city"];
        $user["province"] = $userinfo["province"];
        $user["language"] = $userinfo["language"];
        $user["avatarUrl"] = $userinfo["avatarUrl"];
        $user["source_id"] = intval($_GPC["share_id"]) ? intval($_GPC["share_id"]) : 0;
        $user["send_cardid"] = intval($_GPC["send_cardid"]) ? intval($_GPC["send_cardid"]) : 0;
        $user["addtime"] = time();
        $res_one = pdo_insert("dbs_masclwlcard_card_member", $user);
        if (!empty($res_one)) {
            if (intval($_GPC["share_id"])) {
                $card_membr = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and aid=:aid and openId=:openId", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"], ":openId" => $userinfo["openId"]));
                $this->send_cash($card_membr);
            }
            $user = array();
            if ($info_old["zd_msg"]) {
                $user["uniacid"] = $_W["uniacid"];
                $user["openId"] = $userinfo["openId"];
                $user["card_id"] = $_GPC["card_id"];
                $user["nickname"] = $userinfo["nickname"];
                $user["gender"] = $userinfo["gender"];
                $user["city"] = $userinfo["city"];
                $user["province"] = $userinfo["province"];
                $user["language"] = $userinfo["language"];
                $user["avatarUrl"] = $userinfo["avatarUrl"];
                $user["msg"] = $info_old["zd_msg"];
                $user["formId"] = '';
                $user["type"] = 0;
                $user["is_send"] = 1;
                $user["stype"] = 1;
                $user["addtime"] = time();
                $result = pdo_insert("dbs_masclwlcard_chat", $user);
            }
        }
    }
}
$card_membr = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and aid=:aid and openId=:openId", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"], ":openId" => $userinfo["openId"]));
$info_card = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
if ($_GPC["type"] == 3 && $_GPC["card_id"]) {
    if ($userinfo["openId"]) {
        if ($card_membr["showZan"]) {
            pdo_update("dbs_masclwlcard_card_member", array("showZan" => 0), array("id" => $card_membr["id"]));
            pdo_update("dbs_masclwlcard", array("thumbs_num -=" => 1), array("uniacid" => $_W["uniacid"], "id" => $info_card["id"]));
        } else {
            pdo_update("dbs_masclwlcard_card_member", array("showZan" => 1), array("id" => $card_membr["id"]));
            pdo_update("dbs_masclwlcard", array("thumbs_num +=" => 1), array("uniacid" => $_W["uniacid"], "id" => $info_card["id"]));
        }
    }
}
$info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid and is_sendcard=0 ", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
$card = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_set") . " WHERE uniacid =:uniacid ", array(":uniacid" => $_W["uniacid"]));
$web = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_web") . " WHERE uniacid =:uniacid ", array(":uniacid" => $_W["uniacid"]));
$adv = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_adv") . " WHERE uniacid =:uniacid ", array(":uniacid" => $_W["uniacid"]));
$news = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_news") . " WHERE uniacid =:uniacid ORDER BY sort DESC ", array(":uniacid" => $_W["uniacid"]));
$nav = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_nav") . " WHERE uniacid =:uniacid ", array(":uniacid" => $_W["uniacid"]));
$shops = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops") . " WHERE uniacid = :uniacid and is_show=1 ORDER BY sort DESC LIMIT 0,8", array(":uniacid" => $_W["uniacid"]));
$titles = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops_category") . " WHERE uniacid = :uniacid and parentid=0 and  enabled=1 ORDER BY sort DESC ", array(":uniacid" => $_W["uniacid"]));
$dynamic_list = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_friend") . " WHERE uniacid =:uniacid and ( is_card=0 OR ( is_card=1 and card_id=:card_id) ) ORDER BY time DESC ", array(":uniacid" => $_W["uniacid"], ":card_id" => $info["id"]));
if (!empty($dynamic_list)) {
    foreach ($dynamic_list as $k => $v) {
        $dynamic_list[$k]["ups"] = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_zan") . " WHERE uniacid =:uniacid and fid=:fid and status=1", array(":uniacid" => $_W["uniacid"], ":fid" => $v["id"]));
        $dynamic_list[$k]["replies"] = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_pl") . " WHERE uniacid =:uniacid and fid=:fid", array(":uniacid" => $_W["uniacid"], ":fid" => $v["id"]));
        $isupinfo = array();
        if ($userinfo["openId"]) {
            $isupinfo = array();
            $isupinfo = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_zan") . " WHERE uniacid =:uniacid and openId=:openId and fid=:fid", array(":uniacid" => $_W["uniacid"], ":openId" => $userinfo["openId"], ":fid" => $v["id"]));
            $dynamic_list[$k]["isup"] = $isupinfo["status"];
        }
        if (!empty($v["all_img"])) {
            $dynamic_list[$k]["all_imgarr"] = explode(",", $v["all_img"]);
        }
        $dynamic_list[$k]["head_img"] = tomedia($v["head_img"]);
        $dynamic_list[$k]["time"] = date("Y-m-d", $v["time"]);
    }
}
$product = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_product") . " WHERE uniacid =:uniacid ORDER BY sort DESC ", array(":uniacid" => $_W["uniacid"]));
$message = "返回消息";
$errno = 0;
if (!empty($product)) {
    foreach ($product as $k => $v) {
        if ($v["cp_bs_img"]) {
            $product[$k]["cp_bs_img"] = unserialize($v["cp_bs_img"]);
            if (!empty($product[$k]["cp_bs_img"])) {
                foreach ($product[$k]["cp_bs_img"] as $key => $val) {
                    $product[$k]["cp_bs_img"][$key] = tomedia($val);
                }
            }
        }
        if ($v["cp_bs_content"]) {
            $product[$k]["cp_bs_content"] = unserialize($v["cp_bs_content"]);
            if (!empty($product[$k]["cp_bs_content"])) {
                foreach ($product[$k]["cp_bs_content"] as $key => $val) {
                    $product[$k]["cp_bs_content"][$key] = tomedia($val);
                }
            }
        }
    }
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
if (!empty($news)) {
    foreach ($news as $k => $v) {
        $news[$k]["head_img"] = tomedia($v["head_img"]);
        $news[$k]["time"] = date("Y-m-d", $v["time"]);
    }
}
if (!empty($nav)) {
    foreach ($nav as $k => $v) {
        $nav[$k]["images"] = tomedia($v["images"]);
    }
}
if (!empty($adv)) {
    foreach ($adv as $k => $v) {
        $adv[$k]["images"] = tomedia($v["images"]);
    }
}
$web["video"] = tomedia($web["video"]);
$web["images"] = tomedia($web["images"]);
$j_photo = array();
if (!empty($web["cp_bs_content"])) {
    $js_photo = unserialize($web["cp_bs_content"]);
    foreach ($js_photo as $k => $v) {
        $j_photo[] = tomedia($v);
    }
}
$info["web"] = $web;
$info["adv"] = $adv;
$info["j_photo"] = $j_photo;
$info["news"] = $news;
$info["shops"] = $shops ? $shops : '';
$info["nav"] = $nav;
$info["dynamic_list"] = $dynamic_list;
$info["product"] = $product;
$photo = array();
if (!empty($info["photo"])) {
    $newphoto = unserialize($info["photo"]);
    if (!empty($newphoto)) {
        foreach ($newphoto as $k => $v) {
            $photo[] = tomedia($v);
        }
    }
}
$info["newphoto"] = $photo;
$card_allmembr = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and  aid=:aid  order by id desc ", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
$totle = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_card_member") . "where uniacid=:uniacid and  aid=:aid ", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
$info["card_allmembr"] = $card_allmembr;
$info["totle"] = $totle;
$card_membr = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and aid=:aid and openId=:openId", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"], ":openId" => $userinfo["openId"]));
$info["card_membr"] = $card_membr;
load()->model("mc");
$account_api = WeAccount::create();
$GetCustomMobile = 0;
if (empty($userinfo["openId"]) || empty($userinfo["nickname"])) {
    $isAuthorize = 0;
} else {
    $isAuthorize = 1;
    $GetPhone = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_member") . " WHERE uniacid =:uniacid and openId=:openId", array(":uniacid" => $_W["uniacid"], ":openId" => $userinfo["openId"]));
    if ($GetPhone) {
        $GetCustomMobile = 1;
    }
}
$footer = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_footer") . " WHERE uniacid =:uniacid ", array(":uniacid" => $_W["uniacid"]));
$footer["card_name"] = $footer["card_name"] ? $footer["card_name"] : "名片";
$footer["shop_name"] = $footer["shop_name"] ? $footer["shop_name"] : "商城";
$footer["friend_name"] = $footer["friend_name"] ? $footer["friend_name"] : "动态";
$footer["web_name"] = $footer["web_name"] ? $footer["web_name"] : "官网";
$footer_nav = array($footer["card_name"], $footer["shop_name"], $footer["friend_name"], $footer["web_name"]);
$footer["card_img"] = tomedia($footer["card_img"]) ? tomedia($footer["card_img"]) : "../../images/card/01_2x.png";
$footer["card_img_no"] = tomedia($footer["card_img_no"]) ? tomedia($footer["card_img_no"]) : "../../images/card/01_2x_n.png";
$footer["shop_img"] = tomedia($footer["shop_img"]) ? tomedia($footer["shop_img"]) : "../../images/card/02_x.png";
$footer["shop_img_no"] = tomedia($footer["shop_img_no"]) ? tomedia($footer["shop_img_no"]) : "../../images/card/02_x_n.png";
$footer["friend_img"] = tomedia($footer["friend_img"]) ? tomedia($footer["friend_img"]) : "../../images/card/03_x.png";
$footer["friend_img_no"] = tomedia($footer["friend_img_no"]) ? tomedia($footer["friend_img_no"]) : "../../images/card/03_x_n.png";
$footer["web_img"] = tomedia($footer["web_img"]) ? tomedia($footer["web_img"]) : "../../images/card/04_x.png";
$footer["web_img_no"] = tomedia($footer["web_img_no"]) ? tomedia($footer["web_img_no"]) : "../../images/card/04_x_n.png";
$nav_footer = array(0 => array("name" => $footer["card_name"], "icon" => $footer["card_img_no"], "selectIcon" => $footer["card_img"], "card_type" => intval($footer["card_type"]), "card_appid" => $footer["card_appid"], "card_url" => $footer["card_url"], "card_path" => $footer["card_path"]), 1 => array("name" => $footer["shop_name"], "icon" => $footer["shop_img_no"], "selectIcon" => $footer["shop_img"], "shop_type" => intval($footer["shop_type"]), "shop_appid" => $footer["shop_appid"], "shop_url" => $footer["shop_url"], "shop_path" => $footer["shop_path"]), 2 => array("name" => $footer["friend_name"], "icon" => $footer["friend_img_no"], "selectIcon" => $footer["friend_img"], "friend_type" => intval($footer["friend_type"]), "friend_appid" => $footer["friend_appid"], "friend_url" => $footer["friend_url"], "friend_path" => $footer["friend_path"]), 3 => array("name" => $footer["web_name"], "icon" => $footer["web_img_no"], "selectIcon" => $footer["web_img"], "web_type" => intval($footer["web_type"]), "web_appid" => $footer["web_appid"], "web_url" => $footer["web_url"], "web_path" => $footer["web_path"]));
$info["nav_footer"] = $nav_footer;
$info["footer_nav"] = $footer_nav;
$info["isAuthorize"] = $isAuthorize;
$info["GetCustomMobile"] = $GetCustomMobile;
$info["titles"] = $titles;
$info["hmd_status"] = intval($card_membr["hmd_status"]);
$info["share_id"] = intval($_GPC["share_id"]) ? intval($_GPC["share_id"]) : 0;
if (!empty($info)) {
    $card["company_logo"] = tomedia($card["company_logo"]);
    $card["shop_bg"] = tomedia($card["shop_bg"]);
    $info["card_logo"] = tomedia($info["card_logo"]);
    $info["template_img"] = tomedia($info["template_img"]);
    $info["share_img"] = tomedia($info["share_img"]);
    $info["card"] = $card;
    return $this->result($errno, $message, $info);
} else {
    return $this->result($errno, $message, $info);
}