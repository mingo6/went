<?php
class Sms {
	/**
	 * 发送短信
	 *
	 * @param string $mobile 手机号码
	 * @param string $msg 短信内容
	 * @param string $needstatus 是否需要状态报告
	 * @param string $extno   扩展码，可选
	 */
    private $api_send_url;
    private $api_balance_query_url;
    private $api_account = 'N613153_N3718739';
    private $api_password = 'XI4awBJrNEa759';
    private $error;
    
    const RESULT_SUCCESS = 0;   //发送成功
    const RESULT_USER_NOTEXISTS = 101;   //无此用户
    const RESULT_PASS_ERROR = 102;   //密码错误
    const RESULT_SUBMIT_FAST = 103;   //提交过快
    const RESULT_SYSTEM_BUSY = 104;   //系统忙
    const RESULT_SENSITIVE_MSG = 105;   //敏感短信
    const RESULT_MSG_LENGTH_ERROR = 106;   //消息长度错误
    const RESULT_MOBILE_ERROR = 107;   //包含错误的手机号码
    const RESULT_MOBILE_LENGTH_ERROR = 108;   //手机号位数错误
    const RESULT_NOT_AMOUNT = 109;   //无发送额度
    const RESULT_NOT_SEND_TIME = 110;   //不在发送时间内
    const RESULT_EXCEED_CURRMONTH_AMOUNT_LIMIT = 111;   //超出该账户当月发送额度限制
    const RESULT_NOT_GOODS = 112;   //无此产品，用户没有订购该产品
    const RESULT_EXTNO_FROMAT_ERROR = 113;   //extno格式错误
    const RESULT_AUTOAUDIT_REVIEW = 115;   //自动审核驳回
    const RESULT_SIGNA_ERROR = 116;   //签名不合法
    const RESULT_IP_ERROR = 117;   //IP地址认证错误
    const RESULT_NOT_RESPONSE_PRIVILEGE = 118;   //没有响应的发送权限
    const RESULT_USER_EXPIRED = 119;   //用户已过期
    const RESULT_TEST_NOT_WRITE_LIST = 120;   //测试内容不是白名单
    
    public function __construct($account = '', $password = ''){
		$this->api_send_url = "https://smssh1.253.com/msg/send/json";
        $this->api_balance_query_url = "https://smssh1.253.com/msg/balance/json";
        $this->api_variable_url = "https://smssh1.253.com/msg/variable/json";
		if(!empty($account)){
            $this->api_account = $account;
        }
        if(!empty($password)){
            $this->api_password = $password;
		}
		$this->sign = '【嘀嘀订水】'; //签名
    }
	public function sendSMS( $mobile, $msg, $report = true) {
		//创蓝接口参数
		$postArr = array (
			'account' => $this->api_account,
			'password' => $this->api_password,
			'msg' => $this->sign . $msg,
			'phone' => $mobile,
			'report' => $report
		);
		$result = $this->curlPost( $this->api_send_url , $postArr);
		$res = $this->execResult($result);
		return $res;
	}

	/**
	 * 发送变量短信
	 *
	 * @param string $msg 			短信内容
	 * @param string $params 	最多不能超过1000个参数组
	 */
	public function sendVariableSMS( $msg, $params) {
		global $chuanglan_config;
		//创蓝接口参数
		$postArr = array (
			'account'  => $this->api_account,
			'password' => $this->api_password,
			'msg' => $msg,
			'params' => $params,
			'report' => 'true'
        );
		$result = $this->curlPost( $this->api_variable_url, $postArr);
		return $result;
	}
	
	/**
	 * 查询额度
	 *
	 *  查询地址
	 */
	public function queryBalance() {
		//查询参数
		$postArr = array ( 
		          'account' => $this->api_account,
		          'pswd' => $this->api_password,
		);
		$result = $this->curlPost($this->api_balance_query_url, $postArr);
		return $result;
	}

