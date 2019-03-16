<?php

$id = intval($_GPC["address_id"]);
if (empty($id)) {
    $message = "返回消息";
    return $this->result(0, $message, $info);
}
$data = array();
$data["userName"] = $_GPC["userName"];
$data["telNumber"] = $_GPC["telNumber"];
$data["provinceName"] = $_GPC["provinceName"];
$data["cityName"] = $_GPC["cityName"];
$data["countyName"] = $_GPC["countyName"];
$data["detailInfo"] = $_GPC["detailInfo"];
$result = pdo_update("dbs_masclwlcard_shops_address", $data, array("id" => $id, "uniacid" => $uniacid));
if ($result) {
    $info["error"] = 0;
} else {
    $info["error"] = 1;
}
$info["info"] = $find;
$info["info_is_status"] = intval($find["is_status"]);
$message = "返回消息";
return $this->result(0, $message, $info);