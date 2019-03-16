<?php
global $_W,$_GPC;

if(empty($_SESSION['check_success'])) {
    ajaxreturn(10001,'非法操作');
} 

$mobile = $_GPC['mobile'];
$name = $_GPC['name'];
$addr = $_GPC['addr'];

function ajaxreturn($code, $msg)
{
    echo json_encode(array('code'=>$code, 'msg'=>$msg));
    exit;
}

if(empty($_GPC['mobile'])) ajaxreturn(10000, '手机号码不能为空！');
if(empty($_GPC['name'])) ajaxreturn(10000, '姓名不能为空！');
if(empty($_GPC['addr'])) ajaxreturn(10000, '地址不能为空！');
$reg = '/^1[34578]\d{9}$/';
if(!preg_match($reg, $_GPC['mobile'])) ajaxreturn(10000, '手机号码格式不正确！');

$startTime = strtotime(date('Y-m-d'));
$endTime = $startTime + 24 * 3600;

//获取ip
function ip() 
{
    //strcasecmp 比较两个字符，不区分大小写。返回0，>0，<0。
    // if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
    //     $ip = getenv('HTTP_CLIENT_IP');
    // } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
    //     $ip = getenv('HTTP_X_FORWARDED_FOR');
    // } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
    //     $ip = getenv('REMOTE_ADDR');
    // } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
    //     $ip = $_SERVER['REMOTE_ADDR'];
    // }
    $ip = $_SERVER['REMOTE_ADDR'];
    $res =  preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
    return $res;
}
$ip_addr = ip();

// $sql = 'SELECT count(id) AS count FROM '.tablename('gt_lottery_record') . ' WHERE uniacid = "'.$_W['uniacid'].'" AND ( mobile = "'. $_GPC['mobile'] . '" OR ip_addr = "'. $ip_addr .'" ) AND create_time >= '. $startTime .' AND create_time < '.$endTime;
// $count = pdo_fetchcolumn($sql);
// if($count > 0){
//     ajaxreturn(10001, '您今天已经抽过奖了！');
// }

$config = uni_modules(false);
$data = array(
    'users_id' => 0,
    'is_lottery' => 0,
    'prize_id' => 0,
    'mobile' => $_GPC['mobile'],
    'real_name' => $_GPC['name'],
    'addr' => $_GPC['addr'],
    'ip_addr' => $ip_addr,
    'create_time' => TIMESTAMP,
);
$isLotter = false;
$count = pdo_getcolumn('gt_lottery_record', array('mobile' => $_GPC['mobile'], 'uniacid' => $_W['uniacid'], 'is_lottery' => 1), 'id');
if($config[MODULE]['config']['lottery_count'] == -1)
{
    $isLotter = true;
}
elseif($config[MODULE]['config']['lottery_count'] > 0)
{
    if($count < $config[MODULE]['config']['lottery_count']){
        $isLotter = true;
    }
}

if($isLotter){
    //开始计算抽奖
    // $prizeInfo = pdo_getall('gt_prize', array(), array('id','prob'));
    $sql = 'SELECT id,prob FROM ' . tablename('gt_prize') . ' WHERE uniacid = "'.$_W['uniacid'].'" AND num>0 ORDER BY sort DESC,id';
    $prizeInfo = pdo_fetchall($sql);
    $tempPrizeInfo = array();
    if(!empty($prizeInfo)){
        $rand = rand(0, model_prize::PRIZE_PROB_SALE);
        foreach($prizeInfo AS $key => $value)
        {
            if($value['prob'] >= $rand && (empty($tempPrizeInfo) || $tempPrizeInfo['prob'] > $value['prob'])){
                $tempPrizeInfo = $value;
            }
        }
    }
    else
    {
        ajaxreturn(10001, '抱歉，所有奖品都已经赠送出去了');
    }
    if(!empty($tempPrizeInfo)){
        $data['prize_id'] = $tempPrizeInfo['id'];
        $data['is_lottery'] = 1;

        // 修改库存数量
        $prizeRes = pdo_query("UPDATE " . tablename('gt_prize') . " SET num=num-1 WHERE uniacid=".$_W['uniacid']." and id=".$tempPrizeInfo['id']);
        if(!$prizeRes) ajaxreturn(10000, '系统错误！');
    }
}
$res = Util::inserData('gt_lottery_record',$data);
if(!$res) ajaxreturn(10000, '系统错误！');

$_SESSION['check_success'] = false;

if(empty($data['prize_id'])) {
    ajaxreturn(10001, '很遗憾，没有抽到奖品，请明天再试');
} else {
    ajaxreturn(200, '抽奖成功');
}