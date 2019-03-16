<?php 
	global $_W,$_GPC;


	//批量删除
	if(checksubmit('deleteall')){
		$res = WebCommon::deleteDataInWeb($_GPC['checkall'],'zofui_sitetemp_form');
		message('操作完成,成功删除'.$res[0].'项，失败'.$res[1].'项',referer(),'success');
	}
	//批量删除
	if(checksubmit('deletealladmin')){
		$res = WebCommon::deleteDataInWeb($_GPC['checkall'],'zofui_sitetemp_admin');
		message('操作完成,成功删除'.$res[0].'项，失败'.$res[1].'项',referer(),'success');
	}
	
	if(checksubmit('readall')){
		
		if( empty( $_GPC['checkall'] ) ) message('请先选择要审核的数据',referer(),'success');

		foreach ( $_GPC['checkall'] as $v ) {
			pdo_update('zofui_sitetemp_form',array('isread'=>1),array('id'=>$v,'uniacid'=>$_W['uniacid']));
		}
		message('操作完成',referer(),'success');
	}	


	if($_GPC['op'] == 'wait' || $_GPC['op'] == 'scaned'){

		$where['isread'] = 0;
		//$where['uniacid'] = $_W['uniacid'];
		if( $_GPC['op'] == 'scaned' ) $where['isread'] = 1;

		$num = 10;

		if( $_GPC['down'] == 1 ){
			$num = 9999999;
			$_GPC['page'] = 1;

			$where['createtime>'] = strtotime( $_GPC['time']['start'] );
			$andstr = ' AND createtime <= '. strtotime( $_GPC['time']['end'] ) ;
		}

		
		$info = Util::getAllDataInSingleTable('zofui_sitetemp_form',$where,$_GPC['page'],$num,' `id` DESC ',false,true,' * ',$andstr);
		$list = $info[0];
		$pager = $info[1];

		// echo '<pre>';
		// var_dump($info);
		// echo '</pre>';die;
		
		if( $_GPC['down'] == 1 ){
			downLoadOrder($list);
		}

		if( !empty( $list ) ) {
			foreach ( $list as &$v ) {
				$v['data'] = iunserializer( $v['data'] );
				$v['content'] = '';
				foreach ((array)$v['data'] as $kk => $vv) {
					if( is_string( $vv ) ) {
						$v['content'] .= $kk.'：'.$vv.'，';
					}elseif( is_array( $vv ) ) {
						$instr = '';
						foreach ($vv as $vvv) {
							$instr .= $vvv.'-';
						}
						$instr = trim( $instr,'-' );
						$v['content'] .= $kk.'：'.$instr.'，';
					}
					
				}
			}
		}

	}
	


	if($_GPC['op'] == 'deleteform'){
		$res = WebCommon::deleteSingleData($_GPC['id'],'zofui_sitetemp_form');
		if($res) message('删除成功',referer(),'success');
	}


	/*if( $_GPC['op'] == 'admin' ){
		
		Util::deleteCache('scene','all');
		
		$info = Util::getAllDataInSingleTable('zofui_sitetemp_admin',array('uniacid'=>$_W['uniacid']),1,9999,' `id` DESC ',false,false);
		$list = $info[0];
		if( !empty( $list ) ) {

			foreach ( $list as  &$v ) {
				$user = pdo_get('mc_mapping_fans',array('openid'=>$v['openid']),array('tag'));
				$tag = iunserializer( base64_decode( $user['tag'] ) );
				$v['headimgurl'] = $tag['headimgurl'];
				$v['nickname'] = $tag['nickname'];
				
			}
		}
	}

	if($_GPC['op'] == 'deleteadmin'){
		$res = WebCommon::deleteSingleData($_GPC['id'],'zofui_sitetemp_admin');
		if($res) message('删除成功',referer(),'success');
	}*/


	//下载表格
	function downLoadOrder($list){
		
		/* 输入到CSV文件 */
		$html = "\xEF\xBB\xBF".$html; //添加BOM
		/* 输出表头 */		
		$html .= '数据id' . "\t,";
		$html .= '数据内容' . "\t,";		
		$html .= '提交时间' . "\t,";
		$html .= "\n";
			
 		foreach((array)$list as $k => $v){	

 			$time = date('Y-m-d H:i:s',$v['createtime']);

 			$data = iunserializer( $v['data'] );
			$content = '';
			foreach ($data as $kk => $vv) {
				if( is_string( $vv ) ) {
					$content .= $kk.'：'.$vv."，";
				}elseif( is_array( $vv ) ) {
					$instr = '';
					foreach ($vv as $vvv) {
						$instr .= $vvv.'-';
					}
					$instr = trim( $instr,'-' );
					$content .= $kk.'：'.$instr."，";
				}
			}
 			
			$html .= $v['id'] . "\t,";
			$html .= $content . "\t,";					
			$html .= $time . "\t,";
			
			$html .= "\n"; 
			
		}
		/* 输出CSV文件 */
		header("Content-type:text/csv");
		header("Content-Disposition:attachment; filename=表单数据.csv");
		echo $html;
		exit;
		
	}

	function input_csv($handle) { 
		$out = array (); 
		$n = 0; 
		while ($data = fgetcsv($handle, 10000)) { 
			$num = count($data); 
			for ($i = 0; $i < $num; $i++) { 
				$out[$n][$i] = $data[$i]; 
			} 
			$n++; 
		} 
		return $out; 
	}
	

	include $this->template('web/form');