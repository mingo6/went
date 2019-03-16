<?php
defined("IN_IA") or exit( "Access Denied" );

class AllgroupgoodsOrder{
    const TYPE_ALONE = 1;   //单独购买
    const TYPE_GROUP = 2;   //拼团购买

    const IS_SHELVES = 1;   //已上架
    const NOT_SHELVES = 2;  //已下架

    const IS_PAY = 1;   //已支付
    const NOT_PAY = 0;  //未支付

    const STATUS_CANCEL = -1;   //订单已取消
    const STATUS_WAIT_PAY = 0;   //订单待支付
    const STATUS_WAIT_DELIVER = 1;   //订单待发货
    const STATUS_WAIT_RECEIV = 2;   //订单待收货
    const STATUS_CONFIRM = 3;   //订单已确认收货
    const STATUS_COMMENT = 4;   //订单已评价

    const PAY_TYPE_ALIPAY = 1;  //阿里云支付
    const PAY_TYPE_WECHAT = 2;  //微信支付
    const PAY_TYPE_MONEY = 3;   //余额支付
    /**
     * 拼团订单支付成功
     *
     * @param [type] $id
     * @return void
     */
    public function orderPaySuccess($id, $payType = 2, $param = array())
    {
        if($id <= 0){
            return error('-1', 'id不能为空');
        }
        $groupOrderInfo = pdo_get('tiny_wmall_allgroupgoods_order', array('id' => $id));
        if(empty($groupOrderInfo)){
            return error('-1', '拼团订单不存在！');
        }
        if($groupOrderInfo['is_pay'] == self::IS_PAY){
            return error('-1', '已支付');
        }
        $goodsInfo =  pdo_get('tiny_wmall_allgroupgoods_goods', array('id' => $groupOrderInfo['goods_id']));
        $updateData = array('is_pay' => self::IS_PAY, 'pay_type' => $payType , 'status' => self::STATUS_WAIT_DELIVER, 'pay_time' => TIMESTAMP);
        $goodsUpdate = array();
        if($groupOrderInfo['group_id'] > 0){
            $groupInfo = pdo_get('tiny_wmall_allgroupgoods_group', array('id' => $groupOrderInfo['group_id'], 'uniacid' => $groupOrderInfo['uniacid']));
            if(!empty($groupInfo)){
                if($groupInfo['state'] == 0 || $groupInfo['state'] == 1){
                    if($groupInfo['state'] == 0){
                        // $groupUpdate = array('kt_time' => TIMESTAMP);
                        if(!empty($goodsInfo)){
                            $goodsUpdate['ycd_num'] = ++$goodsInfo['ycd_num'];
                        }
                    }
                    $groupUpdate['state'] = 1;
                    $groupUpdate['yg_num'] = $groupInfo['yg_num']+$groupOrderInfo['goods_num'];
                    if ($groupUpdate['yg_num']>=$goodsInfo['people']) $groupUpdate['state']=2;
                    pdo_update('tiny_wmall_allgroupgoods_group', $groupUpdate, array('id' => $groupInfo['id']));
                }
            }
        }
        //更新商品数据
        if(!empty($goodsInfo)){
            $goodsUpdate['ysc_num'] = $goodsInfo['ysc_num'] + $groupOrderInfo['goods_num'];
            $goodsUpdate['inventory'] = max(0, $goodsInfo['inventory'] - $groupOrderInfo['goods_num']);
            pdo_update('tiny_wmall_allgroupgoods_goods', $goodsUpdate, array('id' => $groupOrderInfo['goods_id']));
        }
        if(!pdo_update('tiny_wmall_allgroupgoods_order', $updateData, array('id' => $groupOrderInfo['id']))){
            return error(-1, '拼团订单状态修改失败!');
        }
        return error(0, '成功');
    }

    /*
     * 拼团失败自动退款
     *
     * @param $active_id 拼团订单id
     * @return $extra 订单日志
     */
    public function orderFail($active_id)
    {
        $group = $this->getGroupInfo($active_id);
        if ($group['state']==1 && $group['end_time']<=time()){
            //拼团失败
            pdo_update("tiny_wmall_allgroupgoods_group",array('state'=>3),array('id'=>$group['group_id']));
            $extra = array(
                'note' => "拼团失败,系统已自动取消订单",
                'reason' => 'others',
                'remark' => "拼团失败,系统已自动取消订单"
            );
            return $extra;
        }
        else{
            return false;
        }
    }

    /*
     * 获取当前订单拼团信息
     *
     * @param $active_id 拼团订单id
     * @return $group_info 拼团订单
     */
    public function getGroupInfo($active_id)
    {
        $condition = "where o.id = :oid";
        $param = array(":oid"=>$active_id);
        $sql = "select o.id,o.group_id,g.state,g.dq_time,g.goods_id,g.goods_name from " .tablename('tiny_wmall_allgroupgoods_order')." as o left join ".tablename('tiny_wmall_allgroupgoods_group')." as g on o.`group_id` = g.`id` " . $condition;
        $group_info = pdo_fetch($sql,$param);
        $group_info['end_time'] = pdo_get("tiny_wmall_allgroupgoods_goods",array("id"=>$group_info['goods_id']),array("end_time"))['end_time'];
        if (empty($group_info)){
            return false;
        }else{
            return $group_info;
        }
    }
}
