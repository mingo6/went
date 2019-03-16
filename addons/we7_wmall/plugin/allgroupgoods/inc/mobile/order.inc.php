<?php
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
mload()->model("AllgroupgoodsGoods");
mload()->model("AllgroupgoodsOrder");
$_W['page']['title'] = "拼团活动详情";
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'index';
icheckauth();

if ($op == 'index') {
    $_config_mall = $_W['we7_wmall']['config']['mall'];
    /* if (!$_W['ispost']) {
        die(json_encode(ierror('-1', '请求错误！')));
    } */
    $pay_types = order_pay_types();
    if ($_GPC['goods_id'] <= 0) {
        imessage('商品id不能为空！', '', 'error');
    }
    $_GPC['type'] = $_GPC['type'] == 1 ? 1 : 2;
    $_GPC['goods_num'] = 1;

    $goodsMod = new AllgroupgoodsGoods();
    $goods = $goodsMod->goodsFetch($_GPC['goods_id']);
    if (is_error($goods)) {
        imessage($goods['message'], '', 'error');
    }
    if ($goods['inventory'] <= 0) {
        imessage('库存不足！', '', 'error');
    }
    if($_GPC['group_id'] > 0){
        $group = pdo_get('tiny_wmall_allgroupgoods_group', array('id' => $_GPC['group_id'], 'uniacid' => $_W['uniacid']));
        if(empty($group)){
            imessage(error(-1, '拼团不存在！'), '', 'ajax');
        }
        if($group['state'] != 1){
            imessage(error(-1, '拼团已失效或未支付！'), '', 'ajax');
        }
    }
    if ($_GPC['type'] == AllgroupgoodsOrder::TYPE_ALONE) {	//单独购买
        $price = $goods['dd_price'];
    } else if ($_GPC['type'] == AllgroupgoodsOrder::TYPE_GROUP) { //团购
        $price = $goods['pt_price'];
    } else {
        imessage('类型错误', '', 'error');
    }
    $store = store_fetch($goods['sid'], array('agentid', 'id', 'cid', 'is_rest', 'title', 'logo', 'location_x', 'location_y', 'invoice_status', 'delivery_type', 'delivery_mode', 'delivery_price', 'delivery_fee_mode', 'delivery_areas', 'delivery_time', 'delivery_free_price', 'pack_price', 'delivery_within_days', 'delivery_reserve_days', 'order_note', 'data', 'not_in_serve_radius', 'serve_radius', 'payment'));
	//支付方式
    if (empty($store['payment'])) {
        imessage('店铺没有设置有效的支付方式', referer(), 'error');
    }
    $address = member_fetch_available_address($goods['sid']);
    $address_id = $address['id'];
    $sid = $goods['sid'];
    
	//商家配送方式
    $delivery_time = store_delivery_times($sid);
    $time_flag = 0;
    $predict_index = 0;
    $predict_timestamp = TIMESTAMP + 60 * $store['delivery_time'];

    if (!$delivery_time['reserve']) {
        $data = array_order(TIMESTAMP + 60 * $store['delivery_time'], $delivery_time['timestamp']);
        if (!empty($data)) {
            $time_flag = 1;
            $predict_index = array_search($data, $delivery_time['timestamp']);
            $predict_day = $delivery_time['days'][0];
            $predict_time_cn = "{$delivery_time['times'][$predict_index]['start']}~{$delivery_time['times'][$predict_index]['end']}";
            $text_time = $predict_time = "尽快送达";
            $predict_extra_price = $delivery_time['times'][$predict_index]['fee'];
        } else {
            $predict_day = $delivery_time['days'][1];
            $predict_times = array_shift($delivery_time['times']);
            $predict_time = "{$predict_times['start']}~{$predict_times['end']}";
            $text_time = "{$predict_day} {$predict_time}";
        }
        $predict_delivery_price = $store['delivery_price'] + $delivery_time['times'][$predict_index]['fee'];
        if ($store['delivery_fee_mode'] == 1) {
            $predict_delivery_price = "{$predict_delivery_price}元配送费";
        } else {
            $predict_delivery_price = "配送费{$predict_delivery_price}元起";
        }
    } else {
        $predict_day = $delivery_time['days'][0];
        $predict_time = "{$delivery_time['times'][0]['start']}~{$delivery_time['times'][0]['end']}";
        $text_time = "{$predict_day} {$predict_time}";
    }

	//计算配送费
    $delivery_price = 0;
    $delivery_free_price = 0;
    if ($store['delivery_type'] != 2) {
        if ($store['delivery_fee_mode'] == 1) {
            $delivery_price_basic = $store['delivery_price'];
            $delivery_price = $store['delivery_price'] + $delivery_time['times'][$predict_index]['fee'];
        } elseif ($store['delivery_fee_mode'] == 2) {
            $delivery_price = $delivery_price_basic = $store['delivery_price_extra']['start_fee'];
            $distance = $address['distance'];
            if (!empty($address) && $distance > 0) {
                if ($distance > $store['delivery_price_extra']['start_km']) {
                    $delivery_price += ($distance - $store['delivery_price_extra']['start_km']) * $store['delivery_price_extra']['pre_km_fee'];
                }
                $delivery_price = $delivery_price_basic = round($delivery_price, 2);
                if ($store['delivery_price_extra']['max_fee'] > 0 && $delivery_price > $store['delivery_price_extra']['max_fee']) {
                    $delivery_price = $store['delivery_price_extra']['max_fee'];
                }
                $delivery_price += $delivery_time['times'][$predict_index]['fee'];
            }
            $_SESSION['delivery_price'] = $delivery_price;
        } elseif ($store['delivery_fee_mode'] == 3) {
            if (!empty($address)) {
                $area_index = 0;
                foreach ($store['delivery_areas'] as $key => $row) {
                    $is_ok = isPointInPolygon($row['path'], array($address['location_y'], $address['location_x']));
                    if ($is_ok) {
                        $area_index = $key;
                        break;
                    }
                }
                if (!empty($area_index)) {
                    $area = $store['delivery_areas'][$area_index];
                    $delivery_price = $delivery_price_basic = round($area['delivery_price'], 2);
                    $send_price = $area['send_price'];
                    $delivery_free_price = $area['delivery_free_price'];
                    $delivery_price += $delivery_time['times'][$predict_index]['fee'];
                }
            }
        }
    }
    $cookie_price_original = array();
    if (!empty($_GPC['_cookie_price'])) {
        $cookie_price_original = iunserializer(base64_decode($_GPC['_cookie_price']));
    }

    $cookie_price = array(
        'delivery_price' => $delivery_price,
        'delivery_free_price' => $delivery_free_price,
    );
    isetcookie('_cookie_price', base64_encode(iserializer($cookie_price)), 180);
    $send_diff = 0;
    if ($send_price > $price) {
        $send_diff = round($send_price - $price, 2);
    } else {
        if (!empty($address_id)) {
            isetcookie('__aid', $address['id'], 300);
        }
    }
	//代金券
    $coupon_text = '无可用代金券';
    mload()->model('coupon');
    $coupons = coupon_available($sid, $price);
    if (!empty($coupons)) {
        $coupon_text = count($coupons) . '张可用代金券';
    }
	//红包
    $redPacket_text = '无可用红包';
    mload()->model('redPacket');
    $redPackets = redPacket_available($price, explode('|', $store['cid']));
    if (!empty($redPackets)) {
        $redPacket_text = count($redPackets) . '个可用红包';
    }
    $recordid = intval($_GPC['recordid']);
    $redPacket_id = intval($_GPC['redPacket_id']);
    $cart = array();
    $activityed = order_count_activity($store['id'], $cart, $recordid, $redPacket_id, $delivery_price, $delivery_free_price);
    if (!empty($activityed['list']['token'])) {
        $coupon_text = "{$activityed['list']['token']['value']}元券";
    }
    if (!empty($activityed['list']['redPacket'])) {
        $redPacket_text = "-￥{$activityed['list']['redPacket']['value']}";
        $redPacket = $activityed['redPacket'];
    }
	//总优惠金额,此金包含到店自提优惠的金额
    $activity_price = $activity_notSelfDelivery_price = $activityed['total'];
	//配送费优惠金额
    $delivery_activity_price = 0;
    if (!empty($activityed) && (!empty($activityed['list']['delivery']) || !empty($activityed['list']['deliveryFeeDiscount']))) {
        $delivery_activity_price = floatval($activityed['list']['delivery']['value'] + $activityed['list']['deliveryFeeDiscount']['value']);
    }
	//到店自提优惠金额
    $self_delivery_activity_price = 0;
    if (!empty($activityed) && !empty($activityed['list']['selfDelivery'])) {
        $self_delivery_activity_price = $activityed['list']['selfDelivery']['value'];
    }
	//平台附加费
    $extra_fee = 0;
    if (!empty($store['data']['extra_fee'])) {
        foreach ($store['data']['extra_fee'] as $key => $item) {
            $item_fee = floatval($item['fee']);
            if ($item['status'] == 1 && $item_fee > 0) {
                $extra_fee += $item_fee;
            } else {
                unset($store['data']['extra_fee'][$key]);
            }
        }
    }
	//（平台配送/订单配送模式下）订单优惠后的金额
    $waitprice = $price + $delivery_price + $store['pack_price'] - $activityed['total'] + $self_delivery_activity_price + $extra_fee;
	//（平台配送/订单配送模式下）优惠金额,此金额减去了到店自提优惠的金额
    $activity_price -= $self_delivery_activity_price;
    $activity_notSelfDelivery_price -= $self_delivery_activity_price;
	//如果门店只支持到店自提
    if ($store['delivery_type'] == 2) {
        $waitprice -= $self_delivery_activity_price;
        $activity_price += $self_delivery_activity_price;
        $activity_notSelfDelivery_price += $self_delivery_activity_price;
    }
    $waitprice = ($waitprice > 0) ? $waitprice : 0;
    $order_type = 1;
} elseif ($op == 'submit') {
    if (!$_W['isajax']) {
        imessage(error(-1, '非法访问'), '', 'ajax');
    }
    if ($_GPC['goods_id'] <= 0) die(json_encode(ierror('-1', 'goods_id不能为空！')));
    $_GPC['goods_num'] = 1;
    if ($_GPC['goods_num'] <= 0) die(json_encode(ierror('-1', '数量不能为空！')));
//    $_GPC['pay_type'] = $_GPC['pay_type'] == 'money' ? 'money' : 'wechat';
	$goodsMod = new AllgroupgoodsGoods();
	$good = $goodsMod->goodsFetch($_GPC['goods_id']);
	if (is_error($good)) {
        imessage(error(-1, $good['message']), '', 'ajax');
	}
    $sid = $good['sid'];

    pdo_begin();
    $_GPC['order_type'] = 1;
    $order_type = $_GPC['order_type'];

    $store = store_fetch($good['sid'], array('agentid', 'id', 'cid', 'is_rest', 'title', 'logo', 'location_x', 'location_y', 'invoice_status', 'delivery_type', 'delivery_mode', 'delivery_price', 'delivery_fee_mode', 'delivery_areas', 'delivery_time', 'delivery_free_price', 'pack_price', 'delivery_within_days', 'delivery_reserve_days', 'order_note', 'data', 'not_in_serve_radius', 'serve_radius', 'payment'));

    if ($_GPC['order_type'] == 1) {
        $address = member_takeout_address_check($store, $_GPC['address_id'], false);
        if (is_error($address)) {
            imessage(error(-1, $address['message']), '', 'ajax');
        }
        $delivery_time = store_delivery_times($sid);
		//计算配送费
        $predict_index = intval($_GPC['delivery_index']);
        $delivery_price = 0;
        if ($store['delivery_type'] != 2) {
            if ($store['delivery_fee_mode'] == 1) {
                $delivery_price = $store['delivery_price'] + $delivery_time['times'][$predict_index]['fee'];
            } elseif ($store['delivery_fee_mode'] == 2) {
                $distance = $address['distance'];
                $delivery_price = $store['delivery_price_extra']['start_fee'];
                if ($distance > 0) {
                    if ($distance > $store['delivery_price_extra']['start_km']) {
                        $delivery_price += ($distance - $store['delivery_price_extra']['start_km']) * $store['delivery_price_extra']['pre_km_fee'];
                    }
                    $delivery_price = round($delivery_price, 2);
                    if ($store['delivery_price_extra']['max_fee'] > 0 && $delivery_price > $store['delivery_price_extra']['max_fee']) {
                        $delivery_price = $store['delivery_price_extra']['max_fee'];
                    }
                    $delivery_price += $delivery_time['times'][$predict_index]['fee'];
                }
                if (!empty($_SESSION['delivery_price'])) {
                    $delivery_price = $_SESSION['delivery_price'];
                }
            } elseif ($store['delivery_fee_mode'] == 3) {
                $price = store_order_condition($store, array($address['location_y'], $address['location_x']));
                $send_price = $price['send_price'];
                if ($send_price > ($data['total_price'])) {
                    imessage(error(-1, '当前商品不满起送价'), '', 'ajax');
                }
                $delivery_price = round($price['delivery_price'], 2);
                $delivery_free_price = $price['delivery_free_price'];
                $delivery_price += $delivery_time['times'][$predict_index]['fee'];
            }
        }
    } elseif ($_GPC['order_type'] == 2) {
        $address = array(
            'realname' => trim($_GPC['username']),
            'mobile' => trim($_GPC['mobile'])
        );
    }
    isetcookie('_cookie_price', '', -100);
    $order_type = intval($_GPC['order_type']) ? intval($_GPC['order_type']) : 1;
    $recordid = intval($_GPC['record_id']);
    $redPacket_id = intval($_GPC['redPacket_id']);
    $cart = array();
    $activityed = order_count_activity($sid, $cart, $recordid, $redPacket_id, $delivery_price, $delivery_free_price, $order_type);

	//平台附加费
    $extra_fee_note = array();
    $extra_fee = 0;
    if (!empty($store['data']['extra_fee'])) {
        foreach ($store['data']['extra_fee'] as $item) {
            $item_fee = floatval($item['fee']);
            if ($item['status'] == 1 && $item_fee > 0) {
                $extra_fee += $item_fee;
                $extra_fee_note[] = $item;
            }
        }
    }

    //公共订单信息
	$data['uniacid'] = $_W['uniacid'];
	$data['order_no'] = date('YmdHis', time()) . rand(100000, 999999);//订单号
	$data['uid'] = $_W['member']['uid'];
	$data['sid'] = $good['sid'];
	$data['goods_id'] = $_GPC['goods_id'];
	$data['group_id'] = 0;
	$data['create_time'] = time();
	$data['pay_type'] = $_GPC['pay_type'] == 'money' ? 3 : 2;   //默认微信支付
	$data['status'] = 0;
	$data['location_x'] = $address['location_x'];
    $data['location_y'] = $address['location_y'];
	if ($good['inventory'] >= $_GPC['goods_num']) {
		if ($_GPC['type'] == 1) {	//单独购买
			// $data['logo']=$_GPC['logo'];
			// $data['goods_name']=$_GPC['goods_name'];
			// $data['goods_type']=$_GPC['goods_type'];
			// $data['goods_name']=$_GPC['goods_name'];
			$data['goods_num'] = $_GPC['goods_num'];
			$data['total_price'] = $good['dd_price'] * $_GPC['goods_num'];
			$data['pay_price'] = $good['dd_price'] * $_GPC['goods_num'];
			// $data['receive_name']=$_GPC['receive_name'];
			// $data['receive_tel']=$_GPC['receive_tel'];
			// $data['receive_address']=$_GPC['receive_address'];
			// $data['note']=$_GPC['note'];
			$res = pdo_insert('tiny_wmall_allgroupgoods_order', $data);
			$id = pdo_insertid();
			if (!$res) {
                imessage(error(-1, '下单失败'), '', 'ajax');
			}
		} else if ($_GPC['type'] == 2) {
			//生产团
			$_GPC['group_id'] = intval($_GPC['group_id']);
			if ($_GPC['group_id'] <= 0) {	//生产团
				$data2['sid'] = $good['sid'];
				$data2['goods_id'] = $good['id'];
				$data2['goods_logo'] = $good['thumb'];
				$data2['goods_name'] = $good['name'];
				$data2['kt_num'] = $_GPC['goods_num'];
				$data2['kt_time'] = time();
				$data2['dq_time'] = $good['end_time'];
				$data2['state'] = 0;
				$data2['uid'] = $_W['member']['uid'];
				$data2['uniacid'] = $_W['uniacid'];
				$rst = pdo_insert('tiny_wmall_allgroupgoods_group', $data2);
				$group_id = pdo_insertid();
			} else {
                $group = pdo_get('tiny_wmall_allgroupgoods_group', array('id' => $_GPC['group_id']));
                if(empty($group)){
                    imessage(error(-1, '拼团不存在！'), '', 'ajax');
                }
			}
			if ($_GPC['group_id'] <= 0 && $rst or $_GPC['group_id'] && $group['state'] == 1) {
				$data['group_id'] = empty($_GPC['group_id']) ? $group_id : $_GPC['group_id'];
				// $data['logo'] = $good['thumb'];
				// $data['goods_type']=$_GPC['goods_type'];
				// $data['goods_name']=$_GPC['goods_name'];
				// $data['price']=$_GPC['price'];
				$data['goods_num'] = $_GPC['goods_num'];
				$data['total_price'] = $good['pt_price'] * $_GPC['goods_num'];
				$data['pay_price'] = $good['pt_price'] * $_GPC['goods_num'];
				// $data['money']=$_GPC['money'];
				// $data['receive_name']=$_GPC['receive_name'];
				// $data['receive_tel']=$_GPC['receive_tel'];
				// $data['receive_address']=$_GPC['receive_address'];
				// $data['note']=$_GPC['note'];
				// $data['xf_time']=$_GPC['xf_time'];
				$res = pdo_insert('tiny_wmall_allgroupgoods_order', $data);
				$id = pdo_insertid();
				if (!$res) {
					imessage(error(-1, '下单失败'), '', 'ajax');
				}
			} else {//没有剩余
                imessage(error(-1, '商品已销售完毕或拼团已失效'), '', 'ajax');
			}
		} else {
            imessage(error(-1, '类型错误'), '', 'ajax');
		}
	} else {
        imessage(error(-1, '库存不足！'), '', 'ajax');
    }
    $total_fee = $data['total_price'] + $store['pack_price'] + $delivery_price + $extra_fee;
    $order = array(
        'uniacid' => $_W['uniacid'],
        'agentid' => $store['agentid'],
        'acid' => $_W['acid'],
        'sid' => $sid,
        'uid' => $_W['member']['uid'],
        'mall_first_order' => $_W['member']['is_mall_newmember'],
        'ordersn' => date('YmdHis') . random(6, true),
        'serial_sn' => store_order_serial_sn($sid),
        'code' => random(4, true),
        'order_type' => $order_type,
        'openid' => $_W['openid'],
        'mobile' => $address['mobile'],
        'username' => $address['realname'],
        'sex' => $address['sex'],
        'address' => $address['address'] . $address['number'],
        'location_x' => floatval($address['location_x']),
        'location_y' => floatval($address['location_y']),
        'delivery_day' => trim($_GPC['delivery_day']) ? (date('Y') . '-' . trim($_GPC['delivery_day'])) : date('Y-m-d'),
        'delivery_time' => trim($_GPC['delivery_time']) ? trim($_GPC['delivery_time']) : '尽快送出',
        'delivery_fee' => $delivery_price,
        'pack_fee' => $store['pack_price'],
        'pay_type' => trim($_GPC['pay_type']),
        'num' => $data['goods_num'],
        'distance' => $distance,
        'box_price' => 0,
        'price' => $data['total_price'],
        'extra_fee' => $extra_fee,
        'total_fee' => $total_fee,
        'discount_fee' => $activityed['total'],
        'store_discount_fee' => $activityed['store_discount_fee'],
        'plateform_discount_fee' => $activityed['plateform_discount_fee'],
        'agent_discount_fee' => $activityed['agent_discount_fee'],
        'final_fee' => $total_fee - $activityed['total'],
        'vip_free_delivery_fee' => !empty($activityed['list']['vip_delivery']) ? 1 : 0,
        'delivery_type' => $store['delivery_mode'],
        'status' => 1,
        'is_comment' => 0,
        'invoice' => trim($_GPC['invoice']),
        'addtime' => TIMESTAMP,
        'data' => array(
            'extra_fee' => $extra_fee_note,
            'cart' => iunserializer(''),
            'commission' => array(
                'spread1_rate' => "0%", 
                'spread1' => 0,
                'spread2_rate' => "0%",
                'spread2' => 0,
            ),
        ),
        'note' => trim($_GPC['note']),
    );
    if ($order['final_fee'] < 0) {
        $order['final_fee'] = 0;
    }
    $order['spreadbalance'] = 1;
    if (check_plugin_perm('spread')) {
        if (!empty($_W['member']['spread1']) && $_W['member']['spreadfixed'] == 1) {
            mload()->model('plugin');
            $_W['plugin'] = array(
                'name' => 'spread'
            );
            pload()->model('spread');
            $config_spread = get_plugin_config('spread');

            $order['spread1'] = $_W['member']['spread1'];
            if ($config_spread['basic']['level'] == 2) {
                $order['spread2'] = $_W['member']['spread2'];
            }
            $spreads = pdo_fetchall('select uid,spread_groupid from ' . tablename('tiny_wmall_members') . ' where uid = :uid1 or uid = :uid2', array(':uid1' => $order['spread1'], ':uid2' => $order['spread2']), 'uid');
            if (!empty($spreads)) {
                $order['spreadbalance'] = 0;
                $groups = spread_groups();
                $group1 = $groups[$spreads[$order['spread1']]['spread_groupid']];
                $commission1_type = $group1['commission_type'];
                if ($commission1_type == 'ratio') {
                    $spread1_rate = $group1['commission1'] / 100;
                    $commission_spread1 = round($spread1_rate * $order['final_fee'], 2);
                    $spread1_rate = $spread1_rate * 100;
                } elseif ($commission1_type == 'fixed') {
                    $commission_spread1 = $group1['commission1'];
                }
                if (!empty($order['spread2'])) {
                    $group2 = $groups[$spreads[$order['spread2']]['spread_groupid']];
                    $commission2_type = $group2['commission_type'];
                    if ($commission2_type == 'ratio') {
                        $spread2_rate = $group2['commission2'] / 100;
                        $commission_spread2 = round($spread2_rate * $order['final_fee'], 2);
                        $spread2_rate = $spread2_rate * 100;
                    } elseif ($commission1_type == 'fixed') {
                        $commission_spread2 = $group2['commission2'];
                    }
                }
                $order['data']['spread'] = array(
                    'commission' => array(
                        'commission1_type' => $commission1_type,
                        'spread1_rate' => "{$spread1_rate}%",
                        'spread1' => $commission_spread1,
                        'commission2_type' => $commission2_type,
                        'spread2_rate' => "{$spread2_rate}%",
                        'spread2' => $commission_spread2,
                        'from_spread' => $_SESSION['from_spread_id']
                    )
                );
            }
        }
    }

	//分销
    if ($_W['member']['pid'] > 0) {
        $order['pid'] = $_W['member']['pid'];
    }
    
    $order['active_id'] = $id;
    $order['type'] = 2;
    $order['data'] = iserializer($order['data']);
    unset($_SESSION['from_spread_id']);
    pdo_insert('tiny_wmall_order', $order);
    $order_id = pdo_insertid();
    order_update_bill($order_id, array('activity' => $activityed));
    order_insert_discount($order_id, $sid, $activityed['list']);
    order_insert_status_log($order_id, 'place_order');
    // order_update_goods_info($order_id, $sid, array('data' => array()));
    pdo_commit();
    imessage(error(0, $order_id), '', 'ajax');
}

include itemplate('order');