<?php
/**
 * 模块微站定义
 *
 * @author 众惠科技
 * @url http://bbs.we7.cc/ 
 */
global $_W;
defined('IN_IA') or exit('Access Denied');
define('ST_ROOT',IA_ROOT.'/addons/active/');
define('ST_URL',$_W['siteroot'].'addons/active/');
define('MODULE','active');
require_once(ST_ROOT.'class/autoload.php');

class ActiveModuleSite extends WeModuleSite {
    protected $pagesize;
    public function __construct()
    {
        global $_W,$_GPC;

        if (empty($_GPC['op'])){
            if ($_W['container']!='wechat'){
                message('请用在微信内部浏览器打开！');
            }

            //微信登录
            if (empty($_W['fans']['nickname']) || empty($_SESSION['userinfo']['id'])) {
                mc_oauth_userinfo();
                $userinfo = pdo_get('active_users',array('openid'=>$_W['fans']['tag']['openid'],'uniacid'=>$_W['uniacid']));
                if (empty($userinfo)){
                    $userdata = $_W['fans']['tag'];
                    $data['create_time'] = time();
                    $data['uniacid'] = $_W['uniacid'];
                    $data['nickname'] = $userdata['nickname'];
                    $data['openid'] = $userdata['openid'];
                    $data['sex'] = $userdata['sex'];
                    $data['city'] = $userdata['city'];
                    $data['province'] = $userdata['province'];
                    $data['country'] = $userdata['country'];
                    $data['avatar'] = $userdata['avatar'];
                    pdo_insert('active_users', $data);
                    $userinfo = pdo_get('active_users',array('openid'=>$_W['fans']['tag']['openid'],'uniacid'=>$_W['uniacid']));
                }
                $_SESSION['userinfo'] = $userinfo;
            }
        }
//        $userinfo = pdo_get('active_users',array('id'=>26));
//        $_SESSION['userinfo'] = $userinfo;

        $this->pagesize = 10;
    }
}

