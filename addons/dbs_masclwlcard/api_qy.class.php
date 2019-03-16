<?php

class api_qy
{
    public function webOauth($info, $codeUrl, $qytoken)
    {
        if (empty($_GET["code"]) && empty($_GET["state"])) {
            header("Location: " . $codeUrl);
            exit;
        } else {
            $code = $_GET["code"];
            if (!empty($code)) {
                $geturl = "https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=" . $qytoken . "&code=" . $code;
                $res = json_decode(file_get_contents($geturl), true);
                $UserId = $res["UserId"];
                if (!$UserId) {
                    echo "请在企业微信打开";
                    exit;
                } else {
                    return $UserId;
                }
            }
        }
    }
}