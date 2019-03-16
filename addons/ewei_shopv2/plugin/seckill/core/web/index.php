<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
require EWEI_SHOPV2_PLUGIN . 'seckill/core/seckill_page_web.php';
class Index_EweiShopV2Page extends SeckillWebPage 
{
	public function main() 
	{
		global $_W;
		if (cv('seckill.task')) 
		{
			headers(webUrl('seckill/task'));
		}
		else if (cv('seckill.goods')) 
		{
			headers(webUrl('seckill/goods'));
		}
		else if (cv('seckill.category')) 
		{
			headers(webUrl('seckill/category'));
		}
		else if (cv('seckill.adv')) 
		{
			headers(webUrl('seckill/adv'));
		}
		else if (cv('seckill.calendar')) 
		{
			headers(webUrl('seckill/calendar'));
		}
		else if (cv('seckill.cover')) 
		{
			headers(webUrl('seckill/cover'));
		}
		else 
		{
			headers(webUrl());
		}
	}
}
?>