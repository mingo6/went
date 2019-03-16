<?php 
	global $_W,$_GPC;
	load()->func('tpl');
	$uniacid = $_W['uniacid'];
	$id=$_GPC['a_id'];
	$pindex = max(1,intval($_GPC['page']));
	$psize = 10;
	$keyword = $_GPC['keyword'];
	if(!empty($keyword)){
		$condition = "nickname like '%$keyword%' and ";

	}else{
		$condition ="";
	}
	$sql = "select user_id from ".tablename('dg_article_agent')." where uniacid=:uniacid";
	$pram = array();
	$pram[':uniacid'] = $uniacid;
	$result = pdo_fetchall($sql,$pram);
	$area_name = array();
	foreach ($result as $key => $value) {
		$area_name[] = $value['user_id'];
	}
	$area_name = implode('', $area_name);
	// var_dump($area_name);die;
	$user_id = substr($area_name,0,-1);
	if($_W['isajax']){
		$checkbox_val = $_GPC['checkbox_val'];
		$sql2 = "select user_id from ".tablename('dg_article_agent')." where uniacid=:uniacid and a_id=:a_id";
		$pram2 = array();
		$pram2[':uniacid'] = $uniacid;
		$pram2[':a_id'] = $id;
		$result2 = pdo_fetch($sql2,$pram2);
		$user_id = $result2['user_id'].$checkbox_val;
		$data = array();
		$data['user_id'] = $user_id;
		$result = pdo_update('dg_article_agent',$data,array('a_id'=>$id));
		if ($result){
	        $data=array(
	            'success'=>1
	        );
	    } else {
	      $data=array(
	            'success'=>0
	        );
    	}
    	header("Content-type:application/json");
    	echo json_encode($data);die;
	}
	//查询没设置的人员
	if(!empty($user_id)){
		$sql1 = "select * from ".tablename('dg_article_user')." where ".$condition." uniacid=:uniacid and id not in (".$user_id.") limit ".intval($pindex-1)*$psize.",".$psize;
		$result1 = pdo_fetchall($sql1,$pram);
		$total = pdo_fetchcolumn("select count(*) from ".tablename('dg_article_user')." where ".$condition." uniacid=:uniacid and id not in (".$user_id.")",$pram);
		$pager=pagination($total,$pindex,$psize);
	}else{
		$sql1 = "select * from ".tablename('dg_article_user')." where ".$condition." uniacid=:uniacid";
		$result1 = pdo_fetchall($sql1,$pram);
		$total = pdo_fetchcolumn("select count(*) from ".tablename('dg_article_user')." where ".$condition." uniacid=:uniacid",$pram);
		$pager=pagination($total,$pindex,$psize);
	}
	include  $this->template('add_set_user');
 ?>