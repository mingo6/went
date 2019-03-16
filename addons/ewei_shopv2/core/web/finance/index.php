<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Index_EweiShopV2Page extends WebPage 
{
	public function main() 
	{
		if (cv('finance.recharge.view')) 
		{
			headers(webUrl('finance/log/recharge'));
			return;
		}
		if (cv('finance.withdraw.view')) 
		{
			headers(webUrl('finance/log/withdraw'));
			return;
		}
		if (cv('finance.downloadbill')) 
		{
			headers(webUrl('finance/downloadbill'));
			return;
		}
		headers(webUrl());
	}
}
?>