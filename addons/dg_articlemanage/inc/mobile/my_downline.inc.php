<?php 
	global $_W,$_GPC;
	load()->func('tpl');
	$uniacid = $_W['uniacid'];
	$userinfo=$this->getUserInfo();
	$userinfo=json_decode($userinfo,true);
	$openid=$userinfo['openid'];
	$nickname=$userinfo['nickname'];
	$avatar=$userinfo['headimgurl'];
	$sex=$userinfo['sex'];

	$pindex= max(1,intval($_GPC['page']));
	$psize = 10;
	if($_W['isajax']){
		$sql = "select * from ".tablename('dg_article_count')." left join ".tablename('dg_article_user')." on ims_dg_article_count.userid=ims_dg_article_user.openid where fid=:fid limit ".intval($pindex-1)*$psize.",".$psize;
		$pram = array();
		$pram['fid'] = $openid;
		$result = pdo_fetchall($sql,$pram);
		foreach ($result as $key => $value) {
			$result[$key]['time'] =date('Y/m/d H:i:s', $value['time']);
		}
		// var_dump($result);die;
		$sql1 = "select count(*) from ".tablename('dg_article_count')." where fid=:fid";
		$total = pdo_fetchcolumn($sql1,$pram);
		$total =isset($total)?$total:0;
		$data = array();
		$data['list'] = $result;
		$data['total']= $total;
		header("Content-type:application/json");
    	echo json_encode($data);exit;
	}else{
	$sql = "select * from ".tablename('dg_article_count')." left join ".tablename('dg_article_user')." on ims_dg_article_count.userid=ims_dg_article_user.openid where fid=:fid limit ".intval($pindex-1)*$psize.",".$psize;
	$pram = array();
	$pram['fid'] = $openid;
	$result = pdo_fetchall($sql,$pram);
	$sql1 = "select count(*) from ".tablename('dg_article_count')." where fid=:fid";
	$total = pdo_fetchcolumn($sql1,$pram);
	$data = array();
	$data['total'] =isset($total)?$total:0;
	}
	include $this->template('my_downline');
 ?>