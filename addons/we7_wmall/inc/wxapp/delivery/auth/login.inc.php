<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;


if($_W['ispost']) {
	$mobile = trim($_GPC['mobile']) ? trim($_GPC['mobile']) : imessage(error(-1, '请输入手机号'), '', 'ajax');
	$deliveryer = pdo_get('tiny_wmall_deliveryer', array('uniacid' => $_W['uniacid'], 'mobile' => $mobile));
	if(empty($deliveryer)) {
		imessage(error(-1, '用户不存在'), '', 'ajax');
	}
	$password = md5(md5($deliveryer['salt'] . trim($_GPC['password'])) . $deliveryer['salt']);
	if($password != $deliveryer['password']) {
		imessage(error(-1, '用户名或密码错误'), '', 'ajax');
	}
	$result = array(
		'deliveryer' => $deliveryer
	);
	imessage(error(0, $result), '', 'ajax');
}
$config_mall = $_W['we7_wmall']['config']['mall'];
$result = array(
	'config' => array(
		'logo' => tomedia($config_mall['logo']),
		'title' => $config_mall['title'],
	)
);
imessage(error(0, $result), '', 'ajax');