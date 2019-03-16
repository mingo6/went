<?php 
	global $_W,$_GPC;
	load()->func('tpl');
	$uniacid = $_W['uniacid'];
	echo 1;
	$id=$_GPC['a_id'];
	include  $this->template('set_user');
 ?>