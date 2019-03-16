<?php
defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
icheckauth();
$_W["page"]["title"] = "发票入口";
$ta = (trim($_GPC["ta"]) ? trim($_GPC["ta"]) : "list");
if ($ta == "list") {
    include(itemplate("member/entrance_invoice"));
}