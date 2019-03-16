<?php 
	defined('IN_IA') or exit('Access Denied');
	global $_W,$_GPC;

	if( $_W['ispost'] ) {

		$content = htmlspecialchars_decode( $_GPC['data'] );

		$data = json_decode( $content,true );

		if( empty( $data ) ) $this->result(1,'请提交数据');

		/*foreach ( $data as $k => $v ) {
			if( empty( $v ) ) $this->result(1,'请填写'.$k);
		}*/


		$indata = array(
			'uniacid' => $_W['uniacid'],
			'data' => iserializer( $data ),
			'createtime' => TIMESTAMP
		);

		$res = pdo_insert('zofui_sitetemp_form',$indata);

		if( $res ){

			// 给管理员发消息
			if( !empty( $this->module['config']['mail'] ) ) {
				$body = array('有人提交了一项表单数据，请查收');
				if( !empty( $data ) ){
					foreach ( $data as $k => $v ) {
						if( is_array( $v ) ){
							$in = '';
							foreach ($v as $vv ) {
								$in .= $vv.'，';
							}
							$in = trim($in,'，');
							$item = $k.'：'.$in;
						}else{
							$item = $k.'：'.$v;
						}
						$body[] = $item;
					}
				}
				Util::ihttp_email($this->module['config']['mail'], '表单通知', $body);
			}
			
			$this->result(0, '已提交');
		}

		
	}


	
	
	$this->result(1, '提交失败');