<?php

$id = intval($_GPC["address_id"]);
if (empty($id)) {
    $message = "返回消息";
    return $this->result(0, $message, $info);
}
$find = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_shops_address") . " WHERE uniacid =:uniacid and id=:aid", array(":aid" => $id, ":uniacid" => $uniacid));
if (intval($find["is_status"])) {
    $result = pdo_update("dbs_masclwlcard_shops_address", array("is_status" => 0), array("id" => $id, "uniacid" => $uniacid));
} else {
    pdo_update("dbs_masclwlcard_shops_address", array("is_status" => 0), array("uniacid" => $uniacid));
    $result = pdo_update("dbs_masclwlcard_shops_address", array("is_status" => 1), array("id" => $id, "uniacid" => $uniacid));
}
if ($result) {
    $info["error"] = 0;
} else {
    $info["error"] = 1;
}
$info["info"] = $find;
$info["info_is_status"] = intval($find["is_status"]);
$message = "返回消息";
return $this->result(0, $message, $info);