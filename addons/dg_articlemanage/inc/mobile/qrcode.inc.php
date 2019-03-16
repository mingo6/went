<?php
global $_W,$_GPC;
load()->func('file');
define('SRC',$_W['attachurl']);
$uniacid=$_W['uniacid'];
$cfg=$this->module['config'];
$qrcode_desc=$cfg['qrcode_desc'];
$user_info = json_decode($this->getUserInfo());
$openid = $user_info->openid;
$avatar=$user_info->headimgurl;
$myself = pdo_get("dg_article_user",array('uniacid'=>$uniacid,'openid'=>$openid));
$ticket=$myself['ticket'];
if(empty($ticket)){
    $uniacccount = WeAccount::create ($_W['uniacid']);
    $barcode=array(
        'action_name' => '',
        'action_info' => array(
            'scene' => array('scene_str' => ''),
        ),
    );
    $vstr='dg_art_'.$uniacid.'_uid'.$openid;
    $barcode['action_info']['scene']['scene_str'] = $vstr;
    $barcode['action_name'] = "QR_LIMIT_STR_SCENE";
    $content = $uniacccount->barCodeCreateFixed($barcode);
    $ticket=$content["ticket"];
    pdo_update("dg_article_user",array('ticket'=>$ticket),array('uniacid'=>$uniacid,'openid'=>$openid));
    $qrinsert=array(
        'ticket'=>$ticket,
        'keyword'=>$vstr,
        'scene_str'=>$vstr,
        'name'=>'付费邀请卡',
        'uniacid'=>$uniacid,
        'acid'=>$uniacid,
        'type'=>'scene',
        'model'=>2,
        'createtime'=>time()
    );
    pdo_insert('qrcode',$qrinsert);
}
$list = pdo_fetchall("SELECT * FROM ".tablename('dg_article_user')." WHERE uniacid=".$uniacid." AND fopenid='".$openid."'");

if($_GPC['mini_pay']==true){
    if(file_exists(ATTACHMENT_ROOT."erdg_costreadsimple$uniacid/") == false){
        mkdir(ATTACHMENT_ROOT."erdg_costreadsimple$uniacid/");
    }

    if(file_exists(ATTACHMENT_ROOT."erdg_costreadsimple$uniacid/er$uniacid{$openid}.jpg") == false){
        $uniacid_mini = pdo_fetch("select uniacid from ".tablename('dg_account_token')."where mini_name=:mini_name",array(':mini_name' =>'dg_costreadsimple'));
        $access_token= getAccess_token('dg_account_token',$uniacid_mini['uniacid']);

        $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=$access_token";
        $art_u=$_SERVER['SERVER_NAME'].'&'.$uniacid.'&s='.$myself['id'];
        $data_arr = array('scene'=>"{$art_u}",'page'=>'dg_costreadsimple/pages/index/index','width'=>430);
        $er=http_curl($url,'post','json',json_encode($data_arr,true));

        if(strlen($er)<10000){
            $constraint=json_decode($er,true);
            if($constraint['errcode'] == 40001){
                getAccess_token('dg_account_token',$uniacid_mini['uniacid'],1);
            }
        }
        file_put_contents(ATTACHMENT_ROOT."erdg_costreadsimple$uniacid/er{$uniacid}{$openid}.jpg",$er);
    }
    $ticketurl = ATTACHMENT_ROOT."erdg_costreadsimple$uniacid/er{$uniacid}{$openid}.jpg";
}else{
    $ticketurl = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=' . urlencode($ticket);
}
$url='';

$url ='../addons/dg_articlemanage/style/qrcode/image/';
$chat_poster = scandir('../addons/dg_articlemanage/style/qrcode/image',1);
array_pop($chat_poster);
array_pop($chat_poster);
$background = $url.$chat_poster[0];
$updir = '../attachment/images/'.$uniacid.'/'.date("Y").'/'.date("m").'/';
if(!is_dir($updir)){
    mkdirs($updir);
}

//图片名称
$useravatar='dg_articlemanage'.$myself['id']."uid_".$myself['openid']."_top";
//图片保存路径
$avatarlocal= $updir.$useravatar.".png";
//字体路径
$fontfile='../addons/dg_articlemanage/style/qrcode/font/msyh.ttf';


//邀请人头像
$avatar=substr($avatar,0,strlen($avatar)-3).'64';

//$user = downloadWeixinFile($myself['avatar']);
$user = downloadWeixinFile($avatar);

$test = test($user['body'],$updir.$useravatar);
$myself['qrcode_desc']=$qrcode_desc;
$code = intval($_GPC['code']);
if(!empty($_GPC['type'])&&$_GPC['type']=='img'){

    if(!empty($chat_poster[$code])){
        $background = $url.$chat_poster[$code];//图片的完整路径
        $img = qrcode($ticketurl,$background,$avatarlocal,$fontfile,$myself,$test);
        echo json_encode(array('status'=>1,'content'=>$img));
        exit;
    }else{
        echo json_encode(array('status'=>0,'content'=>'未找到背景'));
        exit;
    }

}

