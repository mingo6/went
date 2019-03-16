<?php
 /**
 * 本程序由微智社区源码论坛，淘宝店铺：微智分销提供
 *
 * www.wezhicms.com
 * 
 * www.wezhicms.com  承接微擎模块破解、小程序前端、PHP解密
 */
defined('IN_IA') or exit('Access Denied');

class zh_cjdiancModule extends WeModule
{
    

    public function welcomeDisplay()
    {   
        global $_GPC, $_W;
    	 if ($_W['role'] == 'operator') {
	        $url = $this->createWebUrl('store');
	        Header("Location: " . $url);
    	}else{
            $url = $this->createWebUrl('store');
	    	//$url = $this->createWebUrl('gaikuangdata');
	        Header("Location: " . $url);
    	}
    }
}