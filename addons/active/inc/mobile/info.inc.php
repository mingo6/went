<?php
global $_W,$_GPC;
$uniacid = $_W['uniacid'];
$userinfo = $_SESSION['userinfo'];

//参与活动
if (empty($_POST['ua'])&&$_POST['id']){
    $id = $_POST['id'];

    //活动结束时间
    $active_info = pdo_get('active_activity', array('id'=>$id), array('end_time','start_time'));

    if ((int)$active_info['start_time']>time()){
        exit(json_encode(['status'=>2,'msg'=>'活动暂未开始！']));
    }
    if ((int)$active_info['end_time']<time()){
        exit(json_encode(['status'=>2,'msg'=>'活动已过期！']));
    }

    if (Util::getSingelDataInSingleTable('active_users_activity',array('user_id'=>$userinfo['id'],'activity_id'=>$id,'uniacid'=>$uniacid))){
        exit(json_encode(['status'=>3,'msg'=>'您已参加活动了，请勿重复操作！']));
    }

    $data = array(
        'user_id'=>$userinfo['id'],
        'activity_id'=>$id,
        'attend_time'=>time()
    );
    //参与人数
    pdo_update('active_activity',array('attend_people_num +='=>1,'sham_people_num +='=>1), array('id'=>$id));
    $res = Util::inserData('active_users_activity',$data);
    if ($res){
        exit(json_encode(['status'=>1,'msg'=>'参加成功！']));
    }else{
        exit(json_encode(['status'=>2,'msg'=>'参加失败，请稍后重试！']));
    }
}
//点赞
elseif(!empty($_POST['ua'])){
    $activity_id = $_POST['id'];
    $users_activity_id = $_POST['ua'];
    if (Util::getSingelDataInSingleTable('active_users_fabulous',array('users_id'=>$userinfo['id'],'users_activity_id'=>$users_activity_id,'uniacid'=>$uniacid))){
        exit(json_encode(['status'=>2,'msg'=>'您已点过赞了！']));
    }
    //点赞次数
    pdo_update('active_users_activity',array('fabulous_num +='=>1), array('id'=>$users_activity_id));

    //点赞记录
    $data = array(
        'users_id'=>$userinfo['id'],
        'avatar'=>$userinfo['avatar'],
        'users_activity_id'=>$users_activity_id,
        'fabulous_time'=>time(),
        'uniacid'=>$uniacid
    );
    $res = Util::inserData('active_users_fabulous',$data);

    if ($res){
        exit(json_encode(['status'=>1,'msg'=>'点赞成功！']));
    }else{
        exit(json_encode(['status'=>2,'msg'=>'点赞失败，请稍后重试！']));
    }
}
//活动详情
else{
    $ua = $_GPC['ua'];
    if (empty($_GPC['id'])) message('该活动不存在或已关闭！');
    $info = Util::getSingelDataInSingleTable('active_activity',array('is_default'=>1,'id'=>$_GPC['id'],'uniacid'=>$uniacid));
    if (empty($info)) message('该活动不存在或已关闭！');
    if (empty($ua)){
        $ua = pdo_get('active_users_activity', array('activity_id'=>$_GPC['id'],'user_id'=>$userinfo['id']), array('id'));
        if (isset($ua)) $ua = $ua['id'];
    }

    //底部二维码
    $index_url = $_W['siteroot']."app/index.php?i=".$uniacid."&c=entry&do=index&m=active";
    $code_url = $_W['siteroot']."app/index.php?i=".$uniacid."&c=entry&do=qrcode&m=active&url=".urlencode($index_url);

    //富文本
    $info['synopsis'] = htmlspecialchars_decode($info['synopsis']);
    $info['product_introduce'] = htmlspecialchars_decode($info['product_introduce']);
    $info['rule'] = htmlspecialchars_decode($info['rule']);


    //活动详情
    if (empty($ua)){
        $is_my_active = 0;
        $isSupport = 0;
        $iscode=0;
        //微信自定义分享内容
        $shareCon = array(
            'title' => $info['title'],
            'link' => $_W['siteroot']."app/index.php?i=".$uniacid."&c=entry&do=info&m=active&id=".$info['id']."&ua=".$ua,
            'imgUrl' => $_W['siteroot']."/attachment/".$info['share_img'],
            'desc' => $info['index_synopsis']
        );
        $signPackage = $_W['account']['jssdkconfig'];
    }
    //我的活动详情
    else{
        //微信自定义分享内容
        $shareCon = array(
            'title' => "我在参加“".$info['title']."”活动，需要得到".$info['need_fabulous_num']."位亲友的助力，请帮我点赞加油。",
            'link' => $_W['siteroot']."app/index.php?i=".$uniacid."&c=entry&do=info&m=active&id=".$info['id']."&ua=".$ua,
            'imgUrl' => $_W['siteroot']."/attachment/".$info['share_img'],
            'desc' => $info['index_synopsis']
        );
        $signPackage = $_W['account']['jssdkconfig'];

        //点赞人数和点赞用户头像
        $user_avatar = pdo_getall('active_users_fabulous', array('users_activity_id' => $ua),array('avatar'));

        $active_user_activity = pdo_get('active_users_activity', array('id'=>$ua), array('id','user_id','fabulous_num','activity_code','havecode_time','iscode_time','is_code'));
        //$active_user_activity = pdo_fetchall("select a.id,a.user_id,a.fabulous_num,a.activity_code,b.avatar from ".tablename('active_users_activity')." as a left join ".tablename('active_users_fabulous')." as b on a.id = b.users_activity_id where a.id = :id and a.uniacid = :uniacid",array(':id'=>$ua,':uniacid'=>$uniacid));
        $iscode=$active_user_activity['is_code'];
        //如果点赞数大于等于集赞数，则生成活动码
        if (empty($active_user_activity['activity_code'])&&$active_user_activity['fabulous_num']>=$info['need_fabulous_num'])
        {

            if ($info['limited_num'] <= $info['code_num']){
                pdo_update('active_users_activity', array('is_code'=>3), array('id'=>$ua));
                $iscode=3;
            }else{
                //随机生成10位数字符串
                $str="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
                str_shuffle($str);
                $active_code=substr(str_shuffle($str),26,10);
                pdo_update('active_users_activity', array('activity_code'=>$active_code,'havecode_time'=>time()), array('id'=>$ua));
                do {
                    $str="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
                    str_shuffle($str);
                    $active_code=substr(str_shuffle($str),26,10);
                } while (pdo_get('active_users_activity', array('activity_code'=>$str,'uniacid'=>$uniacid), array('id')));
                pdo_update('active_users_activity', array('activity_code'=>$active_code,'havecode_time'=>time()), array('id'=>$ua));
                pdo_update('active_activity',array('code_num +='=>1), array('is_default'=>1,'id'=>$_GPC['id']));
                $active_user_activity['activity_code']=$active_code;
                $active_user_activity['havecode_time']=time();
                $iscode=1;
            }

        }

        $disparity_num = $info['need_fabulous_num']-$active_user_activity['fabulous_num'];

        //自己查看，可转发和邀请
        if ($active_user_activity['user_id']==$userinfo['id']){
            $is_my_active = 1;
            $isSupport = 0;
            $isHeOrMy = '我';
        }
        //他人查看，可点赞和参加
        else{

            $is_my_active = 2;
            if (Util::getSingelDataInSingleTable('active_users_fabulous',array('users_id'=>$userinfo['id'],'users_activity_id'=>$ua,'uniacid'=>$uniacid))){
                //已点赞
                $isSupport = 1;
            }else{
                //未点赞
                $isSupport = 2;
            }
            $isHeOrMy = '他';
        }
    }
    include $this->template('my_info');
}
