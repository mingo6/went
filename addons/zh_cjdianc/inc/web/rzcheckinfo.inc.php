<?php
global $_GPC, $_W;

$GLOBALS['frames'] = $this->getMainMenu();
$storetype=pdo_getall('cjdc_storetype',array('uniacid'=>$_W['uniacid']),array(),'','num asc');
$sql="SELECT * FROM ".tablename('cjdc_store')."  where id=:id ";
$item=pdo_fetch($sql,array(':id'=>$_GPC['id']));
if(checksubmit('submit')){   
	$data['name']=$_GPC['name'];    
	$data['address'] = $_GPC['address']; 
	$data['link_name']=$_GPC['link_name'];
	$data['link_tel']=$_GPC['link_tel'];
	$data['state']=$_GPC['state'];
	$data['rzdq_time']=date('Y-m-d H:i:s',strtotime("+{$item['rz_time']}day"));;
	$data['md_type']=$_GPC['md_type'];
	if(empty($_GPC['md_type'])){
		 message('分类不能为空','','error');
	}
	if($_GPC['state']==2){
		// if(strlen($item['logo'])<25){
		// 	$data['logo']=$_W['attachurl'].$item['logo'];
		// }
		// if(strlen($item['zm_img'])<25){
		// 	$data['zm_img']=$_W['attachurl'].$item['zm_img'];
		// }
		// if(strlen($item['fm_img'])<25){
		// 	$data['fm_img']=$_W['attachurl'].$item['fm_img'];
		// }
		// if(strlen($item['yyzz'])<25){
		// 	$data['yyzz']=$_W['attachurl'].$item['yyzz'];
		// }
		$set=pdo_get('cjdc_storeset',array('store_id'=>$item['id']));
    if(!$set){   
      $data3['store_id']=$item['id'];
      pdo_insert('cjdc_storeset',$data3);
  		}
	}
	$data['details']=html_entity_decode($_GPC['details']);
	$rst=pdo_update('cjdc_store',$data,array('id'=>$item['id']));
	if($rst){

	     message('编辑成功！', $this->createWebUrl('rzcheck'), 'success');
	}else{
	     message('编辑失败！','','error');
	}

}

include $this->template('web/rzcheckinfo');