<?php
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
$op = (trim($_GPC['op']) ? trim($_GPC['op']) : 'auth');
load()->func('communication');
load()->func('db');
load()->func('file');
mload()->model('common');
mload()->model('cloud');
$params['domain'] = trim(preg_replace('/http(s)?:\\/\\//', '', rtrim($_W['siteroot'], '/')));
$params['ip'] = gethostbyname($_SERVER['HTTP_HOST']);
$params['modname'] = 'we7_wmall';
$cache = get_cache();
if ($op == 'auth') {
	if ($_W['ispost']) {
		if (empty($_GPC['code'])) {
				imessage(error(-1, '请填写授权码'), referer(), 'ajax');
			}
		$resp = ihttp_request('http://localhost/mod.php?a=mod', array('ip' => $params['ip'], 'modname' => $params['modname'], 'code' => $_GPC['code'], 'domain' => $params['domain']));
		$result = @json_decode($resp['content'], true);
		if ($result['status'] == '1') {
		$config = pdo_fetch('select id, sysset from ' . tablename('tiny_wmall_config') . ' order by id asc limit 1');
			$sysset = iunserializer($config['sysset']);
		if (!(is_array($sysset))) 
		{
			$sysset = array();
		}

		$sysset['auth'] = array('ip' => $params['ip'], 'modname' => $params['modname'], 'code' => $_GPC['code'], 'domain' => $params['domain']);

		if (empty($config)) {
			pdo_insert('tiny_wmall_config', array('sysset' => iserializer($sysset), 'uniacid' => $_W['uniacid']));
				}
			else {
			pdo_update('tiny_wmall_config', array('sysset' => iserializer($sysset)), array('id' => $config['id']));
			}

			imessage(error(0, $result['message']), referer(), 'ajax');
		exit(json_encode($result));			
		}else{
			imessage(error(-1, $result['message']), referer(), 'ajax');			
			}

		exit(json_encode($result));
	}
}
			
if ($op == 'upgrade') {
	if ($_W['ispost']) {
	$versionfile = IA_ROOT . '/addons/we7_wmall/version.php';
	include $versionfile;
	$upgrade = cloud_l_build();
	}
}



if($op == 'process') {
	global $_GPC;
	$versionfile = IA_ROOT . '/addons/we7_wmall/version.php';
	include $versionfile;
	$step = trim($_GPC['step']) ? trim($_GPC['step']) : 'files';
	if ($step == 'files' && $_W['ispost']) {
		$post = $_GPC['__input'];
		$path = $post['path'];
		$resp = ihttp_request('http://localhost/mod.php?a=mod&b=download', array('ip' => $cache['ip'], 'modname' => $cache['modname'], 'code' => $cache['code'], 'domain' => $cache['domain'], 'path' => $path));
		$ret = @json_decode(gzuncompress($resp['content']), true);
		$ret = $ret['result'];
		if (!is_error($ret)) {
		$file = base64_decode($ret['content']);	
		$path = IA_ROOT .'/addons/we7_wmall/'. $ret['path'];
		load()->func('file');
		@mkdirs(dirname($path));
		file_put_contents($path, $file);
		exit('success');
		}
	}
	$packet = cloud_l_build();
	if ($step == 'schemas' && $_W['ispost']) {
	cloud_l_run_schemas($packet);
	}
}

include itemplate('system/cloud');

function cloud_l_build() 
	{
		$pars = cloud_l_build_params();
		$dat = cloud_l_request('http://localhost/mod.php?a=mod&b=check', $pars);
		$result = @json_decode(gzuncompress($dat), true);
		$ret = $result['result'];
		if (!(is_error($ret))) 
		{

			$files = array();
			if (!(empty($ret['files']))) 
			{
				foreach ($ret['files'] as $file ) 
				{
					$entry = IA_ROOT .'/addons/we7_wmall/'. $file['path'];
					if (!(is_file($entry)) || (md5_file($entry) != $file['hash'])) 
					{
						$files[] = $file['path'];
					}
				}
			}
			$ret['files'] = $files;
			$database = array();
			if (!(empty($ret['database']))) 
			{
				load()->func('db');
				foreach ($ret['database'] as $remote ) 
				{
					$name = substr($remote['tablename'], 4);
					$local = table_schema(pdo(), $name);
					unset($remote['increment'], $local['increment']);
					if (empty($local)) 
					{
						$database[] = $remote;
					}
					else 
					{
						$sqls = db_table_fix_sql($local, $remote);
						if (!(empty($sqls))) 
						{
							$database[] = $remote;
						}
					}
				}
			}
			$ret['database'] = $database;
			if (!(empty($ret['database']))) 
			{
				$ret['data'] = array();
				foreach ($ret['database'] as $remote ) 
				{
					$row = array();
					$row['tablename'] = $remote['tablename'];
					$name = substr($remote['tablename'], 4);
					$local = table_schema(pdo(), $name);
					unset($remote['increment'], $local['increment']);
					if (empty($local)) 
					{
						$row['new'] = true;
					}
					else 
					{
						$row['new'] = false;
						$row['fields'] = array();
						$row['indexes'] = array();
						$diffs = db_schema_compare($local, $remote);
						if (!(empty($diffs['fields']['less']))) 
						{
							$row['fields'] = array_merge($row['fields'], $diffs['fields']['less']);
						}
						if (!(empty($diffs['fields']['diff']))) 
						{
							$row['fields'] = array_merge($row['fields'], $diffs['fields']['diff']);
						}
						if (!(empty($diffs['indexes']['less']))) 
						{
							$row['indexes'] = array_merge($row['indexes'], $diffs['indexes']['less']);
						}
						if (!(empty($diffs['indexes']['diff']))) 
						{
							$row['indexes'] = array_merge($row['indexes'], $diffs['indexes']['diff']);
						}
						$row['fields'] = implode($row['fields'], ' ');
						$row['indexes'] = implode($row['indexes'], ' ');
					}
					$ret['data'][] = $row;
				}
			}
			$ret['upgrade'] = false;
			if (!(empty($ret['files'])) || !(empty($ret['database']))) 
			{
				$ret['upgrade'] = true;
			}
			$upgrade = array();
			$upgrade['upgrade'] = $ret['upgrade'];
			$upgrade['lastupdate'] = TIMESTAMP;
			cache_write('we7_wmall_upgrade', $upgrade);
		}
		return $ret;
	}


