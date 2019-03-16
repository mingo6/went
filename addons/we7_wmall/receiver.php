<?php 
defined("IN_IA") or exit( "Access Denied" );
include(IA_ROOT . "/addons/we7_wmall/version.php");
include("defines.php");
include("model.php");

/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */

class We7_wmallModuleReceiver extends WeModuleReceiver
{
    public function receive()
    {
        global $_W;
    }

}
?>