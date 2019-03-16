<?php
if (!(defined('IN_IA')))
{
    exit('Access Denied');
}
class Pay_EweiShopV2Page extends PluginPfMobilePage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        $openid = $_W['openid'];
        load()->model('mc');
        $uid = mc_openid2uid($openid);
        if (empty($uid)) {
            mc_oauth_userinfo($openid);
        }
        $member = m('member')->getMember($openid, true);
        $uniacid = $_W['uniacid'];
        $orderid = intval($_GPC['id']);

        $order = pdo_fetch('select o.* from ' . tablename('ewei_shop_waterorder') . ' as o' . "\r\n\t\t\t\t" . 'left join ' . tablename('ewei_shop_water') . ' as g on g.id = o.water_id' . "\r\n\t\t\t\t" . 'where o.id = :id and o.uniacid = :uniacid order by o.create_time desc', array(':id' => $orderid, ':uniacid' => $uniacid));

        if (empty($order)) {
            $this->message('订单未找到！', mobileUrl('water/index'), 'error');
        }


        /*if (empty($order['gstatus']) || !(empty($order['gdeleted']))) {
            $this->message($order['title'] . '<br/> 已下架!', mobileUrl('groups/index'), 'error');
        }
        if ($order['stock'] <= 0) {
            $this->message($order['title'] . '<br/>库存不足!', mobileUrl('groups/index'), 'error');
        }*/
        if (empty($order)) {
            headers(mobileUrl('water'));
            exit();
        }
        if ($order['status'] == 2||$order['status'] == 3||$order['status'] == 5) {
            //已付款  已发货  已完成
            headers(mobileUrl('water'));
            exit();
        }
        /*$log = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_groups_paylog') . "\r\n\t\t" . ' WHERE `uniacid`=:uniacid AND `module`=:module AND `tid`=:tid limit 1', array(':uniacid' => $uniacid, ':module' => 'water', ':tid' => $order['order_sn']));
        if (!(empty($log)) && ($log['status'] != '0')) {
            headers(mobileUrl('waterorder'));
            exit();
        }
        if (empty($log)) {
            $log = array('uniacid' => $uniacid, 'openid' => $_W['openid'], 'module' => 'water', 'tid' => $order['orderno'], 'credit' => $order['credit'], 'creditmoney' => $order['creditmoney'], 'fee' => ($order['price'] - $order['creditmoney']) + $order['freight'], 'status' => 0);
            pdo_insert('ewei_shop_groups_paylog', $log);
            $plid = pdo_insertid();
        }*/
        $set = m('common')->getSysset(array('shop', 'pay'));
        $set['pay']['weixin'] = ((!(empty($set['pay']['weixin_sub'])) ? 1 : $set['pay']['weixin']));
        $set['pay']['weixin_jie'] = ((!(empty($set['pay']['weixin_jie_sub'])) ? 1 : $set['pay']['weixin_jie']));
        $sec = m('common')->getSec();
        $sec = iunserializer($sec['sec']);
        $param_title = $set['shop']['name'] . '订单';
        $credit = array('success' => false);
        if (isset($set['pay']) && ($set['pay']['credit'] == 1)) {
                $credit = array('success' => true, 'current' => $member['credit2']);
        }
        load()->model('payment');
        $setting = uni_setting($_W['uniacid'], array('payment'));
        $wechat = array('success' => false);
        if (is_weixin()) {
            $params = array();
            $params['tid'] = $order['order_sn'];
            $params['user'] = $openid;
            $params['fee'] = $order['price'];
            $params['title'] = $param_title;
            if (isset($set['pay']) && ($set['pay']['weixin'] == 1)) {
                if (is_array($setting['payment']['wechat']) && $setting['payment']['wechat']['switch']) {
                    load()->model('payment');
                    $setting = uni_setting($_W['uniacid'], array('payment'));
                    $options = array();
                    if (is_array($setting['payment'])) {
                        $options = $setting['payment']['wechat'];
                        $options['appid'] = $_W['account']['key'];
                        $options['secret'] = $_W['account']['secret'];
                    }
                    $wechat = m('common')->wechat_build($params, $options, 19);
                    if (!(is_error($wechat))) {
                        $wechat['success'] = true;
                        if (!(empty($wechat['code_url']))) {
                            $wechat['weixin_jie'] = true;
                        } else {
                            $wechat['weixin'] = true;
                        }
                    }
                }
            }
            if (isset($set['pay']) && ($set['pay']['weixin_jie'] == 1) && !($wechat['success'])) {
                $params['tid'] = $params['tid'] . '_borrow';
                $options = array();
                $options['appid'] = $sec['appid'];
                $options['mchid'] = $sec['mchid'];
                $options['apikey'] = $sec['apikey'];
                if (!(empty($set['pay']['weixin_jie_sub'])) && !(empty($sec['sub_secret_jie_sub']))) {
                    $wxuser = m('member')->wxuser($sec['sub_appid_jie_sub'], $sec['sub_secret_jie_sub']);
                    $params['openid'] = $wxuser['openid'];
                } else if (!(empty($sec['secret']))) {
                    $wxuser = m('member')->wxuser($sec['appid'], $sec['secret']);
                    $params['openid'] = $wxuser['openid'];
                }
                $wechat = m('common')->wechat_native_build($params, $options, 19);
                if (!(is_error($wechat))) {
                    $wechat['success'] = true;
                    if (!(empty($params['openid']))) {
                        $wechat['weixin'] = true;
                    } else {
                        $wechat['weixin_jie'] = true;
                    }
                }
            }
        }
        $payinfo = array('orderid' => $orderid, 'teamid' => '', 'credit' => $credit, 'wechat' => $wechat, 'money' => $order['price']);
        if (is_h5app()) {
            $payinfo = array('wechat' => (!(empty($sec['app_wechat']['merchname'])) && !(empty($set['pay']['app_wechat'])) && !(empty($sec['app_wechat']['appid'])) && !(empty($sec['app_wechat']['appsecret'])) && !(empty($sec['app_wechat']['merchid'])) && !(empty($sec['app_wechat']['apikey'])) && (0 < $order['price']) ? true : false), 'alipay' => false, 'mcname' => $sec['app_wechat']['merchname'], 'ordersn' => $order['order_sn'], 'money' => $order['price'], 'attach' => $_W['uniacid'] . ':5', 'type' => 5, 'orderid' => $orderid, 'credit' => $credit, 'teamid' => '');
        }
        include $this->template();
    }



    //执行支付 （包括余额支付和微信支付）
    public function complete()
    {
        global $_W;
        global $_GPC;
        $orderid = intval($_GPC['orderid']);
        $uniacid = $_W['uniacid'];
        $openid = $_W['openid'];
        $member = m('member')->getMember($openid, true);
        if (is_h5app() && empty($orderid))
        {
            $ordersn = $_GPC['order_sn'];
            $orderid = pdo_fetchcolumn('select id from ' . tablename('ewei_shop_waterorder') . ' where order_sn=:orderno and uniacid=:uniacid and uid=:uid limit 1', array(':orderno' => $ordersn, ':uniacid' => $uniacid, ':uid' => $member['id']));
        }
        if (empty($orderid))
        {
            if ($_W['ispost'])
            {
                show_json(0, '参数错误!');
            }
            else
            {
                $this->message('参数错误!', mobileUrl('water'));
            }
        }
        $order = pdo_fetch('select * from ' . tablename('ewei_shop_waterorder') . ' where id = :orderid and uniacid= :uniacid and uid=:uid', array(':orderid' => $orderid, ':uniacid' => $uniacid, ':uid' => $member['id']));

        if (empty($order))
        {
            if ($_W['ispost'])
            {
                show_json(0, '订单不存在!');
            }
            else
            {
                $this->message('参数错误!', mobileUrl('water'));
            }
        }
        $order_goods = pdo_fetch('select * from  ' . tablename('ewei_shop_water') . "\r\n\t\t\t\t\t" . 'where id = :id and uniacid=:uniacid ', array(':uniacid' => $_W['uniacid'], ':id' => $order['water_id']));
        if (empty($order_goods))
        {
            if ($_W['ispost'])
            {
                show_json(0, '商品不存在!');
            }
            else
            {
                $this->message('商品不存在!', mobileUrl('water'));
            }
        }
        $type = $_GPC['type'];
        if (!(in_array($type, array('wechat', 'alipay', 'credit', 'cash'))))
        {
            if ($_W['ispost'])
            {
                show_json(0, '未找到支付方式!');
            }
            else
            {
                $this->message('未找到支付方式!', mobileUrl('water'));
            }
        }
        /*$log = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_groups_paylog') . "\r\n\t\t" . ' WHERE `uniacid`=:uniacid AND `module`=:module AND `tid`=:tid limit 1', array(':uniacid' => $uniacid, ':module' => 'groups', ':tid' => $order['orderno']));
        if (empty($log))
        {
            if ($_W['ispost'])
            {
                show_json(0, '支付出错,请重试(0)!');
            }
            else
            {
                $this->message('支付出错,请重试!', mobileUrl('groups/orders'));
            }
        }*/
        if ($type == 'credit')
        {
            $order_sn = $order['order_sn'];
            $credits = m('member')->getCredit($openid, 'credit2'); //获取余额
            if (($credits < $order['price']) || ($credits < 0))
            {
                show_json($credits, '余额不足,请充值');
            }
            $fee = floatval($order['price']);
            $result = m('member')->setCredit($openid, 'credit2', -$fee, array($_W['member']['uid'], $_W['shopset']['shop']['name'] . '消费' . $fee));
            if (is_error($result))
            {
                if ($_W['ispost'])
                {
                    show_json(0, $result['message']);
                }
                else
                {
                    $this->message($result['message'], mobileUrl('water'));
                }
            }
           // $this->model->payResult($log['tid'], $type);
            pdo_update('ewei_shop_waterorder', array('pay_type' => 'credit', 'status' => 2, 'pay_time' => time()), array('id' => $orderid));
            if ($_W['ispost'])
            {
                show_json(1,array('url' => mobileUrl('waterorder')));
            }
            else
            {
                headers(mobileUrl('water', array('orderid' => $orderid)));
                exit();
            }
        }
        else if ($type == 'wechat')
        {
            if ($_W['ispost'])
            {
                show_json(1);
            }
            else
            {
                headers(mobileUrl('water'));
                exit();
            }
            /* $orderno = $order['order_sn'];
            if (!(empty($order['ordersn2'])))
            {
                $orderno .= 'GJ' . sprintf('%02d', $order['ordersn2']);
            }
            $payquery = m('finance')->isWeixinPay($orderno, $order['price'], (is_h5app() ? true : false));
            $payqueryBorrow = m('finance')->isWeixinPayBorrow($orderno, $order['price']);
            if (!(is_error($payquery)) || !(is_error($payqueryBorrow)))
            {
             //   $this->model->payResult($log['tid'], $type, (is_h5app() ? true : false));
                pdo_update('ewei_shop_waterorder', array('pay_type' => 'wechat', 'status' => 2, 'is_pay' => 1, 'pay_time' => time() ), array('id' => $orderid));
                if ($_W['ispost'])
                {
                    show_json(1);
                }
                else
                {
                    headers(mobileUrl('water'));
                    exit();
                }
            }
            else if ($_W['ispost'])
            {
                show_json(0, '支付出错,请重试(1)!');
            }
            else
            {
                $this->message('支付出错,请重试!', mobileUrl('water'));
            }
        } */
    }

}