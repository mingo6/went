<?php 
	global $_W,$_GPC;
	$_W['set'] = $this->module['config'];
	if($_GPC['op'] == 'deletecache'){ 
		$res = cache_clean('zfst');
		die('1');
	}
	
	
	elseif($_GPC['op'] == 'editvalue'){ //修改
		$id = intval($_GPC['id']);
	
		
		if($_GPC['name'] == 'sorttempnumber'){
			pdo_update('zofui_orderfood_sorttemp',array('number'=>intval( $_GPC['value'] )),array('id'=>$id,'uniacid'=>$_W['uniacid']));
			Util::deleteCache('sorttemp','all');
			
		}

	}

	// 保存页面
	elseif ($_GPC['op'] == 'savepage') {

		$getdata = htmlspecialchars_decode($_GPC['data']);
		$getdata = json_decode($getdata,true);

		$basic = htmlspecialchars_decode($_GPC['basic']);
		$basic = json_decode($basic,true);
		
		$name = $basic['name'];

		$id = intval($_GPC['id']);		

		$tid = intval($_GPC['tid']);
		$temp = pdo_get('zofui_sitetemp_temp',array('id'=>$tid,'uniacid'=>$_W['uniacid']));
		if( empty( $temp ) ) Util::echoResult(201,'请返回重新选择模板');


		$content = iserializer(array('basic' => $basic,'data' => $getdata));


		$data = array(
			'uniacid' => $_W['uniacid'],
			'tempid' => $tid,
			'params'=>$content,
			'createtime'=>TIMESTAMP,
			'name' => $name
		);	
		
		
		if($id > 0){
			$res = pdo_update('zofui_sitetemp_page',$data,array('id'=>$id));
		}else{
			$res = pdo_insert('zofui_sitetemp_page',$data);
			$id = pdo_insertid();

		}
		if($res){
			Util::deletecache('page',$id);
		}
		Util::echoResult(200,'已保存');
		
	}elseif ($_GPC['op'] == 'savebar') {

		$tid = intval($_GPC['tid']);	
		$temp = pdo_get('zofui_sitetemp_temp',array('id'=>$tid,'uniacid'=>$_W['uniacid']));
		if( empty( $temp ) ) Util::echoResult(201,'请返回重新选择模板');		

		$data = array(
			'uniacid' => $_W['uniacid'],
			'data'=> iserializer( $_GPC['data'] ),
			'createtime'=>TIMESTAMP,
			'tempid' => $tid,
		);
		
		$isset = pdo_get('zofui_sitetemp_bar',array('uniacid'=>$_W['uniacid'],'tempid'=>$tid),array('id'));

		if( !empty( $isset['id'] ) ){
			$res = pdo_update('zofui_sitetemp_bar',$data,array('id'=>$isset['id']));
		}else{
			$res = pdo_insert('zofui_sitetemp_bar',$data);
			$id = pdo_insertid();
		}
		if($res){
			Util::deletecache('bar',$id);
		}
		Util::echoResult(200,'已保存');
		

	// 查询链接
	}elseif( $_GPC['op'] == 'getlink'){		
		
		$page = pdo_getall('zofui_sitetemp_page',array('uniacid'=>$_W['uniacid'],'tempid'=>$_GPC['tid']),array('id','name'));

		if( !empty( $page ) ){
			foreach ( $page as &$v ) {
				$v['url'] = '/zofui_sitetemp/pages/page/page?pid='.$v['id'];
			}
			unset( $v );
		}
		
		$news = pdo_getall('zofui_sitetemp_article',array('uniacid'=>$_W['uniacid']),array('id','title'));
		if( !empty( $news ) ){
			foreach ( $news as &$v ) {
				$v['url'] = '/zofui_sitetemp/pages/art/art?aid='.$v['id'];
			}
		}
		Util::echoResult(200,'好',array('page'=>$page,'news'=>$news));
		
	}elseif( $_GPC['op'] == 'loadpagelist' ){

		$temp = pdo_getall('zofui_sitetemp_temp',array('uniacid'=>$_W['uniacid']),array('name','id'));

		if( !empty( $temp ) ) {
			foreach ($temp as &$v) {
				$v['page'] = pdo_getall('zofui_sitetemp_page',array('tempid'=>$v['id']),array('id','name'));
			}
		}
		
		
		Util::echoResult(200,'好',$temp);

	}elseif( $_GPC['op'] == 'toreaded' ){

		$id = intval( $_GPC['fid'] );

		pdo_update('zofui_sitetemp_form',array('isread'=>1),array('id'=>$id,'uniacid'=>$_W['uniacid']));

		Util::echoResult(200,'已记为已审核');
		

	}elseif( $_GPC['op'] == 'baidutoten' ){

		$ak = empty( $this->module['config']['ak'] ) ? 'F51571495f717ff1194de02366bb8da9' : $this->module['config']['ak'];

		$tourl = 'http://api.map.baidu.com/geoconv/v1/?coords='.$_GPC['lng'].','.$_GPC['lat'].'&from=1&to=5&ak='.$ak;
		$tores = Util::httpGet($tourl);
		$tores = json_decode($tores,true);

		if( $tores['status'] == '0' ){
			
			$data['lat'] = sprintf('%.5f',$tores['result'][0]['y']);
			$data['lng'] = sprintf('%.4f',$tores['result'][0]['x']);
			
			Util::echoResult(200,'已记为已审核',$data);
			
		}

		Util::echoResult(201,'设置坐标失败');

	}elseif( $_GPC['op'] == 'addtempform' ){

		$id = intval( $_GPC['fid'] );

		$data = array(
			'uniacid' => $_W['uniacid'],
			'name' => $_GPC['name'],
			'number' => intval( $_GPC['number'] ),
			'img' => $_GPC['img'],
		);

		if( empty( $data['name'] ) ) Util::echoResult(201,'请填写模板名称');
		if( empty( $data['img'] ) ) Util::echoResult(201,'请设置模板图标');	

		if( $id > 0 ) {
			$res = pdo_update( 'zofui_sitetemp_temp',$data ,array('id'=>$id,'uniacid'=>$_W['uniacid']));
		}else{
			$res = pdo_insert('zofui_sitetemp_temp',$data);
		}

		if( $res ) {
			Util::deleteCache('temp','all');
			Util::echoResult(200,'已保存');
		}

		Util::echoResult(201,'保存失败');

	// 编辑模板
	}elseif( $_GPC['op'] == 'findtemp' ){

		$temp = pdo_get('zofui_sitetemp_temp',array('uniacid'=>$_W['uniacid'],'id'=>$_GPC['fid']));
		if( empty( $temp ) ) Util::echoResult(201,'没有找到模板');

		$temp['showimg'] = tomedia( $temp['img'] );

		Util::echoResult(200,'好',$temp);

	// 使用模板
	}elseif( $_GPC['op'] == 'setacttemp' ){		

		$id = intval( $_GPC['id'] );
		$temp = pdo_get('zofui_sitetemp_temp',array('id'=>$_GPC['id']));
		if( empty( $temp ) ) Util::echoResult(201,'没有找到模板');

		if( $temp['issystem'] == 1 ) Util::echoResult(201,'不能使用系统模板');

		pdo_update('zofui_sitetemp_temp',array('isact'=>0),array('uniacid'=>$_W['uniacid'],'issystem'=>0));
		pdo_update('zofui_sitetemp_temp',array('isact'=>1),array('uniacid'=>$_W['uniacid'],'issystem'=>0,'id'=>$id));

		Util::deleteCache('temp','all');
		Util::echoResult(200,'已使用');


	}elseif( $_GPC['op'] == 'temptopage' ){

		$id = intval( $_GPC['id'] );
		$temp = pdo_get('zofui_sitetemp_temp',array('id'=>$_GPC['id']));
		if( empty( $temp ) ) Util::echoResult(201,'没有找到模板');
			
			
		$tdata = array(
			'uniacid' => $_W['uniacid'],
			'name' => '新复制的模板',
			'number' => 1,
			'img' => $temp['img'],
		);

		$res = pdo_insert('zofui_sitetemp_temp',$tdata);
		$tid = pdo_insertid();

		if( $temp['name'] == '电镀厂系统模板' && $temp['issystem'] == 1 )	{
			model_temp::insertddPage( $tid );
		
		}elseif( $temp['name'] == '网络公司系统模板' && $temp['issystem'] == 1 )	{
			
			model_temp::insertwlPage( $tid );
		
		}else{

			if( $tid ){
				// bar
				$bar = pdo_get('zofui_sitetemp_bar',array('tempid'=>$temp['id']));
				$data = array(
					'uniacid' => $_W['uniacid'],
					'data' => $bar['data'],
					'createtime' => TIMESTAMP,
					'tempid' => $tid,
				);
				pdo_insert('zofui_sitetemp_bar',$data);

				// page
				$allpage = pdo_getall('zofui_sitetemp_page',array('tempid'=>$temp['id']));
				if( !empty( $allpage ) ) {
					foreach ($allpage as $v) {
						$data = array(
							'uniacid' => $_W['uniacid'],
							'params' => $v['params'],
							'createtime' => TIMESTAMP,
							'name' => $v['name'],
							'tempid' => $tid,
						);
						pdo_insert('zofui_sitetemp_page',$data);
					}
				}
			}else{
				Util::echoResult(201,'导出模板失败');
			}

		}


		Util::echoResult(200,'已复制，请编辑复制出的模板的各个点击动作');	

	// 查询小程序
	}elseif( $_GPC['op'] == 'getapp' ){
		load()->model('wxapp');
		load()->model('account');

		$pindex = 1;
		$psize = 9999;

		$account_table = table('account');
		$account_table->searchWithType(array(ACCOUNT_TYPE_APP_NORMAL));

		$account_table->searchWithPage($pindex, $psize);
		$wxapp_lists = $account_table->searchAccountList();


		if (!empty($wxapp_lists)) {
			foreach ($wxapp_lists as &$account) {
				$account = uni_fetch($account['uniacid']);
				$account['versions'] = wxapp_get_some_lastversions($account['uniacid']);
				if (!empty($account['versions'])) {
					foreach ($account['versions'] as $version) {
						if (!empty($version['current'])) {
							$account['current_version'] = $version;
						}
					}
				}
			}

			$data = array();
			foreach ( $wxapp_lists as $v ) {
				$in = array();
				$in['appname'] = $v['name'];
				$in['logo'] = $v['logo'];
				$in['appid'] = $v['key'];

				$wxapp_modules = pdo_getcolumn('wxapp_versions', array('id' => $v['current_version']['id']), 'modules');
				
				if (!empty($wxapp_modules)) {
					$module_info = iunserializer($wxapp_modules);
					$module_info = pdo_getall('modules_bindings', array('module' => array_keys($module_info), 'entry' => 'page'));
					
					if( !empty( $module_info ) ) {
						$list = array();
						foreach ($module_info as $vv) {
							$listin = array();
							$listin['title'] = $vv['title'];
							$listin['url'] = $vv['do'];
							$list[] = $listin;
						}
						$in['list'] = $list;
					}
				}
				$data[] = $in;
			}

		}

		
		Util::echoResult(200,'好',$data);	


	// 查询二维码
	}elseif( $_GPC['op'] == 'getqrcode' ){
		
		
		$scene = Util::getCache('scene','all');

		if( empty( $scene ) || $scene['time'] <= TIMESTAMP ){
			$id = TIMESTAMP.rand(1111,999);
			$scene = array( 'time' => (TIMESTAMP + 60) , 'id' => $id );
			Util::setCache( 'scene','all',$scene );

			Util::echoResult(202,'好',array('url'=>$this->createWebUrl('img',array('id'=>$id))));
		}

		Util::echoResult(200,'好');

	}elseif( $_GPC['op'] == 'checkqrcode' ){

		load()->model('account');
		
		$uniacccount = WeAccount::create($_W['acid']);	
		$res = Util::wxappQrcode( $uniacccount,'123456','zofui_sitetemp/pages/form/form' );
		
		
		if( strpos( $res, '{"errcode":' ) !== false ){
			Util::echoResult(201,'生成二维码失败，请确保小程序的appid和secret正确，并且程序已上传审核通过。具体原因'.$res);
		}else {
			Util::echoResult(200,'好');
		}

	// 普通模板转为系统模板
	}elseif( $_GPC['op'] == 'tosystem' ){
		
		if( $_W['role'] != 'founder' ) Util::echoResult(201,'你无权限');

		

		$id = intval( $_GPC['id'] );
		$temp = pdo_get('zofui_sitetemp_temp',array('id'=>$_GPC['id']));
		if( empty( $temp ) ) Util::echoResult(201,'没有找到模板');

		$data = array(
			'uniacid' => 0,
			'createtime' => TIMESTAMP,
			'name' => $temp['name'],
			'number' => 1,
			'img' => $temp['img'],
			'isact' => 0,
			'issystem' => 1,
			'issetsystem' => 1,
		);
		
		$res = pdo_insert('zofui_sitetemp_temp',$data);

		if( $res ){
			$tid = pdo_insertid();

			$bar = pdo_get('zofui_sitetemp_bar',array('tempid'=>$temp['id']));
			

			$data = array(
				'uniacid' => $_W['uniacid'],
				'data' => $bar['data'],
				'createtime' => TIMESTAMP,
				'tempid' => $tid,
			);
			pdo_insert('zofui_sitetemp_bar',$data);

			$allpage = pdo_getall('zofui_sitetemp_page',array('tempid'=>$temp['id']));

			if( !empty( $allpage ) ) {

				foreach ($allpage as $v) {
					$data = array(
						'uniacid' => $_W['uniacid'],
						'params' => $v['params'],
						'createtime' => TIMESTAMP,
						'name' => $v['name'],
						'tempid' => $tid,
					);
					pdo_insert('zofui_sitetemp_page',$data);
				}

			}

			Util::echoResult(200,'已保存成系统模板');
		}

		Util::echoResult(201,'保存系统模板失败');

	}elseif( $_GPC['op'] == 'deletesystem' ){

		
		if( $_W['role'] != 'founder' ) Util::echoResult(201,'你无权限');

		$id = intval( $_GPC['id'] );
		$temp = pdo_get('zofui_sitetemp_temp',array('id'=>$_GPC['id']));
		if( empty( $temp ) ) Util::echoResult(201,'没有找到模板');

		if( $temp['issystem'] != 1 ) Util::echoResult(201,'不是系统模板');
		if( $temp['issetsystem'] != 1 ) Util::echoResult(201,'此系统模板不能删除');
		
		pdo_delete('zofui_sitetemp_temp',array('id'=>$id));
		pdo_delete('zofui_sitetemp_bar',array('tempid'=>$id));
		pdo_delete('zofui_sitetemp_page',array('tempid'=>$id));

		Util::echoResult(200,'已删除');


	}elseif( $_GPC['op'] == 'usemail' ){
		load()->func('communication');

		if( empty( $this->module['config']['mail'] ) ) Util::echoResult(200,'发送失败，原因：参数设置内还没设置邮箱');
		
			
		$res = Util::ihttp_email($this->module['config']['mail'], '测试邮件', array('测试邮件','测试邮件','测试邮件'));

		if( $res['status'] == 200 ) {
			Util::echoResult(200,'已发送');
		}else{
			Util::echoResult(200,'发送失败，原因：'.$res['res']);
		}


	}elseif( $_GPC['op'] == 'addartsort' ){

		$fid = intval( $_GPC['fid'] );
		if( $fid > 0 ){
			$form = pdo_get('zofui_sitetemp_artsort',array('uniacid'=>$_W['uniacid'],'id'=>$fid));
			if( empty( $form ) ) Util::echoResult(201,'没有找到数据');
		}
		if( empty( $_GPC['name'] ) ) Util::echoResult(201,'请填写名称');

		$data['number'] = $_GPC['number'];
		$data['uniacid'] = $_W['uniacid'];
		$data['name'] = $_GPC['name'];

		if( $fid > 0 ){ 
			$res = pdo_update('zofui_sitetemp_artsort',$data,array('id'=>$fid));
		}else{
			$res = pdo_insert('zofui_sitetemp_artsort',$data);
		}
		if( $res ){
			Util::deleteCache('artsort','all');
			Util::echoResult(200,'已保存');
		} 
		Util::echoResult(201,'保存失败');


	}elseif( $_GPC['op'] == 'findartsort' ){

		$form = pdo_get('zofui_sitetemp_artsort',array('uniacid'=>$_W['uniacid'],'id'=>$_GPC['fid']));
		if( empty( $form ) ) Util::echoResult(201,'没有找到数据');

		Util::echoResult(200,'好',$form);

	}elseif( $_GPC['op'] == 'queue' ){

		for( $i = 0;$i<3;$i++ ){
			$cache = Util::getCache('queue','q');
			if( empty( $cache ) || $cache['time'] < ( time() - 40 ) ){
				if( $i == 2 ){
					$url = Util::createModuleUrl('message',array('op'=>1));
					$res = Util::httpGet($url,'', 1);
					die('2');
				}
				sleep(1);
			}else{
				die('1');
			}			
			
		}

		

	}