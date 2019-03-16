<?php
/**
 * 课程管理模块微站定义
 *
 * @author 夺冠
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
define("ARTICLE", "dg_articlemanage");
define("RES", "../addons/".ARTICLE."/style/");
require_once"../addons/".ARTICLE."/WxPayPubHelper/"."WxPayPubHelper.php";
require_once"../addons/".ARTICLE."/oauth2.class.php";
class Dg_articlemanageModuleSite extends WeModuleSite {

	public function findKJsetting(){
		global $_W;
		$tempuniacid=$_W['uniacid'];
		$tempappid=$_W['account']['key'];
		$tempappsecret=$_W['account']['secret'];
		if($_W["account"]["level"]<4){
			$tempuniacid=$_W['oauth_account']['acid'];
			$tempappid=$_W['oauth_account']['key'];
			$tempappsecret=$_W['oauth_account']['secret'];
		}
		$kjsetting=array();
		$setting = uni_setting($tempuniacid, array('payment'));
		$pay = (array)$setting['payment'];

		$kjsetting['appid']=$tempappid;
		$kjsetting['appsecret']=$tempappsecret;

		$kjsetting['mchid']=$pay['wechat']['mchid'];
		$kjsetting['shkey']=$pay['wechat']['apikey'];
		return $kjsetting;
	}
	/**
	 * 授权方式获取用户信息
	 */
	public function getUserInfo(){
		global $_GPC,$_W;
		$uniacid=$_W['uniacid'];
		if($_SERVER['SERVER_PORT']=='80'){
			$redirect_uri='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		}else{
			$redirect_uri='https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		}
		$cookieKey="dg_article_user_info_".$_W['uniacid'];
		$cuser_info=$_GPC[$cookieKey];
		if(empty($_GPC[$cookieKey])){
			//load()->classs("oauth2");
			$oauth2=new Oauth2($_W['oauth_account']);

			if(empty($_GPC['code'])){
				$oauth2->authorization_code($redirect_uri, Oauth2::$SCOPE_USERINFO,'we7sid-'.$_W['session_id']);
			}
			$code=$_GPC['code'];
			$access_token=$oauth2->getOauthAccessToken($code);
			$user_info=$oauth2->getOauthUserInfo($access_token['openid'], $access_token['access_token']);
			$db_user=pdo_fetch("SELECT * FROM ".tablename("dg_article_user")." WHERE openid=:openid AND uniacid=:uniacid",array(":openid"=>$user_info['openid'],":uniacid"=>$_W['uniacid']));
			if(empty($db_user)){
				$data=array(
						"openid"=>$user_info['openid'],
						"uniacid"=>$_W['uniacid'],
						"nickname"=>$user_info['nickname'],
						"avatar"=>$user_info['headimgurl'],
						"createtime"=>time(),
						"sex"=>$user_info['sex'],
				);
				
				pdo_insert("dg_article_user",$data);
				$user_info['uid']=pdo_insertid();
			}else{
				$user_info['uid']=$db_user['id'];
			}			
			//$cookieKey="user_info";
			$cuser_info=$oauth2::setClientCookieUserInfo($user_info,$cookieKey);
		}

		$user_info=base64_decode($cuser_info);
		return $user_info;
	}
       public function sendTplNotice($touser, $template_id, $postdata, $url = '', $topcolor = '#FF683F'){
        global $_W;
        $Account = WeAccount::create($_W['account']);
        $Account->sendTplNotice($touser,$template_id,$postdata,$url,$topcolor);
    }
    /*获取带域名的全路径url*/
    public function get_normal_url($action,$parametrs){
        global $_W;
        $temp_url=$this->createMobileUrl($action,$parametrs);
        $temp_url=substr($temp_url, 1);
        $url=$_W['siteroot']."app".$temp_url;
        return $url;
    }  
	/*
	 * 生成订单*/
	public function build_order_sn(){
		return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
	}
	public function pay_cash($openid,$fee){
		global $_W;
		$url='https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
		$kjsetting=$this->findKJsetting();
		$pars = array();
		$pars['mch_appid'] =$kjsetting['appid'];
		$pars['mchid']=$kjsetting['mchid'];
		$pars['nonce_str'] =random(32);
		$pars['partner_trade_no'] =time().random(3,1);
		$pars['openid'] =$openid;
		$pars['check_name'] ='NO_CHECK' ;
		$pars['amount'] =$fee*100;
		$pars['desc'] ='付费阅读提现';
		$pars['spbill_create_ip'] =CLIENT_IP;

		ksort($pars, SORT_STRING);
		$string1 = '';
		foreach ($pars as $k => $v) {
			$string1 .= "{$k}={$v}&";
		}
		$string1 .= "key=".$kjsetting['shkey'];
		$pars['sign'] = strtoupper(md5($string1));
		$xml = array2xml($pars);

		$extras = array();

		$extras['CURLOPT_CAINFO'] =MODULE_ROOT.'/cert/apiclient_root_'.$_W['uniacid'].'.pem';
		$extras['CURLOPT_SSLCERT'] = MODULE_ROOT.'/cert/apiclient_cert_'.$_W['uniacid'].'.pem';
		$extras['CURLOPT_SSLKEY'] = MODULE_ROOT.'/cert/apiclient_key_'.$_W['uniacid'].'.pem';

		$procResult = null;
		load()->func('communication');
		$resp = ihttp_request($url, $xml, $extras);

		if (is_error($resp)) {
			$procResult = $resp;
		} else {
			$arr=json_decode(json_encode((array) simplexml_load_string($resp['content'])), true);
			$xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
			$dom = new \DOMDocument();
			if ($dom->loadXML($xml)) {
				$xpath = new \DOMXPath($dom);
				$code = $xpath->evaluate('string(//xml/return_code)');
				$ret = $xpath->evaluate('string(//xml/result_code)');
				if (strtolower($code) == 'success' && strtolower($ret) == 'success') {
					$payment_no=$xpath->evaluate('string(//xml/payment_no)');
					$procResult =  array('errno'=>0,'error'=>'success','payment_no'=>$payment_no);
				} else {
					$error = $xpath->evaluate('string(//xml/err_code_des)');
					$procResult = array('errno'=>-2,'error'=>$error);
				}
			} else {
				$procResult = array('errno'=>-1,'error'=>'未知错误');
			}
		}
		return $procResult;
	}
	          //下载图片
    public function downloadImage($mediaids) {
        global $_W;
        $uniacid = $_W['uniacid'];
        load()->func('file');
        $account = WeAccount::create($_W['account']);
        $mediaarray=explode(",",$mediaids);
        $filenames="";
        foreach($mediaarray as $mediaid){
            $filename = 'FMFetchi'.date('YmdHis').random(16);
            $access_token = $account->fetch_token();
            $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$mediaid";
        
            $fileInfo = $this->downloadWeixinFile($url);
            $updir = '../attachment/images/'.$uniacid.'/'.date("Y").'/'.date("m").'/';
            if(!is_dir($updir)){
                mkdirs($updir);
            }
            $filename= $updir.$filename.".jpg";
            $this->saveWeixinFile($filename, $fileInfo["body"]);
            $filenames.=$filename.",";
        }
        return $filenames;
    }

    public function downloadWeixinFile($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_NOBODY, 0);    //只取body头
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $package = curl_exec($ch);
        $httpinfo = curl_getinfo($ch);
        curl_close($ch);
        $imageAll = array_merge(array('header' => $httpinfo), array('body' => $package));
        return $imageAll;
    }

    public function saveWeixinFile($filename, $filecontent) {
        $local_file = fopen($filename, 'w');
        if (false !== $local_file){
            if (false !== fwrite($local_file, $filecontent)) {
                fclose($local_file);
            }
        }
    }
}