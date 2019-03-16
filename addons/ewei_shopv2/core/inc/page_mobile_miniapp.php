<?php
if (!defined('IN_IA')) 
{
	exit('Access Denied');
}
class MobileMiniappPage
{
	static $APPID = 'wx5242e35d2b828a36';
	static $APPSECRET = 'bc827347af714c172c4668bc4e7128cf';

	public function __construct() 
	{
		global $_W;
		global $_GPC;
	}

	public function getPayInfo()
	{
		list(, $paymentinfo) = m('common')->public_build();
		if(empty($paymentinfo))
		{
			return false;
		}
		self::$APPID = $paymentinfo['miniapp_appid'];
		self::$APPSECRET = $paymentinfo['miniapp_secret'];
		return $paymentinfo;
	}
}
?>