$img = qrcode($ticketurl,$background,$avatarlocal,$fontfile,$myself,$test);
include $this->template('qrcode');
function qrcode($ticketurl,$background,$avatarlocal,$fontfile,$myself,$test){
    $text = autowrap(20,0,$fontfile,$myself['nickname'],350);
    $qrcode_desc = autowrap(20,0,$fontfile,$myself['qrcode_desc'],350);

    $src = imagecreatefromstring(file_get_contents($ticketurl));//从字符串中新建一个二维码图像
    $dst = imagecreatefromstring(file_get_contents($background));

    imagejpeg($src,$avatarlocal);//保存二维码
    list($width, $height)=getimagesize($avatarlocal);//拿到图片宽高
    list($b_w, $b_h)=getimagesize($background);//拿到图片宽高
    //缩放粘贴二维码至背景图
    $per=0.5;
    $n_w=$width*$per;
    $n_h=$height*$per;
    $qr_l=($b_w-$n_w)/2;

    $new=imagecreatetruecolor($n_w, $n_h);//新建一个真彩色图像
    $img=imagecreatefromjpeg($avatarlocal);
    imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
    imagecopymerge($dst, $new, 70, 885, 0, 0, $n_w, $n_h, 100);
    /*头像粘贴至背景图*/
    $im = imagecreatefrompng($test);
    imagecopyresampled($dst,$im,280,200,0,0,100,100,64,64);
    //粘贴文字
    $color = imagecolorallocate($dst, 0, 0, 0);
    //imagettftext($dst,20,0,150,360,$color,$fontfile,$text);
    imagettftext($dst,20,0,150,360,$color,$fontfile,$qrcode_desc);

    //保存
    imagepng($dst,$avatarlocal);
    imagedestroy($im);
    imagedestroy($new);
    imagedestroy($img);
    imagedestroy($dst);

    return $avatarlocal;
}


function autowrap($fontsize, $angle=0, $fontface="", $string, $width) {
    // 这几个变量分别是 字体大小, 角度, 字体名称, 字符串, 预设宽度
    $content = "";
    $v = 0;
    // 将字符串拆分成一个个单字 保存到数组 letter 中
    for ($i=0;$i<mb_strlen($string,'utf-8');$i++) {
        $letter[] = mb_substr($string, $i, 1,'utf-8');
    }
    if(!empty($letter)){
        foreach ($letter as $l) {
            $v+=1;
            $teststr = $content." ".$l;
            $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
            // 判断拼接后的字符串是否超过预设的宽度
            if (($testbox[2] > $width) && ($content !== "")) {
                $content .= "\n";
            }
            if($v<30){
                $content .= $l;
            }else{
                $content .='...';
                break;
            }
        }
    }

    return $content;
}

function downloadWeixinFile($url) {
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
/*处理圆头像并保存*/
function test($body,$useravatar){
    /*处理圆头像*/
    //图片保存路径
    $dest_path= $useravatar."11.png";

    $w = 64;  $h=64; // original size
    $src = imagecreatefromstring($body);//获取头像
    $newpic = imagecreatetruecolor($w,$h);
    imagealphablending($newpic,false);
    $transparent = imagecolorallocatealpha($newpic, 255,255,255, 127);

    $r=$w/2;
    for($x=0;$x<$w;$x++)
        for($y=0;$y<$h;$y++){
            $c = imagecolorat($src,$x,$y);
            $_x = $x - $w/2;
            $_y = $y - $h/2;
            if((($_x*$_x) + ($_y*$_y)) < ($r*$r)){
                imagesetpixel($newpic,$x,$y,$c);
            }else{
                imagesetpixel($newpic,$x,$y,$transparent);
            }
        }
    imagesavealpha($newpic, true);
    imagepng($newpic, $dest_path);
    imagedestroy($newpic);
    imagedestroy($src);
    if(file_exists($url)){
        unlink($url);
    }
    return $dest_path;
}

/****************小程序所用********************/
function getAccess_token($table,$uniacid,$constraint=0){
    $mes = pdo_fetch("SELECT aw.secret,aw.key FROM ".tablename('account_wxapp')."as aw WHERE uniacid=:uniacid",array(':uniacid'=>$uniacid));
    $access_token = pdo_fetch("SELECT access_token,expires_in FROM ".tablename("$table")." WHERE uniacid=:uniacid",array(':uniacid'=>$uniacid));

    if($access_token['expires_in'] <= time()+7000 || $constraint == 1){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$mes['key']}&secret={$mes['secret']}";

        $arr=http_curl($url);
        $arr=json_decode($arr,true);
        $access_token=$arr['access_token'];

        $data=array(
            'access_token'=>$access_token,
            'expires_in'=>time()+7000
        );
        pdo_update($table,$data,array('uniacid'=>$uniacid));
    }else{
        $access_token=$access_token['access_token'];
    }
    return $access_token;
}


function http_curl($url,$type='get',$res='json',$arr=''){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    //有的是证书问题
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    if($type== 'post'){
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$arr);
    }

    $output=curl_exec($ch);

    curl_close($ch);

    if($res=='json'){
        if(curl_errno($ch)){
            return curl_error($ch);
        }else{
            return $output;
        }
    }
}
/****************小程序所用********************/
?>