<?php 
	defined('IN_IA') or exit('Access Denied');
	global $_W,$_GPC;

	if( $_W['ispost'] && empty( $_GPC['op'] ) ) {

		if( empty( $_W['openid'] ) ) $this->result(2,'您的会员数据不存在');
		if( empty( $_GPC['scene'] ) ) $this->result(2,'已过期,请重新扫码');
		
		$scene = Util::getCache('scene','all');
		if( empty( $scene ) || $scene['time'] < TIMESTAMP ) $this->result(2,'已过期,请重新扫码');
		
		if( $_GPC['scene'] != $scene['id'] ) $this->result(2,'已过期,请重新扫码');

		$isset = pdo_get('zofui_sitetemp_admin',array('uniacid'=>$_W['uniacid'],'openid'=>$_W['openid']));
		if( !empty( $isset ) ) $this->result(2,'您已经绑定过了');

	}

	if( empty( $_GPC['op'] ) ){

		$this->result(0, '绑定');

	}elseif( $_GPC['op'] == 'bind' ){

		$data = array(
			'uniacid' => $_W['uniacid'],
			'openid' => $_W['openid'],
		);
		$res = pdo_insert('zofui_sitetemp_admin',$data);
		
		if( $res ) {
			Util::deleteCache('scene','all');
			$this->result(0, '已绑定');
		}
		$this->result(1, '绑定失败,请扫码重试');
	}


	
	
	$this->result(1, '已过期,请重新扫码');