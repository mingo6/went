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
mload()->func('tpl.app');
mload()->model('member');
mload()->model('store');
mload()->model('order');
$_W['we7_wmall']['global'] = get_global_config();
if($_W['we7_wmall']['global']['development'] == 1) {
	ini_set('display_errors', '1');
	error_reporting(E_ALL ^ E_NOTICE);
}
$_W['is_agent'] = is_agent();
$_W['agentid'] = 0; //代表未获取过位置
if($_W['is_agent']) {
	mload()->model('agent');
	$_W['agentid'] = empty($_GPC['agentid'])?intval($_GPC['__agentid']):intval($_GPC['agentid']);

	if(in_array($_GPC['ctrl'], array('wmall')) && in_array($_GPC['ac'], array('home', 'channel'))) {
		if($_W['isajax']) {
			if($_GPC['ac'] == 'home' && !empty($_GPC['lat'])) {
				//选择收货地址场景
				$location = array($_GPC['lat'], $_GPC['lng']);
				$_W['agentid'] = get_location_agent($location[0], $location[1]);
			}
			if($_W['agentid'] <= 0) {
				$location = array($_GPC['__lat'], $_GPC['__lng']);
				$_W['agentid'] = get_location_agent($location[0], $location[1]);
			}
		}
		$_W['agent'] = get_agent($_W['agentid'], array('id', 'area'));
		if(!empty($_W['agent'])) {
			if($_W['agent']['id'] != $_GPC['__agentid']) {
				isetcookie('__agentid', $_W['agent']['id'], 900);
			}
		}
	} elseif(in_array($_GPC['ctrl'], array('errander'))) {
		if(empty($_W['agentid'])) {
			$_W['agentid'] = intval($_GPC['agentid']);
		}
		if($_W['agentid'] > 0) {
			$_W['agent'] = get_agent($_W['agentid'], array('id', 'area'));
		}
		if(($_W['agentid'] <= 0 || empty($_W['agent'])) && $_GPC['ac'] != 'agent') {
			if($_W['isajax']) {
				imessage(error(-1000, '请先选择代理'), '', 'ajax');
			}
			header('location:' . imurl('errander/agent'));
			die;
		}
		isetcookie('__agentid', $_W['agent']['id'], 900);
	}
}
$_W['we7_wmall']['config'] = get_system_config();
$_config_mall = $_W['we7_wmall']['config']['mall'];
if(empty($_config_mall['delivery_title'])) {
	$_config_mall['delivery_title'] = '平台专送';
}
$mobile_template = $_config_mall['template_mobile'];
if(empty($mobile_template) || $mobile_template == 'template') {
	$mobile_template = 'default';
}
$_W['we7_wmall']['config']['wxapp'] = get_plugin_config('wxapp');
$_W['mobile_tpl'] = $mobile_template;
define('WE7_WMALL_TPL_ROOT', WE7_WMALL_LOCAL . "/template/mobile/wmall/{$mobile_template}/");
define('WE7_WMALL_TPL_URL', WE7_WMALL_URL . "/template/mobile/wmall/{$mobile_template}/");
$_W['page']['title'] = $_config_mall['title'];
if(MODULE_FAMILY == 'wxapp' && $_GPC['ctrl'] == 'wmall') {
	imessage('您使用的是小程序版本,此功能为公众号版本特有,您没有使用该功能的权限');
}
$_W['role'] = 'consumer';
$_W['role_cn'] = '下单顾客';


