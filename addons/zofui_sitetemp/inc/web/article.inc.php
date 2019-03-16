<?php 
	global $_W,$_GPC;
	$_GPC['op'] = isset($_GPC['op'])?$_GPC['op']:'list';
	
	

	//添加，编辑
	if(checksubmit('create')){
		$_GPC = Util::trimWithArray($_GPC);
		
		$data['number'] = $_GPC['number'];
		$data['uniacid'] = $_W['uniacid'];
		$data['title'] = $_GPC['title'];
		$data['content'] = $_GPC['content'];
		$data['img'] = $_GPC['img'];
		$data['time'] = $_GPC['time'];
		$data['author'] = $_GPC['author'];
		$data['sortid'] = $_GPC['sortid'];

		if(!empty($_GPC['id'])){
			$id = intval($_GPC['id']);
			$res = pdo_update('zofui_sitetemp_article',$data,array('uniacid'=>$_W['uniacid'],'id'=>$id));	
		}else{
			$res = Util::inserData('zofui_sitetemp_article',$data);
			$id = pdo_insertid();
		}
		Util::deleteCache('article',$id);
		message('操作成功',$this->createWebUrl('article',array('op'=>'list','page'=>$_GPC['page'])),'success');
	}
	
	
	//批量删除
	if(checksubmit('deleteall')){
		$res = WebCommon::deleteDataInWeb($_GPC['checkall'],'zofui_sitetemp_article');
		message('操作完成,成功删除'.$res[0].'项，失败'.$res[1].'项',referer(),'success');
	}
	
	$artsort = model_artsort::getSort();
	
	if($_GPC['op'] == 'list'){	
		$info = Util::getAllDataInSingleTable('zofui_sitetemp_article',array('uniacid'=>$_W['uniacid']),$_GPC['page'],10,' `number` DESC ');
		$list = $info[0];
		$pager = $info[1];
	}
	
	if($_GPC['op'] == 'edit'){
		$id = intval($_GPC['id']);
		$info = pdo_get('zofui_sitetemp_article',array('uniacid'=>$_W['uniacid'],'id'=>$id));

	}
	
	if($_GPC['op'] == 'delete'){
		$res = WebCommon::deleteSingleData($_GPC['id'],'zofui_sitetemp_article');
		if($res) message('删除成功',referer(),'success');
	}
	
	
	
	include $this->template('web/article');