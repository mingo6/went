<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
function superRedpacket_grant_show() {
	global $_W;
	$activity_id = pdo_fetchcolumn('select activity_id from ' . tablename('tiny_wmall_activity_redpacket_record') . ' where uniacid = :uniacid and uid = :uid and channel = :channel and type = :type and status = 1 and is_show = 0', array(':uniacid' => $_W['uniacid'], ':uid' => $_W['member']['uid'], ':channel' => 'superRedpacket', ':type' => 'grant'));
	if(empty($activity_id)) {
		return error(-1, '发放红包活动不存在1');
	}
	$superRedpacket = pdo_get('tiny_wmall_superredpacket', array('uniacid' => $_W['uniacid'], 'id' => $activity_id));
	if(empty($superRedpacket)) {
		return error(-1, '发放红包活动不存在2');
	}
	$superRedpacket['data'] = json_decode(base64_decode($superRedpacket['data']), true);
	$superRedpacket['data']['page']['image'] = tomedia($superRedpacket['data']['page']['image'] );
	$redpackets = pdo_fetchall('select * from ' . tablename('tiny_wmall_activity_redpacket_record') . ' where uniacid = :uniacid and uid = :uid and channel = :channel and activity_id = :activity_id and status = 1 and is_show = 0', array(':uniacid' => $_W['uniacid'], ':uid' => $_W['member']['uid'], ':channel' => 'superRedpacket', ':activity_id' => $activity_id));
	if(!empty($redpackets)) {
		foreach($redpackets as &$row) {
			$row['discount'] = floatval($row['discount']);
			$row['condition'] = floatval($row['condition']);
			$row['use_days_limit_text'] = date('Y-m-d', $row['starttime']) . '~' . date('Y-m-d', $row['endtime']) . '有效';
		}
		$data = array(
			'page' => $superRedpacket['data']['page'],
			'redpackets' => $redpackets
		);
		pdo_update('tiny_wmall_activity_redpacket_record', array('is_show' => 1), array('uniacid' => $_W['uniacid'], 'uid' => $_W['member']['uid'], 'channel' => 'superRedpacket', 'activity_id' => $activity_id));
		return error(0, $data);
	}
	return error(-1, '');
}

function superRedpacket_available_meal_get() {
	global $_W;
	$activity = pdo_get('tiny_wmall_superredpacket', array('uniacid' => $_W['uniacid'], 'type' => 'meal', 'status' => 1));
	if(!empty($activity)) {
		$activity['data'] = json_decode(base64_decode($activity['data']), true);
		if(!empty($activity['data']['rules'])) {
			$activity['data']['rules'] = htmlspecialchars_decode(base64_decode($activity['data']['rules']));
		}
	}
	return $activity;
}

function superRedpacket_meal_get($id) {
	global $_W;
	$activity = pdo_get('tiny_wmall_superredpacket', array('uniacid' => $_W['uniacid'], 'type' => 'meal', 'id' => $id));
	if(!empty($activity)) {
		$activity['data'] = json_decode(base64_decode($activity['data']), true);
		if(!empty($activity['data']['rules'])) {
			$activity['data']['rules'] = htmlspecialchars_decode(base64_decode($activity['data']['rules']));
		}
	}
	return $activity;
}

function superRedpacket_share_insert($order_id) {
	global $_W;
	$order = order_fetch($order_id);
	if(empty($order)) {
		return error(-1, '订单不存在');
	}
	$activity = pdo_get('tiny_wmall_superredpacket', array('uniacid' => $_W['uniacid'], 'type' => 'share', 'status' => 1));
	if(empty($activity)) {
		return error(-1, '没有开启的分享超级红包活动');
	}
	if($order['total_fee'] < $activity['condition']) {
		return error(-1, '没有达到分享超级红包的条件');
	}

	$activity['data'] = json_decode(base64_decode($activity['data']), true);
	$packet_num = rand($activity['data']['activity']['packet_min_num'], $activity['data']['activity']['packet_max_num']);
	$insert = array(
		'uniacid' => $_W['uniacid'],
		'uid' => $order['uid'],
		'order_id' => $order_id,
		'activity_id' => $activity['id'],
		'packet_dosage' => $packet_num,
		'packet_total' => $packet_num,
		'addtime' => TIMESTAMP
	);
	pdo_insert('tiny_wmall_superredpacket_grant', $insert);
	return true;
}

