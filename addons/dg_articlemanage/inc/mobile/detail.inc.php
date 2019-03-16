<?php
    global $_W,$_GPC;
    $cfg=$this->module['config'];
    $op=empty($_GPC['op']) ? "display" :$_GPC['op'];
	$shang_status=empty($cfg['shang_status'])?1:$cfg['shang_status'];
    $uniacid=$_W['uniacid'];
	$configlist=pdo_fetchall("select * from ".tablename("dg_article_vipconfig")." where uniacid=:uniacid",array(":uniacid"=>$uniacid));
    $userinfo=$this->getUserInfo();
	$userinfo = json_decode($userinfo,true);
    $openid=$userinfo['openid'];
	$temp_url=$this->createMobileUrl('detail');
    $temp_url=substr($temp_url, 1);
    $send_url=$_W['siteroot']."app".$temp_url;
    //查找课程指定的分组id
    $asql="select * from ".tablename('dg_article')."  where id=:id";
    $mparms=array(":id"=>$_GET['id']);
    $power=pdo_fetch($asql,$mparms);
    if($power['appoint']==2){
        if(!empty($power['appo_users'])){
            $powerid=substr($power['appo_users'], 0, -1);
            //查找分组里面的用户id
            $sql="select userid from ".tablename('dg_article_group')."  where id in ($powerid) and uniacid=:uniacid ";
            $parms=array(":uniacid"=>$uniacid);
            $groupuser=pdo_fetchall($sql,$parms);
            $userid = '';
            foreach ($groupuser as $key => $value) {
                    $userid .= $value['userid'];
            }
            $userid=  substr($userid, 0, -1);
            $groupuser=  explode(',', $userid);//课程限制的所有用户id
            //查找访问用户的id
            $usql="select id from ".tablename('dg_article_user')."  where openid=:openid and uniacid=:uniacid ";
            $mparm=array(":openid"=>$_W['openid'],":uniacid"=>$uniacid);
            $uid=pdo_fetch($usql,$mparm);
        //是不是用户
            if(!empty($uid['id'])){
                    $flag = true;
                    foreach ($groupuser as $k => $v) {
                         foreach( $uid as $val ){
                            //判断是否在用户组里
                            if( !in_array($val, $groupuser) ){
                            $flag = false;
                            break;
                            }
                        }
                    }
                    if(!$flag){
                        //不在制定用户组里面
                        echo '<title>阅读受限</title>';
                        echo '<div style="width:80% height:50%; margin:10% auto;text-align:center;font-size:24px;">';
                        echo '<img style="width:80%;" src="http://'.$_SERVER['HTTP_HOST'].'/addons/dg_articlemanage/style/images/power.png" />';
                        echo '<h2>本内容只限指定用户阅览。</h2>';
                        echo '<h2>可以联系管理员开通阅览权限。</h2>';
                        echo '</div>';
                        exit();
                    }
            }  else {
                //请求用户不在用户表(基本不会存在)
                echo '<title>阅读受限</title>';
                echo '<div style="width:80% height:50%; margin:10% auto;text-align:center;font-size:24px;">';
                echo '<img style="width:80%;" src="http://'.$_SERVER['HTTP_HOST'].'/addons/dg_articlemanage/style/images/power.png" />';
//                echo '<h2>您还不是有效用户，<a href="{php echo $this->createmobileurl("edit")}"><i class="iconfont">&#xe60b;</i>请先再个人中心编辑资料</a></h2>';
                echo '<h2>本内容只限指定会员用户阅览。</h2>';
                echo '</div>';
                exit();
                    
            }
        }else{
            //课程没有添加指定用户组
            echo '<title>阅读受限</title>';
            echo '<div style="width:80% height:50%; margin:10% auto;text-align:center;font-size:24px;">';
            echo '<img style="width:80%;" src="http://'.$_SERVER['HTTP_HOST'].'/addons/dg_articlemanage/style/images/power.png" />';
            echo '<h2>本内容只限指定用户阅览。</h2>';
            echo '</div>';
            exit();
        }
    }
