<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
mload()->model('page');
global $_W, $_GPC;
$ta = trim($_GPC['ta']) ? trim($_GPC['ta']) : 'index';
$config_mall = $_W['we7_wmall']['config']['mall'];
icheckauth();

if($ta == 'index') {
	$helps = pdo_fetchall('select * from ' . tablename('tiny_wmall_help') . ' where uniacid = :uniacid order by displayorder desc, id asc' ,array(':uniacid' => $_W['uniacid']));
	$result = array(
		'helps' => $helps,
		'mobile' => $config_mall['mobile']
	);
	imessage(error(0, $result), '', 'ajax');
}