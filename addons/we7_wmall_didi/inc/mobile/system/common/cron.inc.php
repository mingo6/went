<?php 
defined("IN_IA") or exit( "Access Denied" );
mload()->model("cron");
global $_W;
global $_GPC;
if( $_W["isajax"] ) 
{
    set_time_limit(0);
    cron_order();
    cron_delivery_order();
    exit( "success" );
}
?>