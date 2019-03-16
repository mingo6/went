<?php
/**
 * 企业官网DIY模块定义
 *
 * @author 众惠科技
 * @url http://bbs.we7.cc/
 */
global $_W;
defined('IN_IA') or exit('Access Denied');
define('ST_ROOT',IA_ROOT.'/addons/gt_answer/');
define('ST_URL',$_W['siteroot'].'addons/gt_answer/');
define('MODULE','gt_answer');
require_once(ST_ROOT.'class/autoload.php');

class Gt_answerModule extends WeModule {

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
		
		//设置模板id
		/*if( empty( $settings['mid'] ) ) {

			load() -> model('account');
			$account = WeAccount::create( $_W['acid'] );
			$access_token = $account->getAccessToken();	

			if( !empty( $access_token ) ) {
				$res = $this->getMidList($access_token,0,20);

				$res = json_decode($res,true);
				if( !empty( $res ) && $res['errmsg'] == 'ok' && $res['errcode'] == '0' && !empty( $res['list'] ) ) {

					foreach ($res['list'] as $v ) {
						if( $v['title'] == '待办事务提醒' ) {
							$template_id = $v['template_id'];
							$isset = 1;
							break;
						}
					}

					// 查余下的5个
					if( !$isset && count( $res['list'] ) >= 20 ){
						$res = $this->getMidList($access_token,20,5);

						$res = json_decode($res,true);
						if( !empty( $res ) && $res['errmsg'] == 'ok' && $res['errcode'] == '0' && !empty( $res['list'] ) ) {

							foreach ($res['list'] as $v ) {
								if( $v['title'] == '待办事务提醒' ) {
									$template_id = $v['template_id'];
									$isset = 1;
									break;
								}

							}
						}
					}
				}
				if( !$isset ) { // 不存在 加入
					$url = 'https://api.weixin.qq.com/cgi-bin/wxopen/template/add?access_token='.$access_token;
					$res = Util::httpPost( $url , json_encode( array('id'=>'AT0279','keyword_id_list'=>array(16,17)) ) );

					$res = json_decode( $res , true );
					if( !empty( $res['template_id'] ) ) {
						$template_id = $res['template_id'];
					}
				}

				if( !empty( $template_id ) ) {
					$settings['mid'] = $template_id;
					$this->saveSettings($settings);
				}
			}
		}*/
		include $this->template('web/setting');
	}
	
	public function getMidList($token,$start,$num){
		$url = 'https://api.weixin.qq.com/cgi-bin/wxopen/template/list?access_token='.$token;
		$res = Util::httpPost( $url , json_encode( array('offset'=>$start,'count'=>$num) ) );
		return $res;
	}
}