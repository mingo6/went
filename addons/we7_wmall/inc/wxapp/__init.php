<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
mload()->model('common');
mload()->func('app');
mload()->model('member');
mload()->model('store');
mload()->model('order');
$_W['we7_wmall']['global'] = get_global_config();
if($_W['we7_wmall']['global']['development'] == 1) {
	ini_set('display_errors', '1');
	error_reporting(E_ALL ^ E_NOTICE);
}
$_W['is_agent'] = is_agent();
$_W['agentid'] = 0;
if($_W['is_agent']) {
	mload()->model('agent');
	if((in_array($_GPC['ctrl'], array('wmall')) && in_array($_GPC['ac'], array('home', 'channel'))) || in_array($_GPC['ctrl'], array('errander'))) {
		if($_GPC['ac'] == 'home' && !empty($_GPC['lat'])) {
			//选择收货地址场景
			$location = array($_GPC['lat'], $_GPC['lng']);
			$_W['agentid'] = get_location_agent($location[0], $location[1]);
		}
		if($_W['agentid'] <= 0) {
			$location = array($_GPC['__lat'], $_GPC['__lng']);
			$_W['agentid'] = get_location_agent($location[0], $location[1]);
		}
		$_W['agent'] = get_agent($_W['agentid'], array('id', 'area'));
	}
}

$_W['we7_wmall']['config'] = get_system_config();
$_config_mall = $_W['we7_wmall']['config']['mall'];
if(empty($_config_mall['delivery_title'])) {
	$_config_mall['delivery_title'] = '平台专送';
}
$config_close = $_W['we7_wmall']['config']['close'];
$_W['we7_wxapp']['config'] = get_plugin_config('wxapp');
if(empty($_W['we7_wxapp']['config']['basic']['release_version'])) {
	$_W['we7_wxapp']['config']['basic']['release_version'] = '8.0';
}
$_W['we7_wxapp']['config']['basic']['request_version'] = floatval($_GPC['v']) ? floatval($_GPC['v']) : '8.0';

$config_wxapp = $_config_wxapp = $_W['we7_wxapp']['config'];
if(($config_close['status'] == 2 || !$config_wxapp['basic']['status']) && $_W['_controller'] == 'wmall') {
	$config_close['tips'] = !empty($config_close['tips']) ? $config_close['tips'] : '亲,平台休息中。。。';
	imessage(error(-3000, $config_close['tips']), 'close', 'ajax');
}
$_W['role'] = 'consumer';
$_W['role_cn'] = '下单顾客';


