<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
icheckauth();
$ta = trim($_GPC['ta']) ? trim($_GPC['ta']) : 'list';

if($ta == 'list') {
	$id = intval($_GPC['min']);
	$condition = "where a.uniacid = :uniacid and a.uid = :uid";
	$params = array(
		':uniacid' => $_W['uniacid'],
		':uid' => $_W['member']['uid'],
	);
	if($id > 0) {
		$condition .= ' and a.id < :id';
		$params[':id'] = $id;
	}
	$orders = pdo_fetchall('select a.id as aid, a.*, b.title, b.logo, b.delivery_mode from ' . tablename('tiny_wmall_order') . ' as a left join ' . tablename('tiny_wmall_store') . ' as b on a.sid = b.id ' . $condition . ' order by a.id desc limit 20', $params, 'aid');
	$min = 0;
	if(!empty($orders)) {
		$share = get_plugin_config('ordergrant.share');
		$order_status = order_status();
		foreach($orders as &$da) {
			$da['goods'] = pdo_get('tiny_wmall_order_stat', array('oid' => $da['id']));
			$da['comment_cn'] = '去评价';
			if(0 && $share['status'] == 1 && $da['status'] == 5 && $da['is_comment'] == 0 && $da['endtime'] >= (time() - $share['share_grant_days_limit'] * 86400)) {
				$da['comment_cn'] = '评价赢好礼';
			}
			$da['addtime'] = date('Y-m-d H:i:s', $da['addtime']);
			$da['status_text'] = $order_status[$da['status']]['text'];
			$da['logo'] = tomedia($da['logo']);
			$da['delivery_title'] = $_config_mall['delivery_title'];
		}
		$min = min(array_keys($orders));
	}
	$result = array(
		'errno' => 0,
		'message' => array_values($orders),
		'min' => $min,
		'config_mall' => $config_mall,
		'errander_status' => check_plugin_perm('errander') && get_plugin_config('errander.status'),
	);
	imessage($result, '', 'ajax');
}


if($ta == 'detail') {
	$id = intval($_GPC['id']);
	$order = order_fetch($id, true);
	$order_status = order_status();
	if(empty($order)) {
		imessage('订单不存在或已删除', '', 'error');
	}
	$store = store_fetch($order['sid'], array('id', 'title', 'telephone', 'pack_price', 'logo', 'delivery_price', 'address', 'location_x', 'location_y'));
	$goods = order_fetch_goods($order['id']);
	$log = pdo_fetch('select * from ' . tablename('tiny_wmall_order_status_log') . ' where uniacid = :uniacid and oid = :oid order by id desc', array(':uniacid' => $_W['uniacid'], ':oid' => $id));
	$activityed = order_fetch_discount($id);
	$logs = order_fetch_status_log($id);
	if(!empty($logs)) {
		$maxid = max(array_keys($logs));
		$minid = min(array_keys($logs));
		foreach($logs as &$log) {
			$log['addtime'] = date('H:i', $log['addtime']);
		}
	}
	if($order['refund_status']) {
		$refund = order_refund_fetch($id);
		$refund_logs = order_fetch_refund_log($id);
		if(!empty($refund_logs)) {
			$refundmaxid = max(array_keys($refund_logs));
		}
	}
	$deliveryer = pdo_get('tiny_wmall_deliveryer', array('uniacid' => $_W['uniacid'], 'id' => $order['deliveryer_id']));

	$share = get_plugin_config('ordergrant.share');
	$comment = pdo_get('tiny_wmall_order_comment', array('oid' => $order['id']));
	$share_button = 0;
	$order['comment_cn'] = '去评价';
	if(0 && $share['status'] == 1 && !$comment['is_share'] && $order['status'] == 5 && $order['endtime'] >= (time() - $share['share_grant_days_limit'] * 86400)) {
		if($order['is_comment'] == 0) {
			$order['comment_cn'] = '评价赢好礼';
			$share_button = 1;
		} else {
			$share_button = 2;
		}
		$_share = array(
			'title' => $share['share']['title'],
			'desc' => $share['share']['desc'],
			'imgUrl' => tomedia($share['share']['imgUrl']),
			'link' => imurl('ordergrant/share/detail', array('id' => $order['id']), 'true')
		);
	}
	$slides = sys_fetch_slide('orderDetail', true);
	if(empty($slides)){
		$slides = false;
	}
	$result = array(
		'config_mall' => $config_mall,
		'goods' => $goods,
		'store' => $store,
		'order' => $order,
		'activityed' => $activityed,
		'deliveryer' => $deliveryer,
		'order_status' => $order_status,
		'delivery_title' => $config_mall['delivery_title'],
		'logs' => $logs,
		'log' => $log,
		'maxid' => $maxid,
		'minid' => $minid,
		'slides' => $slides
	);
	imessage(error(0, $result), '', 'ajax');
}

