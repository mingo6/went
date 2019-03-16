<?php
global $_W,$_GPC;
load()->func('tpl');
$uniacid = $_W['uniacid'];
$op = !empty($_GPC['op'])?$_GPC['op']:'display';
if($op == 'post'){
	$data = array();
	$data['agent_name'] = $_GPC['agent_name'];
	$data['uniacid'] = $uniacid;
	$data['persent'] = $_GPC['persent']/100;
	$data['add_time'] = time();
	$result = pdo_insert('dg_article_agent',$data);
	if(!empty($result)){
		message("添加成功！","","success");exit;
	}
}
$pindex=max(1,intval($_GPC['page']));
$psize=10;
$sql = "select * from" .tablename('dg_article_agent')."where uniacid=:uniacid order by a_id asc limit " .intval($pindex-1)*$psize.",".$psize;
$pram = array();
$pram[':uniacid'] = $uniacid;
$agent_list = pdo_fetchall($sql,$pram);
//分页
$total=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_agent')." where uniacid=:uniacid  ",$pram);
$pager=pagination($total,$pindex,$psize);
include  $this->template('user_set');
?>