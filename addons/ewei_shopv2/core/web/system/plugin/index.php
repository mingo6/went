<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Index_EweiShopV2Page extends SystemPage 
{
    /******20180420修改绑定公众号和应用*****/
	public function mainnew()
	{
		global $_W;
		global $_GPC;
		if ($_W['ispost']) 
		{
			if (!(empty($_GPC['displayorder'])))
			{


				foreach ($_GPC['displayorder'] as $id => $displayorder )
				{
					pdo_update('ewei_shop_plugin', array('status' => $_GPC['status'][$id], 'displayorder' => $displayorder, 'name' => $_GPC['name'][$id], 'thumb' => $_GPC['thumb'][$id], 'desc' => $_GPC['desc'][$id]), array('id' => $id));


				}


                //先删除该表中该公众号对应的plugin_id
                $res = pdo_delete('ewei_shop_plugin_uniacid',array('uniacid'=>$_W['uniacid']));
                //再写入
                foreach($_GPC['displayorder'] as $id=>$displayorder) {
                    if($_GPC['status'][$id] == 1) {
                        $data = array(
                            'plugin_id'=>$id,
                            'uniacid'=>$_W['uniacid'],
                        );
                        pdo_insert('ewei_shop_plugin_uniacid',$data);
                    }
                }

				m('plugin')->refreshCache(1);
				show_json(1);
			}


		}

		//查出列表时候 关联新建的表


		$condition = ' and a.iscom=0 and a.deprecated=0';
		if (!(empty($_GPC['keyword']))) 
		{
			$condition .= ' and a.identity like :keyword or a.name like :keyword';
            $params[':keyword'] = '%' . $_GPC['keyword'];
        }
        $condition .= ' and b.uniacid = :uniacid';
        $params[':uniacid'] = $_W['uniacid'];
        $haslist = pdo_fetchall('select * from ' . tablename('ewei_shop_plugin') . ' as a left join '.tablename('ewei_shop_plugin_uniacid').' as b on a.id = b.plugin_id where 1' . $condition . ' order by displayorder asc', $params);


        $condition1 = ' and iscom=0 and deprecated=0';
        if (!(empty($_GPC['keyword']))) {
            $condition1 .= 'and identity like :keyword or name like :keyword';
            $params1[':keyword'] = '%' . $_GPC['keyword'];
        }
        $list = pdo_fetchall('select * from ' . tablename('ewei_shop_plugin') .' where 1' .$condition1. ' order by displayorder asc',$params1);

        foreach ($list as $k=>&$v) {
            $v['status_str'] = 0;
            foreach ($haslist as $kk=>$vv) {
                if($vv['plugin_id'] == $v['id']) {
                    $v['status_str'] = 1;
                }
            }
        }
        unset($v);

		$total = count($list);
		include $this->template();
		exit();
	}

    public function main()
    {
        global $_W;
        global $_GPC;
        if ($_W['ispost'])
        {
            if (!(empty($_GPC['displayorder'])))
            {
                foreach ($_GPC['displayorder'] as $id => $displayorder )
                {
                    pdo_update('ewei_shop_plugin', array('status' => $_GPC['status'][$id], 'displayorder' => $displayorder, 'name' => $_GPC['name'][$id], 'thumb' => $_GPC['thumb'][$id], 'desc' => $_GPC['desc'][$id]), array('id' => $id));
                }
                m('plugin')->refreshCache(1);
                show_json(1);
            }
        }
        $condition = ' and iscom=0 and deprecated=0';
        if (!(empty($_GPC['keyword'])))
        {
            $condition .= ' and identity like :keyword or name like :keyword';
            $params[':keyword'] = '%' . $_GPC['keyword'];
        }
        $list = pdo_fetchall('select * from ' . tablename('ewei_shop_plugin') . ' where 1 ' . $condition . ' order by displayorder asc', $params);
        $total = count($list);
        include $this->template();
        exit();
    }


	public function apps() 
	{
		global $_W;
		global $_GPC;
		$domain = trim(preg_replace('/http(s)?:\\/\\//', '', rtrim($_W['siteroot'], '/')));
		$setting = setting_load('site');
		$id = ((isset($setting['site']['key']) ? $setting['site']['key'] : ((isset($setting['key']) ? $setting['key'] : '0'))));
		$authcode = get_authcode();
		$auth = base64_encode(authcode($domain . '|' . $id . '|' . $authcode, 'ENCODE', 'ewei_shopv2_apps'));
		headers('http://app.we7shop.com/apps?auth=' . $auth);
	}
}
?>