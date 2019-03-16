<?php  defined("IN_IA") or exit( "Access Denied" );



//砍价方法
function kj($userData,$wkj,$uid,$userInfo)
{
    global $_W;
    //查找用户是否已经砍价
    $dbFirend = pdo_fetch("select * from " . tablename('tiny_wmall_cutPrice_firend') . " where uid=:uid and openid = :openid", array(":uid"=>$uid,":openid"=>$userInfo['openid']));
    $user = $userData;
    if ($user['price'] <= $wkj['s_price']) {
        return array(0, "好友砍价过猛已经最低价啦，下次再来帮好友砍吧！");
    }
    $k_price = rand($wkj['cut_min_price']*100,$wkj['cut_max_price']*100)/100;
    if ($user['price'] - $k_price < $wkj['s_price']) {//最低价控制
        $k_price = $user['price'] - $wkj['s_price'];
    }

    if (empty($dbFirend)) {
        //商品金额-砍价金额
        $leftPrice = $user['price'] - $k_price;
        if ($leftPrice <= $wkj['s_price']) {
            $leftPrice = $wkj['s_price'];
        }
        $helpFirend = array(
            'kid' => $wkj['id'],
            'uid' => $uid,
            'openid' => $userInfo['openid'],
            'nickname' => $userInfo['nickname'],
            'headimgurl' => $userInfo['avatar'],
            'k_price' => $k_price,
            'kh_price' => $leftPrice,
            'ip' => $_W['clientip'],
            'createtime' => time()
        );
        pdo_insert('tiny_wmall_cutPrice_firend',$helpFirend);
        pdo_update('tiny_wmall_cutPrice_user',array('price' => $leftPrice),array('id'=>$uid));
    } else{
        return array(0, "已经帮好友砍过价了，下次再继续吧！！");
    }
    return array($k_price, '手气真大，砍掉了这么多！！');
}

//活动状态
function getStatus($status)
{
    switch ($status) {
        case 0:
            return "未开始";
            break;
        case 1:
            return "正常";
            break;
        case 2:
            return "已结束";
            break;
        case 3:
            return "已付款";
            break;
        case 4:
            return "配送中";
            break;
        case 5:
            return "已完成";
            break;
        case 6:
            return "已售完 ";
            break;
    }
}


