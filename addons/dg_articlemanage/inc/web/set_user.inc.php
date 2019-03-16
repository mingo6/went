<?php 
	global $_W,$_GPC;
	load()->func('tpl');
	$uniacid = $_W['uniacid'];
	$id=$_GPC['a_id'];
	$keyword = $_GPC['keyword'];
	$pindex = max(1,intval($_GPC['page']));
	$psize = 10;
	if(!empty($keyword)){
		$condition = "nickname like '%$keyword%' and ";

	}else{
		$condition ="";
	}

	$sql = "select * from ".tablename('dg_article_agent')." where uniacid=:uniacid and a_id = $id";
	$pram = array();
	$pram[':uniacid'] = $uniacid;
	$result = pdo_fetch($sql,$pram);
	$user_id = substr($result['user_id'],0,-1);
	if($_W['isajax']){
		$uid = $_GPC['uid'];
		//处理移除字段内id
		$arr = explode(',',$user_id);
		foreach ($arr as $key => $val) {
			if($val === $uid){
				unset($arr[$key]);
			}
		}
		$now_user_id = implode(',', $arr).',';
		$data1=array();
		if($now_user_id ==","){
			$data1['user_id'] ="";
		}else{
			$data1['user_id'] = $now_user_id;
		}
		
		$news = pdo_update('dg_article_agent',$data1,array('a_id'=>$_GPC['a_id']));
		if ($news){
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
	//查询是否有人员
	if(!empty($user_id)){
		$sql1 = "select * from ".tablename('dg_article_user')." where ".$condition."uniacid=:uniacid and id in (".$user_id.") limit ".intval($pindex-1)*$psize.",".$psize;
		$result1 = pdo_fetchall($sql1,$pram);
		$total = pdo_fetchcolumn("select count(*) from ".tablename('dg_article_user')." where ".$condition."uniacid=:uniacid and id in (".$user_id.")",$pram);
		$pager=pagination($total,$pindex,$psize);
	}else{
		$result1="";
	}
	include $this->template('set_user');
 ?>