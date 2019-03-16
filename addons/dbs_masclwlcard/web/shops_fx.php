<?php

if (checksubmit("submit")) {
    $data = array();
    $data = array("uniacid" => $_W["uniacid"], "open_fx" => $_GPC["open_fx"], "fx_price" => $_GPC["fx_price"]);
    $info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_set_fx") . " WHERE uniacid ='{$_W["uniacid"]}'");
    if (empty($info["id"])) {
        $result = pdo_insert("dbs_masclwlcard_set_fx", $data);
        if (!empty($result)) {
            message("操作成功！", $this->createWebUrl("shops_fx"), "success");
        } else {
            message("操作失败！", $this->createWebUrl("shops_fx"), "error");
        }
    } else {
        pdo_update("dbs_masclwlcard_set_fx", $data, array("id" => $info["id"]));
    }
    message("操作成功！", $this->createWebUrl("shops_fx"), "success");
}
$info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_set_fx") . " WHERE uniacid ='{$_W["uniacid"]}'");
include $this->template("shops_fx");