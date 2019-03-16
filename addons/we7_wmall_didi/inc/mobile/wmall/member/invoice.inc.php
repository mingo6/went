<?php 
defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
icheckauth();
$_W["page"]["title"] = "我的发票";
$ta = (trim($_GPC["ta"]) ? trim($_GPC["ta"]) : "list");
if( $ta == "list" ) 
{
    $condition = " where uniacid = :uniacid and uid = :uid and is_pay = :is_pay AND is_invoice=1";
    $params = array( ":uniacid" => $_W["uniacid"], ":uid" => $_W["member"]["uid"], ":is_pay" => 1 );
    $invoices = pdo_fetchall("select * from " . tablename("tiny_wmall_member_recharge") . $condition . " order by id desc limit 1", $params, "id");
    $min = 0;
    if(!empty($invoices)){
        foreach($invoices AS $key => &$value){
            if(!empty($value['invoice_images'])){
                $value['arr_invoice_images'] = explode(',', $value['invoice_images']);
            }else{
                $value['arr_invoice_images'] = array();
            }
        }
    }
    $min = min(array_keys($invoices));
    $invoices = array_merge($invoices, $invoices);
    include(itemplate("member/invoice"));
}

if( $ta == "more" ) 
{
    $id = $_GPC['min'];
    $condition = " where uniacid = :uniacid and uid = :uid and is_pay = :is_pay and id < :id";
    $params = array( ":uniacid" => $_W["uniacid"], ":uid" => $_W["member"]["uid"], ":is_pay" => 1, ":id" => $id );
    $invoices = pdo_fetchall("select  * from " . tablename("tiny_wmall_member_recharge") . " " . $condition . " order by id desc limit 1", $params, 'id');
    $min = 0;
    if( !empty($invoices) ) 
    {
        foreach($invoices AS $key => &$value){
            if(!empty($value['invoice_images'])){
                $value['arr_invoice_images'] = explode(',', $value['invoice_images']);
                $value['arr_invoice_images'] = array_map('tomedia', $value['arr_invoice_images']);
            }else{
                $value['arr_invoice_images'] = array();
            }
        }
        $min = min(array_keys($invoices));
    }
    $invoices = array_values($invoices);
    $respon = array( "errno" => 0, "message" => $invoices, "min" => $min );
    imessage($respon, "", "ajax");
}
?>