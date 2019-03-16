<?php
  /********************************************************
   *   @author Kyler You <QQ:2444756311>
   *   @link http://mp.weixin.qq.com/wiki/home/index.html
   *   @version 2.0.1
   *   @uses $wxApi = new WxApi();
   *   @package 微信API接口 陆续会继续进行更新
   ********************************************************/
  
class wxapi{
    private static $appId     = "";
    private static $appSecret   = ""; 
    private static $mchid     = ""; //商户号
    private static $privatekey  = ""; //私钥
    public $error;
    public $parameters = array();
  
    public function __construct($appid="",$appSecret="",$mchid="",$privatekey=""){
        self::$appId = $appid;
        self::$appSecret = $appSecret;
        self::$mchid = $mchid;
        self::$privatekey = $privatekey;
    }
  
    /****************************************************
     * 微信提交API方法，返回微信指定JSON
     ****************************************************/
  
    public function wxHttpsRequest($url,$data = null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
  
    /****************************************************
     * 微信带证书提交数据 - 微信红包使用
     ****************************************************/
  
    public function wxHttpsRequestPem($url, $vars, $second=30,$aHeader=array()){
        $ch = curl_init();
        //超时时间
        curl_setopt($ch,CURLOPT_TIMEOUT,$second);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
  
        //以下两种方式需选择一种
  
        //第一种方法，cert 与 key 分别属于两个.pem文件
        //默认格式为PEM，可以注释
        curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/apiclient_cert.pem');
        //默认格式为PEM，可以注释
        curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLKEY,getcwd().'/apiclient_key.pem');
  
        curl_setopt($ch,CURLOPT_CAINFO,'PEM');
        curl_setopt($ch,CURLOPT_CAINFO,getcwd().'/rootca.pem');
  
        //第二种方式，两个文件合成一个.pem文件
        //curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/all.pem');
  
        if( count($aHeader) >= 1 ){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        }
  
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
        $data = curl_exec($ch);
        if($data){
            curl_close($ch);
            return $data;
        }
        else { 
            $error = curl_errno($ch);
            echo "call faild, errorCode:$error\n"; 
            curl_close($ch);
            return false;
        }
    }
  
    /****************************************************
     * 微信获取AccessToken 返回指定微信公众号的at信息
     ****************************************************/
  
   /*  public function wxAccessToken($appId = NULL , $appSecret = NULL){
        $appId     = is_null($appId) ? self::$appId : $appId;
        $appSecret   = is_null($appSecret) ? self::$appSecret : $appSecret;
        //echo $appId,$appSecret;
        $url      = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appId."&secret=".$appSecret;
        $result     = $this->wxHttpsRequest($url);
        //print_r($result);
        $jsoninfo    = json_decode($result, true);
        $access_token  = $jsoninfo["access_token"];
        return $access_token;
    } */
   public function wxAccessToken($appId = NULL , $appSecret = NULL){
        $appId     = is_null($appId) ? self::$appId : $appId;
        $appSecret   = is_null($appSecret) ? self::$appSecret : $appSecret;
        $cachename = 'account:auth:accesstoken:wxapi:'.$appId;
        $accesstoken = cache_load($cachename);
        if (empty($accesstoken) || empty($accesstoken['access_token']) || $accesstoken['dateline'] < TIMESTAMP) {
            $url      = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appId."&secret=".$appSecret;
            $result     = $this->wxHttpsRequest($url);
            //print_r($result);
            $accesstoken    = json_decode($result, true);
            $access_token    = $accesstoken['access_token'];
            if(strlen($access_token) >= 64){
                $time  = time();
                $dateline = $time+7000;
                $accesstoken['dateline'] = $dateline;
                cache_write($cachename, $accesstoken);
            }else{
                $this->error = array('status'=>'1','msg'=>'accessToken生成失败！','errinfo'=>$jsoninfo);
                return false;
            }
            return $access_token;
        }else{
            return $accesstoken['access_token'];
        }
   }
  
    /****************************************************
     * 微信通过OPENID获取用户信息，返回数组
     ****************************************************/
  
    public function wxGetUser($openId){
        $wxAccessToken = $this->wxAccessToken();
        if(!$wxAccessToken){
            return false;
        }
        $url      = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$wxAccessToken."&openid=".$openId."&lang=zh_CN";
        $result     = $this->wxHttpsRequest($url);
        $jsoninfo    = json_decode($result, true);
        return $jsoninfo;
    }
  
    /****************************************************
     * 微信通过指定模板信息发送给指定用户，发送完成后返回指定JSON数据
     ****************************************************/
  
    public function wxSendTemplate($jsonData){
        $wxAccessToken = $this->wxAccessToken();
        if(!$wxAccessToken){
            return false;
        }
        $url      = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$wxAccessToken;
        $result     = $this->wxHttpsRequest($url,$jsonData);
        return $result;
    }
    
    /**
     * 微信获取模板ID
     */
    public function wxGetTemplateId($template_id_short){
        $wxAccessToken = $this->wxAccessToken();
        if(!$wxAccessToken){
            return false;
        }
        $url = "https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token=".$wxAccessToken;
        $data = "{'template_id_short':'".$template_id_short."'}";
        $result     = $this->wxHttpsRequest($url,$data);
        return $result;
    }
  
