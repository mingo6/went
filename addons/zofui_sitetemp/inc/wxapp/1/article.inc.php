<?php 
	defined('IN_IA') or exit('Access Denied');
	global $_W,$_GPC;

	if( $_GPC['op'] == 'list' ) {

		$where = array('uniacid' => $_W['uniacid']);
		if( !empty( $_GPC['actsort'] ) ) $where['sortid'] = intval( $_GPC['actsort'] );

		$info = Util::getAllDataInSingleTable('zofui_sitetemp_article',$where,$_GPC['page'],10,' `number` DESC ',false,false,' id,img,title,time ');
		$list = $info[0];
		
		if( !empty( $list ) ) {
			foreach ($list as &$v) {
				$v['url'] = '/zofui_sitetemp/pages/art/art?aid='.$v['id'];
				$v['img'] = tomedia( $v['img'] );
			}
		}
		
		$data['art'] = $list;

		// 页脚导航
		$temp = model_temp::getTemp();
		if( !empty( $temp['id'] ) ) {

			$bar = pdo_get('zofui_sitetemp_bar',array('uniacid'=>$_W['uniacid'],'tempid'=>$temp['id']));
			if( !empty( $bar ) ) {
				$bar['data'] = iunserializer( $bar['data'] );
			}
		}
		$data['bar'] = $bar;

		// 分类
		$data['artsort'] = model_artsort::getSort();
		
		
		$this->result(0, '',$data);
	
	}elseif( $_GPC['op'] == 'article' ) {
		
		$info = pdo_get('zofui_sitetemp_article',array('uniacid'=>$_W['uniacid'],'id'=>$_GPC['id']));
		if( !empty( $info ) ) {
			$info['content'] = htmlspecialchars_decode( $info['content'] );
			$info['img'] = tomedia( $info['img'] );
		}

		Util::addOrMinusOrUpdateData('zofui_sitetemp_article',array('readed'=>1),$info['id']);

		$this->result(0, '',$info);
		
	}

	