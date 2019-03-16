<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
load()->func('communication');
global $_W, $_GPC;
$ta  = trim($_GPC['ta']);

if($ta == 'regeo_qq') {
	$query = array(
		'output' => 'json',
		'get_poi' => 1,
		'key' => '2ECBZ-DXGLS-26MOI-6XMGC-QLTA6-SYFYL',
		'location' => "{$_GPC['latitude']},{$_GPC['longitude']}"
	);
	$query = http_build_query($query);
	$result = ihttp_get('http://apis.map.qq.com/ws/geocoder/v1/?' . $query);
	if(is_error($result)) {
		imessage(error(-1, '访问出错'), '', 'ajax');
	}
	$result = @json_decode($result['content'], true);
	if($result['status'] != 0) {
		imessage(error(-1, $result['message']), '', 'ajax');
	}
	$result = $result['result'];
	$data = array(
		'address' => $result['formatted_addresses']['recommend'],
		'location_x' => $result['location']['lat'],
		'location_y' => $result['location']['lng'],
		'latitude' => $result['location']['lat'],
		'longitude' => $result['location']['lng'],
		'locations' => "{$result['location']['lng']}, {$result['location']['lat']}",
	);
	foreach($result['pois'] as &$item) {
		$item['location_y'] = $item['location']['lng'];
		$item['location_x'] = $item['location']['lat'];
		$item['name'] = $item['title'];
		$item['address'] = $item['address'];
	}
	$data['pois'] = $result['pois'];
	imessage(error(0, $data), '', 'ajax');
}
elseif($ta == 'regeo') {
	$latitude = trim($_GPC['latitude']);
	$longitude = trim($_GPC['longitude']);
	$convert = intval($_GPC['convert']);
	if($convert)  {
		//转换坐标系
		$result = ihttp_post('http://restapi.amap.com/v3/assistant/coordinate/convert?parameters',  array('locations' => "{$longitude},{$latitude}", 'coordsys' => 'gps', 'key' => '37bb6a3b1656ba7d7dc8946e7e26f39b'));
		if(is_error($result)) {
			imessage(error(-1, "{$result['message']}"), '', 'ajax');
		}
		$respon = @json_decode($result['content'], true);
		$locations = $respon['locations'];
	} else {
		$locations = "{$longitude},{$latitude}";
	}
	//地址转换
	$query = array(
		'output' => 'json',
		'extensions' => 'all',
		'key' => '37bb6a3b1656ba7d7dc8946e7e26f39b',
		'location' => $locations,
	);
	$query = http_build_query($query);
	$result = ihttp_get('http://restapi.amap.com/v3/geocode/regeo?' . $query);
	if(is_error($result)) {
		imessage(error(-1, '访问出错'), '', 'ajax');
	}
	$result = @json_decode($result['content'], true);
	if(!empty($result['regeocode']['addressComponent']['neighborhood']['name'])) {
		$address = $result['regeocode']['addressComponent']['neighborhood']['name'];
	} elseif(!empty($result['regeocode']['aois'][0])) {
		$address = $result['regeocode']['aois'][0]['name'];
	} else {
		$address = str_replace(array($result['regeocode']['addressComponent']['province'], $result['regeocode']['addressComponent']['district'], $result['regeocode']['addressComponent']['city'], $result['regeocode']['addressComponent']['township']), '', $result['regeocode']['formatted_address']);
	}
	foreach($result['regeocode']['pois'] as &$item) {
		$itemold = $item;
		$location = explode(',', $item['location']);
		$item['location_y'] = $location[0];
		$item['location_x'] = $location[1];
		$item['name'] = $itemold['address'];
		$item['address'] = $itemold['name'];
	}

	$result['address'] = $address;
	$result['pois'] = $result['regeocode']['pois'];
	$result['aois'] = $result['regeocode']['aois'];
	$result['locations'] = $locations;
	$loc = explode(',', $locations);
	$result['location_y'] = $result['longitude'] = $loc[0];
	$result['location_x'] = $result['latitude'] = $loc[1];
	imessage(error(0, $result), '', 'ajax');
}
elseif($ta == 'place_around') {
	$latitude = trim($_GPC['latitude']);
	$longitude = trim($_GPC['longitude']);
	$query = array(
		'output' => 'json',
		'extensions' => 'all',
		'key' => '37bb6a3b1656ba7d7dc8946e7e26f39b',
		'location' => "{$longitude},{$latitude}",
		'keywords' => $_GPC['keywords'],
	);
	if(!empty($_GPC['city'])) {
		$query['city'] = $_GPC['city'];
	}
	if(!empty($_GPC['radius'])) {
		$query['radius'] = $_GPC['radius'];
	}
	if(!empty($_GPC['sortrule'])) {
		$query['sortrule'] = $_GPC['sortrule'];
	}
	$query = http_build_query($query);
	$result = ihttp_get('http://restapi.amap.com/v3/place/around?' . $query);
	if(is_error($result)) {
		imessage(error(-1, '访问出错'), '', 'ajax');
	}
	$result = @json_decode($result['content'], true);
	if(!empty($result['pois'])) {
		foreach($result['pois'] as &$item) {
			$itemold = $item;
			$location = explode(',', $item['location']);
			$item['location_y'] = $location[0];
			$item['location_x'] = $location[1];
			$item['name'] = $itemold['address'];
			$item['address'] = $itemold['name'];
		}
	}
	imessage(error(0, $result['pois']), '', 'ajax');
}

