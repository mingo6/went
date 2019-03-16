<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Pay_EweiShopV2Page extends MobileMiniappPage
{
    private $ordersn_ext = '_miniapp';
    public function __construct()
    {
        if (is_h5app()) 
		{
			show_json(1, '不能h5支付!');
        }
        if(!$this->getPayInfo())
        {
            show_json(1, '支付参数配置不正确');
        }
        
    }

	public function main() 
	{
		global $_W;
        global $_GPC;
        $session3rd = $_GPC['session3rd'];
        $order_id = intval($_GPC['order_id']);
        if(empty($session3rd)){
            show_json(9999, '未登录！');
        }
        $userinfo = cache_read($session3rd);
        if(empty($userinfo)){
            show_json(9999, '未登录！');
        }
        if($order_id <= 0){
            show_json(9999, '订单id不正确！');
        }
        $sql = 'SELECT id,ordersn,ordersn2,agentid,price FROM '.tablename('ewei_shop_order').' WHERE id=:id AND status = 0';
        $orderInfo = pdo_fetch($sql,array(':id'=>$order_id));
        if(empty($orderInfo)){
            show_json(9999, '订单id不正确！');
        }
        $ispeerpay = m('order')->checkpeerpay($orderInfo['id']);
        $ext = $this->ordersn_ext;

        //微信支付
        $set = m('common')->getSysset(array('shop', 'pay'));
		$set['pay']['weixin'] = ((!(empty($set['pay']['weixin_sub'])) ? 1 : $set['pay']['weixin']));
        $set['pay']['weixin_jie'] = ((!(empty($set['pay']['weixin_jie_sub'])) ? 1 : $set['pay']['weixin_jie']));
        if (empty($set['pay']['weixin']) && empty($set['pay']['weixin_jie'])) 
        {
            show_json(1, '未开启微信支付!');
        }

		$param_title = $set['shop']['name'] . '订单';
		$credit = array('success' => false);
		if (isset($set['pay']) && ($set['pay']['credit'] == 1)) 
		{
			$credit = array('success' => true, 'current' => $member['credit2']);
		}
		$orderInfo['price'] = floatval($orderInfo['price']);
		if (empty($orderInfo['price'])) 
		{
			show_json(9999, '支付金额不能为0元!');
        }
        
        $log = pdo_fetch('SELECT * FROM ' . tablename('core_paylog') . ' WHERE `uniacid`=:uniacid AND `module`=:module AND `tid`=:tid limit 1', array(':uniacid' => $_W['uniacid'], ':module' => 'ewei_shopv2', ':tid' => $orderInfo['ordersn']));
		if (!(empty($log)) && ($log['status'] != '0')) 
		{
			show_json(9999, '订单异常！');
		}
		// $seckill_goods = pdo_fetchall('select goodsid,optionid,seckill from  ' . tablename('ewei_shop_order_goods') . ' where orderid=:orderid and uniacid=:uniacid and seckill=1 ', array(':uniacid' => $_W['uniacid'], ':orderid' => $orderInfo['id']));
        if (!(empty($log)) && ($log['status'] == '0')) 
		{
			pdo_delete('core_paylog', array('plid' => $log['plid']));
			$log = NULL;
		}
		if (empty($log)) 
		{
			$log = array('uniacid' => $_W['uniacid'], 'openid' => $orderInfo['agentid'], 'module' => 'ewei_shopv2', 'tid' => $orderInfo['ordersn'], 'fee' => $orderInfo['price'], 'status' => 0);
			pdo_insert('core_paylog', $log);
			$plid = pdo_insertid();
        }
        load()->model('payment');
        $setting = uni_setting($_W['uniacid'], array('payment'));
        $sec = m('common')->getSec();
        $sec = iunserializer($sec['sec']);
        
        $params = array();
        $params['tid'] = $log['tid'] . $ext;
        if (!(empty($orderInfo['ordersn2']))) 
        {
            $var = sprintf('%02d', $orderInfo['ordersn2']);
            $params['tid'] .= 'GJ' . $var . $ext;
        }
        $params['user'] = $params['openid'] = $userinfo['openid'];
        $params['fee'] = $orderInfo['price'];
        if (!(empty($ispeerpay))) 
        {
            $params['fee'] = $peerprice;
            $params['tid'] = $params['tid'] . $orderInfo['agentid'] . str_replace('.', '', $params['fee']) . $ext;
        }
        $params['title'] = $param_title;
        if (isset($set['pay']) && ($set['pay']['weixin'] == 1)) 
        {
            if (is_array($setting['payment'])) 
            {
                $options = $setting['payment']['wechat'];
                $options['appid'] = self::$APPID;
                $options['secret'] = self::$APPSECRET;
            }
            $wechat = m('common')->wechat_build($params, $options, 0);
            if (!(is_error($wechat))) 
            {
                $wechat['success'] = true;
                if (!(empty($wechat['code_url']))) 
                {
                    $wechat['weixin_jie'] = true;
                }
                else 
                {
                    $wechat['weixin'] = true;
                }
            }
        }
        if ((isset($set['pay']) && ($set['pay']['weixin_jie'] == 1) && !($wechat['success']))) 
        {
            if (!(empty($orderInfo['ordersn2']))) 
            {
                $params['tid'] = $params['tid'] . '_B' . $ext;
            }
            else 
            {
                $params['tid'] = $params['tid'] . '_borrow' . $ext;
            }
            $options = array();
            $options['appid'] = self::$APPID;
            $options['secret'] = self::$APPSECRET;
            $options['mchid'] = $sec['mchid'];
            $options['apikey'] = $sec['apikey'];
            
            $wechat = m('common')->wechat_native_build($params, $options, 0);
            if (!(is_error($wechat))) 
            {
                $wechat['success'] = true;
                if (!(empty($params['openid']))) 
                {
                    $wechat['weixin'] = true;
                }
                else 
                {
                    $wechat['weixin_jie'] = true;
                }
            }
        }
        if(!$wechat['success']){
            show_json(9999, $wechat['message']);
        }
        /* load()->func('communication');
        $response = ihttp_get($url);
		if (is_error($response)) {
			show_json(1, '服务器请求错误！');
        } */
        show_json(200, $wechat);
    }

    /**
     * 用户余额充值
     */
    public function rechange()
    {
		global $_W;
        global $_GPC;

        $session3rd = $_GPC['session3rd'];
        $order_id = intval($_GPC['order_id']);
        
        if(empty($session3rd)){
            show_json(9999, '未登录！');
        }
        $userinfo = cache_read($session3rd);
        if(empty($userinfo)){
            show_json(9999, '未登录！');
        }
		if($order_id <= 0){
            show_json(9999, '订单id不正确！');
        }
        $sql = 'SELECT id,logno,`money`,`status`,`type`,title FROM '.tablename('ewei_shop_member_log').' WHERE id=:id AND uniacid = :uniacid';
        $orderInfo = pdo_fetch($sql,array(':uniacid' => $_W['uniacid'],':id'=>$order_id));
        if(empty($orderInfo)){
            show_json(9999, '订单不存在！');
        }
        $logid = $orderInfo['id'];
        $logno = $orderInfo['logno'];
		
        $type = $_GPC['type'];
        $ext = $this->ordersn_ext;
		
		$set = m('common')->getSysset(array('shop', 'pay'));
		$set['pay']['weixin'] = ((!(empty($set['pay']['weixin_sub'])) ? 1 : $set['pay']['weixin']));
        $set['pay']['weixin_jie'] = ((!(empty($set['pay']['weixin_jie_sub'])) ? 1 : $set['pay']['weixin_jie']));
        
        if (empty($set['pay']['weixin']) && empty($set['pay']['weixin_jie'])) 
        {
            show_json(1, '未开启微信支付!');
        }
        $wechat = array('success' => false);
        $jie = intval($_GPC['jie']);
        $params = array();
        $params['tid'] = $orderInfo['logno'] . $ext;
        $params['openid'] = $params['user'] = $userinfo['openid'];
        $params['fee'] = $orderInfo['money'];
        $params['title'] = $orderInfo['title'];
        if (isset($set['pay']) && ($set['pay']['weixin'] == 1) && ($jie !== 1)) 
        {
            load()->model('payment');
            $setting = uni_setting($_W['uniacid'], array('payment'));
            $options = array();
            if (is_array($setting['payment'])) 
            {
                $options = $setting['payment']['wechat'];
                $options['appid'] = self::$APPID;
                $options['secret'] = self::$APPSECRET;
            }
            $options['appid'] = self::$APPID;
            $options['secret'] = self::$APPSECRET;
            $wechat = m('common')->wechat_build($params, $options, 1);
            if (!(is_error($wechat))) 
            {
                $wechat['success'] = true;
                if (!(empty($wechat['code_url']))) 
                {
                    $wechat['weixin_jie'] = true;
                }
                else 
                {
                    $wechat['weixin'] = true;
                }
            }
        }
        if ((isset($set['pay']) && ($set['pay']['weixin_jie'] == 1) && !($wechat['success'])) || ($jie === 1)) 
        {
            $params['tid'] = $params['tid'] . '_borrow' . $ext;
            $sec = m('common')->getSec();
            $sec = iunserializer($sec['sec']);
            $options = array();
            $options['appid'] = self::$APPID;
            $options['mchid'] = self::$APPSECRET;
            $options['apikey'] = $sec['apikey'];

            $wechat = m('common')->wechat_native_build($params, $options, 1);
            if (!(is_error($wechat))) 
            {
                $wechat['success'] = true;
                if (!(empty($params['openid']))) 
                {
                    $wechat['weixin'] = true;
                }
                else 
                {
                    $wechat['weixin_jie'] = true;
                }
            }
        }
        $wechat['jie'] = $jie;
        if (!($wechat['success'])) 
        {
            show_json(0, '微信支付参数错误!');
        }
        $wechat['order_id'] = $orderInfo['id'];
        show_json(200, $wechat);
    }

    /**
     * 送水订单
     */
    public function waterOrder()
    {
        global $_W;
        global $_GPC;
        $session3rd = $_GPC['session3rd'];
        $order_id = intval($_GPC['order_id']);
        
        if(empty($session3rd)){
            show_json(9999, '未登录！');
        }
        $userinfo = cache_read($session3rd);
        if(empty($userinfo)){
            show_json(9999, '未登录！');
        }
		if($order_id <= 0){
            show_json(9999, '订单id不正确！');
        }
        load()->model('mc');
        $uniacid = $_W['uniacid'];
        $openid = $userinfo['openid'];
        $order = pdo_fetch('select o.* from ' . tablename('ewei_shop_waterorder') . ' as o left join ' . tablename('ewei_shop_water') . ' as g on g.id = o.water_id where o.id = :id and o.uniacid = :uniacid order by o.create_time desc', array(':id' => $order_id, ':uniacid' => $uniacid));
        if (empty($order)) {
            show_json(0, '订单未找到！');
        }

        /*if (empty($order['gstatus']) || !(empty($order['gdeleted']))) {
            $this->message($order['title'] . '<br/> 已下架!', mobileUrl('groups/index'), 'error');
        }
        if ($order['stock'] <= 0) {
            $this->message($order['title'] . '<br/>库存不足!', mobileUrl('groups/index'), 'error');
        }*/
        if (empty($order)) {
            show_json(0, '订单未找到！');
        }
        if ($order['status'] > 1) {
            //已付款  已发货  已完成
            show_json(0, '订单已支付');
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
            $params['tid'] = $order['order_sn'] . $this->ordersn_ext;
            $params['user'] = $params['openid'] = $openid;
            $params['fee'] = $order['price'];
            $params['title'] = $param_title;
            if (isset($set['pay']) && ($set['pay']['weixin'] == 1)) {
                if (is_array($setting['payment']['wechat']) && $setting['payment']['wechat']['switch']) {
                    load()->model('payment');
                    $setting = uni_setting($_W['uniacid'], array('payment'));
                    $options = array();
                    if (is_array($setting['payment'])) {
                        $options = $setting['payment']['wechat'];
                        $options['appid'] = self::$APPID;
                        $options['secret'] = self::$APPSECRET;
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
                $params['tid'] = $params['tid'] . '_borrow' . $this->ordersn_ext;
                $options = array();
                $options['appid'] = self::$APPID;
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
        /* $payinfo = array('orderid' => $order_id, 'teamid' => '', 'credit' => $credit, 'wechat' => $wechat, 'money' => $order['price']);
        if (is_h5app()) {
            $payinfo = array('wechat' => (!(empty($sec['app_wechat']['merchname'])) && !(empty($set['pay']['app_wechat'])) && !(empty($sec['app_wechat']['appid'])) && !(empty($sec['app_wechat']['appsecret'])) && !(empty($sec['app_wechat']['merchid'])) && !(empty($sec['app_wechat']['apikey'])) && (0 < $order['price']) ? true : false), 'alipay' => false, 'mcname' => $sec['app_wechat']['merchname'], 'ordersn' => $order['order_sn'], 'money' => $order['price'], 'attach' => $_W['uniacid'] . ':5', 'type' => 5, 'orderid' => $order_id, 'credit' => $credit, 'teamid' => '');
        } */
        if (!($wechat['success'])) 
        {
            // show_json(0, '微信支付参数错误!');
            show_json(0, $wechat['message']);
        }
        $wechat['order_id'] = $order['id'];
        show_json(200, $wechat);
    }

    /* public function queryOrder(){
        global $_W;
        global $_GPC;
        $order_sn = $_GPC['order_sn'];
        if(empty($order_sn)){
            $order_sn = 'SH20180127175519224283_miniapp';
        }
        // load()->func('communication');
        $params = array();
        $params['tid'] = $orderInfo['logno'] . $this->ordersn_ext;
        $options['appid'] = self::$APPID;
        $options['secret'] = self::$APPSECRET;

        $sec = m('common')->getSec();
        $sec = iunserializer($sec['sec']);
        $options = array();
        $options['appid'] = self::$APPID;
        $options['mchid'] = self::$APPSECRET;
        $options['apikey'] = $sec['apikey'];
        list(, $payment) = m('common')->public_build();
        
        $wechat = array(
            'appid'=>self::$APPID,
            'mch_id'=>$payment['sub_mch_id'],
            // 'sub_mch_id'=>$payment['sub_mch_id'],
            'apikey'=> $payment['apikey'],
        );
        $wechat = m('common')->wechat_order_query($order_sn, '299',$wechat);
        var_dump($wechat);exit;
		$response = ihttp_request('https://api.mch.weixin.qq.com/pay/orderquery', $dat);
    } */
}
?>