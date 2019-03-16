<?php
global $_GPC,$_W;
$uniacid = $_W['uniacid'];
$op=empty($_GPC['op'])?"display":$_GPC['op'];

if($op=="display"){
	$sql1='select count(id) as total,sum(pay_money) as pay_money  from '.tablename('dg_article_payment').' where order_status=1 and uniacid=:uniacid';
	$sql2='select count(id) as total,sum(recharge) as pay_money  from '.tablename('dg_article_recharge').' where rec_status=1 and uniacid=:uniacid';
	$sql="select sum(total) as total,sum(pay_money) as pay_money  from (".$sql1." union all ".$sql2." )b";
	
	
	$total = pdo_fetch($sql,array(':uniacid'=>$uniacid));
	$yt = 24*3600;
	$time =array(
		'today'=>date('Y-m-d',time()),
		'zuotian'=>date('Y-m-d',time()-$yt),
		'jinqitian'=>date('Y-m-d',time()-(7*$yt)),
		'jinyigeyue'=>date('Y-m-d',time()-(30*$yt))
	);
	//今日
	$starttime=strtotime("{$time['today']} 00:00:00"); 
	$endtime=strtotime("{$time['today']} 23:59:59");
	$a_sql1 = 'select count(id) as total,sum(pay_money) as pay_money  from '.tablename('dg_article_payment')." where order_status=1 and uniacid=:uniacid and pay_time > {$starttime} and pay_time < {$endtime}";
	$a_sql2='select count(id) as total,sum(recharge) as pay_money  from '.tablename('dg_article_recharge')." where rec_status=1 and uniacid=:uniacid and rec_time > {$starttime} and rec_time < {$endtime}";
	$a_sql="SELECT SUM(total) AS total,SUM(pay_money) AS pay_money FROM( ".$a_sql1." union all ".$a_sql2." )a";
	
	$a = pdo_fetch($a_sql,array(':uniacid'=>$uniacid));
	
	//昨天		
	$zuotian=strtotime("{$time['zuotian']} 00:00:00"); 
	$zuotian_end=strtotime("{$time['zuotian']} 23:59:59");
	$b_sql1 = 'select count(id) as total,sum(pay_money) as pay_money  from '.tablename('dg_article_payment')." where order_status=1 and uniacid=:uniacid and pay_time > {$zuotian} and pay_time < {$zuotian_end}";
	$b_sql2='select count(id) as total,sum(recharge) as pay_money  from '.tablename('dg_article_recharge')." where rec_status=1 and uniacid=:uniacid and rec_time > {$zuotian} and rec_time < {$zuotian_end}";
	$b_sql="SELECT SUM(total) AS total,SUM(pay_money) AS pay_money FROM( ".$b_sql1." union all ".$b_sql2." )b";
	$b = pdo_fetch($b_sql,array(':uniacid'=>$uniacid));	
	
	//近七天
	$jinqitian=strtotime("{$time['jinqitian']} 00:00:00"); 
	$jinqitian_end=strtotime("{$time['today']} 23:59:59");
	$c_sql1 = 'select count(id) as total,sum(pay_money) as pay_money  from '.tablename('dg_article_payment')." where order_status=1 and uniacid=:uniacid and pay_time > {$jinqitian} and pay_time < {$jinqitian_end}";
	$c_sql2='select count(id) as total,sum(recharge) as pay_money  from '.tablename('dg_article_recharge')." where rec_status=1 and uniacid=:uniacid and rec_time > {$jinqitian} and rec_time < {$jinqitian_end}";
	$c_sql="SELECT SUM(total) AS total,SUM(pay_money) AS pay_money FROM( ".$c_sql1." union all ".$c_sql2." )c";
	$c = pdo_fetch($c_sql,array(':uniacid'=>$uniacid));	
	
	//近一个月 本@模@块@来@自@新@睿@社@区！
	$yue=strtotime("{$time['jinyigeyue']} 00:00:00"); 
	$yue_end=strtotime("{$time['today']} 23:59:59");
	$d_sql1 = 'select count(id) as total,sum(pay_money) as pay_money  from '.tablename('dg_article_payment')." where order_status=1 and uniacid=:uniacid and pay_time > {$yue} and pay_time < {$yue_end}";
	$d_sql2='select count(id) as total,sum(recharge) as pay_money  from '.tablename('dg_article_recharge')." where rec_status=1 and uniacid=:uniacid and rec_time > {$yue} and rec_time < {$yue_end}";
	$d_sql="SELECT SUM(total) AS total,SUM(pay_money) AS pay_money FROM( ".$d_sql1." union all ".$d_sql2." )d";
	
	$d = pdo_fetch($d_sql,array(':uniacid'=>$uniacid));	

}else{
	$start = empty($_GPC['time']['start']) ? TIMESTAMP -  86399 * 6 : strtotime($_GPC['time']['start']);
	$end = empty($_GPC['time']['end']) ? TIMESTAMP + 6*86400: strtotime($_GPC['time']['end']);
	$pay_time = intval($_GPC['pay_time']);//时间

	$pindex = max(1, intval($_GPC['page']));
	//$page = max(1, intval($_GPC['page']));
	$psize=10;
	$condition="";
	if(!empty($_GPC['time']['start'])&& !empty($_GPC['time']['end'])){
		$condition=" and ".strtotime($_GPC['time']['start']."00:00:00").">A1.pay_time<".strtotime($_GPC['time']['end']."00:00:00");
	}
	
	
	$condition2="";
	if(!empty($_GPC['time']['start'])&& !empty($_GPC['time']['end'])){
		$condition2=" and ".strtotime($_GPC['time']['start']."00:00:00").">A1.rec_time<".strtotime($_GPC['time']['end']."00:00:00");
	}
	

	$sql="select A1.pay_time,A2.nickname,A2.avatar,'课程付费' as type,(select title from ".tablename('dg_article').' where id=A1.article_id) as title,A1.pay_money as pay_money from '.tablename('dg_article_payment').' A1 left join '.tablename('dg_article_user').' A2 on A1.openid=A2.openid where A1.order_status=1 and A1.uniacid=:uniacid and A1.article_id is not null '.$condition;
	
	$sql2="select A1.rec_time as pay_time,A2.nickname,A2.avatar,'充值会员' as type,'' as title,recharge as pay_money from ".tablename('dg_article_recharge').' A1 left join '.tablename('dg_article_user').' A2 on A1.openid=A2.openid where A1.rec_status=1 and A1.uniacid=:uniacid '.$condition2;
	
	$sql3="select A1.pay_time,A2.nickname,A2.avatar,'专栏付费' as type,(select serialize_title from ".tablename('dg_article_serialize').' where id=A1.serialize_id) as title,A1.pay_money as pay_money from '.tablename('dg_article_payment').' A1 left join '.tablename('dg_article_user').' A2 on A1.openid=A2.openid where A1.serialize_id is not null AND A1.order_status=1 and A1.uniacid=:uniacid '.$condition;
	
	
	
	$list3=pdo_fetchall($sql,array(":uniacid"=>$uniacid));
	$list4=pdo_fetchall($sql2,array(":uniacid"=>$uniacid));
	$list5=pdo_fetchall($sql3,array(":uniacid"=>$uniacid));
	$total=count($list3)+count($list4)+count($list5);
	$pager = pagination($total, $pindex, $psize);
	
	
	$sql_all="SELECT a.* FROM ( ".$sql." UNION ALL ".$sql2." UNION ALL ".$sql3." )a order by pay_time desc ";
	
	$list=pdo_fetchall($sql_all." LIMIT " . ($pindex - 1) * $psize . ',' . $psize,array(":uniacid"=>$uniacid));
	// $list2=pdo_fetchall($sql2." LIMIT " . ($pindex - 1) * $psize . ',' . $psize,array(":uniacid"=>$uniacid));
}
include $this->template('statistic');

?>