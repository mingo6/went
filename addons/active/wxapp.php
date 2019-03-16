<?php
/**
 * 小程序测试模块小程序接口定义
 *
 * @author zofui
 * @url 
 */
global $_W;
defined('IN_IA') or exit('Access Denied');
define('ST_ROOT',IA_ROOT.'/addons/gt_answer/');
define('ST_URL',$_W['siteroot'].'addons/gt_answer/');
define('MODULE','gt_answer');
require_once(ST_ROOT.'class/autoload.php');

class ActiveModuleWxapp extends WeModuleWxapp {

	//public $token = 'aaaa';

	/*public function doPageTest(){
		global $_GPC, $_W;
		$errno = 0;
		$message = '返回消息';
		$data = array();
		return $this->result($errno, $message, $data);
	}*/
	

	/*
		接口规则
		return $this->result($errno, $message, $data);
		$errno = 0,正常
		$errno = 1,错误
		
	*/

}