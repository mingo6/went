<?php

defined("IN_IA") or exit("Access Denied");
define("MB_ROOT", IA_ROOT . "/addons/dbs_masclwlcard");
class Dbs_masclwlcardModuleWxapp extends WeModuleWxapp
{
    public function doPageTest()
    {
        global $_GPC, $_W;
        $errno = 0;
        $message = "返回消息";
        $data = array();
        return $this->result($errno, $message, $data);
    }
    public function Send_message($subject, $content, $email)
    {
        return 0;
    }
    public function doPageChat_detail_h()
    {
        global $_W, $_GPC;
        $card = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
        $info = array();
        $message = "返回消息";
        $errno = 0;
        $userinfo = $_SESSION["userinfo"];
        $userinfo = base64_decode($_SESSION["userinfo"]);
        $userinfo = unserialize($userinfo);
        if (!$userinfo["openId"]) {
            return $this->result($errno, $message, $info);
        }
        $msg = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_chat") . " WHERE uniacid =:uniacid and openId=:openId and type=1 and card_id=:card_id and addtime>=:addtime", array(":uniacid" => $_W["uniacid"], ":addtime" => time() - 24 * 3600, "card_id" => $_GPC["card_id"], ":openId" => $userinfo["openId"]));
        $card["card_logo"] = tomedia($card["card_logo"]);
        $card["avatarUrl"] = $userinfo["avatarUrl"];
        $info["card"] = $card;
        $info["msg"] = $msg;
        return $this->result($errno, $message, $info);
    }
    public function doPageWeb_get()
    {
        global $_W, $_GPC;
        $web = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_web") . " WHERE uniacid =:uniacid ", array(":uniacid" => $_W["uniacid"]));
        $info = array();
        $message = "返回消息";
        $errno = 0;
        $userinfo = $_SESSION["userinfo"];
        $userinfo = base64_decode($_SESSION["userinfo"]);
        $userinfo = unserialize($userinfo);
        if (!$userinfo["openId"]) {
            return $this->result($errno, $message, $info);
        }
        if (!$web["tx_video"]) {
            $web["video"] = tomedia($web["video"]);
        }
        return $this->result($errno, $message, $web);
    }
    public function doPageOffline()
    {
        global $_W, $_GPC;
        $card = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
        $info = array();
        $message = "返回消息";
        $errno = 0;
        $userinfo = $_SESSION["userinfo"];
        $userinfo = base64_decode($_SESSION["userinfo"]);
        $userinfo = unserialize($userinfo);
        if (!$userinfo["openId"]) {
            return $this->result($errno, $message, $info);
        }
        $info = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_chat") . " WHERE uniacid =:uniacid and openId=:openId and type=0 and card_id=:card_id order by addtime asc", array(":uniacid" => $_W["uniacid"], ":openId" => $userinfo["openId"], "card_id" => $_GPC["card_id"]));
        return $this->result($errno, $message, $info);
    }
    public function doPageChat_detail()
    {
        global $_W, $_GPC;
        $card = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
        $info = array();
        $message = "返回消息";
        $errno = 0;
        $userinfo = $_SESSION["userinfo"];
        $userinfo = base64_decode($_SESSION["userinfo"]);
        $userinfo = unserialize($userinfo);
        if (!$userinfo["openId"]) {
            return $this->result($errno, $message, $info);
        }
        $card_membr = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and aid=:aid and openId=:openId", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"], ":openId" => $userinfo["openId"]));
        $info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_chat") . " WHERE uniacid =:uniacid and openId=:openId and type=0 and card_id=:card_id order by addtime asc", array(":uniacid" => $_W["uniacid"], ":openId" => $userinfo["openId"], "card_id" => $_GPC["card_id"]));
        if (!empty($info)) {
            pdo_update("dbs_masclwlcard_chat", array("type" => 1), array("id" => $info["id"]));
            if (!intval($card_membr["pb_status"])) {
                $this->qy_send($card["userid"], "对方已经查看了:" . $info["msg"]);
            }
        }
        $info["card_info"] = $card;
        return $this->result($errno, $message, $info);
    }
    public function doPageAddcard_id()
    {
        global $_GPC, $_W;
        load()->model("mc");
        $account_api = WeAccount::create();
        load()->func("communication");
        $userinfo = $_SESSION["userinfo"];
        $userinfo = base64_decode($_SESSION["userinfo"]);
        $userinfo = unserialize($userinfo);
        $info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
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
                $user["source_id"] = intval($_GPC["share_id"]) ? intval($_GPC["share_id"]) : 0;
                $user["send_cardid"] = intval($_GPC["send_cardid"]) ? intval($_GPC["send_cardid"]) : 0;
                $user["province"] = $userinfo["province"];
                $user["language"] = $userinfo["language"];
                $user["avatarUrl"] = $userinfo["avatarUrl"];
                $user["addtime"] = time();
                $res_one = pdo_insert("dbs_masclwlcard_card_member", $user);
                if (!empty($res_one)) {
                    if (intval($_GPC["share_id"])) {
                        $card_membr = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and aid=:aid and openId=:openId", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"], ":openId" => $userinfo["openId"]));
                        $this->send_cash($card_membr);
                    }
                    $user = array();
                    if ($info["zd_msg"]) {
                        $user["uniacid"] = $_W["uniacid"];
                        $user["openId"] = $userinfo["openId"];
                        $user["card_id"] = $_GPC["card_id"];
                        $user["nickname"] = $userinfo["nickname"];
                        $user["gender"] = $userinfo["gender"];
                        $user["city"] = $userinfo["city"];
                        $user["province"] = $userinfo["province"];
                        $user["city"] = $userinfo["city"];
                        $user["language"] = $userinfo["language"];
                        $user["avatarUrl"] = $userinfo["avatarUrl"];
                        $user["msg"] = $info["zd_msg"];
                        $user["formId"] = '';
                        $user["msg"] = $info["zd_msg"];
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
        $message = "返回消息";
        $errno = 0;
        $data = array();
        $data["error"] = 0;
        return $this->result($errno, $message, $card_membr);
    }
    public function doPageGetphonenum()
    {
        global $_GPC, $_W;
        load()->model("mc");
        $account_api = WeAccount::create();
        load()->func("communication");
        $encrypt_data = $_GPC["encryptedData"];
        $iv = $_GPC["iv"];
        $card = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
        if (empty($_SESSION["session_key"]) || empty($encrypt_data) || empty($iv)) {
            $message = "请先登录";
        } else {
            $userinfo = $_SESSION["userinfo"];
            $data = $account_api->pkcs7Encode($encrypt_data, $iv);
            $userinfo = base64_decode($_SESSION["userinfo"]);
            $userinfo = unserialize($userinfo);
            if ($userinfo["openId"]) {
                $card_membr = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and aid=:aid and openId=:openId", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"], ":openId" => $userinfo["openId"]));
                $info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_member") . " WHERE uniacid =:uniacid and openId=:openId", array(":uniacid" => $_W["uniacid"], ":openId" => $userinfo["openId"]));
                $user = array();
                $user["uniacid"] = $_W["uniacid"];
                $user["openId"] = $userinfo["openId"];
                $user["nickname"] = $userinfo["nickname"];
                $user["phone"] = $data["purePhoneNumber"];
                $user["gender"] = $userinfo["gender"];
                $user["city"] = $userinfo["city"];
                $user["province"] = $userinfo["province"];
                $user["city"] = $userinfo["city"];
                $user["language"] = $userinfo["language"];
                $user["avatarUrl"] = $userinfo["avatarUrl"];
                if (empty($info)) {
                    $user["addtime"] = time();
                    $result = pdo_insert("dbs_masclwlcard_member", $user);
                    $content = "请尽快联系客户: " . $user["nickname"] . " 电话:" . $user["phone"];
                    $subject = "客户留言";
                    if (!intval($card_membr["pb_status"])) {
                        $this->qy_send($card["userid"], $content);
                    }
                } else {
                    $user["addtime"] = $info["addtime"] ? $info["addtime"] : time();
                    $user["updatetime"] = time();
                    pdo_update("dbs_masclwlcard_member", $user, array("id" => $info["id"]));
                    $content = "请尽快联系客户: " . $user["nickname"] . " 电话:" . $user["phone"];
                    $subject = "客户留言";
                    if (!intval($card_membr["pb_status"])) {
                        $this->qy_send($card["userid"], $content);
                    }
                }
            }
        }
        if (empty($_SESSION["session_key"])) {
            $info["isAuthorize"] = 0;
        } else {
            $info["isAuthorize"] = 1;
        }
        $message = "返回消息";
        $errno = 0;
        $data = array();
        $data["error"] = 0;
        return $this->result($errno, $message, $info);
    }
    public function qy_send($touser, $content)
    {
        global $_W, $_GPC;
        if (!$touser) {
            return -1;
        }
        $set_qy = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_set_qy") . " WHERE uniacid =:uniacid", array(":uniacid" => $_W["uniacid"]));
        $qytoken = $this->getAccessToken($set_qy["corpid"], $set_qy["secret"]);
        $qyurl = "https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token=" . $qytoken;
        $msgdata = array();
        $msgdata["touser"] = $touser;
        $msgdata["msgtype"] = "text";
        $msgdata["agentid"] = $set_qy["agentid"];
        $msgdata["text"]["content"] = $content;
        $jsonData = json_encode($msgdata, JSON_UNESCAPED_UNICODE);
        $result = ihttp_request($qyurl, $jsonData);
    }
    public function doPageCard_poster()
    {
        global $_W, $_GPC;
        $info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
        $info["base"] = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_set") . " WHERE uniacid =:uniacid", array(":uniacid" => $_W["uniacid"]));
        $info["card_logo"] = tomedia($info["card_logo"]);
        $info["base"]["company_logo"] = tomedia($info["base"]["company_logo"]);
        $info["codepng"] = tomedia("addons/dbs_masclwlcard/sea/" . $_W["uniacid"] . "/" . $info["id"] . ".png");
        $info["codepng"] = str_replace("http://", "https://", $info["codepng"]);
        $info["card_logo"] = str_replace("http://", "https://", $info["card_logo"]);
        $info["base"]["company_logo"] = str_replace("http://", "https://", $info["base"]["company_logo"]);
        $message = "返回消息";
        $errno = 0;
        return $this->result($errno, $message, $info);
    }
    public function doPageCard()
    {
        global $_W, $_GPC;
        $userinfo = $_SESSION["userinfo"];
        $userinfo = base64_decode($_SESSION["userinfo"]);
        $userinfo = unserialize($userinfo);
        $arr = array();
        $arr_1 = array();
        $arr_2 = array();
        $info = array();
        if ($userinfo["openId"]) {
            $card_membr = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and openId=:openId", array(":uniacid" => $_W["uniacid"], ":openId" => $userinfo["openId"]));
            if (!empty($card_membr)) {
                foreach ($card_membr as $k => $v) {
                    $mo = array();
                    $mo = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid and is_sendcard=0 ", array(":uniacid" => $_W["uniacid"], ":aid" => $v["aid"]));
                    if (!empty($mo)) {
                        $arr[] = $v["aid"];
                        $arr_1[] = $v["aid"];
                    }
                }
            }
        }
        $card_mr = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and mrtype=1 and is_sendcard=0 ", array(":uniacid" => $_W["uniacid"]));
        if (!empty($card_mr)) {
            foreach ($card_mr as $k => $v) {
                $arr[] = $v["id"];
                $arr_2[] = $v["id"];
            }
        }
        if ($arr) {
            $info = pdo_getall("dbs_masclwlcard", array("id" => $arr), array(), '', array("sort DESC"));
        }
        if ($_GPC["send_card"]) {
            $find_send = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid and is_sendcard=1 ", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["send_card"]));
            if (!empty($find_send)) {
                $find_targ = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid and is_sendcard=0 ", array(":uniacid" => $_W["uniacid"], ":aid" => $find_send["is_sendcard_id"]));
                $is_send = in_array($find_targ["id"], $arr) ? 1 : 0;
                $find_targ["get_status"] = 1;
                if (!$is_send) {
                    array_push($info, $find_targ);
                }
            }
        }
        $set = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_set") . " WHERE uniacid =:uniacid ", array(":uniacid" => $_W["uniacid"]));
        if (empty($userinfo["openId"]) || empty($userinfo["nickname"])) {
            $isAuthorize = 0;
        } else {
            $isAuthorize = 1;
        }
        $message = "返回消息";
        $errno = 0;
        if (!empty($info)) {
            foreach ($info as $k => $v) {
                $info[$k]["card_logo"] = tomedia($v["card_logo"]);
                $source = array();
                $op = 0;
                $op = in_array($v["id"], $arr_1) ? 1 : 0;
                if ($v["get_status"]) {
                    $info[$k]["source_name"] = "来自" . $find_send["card_name"] . "的交接";
                } else {
                    if ($op) {
                        $membr_info = array();
                        $membr_share = array();
                        $membr_suorce = array();
                        $membr_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and  aid=:aid and openId=:openId ", array(":uniacid" => $_W["uniacid"], ":aid" => $v["id"], ":openId" => $userinfo["openId"]));
                        $membr_share = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and  id=:share_id  ", array(":uniacid" => $_W["uniacid"], ":share_id" => $membr_info["source_id"]));
                        if (!empty($membr_share)) {
                            $info[$k]["source_name"] = $membr_share["name"] ? $membr_share["name"] : $membr_share["nickname"];
                        } else {
                            if ($membr_info["send_cardid"]) {
                                $membr_suorce = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and  id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $membr_info["send_cardid"]));
                                $info[$k]["source_name"] = "来自" . $membr_suorce["card_name"] . "的交接";
                            } else {
                                $info[$k]["source_name"] = "搜索或扫描";
                            }
                        }
                    } else {
                        $info[$k]["source_name"] = "搜索或扫描";
                    }
                }
            }
            $info["info"] = $info;
            $info["isAuthorize"] = $isAuthorize;
            $info["company_logo"] = tomedia($set["company_logo"]);
            $info["company_name"] = $set["company_name"];
            $info["isAuthorize"] = $isAuthorize;
            return $this->result($errno, $message, $info);
        } else {
            $info["isAuthorize"] = $isAuthorize;
            return $this->result($errno, $message, $info);
        }
    }
    public function doPageSave_form()
    {
        global $_W, $_GPC;
        $userinfo = $_SESSION["userinfo"];
        $userinfo = base64_decode($_SESSION["userinfo"]);
        $userinfo = unserialize($userinfo);
        if ($userinfo["openId"]) {
            $user = array();
            $user["uniacid"] = $_W["uniacid"];
            $user["openId"] = $userinfo["openId"];
            $user["formId"] = $_GPC["formId"];
            $user["nickname"] = $userinfo["nickname"];
            $user["gender"] = $userinfo["gender"];
            $user["city"] = $userinfo["city"];
            $user["province"] = $userinfo["province"];
            $user["city"] = $userinfo["city"];
            $user["language"] = $userinfo["language"];
            $user["avatarUrl"] = $userinfo["avatarUrl"];
            $user["status"] = 0;
            $user["addtime"] = time();
            $result = pdo_insert("dbs_masclwlcard_formid", $user);
        }
    }
    public function doPageNews_detail()
    {
        global $_W, $_GPC;
        $info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_news") . " WHERE uniacid =:uniacid and id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["news_id"]));
        $message = "返回消息";
        $errno = 0;
        if (!empty($info)) {
            return $this->result($errno, $message, $info);
        } else {
            return $this->result($errno, $message, $info);
        }
    }
    public function doPageFriend_detail()
    {
        global $_W, $_GPC;
        $info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_friend") . " WHERE uniacid =:uniacid and id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["friend_id"]));
        $info["head_img"] = tomedia($info["head_img"]);
        $card = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
        $card["card_logo"] = tomedia($card["card_logo"]);
        $info["card"] = $card;
        $info["card_id"] = $_GPC["card_id"];
        $info["time"] = date("Y-m-d H:i:s", $info["time"]);
        if (!empty($info["all_img"])) {
            $info["all_imgarr"] = explode(",", $info["all_img"]);
        }
        $message = "返回消息";
        $errno = 0;
        if (!empty($info)) {
            return $this->result($errno, $message, $info);
        } else {
            return $this->result($errno, $message, $info);
        }
    }
    public function doPageProduct_detail()
    {
        global $_W, $_GPC;
        $info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_product") . " WHERE uniacid =:uniacid and id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["product_id"]));
        $card = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id=:aid", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"]));
        $userinfo = $_SESSION["userinfo"];
        $userinfo = base64_decode($_SESSION["userinfo"]);
        $userinfo = unserialize($userinfo);
        if ($userinfo["openId"] && $_GPC["product_id"] && $_GPC["card_id"]) {
            $myinfo = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_act_report") . " WHERE uniacid =:uniacid and openId=:openId and card_id=:card_id and act_id=:act_id and p_id=:product_id", array(":uniacid" => $_W["uniacid"], ":openId" => $userinfo["openId"], ":card_id" => $_GPC["card_id"], ":act_id" => 568, ":product_id" => $_GPC["product_id"]));
            if ($myinfo) {
                $num = $myinfo["num"] + 1;
            } else {
                $num = 1;
            }
            $user = array();
            $user["uniacid"] = $_W["uniacid"];
            $user["num"] = $num;
            $user["openId"] = $userinfo["openId"];
            $user["p_id"] = $_GPC["product_id"];
            $user["card_id"] = $_GPC["card_id"];
            $user["act_id"] = 568;
            $user["nickname"] = $userinfo["nickname"];
            $user["gender"] = $userinfo["gender"];
            $user["city"] = $userinfo["city"];
            $user["province"] = $userinfo["province"];
            $user["city"] = $userinfo["city"];
            $user["language"] = $userinfo["language"];
            $user["avatarUrl"] = $userinfo["avatarUrl"];
            $content = $info["cp_bs_name"];
            $user["act_content"] = $content;
            $card_membr = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and aid=:aid and openId=:openId", array(":uniacid" => $_W["uniacid"], ":aid" => $_GPC["card_id"], ":openId" => $userinfo["openId"]));
            if (empty($myinfo)) {
                $user["addtime"] = time();
                $result = pdo_insert("dbs_masclwlcard_act_report", $user);
                $subject = "客户行为";
                if (!intval($card_membr["pb_status"])) {
                    $this->qy_send($card["userid"], $userinfo["nickname"] . "第" . $num . "次" . "查看了你的产品:" . $content);
                }
            } else {
                $user["addtime"] = $myinfo["addtime"] ? $myinfo["addtime"] : time();
                $user["updatetime"] = time();
                pdo_update("dbs_masclwlcard_act_report", $user, array("id" => $myinfo["id"]));
                $subject = "客户行为";
                if (!intval($card_membr["pb_status"])) {
                    $this->qy_send($card["userid"], $userinfo["nickname"] . "第" . $num . "次" . "查看了你的产品:" . $content);
                }
            }
        }
        $card["card_logo"] = tomedia($card["card_logo"]);
        $info["card"] = $card;
        $info["card_id"] = $_GPC["card_id"];
        $info["cp_bs_img"] = unserialize($info["cp_bs_img"]);
        if (!empty($info["cp_bs_img"])) {
            foreach ($info["cp_bs_img"] as $key => $val) {
                $info["cp_bs_img"][$key] = tomedia($val);
            }
        }
        $info["cp_bs_content"] = unserialize($info["cp_bs_content"]);
        if (!empty($info["cp_bs_content"])) {
            foreach ($info["cp_bs_content"] as $key => $val) {
                $info["cp_bs_content"][$key] = tomedia($val);
            }
        }
        $message = "返回消息";
        $errno = 0;
        if (!empty($info)) {
            return $this->result($errno, $message, $info);
        } else {
            return $this->result($errno, $message, $info);
        }
    }
    public function doPageMycheck()
    {
        global $_W, $_GPC;
        $userinfo = $_SESSION["userinfo"];
        $userinfo = base64_decode($_SESSION["userinfo"]);
        $userinfo = unserialize($userinfo);
        if (empty($_W["openid"]) || empty($userinfo["nickname"])) {
            $isAuthorize = 0;
        } else {
            $isAuthorize = 1;
        }
        $data = array();
        $data["isAuthorize"] = $isAuthorize;
        $data["openid"] = $_W["openid"];
        $data["userinfo"] = $userinfo;
        $message = "返回消息";
        return $this->result(0, $message, $data);
    }
    public function doPageShops_detail()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageGet_moredt()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageReport()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageGet_moreshops()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageCard_detail()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageHome()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageAddress_list()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageAdd_address()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageDel_address()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageEdit_address()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageSet_address()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageDefault_address()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageShops_topay()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageShops_order_list()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageShops_get_class()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageShops_all_class()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageWithdraw_broker()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageWithdraw_bank()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function doPageWithdraw_bank_add()
    {
        $this->__wxapp(__FUNCTION__);
    }
    public function payResult($pay_result)
    {
        if ($pay_result["result"] == "success") {
            if ($pay_result["tid"]) {
                $order = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_shops_order") . " WHERE orderid ='{$pay_result["tid"]}'" . " AND paid=0");
                if (!empty($order) && $order["paid"] == "0") {
                    $updata = array();
                    $updata["paid"] = 1;
                    $updata["transaction_id"] = $pay_result["tag"]["transaction_id"];
                    pdo_update("dbs_masclwlcard_shops_order", $updata, array("orderid" => $pay_result["tid"]));
                    pdo_update("dbs_masclwlcard_shops", array("shops_num -=" => intval($order["shops_num"])), array("uniacid" => $pay_result["uniacid"], "id" => $order["shops_id"]));
                    $shops = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_shops") . " WHERE id =:shops_id ", array(":shops_id" => $order["shops_id"]));
                    if ($shops["fx_type"]) {
                        if ($shops["fx_type"] == 2) {
                            if (intval($shops["fx_price"] * 100) >= 1) {
                                $card_member = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE aid=:card_id and openId=:openId", array(":card_id" => $order["card_id"], ":openId" => $order["from_user"]));
                                if (!empty($card_member)) {
                                    if (!$card_member["hmd_status"]) {
                                        if ($card_member["source_id"]) {
                                            $s_card_member = array();
                                            $s_card_member = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE id =:card_id ", array(":card_id" => $card_member["source_id"]));
                                            if (!empty($s_card_member)) {
                                                pdo_update("dbs_masclwlcard_card_member", array("notInAccount +=" => $shops["fx_price"]), array("id" => $s_card_member["id"]));
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if ($shops["fx_type"] == 1) {
                            $fx_set = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_set_fx") . " WHERE uniacid =:uniacid ", array("uniacid" => $pay_result["uniacid"]));
                            if (!empty($fx_set)) {
                                if ($fx_set["open_fx"]) {
                                    if (intval($fx_set["fx_price"] * 100) >= 1) {
                                        $card_member = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE aid =:card_id and openId=:openId", array(":card_id" => $order["card_id"], ":openId" => $order["from_user"]));
                                        if (!empty($card_member)) {
                                            if (!$card_member["hmd_status"]) {
                                                if ($card_member["source_id"]) {
                                                    $s_card_member = array();
                                                    $s_card_member = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE id =:card_id ", array(":card_id" => $card_member["source_id"]));
                                                    if (!empty($s_card_member)) {
                                                        pdo_update("dbs_masclwlcard_card_member", array("notInAccount +=" => $fx_set["fx_price"]), array("id" => $s_card_member["id"]));
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    exit("success");
                }
            }
        }
        return true;
    }
    public function send_cash($order)
    {
        global $_W, $_GPC;
        $userinfo = $_SESSION["userinfo"];
        $userinfo = base64_decode($_SESSION["userinfo"]);
        $userinfo = unserialize($userinfo);
        if (!$userinfo["openId"]) {
            return -2;
        }
        $_W["uniacid"] = $order["uniacid"];
        $setting = uni_setting($_W["uniacid"], "payment");
        if (!is_array($setting["payment"])) {
            return 0;
        }
        $seting = $setting["payment"]["wechat"];
        $sql = "SELECT `key`,`secret` FROM " . tablename("account_wxapp") . " WHERE `uniacid`=:uniacid";
        $row = pdo_fetch($sql, array(":uniacid" => $_W["uniacid"]));
        $paysetting["mchid"] = $seting["mchid"];
        $paysetting["appid"] = $row["key"];
        $paysetting["appsecret"] = $row["secret"];
        $paysetting["shkey"] = $seting["signkey"];
        $uniacid = $_W["uniacid"];
        $base = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_set") . " WHERE uniacid =:uniacid", array(":uniacid" => $_W["uniacid"]));
        if (!$base["open_redpack"]) {
            return -1;
        }
        if (!$order["source_id"]) {
            return -3;
        }
        $source_membr = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_card_member") . " WHERE uniacid =:uniacid and aid=:aid and id=:id and hmd_status=0 ", array(":uniacid" => $_W["uniacid"], ":aid" => $order["aid"], ":id" => $order["source_id"]));
        if (empty($source_membr)) {
            return -4;
        }
        $delta = 0.001;
        $a = $base["redpack_min"];
        $b = $base["redpack_max"];
        if (abs($a - $b) < $delta) {
            $fee = $base["redpack_min"] * 100;
        } else {
            $fee = mt_rand($a * 100, $b * 100);
        }
        $pars = array();
        $pars[":uniacid"] = $_W["uniacid"];
        $pars[":openid"] = $source_membr["openId"];
        $pars[":m_id"] = $order["id"];
        $pars[":source_id"] = $source_membr["id"];
        $sql = "SELECT * FROM " . tablename("dbs_masclwlcard_cash") . " WHERE aid=:aid and source_id=:source_id and uniacid=:uniacid and m_id=:m_id and openid=:openid ";
        $ret = pdo_fetch($sql, $pars);
        if (!empty($ret) && $ret["status"] == 1) {
            return -4;
        }
        if (empty($ret)) {
            $r = array();
            $r["uniacid"] = $uniacid;
            $r["openid"] = $source_membr["openId"];
            $r["m_id"] = $order["id"];
            $r["source_id"] = $source_membr["id"];
            $r["fee"] = $fee / 100;
            list($msec, $sec) = explode(" ", microtime());
            $orderid = date("YmdHis", $sec) . substr($msec, 2, 4);
            $orderid = "niceyj" . $orderid;
            $r["mch_billno"] = $orderid;
            $r["log"] = '';
            $r["create_t"] = time();
            $r["success_t"] = 0;
            $r["status"] = 0;
            $r["ip"] = $_SERVER["REMOTE_ADDR"];
            $ret = pdo_insert("dbs_masclwlcard_cash", $r);
            if (!empty($ret)) {
                $record_id = pdo_insertid();
            } else {
                return -5;
            }
            $mch_billno = $r["mch_billno"];
        } else {
            return -6;
        }
        $uniacid = $_W["uniacid"];
        $url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers";
        $pars = array();
        $pars["mch_appid"] = $paysetting["appid"];
        $pars["mchid"] = $paysetting["mchid"];
        $pars["nonce_str"] = random(32);
        $pars["partner_trade_no"] = $mch_billno;
        $pars["openid"] = $source_membr["openId"];
        $pars["check_name"] = "NO_CHECK";
        $pars["amount"] = $fee;
        $pars["desc"] = "您邀请" . $order["nickname"] . "得到" . $r["fee"] . "元";
        $pars["spbill_create_ip"] = $_SERVER["REMOTE_ADDR"];
        ksort($pars, SORT_STRING);
        $string1 = '';
        foreach ($pars as $k => $v) {
            $string1 .= "{$k}={$v}&";
        }
        $string1 .= "key={$paysetting["shkey"]}";
        $pars["sign"] = strtoupper(md5($string1));
        $xml = array2xml($pars);
        $extras = array();
        $extras["CURLOPT_SSLCERT"] = MB_ROOT . "/cert/" . $uniacid . "/apiclient_cert.pem";
        $extras["CURLOPT_SSLKEY"] = MB_ROOT . "/cert/" . $uniacid . "/apiclient_key.pem";
        load()->func("communication");
        $procResult = null;
        $resp = ihttp_request($url, $xml, $extras);
        if (is_error($resp)) {
            $procResult = $resp;
        } else {
            $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>" . $resp["content"];
            $dom = new \DOMDocument();
            if ($dom->loadXML($xml)) {
                $xpath = new \DOMXPath($dom);
                $code = $xpath->evaluate("string(//xml/return_code)");
                $ret = $xpath->evaluate("string(//xml/result_code)");
                if (strtolower($code) == "success" && strtolower($ret) == "success") {
                    $procResult = true;
                } else {
                    $error = $xpath->evaluate("string(//xml/err_code_des)");
                    $procResult = error(-2, $error);
                }
            } else {
                $procResult = error(-1, "error response");
            }
        }
        if (is_error($procResult)) {
            $filters = array();
            $filters["uniacid"] = $uniacid;
            $filters["id"] = $record_id;
            $rec = array();
            $rec["log"] = $procResult["message"];
            pdo_update("dbs_masclwlcard_cash", $rec, $filters);
            return $procResult;
        } else {
            $filters = array();
            $filters["uniacid"] = $uniacid;
            $filters["id"] = $record_id;
            $rec = array();
            $rec["status"] = 1;
            $rec["success_t"] = time();
            pdo_update("dbs_masclwlcard_cash", $rec, $filters);
            return true;
        }
    }
    public function __wxapp($funname)
    {
        global $_W, $_GPC;
        $uniacid = $_W["uniacid"];
        load()->func("tpl");
        include_once MODULE_ROOT . "/wxapp/" . strtolower(substr($funname, 6)) . ".php";
    }
    public function getAccessToken($corpid, $secret)
    {
        global $_W, $_GPC;
        $path = IA_ROOT . "/addons/dbs_masclwlcard/alltoken/" . $_W["uniacid"] . "/" . $secret . ".php";
        load()->func("file");
        $dirpath = IA_ROOT . "/addons/dbs_masclwlcard/alltoken/" . $_W["uniacid"] . "/";
        is_dir($dirpath) or mkdir($dirpath, 0777, true);
        $data = json_decode(file_get_contents($path));
        if ($data->expire_time < time()) {
            $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=" . $corpid . "&corpsecret=" . $secret;
            $res = json_decode(file_get_contents($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $file = fopen($path, "w");
                if ($file) {
                    set_file_buffer($file, 0);
                    fwrite($file, json_encode($data));
                    fclose($file);
                }
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }
}