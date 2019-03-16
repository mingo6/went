<?php
defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;

$_W["page"]["title"] = "公司介绍";

$config = get_system_config("mall");


include(itemplate("member/company"));