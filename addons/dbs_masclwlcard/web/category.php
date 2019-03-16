<?php

$options = array("display", "edit", "delete");
$op = in_array($_GPC["op"], $options) ? $_GPC["op"] : "display";
if ($op == "display") {
    if (!empty($_GPC["sort"])) {
        foreach ($_GPC["sort"] as $id => $sort) {
            pdo_update("dbs_masclwlcard_shops_category", array("sort" => $sort), array("id" => $id));
        }
        message("分类排序更新成功！", $this->createWebUrl("category", array("op" => "display")), "success");
    }
    $children = array();
    $category = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops_category") . " WHERE uniacid = '{$_W["uniacid"]}' ORDER BY parentid ASC, sort DESC");
    foreach ($category as $index => $row) {
        if (!empty($row["parentid"])) {
            $children[$row["parentid"]][] = $row;
            unset($category[$index]);
        }
    }
    include $this->template("shops_category");
}
if ($op == "edit") {
    $parentid = intval($_GPC["parentid"]);
    $id = intval($_GPC["id"]);
    if (!empty($id)) {
        $category = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_shops_category") . " WHERE id = '{$id}'");
    } else {
        $category = array("sort" => 0);
    }
    if (!empty($parentid)) {
        $parent = pdo_fetch("SELECT id, title FROM " . tablename("dbs_masclwlcard_shops_category") . " WHERE id =:parentid and uniacid =:uniacid", array(":parentid" => $parentid, ":uniacid" => $_W["uniacid"]));
        if (empty($parent)) {
            message("抱歉，上级分类不存在或是已经被删除！", $this->createWebUrl("category"), "error");
        }
    }
    if (checksubmit("submit")) {
        if (empty($_GPC["title"])) {
            message("抱歉，请输入分类名称！");
        }
        $data = array("uniacid" => $_W["uniacid"], "title" => $_GPC["title"], "enabled" => intval($_GPC["enabled"]), "sort" => intval($_GPC["sort"]), "num" => intval($_GPC["num"]), "parentid" => intval($parentid), "thumb" => $_GPC["thumb"]);
        if (!empty($id)) {
            pdo_update("dbs_masclwlcard_shops_category", $data, array("id" => $id));
        } else {
            pdo_insert("dbs_masclwlcard_shops_category", $data);
            $id = pdo_insertid();
        }
        message("更新分类成功！", $this->createWebUrl("category", array("op" => "display")), "success");
    }
    include $this->template("shops_category");
}
if ($op == "delete") {
    $id = intval($_GPC["id"]);
    $category = pdo_fetch("SELECT id, parentid FROM " . tablename("dbs_masclwlcard_shops_category") . " WHERE id = '{$id}'");
    if (empty($category)) {
        message("抱歉，分类不存在或是已经被删除！", $this->createWebUrl("category", array("op" => "display")), "error");
    }
    pdo_delete("dbs_masclwlcard_shops_category", array("id" => $id, "parentid" => $id), "OR");
    message("分类删除成功！", $this->createWebUrl("category", array("op" => "display")), "success");
}