elseif($ta == 'suggestion_qq') {
	$key = trim($_GPC['key']);
	$query = array(
		'key' => '2ECBZ-DXGLS-26MOI-6XMGC-QLTA6-SYFYL',
		'keyword' => $key,
		'region' => '全国',
		'region_fix' => 1,
		'output' => 'json',
	);
	$city = trim($_GPC['city']);
	if(!empty($city)) {
		$query['region'] = $city;
	} else {
		$plugin = trim($_GPC['plugin']) ? trim($_GPC['plugin']) : 'takeout';
		$config = $_W['we7_wmall']['config'];
		if($plugin == 'takeout') {
			$city = $config['takeout']['range']['city'];
		} elseif($plugin == 'errander') {
			$city = get_plugin_config('errander.city');
		}
		$query['region'] = $city;
	}

	$query = http_build_query($query);
	$result = ihttp_get('http://apis.map.qq.com/ws/place/v1/suggestion?' . $query);
	if(is_error($result)) {
		imessage(error(-1, '访问出错'), '', 'ajax');
	}
	$result = @json_decode($result['content'], true);
	if($result['status'] != 0) {
		imessage(error(-1, $result['message']), '', 'ajax');
	}
	if(!empty($result['data'])) {
		foreach($result['data'] as $key => &$val) {
			$val['name'] = $val['title'];
			$val['address'] = $val['address'];
			$val['lng'] = $val['location_y'] = $val['location']['lng'];
			$val['lat'] = $val['location_x'] = $val['location']['lat'];
		}
	}
	imessage(error(0, $result['data']), '', 'ajax');
}

elseif($ta == 'suggestion') {
	$key = trim($_GPC['key']);
	$query = array(
		'keywords' => $key,
		'city' => '全国',
		'output' => 'json',
		'key' => '37bb6a3b1656ba7d7dc8946e7e26f39b',
		'citylimit' => 'true',
	);

	$city = trim($_GPC['city']);
	if(!empty($city)) {
		$query['city'] = $city;
	} else {
		$plugin = trim($_GPC['plugin']) ? trim($_GPC['plugin']) : 'takeout';
		$config = $_W['we7_wmall']['config'];
		if($plugin == 'takeout') {
			$city = $config['takeout']['range']['city'];
		} elseif($plugin == 'errander') {
			$city = get_plugin_config('errander.city');
		}
		$query['city'] = $city;
	}

	$query = http_build_query($query);
	$result = ihttp_get('http://restapi.amap.com/v3/assistant/inputtips?' . $query);
	if(is_error($result)) {
		imessage(error(-1, '访问出错'), '', 'ajax');
	}
	$result = @json_decode($result['content'], true);
	if(!empty($result['tips'])) {
		$distance_sort = 0;
		foreach($result['tips'] as $key => &$val) {
			$valold = $val;
			$val['name'] = $valold['address'];
			$val['address'] = $valold['name'];
			if(is_array($val['location'])) {
				unset($val[$key]);
			} else {
				$location = explode(',', $val['location']);
				$val['lng'] = $val['location_y'] = $location[0];
				$val['lat'] = $val['location_x'] = $location[1];
			}
			if(!is_array($val['address'])) {
				$val['address'] = $val['district'] . $val['address'];
			} else {
				$val['address'] = $val['district'];
			}
		}
	}
	imessage(error(0, $result['tips']), '', 'ajax');
}
