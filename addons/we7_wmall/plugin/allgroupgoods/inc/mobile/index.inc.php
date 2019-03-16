<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
$_W['page']['title'] = "拼团活动";
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'index';

if ($op == 'index'){    //拼团列表
	global $_W, $_GPC;
	$time=time();
	if($_W['isajax']){
		$where= " where a.uniacid={$_W['uniacid']} and a.end_time >{$time} and a.is_shelves=1";
		if($_GPC['type_id']){
			$where.=" and a.type_id=".$_GPC['type_id'];
		}
		if($_GPC['sid']){
			$where.=" and a.sid=".$_GPC['sid'];
		}
		if($_GPC['display']){
			$where.=" and a.display=1";
		}
		$pageindex = max(1, intval($_GPC['page']));
		$pagesize=empty($_GPC['pagesize'])?10:$_GPC['pagesize'];
		$sql="select a.* from " . tablename("tiny_wmall_allgroupgoods_goods"). " a  left join " . tablename("tiny_wmall_store") . " b on b.id=a.sid" .$where." order by num asc";
		$select_sql = $sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
		$data['list'] = pdo_fetchall($select_sql);
		$sql="select count(a.id) from " . tablename("tiny_wmall_allgroupgoods_goods"). " a  left join " . tablename("tiny_wmall_store") . " b on b.id=a.sid" .$where." order by num asc";
		$select_sql = $sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
		$total = (int)pdo_fetchcolumn($select_sql);
		foreach($data['list'] AS &$value){
			$value["thumb"] = tomedia($value["thumb"]);
			unset($value);
		}
		$list = ajaxPagination($data['list'], $total, $pageindex);
		echo json_encode(isuccess('OK', $list));
		exit;
	}
	
}
include itemplate('index');