function superRedpacket_share_grant($order_id) {
	global $_W;
	$grant = pdo_get('tiny_wmall_superredpacket_grant', array('uniacid' => $_W['uniacid'], 'order_id' => $order_id));
	if(empty($grant)) {
		return error(-1, '分享红包不存在');
	}
	if($grant['packet_dosage'] <= 0) {
		return error(-1, '红包已发放完毕');
	}
	$member = pdo_get('tiny_wmall_members', array('uniacid' => $_W['uniacid'], 'uid' => $grant['uid']));
	if(empty($member)) {
		return error(-1, '分享人不存在');
	}
	$activity = pdo_get('tiny_wmall_superredpacket', array('uniacid' => $_W['uniacid'],'id' => $grant['activity_id'], 'type' => 'share', 'status' => 1));
	if(empty($activity)) {
		return error(-1, '分享超级红包活动不存在或已结束');
	}
	$activity['data'] = json_decode(base64_decode($activity['data']), true);
	$redpackets = pdo_fetchall('select * from ' . tablename('tiny_wmall_superredpacket_share') . ' where uniacid = :uniacid and activity_id = :activity_id and nums > 0', array(':uniacid' => $_W['uniacid'], ':activity_id' => $grant['activity_id']), 'id');
	if(empty($redpackets)) {
		return error(-1, '没有可发放的红包');
	}
	$redpacket_grant_num = rand($activity['data']['activity']['redpacket_min_num'], $activity['data']['activity']['redpacket_max_num']);
	mload()->model('redPacket');
	$ids = array_keys($redpackets);
	if($redpacket_grant_num < count($redpackets)) {
		$ids = array_rand($redpackets, $redpacket_grant_num);
	}
	if(!empty($ids)) {
		foreach($ids as $id) {
			$params = array(
				'uniacid' => $_W['uniacid'],
				'activity_id' => $activity['id'],
				'super_share_id' => $grant['id'],
				'title' => $redpackets[$id]['title'],
				'channel' => 'superRedpacket',
				'type' => 'share',
				'uid' => $_W['member']['uid'],
				'discount' => $redpackets[$id]['discount'],
				'condition' => $redpackets[$id]['condition'],
				'days_limit' => $redpackets[$id]['use_days_limit'],
				'grant_days_effect' => $redpackets[$id]['grant_days_effect'],
				'category_limit' => $redpackets[$id]['category_limit'],
				'times_limit' => $redpackets[$id]['times_limit'],
			);
			$status = redPacket_grant($params, false);
			$nums = $redpackets[$id]['nums'] - 1;
			pdo_update('tiny_wmall_superredpacket_share', array('nums' => $nums), array('uniacid' => $_W['uniacid'], 'id' => $id));
		}
		$packet_dosage = $grant['packet_dosage'] - 1;
		pdo_update('tiny_wmall_superredpacket_grant', array('packet_dosage' => $packet_dosage), array('uniacid' => $_W['uniacid'], 'id' => $grant['id']));
	}
	return true;
}

function superRedpacket_cron() {
	global $_W;
	pdo_query("update " . tablename('tiny_wmall_superredpacket') . " set status = 0 where uniacid = :uniacid and status = 1 and type = :type and (endtime < :time or starttime > :time)", array(':uniacid' => $_W['uniacid'], ':type' => 'share', ':time' => TIMESTAMP));
	pdo_query("update " . tablename('tiny_wmall_superredpacket') . " set status = 1 where uniacid = :uniacid and status = 0 and type = :type and (endtime > :time and starttime < :time)", array(':uniacid' => $_W['uniacid'], ':type' => 'share', ':time' => TIMESTAMP));
	return true;
}

function superRedpacket_meal_order_get($id) {
	global $_W;
	$data = pdo_get('tiny_wmall_superredpacket_meal_order', array('uniacid' => $_W['uniacid'], 'id' => $id));
	if(!empty($data)){
		$data['addtime'] = date('Y-m-d H:i',$data['addtime']);
		$data['data'] = iunserializer($data['data']);
	}
	return $data;
}

function superRedpacket_meal_order_order_update($orderOrId, $type, $extra = array()) {
	global $_W;
	$order = $orderOrId;
	if(!is_array($order)) {
		$order = superRedpacket_meal_order_get($order);
	}
	if(empty($order)) {
		return error(-1, '商品不存在！');
	}
	if($type == 'pay') {
		$update = array(
			'is_pay' => 1,
			'pay_type' => $extra['type'],
			'paytime' => TIMESTAMP,
		);
		pdo_update('tiny_wmall_superredpacket_meal_order', $update, array('id' => $order['id']));
		//开始兑换红包
		mload()->model('redPacket');
		if(!empty($order['data']['meal']['data'])) {
			foreach($order['data']['meal']['data'] as $redpacket) {
				$data = array(
					'title' => $redpacket['name'],
					'channel' => 'superRedpacket_meal',
					'type' => 'grant',
					'discount' => $redpacket['discount'],
					'days_limit' => $redpacket['use_days_limit'],
					'grant_days_effect' => $redpacket['grant_days_effect'],
					'condition' => $redpacket['condition'],
					'times_limit' => iserializer($redpacket['times']),
					'uid' => $order['uid']
				);
				redPacket_grant($data);
			}
		}
	} elseif($type == 'handle') {
		if($order['status'] == 1) {
			pdo_update('tiny_wmall_superredpacket_meal_order', array('status' => 2), array('id' => $order['id']));
		}
	}
}


