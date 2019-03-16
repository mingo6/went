<?php

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_EweiShopV2Page extends PluginWebPage
{
	public function main()
	{
		if (cv('qa.question')) {
			headers(webUrl('qa/question'));
		}
		 else if (cv('qa.category')) {
			headers(webUrl('qa/category'));
		}
		 else if (cv('qa.set')) {
			headers(webUrl('qa/set'));
		}
		 else {
			headers(webUrl());
		}

		exit();
	}
}


?>