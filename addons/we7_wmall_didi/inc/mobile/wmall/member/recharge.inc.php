<?php 
defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
icheckauth();
$ta = (trim($_GPC["ta"]) ? trim($_GPC["ta"]) : "index");
if( $ta == "index" ) 
{
    $_W["page"]["title"] = "账户充值";
    $config_recharge = $_W["we7_wmall"]["config"]["recharge"];
    if( $config_recharge["status"] != 1 ) 
    {
        imessage("平台暂未开启充值功能", imurl("wmall/member/mine"), "info");
    }
    $recharges = $config_recharge["items"];
}

if( $ta == "submit" ) 
{
    $config_recharge = $_W["we7_wmall"]["config"]["recharge"];
    if( $config_recharge["status"] != 1 ) 
    {
        imessage(error(-1, "平台暂未开启充值功能"), "", "ajax");
    }

    $price = floatval($_GPC["price"]);
    if( !$price || $price < 0 ) 
    {
        imessage(error(-1, "充值金额必须大于0"), "", "ajax");
    }

    $tag = array( "credit2" => $price );
    if( !empty($config_recharge["items"]) ) 
    {
        foreach( $config_recharge["items"] as $item ) 
        {
            if( $item["charge"] == $price ) 
            {
                if( !empty($item["back"]) && !empty($item["type"]) ) 
                {
                    $tag["grant"] = array( "type" => $item["type"], "back" => $item["back"] );
                }

                break;
            }

        }
    }
    $invoice_money = 0;
    $isPay = 0;
    if($_GPC['pay_type'] == 'transfer'){
        if($_GPC['is_invoice'] == 0){
            $isPay = 1;
        }
        $final_fee = 0;
        $rechargeType = 2;
    }else{
        $final_fee = $price;
        $rechargeType = 1;
    }
    $data = array( "uniacid" => $_W["uniacid"], "uid" => $_W["member"]["uid"], "openid" => $_W["openid"], "order_sn" => date("YmdHis") . random(6, true), "type" => "credit2", "fee" => $price, "pay_type" => '', 'recharge_type' => $rechargeType, "is_pay" => $isPay, "tag" => iserializer($tag), "addtime" => TIMESTAMP, 'is_invoice' => $_GPC['is_invoice'], 'invoice_images' => $_GPC['invoice_images']);
    if($_GPC['is_invoice'] == 1){
        $data['invoice_type'] = $_GPC['invoice_type'];
        /* empty($_GPC['company_name']) && imessage(error(-1, "公司名称不能为空！"), "", "ajax");
        empty($_GPC['tax_identification']) && imessage(error(-1, "纳税人识别号不能为空！"), "", "ajax");
        empty($_GPC['out_bank']) && imessage(error(-1, "开户银行不能为空！"), "", "ajax");
        empty($_GPC['bank_account']) && imessage(error(-1, "银行账号不能为空！"), "", "ajax"); */
        /* $data['company_name'] =  $_GPC['company_name'];
        $data['tax_identification'] =  $_GPC['tax_identification'];
        $data['out_bank'] =  $_GPC['out_bank'];
        $data['bank_account'] =  $_GPC['bank_account']; */
        $invoice_fee_scale = 0;
        if($_GPC['invoice_type'] == 1){
            $config_recharge['invoice_fee_scale'] > 0 && $invoice_fee_scale = $config_recharge['invoice_fee_scale'] / 100;
        }else{
            /* empty($_GPC['unit_address']) && imessage(error(-1, "单位地址不能为空！"), "", "ajax");
            empty($_GPC['phone']) && imessage(error(-1, "联系人电话不能为空！"), "", "ajax");
            $data['unit_address'] = $_GPC['unit_address'];
            $data['phone'] = $_GPC['phone']; */
            $config_recharge['added_invoices_fee_scale'] > 0 && $invoice_fee_scale = $config_recharge['added_invoices_fee_scale'] / 100;
        }
        if($invoice_fee_scale > 0 && $isPay == 0){
            $invoice_money = $invoice_fee_scale * $price;
            $final_fee += $invoice_money;
        }
    }
    $data['final_fee'] = $final_fee;
    $data['invoice_money'] = $invoice_money;
    pdo_insert("tiny_wmall_member_recharge", $data);
    $id = pdo_insertid();
    if(!$id){
        imessage(error(-1, "充值失败！"), "", "ajax");
    }
    if($isPay == 1){
        imessage(error(1, $id), "", "ajax");
    }
    imessage(error(0, $id), "", "ajax");
} else if($ta == "upload_invoice_img"){
    load()->func('file');
    $fileInfo = file_upload($_FILES['invoice_images'], 'image');
    if(is_error($fileInfo)){
        imessage(error(-1, $fileInfo['message']), "", "ajax");
    }
    imessage(array(
		'errno' => 0,
		'message' => '上传成功！',
		'data' => $fileInfo,
	), referer(), "ajax");
}

include(itemplate("member/recharge"));
?>