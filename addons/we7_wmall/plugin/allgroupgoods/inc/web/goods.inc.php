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
				pdo_update("tiny_wmall_allgroupgoods_goods", $data, array( "uniacid" => $_W["uniacid"], "id" => intval($v) ));
			}
		}
		imessage(error(0, "修改成功"), iurl("allgroupgoods/goods/list"), "ajax");
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
	$lists = pdo_fetchall("select * from" . tablename("tiny_wmall_allgroupgoods_goods") . $condition . " order by num desc", $params);

	//商品分类
    $category = pdo_getall("tiny_wmall_allgroupgoods_category",array("uniacid" => $_W["uniacid"]));

}
if( $op == "post" ) 
{
	$_W["page"]["title"] = "编辑商品";
	$id = intval($_GPC["id"]);
	if( 0 < $id ) 
	{
		$item = allgroupgoods_goods_get($id);
		$item['img'] = explode(',',$item['img']);
		// $item["redpacket"] = iunserializer($item["redpacket"]);
	}
	$categorys = allgroupgoods_category_get();
	//商户分类
	$stores = pdo_getall('tiny_wmall_store', array('uniacid' => $_W['uniacid']), array('id', 'title', 'logo', 'cid'));
	
	if( $_W["ispost"] ) 
	{
		$data = $_POST;
		$data['sid']=intval($_GPC['sid']);
		if($data['sid'] <= 0){
			imessage(error(-1, "sid不存在"), "", "ajax");
		}
		$storeInfo = pdo_fetchall("SELECT id FROM " . tablename('tiny_wmall_store') . ' WHERE uniacid = :uniacid AND id = :id', array(':uniacid' => $_W['uniacid'], ':id' => $_GPC['sid']), 'id');
		if(!$storeInfo){
			imessage(error(-1, "商户不存在！"), "", "ajax");
		}
		$info = store_get_data($data['sid']);
        $data['start_time']=strtotime($_GPC['start_time']);
        $data['end_time']=strtotime($_GPC['end_time']);
        $data['xf_time']=strtotime($_GPC['xf_time']);
        $data['uniacid']=$_W["uniacid"];
		unset($data['token']);

		if (empty($data['thumb'])) imessage(error(-1, "请选择商品图片"), "", "ajax");
		if(!empty($_GPC['img'])){
			$data['img']=implode(",",$_GPC['img']);
		}else{
			$data['img']='';
		}
        if ($data['y_price']<=0) imessage(error(-1, "原价必须大于0"), "", "ajax");
        if ($data['pt_price']<=0 || $data['pt_price']>$data['y_price']) imessage(error(-1, "售价必须大于0且不能大于原价"), "", "ajax");
        if ($data['dd_price']<=0) imessage(error(-1, "单独购买价格必须大于0"), "", "ajax");
        if ($data['people']<=0) imessage(error(-1, "开团人数必须大于0"), "", "ajax");
        if ($data['inventory']<=0) imessage(error(-1, "库存必须大于0"), "", "ajax");
        if ($data['start_time']>=$data['end_time']) imessage(error(-1, "活动结束时间必须大于活动开始时间"), "", "ajax");

		if( 0 < $id )
		{
			pdo_update("tiny_wmall_allgroupgoods_goods", $data, array( "uniacid" => $_W["uniacid"], "id" => $id ));
		}
		else 
		{
            $data['create_time']=time();
			pdo_insert("tiny_wmall_allgroupgoods_goods", $data);
		}
		imessage(error(0, "编辑商品成功"), iurl("allgroupgoods/goods/list"), "ajax");
	}
}
if( $op == "status" ) 
{
	$id = intval($_GPC["id"]);
	$status = intval($_GPC["status"]);
	$state = pdo_update("tiny_wmall_allgroupgoods_goods", array( "status" => $status ), array( "uniacid" => $_W["uniacid"], "id" => $id ));
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
		pdo_delete("tiny_wmall_allgroupgoods_goods", array( "uniacid" => $_W["uniacid"], "id" => $v ));
	}
	imessage(error(0, "删除商品成功"), "", "ajax");
}
include(itemplate("goods"));
?>