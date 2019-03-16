<?php

$id = intval($_GPC["address_id"]);
if (empty($id)) {
    return $this->result(0, "erorr", "erorr");
}
$result = pdo_delete("dbs_masclwlcard_shops_address", array("id" => $id, "uniacid" => $uniacid));
if ($result) {
    $info["error"] = 0;
} else {
    $info["error"] = 1;
}
$message = "返回消息";
return $this->result(0, $message, $info);