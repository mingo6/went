<?php
/**
 * 课程管理模块处理程序
 *
 * @author 夺冠
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class Dg_articlemanageModuleProcessor extends WeModuleProcessor {
	public function respond() {
		global $_W,$_GPC;
		$rid=$this->rule;
		$uniacid=$_W["uniacid"];
		$scenestr = $this->message ['content'];
		
		if(($this->message['event']=='subscribe'||$this->message['event'] == 'SCAN')&&!empty($scenestr)){
			//$user_info=$this->getUserInfo();
			$from  = $this->message ['from'];//扫码人的openid

			$i=strpos($scenestr,'_uid');
			//$topic_id=substr($scenestr,8,$i-8);//房间名
			$fopenid=substr($scenestr,$i+4);//用户id;
			$u = pdo_get("dg_article_user",array("fopenid"=>$fopenid));
			if(!empty($db_u) && !empty($db_u['fopenid'])){
				return $this->respText('不能被重复邀请');
			}
			$u = pdo_get("dg_article_user",array("openid"=>$fopenid));
			if(!empty($u) && $u['openid']==$from){
				return $this->respText('不能邀请自己');
			}
	 		$share=pdo_fetch("SELECT * FROM ".tablename("dg_article_share")." WHERE uniacid=:uniacid",array(":uniacid"=>$uniacid));
			$shareimg=tomedia($share['shareimg']);
			$sharedesc=$share['sharedesc'];
			$sharetitle=$share['sharetitle'];
			return $this->respNews(array(
					'Title' => $sharetitle,
					'Description' => $sharedesc,
					'PicUrl' => tomedia($shareimg),
					'Url' => $this->createMobileUrl('new_index', array('fopenid'=>$fopenid))
			));
		}
	}
}