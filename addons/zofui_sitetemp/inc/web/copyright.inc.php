<?php 
	global $_W,$_GPC;
	

	if( $_W['role'] != 'founder' ) die;

	if( $_GPC['op'] == 'list' ){
		$temp = pdo_get('zofui_sitetemp_copyright');

		//批量删除
		if(checksubmit('create')){
			
			$data = array(
				'status' => $_GPC['status'],
				'content' => $_GPC['content'],
			);

			if( empty( $temp ) ) {
				pdo_insert('zofui_sitetemp_copyright',$data);
			}else{
				pdo_update('zofui_sitetemp_copyright',$data);
			}

			message('已保存',referer(),'success');

		}

	}elseif( $_GPC['op'] == 'mail' ){
		$temp = pdo_get('zofui_sitetemp_smtp');

		if(checksubmit('savemail')){
			
			$data = array(
				'type' => $_GPC['type'],
				'account' => $_GPC['account'],
				'pass' => $_GPC['pass'],
				'name' => $_GPC['name'],
				'sign' => $_GPC['sign'],
			);

			if( empty( $temp ) ) {
				pdo_insert('zofui_sitetemp_smtp',$data);
			}else{
				pdo_update('zofui_sitetemp_smtp',$data);
			}

			message('已保存',referer(),'success');

		}

	}


	
	include $this->template('web/copyright');