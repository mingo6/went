<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Aftersale_EweiShopV2Page extends MobileLoginPage 
{
	public function main()
	{
        global $_W,$_GPC;
        $aftersale = m('aftersale');
        $applystatus = $aftersale->getAllStatus();
        $allCount = pdo_fetchcolumn('SELECT count(id) FROM '.tablename('ewei_shop_apply_after_sale').' WHERE uniacid=:uniacid AND openid=:openid', array(':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']));
        $waitCount = pdo_fetchcolumn('SELECT count(id) FROM '.tablename('ewei_shop_apply_after_sale').' WHERE uniacid=:uniacid AND openid=:openid AND status = :status', array(':uniacid' => $_W['uniacid'], ':openid' => $_W['openid'], ':status' => $aftersale::STATUS_WAIT));
        $maintenanceCount = pdo_fetchcolumn('SELECT count(id) FROM '.tablename('ewei_shop_apply_after_sale').' WHERE uniacid=:uniacid AND openid=:openid AND status = :status', array(':uniacid' => $_W['uniacid'], ':openid' => $_W['openid'], ':status' => $aftersale::STATUS_MAINTENANCE));
        $deliverGoodsCount = pdo_fetchcolumn('SELECT count(id) FROM '.tablename('ewei_shop_apply_after_sale').' WHERE uniacid=:uniacid AND openid=:openid AND status = :status', array(':uniacid' => $_W['uniacid'], ':openid' => $_W['openid'], ':status' => $aftersale::STATUS_DELIVER_GOODS));
        $completedCount = pdo_fetchcolumn('SELECT count(id) FROM '.tablename('ewei_shop_apply_after_sale').' WHERE uniacid=:uniacid AND openid=:openid AND status = :status', array(':uniacid' => $_W['uniacid'], ':openid' => $_W['openid'], ':status' => $aftersale::STATUS_COMPLETED));
        include $this->template();
    }

    /**
     * 订单详情
     */
    public function detail()
    {
        global $_W,$_GPC;
        $aftersale = m('aftersale');
        $id = $_GPC['id'];
        if($id <= 0){
            $this->message('id不能为空！','','error');
        }
        $aftersaleinfo = pdo_fetch('SELECT * FROM '.tablename('ewei_shop_apply_after_sale').' WHERE id = :id AND uniacid = :uniacid AND openid = :openid', array(':id' => $id, ':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']));
        if(empty($aftersaleinfo)){
            $this->message('售后申请不存在！','','error');
        }
        if(!empty($aftersaleinfo['image'])){
            $aftersaleinfo['image'] = explode(',', $aftersaleinfo['image']);
        }
        $applystatus = $aftersale->getAllStatus();
        include $this->template();
    }

    /**
     * 申请售后页面
     */
    public function apply()
    {
        global $_W,$_GPC;
        if($_W['ispost'])
        {
            $data = array();
            $id = intval($_GPC['id']);
            $data['goods_name'] = $_GPC['goods_name'];
            $data['goods_model'] = $_GPC['goods_model'];
            $data['name'] = $_GPC['name'];
            $data['mobile'] = $_GPC['mobile'];
            $data['express_name'] = $_GPC['express_name'];
            $data['express_numbers'] = $_GPC['express_numbers'];
            $data['remark'] = $_GPC['remark'];
            $data['image'] = $_GPC['image'];
            empty($data['goods_name']) && show_json(0,'商品名称不能为空');
            empty($data['goods_model']) && show_json(0,'商品型号不能为空');
            empty($data['name']) && show_json(0,'联系人名称不能为空');
            empty($data['mobile']) && show_json(0,'联系人手机号码不能为空');
            empty($data['express_name']) && show_json(0,'快递名称不能为空');
            empty($data['express_numbers']) && show_json(0,'快递单号不能为空');
            $aftersale = m('aftersale');
            if($id <= 0)
            {
                $data['uniacid'] = $_W['uniacid'];
                $data['openid'] = $_W['openid'];
                $data['create_time'] = time();
                $data['status'] = $aftersale::STATUS_WAIT;
                if(!pdo_insert('ewei_shop_apply_after_sale',$data)){
                    show_json(0,'网络错误！');
                }
            }
            else
            {
                $aftersaleinfo = pdo_fetch('SELECT id,`status` FROM '.tablename('ewei_shop_apply_after_sale').' WHERE id = :id AND uniacid = :uniacid AND openid = :openid', array(':id' => $id, ':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']));
                if(empty($aftersaleinfo)){
                    show_json(0,'售后申请不存在！');
                }
                if($aftersaleinfo['status'] != $aftersale::STATUS_WAIT){
                    show_json(0,'已经审核过了,不能修改！');                    
                }
                if(!pdo_update('ewei_shop_apply_after_sale', $data, array('id' => $id))){
                    show_json(0,'网络错误！');
                }
            }
            show_json(1,'申请成功');
        }
        else
        {
            $aftersale = m('aftersale');
            $applystatus = $aftersale->getAllStatus();
            include $this->template();
        }
    }

    /**
     * 获取售后订单列表
     */
    public function get_list()
    {
        global $_W,$_GPC;
		$pindex = max(1, intval($_GPC['page']));
        $psize = 50;
        $status = $_GPC['status'];

        $condition = ' and openid=:openid and uniacid=:uniacid ';
        $params = array(':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']);
        
        if($status >0 || $status === 0 || $status === '0'){
            $condition .= ' and status=:status';
            $params[':status'] = $status;
        }

        $list = array();
        $total = pdo_fetchcolumn('SELECT count(a.id) FROM '.tablename('ewei_shop_apply_after_sale').' AS a WHERE 1'.$condition, $params);
        if($total > 0)
        {
            $aftersale = m('aftersale');
            $applystatus = $aftersale->getAllStatus();
            $list = pdo_fetchall('SELECT * FROM '.tablename('ewei_shop_apply_after_sale').' AS a WHERE 1'.$condition, $params);
            foreach($list AS $key=>&$value){
                $value['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
                foreach($applystatus AS $status)
                {
                    if($status['id'] == $value['status'])
                    {
                        $value['statusstr'] = $status['name'];
                        break;   
                    }
                }
            }
        }

        show_json(1, array('list' => $list, 'pagesize' => $psize, 'total' => $total));
    }

    /**
     * 删除售后申请
     */
    public function del()
    {
        global $_W,$_GPC;
        $aftersale = m('aftersale');
        $id = $_GPC['id'];
        if($id <= 0){
            show_json(0,'id不能为空！');
        }
        $aftersaleinfo = pdo_fetch('SELECT id,`status` FROM '.tablename('ewei_shop_apply_after_sale').' WHERE id = :id AND uniacid = :uniacid AND openid = :openid', array(':id' => $id, ':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']));
        if(empty($aftersaleinfo)){
            show_json(0,'售后申请不存在！');
        }
        if($aftersaleinfo['status'] == $aftersale::STATUS_DELIVER_GOODS || $aftersaleinfo['status'] == $aftersale::STATUS_MAINTENANCE){
            show_json(0,'审核中,不能删除！');
        }
        if(!pdo_delete('ewei_shop_apply_after_sale', array('id' => $id))){
            show_json(0,'网络错误！');            
        }
        show_json(1,'删除成功！');
    }

    /**
     * 取消售后申请
     */
    public function cancel()
    {
        global $_W,$_GPC;
        $aftersale = m('aftersale');
        $id = $_GPC['id'];
        if($id <= 0){
            show_json(0,'id不能为空！');
        }
        $aftersaleinfo = pdo_fetch('SELECT id,`status` FROM '.tablename('ewei_shop_apply_after_sale').' WHERE id = :id AND uniacid = :uniacid AND openid = :openid', array(':id' => $id, ':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']));
        if(empty($aftersaleinfo)){
            show_json(0,'售后申请不存在！');
        }
        if($aftersaleinfo['status'] == $aftersale::STATUS_DELIVER_GOODS || $aftersaleinfo['status'] == $aftersale::STATUS_MAINTENANCE){
            show_json(0,'审核中,不能取消！');
        }
        if(!pdo_update('ewei_shop_apply_after_sale', array('status' => $aftersale::STATUS_CANCEL), array('id' => $id))){
            show_json(0,'网络错误！');            
        }
        show_json(1,'取消成功！');
    }
    
    /**
     * 确认收货
     */
    public function confirm()
    {
        global $_W,$_GPC;
        $aftersale = m('aftersale');
        $id = $_GPC['id'];
        if($id <= 0){
            show_json(0,'id不能为空！');
        }
        $aftersaleinfo = pdo_fetch('SELECT id,`status` FROM '.tablename('ewei_shop_apply_after_sale').' WHERE id = :id AND uniacid = :uniacid AND openid = :openid', array(':id' => $id, ':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']));
        if(empty($aftersaleinfo)){
            show_json(0,'售后申请不存在！');
        }
        if($aftersaleinfo['status'] != $aftersale::STATUS_DELIVER_GOODS){
            show_json(0,'您还不能收货！');
        }
        if(!pdo_update('ewei_shop_apply_after_sale', array('status' => $aftersale::STATUS_COMPLETED), array('id' => $id))){
            show_json(0,'网络错误！');            
        }
        show_json(1,'收货成功！');
    }
}