    /**
     * 
     * 微信获取获取模板列表
     * @return mixed
     */
    public function wxGetTemplateList(){
        $wxAccessToken = $this->wxAccessToken();
        if(!$wxAccessToken){
            return false;
        }
        $url = "https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token=".$wxAccessToken;
        $result     = $this->wxHttpsRequest($url);
        return $result;
    }
    
    /****************************************************
     *   发送自定义的模板消息
     ****************************************************/
  
    public function wxSetSend($touser, $template_id, $url, $data, $topcolor = '#7B68EE'){
        $template = array(
            'touser' => $touser,
            'template_id' => $template_id,
            'url' => $url,
            'topcolor' => $topcolor,
            'data' => $data
        );
        $jsonData = json_encode($template);
        $result = $this->wxSendTemplate($jsonData);
        return $result;
    }
    
    /**
     * 发送客服消息
     */
    public function sendKfMessage($openid,$type='text',$data){
        $access_token = $this->wxAccessToken();
        if(!$access_token){
            return false;
        }
        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";
        $send_data = '{
            "touser":"' . $openid . '",
            "msgtype":"' . $type . '",
            "'. $type . '":'.$data.'
        }';
        $result     = $this->wxHttpsRequest($url,$send_data);
        $result_data = json_decode($result,true);
        if($result_data['errcode']==0){
            return true;
        }else{
            $this->error = $result_data;
            return false;
        }
    }
    
  
    /****************************************************
     * 微信设置OAUTH跳转URL，返回字符串信息 - SCOPE = snsapi_base //验证时不返回确认页面，只能获取OPENID
     ****************************************************/
  
    public function wxOauthBase($redirectUrl,$state = "",$appId = NULL){
        $appId     = is_null($appId) ? self::$appId : $appId;
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appId."&redirect_uri=".$redirectUrl."&response_type=code&scope=snsapi_base&state=".$state."#wechat_redirect";
        return $url;
    }
  
    /****************************************************
     * 微信设置OAUTH跳转URL，返回字符串信息 - SCOPE = snsapi_userinfo //获取用户完整信息
     ****************************************************/
  
    public function wxOauthUserinfo($redirectUrl,$state = "",$appId = NULL){
        $appId     = is_null($appId) ? self::$appId : $appId;
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appId."&redirect_uri=".$redirectUrl."&response_type=code&scope=snsapi_userinfo&state=".$state."#wechat_redirect";
        return $url;
    }
  
    /****************************************************
     * 微信OAUTH跳转指定URL
     ****************************************************/
  
    public function wxHeader($url){
        headers($url);
    }
  
    /****************************************************
     * 微信通过OAUTH返回页面中获取AT信息
     ****************************************************/
  
    public function wxOauthAccessToken($code,$appId = NULL , $appSecret = NULL){
        $appId     = is_null($appId) ? self::$appId : $appId;
        $appSecret   = is_null($appSecret) ? self::$appSecret : $appSecret;
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appId."&secret=".$appSecret."&code=".$code."&grant_type=authorization_code";
        $result     = $this->wxHttpsRequest($url);
        //print_r($result);
        $jsoninfo    = json_decode($result, true);
        //$access_token   = $jsoninfo["access_token"];
        return $jsoninfo;      
    }
  
    /****************************************************
     * 微信通过OAUTH的Access_Token的信息获取当前用户信息 // 只执行在snsapi_userinfo模式运行
     ****************************************************/
  
    public function wxOauthUser($OauthAT,$openId){
        $url      = "https://api.weixin.qq.com/sns/userinfo?access_token=".$OauthAT."&openid=".$openId."&lang=zh_CN";
        $result     = $this->wxHttpsRequest($url);
        $jsoninfo    = json_decode($result, true);
        return $jsoninfo;      
    }
      
    public function wxOathUserInfo($openId){
        $access_token = $this->wxAccessToken();
        if(!$access_token){
            return false;
        }
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$openId}&lang=zh_CN";
        $result     = $this->wxHttpsRequest($url);
        $jsoninfo    = json_decode($result, true);
        return $jsoninfo;
    }
    
    /*****************************************************
     *   生成随机字符串 - 最长为32位字符串
     *****************************************************/
    public function wxNonceStr($length = 16, $type = FALSE) {
      $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $str = "";
      for ($i = 0; $i < $length; $i++) {
       $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
      }
      if($type == TRUE){
        return strtoupper(md5(time() . $str));
      }
      else {
        return $str;
      }
    }
      
    /*******************************************************
     *   微信商户订单号 - 最长28位字符串
     *******************************************************/
      
    public function wxMchBillno($mchid = NULL) {
      if(is_null($mchid)){
        if(self::$mchid == "" || is_null(self::$mchid)){
          $mchid = time();
        }
        else{
          $mchid = self::$mchid;
        }
      }
      else{
        $mchid = substr(addslashes($mchid),0,10);
      }
      return date("Ymd",time()).time().$mchid;
    }
      
    /*******************************************************
     *   微信格式化数组变成参数格式 - 支持url加密
     *******************************************************/  
      
    public function wxSetParam($parameters){
      if(is_array($parameters) && !empty($parameters)){
        $this->parameters = $parameters;
        return $this->parameters;
      }
      else{
        return array();
      }
    }
      
    /*******************************************************
     *   微信格式化数组变成参数格式 - 支持url加密
     *******************************************************/
      
  public function wxFormatArray($parameters = NULL, $urlencode = FALSE){
      if(is_null($parameters)){
        $parameters = $this->parameters;
      }
      $restr = "";//初始化空
      ksort($parameters);//排序参数
      foreach ($parameters as $k => $v){//循环定制参数
        if (null != $v && "null" != $v && "sign" != $k) {
          if($urlencode){//如果参数需要增加URL加密就增加，不需要则不需要
            $v = urlencode($v);
          }
          $restr .= $k . "=" . $v . "&";//返回完整字符串
        }
      }
      if (strlen($restr) > 0) {//如果存在数据则将最后“&”删除
        $restr = substr($restr, 0, strlen($restr)-1);
      }
      return $restr;//返回字符串
  }
      
    /*******************************************************
     *   微信MD5签名生成器 - 需要将参数数组转化成为字符串[wxFormatArray方法]
     *******************************************************/
    public function wxMd5Sign($content, $key){
    try {
        if (is_null($key)) {
          throw new Exception("财付通签名key不能为空！");
        }
        if (is_null($content)) {
          throw new Exception("财付通签名内容不能为空");
        }
        $signStr = $content . "&key=" . $key;
        return strtoupper(md5($signStr));
      }
      catch (Exception $e)
      {
        die($e->getMessage());
      }
    }
      
    /*******************************************************
     *   微信Sha1签名生成器 - 需要将参数数组转化成为字符串[wxFormatArray方法]
     *******************************************************/
    public function wxSha1Sign($content, $key){
    try {
        if (is_null($key)) {
          throw new Exception("财付通签名key不能为空！");
        }
        if (is_null($content)) {
          throw new Exception("财付通签名内容不能为空");
        }
        $signStr = $content . "&key=" . $key;
        return strtoupper(sha1($signStr));
      }
      catch (Exception $e)
      {
        die($e->getMessage());
      }
    }
  
    /*******************************************************
     *   将数组解析XML - 微信红包接口
     *******************************************************/
      
  public function wxArrayToXml($parameters = NULL){
      if(is_null($parameters)){
        $parameters = $this->parameters;
      }
        
      if(!is_array($parameters) || empty($parameters)){
        die("参数不为数组无法解析");
      }
        
      $xml = "<xml>";
      foreach ($parameters as $key=>$val)
      {
        if (is_numeric($val))
        {
          $xml.="<".$key.">".$val."</".$key.">"; 
        }
        else
          $xml.="<".$key."><![CDATA[".$val."]]></".$key.">"; 
      }
      $xml.="</xml>";
      return $xml; 
    }
      
    
    //0704 上传临时文件
    public function wxUploadTempFile($file_path,$type='image'){
        $wxAccessToken = $this->wxAccessToken();
        if(!$wxAccessToken){
            return false;
        }
        $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token={$wxAccessToken}&type={$type}";
        $file_path = realpath($file_path);
        if(!$file_path){
            $this->error = array('error'=>1,'msg'=>'文件不存在1');
            return false;
        }
        $imageinfo = getimagesize($file_path);
        $img_size = ceil(filesize($file_path)/1024);
        $file_info = array('filename' => $file_path, //国片相对于网站根目录的路径
            'content-type' => $imageinfo['mime'], //文件类型
            'filelength' => $img_size //图文大小
        );
        $data = array('media'=>'@'.$file_path,'form-data'=>$file_info);
        $result = $this->wxHttpsRequest($url,$data);
        if(empty($data['errcode'])){
            return json_decode($result,true);
        }else{
            $this->error = array('error'=>2,'msg'=>$result['errmsg']);
            return false;
        }
    }
    
    public function wxGetQrcode($scene_id,$action_name='QR_LIMIT_SCENE'){
        $access_token = $this->wxAccessToken();
        if($access_token){
            $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$access_token;
            $json_arr = array('action_name'=>$action_name,'action_info'=>array('scene'=>array('scene_id'=>$scene_id)));
            $data = json_encode($json_arr);
            $json = json_decode($this->wxHttpsRequest($url,$data));
            $ticket = $json->ticket;
            if($ticket){
    			return $ticket;
            }else{
                $this->error = array('status'=>2,'msg'=>'获取带参数二维码失败',errinfo=>$json);
                return false;
            }
        }else{
            return false;
        }
    }
    
    function downloadimageformweixin($url) {  
        $ch = curl_init ();  
        curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );  
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );  
        curl_setopt ( $ch, CURLOPT_URL, $url );  
        ob_start ();  
        curl_exec ( $ch );  
        $return_content = ob_get_contents ();  
        ob_end_clean ();  
          
        $return_code = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );  
        return $return_content;  
    }
  }