<?php

$op = !empty($_GPC["op"]) ? $_GPC["op"] : "display";
if ($op == "display") {
    $pindex = max(1, intval($_GPC["page"]));
    $psize = 10;
    $condition = " uniacid = :uniacid";
    if (!empty($_GPC["keyword"])) {
        $condition .= " AND orderid LIKE '%{$_GPC["keyword"]}%'";
    }
    if (!empty($_GPC["info_member"])) {
        $condition .= " AND (name LIKE '%{$_GPC["info_member"]}%' or phone LIKE '%{$_GPC["info_member"]}%')";
    }
    $list = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops_order") . " WHERE {$condition}  AND paid=1 ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . "," . $psize, array(":uniacid" => $_W["uniacid"]));
    $total = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_shops_order") . "WHERE {$condition} AND paid=1 ", array(":uniacid" => $_W["uniacid"]));
    $pager = pagination($total, $pindex, $psize);
    foreach ($list as $key => $value) {
    }
    include $this->template("order_list");
}
if ($op == "detail") {
    $id = intval($_GPC["id"]);
    if (empty($id)) {
        message("未找到指定商品");
    }
    $condition = " uniacid = :uniacid";
    $item = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_shops_order") . " WHERE {$condition} and id=:id", array(":uniacid" => $_W["uniacid"], ":id" => $id));
    if ($item["shops_id"]) {
        $item["shops"] = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_shops") . " WHERE {$condition} and id=:id", array(":uniacid" => $_W["uniacid"], ":id" => $item["shops_id"]));
        $item["card"] = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard") . " WHERE uniacid =:uniacid and id =:id", array(":uniacid" => $_W["uniacid"], ":id" => $item["card_id"]));
    }
    include $this->template("order_list");
}
if ($op == "delete") {
    $id = intval($_GPC["id"]);
    if (empty($id)) {
        message("未找到指定订单");
    }
    $result = pdo_delete("dbs_masclwlcard_shops_order", array("id" => $id, "uniacid" => $uniacid));
    if (intval($result) == 1) {
        message("删除订单成功.", $this->createWebUrl("order_list"), "success");
    } else {
        message("删除订单失败.");
    }
}