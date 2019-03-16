<?php

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_EweiShopV2Page extends PluginWebPage
{
	public function main()
	{
		if (cv('diyform.temp')) {
			headers(webUrl('diyform/temp'));
			return NULL;
		}


		if (cv('diyform.category')) {
			headers(webUrl('diyform/category'));
			return NULL;
		}


		if (cv('diyform.set')) {
			headers(webUrl('diyform/set'));
			return NULL;
		}


		headers(webUrl());
	}
}


?>