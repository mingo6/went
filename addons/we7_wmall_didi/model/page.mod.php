<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

function store_filter($filter = array(), $orderby = '') {
	global $_W, $_GPC;
	$condition = "  where uniacid = :uniacid and agentid = :agentid and status = 1";
	$params = array(
		':uniacid' => $_W['uniacid'],
		':agentid' => $_W['agentid']
	);
	if(empty($filter)) {
		$filter = $_GPC;
	}
	if($filter['cid'] > 0) {
		$condition .= ' and cid like :cid';
		$params[':cid'] = "%|{$filter['cid']}|%";
	}
	if(!empty($filter['ids'])) {
		$condition .= " and id in ({$filter['ids']})";
	}
	if(defined('IN_WXAPP')) {
		$temp = $_GPC['condition'];
		$temp = json_decode(htmlspecialchars_decode($temp), true);
	}
	if(!empty($temp)) {
		$dis = trim($temp['dis']);
		if(!empty($dis)) {
			if($dis == 'invoice_status') {
				$condition .= " and invoice_status = 1";
			} elseif($dis == 'delivery_price') {
				$condition .= " and (delivery_price = 0 or delivery_free_price > 0)";
			} else {
				$sids = pdo_getall('tiny_wmall_store_activity', array('uniacid' => $_W['uniacid'], 'type' => $dis, 'status' => 1), array('sid'), 'sid');
				if(empty($sids)) {
					$sids = array(0);
				}
				$sids = implode(',', array_keys($sids));
				$condition .= " and id in ({$sids})";
			}
		}
		$mode = intval($temp['mode']);
		if(!empty($mode)) {
			$condition .= " and delivery_mode = ".$mode;
		}
	}
	$config_mall = $_W['we7_wmall']['config']['mall'];
	$lat = trim($_GPC['lat']);
	$lng = trim($_GPC['lng']);
	$order_by_base = " order by is_rest asc, is_stick desc";
	$order_by = trim($temp['order']) ? trim($temp['order']) : $config_mall['store_orderby_type'];
	if(in_array($order_by, array('sailed', 'score', 'displayorder', 'click'))) {
		$order_by_base .= ", {$order_by} desc";
	} else {
		$order_by_base .= ", {$order_by} asc";
	}

	$pindex = max(1, intval($_GPC['page']));
	$psize = intval($_GPC['psize']) ? intval($_GPC['psize']) : 20;
	$limit = ' limit ' . ($pindex - 1) * $psize . ',' . $psize;
	$stores = pdo_fetchall('select id,agentid,score,title,logo,content,sailed,score,label,serve_radius,not_in_serve_radius,delivery_areas,business_hours,is_in_business,is_rest,is_stick,delivery_fee_mode,delivery_price,delivery_free_price,send_price,delivery_time,delivery_mode,token_status,invoice_status,location_x,location_y,forward_mode,forward_url,displayorder,click,
 ROUND(
        6378.138 * 2 * ASIN(
            SQRT(
                POW(
                    SIN(
                        (
                            '.$lat.' * PI() / 180 - location_x * PI() / 180
                        ) / 2
                    ),
                    2
                ) + COS('.$lat.' * PI() / 180) * COS(location_x * PI() / 180) * POW(
                    SIN(
                        (
                           '.$lng.'  * PI() / 180 - location_y * PI() / 180
                        ) / 2
                    ),
                    2
                )
            )
        ) * 1000) as distance from ' . tablename('tiny_wmall_store') . " {$condition} {$order_by_base} {$limit}", $params, 'id');
	$total = intval(pdo_fetchcolumn('select count(*) from ' . tablename('tiny_wmall_store') . $condition, $params));

	$pagetotal = ceil($total / $psize);
	if(!empty($stores)) {
		$store_keys = implode(',', array_keys($stores));
		$cart_nums = pdo_fetchall('select sid, num as cart_num from ' . tablename('tiny_wmall_order_cart') . " where uniacid = :uniacid and uid = :uid and sid in ({$store_keys})", array(':uniacid' => $_W['uniacid'], ':uid' => $_W['member']['uid']), 'sid');
		$store_label = category_store_label();
		foreach($stores as $key => &$da) {
			$da['cart_num'] = intval($cart_nums[$key]['cart_num']);
			$da['logo'] = tomedia($da['logo']);
			$da['delivery_title'] = $config_mall['delivery_title'];
			$da['scores'] = score_format($da['score']);
			$da['url'] = store_forward_url($da['id'], $da['forward_mode'], $da['forward_url']);
			$da['hot_goods'] = array();
			$hot_goods = pdo_fetchall('select id,title,price,old_price,thumb from ' . tablename('tiny_wmall_goods') . ' where uniacid = :uniacid and sid = :sid and is_hot = 1 and status = 1 limit 3', array(':uniacid' => $_W['uniacid'], ':sid' => $da['id']));
			if(!empty($hot_goods)) {
				foreach($hot_goods as &$goods) {
					$goods['thumb'] = tomedia($goods['thumb']);
					$goods['old_price'] = $goods['old_price'] ? $goods['old_price'] : $goods['price'];
					$goods['discount'] = round(($goods['price'] / $goods['old_price']) * 10, 1);
					$da['hot_goods'][] = $goods;
				}
				$da['hot_goods_num'] = count($da['hot_goods']);
				unset($hot_goods);
			}
			if($da['label'] > 0) {
				$da['label_color'] = $store_label[$da['label']]['color'];
				$da['label_cn'] = $store_label[$da['label']]['title'];
			}
			if($da['delivery_fee_mode'] == 2) {
				$da['delivery_price'] = iunserializer($da['delivery_price']);
				$da['delivery_price'] = $da['delivery_price']['start_fee'];
			} elseif($da['delivery_fee_mode'] == 3) {
				$da['delivery_areas'] = iunserializer($da['delivery_areas']);
				if(!is_array($da['delivery_areas'])) {
					$da['delivery_areas'] = array();
				}
				$price = store_order_condition($da, array($lng, $lat));
				$da['delivery_price'] = $price['delivery_price'];
				$da['send_price'] = $price['send_price'];
				$da['delivery_free_price'] = $price['delivery_free_price'];
			}
			$da['activity'] = store_fetch_activity($da['id']);
			if($da['delivery_free_price'] > 0) {
				$da['activity']['items']['delivery'] = array(
					'title' => "满{$da['delivery_free_price']}免配送费",
					'type' => "delivery"
				);
				$da['activity']['num'] += 1;
			}
			$da['activity']['items'] = array_values($da['activity']['items']);

			$da['distance'] = round($da['distance']/1000, 1);
			if(!empty($lng) && !empty($lat)) {
				$in = is_in_store_radius($da, array($lng, $lat));
				if($config_mall['store_overradius_display'] == 2 && !$in) {
					unset($stores[$key]);
				}
			}
			unset($da['delivery_areas']);
		}
	}
	$result = array(
		'stores' => array_values($stores),
		'total' => $total,
		'pagetotal' => $pagetotal,
	);
	return $result;
}

function store_page_get($sid, $id = 0) {
	global $_W;
	$condition = ' WHERE uniacid = :uniacid and sid = :sid';
	$params = array(':uniacid' => $_W['uniacid'], ':sid' => $sid);
	if(empty($id)) {
		$condition .= ' and type = :type';
		$params[':type'] = 'home';
	} else {
		$condition .= ' and id = :id';
		$params[':id'] = $id;
	}
	$page = pdo_fetch('SELECT * FROM ' . tablename('tiny_wmall_store_page') . $condition, $params);
	if(!empty($page)) {
		$page['data'] = json_decode(base64_decode($page['data']), true);
		foreach($page['data']['items'] as $itemid => &$item) {
			if(in_array($item['id'], array('picture', 'operation', 'onsale', 'banner'))) {
				foreach($item['data'] as &$val) {
					if($item['id'] == 'onsale') {
						$val['thumb'] = tomedia($val['thumb']);
					} else {
						$val['imgurl'] = tomedia($val['imgurl']);
					}
				}
			}
			elseif(in_array($item['id'], array('copyright', 'img_card'))) {
				$item['params']['imgurl'] = tomedia($item['params']['imgurl']);
			} elseif($item['id'] == 'richtext') {
				$item['params']['content'] = base64_decode($item['params']['content']);
			} elseif($item['id'] == 'info') {
				$store = store_fetch($sid, array('id', 'title', 'logo', 'business_hours', 'send_price', 'delivery_price', 'telephone', 'address', 'is_rest', 'location_x', 'location_y', 'consume_per_person'));
				$item['data'] = $store;
			} elseif($item['id'] == 'coupon') {
				mload()->model('coupon');
				$coupon = coupon_collect_member_available($sid);
				if(!empty($coupon)) {
					$coupon['can_collect'] = 1;
					$coupon['endtime_cn'] = date('Y-m-d', $coupon['endtime']);
					$coupon['collect_percent'] = round($coupon['dosage'] / $coupon['amount'], 2) * 100;
				} else {
					$coupon['can_collect'] = 0;
					$records = pdo_fetchall('select a.id,a.discount,a.condition,a.endtime,a.sid,b.title from' . tablename('tiny_wmall_activity_coupon_record') . ' as a left join ' . tablename('tiny_wmall_activity_coupon') . ' as b on a.couponid = b.id where a.uniacid = :uniacid and a.status = 1 and a.sid = :sid and a.uid = :uid', array(':uniacid' => $_W['uniacid'], ':sid' => $sid, ':uid' => $_W['member']['uid']));
					foreach($records as &$record) {
						$record['endtime_cn'] = date('Y-m-d', $record['endtime']);
					}
					$coupon['record'] = $records;

				}
				$item['data'] = $coupon;
				if(empty($item['data'])) {
					unset($page['data']['items'][$itemid]);
				}
			} elseif($item['id'] == 'onsale') {
				if($item['params']['goodsdata'] == '0') {
					if(!empty($item['data']) && is_array($item['data'])) {
						$goodsids = array();
						foreach($item['data'] as $data) {
							if(!empty($data['goods_id'])) {
								$goodsids[] = $data['goods_id'];
							}
						}
						if(!empty($goodsids)) {
							$item['data'] = array();
							$goodsids_str = implode(',', $goodsids);
							$goods = pdo_fetchall('select a.*, b.title as store_title from ' . tablename('tiny_wmall_goods') . ' as a left join ' . tablename('tiny_wmall_store') .
								" as b on a.sid = b.id where a.uniacid = :uniacid and a.status = 1 and b.agentid = :agentid and a.id in ({$goodsids_str}) order by a.displayorder desc", array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']));
						}
					}
				} elseif($item['params']['goodsdata'] == '1') {
					$item['data'] = array();
					$condition = ' where a.uniacid = :uniacid and a.agentid = :agentid and a.sid = :sid and a.status= 1';
					$params = array(
						':uniacid' => $_W['uniacid'],
						':agentid' => $_W['agentid'],
						':sid' => $sid,
					);
					$limit = intval($item['params']['goodsnum']);
					$limit = $limit ? $limit : 4;
					$goods = pdo_fetchall('select a.discount_price,a.goods_id,a.discount_available_total,b.* from ' . tablename('tiny_wmall_activity_bargain_goods') . ' as a left join ' . tablename('tiny_wmall_goods') . " as b on a.goods_id = b.id {$condition} order by a.mall_displayorder desc limit {$limit}", $params);
					if(!empty($goods)) {
						$stores = pdo_fetchall('select distinct(a.sid),b.title as store_title,b.is_rest from ' . tablename('tiny_wmall_activity_bargain') . ' as a left join ' . tablename('tiny_wmall_store') . ' as b on a.sid = b.id where a.uniacid = :uniacid and a.agentid = :agentid and a.status = 1', array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']), 'sid');
					}
				} elseif($item['params']['goodsdata'] == '2') {
					$item['data'] = array();
					$limit = intval($item['params']['goodsnum']);
					$limit = $limit ? $limit : 4;
					$goods = pdo_fetchall('select a.*, b.title as store_title from ' . tablename('tiny_wmall_goods') . ' as a left join ' . tablename('tiny_wmall_store') .
						" as b on a.sid = b.id where a.uniacid = :uniacid and a.status = 1 and b.agentid = :agentid and a.is_hot = 1 order by a.displayorder desc limit {$limit}", array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid']));
				}
				if(!empty($goods)) {
					foreach($goods as $good) {
						$childid = rand(1000000000, 9999999999);
						$childid = "C{$childid}";
						$item['data'][$childid] = array(
							'goods_id' => $good['id'],
							'sid' => $good['sid'],
							'store_title' => $item['params']['goodsdata'] == '1' ? $stores[$good['sid']]['store_title'] : $good['store_title'],
							'thumb' => tomedia($good['thumb']),
							'title' => $good['title'],
							'price' => $good['price'],
							'old_price' => $good['old_price'] ? $good['old_price'] : $good['price'],
							'sailed' => $good['sailed'],
							'total' => ($good['total'] != -1 ? $good['total'] : '无限'),
							'discount' => ($good['old_price'] == 0 ? 0 : (round(($good['price'] / $good['old_price']) * 10, 1))),
							'comment_good_percent' => ($good['comment_total'] == 0 ? 0 : (round(($good['comment_good'] / $good['comment_total']) * 100, 2) . "%")),
						);
						if($item['params']['goodsdata'] == '1') {
							$item['data'][$childid]['price'] = $good['discount_price'];
							$item['data'][$childid]['old_price'] = $good['price'];
							$item['data'][$childid]['discount'] = round(($good['discount_price'] / $good['price'] * 10), 1);
						}
					}
				}
				if(empty($item['data'])) {
					unset($page['data']['items'][$itemid]);
				}
			} elseif($item['id'] == 'evaluate') {
				$condition = " where uniacid = :uniacid and agentid = :agentid and sid = :sid and status= 1 order by score desc limit 8";
				$params = array(
					':uniacid' => $_W['uniacid'],
					':agentid' => $_W['agentid'],
					':sid' => $sid,
				);
				$item['data'] = array();
				$comments = pdo_fetchall('select * from ' . tablename('tiny_wmall_order_comment') . $condition, $params);
				if(!empty($comments)) {
					foreach($comments as $comment) {
						if(!empty($comment['thumbs'])) {
							$comment['thumbs'] = iunserializer($comment['thumbs']);
							foreach($comment['thumbs'] as &$val) {
								$val = tomedia($val);
							}
						}
						$comment['data'] = iunserializer($comment['data']);
						$comment['goods_title'] = array_merge($comment['data']['good'], $comment['data']['bad']);
						$comment['avatar'] = tomedia($comment['avatar']);
						$childid = rand(1000000000, 9999999999);
						$childid = "C{$childid}";
						$item['data'][$childid] = array(
							'note' => $comment['note'],
							'thumbs' => $comment['thumbs'],
							'goods_title' => $comment['goods_title'],
							'goods_title_str' => implode(' ', $comment['goods_title']),
							'mobile' => $comment['mobile'],
							'avatar' => $comment['avatar'],
							'reply' => $comment['reply'],
							'score_original' => $comment['score'],
							'score' => score_format($comment['score'] / 2),
							'replytime' => $comment['replytime'],
							'replytime_cn' => date('Y-m-d H:i', $comment['replytime']),
							'addtime' => $comment['addtime'],
							'addtime_cn' => date('Y-m-d H:i', $comment['addtime'])
						);
					}
				}
				if(empty($item['data'])) {
					unset($page['data']['items'][$itemid]);
				}
			} elseif($item['id'] == 'picturew' && !empty($item['data'])) {
				foreach($item['data'] as &$v) {
					$v['imgurl'] = tomedia($v['imgurl']);
				}
				$item['data_num'] = count($item['data']);
				if($item['params']['row'] == 1) {
					$item['data'] = array_values($item['data']);
				} else {
					if($item['params']['showtype'] == 1 && count($item['data']) > $item['params']['pagenum']) {
						$item['data'] = array_chunk($item['data'], $item['params']['pagenum']);
						$item['style']['rows_num'] = ceil($item['params']['pagenum']/$item['params']['row']);
						$row_base_height = array(
							'2' => 122,
							'3' => 85,
							'4' => 65,
						);
						$item['style']['base_height'] = $row_base_height[$item['params']['row']];
					}
				}
			}
		}
	}
	return $page;
}


