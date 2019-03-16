<?php

$options = array("display", "edit", "delete");
$op = in_array($_GPC["op"], $options) ? $_GPC["op"] : "display";
if ($op == "display") {
    if (!empty($_GPC["sort"])) {
        foreach ($_GPC["sort"] as $id => $sort) {
            pdo_update("dbs_masclwlcard_shops_spec", array("sort" => $sort), array("id" => $id));
        }
        message("排序更新成功！", $this->createWebUrl("spec_goods", array("op" => "display")), "success");
    }
    $pindex = max(1, intval($_GPC["page"]));
    $psize = 10;
    $condition = " uniacid = :uniacid";
    $spec = pdo_fetchall("SELECT * FROM " . tablename("dbs_masclwlcard_shops_spec") . " WHERE {$condition} ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . "," . $psize, array(":uniacid" => $_W["uniacid"]));
    $total = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("dbs_masclwlcard_shops_spec") . "WHERE {$condition} ", array(":uniacid" => $_W["uniacid"]));
    $pager = pagination($total, $pindex, $psize);
    include $this->template("spec_goods");
}
if ($op == "edit") {
    $str = str_replace(PHP_EOL, '', $str);
    $id = intval($_GPC["id"]);
    if (!empty($id)) {
        $spec_goods = pdo_fetch("SELECT * FROM " . tablename("dbs_masclwlcard_shops_spec") . " WHERE id = '{$id}'");
        $content = unserialize($spec_goods["spec_content"]);
        $spec_goods["spec_content"] = '';
        if (!empty($content)) {
            foreach ($content as $key => $val) {
                if ($val) {
                    $spec_goods["spec_content"] = $spec_goods["spec_content"] . $val . PHP_EOL;
                }
            }
        }
    } else {
        $spec_goods = array("sort" => 0);
    }
    if (checksubmit()) {
        $spec_content = array();
        if ($_GPC["spec_content"]) {
            $content = explode(PHP_EOL, $_GPC["spec_content"]);
            if (!empty($content)) {
                foreach ($content as $key => $val) {
                    if ($val) {
                        $spec_content[] = $val;
                    }
                }
            }
        }
        $data = array("uniacid" => $_W["uniacid"], "title" => $_GPC["title"], "spec_content" => serialize($spec_content), "enabled" => intval($_GPC["enabled"]), "sort" => intval($_GPC["sort"]));
        if (empty($id)) {
            $data["uniacid"] = $uniacid;
            $ret = pdo_insert("dbs_masclwlcard_shops_spec", $data);
            if (!empty($ret)) {
                $id = pdo_insertid();
            }
        } else {
            $ret = pdo_update("dbs_masclwlcard_shops_spec", $data, array("id" => $id));
        }
        message("信息保存成功", $this->createWebUrl("spec_goods"), "success");
    }
    include $this->template("spec_goods");
}
if ($op == "delete") {
    $id = intval($_GPC["id"]);
    if (empty($id)) {
        message("未找到指定属性");
    }
    $result = pdo_delete("dbs_masclwlcard_shops_spec", array("id" => $id, "uniacid" => $_W["uniacid"]));
    if (intval($result) == 1) {
        message("删除成功.", $this->createWebUrl("spec_goods"), "success");
    } else {
        message("删除失败.");
    }
}