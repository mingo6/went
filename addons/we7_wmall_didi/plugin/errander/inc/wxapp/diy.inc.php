<?php

defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
icheckauth();
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'index';

if ($op == 'index') {
	$id = intval($_GPC['id']);
	$diypage = get_errander_diypage($id);
	$condition = array();
	$params = json_decode(htmlspecialchars_decode($_GPC['extra']), true);

	if (!empty($params)) {
		$buyaddress_id = intval($params['buyaddress_id']);

		if (0 < $buyaddress_id) {
			$buyaddress = member_errander_address_check($buyaddress_id);

			if (!is_error($buyaddress)) {
				$condition['buyaddress'] = $buyaddress;
			}
		}
		else {
			if (!empty($params['buyaddress'])) {
				$buyaddress = member_errander_address_check($params['buyaddress']);

				if (!is_error($buyaddress)) {
					$condition['buyaddress'] = $buyaddress;
				}
			}
		}

		$acceptaddress_id = intval($params['acceptaddress_id']);

		if (0 < $acceptaddress_id) {
			$acceptaddress = member_errander_address_check($acceptaddress_id);

			if (!is_error($acceptaddress)) {
				$condition['acceptaddress'] = $acceptaddress;
			}
		}

		$condition = array_merge($condition, $params);
	}

	if (empty($acceptaddress)) {
		$address = member_fetch_available_address($store);
		$condition['acceptaddress'] = $address;
	}

	$order = errander_order_calculate_delivery_fee($diypage, $condition, intval($_GPC['is_calculate']));

	if (is_error($order)) {
		message($order, '', 'ajax');
	}

	$filter = array('serve_radius' => 0, 'location_x' => $_config_plugin['map']['location_x'], 'location_y' => $_config_plugin['map']['location_y']);
	$addresses = member_fetchall_address($filter);
	$result = array('diy' => $diypage['diypage'], 'addresses' => $addresses, 'redPackets' => order_redPacket_available($order['delivery_fee'], array(), 'paotui'), 'order' => $order, 'buyaddress_id' => $buyaddress['id'], 'buyaddress' => $buyaddress, 'acceptaddress_id' => $acceptaddress['id'], 'acceptaddress' => $acceptaddress);
	message(error(0, $result), '', 'ajax');
	return 1;
}

if ($op == 'feeRule') {
	$id = $_GPC['id'];
	$result = array('feeRule' => get_errander_rule_fee($id));
	message(error(0, $result), '', 'ajax');
}

?>
