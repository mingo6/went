<?php
/**
 * 企业官网DIY模块定义
 *
 * @author 众惠科技
 * @url http://bbs.we7.cc/
 */

global $_W;
defined('IN_IA') or exit('Access Denied');
define('ST_ROOT',IA_ROOT.'/addons/active/');
define('ST_URL',$_W['siteroot'].'addons/active/');
define('MODULE','active');
require_once(ST_ROOT.'class/autoload.php');

class ActiveModule extends WeModule {

	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		$account = pdo_fetch('select settings from ' . tablename('uni_account_modules') .' where uniacid=:uniacid AND module=:module', array(':uniacid'=>$_W['uniacid'], ':module'=>$_W['current_module']['name']));
		$settings = unserialize($account['settings']);

		if(checksubmit('submit')) {
			$_GPC = Util::trimWithArray($_GPC);
			$dat = array(
				'lottery_count' => $_GPC['lottery_count'],
				'standard_score' => $_GPC['standard_score'],
				'roles' => $_GPC['roles'],
				'bg_music' => $_GPC['bg_music'],
				'visit' => $_GPC['visit'],
				'start_time' => strtotime($_GPC['start_time']),
				'end_time' => strtotime($_GPC['end_time']),
			);
			if($dat['start_time'] >= $dat['end_time']){
				message('开始时间不能大于结束时间！');
			}
			
			if ($this->saveSettings($dat)) {
                message('保存成功', 'refresh');
            }
		}
		include $this->template('web/setting');
	}
	
	public function getMidList($token,$start,$num){
		$url = 'https://api.weixin.qq.com/cgi-bin/wxopen/template/list?access_token='.$token;
		$res = Util::httpPost( $url , json_encode( array('offset'=>$start,'count'=>$num) ) );
		return $res;
	}
}