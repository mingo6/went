<?php 
defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
$key = "we7_wmall_deliveryer_session_" . $_W["uniacid"];
isetcookie($key, "", -100);
if( $_W["ispost"] ) 
{
    imessage(error(0, "退出成功"), imurl("delivery/auth/login"), "ajax");
}

header("location:" . imurl("delivery/auth/login"));
exit();
?>