function ordersubmit($orderid,$moneynum){
    global $_W,$_GPC;
    $article_id=intval($_GPC['id']);
    $fromer=$_GPC['fuser'];
	
    $uniacid=$_W['uniacid'];
    $openid=$_W['openid'];
    if($_W["account"]["level"]<4){
        $openid=$_SESSION['oauth_openid'];
    }
    $user=pdo_get("dg_article_user",array('uniacid'=>$uniacid,'openid'=>$openid));
	if(empty($fromer)){
		$fromer=$user['fopenid'];
	}
    $article=pdo_get('dg_article',array('id'=>$article_id));
    $author=pdo_get("dg_article_author",array('uniacid'=>$uniacid,'id'=>$article['author_id']));
    $data=array(
        "uniacid"=>$uniacid,
        "article_id"=>$article_id,
        "openid"=>$openid,
        "oauth_openid"=>empty($_SESSION['oauth_openid'])?$_W['fans']['from_user']:$_SESSION['oauth_openid'],
        "pay_money"=>$moneynum,
        "out_trade_no"=>$orderid,
        "order_status"=>0,
        "author_id"=>$author['id'],
        "pay_time"=>time(),
        'fromer'=>$fromer
    );
    pdo_insert('dg_article_payment',$data);
}
$kjSetting=$this->findKJsetting();
//本片课程支付
function getpayment($money,$kjSetting){
    global $_W,$_GPC;
    $money= floatval($money);

    $money=(int)($money*100);
    $out_trade_no =  date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    if($_GPC['pay_type']=='uni'){
        $jsApi = new JsApi_pub($kjSetting);

        $openid=$_W['openid'];
        if($_W["account"]["level"]<4){
            $openid=$_SESSION['oauth_openid'];
        }
        $unifiedOrder = new UnifiedOrder_pub($kjSetting);
        $unifiedOrder->setParameter("openid", "$openid");//商品描述
        $unifiedOrder->setParameter("body", "课程付费阅读");//商品描述
        $timeStamp = time();
        
        $unifiedOrder->setParameter("out_trade_no", "$out_trade_no");//商户订单号
        $unifiedOrder->setParameter("total_fee", $money);//总金额
        $notifyUrl = $_W['siteroot'] . "addons/dg_articlemanage/notify.php";
        $unifiedOrder->setParameter("notify_url", $notifyUrl);//通知地址
        $unifiedOrder->setParameter("trade_type", "JSAPI");//交易类型
        $prepay_id = $unifiedOrder->getPrepayId();
       // var_dump($prepay_id);
        $jsApi->setPrepayId($prepay_id);
        $jsApiParameters = $jsApi->getParameters();

   }

    //插入数据到赞赏表中
    $data=array(
            'money'=>$money/100,
            'out_trade_no'=>$out_trade_no,
            'jsApiParameters'=>$jsApiParameters
        );
		    ordersubmit($out_trade_no,$money);
    //return $jsApiParameters;
    return $data;
}
//会员支付
if($op=="post"){
    $id=intval($_GPC['id']);
    $vipconfig=pdo_fetch("select * from ".tablename("dg_article_vipconfig")." where id=:id",array(":id"=>$id));
    $num = 1;
    $day=$num*intval($vipconfig["day"]);
    $money=$num*floatval($vipconfig["money"]);
   $pay_parameters=getpayments($money,$day,$kjSetting,$openid);
    $data=$pay_parameters;
    header("Content-type:application/json");
    echo json_encode($data);
    exit();
}

function ordersubmits($orderid,$moneynum,$day,$openid){
   global $_W,$_GPC;
    
    $uniacid=$_W['uniacid'];
    $user=pdo_get("dg_article_user",array('uniacid'=>$uniacid,'openid'=>$openid));
    $data=array();
    $data['uniacid']=$uniacid;
    $data['openid']=$openid;
    $data['recharge']=$moneynum;
    $data['out_trade_no']=$orderid;
    $data['rec_status']=0;
    $data['rec_time']=time();
    $data['month']=$day;
    //$data['mode']=$mode;
    $data['fopenid']=$user['fopenid'];
    pdo_insert('dg_article_recharge',$data);
   // / pdo_debug();
}

