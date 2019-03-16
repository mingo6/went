<?php 
	global $_W,$_GPC;
	
	$temp = pdo_get('zofui_sitetemp_temp',array('id'=>$_GPC['tid'],'uniacid'=>$_W['uniacid']));
	if( empty( $temp ) ) message('请选择模板',referer(),'error');


	//批量删除
	if(checksubmit('deleteall')){
		$res = WebCommon::deleteDataInWeb($_GPC['checkall'],'zofui_sitetemp_page');
		message('操作完成,成功删除'.$res[0].'项，失败'.$res[1].'项',referer(),'success');
	}
	
	
	if($_GPC['op'] == 'list'){

		$where = array('uniacid'=>$_W['uniacid']);
		$where['tempid'] = $_GPC['tid'];

		$info = Util::getAllDataInSingleTable('zofui_sitetemp_page',$where,$_GPC['page'],10,' `id` DESC ',false,true,' id,name,tempid ');
		$list = $info[0];
		$pager = $info[1];
		
	}
	
	if($_GPC['op'] == 'delete'){
		$res = WebCommon::deleteSingleData($_GPC['id'],'zofui_sitetemp_page');
		if($res) message('删除成功',referer(),'success');
	}

	if( $_GPC['op'] == 'edit' ) {
		$page = pdo_get('zofui_sitetemp_page',array('uniacid'=>$_W['uniacid'],'id'=>$_GPC['id']));

		$allsort = model_artsort::getSort();

		if( empty( $page ) ) message('未找到页面',referer(),'error');
		$page['params'] = iunserializer( $page['params'] );

		$info = Util::getAllDataInSingleTable('zofui_sitetemp_article',array('uniacid'=>$_W['uniacid']),1,3,' `number` DESC ',false,false,' img,title,time ');
		$article = $info[0];
		if( !empty( $article ) ) {
			foreach ( $article as &$v ) {
				$v['img'] = tomedia( $v['img'] );
			}
			unset( $v );
		}

	}

	if( $_GPC['op'] == 'add' && !empty( $_GPC['lid'] ) ) {
		$page = pdo_get('zofui_sitetemp_page',array('uniacid'=>$_W['uniacid'],'id'=>$_GPC['lid']));
		if( empty( $page ) ) message('未找到页面',referer(),'error');
		$page['params'] = iunserializer( $page['params'] );
		unset( $page['id'] );
	}

	if( $_GPC['op'] == 'bar' ) {
		
		$page = pdo_get('zofui_sitetemp_bar',array('uniacid'=>$_W['uniacid'],'tempid'=>$_GPC['tid']));
		if( !empty( $page ) ) $page['data'] = iunserializer( $page['data'] );

		// echo '<pre>';
		// var_dump($page);
		// echo '<pre>';die;
		
	}

	include $this->template('web/page');