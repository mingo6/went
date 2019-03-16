<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
mload()->model('sms');
global $_W, $_GPC;

$sid = intval($_GPC['sid']);
$mobile = trim($_GPC['mobile']);
if($mobile == ''){
	exit('请输入手机号');
}

if(!preg_match(IREGULAR_MOBILE, $mobile)) {
	exit('手机号格式错误');
}

$captcha = trim($_GPC['captcha']);
$hash = md5($captcha . $_W['config']['setting']['authkey']);
if($_GPC['__code'] != $hash) {
	exit('图形验证码错误, 请重新输入');
}

$sql = 'DELETE FROM ' . tablename('uni_verifycode') . ' WHERE `createtime`<' . (TIMESTAMP - 1800);
pdo_query($sql);

$sql = 'SELECT * FROM ' . tablename('uni_verifycode') . ' WHERE `receiver`=:receiver AND `uniacid`=:uniacid';
$pars = array();
$pars[':receiver'] = $mobile;
$pars[':uniacid'] = $_W['uniacid'];
$row = pdo_fetch($sql, $pars);
$record = array();
if(!empty($row)) {
	if($row['total'] >= 20) {
		exit('您的操作过于频繁,请稍后再试');
	}
	$code = $row['verifycode'];
	$record['total'] = $row['total'] + 1;
} else {
	$code = random(6, true);
	$record['uniacid'] = $_W['uniacid'];
	$record['receiver'] = $mobile;
	$record['verifycode'] = $code;
	$record['total'] = 1;
	$record['createtime'] = TIMESTAMP;
}
if(!empty($row)) {
	pdo_update('uni_verifycode', $record, array('id' => $row['id']));
} else {
	pdo_insert('uni_verifycode', $record);
}
$content = array(
	'code' => $code,
	//'product' => trim($_GPC['product'])
);
$config_sms = $_W['we7_wmall']['config']['sms']['template'];

//创蓝短信
mload()->classs('Sms');
global $_W;
$config_sms = $_W["we7_wmall"]["config"]["sms"];

if( !is_array($config_sms["set"]) ) return exit("平台没有设置短信参数");
if( empty($config_sms["set"]["status"]) ) return exit("平台已关闭短信功能");
$sms = new Sms($config_sms["set"]['key'],$config_sms["set"]['secret']);
$result = $sms->sendSMS($mobile, "尊敬的用户,您的短信验证码为:".$code."；10分钟内有效！");
if (!$result)exit('短信发送失败，请稍后重试！');
//$result = sms_send($config_sms['verify_code_tpl'], $mobile, $content, $sid);
//if(is_error($result)) {
//	slog('alidayuSms', '阿里大鱼短信通知验证码', $content, $result['message']);
//	exit($result['message']);
//}
exit('success');