if($ta == 'remind') {
	$id = intval($_GPC['id']);
	$order = order_fetch($id);
	if(empty($order)) {
		imessage(error(-1, '订单不存在或已删除'), '', 'ajax');
	}
	$log = pdo_fetch('select * from ' . tablename('tiny_wmall_order_status_log') . ' where uniacid = :uniacid and oid = :oid and status = 8 order by id desc',  array(':uniacid' => $_W['uniacid'], ':oid' => $id));
	$store = store_fetch($order['sid'], array('remind_time_limit', 'remind_time_start'));
	$remind_time_start = intval($store['remind_time_start']);
	if(!empty($remind_time_start) && $order['addtime'] > (time() - $remind_time_start * 60)) {
		imessage(error(-1, "下单后{$remind_time_start}分钟才可以催单"), '', 'ajax');
	}
	$remind_time_limit = intval($store['remind_time_limit']) ? intval($store['remind_time_limit']) : 10;
	if($log['addtime'] >= (time() - $remind_time_limit * 60)) {
		imessage(error(-1, "距离上次催单不超过{$remind_time_limit}分钟,不能催单"), '', 'ajax');
	}
	order_insert_status_log($id, 'remind');
	order_clerk_notice($id, 'remind');
	pdo_update('tiny_wmall_order', array('is_remind' => '1'), array('uniacid' => $_W['uniacid'], 'id' => $id));
	imessage(error(0, '催单成功'), '', 'ajax');
}

if($ta == 'cancel') {
	$id = intval($_GPC['id']);
	$order = order_fetch($id);
	if(empty($order)) {
		imessage(error(-1, '订单不存在或已删除'), '', 'ajax');
	}
	if($order['status'] != 1) {
		imessage(error(-1, '商户已接单,如需取消订单请联系商户处理'), '', 'ajax');
	}
	if(!$order['is_pay']) {
		$result = order_status_update($id, 'cancel');
		if(is_error($result)) {
			imessage(error(-1, $result['message']), '', 'ajax');
		}
	} else {
		imessage(error(-1, '该订单已支付,如需取消订单请联系商户处理'), '', 'ajax');
	}
	imessage(error(0, '取消订单成功'), referer(), 'ajax');
}

if($ta == 'end') {
	$id = intval($_GPC['id']);
	$result = order_status_update($id, 'end');
	if(is_error($result)) {
		imessage(error(-1, $result['message']), '', 'ajax');
	}
	imessage(error(0, '确认订单完成成功'), '', 'ajax');
}

if($ta == 'location') {
	$orderid = intval($_GPC['id']);
	$order = order_fetch($orderid, true);
	$markers = array();
	$markers['customer'] = array(
		'iconPath' => '/static/img/shou.png',
		'id'=> 1,
		'latitude' => $order['location_x'],
		'longitude' => $order['location_y'],
		'width' => 40,
		'height' => 40,
		'callout' => array(
			'content' => '我',
			'color' => '#333',
			'fontSize' => 12,
			'borderRadius' => 5,
			'padding' => 5,
			'bgColor' => '#FFD161',
			'display' => 'ALWAYS',
			'textAlign' => 'center'
		)
	);
	mload()->model('deliveryer');
	$deliveryer = deliveryer_fetch($order['deliveryer_id']);
	$markers['deliveryer'] = array(
		'iconPath' => '/static/img/store1.png',
		'id'=> 2,
		'latitude' => $deliveryer['location_x'],
		'longitude' => $deliveryer['location_y'],
		'width' => 40,
		'height' => 40,
		'callout' => array(
			'content' => "配送员：{$deliveryer['title']}",
			'color' => '#333',
			'fontSize' => 12,
			'borderRadius' => 5,
			'padding' => 5,
			'bgColor' => '#FFD161',
			'display' => 'ALWAYS',
			'textAlign' => 'center'
		)
	);
	$store = store_fetch($order['sid'], array('title', 'logo', 'location_x', 'location_y'));
	$markers['store'] = array(
		'iconPath' => '/static/img/qu.png',
		'id'=> 3,
		'latitude' => $store['location_x'],
		'longitude' => $store['location_y'],
		'width' => 40,
		'height' => 40,
		'callout' => array(
			'content' => "商家：{$store['title']}",
			'color' => '#333',
			'fontSize' => 12,
			'borderRadius' => 5,
			'padding' => 5,
			'bgColor' => '#FFD161',
			'display' => 'ALWAYS',
			'textAlign' => 'center'
		)
	);
	$points = array(
		array(
			'latitude'=> $order['location_x'],
    		'longitude'=> $order['location_y']
		),
		array(
			'latitude'=>  $deliveryer['location_x'],
			'longitude'=>  $deliveryer['location_y']
		),
		array(
			'latitude'=> $store['location_x'],
			'longitude'=> $store['location_y']
		)
	);
	$result = array(
		'markers' => array_values($markers),
		'points' => $points
	);
	imessage(error(0, $result), '', 'ajax');
}


