<?php

defined('IN_IA') or exit('Access Denied');
define('MB_ROOT', IA_ROOT . '/addons/dbs_masclwlcard');
require_once IA_ROOT . '/addons/dbs_masclwlcard/api_qy.class.php';
class Dbs_masclwlcardModuleSite extends WeModuleSite
{
    public function doWebBase()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        if (checksubmit('submit')) {
            $data = array();
            $data = array("uniacid" => $_W['uniacid'], "company_name" => $_GPC['company_name'], "company_addr" => $_GPC['company_addr'], "company_tel" => $_GPC['company_tel'], "template_id" => $_GPC['template_id'], "shop_bg" => $_GPC['shop_bg'], "open_shop" => $_GPC['open_shop'], "open_redpack" => $_GPC['open_redpack'], "redpack_min" => $_GPC['redpack_min'], "redpack_max" => $_GPC['redpack_max'], "num" => $_GPC['num'], "lat" => $_GPC['lat'], "lng" => $_GPC['lng'], "company_logo" => $_GPC['company_logo'],"is_public" => $_GPC['is_public'],"public_password" => md5($_GPC['public_password']));
            $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_set') . " WHERE uniacid ='{$_W['uniacid']}'");
            if (empty($info['id'])) {
                $result = pdo_insert('dbs_masclwlcard_set', $data);
                if (!empty($result)) {
                    message('操作成功！', $this->createWebUrl('base'), 'success');
                } else {
                    message('操作失败！', $this->createWebUrl('base'), 'error');
                }
            } else {
                pdo_update('dbs_masclwlcard_set', $data, array("id" => $info['id']));
            }
            message('操作成功！', $this->createWebUrl('base'), 'success');
        }
        $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_set') . " WHERE uniacid ='{$_W['uniacid']}'");
        include $this->template('base');
    }
    public function doWebFooter()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        if (checksubmit('submit')) {
            $data = array();
            $data = array("uniacid" => $_W['uniacid'], "card_name" => $_GPC['card_name'], "card_img_no" => $_GPC['card_img_no'], "card_img" => $_GPC['card_img'], "shop_name" => $_GPC['shop_name'], "shop_img_no" => $_GPC['shop_img_no'], "shop_img" => $_GPC['shop_img'], "shop_type" => $_GPC['shop_type'], "shop_path" => $_GPC['shop_path'], "shop_appid" => $_GPC['shop_appid'], "shop_url" => $_GPC['shop_url'], "friend_name" => $_GPC['friend_name'], "friend_img_no" => $_GPC['friend_img_no'], "friend_img" => $_GPC['friend_img'], "friend_type" => $_GPC['friend_type'], "friend_path" => $_GPC['friend_path'], "friend_appid" => $_GPC['friend_appid'], "friend_url" => $_GPC['friend_url'], "web_name" => $_GPC['web_name'], "web_img_no" => $_GPC['web_img_no'], "web_img" => $_GPC['web_img'], "web_type" => $_GPC['web_type'], "web_path" => $_GPC['web_path'], "web_appid" => $_GPC['web_appid'], "web_url" => $_GPC['web_url']);
            $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_footer') . " WHERE uniacid ='{$_W['uniacid']}'");
            if (empty($info['id'])) {
                $result = pdo_insert('dbs_masclwlcard_footer', $data);
                if (!empty($result)) {
                    message('操作成功！', $this->createWebUrl('footer'), 'success');
                } else {
                    message('操作失败！', $this->createWebUrl('footer'), 'error');
                }
            } else {
                pdo_update('dbs_masclwlcard_footer', $data, array("id" => $info['id']));
            }
            message('操作成功！', $this->createWebUrl('footer'), 'success');
        }
        $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_footer') . " WHERE uniacid ='{$_W['uniacid']}'");
        include $this->template('footer');
    }
    public function doWebCard_change()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        if (checksubmit('submit')) {
            if (!$_GPC['send_card_id']) {
                message('操作失败请选择交出方！', $this->createWebUrl('card_change'), 'error');
            } else {
                $send_card = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid and id=:id and is_sendcard=0 ', array(":uniacid" => $_W['uniacid'], ":id" => $_GPC['send_card_id']));
                if (empty($send_card)) {
                    message('操作失败交出方不存在！', $this->createWebUrl('card_change'), 'error');
                }
            }
            if (!$_GPC['rec_card_id']) {
                message('操作失败请选择接收方！', $this->createWebUrl('card_change'), 'error');
            } else {
                $rec_card = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid and id=:id and is_sendcard=0 ', array(":uniacid" => $_W['uniacid'], ":id" => $_GPC['rec_card_id']));
                if (empty($rec_card)) {
                    message('操作失败接收方不存在！', $this->createWebUrl('card_change'), 'error');
                }
            }
            if ($_GPC['send_card_id'] == $_GPC['rec_card_id']) {
                message('操作失败接收方与接收方是同一个人员！', $this->createWebUrl('card_change'), 'error');
            }
            $data = array();
            $data['is_sendcard'] = 1;
            $data['is_sendcard_id'] = $_GPC['rec_card_id'];
            $result = pdo_update('dbs_masclwlcard', $data, array("id" => $_GPC['send_card_id']));
            if (!empty($result)) {
                message('交接成功！', $this->createWebUrl('card_change'), 'success');
            } else {
                message('交接失败！', $this->createWebUrl('card_change'), 'error');
            }
        }
        $card_list = pdo_fetchall('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid and is_sendcard=0', array(":uniacid" => $_W['uniacid']));
        include $this->template('card_change');
    }
    public function doWebUpload_cert()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        if (checksubmit('submit')) {
            load()->func('file');
            $dirpath = MB_ROOT . '/cert/' . $_W['uniacid'];
            $r = mkdir($dirpath);
            $r = is_dir($dirpath) or mkdir($dirpath, 0777, true);
            if (!empty($_GPC['cert'])) {
                $ret = file_put_contents(MB_ROOT . '/cert/' . $_W['uniacid'] . '/apiclient_cert.pem', trim($_GPC['cert']));
                $r = $r && $ret;
            }
            if (!empty($_GPC['key'])) {
                $ret = file_put_contents(MB_ROOT . '/cert/' . $_W['uniacid'] . '/apiclient_key.pem', trim($_GPC['key']));
                $r = $r && $ret;
            }
            if (!$r) {
                message('证书保存失败, 请保证 ' . MB_ROOT . '/cert/' . ' 目录可写');
            }
            message('操作成功！', $this->createWebUrl('upload_cert'), 'success');
        }
        $settings = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_set') . ' WHERE uniacid =:uniacid', array(":uniacid" => $_W['uniacid']));
        include $this->template('upload_cert');
    }
    public function doWebQyapi()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        load()->classs('uploadedfile');
        if (checksubmit('submit')) {
            $data = array();
            $data = array("uniacid" => $_W['uniacid'], "corpid" => $_GPC['corpid'], "agentid" => $_GPC['agentid'], "secret_1" => $_GPC['secret_1'], "secret" => $_GPC['secret']);
            $files = UploadedFile::createFromGlobal();
            $file = isset($files['file']) ? $files['file'] : null;
            if ($file && $file->isOk() && $file->allowExt('txt')) {
                $file->moveTo(IA_ROOT . '/' . $file->getClientFilename());
            }
            $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_set_qy') . " WHERE uniacid ='{$_W['uniacid']}'");
            if (empty($info['id'])) {
                $result = pdo_insert('dbs_masclwlcard_set_qy', $data);
                if (!empty($result)) {
                    message('操作成功！', $this->createWebUrl('qyapi'), 'success');
                } else {
                    message('操作失败！', $this->createWebUrl('qyapi'), 'error');
                }
            } else {
                pdo_update('dbs_masclwlcard_set_qy', $data, array("id" => $info['id']));
            }
            message('操作成功！', $this->createWebUrl('qyapi'), 'success');
        }
        $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_set_qy') . " WHERE uniacid ='{$_W['uniacid']}'");
        include $this->template('qyapi');
    }
    public function getAccessToken($corpid, $secret)
    {
        global $_W, $_GPC;
        $path = IA_ROOT . '/addons/dbs_masclwlcard/alltoken/' . $_W['uniacid'] . '/' . $secret . '.php';
        load()->func('file');
        $dirpath = IA_ROOT . '/addons/dbs_masclwlcard/alltoken/' . $_W['uniacid'] . '/';
        is_dir($dirpath) or mkdir($dirpath, 0777, true);
        $data = json_decode(file_get_contents($path));
        if ($data->expire_time < time()) {
            $url = 'https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=' . $corpid . '&corpsecret=' . $secret;
            $res = json_decode(file_get_contents($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $file = fopen($path, 'w');
                if ($file) {
                    set_file_buffer($file, 0);
                    fwrite($file, json_encode($data));
                    fclose($file);
                }
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }
    private function qy_create($data)
    {
        global $_W, $_GPC;
        $set_qy = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_set_qy') . ' WHERE uniacid =:uniacid', array(":uniacid" => $_W['uniacid']));
        $qytoken = $this->getAccessToken($set_qy['corpid'], $set_qy['secret_1']);
        $qy_create_url = 'https://qyapi.weixin.qq.com/cgi-bin/user/create?access_token=' . $qytoken;
        $jsonData = json_encode($data);
        $result = ihttp_request($qy_create_url, $jsonData);
        return $result;
    }
    public function doWebQy_update()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        $activity = pdo_fetchall('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid', array(":uniacid" => $_W['uniacid']));
        if (!empty($activity)) {
            foreach ($activity as $k => $v) {
                if ($v['userid']) {
                    $user = array();
                    $res = '';
                    $resturl = '';
                    $user['userid'] = $v['userid'];
                    $user['name'] = $v['card_name'];
                    $user['mobile'] = $v['card_tel'];
                    if (!$v['card_tel']) {
                        message('电话不能为空', $this->createWebUrl('card_list'), 'error');
                        exit;
                    }
                    $user['email'] = $v['email'];
                    if (!$v['email']) {
                        message('邮箱不能为空', $this->createWebUrl('card_list'), 'error');
                        exit;
                    }
                    $user['department'] = array(1);
                    $res = $this->qy_create($user);
                    $resturl = json_decode($res['content'], TRUE);
                    if (!$resturl['errcode']) {
                        pdo_update('dbs_masclwlcard', array("userid" => $user['userid'], "errmsg" => $resturl['errmsg']), array("id" => $v['id']));
                    } else {
                        pdo_update('dbs_masclwlcard', array("errmsg" => $resturl['errmsg']), array("id" => $v['id']));
                    }
                }
            }
        }
        message('操作成功！', $this->createWebUrl('card_list'), 'success');
    }
    public function doWebCard()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        $set = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_set') . " WHERE uniacid ='{$_W['uniacid']}'");
        if (checksubmit('submit')) {
            $data = array();
            $data = array("uniacid" => $_W['uniacid'], "card_logo" => $_GPC['card_logo'], "detailed_address" => $_GPC['detailed_address'], "photo" => serialize($_GPC['photo']), "card_name" => $_GPC['card_name'], "weixinid" => $_GPC['weixinid'], "card_instr" => $_GPC['card_instr'], "userid" => $_GPC['userid'], "address" => $_GPC['address'], "sex" => $_GPC['sex'], "share_img" => $_GPC['share_img'], "share_title" => $_GPC['share_title'], "template_type" => $_GPC['template_type'] ? $_GPC['template_type'] : 1, "template_img" => $_GPC['template_img'], "company_name" => $_GPC['company_name'], "mrtype" => $_GPC['mrtype'], "thumbs_num" => $_GPC['thumbs_num'], "template_type" => $_GPC['template_type'], "last_update_star_time" => time(), "card_tel" => $_GPC['card_tel'], "role_name" => $_GPC['role_name'], "phone" => $_GPC['phone'], "email" => $_GPC['email']);
            if ($_GPC['id']) {
                $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
                if (empty($info['id'])) {
                    $result = pdo_insert('dbs_masclwlcard', $data);
                    if (!empty($result)) {
                        message('操作成功！', $this->createWebUrl('card'), 'success');
                    } else {
                        message('操作失败！', $this->createWebUrl('card'), 'error');
                    }
                } else {
                    pdo_update('dbs_masclwlcard', $data, array("id" => $info['id']));
                    message('操作成功！', $this->createWebUrl('card', array("id" => $info['id'])), 'success');
                }
            } else {
                if (!empty($set)) {
                    $num = $set['num'];
                }
                if ($num) {
                    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('dbs_masclwlcard') . 'where uniacid=:uniacid', array(":uniacid" => $_W['uniacid']));
                    if ($total >= $num) {
                        message('操作失败！您只能添加' . $num . '个名片', $this->createWebUrl('card'), 'error');
                    }
                }
                $result = pdo_insert('dbs_masclwlcard', $data);
                if (!empty($result)) {
                    message('操作成功！', $this->createWebUrl('card'), 'success');
                } else {
                    message('操作失败！', $this->createWebUrl('card'), 'error');
                }
            }
        }
        $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        if (!empty($info)) {
            $dirpath = IA_ROOT . '/addons/dbs_masclwlcard/sea/' . $_W['uniacid'] . '/';
            $wx_png = $dirpath . $info['id'] . '_original.png';
            $wx_now_png = $dirpath . $info['id'] . '.png';
            $wx_logo = $dirpath . $info['id'] . '_logo.png';
            if ($_GPC['op'] == 'del') {
                if (file_exists($wx_png)) {
                    unlink($wx_png);
                }
            }
            if (!file_exists($wx_png)) {
                ob_flush();
                flush();
                $result = $this->creat_post($info['id']);
                is_dir($dirpath) or mkdir($dirpath, 0777, true);
                $file = fopen($wx_png, 'w');
                if ($file) {
                    set_file_buffer($file, 0);
                    fwrite($file, $result['content']);
                    fclose($file);
                }
                ob_flush();
                flush();
            }
            if (file_exists($wx_now_png)) {
                unlink($wx_now_png);
            }
            if (file_exists($wx_logo)) {
                unlink($wx_logo);
            }
            if (!$info['card_logo']) {
                copy($wx_png, $wx_now_png);
            } else {
                load()->library('qrcode');
                $logo = tomedia($info['card_logo']);
                ob_flush();
                flush();
                $logo = $this->yuanImg(file_get_contents($logo), $wx_logo);
                $logo = imagecreatefromstring(file_get_contents($wx_logo));
                $QR = imagecreatefromstring(file_get_contents($wx_png));
                $QR_width = imagesx($QR);
                $QR_heihgt = imagesy($QR);
                $logo_width = imagesx($logo);
                $logo_height = imagesy($logo);
                $logo_qr_width = $QR_width / 2.2;
                $scale = $logo_width / $logo_qr_width;
                $logo_qr_height = $logo_height / $scale;
                $from_width = ($QR_width - $logo_qr_width) / 2;
                imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
                imagepng($QR, $wx_now_png);
                ob_flush();
                flush();
            }
            $info['photo'] = unserialize($info['photo']);
        }
        include $this->template('card');
    }
    private function yuanImg($picture, $path)
    {
        $src_img = imagecreatefromstring($picture);
        $w = imagesx($src_img);
        $h = imagesy($src_img);
        $w = min($w, $h);
        $h = $w;
        $img = imagecreatetruecolor($w, $h);
        imagesavealpha($img, true);
        $bg = imagecolorallocatealpha($img, 255, 255, 255, 127);
        imagefill($img, 0, 0, $bg);
        $r = $w / 2;
        $y_x = $r;
        $y_y = $r;
        $x = 0;
        while ($x < $w) {
            $y = 0;
            while ($y < $h) {
                $rgbColor = imagecolorat($src_img, $x, $y);
                if (($x - $r) * ($x - $r) + ($y - $r) * ($y - $r) < $r * $r) {
                    imagesetpixel($img, $x, $y, $rgbColor);
                }
                $y++;
            }
            $x++;
        }
        ob_start();
        imagepng($img, $path);
        imagedestroy($img);
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
    private function qrcodeWithLogo($QR, $logo, $path)
    {
        $QR = imagecreatefromstring($QR);
        $logo = imagecreatefromstring($logo);
        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);
        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);
        $logo_qr_width = $QR_width / 2.2;
        $scale = $logo_width / $logo_qr_width;
        $logo_qr_height = $logo_height / $scale;
        $from_width = ($QR_width - $logo_qr_width) / 2;
        imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        ob_start();
        imagepng($QR, $path);
        imagedestroy($QR);
        imagedestroy($logo);
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
    private function creat_post($card_id)
    {
        global $_W, $_GPC;
        load()->func('tpl');
        load()->classs('wxapp.account');
        $token_s = pdo_fetch('SELECT * FROM ' . tablename('account_wxapp') . ' WHERE uniacid =:uniacid', array(":uniacid" => $_W['uniacid']));
        $account_api = new WxappAccount($token_s);
        $token = $account_api->getAccessToken();
        $url = "https://api.weixin.qq.com/wxa/getwxacode?access_token={$token}";
        $msgdata = array();
        $msgdata['width'] = 430;
        $msgdata['path'] = 'dbs_masclwlcard/pages/tab/tab?card_id=' . $card_id;
        $jsonData = json_encode($msgdata);
        $result = ihttp_request($url, $jsonData);
        return $result;
    }
    public function doWebCard_list()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        checklogin();
        if ($_GPC['op'] == 'detail') {
            if (!$_GPC['id']) {
                message('参数错误', $this->createWebUrl('card_list'), 'error');
            }
            $op = $_GPC['op'];
            $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
            if (!empty($info)) {
                include $this->template('card_list');
            } else {
                message('参数错误', $this->createWebUrl('card_list'), 'success');
            }
        } else {
            if (checksubmit('submit')) {
                if ($_GPC['uniacid'] != $_W['uniacid']) {
                    message('操作失败！', $this->createWebUrl('card_list'), 'error');
                }
                if (!empty($_GPC['sort'])) {
                    foreach ($_GPC['sort'] as $id => $sort) {
                        pdo_update('dbs_masclwlcard', array("sort" => $sort), array("id" => $id));
                    }
                    message('名片排序更新成功！', $this->createWebUrl('card_list', array("op" => "display")), 'success');
                }
            } else {
                $pindex = max(1, intval($_GPC['page']));
                $psize = 5;
                $activity = pdo_fetchall('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid and is_sendcard=0 order by sort desc ' . 'LIMIT ' . ($pindex - 1) * $psize . ',' . $psize, array(":uniacid" => $_W['uniacid']));
                if (!empty($activity)) {
                    foreach ($activity as $k => $v) {
                        $activity[$k]['wx_png'] = tomedia('/addons/dbs_masclwlcard/sea/' . $_W['uniacid'] . '/' . $v['id'] . '.png');
                    }
                }
                $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('dbs_masclwlcard') . 'where uniacid=:uniacid and  is_sendcard=0 ', array(":uniacid" => $_W['uniacid']));
                $pager = pagination($total, $pindex, $psize);
                include $this->template('card_list');
            }
        }
    }
    public function doWebDeletecard()
    {
        global $_W, $_GPC;
        $find = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        if (!empty($find)) {
            $result = pdo_delete('dbs_masclwlcard', array("id" => "{$_GPC['id']}"));
            if (!empty($result)) {
                message('删除成功', $this->createWebUrl('card_list'), 'success');
            }
        }
    }
    public function doWebSetboss()
    {
        global $_W, $_GPC;
        $find = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        if (!empty($find)) {
            $status = $find['open_boss'] ? 0 : 1;
            $result = pdo_update('dbs_masclwlcard', array("open_boss" => $status), array("id" => "{$_GPC['id']}"));
            if (!empty($result)) {
                $this->dexit(array("code" => 1, "data" => $status));
            }
        } else {
            $this->dexit(array("code" => 0));
        }
    }
    public function doWebWebsite()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        if (checksubmit('submit')) {
            if ($_GPC['tx_video']) {
                preg_match('/\\/([0-9a-zA-Z]+).html/', $_GPC['video'], $vides);
                $_GPC['video'] = $vides[1];
            }
            $data = array();
            $data = array("uniacid" => $_W['uniacid'], "tx_video" => $_GPC['tx_video'], "video" => $_GPC['video'], "cp_bs_content" => serialize($_GPC['cp_bs_content']), "images" => $_GPC['images']);
            $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_web') . " WHERE uniacid ='{$_W['uniacid']}'");
            if (empty($info['id'])) {
                $result = pdo_insert('dbs_masclwlcard_web', $data);
                if (!empty($result)) {
                    message('操作成功！', $this->createWebUrl('website'), 'success');
                } else {
                    message('操作失败！', $this->createWebUrl('website'), 'error');
                }
            } else {
                pdo_update('dbs_masclwlcard_web', $data, array("id" => $info['id']));
            }
            message('操作成功！', $this->createWebUrl('website'), 'success');
        }
        $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_web') . " WHERE uniacid ='{$_W['uniacid']}'");
        $info['cp_bs_content'] = unserialize($info['cp_bs_content']);
        include $this->template('website');
    }
    public function doWebAdv()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        if (checksubmit('submit')) {
            $data = array();
            $data = array("uniacid" => $_W['uniacid'], "images" => $_GPC['images']);
            if ($_GPC['id']) {
                $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_adv') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
                if (empty($info['id'])) {
                    $result = pdo_insert('dbs_masclwlcard_adv', $data);
                    if (!empty($result)) {
                        message('操作成功！', $this->createWebUrl('adv'), 'success');
                    } else {
                        message('操作失败！', $this->createWebUrl('adv'), 'error');
                    }
                } else {
                    pdo_update('dbs_masclwlcard_adv', $data, array("id" => $info['id']));
                    message('操作成功！', $this->createWebUrl('adv', array("id" => $info['id'])), 'success');
                }
            } else {
                $result = pdo_insert('dbs_masclwlcard_adv', $data);
                if (!empty($result)) {
                    message('操作成功！', $this->createWebUrl('adv'), 'success');
                } else {
                    message('操作失败！', $this->createWebUrl('adv'), 'error');
                }
            }
        }
        $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_adv') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        include $this->template('adv');
    }
    public function doWebAdv_list()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        checklogin();
        if (checksubmit('submit')) {
            if ($_GPC['uniacid'] != $_W['uniacid']) {
                message('操作失败！', $this->createWebUrl('adv_list'), 'error');
            }
            if (empty($_GPC['id'])) {
                message('请选择', $this->createWebUrl('adv_list'), 'error');
            }
            $result = pdo_delete('dbs_masclwlcard_adv', array("uniacid" => $_W['uniacid'], "id" => $_GPC['id']));
            if (!empty($result)) {
                message('操作成功！', $this->createWebUrl('adv_list'), 'success');
            } else {
                message('操作失败！', $this->createWebUrl('adv_list'), 'error');
            }
        } else {
            $pindex = max(1, intval($_GPC['page']));
            $psize = 5;
            $activity = pdo_fetchall('SELECT * FROM ' . tablename('dbs_masclwlcard_adv') . ' WHERE uniacid =:uniacid ' . 'LIMIT ' . ($pindex - 1) * $psize . ',' . $psize, array(":uniacid" => $_W['uniacid']));
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('dbs_masclwlcard_adv') . 'where uniacid=:uniacid', array(":uniacid" => $_W['uniacid']));
            $pager = pagination($total, $pindex, $psize);
            include $this->template('adv_list');
        }
    }
    public function doWebDeleteadv()
    {
        global $_W, $_GPC;
        $find = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_adv') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        if (!empty($find)) {
            $result = pdo_delete('dbs_masclwlcard_adv', array("id" => "{$_GPC['id']}"));
            if (!empty($result)) {
                message('删除成功', $this->createWebUrl('adv_list'), 'success');
            }
        }
    }
    public function doWebNav()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        if (checksubmit('submit')) {
            $data = array();
            $data = array("uniacid" => $_W['uniacid'], "images" => $_GPC['images'], "title" => $_GPC['title'], "path_web" => $_GPC['path_web'], "path" => $_GPC['path'], "appid" => $_GPC['appid'], "linkType" => $_GPC['linkType'] ? $_GPC['linkType'] : 'new', "newid" => $_GPC['newid']);
            if ($_GPC['id']) {
                $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_nav') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
                if (empty($info['id'])) {
                    $result = pdo_insert('dbs_masclwlcard_nav', $data);
                    if (!empty($result)) {
                        message('操作成功！', $this->createWebUrl('nav'), 'success');
                    } else {
                        message('操作失败！', $this->createWebUrl('nav'), 'error');
                    }
                } else {
                    pdo_update('dbs_masclwlcard_nav', $data, array("id" => $info['id']));
                    message('操作成功！', $this->createWebUrl('nav', array("id" => $info['id'])), 'success');
                }
            } else {
                $result = pdo_insert('dbs_masclwlcard_nav', $data);
                if (!empty($result)) {
                    message('操作成功！', $this->createWebUrl('nav'), 'success');
                } else {
                    message('操作失败！', $this->createWebUrl('nav'), 'error');
                }
            }
        }
        $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_nav') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        $newset = pdo_fetchall('SELECT * FROM ' . tablename('dbs_masclwlcard_news') . ' WHERE uniacid =:uniacid ', array(":uniacid" => $_W['uniacid']));
        include $this->template('nav');
    }
    public function doWebNav_list()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        checklogin();
        if (checksubmit('submit')) {
            if ($_GPC['uniacid'] != $_W['uniacid']) {
                message('操作失败！', $this->createWebUrl('nav_list'), 'error');
            }
            if (empty($_GPC['id'])) {
                message('请选择', $this->createWebUrl('nav_list'), 'error');
            }
            $result = pdo_delete('dbs_masclwlcard_nav', array("uniacid" => $_W['uniacid'], "id" => $_GPC['id']));
            if (!empty($result)) {
                message('操作成功！', $this->createWebUrl('nav_list'), 'success');
            } else {
                message('操作失败！', $this->createWebUrl('nav_list'), 'error');
            }
        } else {
            $pindex = max(1, intval($_GPC['page']));
            $psize = 5;
            $activity = pdo_fetchall('SELECT * FROM ' . tablename('dbs_masclwlcard_nav') . ' WHERE uniacid =:uniacid ' . 'LIMIT ' . ($pindex - 1) * $psize . ',' . $psize, array(":uniacid" => $_W['uniacid']));
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('dbs_masclwlcard_nav') . 'where uniacid=:uniacid', array(":uniacid" => $_W['uniacid']));
            $pager = pagination($total, $pindex, $psize);
            include $this->template('nav_list');
        }
    }
    public function doWebDeletenav()
    {
        global $_W, $_GPC;
        $find = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_nav') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        if (!empty($find)) {
            $result = pdo_delete('dbs_masclwlcard_nav', array("id" => "{$_GPC['id']}"));
            if (!empty($result)) {
                message('删除成功', $this->createWebUrl('nav_list'), 'success');
            }
        }
    }
    public function doWebNews()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        if (checksubmit('submit')) {
            $data = array();
            $data = array("uniacid" => $_W['uniacid'], "time" => time(), "title" => $_GPC['title'], "head_img" => $_GPC['head_img'], "content" => $_GPC['content']);
            if ($_GPC['id']) {
                $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_news') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
                if (empty($info['id'])) {
                    $result = pdo_insert('dbs_masclwlcard_news', $data);
                    if (!empty($result)) {
                        message('操作成功！', $this->createWebUrl('news'), 'success');
                    } else {
                        message('操作失败！', $this->createWebUrl('news'), 'error');
                    }
                } else {
                    pdo_update('dbs_masclwlcard_news', $data, array("id" => $info['id']));
                    message('操作成功！', $this->createWebUrl('news', array("id" => $info['id'])), 'success');
                }
            } else {
                $result = pdo_insert('dbs_masclwlcard_news', $data);
                if (!empty($result)) {
                    message('操作成功！', $this->createWebUrl('news'), 'success');
                } else {
                    message('操作失败！', $this->createWebUrl('news'), 'error');
                }
            }
        }
        $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_news') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        include $this->template('news');
    }
    public function doWebNews_list()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        checklogin();
        if (checksubmit('submit')) {
            if ($_GPC['uniacid'] != $_W['uniacid']) {
                message('操作失败！', $this->createWebUrl('news_list'), 'error');
            }
            if (!empty($_GPC['sort'])) {
                foreach ($_GPC['sort'] as $id => $sort) {
                    pdo_update('dbs_masclwlcard_news', array("sort" => $sort), array("id" => $id));
                }
                message('排序更新成功！', $this->createWebUrl('news_list', array("op" => "display")), 'success');
            }
        } else {
            $pindex = max(1, intval($_GPC['page']));
            $psize = 5;
            $activity = pdo_fetchall('SELECT * FROM ' . tablename('dbs_masclwlcard_news') . ' WHERE uniacid =:uniacid order by sort DESC ' . 'LIMIT ' . ($pindex - 1) * $psize . ',' . $psize, array(":uniacid" => $_W['uniacid']));
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('dbs_masclwlcard_news') . 'where uniacid=:uniacid order by sort DESC  ', array(":uniacid" => $_W['uniacid']));
            $pager = pagination($total, $pindex, $psize);
            include $this->template('news_list');
        }
    }
    public function doWebDeletenews()
    {
        global $_W, $_GPC;
        $find = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_news') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        if (!empty($find)) {
            $result = pdo_delete('dbs_masclwlcard_news', array("id" => "{$_GPC['id']}"));
            if (!empty($result)) {
                message('删除成功', $this->createWebUrl('news_list'), 'success');
            }
        }
    }
    public function doWebProduct()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        if (checksubmit('submit')) {
            $data = array();
            $data = array("uniacid" => $_W['uniacid'], "cp_bs_img" => serialize($_GPC['cp_bs_img']), "cp_bs_name" => $_GPC['cp_bs_name'], "cp_bs_price" => $_GPC['cp_bs_price'], "cp_bs_content" => serialize($_GPC['cp_bs_content']));
            if ($_GPC['id']) {
                $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_product') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
                if (empty($info['id'])) {
                    $result = pdo_insert('dbs_masclwlcard_product', $data);
                    if (!empty($result)) {
                        message('操作成功！', $this->createWebUrl('product'), 'success');
                    } else {
                        message('操作失败！', $this->createWebUrl('product'), 'error');
                    }
                } else {
                    pdo_update('dbs_masclwlcard_product', $data, array("id" => $info['id']));
                    message('操作成功！', $this->createWebUrl('product', array("id" => $info['id'])), 'success');
                }
            } else {
                $result = pdo_insert('dbs_masclwlcard_product', $data);
                if (!empty($result)) {
                    message('操作成功！', $this->createWebUrl('product'), 'success');
                } else {
                    message('操作失败！', $this->createWebUrl('product'), 'error');
                }
            }
        }
        $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_product') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        $info['cp_bs_img'] = unserialize($info['cp_bs_img']);
        $info['cp_bs_content'] = unserialize($info['cp_bs_content']);
        include $this->template('product');
    }
    public function doWebProduct_list()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        checklogin();
        if (checksubmit('submit')) {
            if ($_GPC['uniacid'] != $_W['uniacid']) {
                message('操作失败！', $this->createWebUrl('product_list'), 'error');
            }
            if (!empty($_GPC['sort'])) {
                foreach ($_GPC['sort'] as $id => $sort) {
                    pdo_update('dbs_masclwlcard_product', array("sort" => $sort), array("id" => $id));
                }
                message('排序更新成功！', $this->createWebUrl('product_list', array("op" => "display")), 'success');
            }
        } else {
            $pindex = max(1, intval($_GPC['page']));
            $psize = 5;
            $activity = pdo_fetchall('SELECT * FROM ' . tablename('dbs_masclwlcard_product') . ' WHERE uniacid =:uniacid order by sort DESC  ' . 'LIMIT ' . ($pindex - 1) * $psize . ',' . $psize, array(":uniacid" => $_W['uniacid']));
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('dbs_masclwlcard_product') . 'where uniacid=:uniacid order by sort DESC  ', array(":uniacid" => $_W['uniacid']));
            $pager = pagination($total, $pindex, $psize);
            include $this->template('product_list');
        }
    }
    public function doWebDeleteproduct()
    {
        global $_W, $_GPC;
        $find = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_product') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        if (!empty($find)) {
            $result = pdo_delete('dbs_masclwlcard_product', array("id" => "{$_GPC['id']}"));
            if (!empty($result)) {
                message('删除成功', $this->createWebUrl('product_list'), 'success');
            }
        }
    }
    public function doWebCard_Member()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        checklogin();
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $condition = '';
        if (!empty($_GPC['keyword'])) {
            $condition .= " AND (phone LIKE '%{$_GPC['keyword']}%' or nickname LIKE '%{$_GPC['keyword']}%' or name LIKE '%{$_GPC['keyword']}%')";
        }
        $ordersql = 'SELECT * FROM' . tablename('dbs_masclwlcard_card_member') . "where uniacid=:uniacid {$condition}  order by addtime desc " . 'LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
        $paras = array(":uniacid" => $_W['uniacid']);
        $alltuan = pdo_fetchall($ordersql, $paras);
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('dbs_masclwlcard_card_member') . "where uniacid=:uniacid {$condition} ", $paras);
        $pager = pagination($total, $pindex, $psize);
        include $this->template('card_member');
    }
    public function doWebDetail_card_member()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        checklogin();
        $find = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_card_member') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        if (!empty($find)) {
            if ($find['source_id']) {
                $source = array();
                $source = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_card_member') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $find['source_id']));
                $redpack = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_cash') . ' WHERE uniacid =:uniacid AND source_id=:source_id AND m_id=:m_id ', array(":uniacid" => $_W['uniacid'], ":source_id" => $find['source_id'], ":m_id" => $find['id']));
            }
        }
        $card = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $find['aid']));
        $listaddres = pdo_fetchall('SELECT * FROM ' . tablename('dbs_masclwlcard_shops_address') . ' WHERE uniacid =:uniacid AND openId=:openId', array(":uniacid" => $_W['uniacid'], ":openId" => $find['openId']));
        include $this->template('detail_card_member');
    }
    public function doWebMember()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        checklogin();
        if (checksubmit('submit')) {
            if ($_GPC['uniacid'] != $_W['uniacid']) {
                message('操作失败！', $this->createWebUrl('member'), 'error');
            }
            if (empty($_GPC['id'])) {
                message('请选择', $this->createWebUrl('member'), 'error');
            }
            $delcountsql = 'SELECT COUNT(*) FROM' . tablename('dbs_masclwlcard_member') . 'where uniacid=:uniacid and id=:sid';
            $delcount = pdo_query($delcountsql, array(":sid" => $_GPC['id'], ":uniacid" => $_W['uniacid']));
            $result = pdo_delete('dbs_masclwlcard_member', array("uniacid" => $_W['uniacid'], "id" => $_GPC['id']));
            if (!empty($result)) {
                message('操作成功！', $this->createWebUrl('member'), 'success');
            } else {
                message('操作失败！', $this->createWebUrl('member'), 'error');
            }
        } else {
            $pindex = max(1, intval($_GPC['page']));
            $psize = 20;
            $ordersql = 'SELECT * FROM' . tablename('dbs_masclwlcard_member') . 'where uniacid=:uniacid   order by addtime desc ' . 'LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
            $paras = array(":uniacid" => $_W['uniacid']);
            $alltuan = pdo_fetchall($ordersql, $paras);
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('dbs_masclwlcard_member') . 'where uniacid=:uniacid ', $paras);
            $pager = pagination($total, $pindex, $psize);
            include $this->template('member');
        }
    }
    public function doWebDeletemember()
    {
        global $_W, $_GPC;
        $find = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_member') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        if (!empty($find)) {
            $result = pdo_delete('dbs_masclwlcard_member', array("id" => "{$_GPC['id']}"));
            if (!empty($result)) {
                message('删除成功', $this->createWebUrl('member'), 'success');
            } else {
                message('删除失败', $this->createWebUrl('member'), 'error');
            }
        }
    }
    public function doWebFriend()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        if (checksubmit('submit')) {
            $data = array();
            $data = array("uniacid" => $_W['uniacid'], "time" => time(), "title" => $_GPC['title'], "head_img" => $_GPC['head_img'], "content" => $_GPC['content']);
            if ($_GPC['id']) {
                $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_friend') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
                if (empty($info['id'])) {
                    $result = pdo_insert('dbs_masclwlcard_friend', $data);
                    if (!empty($result)) {
                        message('操作成功！', $this->createWebUrl('friend'), 'success');
                    } else {
                        message('操作失败！', $this->createWebUrl('friend'), 'error');
                    }
                } else {
                    pdo_update('dbs_masclwlcard_friend', $data, array("id" => $info['id']));
                    message('操作成功！', $this->createWebUrl('friend', array("id" => $info['id'])), 'success');
                }
            } else {
                $result = pdo_insert('dbs_masclwlcard_friend', $data);
                if (!empty($result)) {
                    message('操作成功！', $this->createWebUrl('friend'), 'success');
                } else {
                    message('操作失败！', $this->createWebUrl('friend'), 'error');
                }
            }
        }
        $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_friend') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        $info['cp_bs_img'] = unserialize($info['cp_bs_img']);
        $info['cp_bs_content'] = unserialize($info['cp_bs_content']);
        include $this->template('friend');
    }
    public function doWebFriend_list()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        checklogin();
        if (checksubmit('submit')) {
            if ($_GPC['uniacid'] != $_W['uniacid']) {
                message('操作失败！', $this->createWebUrl('friend_list'), 'error');
            }
            if (!empty($_GPC['sort'])) {
                foreach ($_GPC['sort'] as $id => $sort) {
                    pdo_update('dbs_masclwlcard_friend', array("sort" => $sort), array("id" => $id));
                }
                message('排序更新成功！', $this->createWebUrl('friend_list', array("op" => "display")), 'success');
            }
        } else {
            $pindex = max(1, intval($_GPC['page']));
            $psize = 5;
            $activity = pdo_fetchall('SELECT * FROM ' . tablename('dbs_masclwlcard_friend') . ' WHERE uniacid =:uniacid and card_id=0 order by sort DESC ' . 'LIMIT ' . ($pindex - 1) * $psize . ',' . $psize, array(":uniacid" => $_W['uniacid']));
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('dbs_masclwlcard_friend') . 'where uniacid=:uniacid and card_id=0 order by sort DESC ', array(":uniacid" => $_W['uniacid']));
            $pager = pagination($total, $pindex, $psize);
            include $this->template('friend_list');
        }
    }
    public function doWebDeletefriend()
    {
        global $_W, $_GPC;
        $find = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_friend') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        if (!empty($find)) {
            $result = pdo_delete('dbs_masclwlcard_friend', array("id" => "{$_GPC['id']}"));
            if (!empty($result)) {
                message('删除成功', $this->createWebUrl('friend_list'), 'success');
            }
        }
    }
    public function doWebFriend_manage()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        checklogin();
        if (checksubmit('submit')) {
            if ($_GPC['uniacid'] != $_W['uniacid']) {
                message('操作失败！', $this->createWebUrl('friend_manage'), 'error');
            }
            if (empty($_GPC['id'])) {
                message('请选择', $this->createWebUrl('friend_manage'), 'error');
            }
            $result = pdo_delete('dbs_masclwlcard_pl', array("uniacid" => $_W['uniacid'], "id" => $_GPC['id']));
            if (!empty($result)) {
                message('操作成功！', $this->createWebUrl('friend_manage'), 'success');
            } else {
                message('操作失败！', $this->createWebUrl('friend_manage'), 'error');
            }
        } else {
            $pindex = max(1, intval($_GPC['page']));
            $psize = 15;
            $activity = pdo_fetchall('SELECT * FROM ' . tablename('dbs_masclwlcard_pl') . ' WHERE uniacid =:uniacid  AND (avatarUrl != 1) ' . 'LIMIT ' . ($pindex - 1) * $psize . ',' . $psize, array(":uniacid" => $_W['uniacid']));
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('dbs_masclwlcard_pl') . 'where uniacid=:uniacid ', array(":uniacid" => $_W['uniacid']));
            $pager = pagination($total, $pindex, $psize);
            include $this->template('friend_manage');
        }
    }
    public function doWebDeletefriend_manage()
    {
        global $_W, $_GPC;
        $find = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_pl') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $_GPC['id']));
        if (!empty($find)) {
            $result = pdo_delete('dbs_masclwlcard_pl', array("id" => "{$_GPC['id']}"));
            if (!empty($result)) {
                message('删除成功', $this->createWebUrl('friend_manage'), 'success');
            }
        }
    }
    public function doWebShops()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebCategory()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebSpec_goods()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebOrder_list()
    {
        $this->__web(__FUNCTION__);
    }
    public function doWebShops_fx()
    {
        $this->__web(__FUNCTION__);
    }
    public function __web($funname)
    {
        global $_W, $_GPC;
        checklogin();
        $uniacid = $_W['uniacid'];
        load()->func('tpl');
        include_once MODULE_ROOT . '/web/' . strtolower(substr($funname, 5)) . '.php';
    }
    public function __mobile($f_name)
    {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        include_once MODULE_ROOT . '/mobile/' . strtolower(substr($f_name, 8)) . '.php';
    }
    public function doMobileChat()
    {
        global $_W, $_GPC;
        $card_id = $_GPC['card_id'];
        $openId = $_GPC['openid'];
        $card = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $card_id));
        $chat_info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_card_member') . ' WHERE uniacid =:uniacid AND aid=:aid AND openId=:openId', array(":uniacid" => $_W['uniacid'], ":aid" => $card_id, ":openId" => $openId));
        $msg = pdo_fetchall('SELECT * FROM ' . tablename('dbs_masclwlcard_chat') . ' WHERE uniacid =:uniacid and openId=:openId and stype=1 and card_id=:card_id and addtime>=:addtime', array(":uniacid" => $_W['uniacid'], ":addtime" => time() - 24 * 3600, "card_id" => $card_id, ":openId" => $openId));
        include $this->template('chat');
    }
    private function send_post($openid, $card_id, $content)
    {
        global $_W, $_GPC;
        load()->func('tpl');
        $card = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid AND id=:aid', array(":uniacid" => $_W['uniacid'], ":aid" => $card_id));
        $set = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_set') . " WHERE uniacid ='{$_W['uniacid']}'");
        $chat_info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_chat') . ' WHERE uniacid =:uniacid AND is_send=0 AND openId=:openId AND card_id=:aid  AND send_fromid=0 and addtime>=:addtime order by addtime desc', array(":uniacid" => $_W['uniacid'], ":openId" => $openid, ":aid" => $card_id, ":addtime" => time() - 6 * 24 * 3600));
        load()->classs('wxapp.account');
        $token_s = pdo_fetch('SELECT * FROM ' . tablename('account_wxapp') . ' WHERE uniacid =:uniacid', array(":uniacid" => $_W['uniacid']));
        $account_api = new WxappAccount($token_s);
        $token = $account_api->getAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=' . $token;
        if (!empty($chat_info) && $chat_info['formId']) {
            $msgdata = array();
            $msgdata['touser'] = $openid;
            $msgdata['template_id'] = $set['template_id'];
            $msgdata['form_id'] = $chat_info['formId'];
            $msgdata['page'] = 'dbs_masclwlcard/pages/tab/tab?card_id=' . $card_id;
            $msgdata['data']['keyword1']['value'] = $content;
            $msgdata['data']['keyword2']['value'] = $card['card_name'];
            $msgdata['data']['keyword3']['value'] = $card['card_tel'];
            $jsonData = json_encode($msgdata, JSON_UNESCAPED_UNICODE);
            $result = ihttp_request($url, $jsonData);
            pdo_update('dbs_masclwlcard_chat', array("send_fromid" => 1, "avatar" => $chat_info['formId'] . json_encode($result, true)), array("id" => $chat_info['id']));
        } else {
            $all_formid = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_formid') . ' WHERE uniacid =:uniacid AND  openId=:openId and addtime>=:addtime  order by addtime desc', array(":uniacid" => $_W['uniacid'], ":openId" => $openid, ":addtime" => time() - 6 * 24 * 3600));
            if (!empty($all_formid)) {
                $msgdata = array();
                $msgdata['touser'] = $openid;
                $msgdata['template_id'] = $set['template_id'];
                $msgdata['form_id'] = $all_formid['formId'];
                $msgdata['page'] = 'dbs_masclwlcard/pages/tab/tab?card_id=' . $card_id;
                $msgdata['data']['keyword1']['value'] = $content;
                $msgdata['data']['keyword2']['value'] = $card['card_name'];
                $msgdata['data']['keyword3']['value'] = $card['card_tel'];
                $jsonData = json_encode($msgdata, JSON_UNESCAPED_UNICODE);
                $result = ihttp_request($url, $jsonData);
                pdo_delete('dbs_masclwlcard_formid', array("uniacid" => $_W['uniacid'], "id" => $all_formid['id']));
            }
        }
        return $result;
    }
    public function doMobileDosend()
    {
        global $_W, $_GPC;
        load()->model('mc');
        $openId = $_GPC['openId'];
        $card_id = $_GPC['card_id'];
        $msg = isset($_GPC['msg']) ? $_GPC['msg'] : '';
        if (!$msg) {
            $this->dexit(array("error" => 1, "mess" => "请输入内容"));
        }
        $msg = isset($_GPC['msg']) ? $_GPC['msg'] : '';
        if (!$openId) {
            $this->dexit(array("error" => 1, "mess" => "参数错误"));
        }
        if (!$card_id) {
            $this->dexit(array("error" => 1, "mess" => "参数错误"));
        }
        $data = array();
        $user = array();
        $user['uniacid'] = $_W['uniacid'];
        $user['openId'] = $_GPC['openId'];
        $user['card_id'] = $_GPC['card_id'];
        $user['nickname'] = $data['nickname'];
        $user['gender'] = $data['gender'];
        $user['city'] = $data['city'];
        $user['province'] = $data['province'];
        $user['city'] = $data['city'];
        $user['language'] = $data['language'];
        $user['formId'] = '';
        $user['avatarUrl'] = $data['avatarUrl'];
        $user['msg'] = htmlspecialchars_decode($msg);
        $user['type'] = 0;
        $user['is_send'] = 1;
        $user['stype'] = 1;
        $user['addtime'] = time();
        $result = pdo_insert('dbs_masclwlcard_chat', $user);
        if (!empty($result)) {
            $this->send_post($_GPC['openId'], $_GPC['card_id'], $user['msg']);
            $this->dexit(array("error" => 0, "mess" => "发送成功"));
        } else {
            $this->dexit(array("error" => 1, "mess" => "发送失败"));
        }
    }
    public function doMobileGetsend()
    {
        global $_W, $_GPC;
        load()->model('mc');
        $openId = $_GPC['openId'];
        $card_id = $_GPC['card_id'];
        $info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_chat') . ' WHERE uniacid =:uniacid and openId=:openId and stype=0 and card_id=:card_id order by addtime asc', array(":uniacid" => $_W['uniacid'], ":openId" => $openId, "card_id" => $card_id));
        if (!empty($info)) {
            pdo_update('dbs_masclwlcard_chat', array("stype" => 1), array("id" => $info['id']));
            $this->dexit(array("success" => 1, "mess" => $info['msg']));
        } else {
            $this->dexit(array("success" => 0, "mess" => "无"));
        }
    }
    public function __mobile_staff($funname)
    {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        load()->func('tpl');
        include_once MODULE_ROOT . '/mobile/staffer/' . strtolower(substr($funname, 8)) . '.php';
    }
    public function doMobileGet_member_aidata()
    {
        $this->__mobile_staff(__FUNCTION__);
    }
    public function doMobileGet_member_change()
    {
        $this->__mobile_staff(__FUNCTION__);
    }
    public function doMobileGet_member_gj()
    {
        $this->__mobile_staff(__FUNCTION__);
    }
    public function doMobileGet_member_follow()
    {
        $this->__mobile_staff(__FUNCTION__);
    }
    public function doMobileGet_member_closer()
    {
        $this->__mobile_staff(__FUNCTION__);
    }
    public function doMobileStaffer_index()
    {
        $this->__mobile_staff(__FUNCTION__);
    }
    public function doMobileGet_ai_msg()
    {
        $this->__mobile_staff(__FUNCTION__);
    }
    public function doMobileMember_detail()
    {
        $this->__mobile_staff(__FUNCTION__);
    }
    public function doMobileGet_ai_msg_client()
    {
        $this->__mobile_staff(__FUNCTION__);
    }
    public function doMobileInteract()
    {
        $this->__mobile_staff(__FUNCTION__);
    }
    public function doMobileGet_interact()
    {
        $this->__mobile_staff(__FUNCTION__);
    }
    public function doMobileGet_interact_chart()
    {
        $this->__mobile_staff(__FUNCTION__);
    }
    public function doMobileMember_act()
    {
        $this->__mobile_staff(__FUNCTION__);
    }
    public function doMobileGet_member_act()
    {
        $this->__mobile_staff(__FUNCTION__);
    }
    public function doMobileGet_member_actiontype()
    {
        $this->__mobile_staff(__FUNCTION__);
    }
    public function __mobile_client($funname)
    {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        load()->func('tpl');
        include_once MODULE_ROOT . '/mobile/client/' . strtolower(substr($funname, 8)) . '.php';
    }
    public function doMobileClient_index()
    {
        $this->__mobile_client(__FUNCTION__);
    }
    public function doMobileClient_getlist()
    {
        $this->__mobile_client(__FUNCTION__);
    }
    public function doMobileClient_edit()
    {
        $this->__mobile_client(__FUNCTION__);
    }
    public function doMobileClient_save()
    {
        $this->__mobile_client(__FUNCTION__);
    }
    public function __mobile_friend($funname)
    {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        load()->func('tpl');
        include_once MODULE_ROOT . '/mobile/friend/' . strtolower(substr($funname, 8)) . '.php';
    }
    public function doMobileFriend_index()
    {
        $this->__mobile_friend(__FUNCTION__);
    }
    public function doMobileFriend_editor()
    {
        $this->__mobile_friend(__FUNCTION__);
    }
    public function doMobileFriend_save()
    {
        $this->__mobile_friend(__FUNCTION__);
    }
    public function doMobileget_friendlist()
    {
        $this->__mobile_friend(__FUNCTION__);
    }
    public function doMobileDeletepl()
    {
        $this->__mobile_friend(__FUNCTION__);
    }
    public function doMobileDeletedt()
    {
        $this->__mobile_friend(__FUNCTION__);
    }
    public function doMobileAdd_pl()
    {
        $this->__mobile_friend(__FUNCTION__);
    }
    public function doMobileAdd_zan()
    {
        $this->__mobile_friend(__FUNCTION__);
    }
    public function __mobile_home($funname)
    {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        load()->func('tpl');
        include_once MODULE_ROOT . '/mobile/home/' . strtolower(substr($funname, 8)) . '.php';
    }
    public function doMobileHome()
    {
        $this->__mobile_home(__FUNCTION__);
    }
    public function doMobileMy_edit()
    {
        $this->__mobile_home(__FUNCTION__);
    }
    public function doMobileMy_save_card()
    {
        $this->__mobile_home(__FUNCTION__);
    }
    public function doMobileMy_ewm()
    {
        $this->__mobile_home(__FUNCTION__);
    }
    public function doMobileMy_photo()
    {
        $this->__mobile_home(__FUNCTION__);
    }
    public function doMobileMy_photo_save()
    {
        $this->__mobile_home(__FUNCTION__);
    }
    public function doMobileMy_photo_get()
    {
        $this->__mobile_home(__FUNCTION__);
    }
    public function __mobile_boss($funname)
    {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        load()->func('tpl');
        include_once MODULE_ROOT . '/mobile/boss/' . strtolower(substr($funname, 8)) . '.php';
    }
    public function doMobileBoss_index()
    {
        $this->__mobile_boss(__FUNCTION__);
    }
    public function doMobileBoss_totle()
    {
        $this->__mobile_boss(__FUNCTION__);
    }
    public function doMobileBoss_probability()
    {
        $this->__mobile_boss(__FUNCTION__);
    }
    public function doMobileBoss_addpeople()
    {
        $this->__mobile_boss(__FUNCTION__);
    }
    public function doMobileBoss_gj()
    {
        $this->__mobile_boss(__FUNCTION__);
    }
    public function doMobileBoss_zx()
    {
        $this->__mobile_boss(__FUNCTION__);
    }
    public function doMobileBoss_hd()
    {
        $this->__mobile_boss(__FUNCTION__);
    }
    public function doMobileBoss_ranking()
    {
        $this->__mobile_boss(__FUNCTION__);
    }
    public function doMobileBoss_getrank()
    {
        $this->__mobile_boss(__FUNCTION__);
    }
    public function doMobileBoss_list()
    {
        $this->__mobile_boss(__FUNCTION__);
    }
    public function doMobileBoss_getclient_list()
    {
        $this->__mobile_boss(__FUNCTION__);
    }
    public function doMobileBoss_client_detail()
    {
        $this->__mobile_boss(__FUNCTION__);
    }
    public function doMobileBoss_ai()
    {
        $this->__mobile_boss(__FUNCTION__);
    }
    public function doMobileBoss_getai_data()
    {
        $this->__mobile_boss(__FUNCTION__);
    }
    public function doMobileFriend_download()
    {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        load()->func('tpl');
        if (!$_GPC['media_id']) {
            $this->dexit(array("Code" => 1));
            exit;
        }
        $status = $this->check_qylogin();
        if ($status == -1) {
            $this->dexit(array("Code" => 1));
            exit;
        }
        if ($status == -2) {
            $this->dexit(array("Code" => 1));
            exit;
        }
        $UserId = $_SESSION['session_dbs_masclwlcard_usderid'];
        $card_info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid and UserId=:UserId and is_sendcard=0 ', array(":uniacid" => $_W['uniacid'], ":UserId" => $UserId));
        if (empty($card_info)) {
            $this->dexit(array("Code" => 1));
            exit;
        }
        $this->download_image($_GPC['media_id'], $card_info['id']);
        $Data = tomedia('addons/dbs_masclwlcard/card_img/' . $_W['uniacid'] . '/' . $card_info['id'] . '/' . $_GPC['media_id'] . '.jpg');
        $this->dexit(array("Code" => 0, "Data" => $Data));
        exit;
    }
    private function download_image($media_id, $card_id)
    {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        load()->func('tpl');
        $set_qy = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_set_qy') . ' WHERE uniacid =:uniacid', array(":uniacid" => $_W['uniacid']));
        $access_token = $this->getAccessqyToken($set_qy['corpid'], $set_qy['secret']);
        $url = 'https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=' . $access_token . '&media_id=' . $media_id;
        $img = IA_ROOT . '/addons/dbs_masclwlcard/card_img/' . $_W['uniacid'] . '/' . $card_id . '/' . $media_id . '.jpg';
        load()->func('file');
        $dirpath = IA_ROOT . '/addons/dbs_masclwlcard/card_img/' . $_W['uniacid'] . '/' . $card_id;
        is_dir($dirpath) or mkdir($dirpath, 0755, true);
        $a = file_get_contents($url);
        $resource = fopen($img, 'w+');
        fwrite($resource, $a);
        fclose($resource);
        return 1;
    }
    public function check_bossqylogin()
    {
        global $_W, $_GPC;
        $set_qy = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_set_qy') . ' WHERE uniacid =:uniacid', array(":uniacid" => $_W['uniacid']));
        $UserId = $_SESSION['session_dbs_masclwlcard_usderid'];
        if (!$UserId) {
            $redirect_uri = $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&do=boss_index&m=dbs_masclwlcard';
            $scope = 'snsapi_base';
            $codeUrl = $this->get_code_url($set_qy, $redirect_uri, $scope);
            $qytoken = $this->getAccessqyToken($set_qy['corpid'], $set_qy['secret']);
            $apiOauth = new api_qy();
            $UserId = $apiOauth->webOauth($set_qy, $codeUrl, $qytoken);
            if (!$UserId) {
                return -1;
            } else {
                $_SESSION['session_dbs_masclwlcard_usderid'] = $UserId;
            }
        }
        $card_info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid and UserId=:UserId and is_sendcard=0', array(":uniacid" => $_W['uniacid'], ":UserId" => $UserId));
        if (empty($card_info)) {
            return -2;
        } else {
            return 1;
        }
    }
    public function check_qylogin()
    {
        global $_W, $_GPC;
        $set_qy = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard_set_qy') . ' WHERE uniacid =:uniacid', array(":uniacid" => $_W['uniacid']));
        $UserId = $_SESSION['session_dbs_masclwlcard_usderid'];
        if (!$UserId) {
            $redirect_uri = $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&do=Staffer_index&m=dbs_masclwlcard';
            $scope = 'snsapi_base';
            $codeUrl = $this->get_code_url($set_qy, $redirect_uri, $scope);
            $qytoken = $this->getAccessqyToken($set_qy['corpid'], $set_qy['secret']);
            $apiOauth = new api_qy();
            $UserId = $apiOauth->webOauth($set_qy, $codeUrl, $qytoken);
            if (!$UserId) {
                return -1;
            } else {
                $_SESSION['session_dbs_masclwlcard_usderid'] = $UserId;
            }
        }
        $card_info = pdo_fetch('SELECT * FROM ' . tablename('dbs_masclwlcard') . ' WHERE uniacid =:uniacid and UserId=:UserId and is_sendcard=0', array(":uniacid" => $_W['uniacid'], ":UserId" => $UserId));
        if (empty($card_info)) {
            return -2;
        } else {
            return 1;
        }
    }
    public function get_code_url($info, $redirect_uri = "", $scope = "")
    {
        $redirect_uri = urlencode($redirect_uri);
        $url = '';
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $info['corpid'] . '&redirect_uri=' . $redirect_uri . '&response_type=code&scope=' . $scope . '&agentid=' . $info['secret'] . '&state=STATE';
        $url .= '#wechat_redirect';
        return $url;
    }
    public function addSign($corpid, $ticket, $url)
    {
        $timestamp = time();
        $nonceStr = rand(100000, 999999);
        $array = array("noncestr" => $nonceStr, "jsapi_ticket" => $ticket, "timestamp" => $timestamp, "url" => $url);
        ksort($array);
        $signPars = '';
        foreach ($array as $k => $v) {
            if ('' != $v && 'sign' != $k) {
                if ($signPars == '') {
                    $signPars .= $k . '=' . $v;
                } else {
                    $signPars .= '&' . $k . '=' . $v;
                }
            }
        }
        $result = array("appId" => $corpid, "timestamp" => $timestamp, "nonceStr" => $nonceStr, "url" => $url, "signature" => SHA1($signPars));
        return $result;
    }
    public function getqy_jsapi_ticket($secret, $access_token)
    {
        global $_W, $_GPC;
        $path = IA_ROOT . '/addons/dbs_masclwlcard/alltoken/' . $_W['uniacid'] . '/' . $secret . 'jsapi_ticket.php';
        load()->func('file');
        $dirpath = IA_ROOT . '/addons/dbs_masclwlcard/alltoken/' . $_W['uniacid'] . '/';
        is_dir($dirpath) or mkdir($dirpath, 0777, true);
        $data = json_decode(file_get_contents($path));
        if ($data->expire_time < time()) {
            $url = 'https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=' . $access_token;
            $res = json_decode(file_get_contents($url));
            $ticket = $res->ticket;
            if ($ticket) {
                $data->expire_time = time() + 7000;
                $data->ticket = $ticket;
                $file = fopen($path, 'w');
                if ($file) {
                    set_file_buffer($file, 0);
                    fwrite($file, json_encode($data));
                    fclose($file);
                }
            }
        } else {
            $ticket = $data->ticket;
        }
        return $ticket;
    }
    public function getAccessqyToken($corpid, $secret)
    {
        global $_W, $_GPC;
        $path = IA_ROOT . '/addons/dbs_masclwlcard/alltoken/' . $_W['uniacid'] . '/' . $secret . '.php';
        load()->func('file');
        $dirpath = IA_ROOT . '/addons/dbs_masclwlcard/alltoken/' . $_W['uniacid'] . '/';
        is_dir($dirpath) or mkdir($dirpath, 0777, true);
        $data = json_decode(file_get_contents($path));
        if ($data->expire_time < time()) {
            $url = 'https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=' . $corpid . '&corpsecret=' . $secret;
            $res = json_decode(file_get_contents($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $file = fopen($path, 'w');
                if ($file) {
                    set_file_buffer($file, 0);
                    fwrite($file, json_encode($data));
                    fclose($file);
                }
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }
    private function dexit($data = "")
    {
        if (is_array($data)) {
            echo json_encode($data);
        } else {
            echo $data;
        }
        exit;
    }
}