function parse_duiba_notify($request_array) 
{
	global $_W;
	global $_GPC;
	$config = get_plugin_config("cutPrice");
	if( empty($config) || !is_array($config) ) 
	{
		return error(-1, "积分商城配置出错");
	}
	if( empty($config["appkey"]) ) 
	{
		return error(-1, "兑吧appkey为空");
	}
	if( empty($config["appsecret"]) ) 
	{
		return error(-1, "兑吧appsecret为空");
	}
	pload()->func("duiba");
	$filter = array( "i", "channel" );
	foreach( $request_array as $key => $val ) 
	{
		if( in_array($key, $filter) ) 
		{
			unset($request_array[$key]);
		}
	}
	if( empty($request_array["channel"]) || $request_array["channel"] == "credit" ) 
	{
		$result = parseCreditConsume($config["appkey"], $config["appsecret"], $request_array);
	}
	else 
	{
		$result = parseCreditNotify($config["appkey"], $config["appsecret"], $request_array);
	}
	if( !is_array($result) ) 
	{
		return error(-1, $result);
	}
	return $result;
}
function cutPrice_adv_get($status = -1)
{
	global $_W;
	$condition = " where uniacid = :uniacid";
	$params = array( ":uniacid" => $_W["uniacid"] );
	if( $status != -1 ) 
	{
		$condition .= " and status = " . $status;
	}
	$data = pdo_fetchall("select * from" . tablename("tiny_wmall_cutPrice_adv") . " " . $condition . " order by displayorder desc", $params);
	if( !empty($data) ) 
	{
		foreach( $data as &$value ) 
		{
			$value["thumb"] = tomedia($value["thumb"]);
		}
	}
	return $data;
}
function cutPrice_can_exchange_goods($idOrGoods, $uid = "")
{
	global $_W;
	$goods = $idOrGoods;
	if( !is_array($goods) ) 
	{
		$goods = cutPrice_goods_get($goods);
	}
	if( empty($goods) ) 
	{
		return error(-1, "商品不存在！");
	}
	if( empty($uid) ) 
	{
		$uid = $_W["member"]["uid"];
	}
	$records_num = pdo_fetchcolumn("select count(*) FROM " . tablename("tiny_wmall_cutPrice_order_new") . " where uniacid = :uniacid and uid = :uid and goods_id = :goods_id ", array( ":uniacid" => $_W["uniacid"], "uid" => $uid, ":goods_id" => $goods["id"] ));
	if( $goods["chance"] <= $records_num ) 
	{
		return error(-2, "兑换已达最大次数！");
	}
	return error(0, "可以兑换！");
}
function cutPrice_category_get($status = -1)
{
	global $_W;
	$condition = " where uniacid = :uniacid";
	$params = array( ":uniacid" => $_W["uniacid"] );
	if( $status != -1 ) 
	{
		$condition .= " and status = " . $status;
	}
	$data = pdo_fetchall("select * from " . tablename("tiny_wmall_cutPrice_category") . " " . $condition . " order by displayorder desc", $params);
	if( !empty($data) ) 
	{
		foreach( $data as &$value ) 
		{
			$value["thumb"] = tomedia($value["thumb"]);
		}
	}
	return $data;
}
function cutPrice_goodsall_get($filter = array( ))
{
	global $_W;
	global $_GPC;
	if( empty($filter) ) 
	{
		if( !empty($_GPC["type"]) ) 
		{
			$filter["type"] = trim($_GPC["type"]);
		}
		if( !empty($_GPC["title"]) ) 
		{
			$filter["title"] = trim($_GPC["title"]);
		}
		if( !empty($_GPC["category_id"]) ) 
		{
			$filter["category_id"] = intval($_GPC["category_id"]);
		}
	}
	if( empty($filter["page"]) ) 
	{
		$filter["page"] = max(1, $_GPC["page"]);
	}
	if( empty($filter["psize"]) ) 
	{
		$filter["psize"] = (intval($_GPC["psize"]) ? intval($_GPC["psize"]) : 20);
	}
	$condition = " where uniacid = :uniacid and status = 1";
	$params = array( ":uniacid" => $_W["uniacid"] );
	if( !empty($filter["type"]) ) 
	{
		$condition .= " and type = :type";
		$params[":type"] = $filter["type"];
	}
	if( !empty($filter["title"]) ) 
	{
		$condition .= " AND title LIKE '%" . $filter["title"] . "%'";
	}
	if( !empty($filter["category_id"]) ) 
	{
		$condition .= " and category_id = :category_id";
		$params[":category_id"] = $filter["category_id"];
	}
	$data = pdo_fetchall("SELECT * FROM " . tablename("tiny_wmall_cutPrice_goods") . " " . $condition . " ORDER BY displayorder DESC LIMIT " . ($filter["page"] - 1) * $filter["psize"] . ", " . $filter["psize"], $params);
	if( !empty($data) ) 
	{
		foreach( $data as &$value ) 
		{
			$value["thumb"] = tomedia($value["thumb"]);
			if( $value["type"] == "redpacket" ) 
			{
				$value["redpacket"] = iunserializer($value["redpacket"]);
			}
		}
	}
	return $data;
}
function cutPrice_goods_get($goods_id)
{
	global $_W;
	if( empty($goods_id) ) 
	{
		return error(-1, "请输入商品编号");
	}
	$data = pdo_get("tiny_wmall_cutPrice_goods", array( "uniacid" => $_W["uniacid"], "id" => $goods_id ));
	$data["records_num"] = pdo_fetchcolumn("select count(*) FROM " . tablename("tiny_wmall_cutPrice_order_new") . " where uniacid = :uniacid and goods_id = :goods_id ", array( ":uniacid" => $_W["uniacid"], ":goods_id" => $goods_id ));
	if( !empty($data) ) 
	{
		$data["thumb"] = tomedia($data["thumb"]);
		if( $data["type"] == "redpacket" ) 
		{
			$data["redpacket"] = iunserializer($data["redpacket"]);
		}
	}
	return $data;
}
function cutPrice_record_get($filter = array( ))
{
	global $_W;
	global $_GPC;
	if( empty($filter) ) 
	{
		if( !empty($_GPC["id"]) ) 
		{
			$filter["goods_id"] = intval($_GPC["id"]);
		}
		else 
		{
			return error(-1, "请输入商品编号");
		}
	}
	if( empty($filter["page"]) ) 
	{
		$filter["page"] = max(1, $_GPC["page"]);
	}
	if( empty($filter["psize"]) ) 
	{
		$filter["psize"] = (intval($_GPC["psize"]) ? intval($_GPC["psize"]) : 15);
	}
	$data = pdo_fetchall("select a.addtime, b.avatar, b.nickname FROM " . tablename("tiny_wmall_cutPrice_order_new") . " as a left join " . tablename("tiny_wmall_members") . " as b on a.uid = b.uid where a.uniacid = :uniacid and a.goods_id = :goods_id limit " . ($filter["page"] - 1) * $filter["psize"] . ", " . $filter["psize"], array( ":uniacid" => $_W["uniacid"], ":goods_id" => $filter["goods_id"] ));
	if( !empty($data) ) 
	{
		foreach( $data as &$value ) 
		{
			$value["addtime"] = date("Y/m/d H:i", $value["addtime"]);
		}
	}
	return $data;
}
function cutPrice_order_get($id)
{
	global $_W;
	$data = pdo_get("tiny_wmall_cutPrice_order_new", array( "uniacid" => $_W["uniacid"], "id" => $id ));
	if( !empty($data) ) 
	{
		$data["data"] = iunserializer($data["data"]);
		$data["addtime"] = date("Y/m/d H:i", $data["addtime"]);
		$goods = cutPrice_goods_get($data["goods_id"]);
		$data["goods_info"] = $goods;
	}
	return $data;
}
function cutPrice_orderall_get($filter = array( ))
{
	global $_W;
	global $_GPC;
	if( empty($filter["page"]) ) 
	{
		$filter["page"] = max(1, $_GPC["page"]);
	}
	if( empty($filter["psize"]) ) 
	{
		$filter["psize"] = (intval($_GPC["psize"]) ? intval($_GPC["psize"]) : 6);
	}
	$condition = " where a.uniacid = :uniacid and a.uid = :uid";
	$params = array( ":uniacid" => $_W["uniacid"], ":uid" => $_W["member"]["uid"] );
	$data = pdo_fetchall("select a.*, c.title, c.thumb from " . tablename("tiny_wmall_cutPrice_order_new") . " as a left join " . tablename("tiny_wmall_cutPrice_goods") . " as c on a.goods_id = c.id " . $condition . " order by a.id desc limit " . ($filter["page"] - 1) * $filter["psize"] . ", " . $filter["psize"], $params);
	if( !empty($data) ) 
	{
		foreach( $data as &$value ) 
		{
			$value["addtime"] = date("Y/m/d H:i", $value["addtime"]);
			$value["data"] = iunserializer($value["data"]);
			$value["thumb"] = tomedia($value["thumb"]);
		}
	}
	return $data;
}
function cutPrice_order_update($orderOrId, $type, $extra = array( ))
{
	global $_W;
	$order = $orderOrId;
	if( !is_array($order) ) 
	{
		$order = cutPrice_order_get($order);
	}
	if( empty($order) ) 
	{
		return error(-1, "商品不存在！");
	}
	if( $type == "pay" ) 
	{
		$update = array( "is_pay" => 1, "pay_type" => $extra["type"], "paytime" => TIMESTAMP );
		pdo_update("tiny_wmall_cutPrice_order_new", $update, array( "id" => $order["id"] ));
		if( $order["goods_type"] == "redpacket" ) 
		{
			mload()->model("redPacket");
			$redpacket = $order["data"]["redpacket"];
			$data = array( "title" => $redpacket["name"], "channel" => "cutPrice", "type" => "grant", "discount" => $redpacket["discount"], "days_limit" => $redpacket["use_days_limit"], "grant_days_effect" => $redpacket["grant_days_effect"], "condition" => $redpacket["condition"], "uid" => $order["uid"] );
			$res = redPacket_grant($data);
			if( $res ) 
			{
				pdo_update("tiny_wmall_cutPrice_order_new", array( "grant_status" => 1 ), array( "id" => $order["id"] ));
				return NULL;
			}
		}
		else 
		{
			if( $order["goods_type"] == "credit2" ) 
			{
				$res = member_credit_update($order["uid"], "credit2", $order["data"]["credit2"]);
				if( $res ) 
				{
					pdo_update("tiny_wmall_cutPrice_order_new", array( "grant_status" => 1 ), array( "id" => $order["id"] ));
					return NULL;
				}
			}
		}
	}
	else 
	{
		if( $type == "handle" ) 
		{
			if( $order["status"] == 1 ) 
			{
				pdo_update("tiny_wmall_cutPrice_order_new", array( "status" => 2 ), array( "id" => $order["id"] ));
				return NULL;
			}
		}
		else 
		{
			if( $type == "cancel" && $order["is_pay"] == 0 && $order["status"] == 1 && 0 < $order["use_credit1"] && $order["use_credit1_status"] == 1 && 0 < $order["use_credit2"] ) 
			{
				$status = member_credit_update($order["uid"], "credit1", $order["use_credit1"]);
				if( is_error($status) ) 
				{
					imessage(-1, $status["message"], "", "ajax");
				}
				pdo_update("tiny_wmall_cutPrice_order_new", array( "status" => 3 ), array( "id" => $order["id"] ));
			}
		}
	}
}
?>