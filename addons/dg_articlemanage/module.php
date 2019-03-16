<?php
/**
 * 课程管理模块定义
 *
 * @author 夺冠
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class Dg_articlemanageModule extends WeModule {
	public function fieldsFormDisplay($rid = 0) {
		//要嵌入规则编辑页的自定义内容，这里 $rid 为对应的规则编号，新增时为 0
	}

	public function fieldsFormValidate($rid = 0) {
		//规则编辑保存时，要进行的数据验证，返回空串表示验证无误，返回其他字符串将呈现为错误提示。这里 $rid 为对应的规则编号，新增时为 0
		return '';
	}

	public function fieldsFormSubmit($rid) {
		//规则验证无误保存入库时执行，这里应该进行自定义字段的保存。这里 $rid 为对应的规则编号
	}

	public function ruleDeleted($rid) {
		//删除规则时调用，这里 $rid 为对应的规则编号
	}

	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		//点击模块设置时将调用此方法呈现模块设置页面，$settings 为模块设置参数, 结构为数组。这个参数系统针对不同公众账号独立保存。
		//在此呈现页面中自行处理post请求并保存设置参数（通过使用$this->saveSettings()来实现）
		empty($settings['dg_article_recharge'])&&$settings['dg_article_recharge']="5.00";
		empty($settings['dg_article_recharge_qua'])&&$settings['dg_article_recharge_qua']="5.00";
		empty($settings['dg_article_recharge_year'])&&$settings['dg_article_recharge_year']="5.00";
		empty($settings['dg_article_scale'])&&$settings['dg_article_scale']="0.3";
		empty($settings['center_intro']) && $settings['center_intro']="成为会员可以免费阅读需要付费的课程";
		empty($settings['dg_article_title']) && $settings['dg_article_title']=$_W['account']['name']."付费阅读";
		empty($settings['dg_article_num']) && $settings['dg_article_num']=20;
		empty($settings['shang_status']) && $settings['shang_status']=1;
		if(checksubmit()) {
			//字段验证, 并获得正确的数据$dat
			$dat['dg_article_recharge']=$_GPC['dg_article_recharge'];
			$dat['dg_article_recharge_qua']=$_GPC['dg_article_recharge_qua'];
			$dat['dg_article_recharge_year']=$_GPC['dg_article_recharge_year'];
			$dat['dg_article_scale']=$_GPC['dg_article_scale'];
			$dat['dg_article_title']=$_GPC['dg_article_title'];
			$dat['dg_article_num']=$_GPC['dg_article_num'];
			$dat['center_intro']=$_GPC['center_intro'];
			$dat['pay_template']=$_GPC['pay_template'];
			$dat['qrcode_desc']=$_GPC['qrcode_desc'];
			$dat['shang_status']=$_GPC['shang_status'];
			$dat['app_id']=$_GPC['app_id'];
			$dat['api_key']=$_GPC['api_key'];
			$dat['secret_key']=$_GPC['secret_key'];
			$dat['article_copy']=$_GPC['article_copy'];

			
			if (!$this->saveSettings($dat)) {
				message('设置失败','','error');
			} else {
				message('设置成功','','success');
			}
		}
		//这里来展示设置项表单
		include $this->template('setting');
	}

}