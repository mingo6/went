<?php

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_EweiShopV2Page extends SystemPage
{
	public function main()
	{
		headers(webUrl('system/plugin'));
		exit();
		include $this->template();
	}
}


?>