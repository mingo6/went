<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Page extends WeModuleSite 
{
	public function runTasks() 
	{
		global $_W;
		load()->func('communication');
		$lasttime = strtotime(m('cache')->getString('receive', 'global'));
		$interval = intval(m('cache')->getString('receive_time', 'global'));
		if (empty($interval)) 
		{
			$interval = 60;
		}
		$interval *= 60;
		$current = time();
		if (($lasttime + $interval) <= $current) 
		{
			m('cache')->set('receive', date('Y-m-d H:i:s', $current), 'global');
			ihttp_request(EWEI_SHOPV2_TASK_URL . 'order/receive.php', NULL, NULL, 1);
		}
		$lasttime = strtotime(m('cache')->getString('closeorder', 'global'));
		$interval = intval(m('cache')->getString('closeorder_time', 'global'));
		if (empty($interval)) 
		{
			$interval = 60;
		}
		$interval *= 60;
		$current = time();
		if (($lasttime + $interval) <= $current) 
		{
			m('cache')->set('closeorder', date('Y-m-d H:i:s', $current), 'global');
			ihttp_request(EWEI_SHOPV2_TASK_URL . 'order/close.php', NULL, NULL, 1);
		}
		$lasttime = strtotime(m('cache')->getString('fullback_receive', 'global'));
		$interval = intval(m('cache')->getString('fullback_receive_time', 'global'));
		if (empty($interval)) 
		{
			$interval = 60;
		}
		$interval *= 60;
		$current = time();
		if (($lasttime + $interval) <= $current) 
		{
			m('cache')->set('fullback_receive', date('Y-m-d H:i:s', $current), 'global');
			ihttp_request(EWEI_SHOPV2_TASK_URL . 'order/fullback.php', NULL, NULL, 1);
		}
		$lasttime = strtotime(m('cache')->getString('status_receive', 'global'));
		$interval = intval(m('cache')->getString('status_receive_time', 'global'));
		if (empty($interval)) 
		{
			$interval = 60;
		}
		$interval *= 60;
		$current = time();
		if (($lasttime + $interval) <= $current) 
		{
			m('cache')->set('status_receive', date('Y-m-d H:i:s', $current), 'global');
			ihttp_request(EWEI_SHOPV2_TASK_URL . 'goods/status.php', NULL, NULL, 1);
		}
		if (com('coupon')) 
		{
			$lasttime = strtotime(m('cache')->getString('willcloseorder', 'global'));
			$interval = intval(m('cache')->getString('willcloseorder_time', 'global'));
			if (empty($interval)) 
			{
				$interval = 20;
			}
			$interval *= 60;
			$current = time();
			if (($lasttime + $interval) <= $current) 
			{
				m('cache')->set('willcloseorder', date('Y-m-d H:i:s', $current), 'global');
				ihttp_request(EWEI_SHOPV2_TASK_URL . 'order/willclose.php', NULL, NULL, 1);
			}
		}
		if (com('coupon')) 
		{
			$lasttime = strtotime(m('cache')->getString('couponback', 'global'));
			$interval = intval(m('cache')->getString('couponback_time', 'global'));
			if (empty($interval)) 
			{
				$interval = 60;
			}
			$interval *= 60;
			$current = time();
			if (($lasttime + $interval) <= $current) 
			{
				m('cache')->set('couponback', date('Y-m-d H:i:s', $current), 'global');
				ihttp_request(EWEI_SHOPV2_TASK_URL . 'coupon/back.php', NULL, NULL, 1);
			}
		}
		if (p('groups')) 
		{
			$groups_order_lasttime = strtotime(m('cache')->getString('groups_order_cancelorder', 'global'));
			$groups_order_interval = intval(m('cache')->getString('groups_order_cancelorder_time', 'global'));
			if (empty($groups_order_interval)) 
			{
				$groups_order_interval = 60;
			}
			$groups_order_interval *= 60;
			$groups_order_current = time();
			if (($groups_order_lasttime + $groups_order_interval) <= $groups_order_current) 
			{
				m('cache')->set('groups_order_cancelorder', date('Y-m-d H:i:s', $groups_order_current), 'global');
				ihttp_request($_W['siteroot'] . 'addons/ewei_shopv2/plugin/groups/task/order.php', NULL, NULL, 1);
			}
			$groups_team_lasttime = strtotime(m('cache')->getString('groups_team_refund', 'global'));
			$groups_team_interval = intval(m('cache')->getString('groups_team_refund_time', 'global'));
			if (empty($groups_team_interval)) 
			{
				$groups_team_interval = 60;
			}
			$groups_team_interval *= 60;
			$groups_team_current = time();
			if (($groups_team_lasttime + $groups_team_interval) <= $groups_team_current) 
			{
				m('cache')->set('groups_team_refund', date('Y-m-d H:i:s', $groups_team_current), 'global');
				ihttp_request($_W['siteroot'] . 'addons/ewei_shopv2/plugin/groups/task/refund.php', NULL, NULL, 1);
			}
			$groups_receive_lasttime = strtotime(m('cache')->getString('groups_receive', 'global'));
			$groups_receive_interval = intval(m('cache')->getString('groups_receive_time', 'global'));
			if (empty($groups_receive_interval)) 
			{
				$groups_receive_interval = 60;
			}
			$groups_receive_interval *= 60;
			$groups_receive_current = time();
			if (($groups_receive_lasttime + $groups_receive_interval) <= $groups_receive_current) 
			{
				m('cache')->set('groups_receive', date('Y-m-d H:i:s', $groups_receive_current), 'global');
				ihttp_request($_W['siteroot'] . 'addons/ewei_shopv2/plugin/groups/task/receive.php', NULL, NULL, 1);
			}
		}
		if (p('seckill')) 
		{
			$lasttime = strtotime(m('cache')->getString('seckill_delete_lasttime', 'global'));
			$interval = 5 * 60;
			$current = time();
			if (($lasttime + $interval) <= $current) 
			{
				m('cache')->set('seckill_delete_lasttime', date('Y-m-d H:i:s', $current), 'global');
				ihttp_request($_W['siteroot'] . 'addons/ewei_shopv2/plugin/seckill/task/receive.php', NULL, NULL, 1);
			}
		}
		exit('run finished.');
	}
	public function template($filename = '', $type = TEMPLATE_INCLUDEPATH, $account = false) 
	{
		global $_W;
		global $_GPC;
		if (empty($filename)) 
		{
			$filename = str_replace('.', '/', $_W['routes']);
		}
		if ($_GPC['do'] == 'web') 
		{
			$filename = str_replace('/add', '/post', $filename);
			$filename = str_replace('/edit', '/post', $filename);
			$filename = 'web/' . $filename;
		}
		else if ($_GPC['do'] == 'mobile') 
		{
		}
		$name = 'ewei_shopv2';
		$moduleroot = IA_ROOT . '/addons/ewei_shopv2';
		if (defined('IN_SYS')) 
		{
			$compile = IA_ROOT . '/data/tpl/web/' . $_W['template'] . '/' . $name . '/' . $filename . '.tpl.php';
			$source = $moduleroot . '/template/' . $filename . '.html';
			if (!(is_file($source))) 
			{
				$source = $moduleroot . '/template/' . $filename . '/index.html';
			}
			if (!(is_file($source))) 
			{
				$explode = array_slice(explode('/', $filename), 1);
				$temp = array_slice($explode, 1);
				$source = $moduleroot . '/plugin/' . $explode[0] . '/template/web/' . implode('/', $temp) . '.html';
				if (!(is_file($source))) 
				{
					$source = $moduleroot . '/plugin/' . $explode[0] . '/template/web/' . implode('/', $temp) . '/index.html';
				}
			}
		}
		else 
		{
			if ($account) 
			{
				$template = $_W['shopset']['wap']['style'];
				if (empty($template)) 
				{
					$template = 'default';
				}
				if (!(is_dir($moduleroot . '/template/account/' . $template))) 
				{
					$template = 'default';
				}
				$compile = IA_ROOT . '/data/tpl/app/' . $name . '/' . $template . '/account/' . $filename . '.tpl.php';
				$source = IA_ROOT . '/addons/' . $name . '/template/account/' . $template . '/' . $filename . '.html';
				if (!(is_file($source))) 
				{
					$source = IA_ROOT . '/addons/' . $name . '/template/account/default/' . $filename . '.html';
				}
				if (!(is_file($source))) 
				{
					$source = IA_ROOT . '/addons/' . $name . '/template/account/default/' . $filename . '/index.html';
				}
			}
			else 
			{
				$template = m('cache')->getString('template_shop');
				if (empty($template)) 
				{
					$template = 'default';
				}
				if (!(is_dir($moduleroot . '/template/mobile/' . $template))) 
				{
					$template = 'default';
				}
				$compile = IA_ROOT . '/data/tpl/app/' . $name . '/' . $template . '/mobile/' . $filename . '.tpl.php';
				$source = IA_ROOT . '/addons/' . $name . '/template/mobile/' . $template . '/' . $filename . '.html';
				if (!(is_file($source))) 
				{
					$source = IA_ROOT . '/addons/' . $name . '/template/mobile/' . $template . '/' . $filename . '/index.html';
				}
				if (!(is_file($source))) 
				{
					$source = IA_ROOT . '/addons/' . $name . '/template/mobile/default/' . $filename . '.html';
				}
				if (!(is_file($source))) 
				{
					$source = IA_ROOT . '/addons/' . $name . '/template/mobile/default/' . $filename . '/index.html';
				}
			}
			if (!(is_file($source))) 
			{
				$names = explode('/', $filename);
				$pluginname = $names[0];
				$ptemplate = m('cache')->getString('template_' . $pluginname);
				if (empty($ptemplate) || ($pluginname == 'creditshop')) 
				{
					$ptemplate = 'default';
				}
				if (!(is_dir($moduleroot . '/plugin/' . $pluginname . '/template/mobile/' . $ptemplate))) 
				{
					$ptemplate = 'default';
				}
				unset($names[0]);
				$pfilename = implode('/', $names);
				$compile = IA_ROOT . '/data/tpl/app/' . $name . '/plugin/' . $pluginname . '/' . $ptemplate . '/mobile/' . $filename . '.tpl.php';
				$source = $moduleroot . '/plugin/' . $pluginname . '/template/mobile/' . $ptemplate . '/' . $pfilename . '.html';
				if (!(is_file($source))) 
				{
					$source = $moduleroot . '/plugin/' . $pluginname . '/template/mobile/' . $ptemplate . '/' . $pfilename . '/index.html';
				}
			}
		}
		if (!(is_file($source))) 
		{
			exit('Error: template source \'' . $filename . '\' is not exist!');
		}
		if (DEVELOPMENT || !(is_file($compile)) || (filemtime($compile) < filemtime($source))) 
		{
			shop_template_compile($source, $compile, true);
		}
		return $compile;
	}
	public function message($msg, $redirect = '', $type = '') 
	{
		global $_W;
		$title = '';
		$buttontext = '';
		$message = $msg;
		$buttondisplay = true;
		if (is_array($msg)) 
		{
			$message = ((isset($msg['message']) ? $msg['message'] : ''));
			$title = ((isset($msg['title']) ? $msg['title'] : ''));
			$buttontext = ((isset($msg['buttontext']) ? $msg['buttontext'] : ''));
			$buttondisplay = ((isset($msg['buttondisplay']) ? $msg['buttondisplay'] : true));
		}
		if (empty($redirect)) 
		{
			$redirect = 'javascript:history.back(-1);';
		}
		else if ($redirect == 'close') 
		{
			$redirect = 'javascript:WeixinJSBridge.call("closeWindow")';
		}
		else if ($redirect == 'exit') 
		{
			$redirect = '';
		}
		include $this->template('_message');
		exit();
	}
	public function checkSubmit($key, $time = 2, $message = '操作频繁，请稍后再试!') 
	{
		global $_W;
		$open_redis = function_exists('redis') && !(is_error(redis()));
		if ($open_redis) 
		{
			$redis_key = $_W['setting']['site']['key'] . '_' . $_W['account']['key'] . '_' . $_W['uniacid'] . '_' . $_W['openid'] . '_mobilesubmit_' . $key;
			$redis = redis();
			if ($redis->setnx($redis_key, time())) 
			{
				$redis->expireAt($redis_key, time() + $time);
			}
			else 
			{
				return error(-1, $message);
			}
		}
		return true;
	}
	public function checkSubmitGlobal($key, $time = 2, $message = '操作频繁，请稍后再试!') 
	{
		global $_W;
		$open_redis = function_exists('redis') && !(is_error(redis()));
		if ($open_redis) 
		{
			$redis_key = $_W['setting']['site']['key'] . '_' . $_W['account']['key'] . '_' . $_W['uniacid'] . '_mobilesubmit_' . $key;
			$redis = redis();
			if ($redis->setnx($redis_key, time())) 
			{
				$redis->expireAt($redis_key, time() + $time);
			}
			else 
			{
				return error(-1, $message);
			}
		}
		return true;
	}

	public function diyPage($type) 
	{
		global $_W;
		global $_GPC;
		if (empty($type) || !(p('diypage'))) 
		{
			return false;
		}
		$merch = intval($_GPC['merchid']);
		if ($merch && ($type != 'member') && ($type != 'commission')) 
		{
			if (!(p('merch'))) 
			{
				return false;
			}
			$diypagedata = p('merch')->getSet('diypage', $merch);
		}
		else 
		{
			$diypagedata = m('common')->getPluginset('diypage');
		}
		if (!(empty($diypagedata))) 
		{
			$diypageid = $diypagedata['page'][$type];
			if (!(empty($diypageid))) 
			{
				$page = p('diypage')->getPage($diypageid, true);
				if (!(empty($page))) 
				{
					p('diypage')->setShare($page);
					$diyitems = $page['data']['items'];
					$diyitem_search = array();
					if (!(empty($diyitems)) && is_array($diyitems)) 
					{
						$jsondiyitems = json_encode($diyitems);
						if (strexists($jsondiyitems, 'fixedsearch')) 
						{
							foreach ($diyitems as $diyitemid => $diyitem ) 
							{
								if ($diyitem['id'] == 'fixedsearch') 
								{
									$diyitem_search = $diyitem;
									unset($diyitems[$diyitemid]);
								}
							}
							unset($diyitem);
						}
						unset($diyitem);
					}
					$startadv = p('diypage')->getStartAdv($page['diyadv']);
					include $this->template('diypage');
					exit();
				}
			}
		}
	}
	public function diyLayer($v = false, $diy = false, $merch = false) 
	{
		global $_W;
		global $_GPC;
		if (!(p('diypage')) || $diy) 
		{
			return;
		}
		if ($merch) 
		{
			if (!(p('merch'))) 
			{
				return false;
			}
			$diypagedata = p('merch')->getSet('diypage', $merch);
		}
		else 
		{
			$diypagedata = m('common')->getPluginset('diypage');
		}
		if (!(empty($diypagedata))) 
		{
			$diylayer = $diypagedata['layer'];
			if (!($diylayer['params']['isopen']) && $v) 
			{
				return;
			}
			include $this->template('diypage/layer');
		}
	}
	public function diyGotop($v = false, $diy = false, $merch = false) 
	{
		global $_W;
		global $_GPC;
		if (!(p('diypage')) || $diy) 
		{
			return;
		}
		if ($merch) 
		{
			if (!(p('merch'))) 
			{
				return false;
			}
			$diypagedata = p('merch')->getSet('diypage', $merch);
		}
		else 
		{
			$diypagedata = m('common')->getPluginset('diypage');
		}
		if (!(empty($diypagedata))) 
		{
			$diygotop = $diypagedata['gotop'];
			if (!($diygotop['params']['isopen']) && $v) 
			{
				return;
			}
			include $this->template('diypage/gotop');
		}
	}
	public function diyDanmu($diy = false) 
	{
		global $_W;
		global $_GPC;
		if (!(p('diypage'))) 
		{
			return;
		}
		$diypagedata = m('common')->getPluginset('diypage');
		$danmu = $diypagedata['danmu'];
		if (empty($danmu) || (!($diy) && empty($danmu['params']['isopen']))) 
		{
			return;
		}
		if (empty($danmu['params']['datatype'])) 
		{
			$condition = ((!(empty($_W['openid'])) ? ' AND openid!=\'' . $_W['openid'] . '\' ' : ''));
			$danmu['data'] = pdo_fetchall('SELECT nickname, avatar as imgurl FROM' . tablename('ewei_shop_member') . ' WHERE uniacid=:uniacid AND nickname!=\'\' AND avatar!=\'\' ' . $condition . ' ORDER BY rand() LIMIT 10', array(':uniacid' => $_W['uniacid']));
			$randstart = ((!(empty($danmu['params']['starttime'])) ? intval($danmu['params']['starttime']) : 0));
			$randend = ((!(empty($danmu['params']['endtime'])) ? intval($danmu['params']['endtime']) : 0));
			if ($randend <= $randstart) 
			{
				$randend = $randend + rand(100, 999);
			}
		}
		else if ($danmu['params']['datatype'] == 1) 
		{
			$danmu['data'] = pdo_fetchall('SELECT m.nickname, m.avatar as imgurl, o.createtime as time FROM' . tablename('ewei_shop_order') . ' o LEFT JOIN ' . tablename('ewei_shop_member') . ' m ON m.openid=o.openid WHERE o.uniacid=:uniacid AND m.nickname!=\'\' AND m.avatar!=\'\' ORDER BY o.createtime DESC LIMIT 10', array(':uniacid' => $_W['uniacid']));
		}
		else if ($danmu['params']['datatype'] == 2) 
		{
			$danmu['data'] = set_medias($danmu['data'], 'imgurl');
		}
		if (empty($danmu['data']) || !(is_array($danmu['data']))) 
		{
			return;
		}
		foreach ($danmu['data'] as $index => $item ) 
		{
			if (empty($danmu['params']['datatype'])) 
			{
				$time = rand($randstart, $randend);
				$danmu['data'][$index]['time'] = p('diypage')->getDanmuTime($time);
			}
			else if ($danmu['params']['datatype'] == 1) 
			{
				$danmu['data'][$index]['time'] = p('diypage')->getDanmuTime(time() - $item['time']);
			}
			else if ($danmu['params']['datatype'] == 2) 
			{
				$danmu['data'][$index]['time'] = p('diypage')->getDanmuTime($danmu['data'][$index]['time']);
			}
		}
		include $this->template('diypage/danmu');
	}
	public function shopShare() 
	{
		global $_W;
		global $_GPC;
		$trigger = false;
		if (empty($_W['shopshare'])) 
		{
			$set = $_W['shopset'];
			$_W['shopshare'] = array('title' => (empty($set['share']['title']) ? $set['shop']['name'] : $set['share']['title']), 'imgUrl' => (empty($set['share']['icon']) ? tomedia($set['shop']['logo']) : tomedia($set['share']['icon'])), 'desc' => (empty($set['share']['desc']) ? $set['shop']['description'] : $set['share']['desc']), 'link' => (empty($set['share']['url']) ? mobileUrl('', NULL, true) : $set['share']['url']));
			$plugin_commission = p('commission');
			if ($plugin_commission) 
			{
				$set = $plugin_commission->getSet();
				if (!(empty($set['level']))) 
				{
					$openid = $_W['openid'];
					$member = m('member')->getMember($openid);
					if (!(empty($member)) && ($member['status'] == 1) && ($member['isagent'] == 1)) 
					{
						if (empty($set['closemyshop'])) 
						{
							$myshop = $plugin_commission->getShop($member['id']);
							$_W['shopshare'] = array('title' => $myshop['name'], 'imgUrl' => tomedia($myshop['logo']), 'desc' => $myshop['desc'], 'link' => mobileUrl('commission/myshop', array('mid' => $member['id']), true));
						}
						else 
						{
							$_W['shopshare']['link'] = ((empty($_W['shopset']['share']['url']) ? mobileUrl('', array('mid' => $member['id']), true) : $_W['shopset']['share']['url']));
						}
						if (empty($set['become_reg']) && (empty($member['realname']) || empty($member['mobile']))) 
						{
							$trigger = true;
						}
					}
					else if (!(empty($_GPC['mid']))) 
					{
						$m = m('member')->getMember($_GPC['mid']);
						if (!(empty($m)) && ($m['status'] == 1) && ($m['isagent'] == 1)) 
						{
							if (empty($set['closemyshop'])) 
							{
								$myshop = $plugin_commission->getShop($_GPC['mid']);
								$_W['shopshare'] = array('title' => $myshop['name'], 'imgUrl' => tomedia($myshop['logo']), 'desc' => $myshop['desc'], 'link' => mobileUrl('commission/myshop', array('mid' => $member['id']), true));
							}
							else 
							{
								$_W['shopshare']['link'] = ((empty($_W['shopset']['share']['url']) ? mobileUrl('', array('mid' => $_GPC['mid']), true) : $_W['shopset']['share']['url']));
							}
						}
						else 
						{
							$_W['shopshare']['link'] = ((empty($_W['shopset']['share']['url']) ? mobileUrl('', array('mid' => $_GPC['mid']), true) : $_W['shopset']['share']['url']));
						}
					}
				}
			}
		}
		return $trigger;
	}
	public function wapQrcode() 
	{
		global $_W;
		global $_GPC;
		$currenturl = '';
		if (!(is_mobile())) 
		{
			$currenturl = $_W['siteroot'] . 'app/index.php?' . $_SERVER['QUERY_STRING'];
		}
		$shop = m('common')->getSysset('shop');
		$shopname = $shop['name'];
		include $this->template('_wapqrcode');
	}
}
?>