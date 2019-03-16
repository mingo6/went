<?php 
defined("IN_IA") or exit( "Access Denied" );

class AllgroupgoodsGoods{
    /**
     * 检测拼团商品是否过期
     */
    public function checkGoodsPasd($startTime, $endTime)
    {
        $currTime = time();
        if($currTime < $startTime){    //未开始
            return error(1, '拼团未开始！');
        }elseif($currTime >= $endTime){ //已结束
            return error(1, '拼团已结束！');
        }else{
            return error(0, 'OK');
        }
    }

    /**
     * 获取拼团商品详情
     *
     * @param [type] $id
     * @return void
     */
    public function goodsFetch($id, $field = array())
    {
        global $_W;
        $goods = pdo_get('tiny_wmall_allgroupgoods_goods',array('id'=>$id, 'uniacid' => $_W['uniacid']), $field);
        if(empty($goods)){
            return error(1, '商品不存在！');
        }
        $goodsMod = new AllgroupgoodsGoods();
        $state = $this->checkGoodsPasd($goods['start_time'], $goods['end_time']);
        if(is_error($state)){
            return $state;
        }
        return $goods;
    }
}
