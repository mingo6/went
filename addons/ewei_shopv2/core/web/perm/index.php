<?php

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_EweiShopV2Page extends WebPage
{
	public function main()
	{
		if (cv('perm.role')) {
			headers(webUrl('perm/role'));
			exit();
			return NULL;
		}


		if (cv('perm.user')) {
			headers(webUrl('perm/user'));
			exit();
			return NULL;
		}


		if (cv('perm.log')) {
			headers(webUrl('perm/log'));
			exit();
		}

	}
}


?>