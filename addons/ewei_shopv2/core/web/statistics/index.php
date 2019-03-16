<?php

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_EweiShopV2Page extends WebPage
{
	public function main()
	{
		if (cv('statistics.sale.main')) {
			headers(webUrl('statistics/sale'));
			return NULL;
		}


		if (cv('statistics.sale_analysis.main')) {
			headers(webUrl('statistics/sale_analysis'));
			return NULL;
		}


		if (cv('statistics.order.main')) {
			headers(webUrl('statistics/order'));
			return NULL;
		}


		if (cv('statistics.sale_analysis.main')) {
			headers(webUrl('statistics/sale_analysis'));
			return NULL;
		}


		if (cv('statistics.goods.main')) {
			headers(webUrl('statistics/goods'));
			return NULL;
		}


		if (cv('statistics.goods_rank.main')) {
			headers(webUrl('statistics/goods_rank'));
			return NULL;
		}


		if (cv('statistics.goods_trans.main')) {
			headers(webUrl('statistics/goods_trans'));
			return NULL;
		}


		if (cv('statistics.member_cost.main')) {
			headers(webUrl('statistics/member_cost'));
			return NULL;
		}


		if (cv('statistics.member_increase.main')) {
			headers(webUrl('statistics/member_increase'));
			return NULL;
		}


		headers(webUrl());
	}
}


?>