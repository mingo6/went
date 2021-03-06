<?php

defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
icheckauth();
$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'index';

if ($op == 'index') {
	$homepage = pdo_fetch('SELECT * FROM ' . tablename('tiny_wmall_errander_page') . ' WHERE uniacid = :uniacid and agentid = :agentid and type = :type', array(':uniacid' => $_W['uniacid'], ':agentid' => $_W['agentid'], ':type' => 'home'));

	if (!empty($homepage)) {
		$homepage['data'] = json_decode(base64_decode($homepage['data']), true);

		if (!empty($homepage['data']['items'])) {
			foreach ($homepage['data']['items'] as &$item) {
				if (!empty($item['picture'])) {
					foreach ($item['picture'] as &$pic) {
						$pic['imgurl'] = tomedia($pic['imgurl']);
					}
				}
			}
		}
	}

	imessage(error(0, $homepage), '', 'ajax');
}

?>
