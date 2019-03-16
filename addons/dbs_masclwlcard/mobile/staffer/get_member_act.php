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
$type = $_GPC["type"] ? $_GPC["type"] : 0;
include $this->template("get_member_act");