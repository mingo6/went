<?php 
defined("IN_IA") or exit( "Access Denied" );
global $_W;
global $_GPC;
icheckauth();
$_W["page"]["title"] = "资料修改";
$user = $_W["member"];
$ta = (trim($_GPC["ta"]) ? trim($_GPC["ta"]) : "info");
if( $ta == "edit" ) 
{
    $type = trim($_GPC["type"]);
    $id = $user["uid"];
    if( $_W["ispost"] ) 
    {
        $data = array(  );
        $callback = $_GPC["callback"];
        if( $type == "username" ) 
        {
            if( !$_GPC["realname"] ) 
            {
                imessage(error(-1, "用户名不能空"), "", "ajax");
            }

            $data = array( "realname" => trim($_GPC["realname"]) );
            pdo_update("tiny_wmall_members", $data, array( "uid" => $id, "uniacid" => $_W["uniacid"] ));
        }elseif($type == "region"){
            $region_id = trim($_GPC["region_id"]);
            if( !$region_id ) 
            {
                imessage(error(-1, "区域不能为空！"), "", "ajax");
            }
            $regionInfo = pdo_get('tiny_wmall_region', array('id' => $region_id, 'uniacid' => $_W["uniacid"]));
            if(!$regionInfo){
                imessage(error(-1, "区域不存在"), "", "ajax");
            }
            $data = array( "region_id" => $region_id );
            if(false === pdo_update("tiny_wmall_members", $data, array( "uid" => $id, "uniacid" => $_W["uniacid"] ))){
                imessage(error(-1, "修改失败！"), "", "ajax");
            }
            pdo_update('tiny_wmall_address', array('region_id' => $region_id), array('uid' => $id, 'uniacid' => $_W["uniacid"]));
        }
        else
        {
            if( $type == "account" ) 
            {
                $password = trim($_GPC["password"]);
                $newpassword = trim($_GPC["newpassword"]);
                $repassword = trim($_GPC["repassword"]);
                if( empty($password) ) 
                {
                    imessage(error(-1, "密码不能为空"), "", "ajax");
                }

                if( empty($newpassword) ) 
                {
                    imessage(error(-1, "新密码不能为空"), "", "ajax");
                }

                $length = strlen($newpassword);
                if( $length < 8 || 20 < $length ) 
                {
                    imessage(error(-1, "请输入8-20密码"), "", "ajax");
                }

                if( !preg_match(IREGULAR_PASSWORD, $newpassword) ) 
                {
                    imessage(error(-1, "密码必须由数字和字母组合"), "", "ajax");
                }

                if( empty($repassword) ) 
                {
                    imessage(error(-1, "请确认密码"), "", "ajax");
                }

                if( $newpassword != $repassword ) 
                {
                    imessage(error(-1, "两次输入的密码不一致"), "", "ajax");
                }

                $member = pdo_get("tiny_wmall_members", array( "uid" => $id, "uniacid" => $_W["uniacid"] ), array( "password", "salt" ));
                $password = md5(md5($member["salt"] . $password) . $member["salt"]);
                if( $password != $member["password"] ) 
                {
                    imessage(error(-1, "原密码错误"), "", "ajax");
                }

                $data = array( "password" => md5(md5($member["salt"] . $newpassword) . $member["salt"]) );
                pdo_update("tiny_wmall_members", $data, array( "uid" => $id, "uniacid" => $_W["uniacid"] ));
            }

        }
        if($callback){
            $callback = urldecode($callback);
        }
        imessage(error(0, "修改成功"), $callback, "ajax");
    }

    if($type == "region"){
        $regionList = pdo_fetchall("select * from" . tablename("tiny_wmall_region") . "where uniacid = :uniacid order by id asc", array( ":uniacid" => $_W["uniacid"] ), "id");
    }
}

if( $ta == "bind" ) 
{
    if(!empty($user['mobile'])){
        header("location: " . imurl('wmall/member/mine'));
    }
    $id = $user["uid"];
    if( $_W["isajax"] ) 
    {
        $mobile = (trim($_GPC["mobile"]) ? trim($_GPC["mobile"]) : imessage(error(-1, "请输入手机号"), "", "ajax"));
        $password = (trim($_GPC["password"]) ? trim($_GPC["password"]) : imessage(error(-1, "请输入密码"), "", "ajax"));
        $callback = $_GPC["callback"];
        $length = strlen($password);
        if( $length < 8 || 20 < $length ) 
        {
            imessage(error(-1, "请输入8-20密码"), "", "ajax");
        }

        if( !preg_match(IREGULAR_PASSWORD, $password) ) 
        {
            imessage(error(-1, "密码必须由数字和字母组合"), "", "ajax");
        }

        $repassword = (trim($_GPC["repassword"]) ? trim($_GPC["repassword"]) : imessage(error(-1, "请重复输入密码"), "", "ajax"));
        if( $password != $repassword ) 
        {
            imessage(error(-1, "两次输入的密码不一样"), "", "ajax");
        }

        $code = trim($_GPC["code"]);
        $status = check_verifycode($mobile, $code);
        if( !$status ) 
        {
            imessage(error(-1, "验证码错误"), "", "ajax");
        }

        $member = pdo_fetch("select * from " . tablename("tiny_wmall_members") . " where uniacid = :uniacid and mobile = :mobile and uid != :id", array( ":uniacid" => $_W["uniacid"], ":mobile" => $mobile, ":id" => $id ));
        if( !empty($member) ) 
        {
            imessage(error(-1, "该手机号已被其他用户绑定"), "", "ajax");
        }

        $salt = random(6, true);
        $password = md5(md5($salt . $password) . $salt);
        $updateData = array( "mobile" => $mobile, "password" => $password, "salt" => $salt, "mobile_audit" => 1 );
        if(empty($user['mobile'])){
            $updateData['drinking_fountain_num'] = intval($_GPC["drinking_fountain_num"]);
            $updateData['bucket_num'] = floatval($_GPC["bucket_num"]);
            $updateData['region_id'] = intval($_GPC["region_id"]);
            if($updateData['region_id'] <= 0){
                imessage(error(-1, "区域不能为空！"), "", "ajax");
            }
            $regionInfo = pdo_get('tiny_wmall_region', array('id' => $updateData['region_id'], 'uniacid' => $_W['uniacid']), array('id'));
            if(!$regionInfo){
                imessage(error(-1, "区域不存在！"), "", "ajax");
            }
        }
        if(!pdo_update("tiny_wmall_members", $updateData, array( "uid" => $id, "uniacid" => $_W["uniacid"] ))){
            imessage(error(1, "绑定失败"), "", "ajax");
        }
        if($callback){
            $callback = urldecode($callback);
        }
        imessage(error(0, "绑定成功"), $callback, "ajax");
    }
    //注册协议
    $agreement_member = get_config_text('agreement_member');    //注册协议
    $regionList = pdo_fetchall("select * from" . tablename("tiny_wmall_region") . "where uniacid = :uniacid order by id asc", array( ":uniacid" => $_W["uniacid"] ), "id");
}
if($user['region_id'] > 0){
    $regionInfo = pdo_get('tiny_wmall_region', array('id' => $user['region_id'], 'uniacid' => $_W['uniacid']), array('name'));
    if(empty($regionInfo)){
        //查不到区域，更新用户数据。
        pdo_update('tiny_wmall_members', array('region_id' => 0), array('id' => $user['id']));
    }else{
        $user['region_name'] = $regionInfo['name'];
    }
}
include(itemplate("member/profile"));
?>