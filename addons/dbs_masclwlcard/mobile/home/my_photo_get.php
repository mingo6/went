<?php

$status = $this->check_qylogin();
if ($status == -1) {
    $this->dexit(array("Code" => 1, "msg" => "错误1"));
    exit;
}
if ($status == -2) {
    $this->dexit(array("Code" => 1, "msg" => "错误2"));
    exit;
}
$UserId = $_SESSION["session_dbs_masclwlcard_usderid"];
$card_info = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and UserId=:UserId", array(":uniacid" => $_W["uniacid"], ":UserId" => $UserId));
if (empty($card_info)) {
    $this->dexit(array("Code" => 1, "msg" => "错误3"));
    exit;
}
$old_photo = $card_info["photo"];
if ($old_photo) {
    $old_photo = unserialize($old_photo);
}
if (!empty($old_photo)) {
    foreach ($old_photo as $k => $v) {
        $old_photo[$k] = tomedia($v);
    }
    $photo = implode(",", $old_photo);
} else {
    $photo = '';
}
$this->dexit(array("Code" => 0, "Imgs" => $photo));
exit;