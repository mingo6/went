<?php 
	global $_W,$_GPC;
	load()->func('tpl');
	$acid = $_W['uniacid'];
	$openid = $_W['openid'];
	if($_W['isajax']){
		$data = array();
		$data['ticket'] ="";
		pdo_update('dg_article_user',$data,array('openid'=>$openid,'uniacid'=>$acid));
	}
	$result = pdo_get('dg_article_user',array('openid'=>$openid,'uniacid'=>$acid));
	if(empty($result['ticket'])){
		$uniacccount = WeAccount::create($acid);
		$txt = "adg-".$openid;
		$barcode['action_info']['scene']['scene_str'] = $txt;
		$barcode['action_name'] = 'QR_LIMIT_STR_SCENE';		
		$content = $uniacccount->barCodeCreateFixed($barcode);
		if(array_key_exists('ticket',$content)){
			$data = array();
			$ticket = $content['ticket'];
			$data['ticket'] = $content['ticket'];
			pdo_update('dg_article_user',$data,array('openid'=>$openid));
			$qrinsert=array(
			'ticket'=>$ticket,
			'keyword'=>$txt,
			'scene_str'=>$txt,
			'name'=>'付费代理邀请卡',
			'uniacid'=>$acid,
			'acid'=>$acid,
			'type'=>'scene'
			);
			if($_W['isajax']){
				$dataa = array();
				$dataa['ticket'] = $content['ticket'];
				pdo_update('qrcode',$dataa,array('scene_str'=>$txt));
			}else{
				pdo_insert('qrcode',$qrinsert);
			}
		
		}
	}else{
		$ticket = $result['ticket'];
	}
	$filename_true = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=". urlencode($ticket);
	include $this->template('create_invite');
 ?>