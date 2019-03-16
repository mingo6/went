<?php  defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
$op = (trim($_GPC["op"]) ? trim($_GPC["op"]) : "list");
if( $op == "list" ) 
{
	$_W["page"]["title"] = "商品列表";
	if( $_W["ispost"] ) 
	{
		if( !empty($_GPC["ids"]) ) 
		{
			foreach( $_GPC["ids"] as $k => $v ) 
			{
				$data = array( "title" => trim($_GPC["titles"][$k]), "old_price" => floatval($_GPC["old_prices"][$k]), "displayorder" => intval($_GPC["displayorders"][$k]) );
				pdo_update("tiny_wmall_cutPrice_goods", $data, array( "uniacid" => $_W["uniacid"], "id" => intval($v) ));
			}
		}
		imessage(error(0, "修改成功"), iurl("cutPrice/goods/list"), "ajax");
	}
	$condition = " where uniacid = :uniacid";
	$params = array( ":uniacid" => $_W["uniacid"] );
	$type = trim($_GPC["type"]);
	if( !empty($type) ) 
	{
		$condition .= " and type_id = :type_id";
		$params[":type_id"] = $type;
	}

	if( !empty($_GPC["keyword"]) )
	{
		$condition .= " AND name LIKE '%" . $_GPC["keyword"] . "%'";
	}
	$lists = pdo_fetchall("select * from" . tablename("tiny_wmall_cutPrice_goods") . $condition . " order by num desc", $params);

	//商品分类
    $category = pdo_getall("tiny_wmall_cutPrice_category",array("uniacid" => $_W["uniacid"]));

}
if( $op == "post" ) 
{
	$_W["page"]["title"] = "编辑商品";
	$id = intval($_GPC["id"]);
	if( 0 < $id ) 
	{
		$item = cutPrice_goods_get($id);
		$item["redpacket"] = iunserializer($item["redpacket"]);
	}
	$categorys = cutPrice_category_get();
	$store = pdo_getall('tiny_wmall_store',array('uniacid'=>$_W['uniacid'],'status !=' => 4),array('id','title'));
	if( $_W["ispost"] )
	{
	    //需要编辑的字段
		$data = $_POST;
        $data['start_time']=strtotime($_GPC['start_time']);
        $data['end_time']=strtotime($_GPC['end_time']);
        $data['uniacid']=$_W["uniacid"];
		unset($data['token']);

		//验证字段
		if ($data['cut_min_price']<=0 || $data['cut_min_price']>=$data['y_price']) imessage(error(-1, "砍价金额必须大于0且不能大于原价"), "", "ajax");
		if ($data['cut_max_price']<=$data['cut_min_price']) imessage(error(-1, "砍价最大金额必须大于最小金额"), "", "ajax");
		if ($data['cut_people_num']<=0) imessage(error(-1, "限制人数必须大于0"), "", "ajax");
		if ($data['start_time']>=$data['end_time']) imessage(error(-1, "活动结束时间必须大于活动开始时间"), "", "ajax");
		if (empty($data['sid'])) imessage(error(-1, "请选择绑定商户"), "", "ajax");
		if (empty($data['thumb'])) imessage(error(-1, "请选择商品图片"), "", "ajax");
		if ($data['y_price']<=0) imessage(error(-1, "原价必须大于0"), "", "ajax");
		if ($data['s_price']<=0 || $data['s_price']>=$data['y_price']) imessage(error(-1, "最低价必须大于0且不能大于原价"), "", "ajax");
		if (!empty($data['sale_num']) && $data['sale_num']<0) $data['sale_num']=0;

        //编辑商品表
        $goods_info = array(
            "sid" => $_GPC["sid"],
            "uniacid" => $_W["uniacid"],
            "title" => trim($_GPC["name"]),
            "price" => floatval($_GPC["y_price"]),
            "box_price" => 0,
            "unitname" => '个/份',
            "total" => intval($_GPC["number"]),
            "sailed" => 0,
            "status" => intval($_GPC["is_shelves"]),
            "cid" => 0,
            "thumb" => trim(str_replace($_W['siteroot'].'attachment/','',$_GPC["thumb"])),
            "label" => '',
            "displayorder" => intval($_GPC["num"]),
            "description" => htmlspecialchars_decode($_GPC["details"]),
            "is_hot" => 0
        );
        $data['thumb'] = trim(str_replace($_W['siteroot'].'attachment/','',$_GPC["thumb"]));

		if( 0 < $id )
		{
			pdo_update("tiny_wmall_cutPrice_goods", $data, array( "uniacid" => $_W["uniacid"], "id" => $id ));

			$gid = pdo_get("tiny_wmall_cutPrice_goods", array( "uniacid" => $_W["uniacid"], "id" => $id ),array('gid'));
			pdo_update("tiny_wmall_goods", $goods_info, array( "uniacid" => $_W["uniacid"], "id" => $gid['gid'] ));
		}
		else 
		{
            pdo_insert("tiny_wmall_goods", $goods_info);
            $gid = pdo_insertid();

            $data['create_time'] = time();
            $data['gid'] = $gid;
			pdo_insert("tiny_wmall_cutPrice_goods", $data);
		}

		imessage(error(0, "编辑商品成功"), iurl("cutPrice/goods/list"), "ajax");
	}
}
if( $op == "status" ) 
{
	$id = intval($_GPC["id"]);
	$status = intval($_GPC["status"]);
	$state = pdo_update("tiny_wmall_cutPrice_goods", array( "status" => $status ), array( "uniacid" => $_W["uniacid"], "id" => $id ));
	if( $state === false ) 
	{
		imessage(error(-1, "操作失败"), "", "ajax");
	}
	imessage(error(0, "操作成功"), "", "ajax");
}
if( $op == "del" ) 
{
	$ids = $_GPC["id"];
	if( !is_array($ids) ) 
	{
		$ids = array( $ids );
	}
	foreach( $ids as $v ) 
	{
		pdo_delete("tiny_wmall_cutPrice_goods", array( "uniacid" => $_W["uniacid"], "id" => $v ));
	}
	imessage(error(0, "删除商品成功"), "", "ajax");
}
include(itemplate("goods"));
?>