	/**
	 * 处理返回值
	 * 
	 */
	public function execResult($result){
		// $result=preg_split("/[,\r\n]/",$result);
		$result=json_decode($result, true);
		switch ($result['code']) {
		    case self::RESULT_SUCCESS:
		        $this->error['msg'] = '发送成功';
		        return true;
		        break;
		    case self::RESULT_USER_NOTEXISTS:
		        $this->error['msg'] = '无此用户';
		        break;
		    case self::RESULT_PASS_ERROR:
		        $this->error['msg'] = '密码错误';
		        break;
		    case self::RESULT_SUBMIT_FAST:
		        $this->error['msg'] = '提交过快';
		        break;
		    case self::RESULT_SYSTEM_BUSY:
		        $this->error['msg'] = '系统忙';
		        break;
		    case self::RESULT_SENSITIVE_MSG:
		        $this->error['msg'] = '敏感短信';
		        break;
		    case self::RESULT_MSG_LENGTH_ERROR:
		        $this->error['msg'] = '消息长度错误';
		        break;
		    case self::RESULT_MOBILE_ERROR:
		        $this->error['msg'] = '包含错误的手机号码';
		        break;
		    case self::RESULT_MOBILE_LENGTH_ERROR:
		        $this->error['msg'] = '手机号位数错误';
		        break;
		    case self::RESULT_NOT_AMOUNT:
		        $this->error['msg'] = '无发送额度';
		        break;
		    case self::RESULT_NOT_SEND_TIME:
		        $this->error['msg'] = '不在发送时间内';
		        break;
		    case self::RESULT_EXCEED_CURRMONTH_AMOUNT_LIMIT:
		        $this->error['msg'] = '超出该账户当月发送额度限制';
		        break;
		    case self::RESULT_NOT_GOODS:
		        $this->error['msg'] = '无此产品，用户没有订购该产品';
		        break;
		    case self::RESULT_EXTNO_FROMAT_ERROR:
		        $this->error['msg'] = 'extno格式错误';
		        break;
		    case self::RESULT_AUTOAUDIT_REVIEW:
		        $this->error['msg'] = '自动审核驳回';
		        break;
		    case self::RESULT_SIGNA_ERROR:
		        $this->error['msg'] = '签名不合法';
		        break;
		    case self::RESULT_IP_ERROR:
		        $this->error['msg'] = 'IP地址认证错误';
		        break;
		    case self::RESULT_NOT_RESPONSE_PRIVILEGE:
		        $this->error['msg'] = '没有响应的发送权限';
		        break;
		    case self::RESULT_USER_EXPIRED:
		        $this->error['msg'] = '用户已过期';
		        break;
		    case self::RESULT_TEST_NOT_WRITE_LIST:
		        $this->error['msg'] = '测试内容不是白名单';
		        break;
			default:
				if(isset($result['errorMsg'])){
					$this->error['msg'] = $result['errorMsg'];
				}else{
					$this->error['msg'] ='未知错误！';
				}
		        break;
		}
		return false;
	}

	/**
	 * 通过CURL发送HTTP请求
	 * @param string $url  //请求URL
	 * @param array $postFields //请求参数 
	 * @return mixed
	 *  
	 */
	private function curlPost($url,$postFields){
		$postFields = json_encode($postFields);
		
		$ch = curl_init ();
		curl_setopt( $ch, CURLOPT_URL, $url ); 
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json; charset=utf-8'   //json版本需要填写  Content-Type: application/json;
			)
		);
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4); 
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt( $ch, CURLOPT_TIMEOUT,60); 
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
		$ret = curl_exec ( $ch );
        if (false == $ret) {
            $result = curl_error(  $ch);
        } else {
            $rsp = curl_getinfo( $ch, CURLINFO_HTTP_CODE);
            if (200 != $rsp) {
                $result = "请求状态 ". $rsp . " " . curl_error($ch);
            } else {
                $result = $ret;
            }
        }
		curl_close ( $ch );
		return $result;
	}
	
	public function getError()
	{
	    return $this->error;
	}
	
	//魔术获取
	public function __get($name){
		return $this->$name;
	}
	
	//魔术设置
	public function __set($name,$value){
		$this->$name=$value;
	}
}
?>