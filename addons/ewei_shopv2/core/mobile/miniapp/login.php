<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Login_EweiShopV2Page extends MobileMiniappPage
{
    public function __construct()
    {
        if(!$this->getPayInfo())
        {
            show_json(1, '支付参数配置不正确');
        }
    }
    
	public function main() 
	{
		global $_W;
        global $_GPC;
        if($_W['ispost'] === false){
            show_json(1, '请求方式不正确！');
        }
        $uniacid = $_W['uniacid'];
        $jscode = $_GPC['code'];
        if(empty($jscode)){
            show_json(1, 'code不能为空！');
        }
        $appid = self::$APPID;
        $appsecret = self::$APPSECRET;
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . $appid .'&secret=' . $appsecret . '&js_code=' . $jscode . '&grant_type=authorization_code';
        load()->func('communication');
        $response = ihttp_get($url);
		if (is_error($response)) {
			show_json(1, '服务器请求错误！');
        }
        $result = json_decode($response['content'],true);
        if(!empty($result['errcode'])){
            show_json($result['errcode'], $result['errmsg']. $appid );
        }
        $session3rd = md5(time().rand(10000,9999).$result['openid']);
        if(cache_search($session3rd)){
            show_json(0, '已经登录过了');
        }
        if(!cache_write($session3rd,$result)){
            show_json(1, '网络异常！');
        }
        show_json(200, array('session3rd' => $session3rd));
    }
    
    public function logout(){
        $session3rd = $_GPC['session3rd'];
        if(empty($session3rd)){
            show_json(9999, '未登录！');
        }
        if(!cache_search($session3rd)){
            show_json(9999, '未登录!');
        }
        if(!cache_delete($session3rd)){
            show_json(1, '网络错误!');
        }
        show_json(200, '退出成功！');
    }
}
?>