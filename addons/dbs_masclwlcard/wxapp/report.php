<?php

$userinfo = $_SESSION["userinfo"];
$userinfo = base64_decode($_SESSION["userinfo"]);
$userinfo = unserialize($userinfo);
$card = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
if ($userinfo["openId"] && $_GPC["card_id"] && intval($_GPC["act_id"])) {
    $url = $_W["siteroot"] . "app/" . $this->createMobileUrl("chat", array("openid" => $userinfo["openId"], "card_id" => $_GPC["card_id"]));
    $card_membr = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and aid=:aid and openId=:openId", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"], ":openId" => $userinfo["openId"]));
    $footer = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_footer") . " WHERE uniacid =:uniacid ", array(":uniacid" => $_W["uniacid"]));
    $footer["card_name"] = $footer["card_name"] ? $footer["card_name"] : "名片";
    $footer["shop_name"] = $footer["shop_name"] ? $footer["shop_name"] : "商城";
    $footer["friend_name"] = $footer["friend_name"] ? $footer["friend_name"] : "动态";
    $footer["web_name"] = $footer["web_name"] ? $footer["web_name"] : "官网";
    switch (intval($_GPC["act_id"])) {
        case 101:
            $content = $userinfo["nickname"] . " 已支付";
            if (!intval($card_membr["pb_status"])) {
                $this->qy_send($card["userid"], $content);
            }
            break;
        case 102:
            if ($_GPC["copytype"]) {
                $wenz = array();
                $wenz = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_friend") . " WHERE uniacid =:uniacid and id=:copytype ", array(":uniacid" => $_W["uniacid"], ":copytype" => $_GPC["copytype"]));
                if ($wenz["is_card"]) {
                    $content = $userinfo["nickname"] . "分享了你的文章:" . cutstr($wenz["content_card"], 8, true);
                } else {
                    $content = $userinfo["nickname"] . "分享了公司文章:" . cutstr($wenz["title"], 8, true);
                }
                if (!intval($card_membr["pb_status"])) {
                    $this->qy_send($card["userid"], $content);
                }
            }
            break;
        case 103:
            if ($_GPC["copytype"] == 0) {
                $content = $userinfo["nickname"] . "分享了" . $footer["card_name"];
            } else {
                if ($_GPC["copytype"] == 1) {
                    $content = $userinfo["nickname"] . "分享了" . $footer["shop_name"];
                } else {
                    if ($_GPC["copytype"] == 2) {
                        $content = $userinfo["nickname"] . "分享了" . $footer["friend_name"];
                    } else {
                        if ($_GPC["copytype"] == 3) {
                            $content = $userinfo["nickname"] . "分享了" . $footer["web_name"];
                        }
                    }
                }
            }
            if (!intval($card_membr["pb_status"])) {
                $this->qy_send($card["userid"], $content);
            }
            break;
        case 201:
            $content = $userinfo["nickname"] . " 更新了银行卡信息";
            if (!intval($card_membr["pb_status"])) {
                $this->qy_send($card["userid"], $content);
            }
            break;
        case 301:
            $shops = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_shops") . " WHERE uniacid =:uniacid and id=:copytype ", array(":uniacid" => $_W["uniacid"], ":copytype" => $_GPC["copytype"]));
            $content = $userinfo["nickname"] . " 正在浏览 商品:" . $shops["shop_name"];
            if (!intval($card_membr["pb_status"])) {
                $this->qy_send($card["userid"], $content);
            }
            break;
        case 653:
            break;
        case 654:
            $content = $userinfo["nickname"] . "将您信息保存到通讯录";
            pdo_update("dbs_masclwlcard_card_member", array("isPopCard" => 1), array("id" => $card_membr["id"]));
            break;
        case 655:
            if ($_GPC["copytype"]) {
                $copytype = $_GPC["copytype"];
                if ($_GPC["copytype"] == "email") {
                    $copytype = "邮箱信息";
                } else {
                    if ($_GPC["copytype"] == "wxid") {
                        $copytype = "微信信息";
                    } else {
                        if ($_GPC["copytype"] == "company") {
                            $copytype = "公司信息";
                        } else {
                            if ($_GPC["copytype"] == "addr") {
                                $copytype = "地址信息";
                            }
                        }
                    }
                }
                $content = $userinfo["nickname"] . "复制了你的" . $copytype;
            }
            break;
        case 656:
            $total = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_act_report") . "where uniacid=:uniacid and openId=:openId and card_id=:card_id and act_id=:act_id", array(":uniacid" => $_W["uniacid"], ":openId" => $userinfo["openId"], ":card_id" => $_GPC["card_id"], ":act_id" => 656));
            if ($total) {
                $num = $total + 1;
            } else {
                $num = 1;
            }
            $content = $userinfo["nickname"] . "第" . $num . "次打开你的名片";
            break;
        case 657:
            if ($_GPC["copytype"] == 0) {
                $copytype = "名片";
                $content = $userinfo["nickname"] . "正在查看" . $footer["card_name"];
            } else {
                if ($_GPC["copytype"] == 1) {
                    $copytype = "产品";
                    $content = $userinfo["nickname"] . "正在查看" . $footer["shop_name"];
                } else {
                    if ($_GPC["copytype"] == 2) {
                        $copytype = "公司信息";
                        $content = $userinfo["nickname"] . "正在查看" . $footer["friend_name"];
                    } else {
                        if ($_GPC["copytype"] == 3) {
                            $copytype = "官网";
                            $content = $userinfo["nickname"] . "正在进入" . $footer["web_name"];
                        }
                    }
                }
            }
            break;
        case 658:
            if ($_GPC["copytype"] == 0) {
                $copytype = "名片";
                $content = $userinfo["nickname"] . "正在返回你的名片首页";
            } else {
                if ($_GPC["copytype"] == 1) {
                    $copytype = "产品";
                    $content = $userinfo["nickname"] . "正在进入您的" . $footer["shop_name"];
                } else {
                    if ($_GPC["copytype"] == 2) {
                        $copytype = "公司信息";
                        $content = $userinfo["nickname"] . "正在查看您的" . $footer["friend_name"];
                    } else {
                        if ($_GPC["copytype"] == 3) {
                            $copytype = "官网";
                            $content = $userinfo["nickname"] . "正在进入您的" . $footer["web_name"];
                        }
                    }
                }
            }
            break;
        case 659:
            $content = $userinfo["nickname"] . "生成了您的海报";
            break;
        case 660:
            $content = $userinfo["nickname"] . "将你的海报保存了";
            break;
        case 701:
            $subject = "客户行为";
            $content = $userinfo["nickname"] . "正在进入对话框,赶紧去看看吧!\n";
            if (!intval($card_membr["pb_status"])) {
                $this->qy_send($card["userid"], $content);
            }
            $this->send_message($subject, $content, $card["email"]);
            break;
        case 708:
            $subject = "客户行为";
            $_GPC["copytype"] = htmlspecialchars_decode($_GPC["copytype"]);
            if ($_GPC["copytype"]) {
                $qy_content = $userinfo["nickname"] . "发来留言:" . $_GPC["copytype"] . "\n" . "对话详细:<a href=\"" . $url . "\">点击对话</a>";
                if (!intval($card_membr["pb_status"])) {
                    $this->qy_send($card["userid"], $qy_content);
                }
                $this->send_message($subject, $qy_content, $card["email"]);
                $user = array();
                $user["uniacid"] = $_W["uniacid"];
                $user["openId"] = $userinfo["openId"];
                $user["card_id"] = $_GPC["card_id"];
                $user["nickname"] = $userinfo["nickname"];
                $user["gender"] = $userinfo["gender"];
                $user["city"] = $userinfo["city"];
                $user["province"] = $userinfo["province"];
                $user["city"] = $userinfo["city"];
                $user["formId"] = $_GPC["formId"];
                $user["language"] = $userinfo["language"];
                $user["avatarUrl"] = $userinfo["avatarUrl"];
                $user["msg"] = $_GPC["copytype"];
                $user["type"] = 1;
                $user["stype"] = 0;
                $user["addtime"] = time();
                $result = pdo_insert("dbs_masclwlcard_chat", $user);
                return $this->result(0, '', '');
            }
            break;
        default:
            return $this->result(0, '', '');
    }
    $info = array();
    $user = array();
    $user["uniacid"] = $_W["uniacid"];
    if ($_GPC["act_id"] == "655") {
        $user["copytype"] = $_GPC["copytype"];
    }
    if ($_GPC["act_id"] == "310") {
        $user["copytype"] = $_GPC["copytype"];
    }
    if ($_GPC["act_id"] == "656") {
        $user["num"] = $num;
    }
    if ($_GPC["act_id"] == "657") {
        $user["footertype"] = $_GPC["copytype"];
    }
    $user["openId"] = $userinfo["openId"];
    $user["card_id"] = $_GPC["card_id"];
    $user["act_id"] = $_GPC["act_id"];
    $user["nickname"] = $userinfo["nickname"];
    $user["gender"] = $userinfo["gender"];
    $user["city"] = $userinfo["city"];
    $user["province"] = $userinfo["province"];
    $user["city"] = $userinfo["city"];
    $user["language"] = $userinfo["language"];
    $user["avatarUrl"] = $userinfo["avatarUrl"];
    $user["act_content"] = $content;
    $rep = "\n" . "立即回复:<a href=\"" . $url . "\">点击对话</a>";
    $user["addtime"] = time();
    $result = pdo_insert("dbs_masclwlcard_act_report", $user);
    $subject = "客户行为";
    if (!intval($card_membr["pb_status"])) {
        $this->qy_send($card["userid"], $content . $rep);
    }
}
$message = "返回消息";
$errno = 0;
$data = array();
$data["error"] = 0;
return $this->result($errno, $message, $info);