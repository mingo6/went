<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
$op = trim($_GPC['op']);
if($op == 'link') {
	$getScene = trim($_GPC['scene']);
	if(empty($getScene)){
		$getScene = 'page';
	}
	$data = wxapp_urls();
	if($getScene == 'menu') {
		unset($data['errander']['business']);
		unset($data['errander']['scene']);
	}
	if($getScene != 'store') {
		unset($data['other']['table']);
	}
	include itemplate('public/wxappLink');
}
elseif($op == 'icon') {
	include itemplate('public/wxappIcon');
}
