<?php 
defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
$_W["page"]["title"] = "申请提现";
icheckauth();
$account = $_W["member"];
$uid = $account['uid'];

//用户提现配置
$account['wechat']["openid"] = $account["openid"];
$account['wechat']["openid_wxapp"] = $account["openid_wxapp"];
$account['wechat']["nickname"] = $account["nickname"];
$account['wechat']["avatar"] = $account["avatar"];
$account['wechat']["realname"] = $account["nickname"];

//提现配置
$account["fee_limit"] = $_W['we7_wmall']['config']['member']['fee_getcash']['get_cash_fee_limit'];//最小提现金额
$account["fee_period"] = $_W['we7_wmall']['config']['member']['fee_getcash']['get_cash_fee_period'];//提现周期
$account["fee_rate"] = $_W['we7_wmall']['config']['member']['fee_getcash']['get_cash_fee_rate'];//提现费率
$account["fee_min"] = $_W['we7_wmall']['config']['member']['fee_getcash']['get_cash_fee_min'];//最小提现费用
$account["fee_max"] = $_W['we7_wmall']['config']['member']['fee_getcash']['get_cash_fee_max'];//最大提现费用

if( $_W["isajax"] ) 
{
    //提现金额
    $get_fee = floatval($_GPC["fee"]);
    $wx_account = $_GPC["wx_account"];

    if( !$get_fee ) imessage(error(-1, "提现金额有误"), "", "ajax");
    if( $get_fee < $account["fee_limit"] ) imessage(error(-1, "提现金额小于最低提现金额限制"), "", "ajax");
    if( $account["credit2"] < $get_fee )
        imessage(error(-1, "提现金额大于账户可用余额"), "", "ajax");

    $fee_period = $account["fee_period"] * 24 * 3600;
    if( 0 < $fee_period ) 
    {
        $getcash_log = pdo_fetch("select addtime from " . tablename("tiny_wmall_member_getcash_log") . " where uniacid = :uniacid and uid = :uid order by addtime desc", array( ":uniacid" => $_W["uniacid"], ":uid" => $uid ));
        $last_getcash = $getcash_log["addtime"];
        if( TIMESTAMP < $last_getcash + $fee_period ) imessage(error(-1, "距上次提现时间小于提现周期"), "", "ajax");
    }

    $take_fee = round($get_fee * $account["fee_rate"] / 100, 2);
    $take_fee = max($take_fee, $account["fee_min"]);
    if( 0 < $account["fee_max"] ) $take_fee = min($take_fee, $account["fee_max"]);
    //实际提现金额
    $final_fee = $get_fee - $take_fee;
    if( $final_fee <= 0 ) imessage(error(-1, "实际到账金额小于0元"), "", "ajax");
    //添加日志表
    $data = array( "uniacid" => $_W["uniacid"], "wx_account" => $wx_account, "agentid" => $_W["agentid"], "uid" => $uid, "trade_no" => date("YmdHis") . random(10, true), "get_fee" => $get_fee, "take_fee" => $take_fee, "final_fee" => $final_fee, "account" => iserializer($account["wechat"]), "status" => 2, "addtime" => TIMESTAMP, "channel" => (MODULE_FAMILY == "wxapp" ? "wxapp" : "weixin") );
    pdo_insert("tiny_wmall_member_getcash_log", $data);
    $getcash_id = pdo_insertid();

    //改变用户余额，添加记录
    $log = array( $uid, "提现:".$get_fee."元" );
    member_credit_update($uid, "credit2", "-".$get_fee, $log);

//    $getcashperiod = get_system_config("store.serve_fee.get_cash_period");
//    if( empty($getcashperiod) )
//    {
        imessage(error(0, "申请提现成功,等待平台管理员处理"), iurl("manage/finance/getcash/log"), "ajax");
//    }
//    else
//    {
//        if( $getcashperiod == 1 )
//        {
//            $transfers = store_getcash_transfers($getcash_id);
//            imessage($transfers, "", "ajax");
//        }
//
//    }

}

include(itemplate("member/getcash"));
?>