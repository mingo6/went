<?php 
defined("IN_IA") or exit( "Access Denied" );

class AllgroupgoodsGoodsMod{
    /**
     * 检测拼团商品是否过期
     */
    public function checkGoodsPasd($startTime, $endTime)
    {
        $currTime = time();
        if($currTime < $startTime){    //未开始
            return 1;
        }elseif($currTime >= $endTime){ //已开始
            return 2;
        }else{
            return true;
        }
    }
}
