<?php 
defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
$op = (trim($_GPC["op"]) ? trim($_GPC["op"]) : "list");
if( $op == "list" ) 
{
    $_W["page"]["title"] = "顾客提现记录";
    $condition = " WHERE uniacid = :uniacid";
    $params[":uniacid"] = $_W["uniacid"];
    $sid = intval($_GPC["sid"]);
    if( 0 < $sid ) 
    {
        $condition .= " AND sid = :sid";
        $params[":sid"] = $sid;
    }

    $agentid = intval($_GPC["agentid"]);
    if( 0 < $agentid ) 
    {
        $condition .= " and agentid = :agentid";
        $params[":agentid"] = $agentid;
    }

    $status = intval($_GPC["status"]);
    if( 0 < $status ) 
    {
        $condition .= " AND status = :status";
        $params[":status"] = $status;
    }

    $days = (isset($_GPC["days"]) ? intval($_GPC["days"]) : -2);
    $todaytime = strtotime(date("Y-m-d"));
    $starttime = $todaytime;
    $endtime = $starttime + 86399;
    if( -2 < $days ) 
    {
        if( $days == -1 ) 
        {
            $starttime = strtotime($_GPC["addtime"]["start"]);
            $endtime = strtotime($_GPC["addtime"]["end"]);
            $condition .= " AND addtime > :start AND addtime < :end";
            $params[":start"] = $starttime;
            $params[":end"] = $endtime;
        }
        else
        {
            $starttime = strtotime("-" . $days . " days", $todaytime);
            $condition .= " and addtime >= :start";
            $params[":start"] = $starttime;
        }

    }

    $pindex = max(1, intval($_GPC["page"]));
    $psize = 15;
    $total = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("tiny_wmall_member_getcash_log") . $condition, $params);
    $records = pdo_fetchall("SELECT * FROM " . tablename("tiny_wmall_member_getcash_log") . $condition . " ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . "," . $psize, $params);
    if( !empty($records) ) 
    {
        foreach( $records as &$row ) 
        {
            $row["account"] = iunserializer($row["account"]);
        }
    }

    $pager = pagination($total, $pindex, $psize);
    $stores = pdo_getall("tiny_wmall_store", array( "uniacid" => $_W["uniacid"] ), array( "id", "title", "logo" ), "id");
}

if( $op == "status" ) 
{
    $id = intval($_GPC["id"]);
    $log = pdo_get("tiny_wmall_member_getcash_log", array( "uniacid" => $_W["uniacid"], "id" => $id ));
    if( empty($log) )
    {
        imessage(error(-1, "提现记录不存在"), "", "ajax");
    }

    if( $log["status"] == 1 ) 
    {
        imessage(error(-1, "该提现记录已处理"), "", "ajax");
    }

    $status = intval($_GPC["status"]);
    pdo_update("tiny_wmall_member_getcash_log", array( "status" => $status, "endtime" => TIMESTAMP ), array( "uniacid" => $_W["uniacid"], "id" => $id ));
    imessage(error(0, "设置提现状态成功"), "", "ajax");
}

if( $op == "transfers" ) 
{
    $id = intval($_GPC["id"]);
    $transfers = member_getcash_transfers($id);
    imessage($transfers, "", "ajax");
}

if( $op == "cancel" ) 
{
    $id = intval($_GPC["id"]);
    $log = pdo_get("tiny_wmall_member_getcash_log", array( "uniacid" => $_W["uniacid"], "id" => $id ));
    if( $log["status"] == 1 ) 
    {
        imessage(error(-1, "本次提现已成功,无法撤销"), referer(), "ajax");
    }
    else
    {
        if( $log["status"] == 3 ) 
        {
            imessage(error(-1, "本次提现已撤销"), referer(), "ajax");
        }

    }

    if( $_W["ispost"] )
    {
        //改变用户余额，添加记录
        $credit_log = array( $log['uid'], "提现撤销。备注：".$_GPC["remark"] );
        pdo_update("tiny_wmall_member_getcash_log", array("status"=>3), array( "uniacid" => $_W["uniacid"], "id" => $id ));
        require(WE7_WMALL_PATH . "model/member.mod.php");
        member_credit_update($log['uid'], "credit2", "+" .$log['get_fee'], $credit_log);
        imessage(error(0, "提现撤销成功"), referer(), "ajax");
    }

    include(itemplate("member/accountOp"));
    exit();
}

include(itemplate("member/getcash"));
?>