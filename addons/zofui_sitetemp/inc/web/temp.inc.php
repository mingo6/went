<?php 
	global $_W,$_GPC;
	

	model_temp::initTemp();

	if( $_GPC['op'] == 'my' || $_GPC['op'] == 'sys' ){
		// echo "<pre>";
		// var_dump($_SERVER['HTTP_HOST']);
		// var_dump($_W['siteroot']);
		// echo "</pre>";die;
		if( $_GPC['op'] == 'my' ){
			$where = array('uniacid'=>$_W['uniacid'],'issystem'=>0);

			$info = Util::getAllDataInSingleTable('zofui_sitetemp_temp',$where,$_GPC['page'],8,' `isact` DESC ,`issystem` ASC,`number` DESC ',false,true,' * ');
		}

		if( $_GPC['op'] == 'sys' ){
			$where = array('issystem'=>1);

			$info = Util::getAllDataInSingleTable('zofui_sitetemp_temp',$where,$_GPC['page'],8,' `isact` DESC ,`issystem` ASC,`number` DESC ',false,true,' * ','','',false);
		}
		//var_dump($info);die;
		$list = $info[0];
		$pager = $info[1];

		/*$system = pdo_getall('zofui_sitetemp_temp',array('issystem'=>1));

		if( !empty( $system ) ) {
			$list = array_merge( $list,$system );
		}*/

	}
	
	if($_GPC['op'] == 'delete'){

		$temp = pdo_get('zofui_sitetemp_temp',array('id'=>$_GPC['id']));
		if( $temp['issystem'] == 1 ) message('此模板不能删除',referer(),'error');
		if( $temp['isact'] == 1 ) message('使用中的模板不能删除',referer(),'error');

		$res = WebCommon::deleteSingleData($_GPC['id'],'zofui_sitetemp_temp');
		if($res) message('删除成功',referer(),'success');
	}
		// echo '<pre>';
        // var_dump($_W);
		// echo '<pre>';die;
	
	include $this->template('web/temp');