function getpayments($money,$day,$kjSetting,$openid){
     global $_W,$_GPC;
    $money= (int)(floatval($money)*100);
    $out_trade_no =  date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
   
     if($_GPC['pay_type']=='uni'){
        $jsApi = new JsApi_pub($kjSetting);
        $unifiedOrder = new UnifiedOrder_pub($kjSetting);
        $unifiedOrder->setParameter("openid", "$openid");//商品描述
        $unifiedOrder->setParameter("body", "阅读会员支付");//商品描述
        $timeStamp = time();
        
        $unifiedOrder->setParameter("out_trade_no", "$out_trade_no");//商户订单号
        $unifiedOrder->setParameter("total_fee", $money);//总金额
        $notifyUrl = $_W['siteroot'] . "addons/dg_articlemanage/recharge.php";
        $unifiedOrder->setParameter("notify_url", $notifyUrl);//通知地址
        $unifiedOrder->setParameter("trade_type", "JSAPI");//交易类型
        $prepay_id = $unifiedOrder->getPrepayId();
        $jsApi->setPrepayId($prepay_id);
        $jsApiParameters = $jsApi->getParameters();
 }
        $data=array(
            'money'=>$money,
            'out_trade_no'=>$out_trade_no,
            'jsApiParameters'=>$jsApiParameters
        );
   
    //插入数据到赞赏表中

    ordersubmits($out_trade_no,$money,$day,$openid);
    // return $jsApiParameters;
    return $data;
}

global $_GPC, $_W;
$id = intval($_GPC['id']);
$uniacid=$_W['uniacid'];
$openid=$_W['openid'];
$detail = pdo_fetch("SELECT * FROM " . tablename('dg_article') . " WHERE `id`=:id and uniacid=:uniacid", array(':id'=>$id,':uniacid' => $uniacid));
$pcate=pdo_get('dg_article_category',array('uniacid'=>$uniacid,'id'=>$detail['pcate']));
$one_article = pdo_fetchall("select * from ".tablename('dg_article')."  where uniacid={$uniacid} and pcate=".$detail['pcate']." and status=2 order by displayorder desc ,id desc limit 0,5");

if (!empty($detail)) {
    pdo_update('dg_article', array('clickNum' => $detail['clickNum'] + 1), array('id' => $detail['id']));
}
$shareimg = toimage($detail['thumb']);
$url=$_W['siteroot']."app/".substr($this->createMobileUrl('detail',array('id'=>$id,'uniacid'=>$uniacid,'fuser'=>$openid),true),2);
$fromer=$_GPC['fuser'];
if($_W["account"]["level"]<4){
    $openid=$_SESSION['oauth_openid'];
}
$user=pdo_fetch("select * from ".tablename('dg_articlelike')."where tid=:id and openid=:openid and uniacid=:uniacid",array(":id"=>$id,":openid"=>$openid,":uniacid"=>$uniacid));
if(!empty($user)){
    $like=1;
}
$member=pdo_fetch("select * from ".tablename('dg_article_user')." where uniacid=:uniacid and openid=:openid",array(":uniacid"=>$uniacid,":openid"=>$openid));
$pay_status=0;
$pay_count=0;
$pay_parameters="{}";
$payid=$_GPC['payid'];
$pay_count=$detail['pay_num'];
/*作者*/
$autorid=$detail['author_id'];
$asql="select * from ".tablename('dg_article_author')." where uniacid=:uniacid and id=:id";
$aprams=array(":uniacid"=>$uniacid,":id"=>$autorid);
$author=pdo_fetch($asql,$aprams);

if($detail['pay_money']>0&&$member["info_status"]!=2&&$openid!=$author['openid']){
    $pay_status=pdo_fetchcolumn("SELECT order_status FROM ".tablename('dg_article_payment')." WHERE order_status=1 AND openid=:openid AND article_id=:article_id and uniacid=:uniacid",array(":openid"=>$openid,":article_id"=>$id,':uniacid' => $uniacid));
    $pay_count=pdo_fetchcolumn("SELECT count(0) FROM ".tablename('dg_article_payment')." WHERE order_status=1 AND article_id=:article_id and uniacid=:uniacid",array(":article_id"=>$id,':uniacid' => $uniacid));
    //如果不存在或者没有支付则替换为课程简介
    $pay_count=$pay_count+$detail['pay_num'];
    if(empty($pay_status)){
        if($detail['types']==1){
            $detail['content']=htmlspecialchars_decode($detail['description']);
        }
        if($detail['types']==2){
            $detail['images']=array_slice(explode(',',$detail['images']),0,$detail['img_free']);
        } 
        if($detail['types']==3){
            $aud_free=$detail['aud_free'];
        } 
        if($detail['types']==4){
            $ved_free=$detail['ved_free'];
        } 
    }
    if($payid==1){
        $pay_parameters=getpayment($detail['pay_money'],$kjSetting);
        $data=$pay_parameters;
        header("Content-type:application/json");
        echo json_encode($data);
        exit();
    }
}
if($detail['types']==2){
    $detail['images']=array_filter(explode(',',$detail['images']));
}
$sql="select * from ".tablename('dg_article_shang')." where article_id=:article_id and uniacid=:uniacid and shang_status=1 order by shang_time desc limit 5";
$parms=array(':uniacid'=>$uniacid,':article_id'=>$id);
$shang=pdo_fetchall($sql,$parms);

