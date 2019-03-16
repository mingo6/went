<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Wxuploader_EweiShopV2Page extends MobilePage 
{
	public function main() 
	{
		global $_W;
        global $_GPC;
        $result['status'] = 'error';
        if(!$_GPC['mediaid']){
            $result['message'] = 'mediaid不能为空！';
            exit(json_encode($result));
        }
        $account_api = WeAccount::create();
        $filepath = $account_api->downloadMedia($_GPC['mediaid']);
        /* $type = 'wxresourse';
        $uniacid = intval($_W['uniacid']);
		$path = "{$type}s/{$uniacid}/" . date('Y/m/');
		mkdirs(ATTACHMENT_ROOT . '/' . $path);
        $filename = file_random_name(ATTACHMENT_ROOT . '/' . $path, 'jpeg');
        $downloadpath = ATTACHMENT_ROOT . '/' . $path . '/' . $filename; */
        
        $result['status'] = 'success';
		$result['error'] = 0;
		$result['filename'] = $filepath;
        $result['url'] = trim($_W['attachurl'] . $filepath);
        exit(json_encode($result));
	}
	protected function upload($uploadfile) 
	{
		global $_W;
		global $_GPC;
		$result['status'] = 'error';
		if ($uploadfile['error'] != 0) 
		{
			$result['message'] = '上传失败，请重试！';
			return $result;
		}
		load()->func('file');
		$path = '/images/ewei_shop/' . $_W['uniacid'];
		if (!(is_dir(ATTACHMENT_ROOT . $path))) 
		{
			mkdirs(ATTACHMENT_ROOT . $path);
		}
		$_W['uploadsetting'] = array();
		$_W['uploadsetting']['image']['folder'] = $path;
		$_W['uploadsetting']['image']['extentions'] = $_W['config']['upload']['image']['extentions'];
		$_W['uploadsetting']['image']['limit'] = $_W['config']['upload']['image']['limit'];
		$file = file_upload($uploadfile, 'image');
		if (is_error($file)) 
		{
			$result['message'] = $file['message'];
			return $result;
		}
		if (function_exists('file_remote_upload')) 
		{
			$remote = file_remote_upload($file['path']);
			if (is_error($remote)) 
			{
				$result['message'] = $remote['message'];
				return $result;
			}
		}
		$result['status'] = 'success';
		$result['url'] = $file['url'];
		$result['error'] = 0;
		$result['filename'] = $file['path'];
		$result['url'] = trim($_W['attachurl'] . $result['filename']);
		pdo_insert('core_attachment', array('uniacid' => $_W['uniacid'], 'uid' => $_W['member']['uid'], 'filename' => $uploadfile['name'], 'attachment' => $result['filename'], 'type' => 1, 'createtime' => TIMESTAMP));
		return $result;
	}
	public function remove() 
	{
		global $_W;
		global $_GPC;
		load()->func('file');
		$file = $_GPC['file'];
		file_delete($file);
		exit(json_encode(array('status' => 'success')));
	}
}
?>