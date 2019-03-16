<?php
if (!defined("IN_IA")) {
	exit("Access Denied");
}

class Index_EweiShopV2Page extends PluginWebPage
{
	public function main()
	{
		headers(webUrl("mc/index/index"));
		exit();
	}

	public function index()
	{
		global $_W;
		include $this->template();
	}
}


?>