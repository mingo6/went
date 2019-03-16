<?php

$options = array("display", "edit", "delete");
$op = in_array($_GPC["op"], $options) ? $_GPC["op"] : "display";
if ($op == "display") {
    if (!empty($_GPC["sort"])) {
        foreach ($_GPC["sort"] as $id => $sort) {
            pdo_update("dbs_masclwlcard_shops", array("sort" => $sort), array("id" => $id));
        }
        message("商品排序更新成功！", $this->createWebUrl("shops", array("op" => "display")), "success");
    }
    $category = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops_category") . " WHERE uniacid = :uniacid and enabled=1 ORDER BY sort DESC", array(":uniacid" => $_W["uniacid"]));
    $spec = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops_spec") . " WHERE uniacid = :uniacid and enabled=1 ORDER BY sort DESC", array(":uniacid" => $_W["uniacid"]));
    $pindex = max(1, intval($_GPC["page"]));
    $psize = 10;
    $condition = " uniacid = :uniacid";
    if (!empty($_GPC["typeid"])) {
        $condition .= " AND typeid = '{$_GPC["typeid"]}'";
    }
    if (!empty($_GPC["keyword"])) {
        $condition .= " AND title LIKE '%{$_GPC["keyword"]}%'";
    }
    $shops = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops") . " WHERE {$condition} ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . "," . $psize, array(":uniacid" => $_W["uniacid"]));
    $total = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_shops") . "WHERE {$condition} ", array(":uniacid" => $_W["uniacid"]));
    $pager = pagination($total, $pindex, $psize);
    foreach ($shops as $key => $value) {
        $shops[$key]["category"] = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_shops_category") . " WHERE uniacid =:uniacid and id =:typeid", array(":uniacid" => $_W["uniacid"], ":typeid" => $value["typeid"]));
        $shops[$key]["spec"] = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_shops_spec") . " WHERE uniacid =:uniacid and id =:specid", array(":uniacid" => $_W["uniacid"], ":specid" => $value["specid"]));
    }
    include $this->template("shops");
}
if ($op == "edit") {
    $id = intval($_GPC["id"]);
    $category = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops_category") . " WHERE uniacid = :uniacid and enabled=1 ORDER BY sort DESC", array(":uniacid" => $_W["uniacid"]));
    $spec = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops_spec") . " WHERE uniacid = :uniacid and enabled=1 ORDER BY sort DESC", array(":uniacid" => $_W["uniacid"]));
    if (!empty($id)) {
        $sql = "SELECT * FROM " . tablename("dbs_masclwlcard_shops") . " WHERE id=:id ";
        $paramse = array(":id" => $id);
        $goods = pdo_fetch($sql, $paramse);
        if (empty($goods)) {
            message("未找到指定的商品.", $this->createWebUrl("shops"));
        }
        $top_pic = unserialize($goods["top_pic"]);
        $cp_bs_img = unserialize($goods["cp_bs_img"]);
    }
    if (checksubmit()) {
        $data = array();
        $data = $_GPC["goods"];
        empty($data["shop_name"]) && message("请填写商品名称");
        empty($data["shops_num"]) && message("请填写商品库存");
        empty($data["price"]) && message("请填写商品价格");
        $data["top_pic"] = serialize($_GPC["top_pic"]);
        $data["cp_bs_img"] = serialize($_GPC["cp_bs_img"]);
        $data["addtime"] = time();
        if (empty($goods)) {
            $data["uniacid"] = $uniacid;
            $ret = pdo_insert("dbs_masclwlcard_shops", $data);
            if (!empty($ret)) {
                $id = pdo_insertid();
            }
        } else {
            $ret = pdo_update("dbs_masclwlcard_shops", $data, array("id" => $id));
        }
        message("商品信息保存成功", $this->createWebUrl("shops"), "success");
    }
    include $this->template("shops_add");
}
if ($op == "delete") {
    $id = intval($_GPC["id"]);
    if (empty($id)) {
        message("未找到指定商品");
    }
    $result = pdo_delete("dbs_masclwlcard_shops", array("id" => $id, "uniacid" => $uniacid));
    if (intval($result) == 1) {
        message("删除商品成功.", $this->createWebUrl("shops"), "success");
    } else {
        message("删除商品失败.");
    }
}