function cloud_l_request($url, $post = '', $extra = array(), $timeout = 60)
{
	load()->func('communication');
	$response = ihttp_request($url, $post, $extra, $timeout);
	if (is_error($response)) {
		return error(-1, "访问公众平台接口失败, 错误: {$response['message']}");
	}
	return $response['content'];
}

function cloud_l_build_params()
{
	global $_W;
	$cache = get_cache();
	$pars = array();
	$pars['domain'] = trim(preg_replace('/http(s)?:\\/\\//', '', rtrim($_W['siteroot'], '/')));
	$pars['ip'] = CLIENT_IP;
	$pars['modname'] = 'we7_wmall';
	$pars['version'] = MODULE_VERSION;
	$pars['code'] = $cache['code'];
	$pars['release'] = MODULE_RELEASE_DATE;
	return $pars;
}


function cloud_l_run_schemas($packet) 
{
	global $_GPC;
	$post = $_GPC['__input'];
	$tablename = $post['table'];
	foreach ($packet['database'] as $schema ) 
	{
		if ($schema['tablename'] == $tablename){
			continue;
		}
		$remote = $schema;
		break;
	}
	if (!(empty($remote))) 
	{
		load()->func('db');
		$tablename = substr($remote['tablename'], 4);
		$local = table_schema(pdo(), $tablename);
		$sqls = db_table_fix_sql($local, $remote);
		$error = false;
		foreach ($sqls as $sql ){
			if (!(pdo_query($sql) === false)) {
						continue;
					}
			$error = true;
			break;
		}
		exit('success');
	}
	exit('success');
}


function get_cache()
		{
		global $_W;
		$config = pdo_fetch('select sysset from ' . tablename('tiny_wmall_config') . ' order by id asc limit 1');
		$sysset = iunserializer($config['sysset']);

		if (is_array($sysset)) {
			return is_array($sysset['auth']) ? $sysset['auth'] : array();
		}

		return array();
		}
		
function table_schema($db, $tablename = '')
	{
		$result = $db->fetch('SHOW TABLE STATUS LIKE \'' . trim($db->tablename($tablename), '`') . '\'');

		if (empty($result)) {
			return array();
		}


		$ret['tablename'] = $result['Name'];
		$ret['charset'] = $result['Collation'];
		$ret['engine'] = $result['Engine'];
		$ret['increment'] = $result['Auto_increment'];
		$result = $db->fetchall('SHOW FULL COLUMNS FROM ' . $db->tablename($tablename));

		foreach ($result as $value ) {
			$temp = array();
			$type = explode(' ', $value['Type'], 2);
			$temp['name'] = $value['Field'];
			$pieces = explode('(', $type[0], 2);
			$temp['type'] = $pieces[0];
			$temp['length'] = rtrim($pieces[1], ')');
			$temp['null'] = $value['Null'] != 'NO';
			$temp['signed'] = empty($type[1]);
			$temp['increment'] = $value['Extra'] == 'auto_increment';
			//$temp['default'] = $value['Default'];
			$ret['fields'][$value['Field']] = $temp;
		}

		$result = $db->fetchall('SHOW INDEX FROM ' . $db->tablename($tablename));

		foreach ($result as $value ) {
			$ret['indexes'][$value['Key_name']]['name'] = $value['Key_name'];
			$ret['indexes'][$value['Key_name']]['type'] = ($value['Key_name'] == 'PRIMARY' ? 'primary' : (($value['Non_unique'] == 0 ? 'unique' : 'index')));
			$ret['indexes'][$value['Key_name']]['fields'][] = $value['Column_name'];
		}

		return $ret;
	}	
?>