foreach($shang as &$item){
    $fansinfo=mc_fetch($item['openid']);
    if(empty($item['headimg'])){
        $item['headimg']=$fansinfo['avatar'];
    }
    
}

$ssql="select count(*) from ".tablename('dg_article_shang')." where openid=:openid and uniacid=:uniacid and article_id=:article_id and shang_status=1";
$sparms=array(":openid"=>$openid,":uniacid"=>$uniacid,":article_id"=>$id);
$sstatus=pdo_fetchcolumn($ssql,$sparms);
$pcount=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_shang')." where shang_status=1 and uniacid=:uniacid and article_id=:article_id",$parms);


$wechat=  pdo_fetch("SELECT * FROM ".tablename('account_wechats')." WHERE acid=:acid AND uniacid=:uniacid limit 1", array(':acid' => $uniacid,':uniacid' => $uniacid));
if(!empty($detail['template'])) {
    include $this->template($detail['templatefile']);
    exit;
}
function randomFloat($min = 0, $max = 1) {
    return $min + mt_rand() / mt_getrandmax() * ($max - $min);
}
$sdol=round(randomFloat(1,5),2);

/*留言展示*/
$disql="select * from ".tablename("dg_article_dis")." where uniacid=:uniacid and aritcle_id=:id and status=2";
$disparms=array(":uniacid"=>$uniacid,":id"=>$id);
$dis=pdo_fetchall($disql,$disparms);



if(!empty($_GPC['disid'])){
    $artid=$_GPC['id'];
    $disid=$_GPC['disid'];
    $result=pdo_fetch("select * from ".tablename('dg_article_diszan')." where uniacid=:uniacid and disid=:disid and artid=:aritid AND openid=:openid",array(":uniacid"=>$uniacid,":disid"=>$disid,":aritid"=>$artid,'openid'=>$openid));

    // $is_dizan=pdo_fetch
    if(empty($result)){
        $insert=array(
            'uniacid'=>$uniacid,
            'disid'=>$disid,
            'artid'=>$artid,
            'openid'=>$openid,
            'createtime'=>TIMESTAMP
        );
        pdo_insert('dg_article_diszan',$insert);
    }else{
      $a= pdo_delete('dg_article_diszan',array("uniacid"=>$uniacid,"disid"=>$disid,"artid"=>$artid,'openid'=>$openid));
  

    }
    // $zannum=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_dis')." where uniacid=:uniacid and aritcle_id=:aid and id=:disid",array(":uniacid"=>$uniacid,":aid"=>$artid,":disid"=>$disid));
    $zannum=pdo_fetchcolumn("select count(*) from ".tablename('dg_article_diszan')." where uniacid=:uniacid and disid=:disid and artid=:aritid",array(":uniacid"=>$uniacid,":disid"=>$disid,":aritid"=>$artid));
    $up=array(
      'zannum'=>$zannum
    );
    pdo_update("dg_article_dis",$up,array("id"=>$disid));
    $res=array();
    header("Content-type:application/json");
    $res['zannum']=$zannum;
    echo json_encode($res);
    exit;
}

$colsql="select count(*) from ".tablename('dg_article_collect')." where article_id=:id and openid=:openid";
$colparms=array(":id"=>$detail['id'],":openid"=>$openid);
$iscol=pdo_fetchcolumn($colsql,$colparms);
include $this->template('detail5');
exit;