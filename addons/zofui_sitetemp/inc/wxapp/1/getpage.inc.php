<?php 
	defined('IN_IA') or exit('Access Denied');
	global $_W,$_GPC;
	$_W['set'] = $this->module['config'];
	$data = array();
	$pid = intval( $_GPC['pid'] );

	

	$where['uniacid'] = $_W['uniacid'];
	if( $pid > 0 ) { // 指定的页面
		$where['id'] = $pid;
	}else{ // 默认的页面

		$temp = model_temp::getTemp();

		if( !empty( $temp['id'] ) ) {
			$bar = pdo_get('zofui_sitetemp_bar',array('uniacid'=>$_W['uniacid'],'tempid'=>$temp['id']));
			if( !empty( $bar ) ) {
				$bar['data'] = iunserializer( $bar['data'] );
				$id = intval( $bar['data']['data'][0]['pageid'] );
				
				if( $id > 0 ){
					$where['id'] = $id;
				} 
			}
		}
	}
	
	$page = pdo_get('zofui_sitetemp_page',$where);
	$page['params'] = iunserializer( $page['params'] );
		
	
	if( !empty( $page['params']['data'] ) ) {

		foreach ( $page['params']['data'] as &$v ) {
			if( $v['name'] == 'text' ) {
				$v['params']['content'] = urldecode( $v['params']['content'] );
			}

			$article = array();
			if( $v['name'] == 'article' ) {

				$where = array('uniacid'=>$_W['uniacid']);
				if( !empty( $v['params']['sortid'] ) ) $where['sortid'] = $v['params']['sortid'];

				$info = Util::getAllDataInSingleTable('zofui_sitetemp_article',$where,1,3,' `number` DESC ',false,false,' id,img,title,time ');
				if( !empty( $info[0] ) ) {
					$v['artlist'] = array();
					foreach ( $info[0] as &$vv ) {
						$art = array();
						$art['title'] = $vv['title'];
						$art['img'] = tomedia( $vv['img'] );
						$art['url'] = '/zofui_sitetemp/pages/art/art?aid='.$vv['id'];
						$art['time'] = $vv['time'];
						$v['artlist'][] = $art;
					}
					unset( $vv );
				}
			}
		}
	}
	
	$data['page'] = $page;

	// footer
	if( empty( $bar ) ) {
		
		$temp = model_temp::getTemp();
		if( !empty( $temp['id'] ) ) {

			$bar = pdo_get('zofui_sitetemp_bar',array('uniacid'=>$_W['uniacid'],'tempid'=>$temp['id']));
			if( !empty( $bar ) ) {
				$bar['data'] = iunserializer( $bar['data'] );
			}
		}
	}
	
	$data['bar'] = $bar['data'];

	// copyright
	$copy = pdo_get('zofui_sitetemp_copyright');

	if( !empty( $copy ) && $copy['status'] == 0 ) {
		$data['copy'] = htmlspecialchars_decode( $copy['content'] );
	}

	$this->result(0, '', $data);