<?php 
defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
$_W["page"]["title"] = "顾客设置";
if( $_W["ispost"] ) 
{
    $config_update['group_update_mode'] = trim($_GPC["group_update_mode"]);
    $config_update['fee_getcash'] = array(
        'get_cash_fee_limit' => floatval($_GPC['fee_getcash']['get_cash_fee_limit']),
        'get_cash_fee_rate' => floatval($_GPC['fee_getcash']['get_cash_fee_rate']),
        'get_cash_fee_min' => floatval($_GPC['fee_getcash']['get_cash_fee_min']),
        'get_cash_fee_max' => floatval($_GPC['fee_getcash']['get_cash_fee_max']),
        'get_cash_fee_period' => floatval($_GPC['fee_getcash']['get_cash_fee_period']),
    );
    //分佣配置]
    if ((int)$_GPC['commission_sale_1']<0) $_GPC['commission_sale_1']=0;
    if ((int)$_GPC['commission_sale_2']<0) $_GPC['commission_sale_2']=0;
    if ((int)$_GPC['commission_sale_3']<0) $_GPC['commission_sale_3']=0;
    $config_update['commission_sale_1'] = (int)$_GPC['commission_sale_1'];
    $config_update['commission_sale_2'] = (int)$_GPC['commission_sale_2'];
    $config_update['commission_sale_3'] = (int)$_GPC['commission_sale_3'];

    if( empty($config_update['group_update_mode']) )
    {
        imessage(error(-1, "请选择顾客等级升级依据"));
    }

    set_system_config("member", $config_update);
    imessage(error(0, "设置成功"), referer(), "ajax");
}

$config = get_system_config("member");
include(itemplate("config/member"));
?>