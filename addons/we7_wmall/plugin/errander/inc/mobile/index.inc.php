<?php  defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
icheckauth();
$op = (trim($_GPC["op"]) ? trim($_GPC["op"]) : "index");
$_W["page"]["title"] = "社区便利荟";
if( $op == "index" ) 
{
//	$orders = pdo_fetchall("select a.*,b.title,b.thumb from " . tablename("tiny_wmall_errander_order") . " as a left join " . tablename("tiny_wmall_errander_category") . " as b on a.order_cid = b.id where a.uniacid = :uniacid and a.agentid = :agentid order by a.id desc limit 5", array( ":uniacid" => $_W["uniacid"], ":agentid" => $_W["agentid"] ));
    $delivery_num = pdo_fetchcolumn("select count(*) from " . tablename("tiny_wmall_deliveryer") . " where uniacid = :uniacid and agentid = :agentid and is_errander = 1", array( ":uniacid" => $_W["uniacid"], ":agentid" => $_W["agentid"] ));
    $ajax_url = $_W['siteurl']."&op=list";
    $categorys = pdo_fetchall("select errander_name,thumb,value from" . tablename("tiny_wmall_errander_type") . " where uniacid = :uniacid  and status = 1 order by id asc", array( ":uniacid" => $_W["uniacid"] ));
    foreach ($categorys as $k=>$v)
    {
        $type = pdo_get("tiny_wmall_errander_category",array("uniacid" => $_W["uniacid"],"agentid" => $_W["agentid"],  "status" => 1, "type"=>$v['value'] ),array('id'));
        if (empty($type)){
            unset($categorys[$k]);
        }else{
            $categorys[$k]['id'] = $type['id'];
        }
    }

//    $categorys = pdo_getall("tiny_wmall_errander_category",array( "uniacid" => $_W["uniacid"], "agentid" => $_W["agentid"], "status" => 1 ));

//    $category_list = pdo_fetchall("select a.id,b.errander_name,b.thumb from " . tablename("tiny_wmall_errander_type") . " as b left join " . tablename("tiny_wmall_errander_category") . " as a on a.type = b.value and a.uniacid = b.uniacid where b.uniacid = :uniacid and b.status = 1 ", array( ":uniacid" => $_W["uniacid"] ));
//    $category_list = array(array('title'=>'','data'=>[]),array('title'=>'','data'=>[]),array('title'=>'','data'=>[]),array('title'=>'','data'=>[]));
//    foreach ($categorys as $k=>$v)
//    {
//        switch ($v['type'])
//        {
//            case "pickup";
//                $category_list[0]['title'] = '废品回收';
//                array_push($category_list[0]['data'],$v);
//                break;
//            case "buy";
//                $category_list[1]['title'] = '家政服务';
//                array_push($category_list[1]['data'],$v);
//                break;
//            case "delivery";
//                $category_list[2]['title'] = '家电维修';
//                array_push($category_list[2]['data'],$v);
//                break;
//            case "errand";
//                $category_list[3]['title'] = '社区跑腿';
//                array_push($category_list[3]['data'],$v);
//                break;
//        }
//    }

    //轮播图
    $slides = sys_fetch_slide();

}

if ( $op == "list" )
{
    //分类搜索条件
    $type = $_GPC['type'];//分类id
    $condition = ' where uniacid = :uniacid and agentid = :agentid and status = 1';
    $params = array( ":uniacid" => $_W["uniacid"], ":agentid" => $_W["agentid"] );
    //分类搜索
    if (!empty($type)){
        $condition .= " and type = '".$type."'";
    }
    //排序
    $order_by = " order by displayorder desc";
    //活动列表
    $categorys = pdo_fetchall('select * from ' . tablename('tiny_wmall_errander_category') . "{$condition} {$order_by}", $params);

    if (!empty($categorys)){
        exit(json_encode(['status'=>1,'data'=>$categorys,'msg'=>'成功！']));
    }else{
        exit(json_encode(['status'=>2,'msg'=>'没有数据！']));
    }

    //$categorys = pdo_fetchall("select * from " . tablename("tiny_wmall_errander_category") . " where uniacid = :uniacid and agentid = :agentid and status = 1 order by displayorder desc", array( ":uniacid" => $_W["uniacid"], ":agentid" => $_W["agentid"] ));
    //imessage(error(0, $categorys), "", "ajax");
}

if( $op == "deliveryer" ) 
{
	mload()->model("deliveryer");
	$deliveryer = deliveryer_fetchall();
	imessage(error(0, $deliveryer), "", "ajax");
}

include(itemplate("index"));
?>