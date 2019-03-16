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
$ta = trim($_GPC['ta']) ? trim($_GPC['ta']) : 'index';
if($ta == 'index') {
	$sid = intval($_GPC['sid']);
	mload()->model('page');
	$homepage = store_page_get($sid);
	imessage(error(0, array('homepage' => $homepage['data'], 'store_id' => $sid)), '', 'ajax');
}
