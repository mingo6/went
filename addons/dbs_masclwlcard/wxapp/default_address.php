<?php

$find = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_shops_address") . " WHERE uniacid =:uniacid and is_status=1", array(":uniacid" => $uniacid));
if ($find) {
    $info["error"] = 0;
} else {
    $info["error"] = 1;
}
$info["info"] = $find;
$message = "返回消息";
return $this->result(0, $message, $info);