<?php 
defined("IN_IA") or exit( "Access Denied" );
include(IA_ROOT . "/addons/we7_wmall/version.php");
include("defines.php");
include("model.php");

/**
 * 微擎外送模块
 *
 * @author 微擎团队&灯火阑珊
 * @url http://bbs.we7.cc/
 */

class We7_wmallModule extends WeModule
{
    public function welcomeDisplay()
    {
        header("location: " . iurl("dashboard/index"));
        exit();
    }

}
?>