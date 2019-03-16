<?php 
defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
mload()->model("member");
$_W["page"]["title"] = "用户充值记录";
$op = (trim($_GPC["op"]) ? trim($_GPC["op"]) : "index");
if( $op == "index" ) 
{
    $condition = " where a.uniacid = :uniacid";
    $params = array( ":uniacid" => $_W["uniacid"] );
    $keywords = trim($_GPC["keyword"]);
    if( !empty($keywords) ) 
    {
        $condition .= " and (b.nickname like '%" . $keywords . "%' or b.realname like '%" . $keywords . "%' or b.mobile like '%" . $keywords . "%')";
    }

    if( !empty($_GPC["addtime"]["start"]) && !empty($_GPC["addtime"]["end"]) ) 
    {
        $starttime = strtotime($_GPC["addtime"]["start"]);
        $endtime = strtotime($_GPC["addtime"]["end"]);
        $condition .= " and a.addtbime >= :starttime and a.addtime <= :endtime";
        $params[":\$starttime"] = $starttime;
        $params[":\$endtime"] = $endtime;
    }

    $type = trim($_GPC["pay_type"]);
    if( !empty($type) ) 
    {
        $condition .= " and pay_type = :pay_type";
        $params[":pay_type"] = $type;
    }
    $is_invoice = $_GPC["is_invoice"];
    if($is_invoice){
        $condition .= " and is_invoice = :is_invoice";
        if($is_invoice == 1){
            $params[":is_invoice"] = 1;
        }else{
            $params[":is_invoice"] = 0;
        }
    }
    if($_GPC["invoice_type"]){
        $condition .= " and invoice_type = :invoice_type";
        if($_GPC["invoice_type"] == 1){
            $params[":invoice_type"] = 1;
        }else{
            $params[":invoice_type"] = 2;
        }
    }

    $pindex = max(1, intval($_GPC["page"]));
    $psize = 15;
    $total = pdo_fetchcolumn("select count(*) from" . tablename("tiny_wmall_member_recharge") . " as a left join " . tablename("tiny_wmall_members") . " as b on a.uid = b.uid " . $condition, $params);
    $recharge = pdo_fetchall("select a.*, b.avatar,b.nickname,b.realname,b.mobile from " . tablename("tiny_wmall_member_recharge") . " as a left join " . tablename("tiny_wmall_members") . " as b on a.uid = b.uid " . $condition . " order by a.addtime desc LIMIT " . ($pindex - 1) * $psize . "," . $psize, $params);
    $pager = pagination($total, $pindex, $psize);
}
else if($op == "upload_invoice"){
    $id = $_GPC['id'];
    if(empty($id)){
        imessage(error(-1, "id不能为空！"), '', "ajax");
    }
    $rechargeInfo = pdo_get('tiny_wmall_member_recharge', array('id' => $id, 'uniacid' => $_W['uniacid']));
    if(!$rechargeInfo){
        imessage(error(-1, "充值不存在！"), '', "ajax");
    }
    if($rechargeInfo['is_invoice'] == 0){
        imessage(error(-1, "不能上传发票！"), '', "ajax");
    }
    if($_W['ispost']){
        if(empty($_GPC['invoice_images'])){
            imessage(error(-1, '发票图片不能为空！'), '', "ajax");
        }
        $invoice_images = implode(',', $_GPC['invoice_images']);
        if(!pdo_update('tiny_wmall_member_recharge', array('invoice_images' => $invoice_images), array('id' => $id))){
            imessage(error(-1, "修改失败！"), '', "ajax");
        }
        imessage(error(0, "上传成功！"), referer(), "ajax");
    }
    if(!empty($rechargeInfo['invoice_images'])){
        $rechargeInfo['arr_invoice_images'] = explode(',', $rechargeInfo['invoice_images']);
    }
    include(itemplate("member/rechargeOp"));
    exit;
}
else if($op == "invoice_info"){
    $id = $_GPC['id'];
    if(empty($id)){
        imessage(error(-1, "id不能为空！"), '', "ajax");
    }
    $rechargeInfo = pdo_get('tiny_wmall_member_recharge', array('id' => $id, 'uniacid' => $_W['uniacid']));
    if(!$rechargeInfo){
        imessage(error(-1, "充值不存在！"), '', "ajax");
    }
    if($rechargeInfo['is_invoice'] == 0){
        imessage(error(-1, "不能上传发票！"), '', "ajax");
    }
    if($_W['ispost']){
        if(empty($_GPC['invoice_images'])){
            imessage(error(-1, '发票图片不能为空！'), '', "ajax");
        }
        $invoice_images = implode(',', $_GPC['invoice_images']);
        if(!pdo_update('tiny_wmall_member_recharge', array('invoice_images' => $invoice_images), array('id' => $id))){
            imessage(error(-1, "修改失败！"), '', "ajax");
        }
        imessage(error(0, "上传成功！"), referer(), "ajax");
    }
    $rechargeInfo['arr_invoice_images'] = explode(',', $rechargeInfo['invoice_images']);
    include(itemplate("member/invoiceOp"));
    exit;
}

include(itemplate("member/recharge"));
?>